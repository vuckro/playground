<?php
namespace UiXpress\Rest;
use UiXpress\Rest\PluginMetricsCollector;

// Prevent direct access to this file
defined("ABSPATH") || exit();

// Include required files for the upgrader
require_once ABSPATH . "wp-admin/includes/class-wp-upgrader.php";
require_once ABSPATH . "wp-admin/includes/update.php";
require_once ABSPATH . "wp-admin/includes/plugin.php";
require_once ABSPATH . "wp-admin/includes/file.php";
require_once ABSPATH . "wp-admin/includes/misc.php";

/**
 * Custom upgrader skin that doesn't require user input
 */
class Silent_Upgrader_Skin extends \WP_Upgrader_Skin
{
  protected $errors = null;

  public function __construct()
  {
    $this->errors = new \WP_Error();
  }

  public function request_filesystem_credentials($error = false, $context = "", $allow_relaxed_file_ownership = false)
  {
    return true;
  }

  public function get_upgrade_messages()
  {
    return [];
  }

  public function feedback($string, ...$args)
  {
  }

  public function header()
  {
  }

  public function footer()
  {
  }

  public function error($errors)
  {
    if (is_string($errors)) {
      $this->errors->add("unknown", $errors);
    } elseif (is_wp_error($errors)) {
      foreach ($errors->get_error_codes() as $code) {
        $this->errors->add($code, $errors->get_error_message($code), $errors->get_error_data($code));
      }
    }
  }

  public function get_errors()
  {
    return $this->errors;
  }
}

/**
 * Class PluginManager
 *
 * Creates new REST API endpoints to manage WordPress plugins
 */
class PluginManager
{
  /**
   * Constructor - registers REST API endpoints
   */
  public function __construct()
  {
    add_action("rest_api_init", ["UiXpress\Rest\PluginManager", "register_custom_endpoints"]);
    new PluginMetricsCollector();
  }

  /**
   * Registers custom endpoints for plugin management
   */
  public static function register_custom_endpoints()
  {
    // Endpoint for plugin activation
    register_rest_route("uixpress/v1", "/plugin/activate/(?P<slug>[a-zA-Z0-9-_]+)", [
      "methods" => "POST",
      "callback" => ["UiXpress\Rest\PluginManager", "activate_plugin"],
      "permission_callback" => ["UiXpress\Rest\PluginManager", "check_permissions"],
      "args" => [
        "slug" => [
          "required" => true,
          "type" => "string",
          "sanitize_callback" => "sanitize_text_field",
        ],
      ],
    ]);

    // Endpoint for plugin deactivation
    register_rest_route("uixpress/v1", "/plugin/deactivate/(?P<slug>[a-zA-Z0-9-_]+)", [
      "methods" => "POST",
      "callback" => ["UiXpress\Rest\PluginManager", "deactivate_plugin"],
      "permission_callback" => ["UiXpress\Rest\PluginManager", "check_permissions"],
      "args" => [
        "slug" => [
          "required" => true,
          "type" => "string",
          "sanitize_callback" => "sanitize_text_field",
        ],
      ],
    ]);

    // Endpoint for plugin deletion
    register_rest_route("uixpress/v1", "/plugin/delete/(?P<slug>[a-zA-Z0-9-_]+)", [
      "methods" => "DELETE",
      "callback" => ["UiXpress\Rest\PluginManager", "delete_plugin"],
      "permission_callback" => ["UiXpress\Rest\PluginManager", "check_permissions"],
      "args" => [
        "slug" => [
          "required" => true,
          "type" => "string",
          "sanitize_callback" => "sanitize_text_field",
        ],
      ],
    ]);

    // Endpoint for plugin update
    register_rest_route("uixpress/v1", "/plugin/update/(?P<slug>[a-zA-Z0-9-_]+)", [
      "methods" => "POST",
      "callback" => ["UiXpress\Rest\PluginManager", "update_plugin"],
      "permission_callback" => ["UiXpress\Rest\PluginManager", "check_permissions"],
      "args" => [
        "slug" => [
          "required" => true,
          "type" => "string",
          "sanitize_callback" => "sanitize_text_field",
        ],
      ],
    ]);

    // Endpoint for plugin auto updates
    register_rest_route("uixpress/v1", "/plugin/toggle-auto-update/(?P<slug>[a-zA-Z0-9-_]+)", [
      "methods" => "POST",
      "callback" => ["UiXpress\Rest\PluginManager", "toggle_auto_update"],
      "permission_callback" => ["UiXpress\Rest\PluginManager", "check_permissions"],
      "args" => [
        "slug" => [
          "required" => true,
          "type" => "string",
          "sanitize_callback" => "sanitize_text_field",
        ],
      ],
    ]);

    // Endpoint for plugin installation from ZIP
    register_rest_route("uixpress/v1", "/plugin/install", [
      "methods" => "POST",
      "callback" => ["UiXpress\Rest\PluginManager", "install_plugin_from_zip"],
      "permission_callback" => ["UiXpress\Rest\PluginManager", "check_permissions"],
      "accept_file_uploads" => true, // Enable file uploads
    ]);

    // In register_custom_endpoints():
    register_rest_route("uixpress/v1", "/plugin/install-repo/(?P<slug>[a-zA-Z0-9-_]+)", [
      "methods" => "POST",
      "callback" => ["UiXpress\Rest\PluginManager", "install_plugin_from_repo"],
      "permission_callback" => ["UiXpress\Rest\PluginManager", "check_permissions"],
      "args" => [
        "slug" => [
          "required" => true,
          "type" => "string",
          "sanitize_callback" => "sanitize_text_field",
        ],
      ],
    ]);

    // Endpoint for querying plugin load time
    register_rest_route("uixpress/v1", "/plugins/performance/(?P<slug>[a-zA-Z0-9-_]+)", [
      "methods" => "GET",
      "callback" => ["UiXpress\Rest\PluginManager", "get_plugin_performance_metrics"],
      "permission_callback" => function () {
        return current_user_can("manage_options");
      },
      "args" => [
        "slug" => [
          "required" => false,
          "type" => "string",
          "sanitize_callback" => "sanitize_text_field",
        ],
      ],
    ]);
  }

