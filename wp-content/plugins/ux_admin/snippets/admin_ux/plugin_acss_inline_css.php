<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("admin.php?page=automatic-css") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='9' class='wpcb2-inline-style'>

        #wpbody-content>div.wrap.acss-wrapper>h1,#wpbody-content>div.wrap.acss-wrapper>nav{display:none}.toplevel_page_automatic-css #wpbody-content{background-color:rgb(var(--uix-base-0,247,247,247))}.dark\:important\:bg-zinc-900:where(.dark,.dark *){background-color:rgb(var(--uix-base-800,66,66,66))!important}
        </style>

    <?php
    }, 10);

