<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("options-reading.php") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='56' class='wpcb2-inline-style'>

        #wpbody-content>div.wrap>form>table>tbody>tr:nth-child(2),#wpbody-content>div.wrap>form>table>tbody>tr:nth-child(3){display:none}
        </style>

    <?php
    }, 10);

