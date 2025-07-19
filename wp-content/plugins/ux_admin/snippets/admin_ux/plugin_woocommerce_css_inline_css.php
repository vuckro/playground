<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("page=wc-orders") ) || ( $wpContext->current_url_contains("plugin-install.php") ) || ( $wpContext->current_url_contains("edit.php") ) || ( $wpContext->current_url_contains("post.php") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='8' class='wpcb2-inline-style'>

        /* ========== Masquage d’éléments inutiles ========== */
aside#woocommerce-activity-panel,
.plugins-popular-tags-wrapper,
.wp-core-ui .woocommerce-layout__header,
a.button-secondary.screen-reader-text.skiplink {
  display: none !important;
}

/* ========== Réglages structurels ========== */
#wpbody {
  margin-top: 0;
}

/* ========== Dark Mode WooCommerce (interface admin) ========== */

:where(.dark, .dark *) .wp-tab-active,
:where(.dark, .dark *) ul.add-menu-item-tabs li.tabs,
:where(.dark, .dark *) ul.category-tabs li.tabs,
:where(.dark, .dark *) .categorydiv div.tabs-panel {
  background-color: rgb(var(--uix-base-800)) !important;
  border: none !important;
  border-bottom-color: transparent !important;
}

:where(.dark, .dark *) #woocommerce-product-data ul.wc-tabs {
  padding: 0;
  border-right: 1px solid rgb(var(--uix-base-700)) !important;
  background-color: rgb(var(--uix-base-900)) !important;
}

:where(.dark, .dark *) .wc-metaboxes-wrapper .wc-metabox {
  background-color: rgb(var(--uix-base-900)) !important;
}

:where(.dark, .dark *) #woocommerce-product-data ul.wc-tabs li.active a,
:where(.dark, .dark *) .wc-metaboxes-wrapper .wc-metabox table,
:where(.dark, .dark *) .mce-toolbar .mce-btn-group .mce-btn.mce-listbox {
  background-color: rgb(var(--uix-base-800)) !important;
}

:where(.dark, .dark *) .wc-metaboxes-wrapper .wc-metaboxes,
:where(.dark, .dark *) #woocommerce-product-data ul.wc-tabs li a {
  border-bottom: 1px solid rgb(var(--uix-base-700)) !important;
}

:where(.dark, .dark *) .notice {
  background-color: #c2410c !important;
}

:where(.dark, .dark *) #post-status-info {
  border: none !important;
  background-color: transparent !important;
  box-shadow: none !important;
  padding-top: 1em;
}

:where(.dark, .dark *) .mce-toolbar .mce-btn-group .mce-btn.mce-listbox,
:where(.dark, .dark *) .select2-container--default .select2-selection--single,
:where(.dark, .dark *) .woocommerce_options_panel .options_group {
  border: none !important;
}

:where(.dark, .dark *) .woocommerce_options_panel .options_group {
  border-bottom: none !important;
}

:where(.dark, .dark *) .mce-container,
:where(.dark, .dark *) #woocommerce-product-data .panel-wrap {
  background: rgb(var(--uix-base-800)) !important;
}
        </style>

    <?php
    }, 10);

