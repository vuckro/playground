<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("page=bwf") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='7' class='wpcb2-inline-style'>

        a.bwf-breadcrumb-svg-icon{display:none!important}#wffn-contacts .wffn-funnel-common{background-color:unset!important}.components-button.is-primary,.components-radio-control__input[type=radio]:checked::before{background-color:rgb(var(--uix-base-800))!important}.bwf-widgets-activity.dark\:important\:text-zinc-300.dark\:important\:bg-zinc-900.dark\:important\:border-zinc-700.dark-mode-processed{background-color:rgb(var(--uix-base-900))!important}#wpbody-content{background-color:unset!important}.bwf-dashboard-wrap .bwf-widgets-wrap .bwf-widgets-activity{background-color:rgb(var(--uix-base-0))!important}:root{--wffn-primary:unset!important;--wffn-primary-alter:unset!important}a,a:hover,a.bwfan_navigation_active,.components-button.is-secondary,:where(.dark,.dark *).wffn-funnel-common>.bwfan_page_header{color:unset!important}.bwf-nav-indicator,.components-button.is-secondary{border-color:unset!important}.components-radio-control__input[type=radio]:checked{border-color:rgb(var(--uix-base-800))!important}:where(.dark,.dark *) .components-radio-control__input[type=radio]:checked{border-color:rgb(var(--uix-base-300))!important}.wffn-funnel-common>.bwfan_page_header{margin:-34px -24px 24px!important;padding:0 24px 16px!important;position:static!important}
        </style>

    <?php
    }, 10);

