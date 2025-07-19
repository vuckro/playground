<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("network") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='19' class='wpcb2-inline-style'>

        /* Couleur Texte Widget Tableau de Bord */

.wu-styling :is(.wu-bg-gray-100) {
  --tw-bg-opacity: 1;
  background-color: unset;
}

.wu-styling :is(.wu-text-gray-600) {
  color: unset;
}

.wu-styling :is(.wu-text-gray-800) {
  color: unset;
}

.wu-styling :is(.wu-border-solid) {
  border-style: unset;
}

/* Responsive barre de recherche sites */

.wu-styling .wp-filter.wu-filter .search-form {
  height: 50px;
}

@media only screen and (max-width: 1000px) {
  .wp-filter .search-form {
    margin: 0px 0;
    height: 32px;
  }
}
        </style>

    <?php
    }, 10);

