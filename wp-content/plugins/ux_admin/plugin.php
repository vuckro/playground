<?php
/**
 * Plugin Name:     UX Admin
 * Description:     Modernise l’admin WordPress : interface claire, sans pubs ni distractions. Les plugins tiers s'adaptent à votre design. Activez UiXPress pour une expérience optimale.
 * Author:          WaasKit
 * Version:         beta
 *
 */

if (!defined('ABSPATH')) {
	die;
}

include_once __DIR__ . '/WFPCore/WordPressContext.php';


include_once 'snippets/admin_ux/core_all_pages_inline_css.php';
include_once 'snippets/admin_ux/core_gutenberg_inline_css.php';
include_once 'snippets/admin_ux/core_compte_js_inline_js.php';
include_once 'snippets/admin_ux/core_compte_css_inline_css.php';
include_once 'snippets/admin_ux/core_permaliens_js_inline_js.php';
include_once 'snippets/admin_ux/core_lecture_inline_css.php';
include_once 'snippets/admin_ux/core_permaliens_css_inline_css.php';
include_once 'snippets/admin_ux/plugin_acss_inline_css.php';
include_once 'snippets/admin_ux/plugin_bricks_builder_editeur_inline_css.php';
include_once 'snippets/admin_ux/plugin_funnelkit_builder_inline_css.php';
include_once 'snippets/admin_ux/plugin_funnelkit_automations_inline_css.php';
include_once 'snippets/admin_ux/plugin_fluent_booking_inline_css.php';
include_once 'snippets/admin_ux/plugin_fluent_smtp_inline_css.php';
include_once 'snippets/admin_ux/plugin_fluent_forms_inline_css.php';
include_once 'snippets/admin_ux/plugin_flyingpress_inline_css.php';
include_once 'snippets/admin_ux/plugin_happy_files_inline_css.php';
include_once 'snippets/admin_ux/plugin_locotranslate_inline_css.php';
include_once 'snippets/admin_ux/plugin_rankmath_inline_css.php';
include_once 'snippets/admin_ux/plugin_slim_seo_inline_css.php';
include_once 'snippets/admin_ux/plugin_slicewp_inline_css.php';
include_once 'snippets/admin_ux/plugin_wp_code_inline_css.php';
include_once 'snippets/admin_ux/plugin_woocommerce_css_inline_css.php';
include_once 'snippets/admin_ux/plugin_woocommerce.php';
include_once 'snippets/admin_ux/plugin_wp_ultimo_inline_css.php';
include_once 'snippets/admin_ux/wu_tableau_de_bord_iframe.php';
include_once 'snippets/admin_ux/plugins_uixpress_x_acss_darkmode_synch_inline_js.php';
// Snippets will go before this line, do not edit
