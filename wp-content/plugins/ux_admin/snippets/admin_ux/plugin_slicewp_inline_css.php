<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("page=slicewp") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='6' class='wpcb2-inline-style'>

        /* ========== Msquer elements ========== */
.wp-core-ui .notice.notice-info,
#slicewp-header,
#need_help {
  display: none;
}
        </style>

    <?php
    }, 10);

