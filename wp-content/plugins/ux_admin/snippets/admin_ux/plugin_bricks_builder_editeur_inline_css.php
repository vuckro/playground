<?php if(!defined('ABSPATH')) { die(); }  

add_action('wp_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("?bricks=run") ) || ( $wpContext->current_url_contains("?page=bricks-settings") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='55' class='wpcb2-inline-style'>

        /* ===== Builder ===== */

:root {
  /* Tous ré-alignés sur la teinte principale */
  --bricks-color-primary:                   		var(--primary-light, #e3e3e3);
  --builder-color-accent:                    		var(--primary-light, #e3e3e3);
  --wp--preset--color--luminous-vivid-amber:		var(--primary-ultra-light, #f7f7f7);
  --builder-bg-accent: 								var(--primary-light-trans-20, rgba(227, 227, 227, 0.2));
}

#bricks-toolbar .logo {
	background-color: var(--primary-light, #e3e3e3);
}




/* ===== Remplace complètement le loader Bricks ===== */
#bricks-preloader .bricks-loading-inner {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  position: relative;
}

#bricks-preloader .bricks-logo-animated,
#bricks-preloader .title,
#bricks-preloader .sub-title {
  display: none !important;
}

#bricks-preloader .bricks-loading-inner::before {
  content: "";
  display: block;
  height: 11em;
  width: 11em;
  background: url('https://www.waaskit.com/wp-content/uploads/2025/05/WaasKit-dark-mode.svg') center/contain no-repeat;
  animation: pulse 1.5s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% { transform: scale(0.98); }
  50%      { transform: scale(1.05); }
}






/* ===== Back-end ===== */

#bricks-settings input[type=checkbox]:checked {
	background-color: rgb(var(--uix-accent-700,103, 103, 103))!important;
}

#bricks-settings .message.info {
    background-color: rgb(var(--uix-accent-50,247, 247, 247));
    color: rgb(var(--uix-accent-700,103, 103, 103));
}

        </style>

    <?php
    }, 1000000);

add_action('admin_head', function() {

        
	// Condition Builder helper class
	$wpContext = new \WFPCore\WordPressContext();

	// Condition Builder generated Conditions
	if( !( ( $wpContext->current_url_contains("?bricks=run") ) || ( $wpContext->current_url_contains("?page=bricks-settings") ) )) {
		return false;
	}
        ?>
        <style wpcb-ids='55' class='wpcb2-inline-style'>

        /* ===== Builder ===== */

:root {
  /* Tous ré-alignés sur la teinte principale */
  --bricks-color-primary:                   		var(--primary-light, #e3e3e3);
  --builder-color-accent:                    		var(--primary-light, #e3e3e3);
  --wp--preset--color--luminous-vivid-amber:		var(--primary-ultra-light, #f7f7f7);
  --builder-bg-accent: 								var(--primary-light-trans-20, rgba(227, 227, 227, 0.2));
}

#bricks-toolbar .logo {
	background-color: var(--primary-light, #e3e3e3);
}




/* ===== Remplace complètement le loader Bricks ===== */
#bricks-preloader .bricks-loading-inner {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  position: relative;
}

#bricks-preloader .bricks-logo-animated,
#bricks-preloader .title,
#bricks-preloader .sub-title {
  display: none !important;
}

#bricks-preloader .bricks-loading-inner::before {
  content: "";
  display: block;
  height: 11em;
  width: 11em;
  background: url('https://www.waaskit.com/wp-content/uploads/2025/05/WaasKit-dark-mode.svg') center/contain no-repeat;
  animation: pulse 1.5s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% { transform: scale(0.98); }
  50%      { transform: scale(1.05); }
}






/* ===== Back-end ===== */

#bricks-settings input[type=checkbox]:checked {
	background-color: rgb(var(--uix-accent-700,103, 103, 103))!important;
}

#bricks-settings .message.info {
    background-color: rgb(var(--uix-accent-50,247, 247, 247));
    color: rgb(var(--uix-accent-700,103, 103, 103));
}

        </style>

    <?php
    }, 10);

