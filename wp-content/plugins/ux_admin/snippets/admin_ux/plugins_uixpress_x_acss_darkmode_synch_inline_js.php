<?php if(!defined('ABSPATH')) { die(); }  

add_action('admin_footer', function() {

        
        ?>
        <script type='text/javascript'>
        (function(){new MutationObserver(mutations=>{if(mutations.some(m=>m.attributeName==='class')){const isDark=document.body.classList.contains('dark');document.querySelectorAll('iframe').forEach(iframe=>{try{iframe.contentWindow.postMessage({theme:isDark},'*');}catch(e){}});}}).observe(document.body,{attributes:true});window.addEventListener('message',e=>{if(e.data&&typeof e.data.theme==='boolean'){document.documentElement.classList.toggle('color-scheme--alt',e.data.theme);document.body.classList.toggle('dark',e.data.theme);localStorage.setItem('uipc_theme',e.data.theme?'dark':'light');localStorage.setItem('user-theme',e.data.theme?'dark':'light');localStorage.setItem('theme-manual','true');}});window.addEventListener('load',()=>{const isDark=document.body.classList.contains('dark');document.querySelectorAll('iframe').forEach(iframe=>{try{iframe.contentWindow.postMessage({theme:isDark},'*');}catch(e){}});});})();
        </script>

    <?php
    }, 10);

add_action('wp_footer', function() {

        
        ?>
        <script type='text/javascript'>
        (function(){new MutationObserver(mutations=>{if(mutations.some(m=>m.attributeName==='class')){const isDark=document.body.classList.contains('dark');document.querySelectorAll('iframe').forEach(iframe=>{try{iframe.contentWindow.postMessage({theme:isDark},'*');}catch(e){}});}}).observe(document.body,{attributes:true});window.addEventListener('message',e=>{if(e.data&&typeof e.data.theme==='boolean'){document.documentElement.classList.toggle('color-scheme--alt',e.data.theme);document.body.classList.toggle('dark',e.data.theme);localStorage.setItem('uipc_theme',e.data.theme?'dark':'light');localStorage.setItem('user-theme',e.data.theme?'dark':'light');localStorage.setItem('theme-manual','true');}});window.addEventListener('load',()=>{const isDark=document.body.classList.contains('dark');document.querySelectorAll('iframe').forEach(iframe=>{try{iframe.contentWindow.postMessage({theme:isDark},'*');}catch(e){}});});})();
        </script>

    <?php
    }, 10);

