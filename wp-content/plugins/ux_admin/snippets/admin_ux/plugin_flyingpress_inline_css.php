<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("?page=flying-press") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='57' class='wpcb2-inline-style'>

        header .flex.items-center.space-x-4{display:none!important}.bg-white.rounded-xl:has(svg.tabler-icon-key.text-red-600){display:none!important}.bg-white.rounded-xl:has(a[href*="flyingcdn.com"]){display:none!important}div:has(>h4.text-gray-600){display:none!important}.bg-indigo-600,.peer:checked~.peer-checked\:bg-indigo-600{background-color:rgb(var(--uix-accent-600,103,103,103))!important}.bg-indigo-50{background-color:rgb(var(--uix-accent-100,247,247,247))}.text-indigo-600,.hover\:text-indigo-600:hover{color:rgb(var(--uix-accent-700,103,103,103))}.ring-indigo-600,.peer:checked~.peer-checked\:ring-indigo-600{--tw-ring-color:rgb(var(--uix-accent-700,103,103,103))}
        </style>

    <?php
    }, 10);

