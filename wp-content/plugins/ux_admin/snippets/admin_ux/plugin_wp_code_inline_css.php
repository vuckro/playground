<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("page=wpcode") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='16' class='wpcb2-inline-style'>

        :root {
  --wpcode-color-primary: rgb(var(--uix-base-700)) !important;
  --wpcode-button-primary-bg: rgb(var(--uix-accent-700, 76, 76, 76)) !important;
  --wpcode-button-primary-bg-hover: rgb(var(--uix-accent-600, 53, 53, 53)) !important;
  --wpcode-button-primary-text-hover: rgb(var(--uix-accent-50, 255, 255, 255)) !important;
  --wpcode-text-color-heading: unset !important;
  --wpcode-text-color-highlight: unset !important;
  --wpcode-background-highlight: rgb(var(--uix-base-100)) !important;
}

/* ========== Masquer elements ========== */

/* Masque logo  */
.wpcode-header-left {
  display: none;
}

/* ========== Couleurs ========== */

.wpcode-checkbox-toggle input:checked+.wpcode-checkbox-toggle-slider {
  background-color: rgb(var(--uix-accent-700, 76, 76, 76)) !important;
}

a.wpcode-button,
.wpcode-button {
    background-color: rgb(var(--uix-accent-700, 76, 76, 76))!important;
    color: rgb(var(--uix-accent-50, 255, 255, 255))!important;
    border-radius: 3em;
}

/* ========== Bordures ========== */

.wpcode-admin-tabs li a:hover,
.wpcode-admin-tabs li a.active {
    border-color: rgb(var(--uix-accent-700, 76, 76, 76))!important;
}

/* ========== Display None ========== */

button#wpcode_save_to_cloud {
    display: none;
}

/* ========== Other ========== */

.wpcode-input-radio label:hover svg path,
.wpcode-input-radio input[type="radio"]:checked+label svg path {
    fill: initial;
;
}
        </style>

    <?php
    }, 10);

