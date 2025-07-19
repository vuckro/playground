<?php
namespace UiXpress\Options;
use UiXpress\Options\TextReplacement;
use UiXpress\Options\AdminFavicon;
use UiXpress\Options\LoginOptions;

// Prevent direct access to this file
defined("ABSPATH") || exit();

/**
 * Class GlobalOptions
 *
 * Registers global options
 */
class GlobalOptions
{
  /**
   * GlobalOptions constructor.
   */
  public function __construct()
  {
    add_action("admin_init", ["UiXpress\Options\GlobalOptions", "create_global_option"]);
    add_action("rest_api_init", ["UiXpress\Options\GlobalOptions", "create_global_option"]);

    new TextReplacement();
    new AdminFavicon();
    new LoginOptions();
  }

  /**
   * Creates global option
   *
   * @return Array
   * @since 3.2.13
   */
  public static function create_global_option()
  {
    $args = [
      "type" => "object",
      "sanitize_callback" => ["UiXpress\Options\GlobalOptions", "sanitize_global_settings"],
      "default" => [],
      "capability" => "manage_options",
      "show_in_rest" => [
        "schema" => [
          "type" => "object",
          "properties" => [
            "license_key" => [
              "type" => "string",
            ],
            "instance_id" => [
              "type" => "string",
            ],
            "plugin_name" => [
              "type" => "string",
            ],
            "logo" => [
              "type" => "string",
            ],
            "dark_logo" => [
              "type" => "string",
            ],
            "auto_dark" => [
              "type" => "boolean",
            ],
            "hide_screenoptions" => [
              "type" => "boolean",
            ],
            "hide_help_toggle" => [
              "type" => "boolean",
            ],
            "style_login" => [
              "type" => "boolean",
            ],
            "login_image" => [
              "type" => "string",
            ],
            "disable_theme" => [
              "type" => "array",
              "default" => [],
            ],
            "search_post_types" => [
              "type" => "array",
              "default" => [],
            ],
            "disable_search" => [
              "type" => "boolean",
              "default" => false,
            ],
            "base_theme_color" => [
              "type" => "string",
              "default" => "",
            ],
            "base_theme_scale" => [
              "type" => "array",
              "default" => [],
            ],
            "accent_theme_color" => [
              "type" => "string",
              "default" => "",
            ],
            "accent_theme_scale" => [
              "type" => "array",
              "default" => [],
            ],
            "custom_css" => [
              "type" => "text",
              "default" => "",
            ],
            "login_path" => [
              "type" => "text",
              "default" => "",
            ],
            "text_replacements" => [
              "type" => "text",
              "default" => [],
            ],
            "enable_turnstyle" => [
              "type" => "boolean",
              "default" => false,
            ],
            "turnstyle_site_key" => [
              "type" => "string",
              "default" => "",
            ],
            "turnstyle_secret_key" => [
              "type" => "string",
              "default" => "",
            ],
            "layout" => [
              "type" => "string",
              "default" => "",
            ],
            "admin_favicon" => [
              "type" => "string",
            ],
            "external_stylesheets" => [
              "type" => "array",
              "default" => [],
            ],
            "force_global_theme" => [
              "type" => "string",
              "default" => "off",
            ],
            "submenu_style" => [
              "type" => "string",
              "default" => "click",
            ],
            "hide_language_selector" => [
              "type" => "boolean",
              "default" => false,
            ],
            "use_classic_post_tables" => [
              "type" => "boolean",
              "default" => false,
            ],
            "use_modern_plugin_page" => [
              "type" => "boolean",
              "default" => false,
            ],
          ],
        ],
      ],
    ];
    register_setting("uixpress", "uixpress_settings", $args);
  }

