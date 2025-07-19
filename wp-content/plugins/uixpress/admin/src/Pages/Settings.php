<?php
namespace UiXpress\Pages;
use UiXpress\Options\GlobalOptions;
use UiXpress\Update\Updater;
use UiXpress\Rest\RestLogout;
use UiXpress\Utility\Scripts;

// Prevent direct access to this file
defined("ABSPATH") || exit();

/**
 * Class uixpress
 *
 * Main class for initialising the uixpress app.
 */
class Settings
{
  private static $screen = null;
  /**
   * uixpress constructor.
   *
   * Initialises the main app.
   */
  public function __construct()
  {
    add_action("admin_menu", ["UiXpress\Pages\Settings", "admin_settings_page"]);
  }

  /**
   * Adds settings page.
   *
   * Calls add_menu_page to add new page .
   */
  public static function admin_settings_page()
  {
    $options = get_option("uixpress_settings", []);
    $menu_name = isset($options["plugin_name"]) && $options["plugin_name"] != "" ? esc_html($options["plugin_name"]) : "uiXpress";

    $hook_suffix = add_options_page($menu_name, $menu_name, "manage_options", "uipc-settings", ["UiXpress\Pages\Settings", "build_uipc"]);

    add_action("admin_head-{$hook_suffix}", ["UiXpress\Pages\Settings", "load_styles"]);
    add_action("admin_head-{$hook_suffix}", ["UiXpress\Pages\Settings", "load_scripts"]);
  }

  /**
   * uixpress settings page.
   *
   * Outputs the app holder
   */
  public static function build_uipc()
  {
    // Enqueue the media library
    wp_enqueue_media();
    // Output the app
    echo "<div id='uipc-settings-app'></div>";
  }

  /**
   * uixpress styles.
   *
   * Loads main lp styles
   */
  public static function load_styles()
  {
    // Get plugin url
    $url = plugins_url("uixpress/");
    $style = $url . "app/dist/assets/styles/settings.css";
    wp_enqueue_style("uixpress-settings", $style, [], uixpress_plugin_version);
  }

  /**
   * uixpress scripts.
   *
   * Loads main lp scripts
   */
  public static function load_scripts()
  {
    // Get plugin url
    $url = plugins_url("uixpress/");
    $script_name = Scripts::get_base_script_path("uixpressSettings.js");

    // Setup script object
    $builderScript = [
      "id" => "uipc-settings-script",
      "src" => $url . "app/dist/{$script_name}",
      "type" => "module",
    ];

    // Print tag
    wp_print_script_tag($builderScript);
  }
}