  /**
   * Check if user has required permissions
   *
   * @return boolean
   */
  public static function check_permissions()
  {
    // Check if user is logged in and has proper capabilities
    return is_user_logged_in() && current_user_can("activate_plugins") && current_user_can("delete_plugins");
  }

  /**
   * Activate a plugin
   *
   * @param WP_REST_Request $request
   * @return WP_REST_Response
   */
  public static function activate_plugin($request)
  {
    // Set a flag to indicate we're in a REST request
    if (!defined("REST_REQUEST")) {
      define("REST_REQUEST", true);
    }

    // Force WordPress to think this is an AJAX request
    if (!defined("DOING_AJAX")) {
      define("DOING_AJAX", true);
    }

    $plugin_slug = $request->get_param("slug");
    $plugin_file = self::get_plugin_file($plugin_slug);
    $plugin_data = get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin_file);

    if (!$plugin_file) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "Plugin not found",
        ],
        404
      );
    }

    // Prevents any html from redirects being returned in the response
    ob_start();

    $result = activate_plugin($plugin_file);

    // Clean up buffer
    ob_end_clean();

    if (is_wp_error($result)) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => $result->get_error_message(),
        ],
        500
      );
    }

    // Get the default action links (like "Settings", "Deactivate")
    $action_links = apply_filters("plugin_action_links_" . $plugin_file, [], $plugin_file, $plugin_data, "");

    // Get additional meta links (like "View details", "Documentation", etc)
    $row_meta = apply_filters("plugin_row_meta", [], $plugin_file, $plugin_data, "");

    // Combine all links and clean them up
    $all_links = array_merge($action_links, $row_meta);
    $cleaned_links = [];

    foreach ($all_links as $link) {
      // Extract URL and text from HTML link
      if (preg_match('/<a.*?href=["\'](.*?)["\'].*?>(.*?)<\/a>/i', $link, $matches)) {
        $cleaned_links[] = [
          "url" => $matches[1],
          "text" => strip_tags($matches[2]),
          "type" => strpos($link, "settings") !== false ? "settings" : (strpos($link, "documentation") !== false ? "documentation" : "other"),
        ];
      }
    }

    return new \WP_REST_Response(
      [
        "success" => true,
        "message" => "Plugin activated successfully",
        "action_links" => $cleaned_links,
      ],
      200
    );
  }

  /**
   * Deactivate a plugin
   *
   * @param WP_REST_Request $request
   * @return WP_REST_Response
   */
  public static function deactivate_plugin($request)
  {
    $plugin_slug = $request->get_param("slug");
    $plugin_file = self::get_plugin_file($plugin_slug);

    if (!$plugin_file) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "Plugin not found",
        ],
        404
      );
    }

    deactivate_plugins($plugin_file);

    if (is_plugin_active($plugin_file)) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "Failed to deactivate plugin",
        ],
        500
      );
    }

    return new \WP_REST_Response(
      [
        "success" => true,
        "message" => "Plugin deactivated successfully",
      ],
      200
    );
  }

  /**
   * Delete a plugin
   *
   * @param WP_REST_Request $request
   * @return WP_REST_Response
   */
  public static function delete_plugin($request)
  {
    $plugin_slug = $request->get_param("slug");
    $plugin_file = self::get_plugin_file($plugin_slug);

    if (!$plugin_file) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "Plugin not found",
        ],
        404
      );
    }

    // Deactivate plugin first
    deactivate_plugins($plugin_file);

    // Delete plugin
    $result = delete_plugins([$plugin_file]);

    if (is_wp_error($result)) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => $result->get_error_message(),
        ],
        500
      );
    }

    return new \WP_REST_Response(
      [
        "success" => true,
        "message" => "Plugin deleted successfully",
      ],
      200
    );
  }

  /**
   * Update a plugin
   *
   * @param WP_REST_Request $request
   * @return WP_REST_Response
   */
  public static function update_plugin($request)
  {
    $plugin_slug = $request->get_param("slug");
    $plugin_file = self::get_plugin_file($plugin_slug);

    if (!$plugin_file) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "Plugin not found",
        ],
        404
      );
    }

    // Store the active status before update
    $was_active = is_plugin_active($plugin_file);

    // Check if update is available
    wp_update_plugins(); // Check for plugin updates
    $update_plugins = get_site_transient("update_plugins");

    if (!isset($update_plugins->response[$plugin_file])) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "No update available for this plugin",
        ],
        400
      );
    }

    // Initialize WordPress filesystem
    global $wp_filesystem;
    if (empty($wp_filesystem)) {
      WP_Filesystem();
    }

    // Prepare the upgrader with our custom skin
    $skin = new Silent_Upgrader_Skin();
    $upgrader = new \Plugin_Upgrader($skin);

    // Perform the update
    $result = $upgrader->upgrade($plugin_file);

    // Check for errors
    if (is_wp_error($result)) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => $result->get_error_message(),
        ],
        500
      );
    }

    // Get error messages if any
    $errors = $skin->get_errors();
    if ($errors && $errors->has_errors()) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => $errors->get_error_message(),
        ],
        500
      );
    }

    if (false === $result) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "Plugin update failed",
        ],
        500
      );
    }

    // Reactivate the plugin if it was active before the update
    if ($was_active) {
      $activate_result = activate_plugin($plugin_file);
      if (is_wp_error($activate_result)) {
        return new \WP_REST_Response(
          [
            "success" => true,
            "message" => "Plugin updated successfully but reactivation failed: " . $activate_result->get_error_message(),
          ],
          200
        );
      }
    }

    return new \WP_REST_Response(
      [
        "success" => true,
        "message" => "Plugin updated successfully" . ($was_active ? " and reactivated" : ""),
      ],
      200
    );
  }

  /**
   * Toggle auto updates for a plugin
   *
   * @param WP_REST_Request $request
   * @return WP_REST_Response
   */
  public static function toggle_auto_update($request)
  {
    $plugin_slug = $request->get_param("slug");
    $plugin_file = self::get_plugin_file($plugin_slug);

    if (!$plugin_file) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "Plugin not found",
        ],
        404
      );
    }

    // Get current auto update settings
    $auto_updates = (array) get_site_option("auto_update_plugins", []);

    // Check if plugin is currently set to auto update
    $auto_update_enabled = in_array($plugin_file, $auto_updates);

    if ($auto_update_enabled) {
      // Remove from auto updates
      $auto_updates = array_diff($auto_updates, [$plugin_file]);
      $message = "Auto updates disabled";
    } else {
      // Add to auto updates
      $auto_updates[] = $plugin_file;
      $message = "Auto updates enabled";
    }

    // Update the option
    $update_result = update_site_option("auto_update_plugins", array_values($auto_updates));

    if (!$update_result) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "Failed to update auto update settings",
        ],
        500
      );
    }

    return new \WP_REST_Response(
      [
        "success" => true,
        "message" => $message,
        "auto_update_enabled" => !$auto_update_enabled, // Return the new state
      ],
      200
    );
  }

  /**
   * Install a plugin from a ZIP file
   *
   * @param WP_REST_Request $request
   * @return WP_REST_Response
   */
  public static function install_plugin_from_zip($request)
  {
    // Check if file was uploaded
    $files = $request->get_file_params();

    if (empty($files["plugin_zip"])) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "No plugin file uploaded",
        ],
        400
      );
    }

    $file = $files["plugin_zip"];

    // Verify it's a ZIP file
    $file_type = wp_check_filetype($file["name"], ["zip" => "application/zip"]);
    if ($file_type["type"] !== "application/zip") {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "Invalid file type. Please upload a ZIP file.",
        ],
        400
      );
    }

    // Initialize WordPress filesystem
    global $wp_filesystem;
    if (empty($wp_filesystem)) {
      WP_Filesystem();
    }

    // Prepare the upgrader
    $skin = new Silent_Upgrader_Skin();
    $upgrader = new \Plugin_Upgrader($skin);

    // Install the plugin
    $result = $upgrader->install($file["tmp_name"]);

    // Check for errors
    if (is_wp_error($result)) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => $result->get_error_message(),
        ],
        500
      );
    }

    // Get error messages if any
    $errors = $skin->get_errors();
    if ($errors && $errors->has_errors()) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => $errors->get_error_message(),
        ],
        500
      );
    }

    if (false === $result) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "Plugin installation failed",
        ],
        500
      );
    }

    // Get the installed plugin file
    $plugin_file = $upgrader->plugin_info();

    if (!$plugin_file) {
      return new \WP_REST_Response(
        [
          "success" => true,
          "message" => "Plugin installed successfully but could not determine the plugin file",
        ],
        200
      );
    }

    // Get plugin data
    $plugin_data = get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin_file);
    $plugin_data["active"] = false;
    $plugin_data["slug"] = $plugin_file;

    return new \WP_REST_Response(
      [
        "success" => true,
        "message" => "Plugin installed successfully",
        "plugin" => $plugin_data,
      ],
      200
    );
  }

  public static function install_plugin_from_repo($request)
  {
    $plugin_slug = $request->get_param("slug");

    // Initialize filesystem
    global $wp_filesystem;
    if (empty($wp_filesystem)) {
      WP_Filesystem();
    }

    // Setup upgrader
    $skin = new Silent_Upgrader_Skin();
    $upgrader = new \Plugin_Upgrader($skin);

    // Install the plugin
    $result = $upgrader->install("https://downloads.wordpress.org/plugin/" . $plugin_slug . ".latest-stable.zip");

    if (is_wp_error($result)) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => $result->get_error_message(),
        ],
        500
      );
    }

    // Get error messages
    $errors = $skin->get_errors();
    if ($errors && $errors->has_errors()) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => $errors->get_error_message(),
        ],
        500
      );
    }

    if (false === $result) {
      return new \WP_REST_Response(
        [
          "success" => false,
          "message" => "Plugin installation failed",
        ],
        500
      );
    }

    // Get installed plugin info
    $plugin_file = $upgrader->plugin_info();
    $plugin_data = get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin_file);
    $plugin_data["active"] = false;
    $plugin_data["slug"] = $plugin_file;

    $slug_parts = explode("/", $plugin_file);
    $base_slug = $slug_parts[0];
    $plugin_data["splitSlug"] = $base_slug;

    return new \WP_REST_Response(
      [
        "success" => true,
        "message" => "Plugin installed successfully",
        "plugin" => $plugin_data,
      ],
      200
    );
  }

  /**
   * Helper function to get plugin file from slug
   *
   * @param string $plugin_slug
   * @return string|null
   */
  private static function get_plugin_file($plugin_slug)
  {
    if (!function_exists("get_plugins")) {
      require_once ABSPATH . "wp-admin/includes/plugin.php";
    }

    $plugins = get_plugins();

    foreach ($plugins as $plugin_file => $plugin_info) {
      if (strpos($plugin_file, $plugin_slug . "/") === 0 || $plugin_file === $plugin_slug . ".php") {
        return $plugin_file;
      }
    }

    return null;
  }

  public static function get_plugin_performance_metrics($request)
  {
    $plugin_slug = $request->get_param("slug");
    $backend = $request->get_param("backend");

    $path = $plugin_slug ? "/?collect_plugin_metrics=1&plugin_slug={$plugin_slug}" : "/?collect_plugin_metrics=1";
    $url = $backend ? admin_url($path) : home_url($path);

    $args = [
      "timeout" => 30, // Set timeout to 10 seconds
    ];

    $response = wp_remote_get($url, $args);

    if (is_wp_error($response)) {
      error_log("WP Error: " . $response->get_error_message());
      return new \WP_REST_Response(
        [
          "error" => "Failed to collect metrics",
          "message" => $response->get_error_message(),
        ],
        500
      );
    }

    $status_code = wp_remote_retrieve_response_code($response);
    if ($status_code !== 200) {
      error_log("HTTP Error: " . $status_code . " - " . wp_remote_retrieve_response_message($response));
      return new \WP_REST_Response(
        [
          "error" => "HTTP Error",
          "status" => $status_code,
          "message" => wp_remote_retrieve_response_message($response),
        ],
        500
      );
    }

    $body = wp_remote_retrieve_body($response);

    // Look for script tag with JSON data
    if (preg_match('/<script id="plugin-metrics-data" type="application\/json">(.*?)<\/script>/s', $body, $matches)) {
      $metrics = json_decode($matches[1], true);
      if ($metrics === null) {
        return new \WP_REST_Response(
          [
            "error" => "Failed to parse metrics JSON",
            "json_error" => json_last_error_msg(),
          ],
          500
        );
      }
      return new \WP_REST_Response($metrics, 200);
    }

    return new \WP_REST_Response(["error" => "No metrics found"], 404);
  }
}
