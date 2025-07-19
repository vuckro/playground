<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("page=slim-seo") ) || ( $wpContext->current_url_contains("post.php") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='5' class='wpcb2-inline-style'>

        :root{--ss-color-primary:#171717!important}h1.ss-title,aside.ss-sidebar{display:none!important}.ss-toggle input:checked+.ss-toggle__switch{background:rgb(var(--uix-accent-700,98,98,98))!important}:where(.dark,.dark *) .ss-toggle__switch{background:rgb(var(--uix-base-700,98,98,98))!important}.ss-tab.ss-is-active{box-shadow:inset 0 0 0 1.5px rgba(0,0,0,0),inset 0 -3.5px 0 0 rgb(var(--uix-accent-700,98,98,98))}:where(.dark,.dark *) .react-tabs__tab:hover{color:unset}
        </style>

    <?php
    }, 10);