  public static function sanitize_global_settings($value)
  {
    $sanitized_value = [];
    $options = get_option("uixpress_settings", false);
    $options = !$options ? [] : $options;

    if (isset($value["license_key"])) {
      $sanitized_value["license_key"] = sanitize_text_field($value["license_key"]);
    }

    if (isset($value["instance_id"])) {
      $sanitized_value["instance_id"] = sanitize_text_field($value["instance_id"]);
    }

    if (isset($value["plugin_name"])) {
      $sanitized_value["plugin_name"] = sanitize_text_field($value["plugin_name"]);
    }

    if (isset($value["logo"])) {
      $sanitized_value["logo"] = sanitize_text_field($value["logo"]);
    }

    if (isset($value["dark_logo"])) {
      $sanitized_value["dark_logo"] = sanitize_text_field($value["dark_logo"]);
    }

    if (isset($value["login_image"])) {
      $sanitized_value["login_image"] = sanitize_text_field($value["login_image"]);
    }

    if (isset($value["base_theme_color"])) {
      $sanitized_value["base_theme_color"] = sanitize_text_field($value["base_theme_color"]);
    }

    if (isset($value["accent_theme_color"])) {
      $sanitized_value["accent_theme_color"] = sanitize_text_field($value["accent_theme_color"]);
    }

    if (isset($value["login_path"])) {
      $sanitized_value["login_path"] = sanitize_text_field($value["login_path"]);
    }

    if (isset($value["layout"])) {
      $sanitized_value["layout"] = sanitize_text_field($value["layout"]);
    }

    if (isset($value["submenu_style"])) {
      $sanitized_value["submenu_style"] = sanitize_text_field($value["submenu_style"]);
    }

    if (isset($value["auto_dark"])) {
      $sanitized_value["auto_dark"] = (bool) $value["auto_dark"];
    }

    if (isset($value["use_classic_post_tables"])) {
      $sanitized_value["use_classic_post_tables"] = (bool) $value["use_classic_post_tables"];
    }

    if (isset($value["use_modern_plugin_page"])) {
      $sanitized_value["use_modern_plugin_page"] = (bool) $value["use_modern_plugin_page"];
    }

    if (isset($value["hide_language_selector"])) {
      $sanitized_value["hide_language_selector"] = (bool) $value["hide_language_selector"];
    }

    if (isset($value["disable_search"])) {
      $sanitized_value["disable_search"] = (bool) $value["disable_search"];
    }

    if (isset($value["hide_screenoptions"])) {
      $sanitized_value["hide_screenoptions"] = (bool) $value["hide_screenoptions"];
    }

    if (isset($value["hide_help_toggle"])) {
      $sanitized_value["hide_help_toggle"] = (bool) $value["hide_help_toggle"];
    }

    if (isset($value["style_login"])) {
      $sanitized_value["style_login"] = (bool) $value["style_login"];
    }

    if (isset($value["enable_turnstyle"])) {
      $sanitized_value["enable_turnstyle"] = (bool) $value["enable_turnstyle"];
    }

    if (isset($value["turnstyle_site_key"])) {
      $sanitized_value["turnstyle_site_key"] = sanitize_text_field($value["turnstyle_site_key"]);
    }

    if (isset($value["turnstyle_secret_key"])) {
      $sanitized_value["turnstyle_secret_key"] = sanitize_text_field($value["turnstyle_secret_key"]);
    }

    if (isset($value["admin_favicon"])) {
      $sanitized_value["admin_favicon"] = sanitize_text_field($value["admin_favicon"]);
    }

    if (isset($value["disable_theme"]) && is_array($value["disable_theme"])) {
      $formattedMenuLinks = [];
      foreach ($value["disable_theme"] as $link) {
        if (is_array($link)) {
          $sanitized_link = [
            "id" => isset($link["id"]) ? (int) sanitize_text_field($link["id"]) : "",
            "value" => isset($link["value"]) ? sanitize_text_field($link["value"]) : "",
            "type" => isset($link["type"]) ? sanitize_text_field($link["type"]) : "",
          ];
          $formattedMenuLinks[] = $sanitized_link;
        }
      }
      $sanitized_value["disable_theme"] = $formattedMenuLinks;
    }

    if (isset($value["search_post_types"]) && is_array($value["search_post_types"])) {
      $formattedMenuLinks = [];
      foreach ($value["search_post_types"] as $postType) {
        if (is_array($postType)) {
          $sanitized_link = [
            "slug" => isset($postType["slug"]) ? sanitize_text_field($postType["slug"]) : "",
            "name" => isset($postType["name"]) ? sanitize_text_field($postType["name"]) : "",
            "rest_base" => isset($postType["rest_base"]) ? sanitize_text_field($postType["rest_base"]) : "",
          ];
          $formattedMenuLinks[] = $sanitized_link;
        }
      }
      $sanitized_value["search_post_types"] = $formattedMenuLinks;
    }

    if (isset($value["base_theme_scale"]) && is_array($value["base_theme_scale"])) {
      $formattedScale = [];
      foreach ($value["base_theme_scale"] as $color) {
        if (is_array($color)) {
          $sanitized_color = [
            "step" => isset($color["step"]) ? sanitize_text_field($color["step"]) : "",
            "color" => isset($color["color"]) ? sanitize_text_field($color["color"]) : "",
          ];
          $formattedScale[] = $sanitized_color;
        }
      }
      $sanitized_value["base_theme_scale"] = $formattedScale;
    }

    if (isset($value["accent_theme_scale"]) && is_array($value["accent_theme_scale"])) {
      $formattedScale = [];
      foreach ($value["accent_theme_scale"] as $color) {
        if (is_array($color)) {
          $sanitized_color = [
            "step" => isset($color["step"]) ? sanitize_text_field($color["step"]) : "",
            "color" => isset($color["color"]) ? sanitize_text_field($color["color"]) : "",
          ];
          $formattedScale[] = $sanitized_color;
        }
      }
      $sanitized_value["accent_theme_scale"] = $formattedScale;
    }

    if (isset($value["text_replacements"]) && is_array($value["text_replacements"])) {
      $cleanedPairs = [];
      foreach ($value["text_replacements"] as $pair) {
        if (is_array($pair)) {
          $find = isset($pair[0]) && $pair[0] != "" ? sanitize_text_field($pair[0]) : false;
          $replace = isset($pair[1]) && $pair[1] != "" ? sanitize_text_field($pair[1]) : false;

          if ($find && $replace) {
            $cleanedPairs[] = [$find, $replace];
          }
        }
      }
      $sanitized_value["text_replacements"] = $cleanedPairs;
    }

    if (isset($value["custom_css"])) {
      $sanitized_value["custom_css"] = wp_filter_nohtml_kses($value["custom_css"]);
    }

    if (isset($value["force_global_theme"])) {
      $sanitized_value["force_global_theme"] = sanitize_text_field($value["force_global_theme"]);
    }

    if (isset($value["external_stylesheets"]) && is_array($value["external_stylesheets"])) {
      $formattedSheets = [];
      foreach ($value["external_stylesheets"] as $link) {
        $formattedSheets[] = sanitize_url($link);
      }
      $sanitized_value["external_stylesheets"] = $formattedSheets;
    }

    return array_merge($options, $sanitized_value);
  }
}
