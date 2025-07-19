<?php if(!defined('ABSPATH')) { die(); }  


add_action('plugins_loaded', function() {

                

	// Code Snippet Code
     
/**
 * Masquer le menu "Paiement" de Woocommerce,
 * y compris le Tableau de bord.
 */
function uixpress_remove_admin_menu_items() {

    // Articles
    remove_menu_page( 'admin.php?page=wc-settings&tab=checkout&from=PAYMENTS_MENU_ITEM' );
}
add_action( 'admin_menu', 'uixpress_remove_admin_menu_items', 999 );

    // End Code Snippet Code

}, 10);