<?php
namespace UiXpress\Options;

// Prevent direct access to this file
defined("ABSPATH") || exit();

/**
 * Class LoginOptions
 *
 * Handles text replacement functionality in the WordPress admin area.
 *
 * @package UiXpress\Options
 */
class LoginOptions
{
  /**
   * Stores the global options.
   *
   * @var array|null
   */
  private static $options = null;

  /**
   * TextReplacement constructor.
   *
   * Initializes the class and adds filters for text replacement.
   */
  public function __construct()
  {
    add_filter("login_display_language_dropdown", [$this, "maybe_remove_language_switcher"], 20);
  }

  /**
   * Retrieves the global options.
   *
   * Fetches the UiXpress settings from the site options.
   */
  private static function get_options()
  {
    self::$options = get_option("uixpress_settings", []);
  }

  /**
   * Retrieves and processes the text replacement pairs.
   *
   * @return array|false The processed text replacement pairs, or false if no valid pairs are found.
   */
  public static function maybe_remove_language_switcher()
  {
    if (is_null(self::$options)) {
      self::get_options();
    }

    if (is_array(self::$options) && isset(self::$options["hide_language_selector"]) && self::$options["hide_language_selector"] === true) {
      return false;
    }

    return true;
  }
}
