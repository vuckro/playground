<?php if(!defined('ABSPATH')) { die(); }  


add_action('plugins_loaded', function() {

                

	// Code Snippet Code
    
defined('ABSPATH') || exit;

// Supprime tous les widgets du dashboard
add_action('wp_dashboard_setup', function () {
    global $wp_meta_boxes;
    $wp_meta_boxes['dashboard'] = [];
}, 999);

// Injecte l'iFrame en pleine page
add_action('admin_head-index.php', function () {
    ?>
    <style>
        #wpbody-content { padding: 0 !important; }
        #wpcontent { padding-left: 0; }
        #wpbody-content .wrap { margin: 0; max-width: 100%; }
        #screen-meta-links { display: none !important; }
        #wpfooter { display: none !important; }

        @media (max-width: 960px) {
            .auto-fold #wpcontent { margin-left: 0; padding-left: 0px; }
        }
        @media (max-width: 600px) {
            #wpbody { padding-top: 0; }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('#wpbody-content .wrap') || document.body;
            container.innerHTML = '<iframe src="https://app.waaskit.com/iframe-wp-admin/" style="width:100%;height:calc(100vh - 32px);border:0"></iframe>';
        });
    </script>
    <?php
}, 20);



    // End Code Snippet Code

}, 10);