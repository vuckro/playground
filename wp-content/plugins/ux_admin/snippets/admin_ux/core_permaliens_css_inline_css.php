<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("options-permalink.php") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='54' class='wpcb2-inline-style'>

        .profile-tab__list{display:flex}.profile-tab__list{border-radius:.5rem}.profile-tab__list{background:rgb(var(--uix-base-0,255,255,255))}:where(.dark,.dark *) .profile-tab__list{background:rgb(var(--uix-base-900))}@media screen and (max-width:767px){.profile-tab__list{flex-direction:column}}.profile-tab__tab{background:none;border:0;padding:.7em 1.2em;font:inherit;cursor:pointer;border-bottom:2px solid transparent;color:rgb(var(--uix-base-800,33,33,33));transition:border .2s,color .2s;outline:0}:where(.dark,.dark *) .profile-tab__tab{color:rgb(var(--uix-base-0,255,255,255))}.profile-tab__tab[aria-selected=true]{border-bottom:2px solid rgb(var(--uix-base-800,33,33,33));color:rgb(var(--uix-base-800,33,33,33));background:rgb(var(--uix-base-100,236,236,236))}:where(.dark,.dark *) .profile-tab__tab[aria-selected=true]{border-bottom:2px solid rgb(var(--uix-base-0,255,255,255));;color:rgb(var(--uix-base-0,255,255,255));background:rgb(var(--uix-base-700,33,33,33))}.profile-tab__tab[aria-selected=true]{border-radius:.25rem .25rem 0 0}.profile-tab__panel{padding:1.5em 0 0 0}@media (max-width:600px){.profile-tab__tab{padding:.7em .7em;font-size:.95em}}
        </style>

    <?php
    }, 10);

