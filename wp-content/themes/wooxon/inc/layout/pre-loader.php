<?php 
/* 
 * preloader html
 */

if(!function_exists('wooxon_enable_loader')){
    function wooxon_enable_loader(){         
            wooxon_get_template('site-loading');
    }
}
add_action('election_after_menu_content','wooxon_enable_loader',1);