<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("edit.php") ) || ( $wpContext->current_url_contains("upload.php") ) || ( $wpContext->current_url_contains("edit-tags.php") ) || ( $wpContext->current_url_contains("post.php") ) || ( $wpContext->current_url_contains("?page=happyfiles_settings") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='11' class='wpcb2-inline-style'>

        /* ========== Background ========== */

#happyfiles-search-folders {
  background-color: unset !important;
}

#happyfiles-delete-confirmation .actions button {
  background-color: rgb(var(--uix-base-50, 255, 255, 255)) !important;
}

#happyfiles-sidebar .folder.open{
  background-color: rgb(var(--uix-base-100, 255, 255, 255)) !important;
}

:where(.dark, .dark *) #happyfiles-sidebar .folder:hover,
#happyfiles-sidebar .folder:hover{
  background-color: rgb(var(--uix-base-100, 236, 236, 236)) !important;
}

#happyfiles-sidebar .folder:hover .count,
#happyfiles-sidebar .folder.context .count,
#happyfiles-sidebar .folder.open .count {
  background-color: rgb(var(--uix-base-400, 205, 205, 205)) !important;
}

:where(.dark, .dark *) .happyfiles-notification {
  background-color: rgb(var(--uix-base-500, 180, 180, 180)) !important;
}

#happyfiles-sidebar .icon:hover,
.happyfiles-notification,
:where(.dark, .dark *) #happyfiles-sidebar .folder.open .count,
#happyfiles-sidebar .folder:hover .count,
#happyfiles-sidebar .folder.open .count{
  background-color: rgb(var(--uix-accent-600, 121, 121, 121)) !important;
}

#happyfiles-resizer i,
.happyfiles-popup header,
#happyfiles-resizer i:hover{
  background-color: rgb(var(--uix-accent-700, 98, 98, 98)) !important;
}

:where(.dark, .dark *) #happyfiles-sidebar .folder.open,
:where(.dark, .dark *) #happyfiles-sidebar .folder:hover{
  background-color: rgb(var(--uix-accent-900, 98, 98, 98)) !important;
}


/* ========== Couleurs ========== */

:where(.dark, .dark *) #happyfiles-delete-confirmation .actions button {
  color: rgb(var(--uix-base-50, 255, 255, 255)) !important;
}

:where(.dark, .dark *) #happyfiles-create-folders button,
:where(.dark, .dark *) #happyfiles-title {
  color: rgb(var(--uix-base-100, 255, 255, 255)) !important;
}

:where(.dark, .dark *) #happyfiles-sidebar .folder .name{
  color: rgb(var(--uix-base-300, 227, 227, 227)) !important;
}


/* ========== Bordures ========== */

#happyfiles-search-folders {
  border: unset !important;
}

#happyfiles-resizer,
#happyfiles-resizer:hover{
    border-right: 1px solid rgb(var(--uix-base-200, 211, 211, 211));
}

:where(.dark, .dark *) #happyfiles-resizer,
:where(.dark, .dark *) #happyfiles-resizer:hover{
    border-right: 1px solid rgb(var(--uix-base-700, 98,  98,  98));
}



/* ========== Padding ========== */

#happyfiles-search-folders {
  padding: 5px;
}

/* ========== Radius ========== */

#happyfiles-sidebar .folder.open,
#happyfiles-sidebar .folder:hover {
  border-radius: 5px !important;
}

#happyfiles-resizer i {
  border-radius: 3em !important;

}

/* ========== Autre ========== */

#happyfiles-create-folders button.button-primary,
#happyfiles-create-folders button {
  width: 100%;
}

#happyfiles-create-folders {
  gap: 0.75rem;
}

/* Compatibilité UIXPRESS X HappyFiles */
.woocommerce-embed-page .wrap {
  padding: 0 20px !important;
}

#happyfiles-settings-content table tfoot .delete button {
    background-color: crimson !important;
    border-color: crimson !important;
}
        </style>

    <?php
    }, 10);

