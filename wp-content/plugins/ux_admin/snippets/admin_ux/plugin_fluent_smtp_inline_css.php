<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("page=fluent-mail") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='18' class='wpcb2-inline-style'>

        .logo,#wpbody-content>div.fluent-mail-app>div.fluent-mail-main-menu-items>ul>li:nth-child(6){display:none}#wpbody-content>div.fluent-mail-app>div.fluent-mail-body>div>div>div.el-col.el-col-24.el-col-sm-24.el-col-md-14>div>div.fss_header>span:nth-child(2),.el-checkbox__label,.el-radio__input.is-checked+.el-radio__label,.el-switch__label.is-active,.el-picker-panel__shortcut:hover,.el-date-table td.available:hover,.el-date-table td.today span,.log-viewer .success,.el-button:hover,.el-menu--horizontal .el-menu-item:not(.is-disabled):hover,.el-menu--horizontal>.el-menu-item.is-active{color:rgb(var(--uix-accent-700,98,98,98))!important}.wp-core-ui h1:where(.dark,.dark *),.wp-core-ui h2:where(.dark,.dark *),.wp-core-ui h3:where(.dark,.dark *),.wp-core-ui h4:where(.dark,.dark *),.wp-core-ui h5:where(.dark,.dark *),.wp-core-ui h6:where(.dark,.dark *),.el-radio-button__inner:hover{color:rgb(var(--uix-base-700,98,98,98))}:where(.dark,.dark *) .el-button:hover,.el-button--primary.is-plain,.el-date-table td.today.end-date span,.el-date-table td.today.start-date span{color:rgb(var(--uix-base-100,222,222,222))!important}.fluent-mail-app .fluent-mail-navigation.el-menu--horizontal.el-menu .el-menu-item.is-active,.el-button:hover,:where(.dark,.dark *) .fss_connection_wizard .fss_connections .el-radio-button__inner,:where(.dark,.dark *) .fsmtp_conncection_selected{background:rgb(var(--uix-base-0,255,255,255))!important}.el-button--primary,.el-button--success,.el-checkbox__input.is-checked .el-checkbox__inner,.el-radio-button__orig-radio:checked+.el-radio-button__inner,.el-radio__input.is-checked .el-radio__inner,.el-switch.is-checked .el-switch__core,.el-date-table td.end-date span,.el-date-table td.start-date span{background:rgb(var(--uix-accent-700,98,98,98))!important}:where(.dark,.dark *) .el-table--enable-row-hover .el-table__body tr:hover>td.el-table__cell{background:rgb(var(--uix-base-800,76,76,76))!important}:where(.dark,.dark *) .fluent-mail-app .fluent-mail-navigation.el-menu--horizontal.el-menu .el-menu-item.is-active,:where(.dark,.dark *) .el-button:hover,:where(.dark,.dark *) .el-menu--horizontal>.el-menu-item:not(.is-disabled):hover,.el-table--border:after,.el-table--group:after,.el-table:before{background:transparent!important}.el-menu--horizontal>.el-menu-item.is-active{border-bottom:2px solid rgb(var(--uix-accent-700,98,98,98))!important}.el-button--success,.el-button--primary,.el-checkbox__input.is-checked .el-checkbox__inner,.el-radio-button__orig-radio:checked+.el-radio-button__inner,.el-radio__input.is-checked .el-radio__inner,.el-switch.is-checked .el-switch__core,.el-range-editor.is-active,.el-button:hover{border-color:rgb(var(--uix-accent-700,98,98,98))!important}.el-button{border-radius:3em}.fsmtp_conncection_selected{border:3px solid rgb(var(--uix-accent-700,98,98,98))}path{fill:rgb(var(--uix-accent-700,98,98,98))}
        </style>

    <?php
    }, 10);

