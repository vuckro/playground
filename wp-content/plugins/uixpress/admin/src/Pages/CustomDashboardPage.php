<?php
namespace UiXpress\Pages;
use UiXpress\Utility\Scripts;

defined("ABSPATH") || exit();

/**
 * Class CustomDashboardPage
 *
 * Handles the modification of the default WordPress dashboard
 * to provide widget data via script attributes
 */
class CustomDashboardPage
{
  /** @var array */
  private static $options;

  /** @var array */
  private $captured_widgets = [];

  /** @var array */
  private $captured_styles = [];

  /**
   * CustomDashboardPage constructor.
   */
  public function __construct()
  {
    // Earlier priority to catch before default dashboard loads
    add_action("load-index.php", [$this, "setup_dashboard"], 0);
    add_action("admin_head-index.php", [$this, "load_styles"]);
    add_action("admin_head-index.php", [$this, "load_scripts"]);

    // Capture styles early
    add_action("admin_enqueue_scripts", [$this, "capture_styles"], 99999);
  }

  /**
   * Captures all enqueued stylesheets
   */
  public function capture_styles()
  {
    global $wp_styles;

    if (!is_object($wp_styles)) {
      return;
    }

    // Get all registered styles
    foreach ($wp_styles->registered as $handle => $style) {
      if (isset($style->src)) {
        $src = $style->src;

        // Convert relative URLs to absolute
        if (strpos($src, "//") === false) {
          if (strpos($src, "/") === 0) {
            $src = site_url($src);
          } else {
            $src = site_url("/" . $src);
          }
        }

        // Capture style information
        $this->captured_styles[] = [
          "handle" => $handle,
          "src" => $src,
          "deps" => $style->deps,
          "ver" => $style->ver,
          "media" => $style->args,
        ];
      }
    }

    // Also capture inline styles
    foreach ($wp_styles->registered as $handle => $style) {
      if (!empty($wp_styles->get_data($handle, "after")) || !empty($wp_styles->get_data($handle, "before"))) {
        $this->captured_styles[] = [
          "handle" => $handle . "-inline",
          "inline" => true,
          "before" => $wp_styles->get_data($handle, "before"),
          "after" => $wp_styles->get_data($handle, "after"),
          "deps" => [$handle],
        ];
      }
    }
  }

  /**
   * Sets up the dashboard modifications
   */
  public function setup_dashboard()
  {
    if (!current_user_can("read")) {
      return;
    }

    self::$options = get_option("uixpress_settings", []);

    // Check if classic dashboard is enabled
    if (is_array(self::$options) && isset(self::$options["use_classic_dashboard"]) && self::$options["use_classic_dashboard"] === true) {
      //return;
    }

    // Remove all default dashboard actions and widgets
    $this->remove_default_dashboard();

    // Capture existing dashboard widgets before removing them
    add_action("wp_dashboard_setup", [$this, "capture_dashboard_widgets"], -99999);

    // Clear default dashboard after capture
    add_action("wp_dashboard_setup", [$this, "clear_default_dashboard"], 99999);

    // Remove welcome panel
    remove_action("welcome_panel", "wp_welcome_panel");

    // Override the default dashboard display
    // Clean cut-off after header but before content
    add_action(
      "in_admin_header",
      function () {
        remove_all_actions("admin_notices");
        remove_all_actions("all_admin_notices");
        echo '<div id="uix-dashboard-page"></div>';

        // Fire necessary footer actions and die
        do_action("admin_footer");
        do_action("admin_print_footer_scripts");
        do_action("in_admin_footer");
        die();
      },
      9999
    );
  }

  /**
   * Removes all default dashboard functionality
   */
  private function remove_default_dashboard()
  {
    remove_action("wp_dashboard_setup", "wp_dashboard_setup");
    remove_action("wp_dashboard_setup", "wp_dashboard_widgets");
    remove_action("wp_dashboard_setup", "wp_dashboard_widget_setup");
    remove_action("activity_box_end", "wp_dashboard_recent_drafts");
    remove_action("rightnow_end", "wp_dashboard_quick_press");
    remove_action("try_gutenberg_panel", "wp_try_gutenberg_panel");

    // Remove default screen options
    add_filter("screen_options_show_screen", "__return_false");

    // Remove help tabs
    add_action("admin_head", function () {
      $screen = get_current_screen();
      if ($screen && $screen->id === "dashboard") {
        $screen->remove_help_tabs();
      }
    });
  }

  /**
   * Captures all registered dashboard widgets and their content
   */
  public function capture_dashboard_widgets()
  {
    global $wp_meta_boxes;

    // Ensure we're working with dashboard widgets
    if (!isset($wp_meta_boxes["dashboard"])) {
      return;
    }

    $locations = ["normal", "side", "column3", "column4"];
    $priorities = ["high", "core", "default", "low"];

    foreach ($locations as $location) {
      foreach ($priorities as $priority) {
        if (isset($wp_meta_boxes["dashboard"][$location][$priority])) {
          foreach ($wp_meta_boxes["dashboard"][$location][$priority] as $widget) {
            if (!isset($widget["id"])) {
              continue;
            }

            $widget_id = $widget["id"];

            // Capture widget output
            ob_start();
            if (isset($widget["callback"]) && is_callable($widget["callback"])) {
              call_user_func($widget["callback"], "", $widget);
            }
            $widget_content = ob_get_clean();

            // Get widget settings if available
            $widget_settings = [];
            if (isset($widget["callback"][0]) && method_exists($widget["callback"][0], "get_settings")) {
              $widget_settings = $widget["callback"][0]->get_settings();
            }

            $this->captured_widgets[$widget_id] = [
              "id" => $widget_id,
              "title" => isset($widget["title"]) ? $widget["title"] : "",
              "location" => $location,
              "priority" => $priority,
              "content" => $widget_content,
              "settings" => $widget_settings,
              "callback" => isset($widget["callback"]) ? (is_array($widget["callback"]) ? get_class($widget["callback"][0]) : "function") : null,
            ];
          }
        }
      }
    }
  }

  /**
   * Clears the default dashboard widgets
   */
  public function clear_default_dashboard()
  {
    global $wp_meta_boxes;
    $wp_meta_boxes["dashboard"] = [];
  }

  /**
   * Loads required styles
   */
  public static function load_styles()
  {
    $url = plugins_url("uixpress/");
    $style = $url . "app/dist/assets/styles/dashboard.css";
    wp_enqueue_style("uixpress-dashboard", $style, [], uixpress_plugin_version);
  }

  /**
   * Loads required scripts and passes widget data
   */
  public function load_scripts()
  {
    $url = plugins_url("uixpress/");
    $script_name = Scripts::get_base_script_path("uixpressDashboard.js");

    // Add any additional dashboard data here
    $dashboard_data = [
      "widgets" => $this->captured_widgets,
      "styles" => $this->captured_styles,
      "user" => [
        "can_customize" => current_user_can("edit_dashboard"),
        "can_manage_options" => current_user_can("manage_options"),
      ],
    ];

    wp_print_script_tag([
      "id" => "uixp-dashboard-script",
      "src" => $url . "app/dist/{$script_name}",
      "dashboard-data" => esc_attr(json_encode($dashboard_data)),
      "type" => "module",
    ]);
  }
}
