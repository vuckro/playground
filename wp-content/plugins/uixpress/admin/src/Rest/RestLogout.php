<?php
namespace UiXpress\Rest;

// Prevent direct access to this file
defined("ABSPATH") || exit();

/**
 * Class RestLogout
 *
 * Registers global options
 */
class RestLogout
{
  /**
   * GlobalOptions constructor.
   */
  public function __construct()
  {
    add_action("rest_api_init", function () {
      register_rest_route("wc/v3", "/logout", [
        "methods" => "POST",
        "callback" => ["UiXpress\Rest\RestLogout", "custom_logout_callback"],
        "permission_callback" => function () {
          return is_user_logged_in();
        },
      ]);
    });
  }

  public static function custom_logout_callback($request)
  {
    wp_logout();
    wp_clear_auth_cookie();
    return new \WP_REST_Response(["success" => true, "message" => "Logged out successfully"], 200);
  }
}
