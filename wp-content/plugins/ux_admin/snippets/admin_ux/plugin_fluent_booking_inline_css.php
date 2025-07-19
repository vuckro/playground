<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("page=fluent-booking") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='17' class='wpcb2-inline-style'>

        :root {
  /* Alignement Fluent Booking sur la teinte accent */
	--el-color-primary: rgb(var(--uix-accent-700, 76, 76, 76)) !important;
}


/* Display none */
.menu_logo_holder img[src*="fluent-booking/assets/images/logo.svg"],
#fluent-booking-app .fcal_welcom_banner .party_icon,
.fcal_title h3 {
  display: none;
}



/* ===== Colors ===== */

:where(.dark, .dark *) h2 .required,
.fcal_primary_btn:hover,
.el-button:hover,
.fcal_primary_btn2,
.fcal_settings_sidebar li a.router-link-exact-active,
.fframe_main-menu-items ul.fframe_menu li.active_item a {
	color: rgb(var(--uix-accent-100, 211, 211, 211))!important;
}


.el-checkbox.is-checked .el-checkbox__label,
.el-tabs__item.is-active,
.el-tabs__item:hover,
.fcal_spot_line .fcal_spot_source,
.fcal_radio_switch .is-active.is-active .el-radio-button__inner,
.fcal_profile_link a,
.el-form .el-form-item .el-switch.is-checked .el-switch__label.is-active,
.el-link{
	color: rgb(var(--uix-accent-600, 98,  98,  98))!important;
}



/* ===== Backgrounds ===== */

.fcal_primary_btn,
.fcal_primary_btn2,
.el-button--primary,
.fcal_welcom_banner,
.el-switch.is-checked .el-switch__core,
.fcal_radio_btn_group .el-radio-button.is-active .el-radio-button__inner,
.el-radio__inner:after,
.el-dialog__footer .dialog-footer .fcal_primary_btn,
.el-dialog.fcal_new_booking .el-dialog__footer .dialog-footer .fcal_primary_btn,
.el-checkbox .el-checkbox__input.is-checked .el-checkbox__inner,
.el-calendar-table tbody tr td.is-selected p,
.fcal_settings_sidebar li a.router-link-exact-active,
.fframe_main-menu-items ul.fframe_menu li.active_item a {
	background: rgb(var(--uix-accent-700, 76, 76, 76))!important;
}

.el-calendar-table tbody tr td.is-selected p{
	background: rgb(var(--uix-base-700, 76, 76, 76))!important;
}

.fcal_primary_btn:hover,
.el-button:hover{
	background: rgb(var(--uix-accent-700, 98,  98,  98))!important;
}


.el-tabs__item.is-active{
	background: rgb(var(--uix-accent-100, 222, 222, 222))!important;
}

#fluent-booking-app {
	background: rgb(var(--uix-base-50, 222, 222, 222));
}

:where(.dark, .dark *) #fluent-booking-app,
:where(.dark, .dark *) .fcal_cal_slot  {
	background: rgb(var(--uix-base-800, 222, 222, 222))!important;
}


.el-calendar-table td.is-selected,
.fcal_spot_line .fcal_spot_source,
.fcal_spot_line:hover,
.fcal_spot_line:before,
.fcal_radio_switch .is-active.is-active .el-radio-button__inner{
	background: rgb(var(--uix-accent-50, 222, 222, 222))!important;
}

.el-switch__core .el-switch__action {
	background: rgb(var(--uix-base-00, 255, 255, 255))!important;
}


.fcal_create_new_booking_type_drawer .el-button:hover,
.el-popper.fcal_select ul .el-dropdown-menu__item:hover,
.fcal_add_question:hover,
.el-dropdown-menu__item:not(.is-disabled):focus {
    background: transparent!important;
}

/* ===== Borders ===== */

.fcal_welcom_banner,
.el-switch.is-checked .el-switch__core,
.fcal_create_calendar_form .fcal_switch.is-checked .el-switch__core,
.fcal_create_new_booking_type_drawer .el-button:hover,
.fcal_radio_btn_group .el-radio-button.is-active .el-radio-button__inner,
.el-radio .el-radio__input.is-checked .el-radio__inner,
.el-input .el-input__wrapper.is-focus,
.el-checkbox .el-checkbox__input.is-checked .el-checkbox__inner,
.fcal_primary_btn2,
.fcal_spot_line,
.el-link__inner{
	border-color: rgb(var(--uix-accent-700, 98,  98,  98))!important;
}

.fcal_primary_btn,
.fcal_primary_btn2,
.el-button--primary,
.fcal_plain_btn,
.fframe_main-menu-items ul.fframe_menu li.active_item a{
	border-radius: 3em!important;
}

/* ===== OTHER ===== */


/* Menu de navigation */
.fframe_main-menu-items {
    display: flex;
    flex-direction: row;
    justify-content: start;
    margin-left: -30px;
}

@media screen and (max-width: 600px) {
    #wpbody {
        padding-top: 0px;
    }
}

.fcal_create_new_booking_type_drawer .el-button:hover {
	box-shadow: unset!important;
}

.fcal_settings_sidebar li a.router-link-exact-active svg path {
	stroke: #1b2533!important;
}

#fluent-booking-app {
	height: 100vh;
}


        </style>

    <?php
    }, 10);

