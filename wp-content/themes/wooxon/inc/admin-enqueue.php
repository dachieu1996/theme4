<?php
/**
 * Enqueues scripts and styles admin.
 *
 */
if(!function_exists('wooxon_admin_scripts')){
    function wooxon_admin_scripts(){       
      wp_enqueue_style('wooxon-fontpiko', WOOXON_CSS.'/fontpiko.css', false, WOOXON_THEME_VERSION, 'all' );
      wp_enqueue_media();   
      wp_enqueue_script('wooxon-admin', WOOXON_JS.'/admin.js', array('jquery'), WOOXON_THEME_VERSION, true);     
    }
    add_action( 'admin_enqueue_scripts', 'wooxon_admin_scripts' );
}