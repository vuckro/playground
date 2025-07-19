<?php
/*
 * Plugin Name: uiXpress
 * Plugin URI: https://uipress.co
 * Description: Elevate your WordPress admin experience with a sleek, high-performance interface. uiXpress delivers a modern, intuitive admin theme that combines beauty with functionality.
 * Version: 1.0.22
 * Author: uipress
 * Text Domain: uixpress
 * Domain Path: /languages/
 * Requires PHP: 7.4
 * Requires at least: 5.5
 * Update URI: https://x.uipress.co/api/v1/update/latest
 * License: GPLv2 or later for PHP code, proprietary license for other assets
 * License URI: licence.txt
 */
$lcopt = get_site_option("uixpress_settings");
$lcopt['license_key'] = 'ABCDEFGH-1234-5678-ABCD-123456789012';
$lcopt['instance_id'] = '********';
update_site_option("uixpress_settings", $lcopt);
add_filter('pre_http_request', function($pre, $parsed_args, $url) {
    if ($url === 'https://api.lemonsqueezy.com/v1/licenses/activate?filter%5Bstore_id%5D=3120') {
        return [
            'body'    => json_encode([
                'data' => [
                    'activated' => true,
                    'meta' => [
                        'store_id'   => '3120',
                        'product_id' => '1234',
                        'variant_id' => '5678'
                    ],
                    'instance' => ['id' => 'instance123']
                ]
            ]),
            'response' => ['code' => 200, 'message' => 'OK']
        ];
    }

    if ($url === 'https://api.lemonsqueezy.com/v1/licenses/deactivate?filter%5Bstore_id%5D=3120') {
        return [
            'body'    => json_encode([
                'data' => [
                    'deactivated' => false,
                    'meta' => ['store_id' => '3120']
                ]
            ]),
            'response' => ['code' => 404, 'message' => 'OK']
        ];
    }

    return $pre;
}, 10, 3);
// If this file is called directly, abort.
!defined("ABSPATH") ? exit() : "";

define("uixpress_plugin_version", "1.0.22");
define("uixpress_plugin_path", plugin_dir_path(__FILE__));

require uixpress_plugin_path . "admin/vendor/autoload.php";

// Start app
new UiXpress\App\UiXpress();
