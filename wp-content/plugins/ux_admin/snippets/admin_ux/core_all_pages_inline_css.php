<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( !$wpContext->current_url_contains("network") ) || ( !$wpContext->current_url_contains("post.php") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='45' class='wpcb2-inline-style'>

        :root{--wp-admin-theme-color:rgb(var(--uix-base-900,33,33,33));--wp-admin-theme-color--rgb:rgb(var(--uix-base-900,33,33,33));--wp-admin-theme-color-darker-10:rgb(var(--uix-base-800,66,66,66));--wp-admin-theme-color-darker-10--rgb:rgb(var(--uix-base-800,66,66,66));--wp-admin-theme-color-darker-20:rgb(var(--uix-base-700,103,103,103));--wp-admin-theme-color-darker-20--rgb:rgb(var(--uix-base-700,103,103,103))}:root{--wp-components-color-accent:rgb(var(--uix-accent-900,33,33,33));--wp-components-color-accent--rgb:rgb(var(--uix-base-900,33,33,33));--wp-components-color-accent-darker-10:rgb(var(--uix-accent-800,66,66,66));--wp-components-color-accent-darker-10--rgb:rgb(var(--uix-accent-800,66,66,66));--wp-components-color-accent-darker-20:rgb(var(--uix-base-700,103,103,103));--wp-components-color-accent-darker-20--rgb:rgb(var(--uix-base-700,103,103,103))}a{color:rgb(var(--uix-base-800,66,66,66))}h1.wp-heading-inline,div#contextual-help-link-wrap{display:none!important}.wp-menu-name,a.ab-item,.wp-core-ui .button-primary,.wp-submenu li.current a,.wrap .wp-heading-inline+.page-title-action{color:rgb(var(--uix-base-200,236,236,236))!important}.wp-has-current-submenu ul>li>a,.wp-not-current-submenu li>a,#adminmenu li a:focus div.wp-menu-image:before,#adminmenu li.opensub div.wp-menu-image:before,#adminmenu li:hover div.wp-menu-image:before{color:rgb(var(--uix-base-400,205,205,205))!important}.wp-core-ui .button-links{color:rgb(var(--uix-accent-800,66,66,66))!important}.row-actions span.delete a{color:#be2d2d!important}li.wp-has-current-submenu a.wp-has-current-submenu{background:rgb(var(--uix-base-700,103,103,103))!important}input[type=radio]:checked::before,.wp-core-ui .button-primary,.wrap .wp-heading-inline+.page-title-action{background-color:rgb(var(--uix-accent-700,103,103,103))!important}.wp-core-ui .button-secondary{background:rgb(var(--uix-accent-0,255,255,255))}input[type=text]:focus{border-color:rgb(var(--uix-base-200,236,236,236))!important}.wp-core-ui .button,.wp-core-ui .button-primary,.wp-core-ui .button-secondary,.wrap .wp-heading-inline+.page-title-action,button.button.media-button.select-mode-toggle-button,.media-frame.mode-grid .media-toolbar select,.wp-core-ui select,input[type=email],input[type=password],input[type=search],input[type=tel],input[type=text],input[type=url]{border-radius:3em!important}input[type=text]:focus{box-shadow:unset}
        </style>

    <?php
    }, 10);

