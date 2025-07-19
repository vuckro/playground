<?php
namespace UiXpress\Rest;

// Prevent direct access to this file
defined("ABSPATH") || exit();

/**
 * Class LemonRest
 *
 * Creates new rest api to handle LemonRest requests
 */
class LemonSqueezy
{
  /**
   * PostMetaQuery constructor.
   */
  public function __construct()
  {
    add_action("rest_api_init", ["UiXpress\Rest\LemonSqueezy", "register_custom_endpoint"]);
  }

  /**
   * Registers custom properties for all public post types.
   */
  public static function register_custom_endpoint()
  {
    register_rest_route("uixpress/v1", "/lemonsqueezy", [
      "methods" => ["GET", "POST"],
      "callback" => ["UiXpress\Rest\LemonSqueezy", "get_lemonrequest"],
      "permission_callback" => function () {
        return current_user_can("manage_options");
      },
    ]);
  }

  /**
   * Checks for meta query and pushes it to request
   *
   * @return Array
   * @since 3.2.13
   */
  public static function get_lemonrequest($request)
  {
    $data = self::do_lemonrequest($request);
    // Set the response headers
    $response = new \WP_REST_Response($data["data"]);
    $response->header("X-WP-Total", isset($data["total"]) ? $data["total"] : 0);
    $response->header("X-WP-TotalPages", isset($data["totalPages"]) ? $data["totalPages"] : 0);

    return $response;
  }

  /**
   * Checks for meta query and pushes it to request
   *
   * @return Array
   * @since 3.2.13
   */
  public static function do_lemonrequest($request)
  {
    // Get body params
    $requestData = $request->get_json_params();
    $lsendpoint = $request->get_param("ls_endpoint") ? sanitize_text_field($request->get_param("ls_endpoint")) : "";

    $baseUrl = "https://api.lemonsqueezy.com/v1/{$lsendpoint}";
    $queryParams = [];

    // Filter by uixpress store
    $queryParams["filter[store_id]"] = 3120;

    $queryString = http_build_query($queryParams);
    $url = $baseUrl . ($queryString ? "?" . $queryString : "");

    $headers = [
      "Content-Type" => "application/json",
    ];

    $args = [
      "method" => "POST",
      "headers" => $headers,
      "timeout" => 10,
    ];

    $args["body"] = json_encode($requestData);

    $response = wp_remote_get($url, $args);

    if (is_wp_error($response)) {
      $error_message = $response->get_error_message();
      return ["data" => ["error" => true, "title" => $error_message], "total" => 0, "totalPages" => 0];
    }

    $response_body = wp_remote_retrieve_body($response);
    $decoded = json_decode($response_body);

    if (!$decoded) {
      return ["data" => [], "total" => 0, "totalPages" => 0];
    }

    if (isset($decoded->errors) && is_array($decoded->errors)) {
      $message = $decoded->errors[0]->detail;
      return ["data" => ["error" => true, "title" => $message], "total" => 0, "totalPages" => 0];
    }

    $data = $decoded;
    return ["data" => $data];
  }
}
