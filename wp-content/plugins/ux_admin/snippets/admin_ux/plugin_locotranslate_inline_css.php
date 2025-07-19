<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("page=loco") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='10' class='wpcb2-inline-style'>

        /* ========== Couleurs ========== */

#loco-admin.wrap .notice-info,
#loco-admin.wrap .panel-info {
  border-color: rgb(var(--uix-base-500));
}

/* ========== Radius ========== */

#loco-admin.wrap .notice-info,
#loco-admin.wrap .panel-info {
  border-radius: 5px;
}
        </style>

    <?php
    }, 10);

