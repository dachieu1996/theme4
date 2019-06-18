<?php
/**
 * functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 */

/**
 * Define variables
 */

defined( 'WOOXON_THEME_DIR' )        or   define( 'WOOXON_THEME_DIR',          trailingslashit( get_template_directory() ) );
defined( 'WOOXON_THEME_URI' )        or   define( 'WOOXON_THEME_URI',          trailingslashit(get_template_directory_uri()) );
defined( 'WOOXON_INC_DIR' )          or   define( 'WOOXON_INC_DIR',            trailingslashit(WOOXON_THEME_DIR . 'inc' ));
defined( 'WOOXON_INC_URI' )          or   define( 'WOOXON_INC_URI',            WOOXON_THEME_URI  . 'inc/admin/theme/assets/' );
defined( 'WOOXON_JS' )               or   define( 'WOOXON_JS',                 WOOXON_THEME_URI  . 'assets/js' );
defined( 'WOOXON_CSS' )              or   define( 'WOOXON_CSS',                WOOXON_THEME_URI . 'assets/css' );
defined( 'WOOXON_IMAGE' )            or   define( 'WOOXON_IMAGE',              WOOXON_THEME_URI . 'assets/images' );
defined( 'WOOXON_PLUGIN' )           or   define( 'WOOXON_PLUGIN',             WOOXON_THEME_URI . 'assets/plugin' );
defined( 'WOOXON_OPTIONS_PRESET' )   or   define( 'WOOXON_OPTIONS_PRESET',     WOOXON_INC_DIR . 'presets' );
defined( 'WOOXON_THEME_VERSION' )    or   define( 'WOOXON_THEME_VERSION',      wp_get_theme()->get('Version') );

defined( 'WOOXON_THEME_SLUG' )       or   define( 'WOOXON_THEME_SLUG',         'wooxon' );



if (!function_exists('wooxon_inc_library')) {
    function wooxon_inc_library(){
        require_once(WOOXON_INC_DIR . 'admin/image-resize.php');
        require_once(WOOXON_INC_DIR . 'admin/mega-menu.php');
        require_once(WOOXON_INC_DIR . 'admin/plugin-activation/class-tgm-plugin-activation.php');
        require_once(WOOXON_INC_DIR . 'admin/plugin-activation/plugin-init.php');
        require_once(WOOXON_INC_DIR . 'admin/theme-options.php');
        require_once(WOOXON_INC_DIR . 'admin/importer/importer.php');
        require_once(WOOXON_INC_DIR . 'conditional.php');
        require_once(WOOXON_INC_DIR . 'theme-setup.php');
        require_once(WOOXON_INC_DIR . 'theme-functions.php');
        require_once(WOOXON_INC_DIR . 'admin-enqueue.php');        
        require_once(WOOXON_INC_DIR . 'layout/pre-loader.php');
        require_once(WOOXON_INC_DIR . 'layout/wmpl-switcher.php');
        require_once(WOOXON_INC_DIR . 'layout/breadcrumbs.php');
        require_once(WOOXON_INC_DIR . 'layout/login-ajax.php');
        require_once(WOOXON_INC_DIR . 'layout/coming-soon-page.php');        
        require_once(WOOXON_INC_DIR . 'configure/header-configure.php');
        require_once(WOOXON_INC_DIR . 'configure/blog-configure.php');
        require_once(WOOXON_INC_DIR . 'configure/ajax.php');
        require_once(WOOXON_INC_DIR . 'configure/template-tags.php');
        require_once(WOOXON_INC_DIR . 'configure/sidebar-configure.php');
        require_once(WOOXON_INC_DIR . 'configure/dynamic_css.php');
        if(function_exists( 'WC' )){
            require_once(WOOXON_INC_DIR . 'woocommerce/function.php');
            require_once(WOOXON_INC_DIR . 'woocommerce/notification.php');
            require_once(WOOXON_INC_DIR . 'woocommerce/hooks.php');
            require_once(WOOXON_INC_DIR . 'woocommerce/vendor/init.php');
        }        
        require_once(WOOXON_INC_DIR . 'theme-filter.php');
        require_once(WOOXON_INC_DIR . 'register-sidebar.php');
        require_once(WOOXON_INC_DIR . 'customizer.php');
        require_once(WOOXON_INC_DIR . 'frontend-enqueue.php'); 
        require_once(WOOXON_INC_DIR . 'visual-composer/init.php');
    }
    wooxon_inc_library();
    
}