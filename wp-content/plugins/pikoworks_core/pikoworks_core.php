<?php

if (!defined('ABSPATH')){
    exit; // if disable direct access
}
/*
 * Plugin Name: Pikoworks Core
 * Plugin URI: 
 * Description: Wooxon WooCommerce theme core functions add metaboxes, shortcodes ...
 * Author: Themepiko
 * Text Domain: pikoworks_core
 * Domain Path: /languages
 * Version: 1.0
 * Author URI: http://www.themepiko.com/
 */

define('PIKOWORKSCORE_VERSION', '1.0.0');
define('PIKOWORKSCORE_BASE_URL', trailingslashit(plugins_url('pikoworks_core')));
define('PIKOWORKSCORE_DIR_PATH', plugin_dir_path(__FILE__));

define('PIKOWORKSCORE_LIBS', PIKOWORKSCORE_DIR_PATH . '/libs/');
define('PIKOWORKSCORE_LIBS_URL', PIKOWORKSCORE_BASE_URL . 'libs/');
define('PIKOWORKSCORE_CORE', PIKOWORKSCORE_DIR_PATH .'/core/');
define('PIKOWORKSCORE_CORE_URL', PIKOWORKSCORE_BASE_URL .'core/');

define('PIKOWORKSCORE_CSS_URL', PIKOWORKSCORE_BASE_URL . 'assets/css/');
define('PIKOWORKSCORE_JS', PIKOWORKSCORE_BASE_URL . 'assets/js/');
define('PIKOWORKSCORE_IMG_URL', PIKOWORKSCORE_BASE_URL . 'assets/images/');
define('PIKOWORKSCORE_PLUGIN', PIKOWORKSCORE_BASE_URL . 'assets/plugin/');
define('PIKOWORKSCORE_FONTS_URL', PIKOWORKSCORE_BASE_URL . 'assets/fonts/');

define('PIKOWORKSCORE_ADMIN_URL', PIKOWORKSCORE_BASE_URL . 'admin/');

/**
 * Load plugin textdomain
 */

if(!function_exists('pikoworks_core_load_textdomain')){
	function pikoworks_core_load_textdomain(){
		load_plugin_textdomain('pikoworks_core', false, PIKOWORKSCORE_DIR_PATH . 'languages');
	}
	add_action('plugins_loaded', 'pikoworks_core_load_textdomain');
}


/**
 * Load core 
 */
if ( file_exists( PIKOWORKSCORE_CORE . 'init.php' ) ) {
    require_once PIKOWORKSCORE_CORE . 'init.php';
    
}
/**
 * Load libs
 */
if ( file_exists( PIKOWORKSCORE_LIBS . 'init.php' ) ) {
    require_once PIKOWORKSCORE_LIBS . 'init.php';
}


if(!function_exists('pikoworks_core_admin_css')){
    function pikoworks_core_admin_css(){     
       wp_enqueue_style( 'pikoworkscore-admin', PIKOWORKSCORE_ADMIN_URL . 'assets/css/admin.css', array(), PIKOWORKSCORE_VERSION, 'all' );    
    }
    add_action( 'admin_enqueue_scripts', 'pikoworks_core_admin_css' );
}

if(!function_exists('pikoworks_core_admin_js')){
    function pikoworks_core_admin_js(){  
       wp_enqueue_script( 'pikoworks-meta-box', PIKOWORKSCORE_ADMIN_URL . 'assets/js/meta-box.js', array('jquery'), PIKOWORKSCORE_VERSION, 'all' );    
       
       global $meta_boxes;
		$meta_box_id = '';
		foreach ($meta_boxes as $box) {
			if (!isset($box['tab'])) {
				continue;
			}
			if (!empty($meta_box_id)) {
				$meta_box_id .= ',';
			}
			$meta_box_id .= '#' . $box['id'];
		}

		wp_localize_script( 'pikoworks-meta-box' , 'meta_box_ids' , $meta_box_id);
		       
    }
    add_action( 'admin_enqueue_scripts', 'pikoworks_core_admin_js' );
}
//for tab section 6/10
if( ! function_exists('pikoworks_core_get_all_attributes') ){
    function pikoworks_core_get_all_attributes( $tag, $text ) {
        preg_match_all( '/' . get_shortcode_regex() . '/s', $text, $matches );
        $out = array();
        if( isset( $matches[2] ) )
        {
            foreach( (array) $matches[2] as $key => $value )
            {
                if( $tag === $value )
                    $out[] = shortcode_parse_atts( $matches[3][$key] );  
            }
        }
        return $out;
    }
}

if (!function_exists('pikoworks_core_meta_tags')) {
    /**
     * Meta tags 
     **/
    function pikoworks_core_meta_tags() {
        
        echo '<meta name="robots" content="NOODP">';
        
        if ( is_front_page() && is_home() ) {
            // Default home page
            echo '<meta name="description" content="' . esc_attr(get_bloginfo( 'description' )) . '" />';
        } elseif ( is_front_page() ) {
            // static home page
            echo '<meta name="description" content="' . esc_attr(get_bloginfo( 'description' )) . '" />';
        } elseif ( is_home() ) {
            //blog page
            echo '<meta name="description" content="' . esc_attr(get_bloginfo( 'description' )) . '" />';
        } else {
            //  Is a singular
            if ( is_singular() ) {
                echo '<meta name="description" content="' . single_post_title( '', false ) . '" />';
            }
            else{ 
                // Is archive or taxonomy
                if ( is_archive() ) {
                    // Checking for shop archive
                    if ( function_exists( 'is_shop' ) ) { // products category, archive, search page
                        if ( is_shop() ) {
                            $post_id = get_option( 'woocommerce_shop_page_id' );                            
                            echo '<meta name="description" content="' . woocommerce_page_title( false ) . '" />';                           
                        }   
                    } 
                    else{
                        echo '<meta name="description" content="' . get_the_archive_description() . '" />';
                    }
                }
                else{
                    if ( is_404() ) {
                        $error_text =  esc_attr__( 'Oops, page not found !', 'pikoworks_core' );
                        echo '<meta name="description" content="' . sanitize_text_field( $error_text ) . '" />';
                    }
                    else{ 
                        if ( is_search() ) {
                            echo '<meta name="description" content="' . sprintf( esc_attr__( 'Search results for: %s', 'pikoworks_core' ), get_search_query() ) . '" />';
                        }
                        else{
                            // is category, is tags, is taxonomize
                            echo '<meta name="description" content="' . single_cat_title( '', false ) . '" />';
                        } 
                    }
                }                
                // Is WooCommerce page title
                if ( function_exists( 'is_woocommerce' ) ) {
                    if ( is_woocommerce() && !is_shop() ) {
                        if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
                            echo '<meta name="description" content="' . woocommerce_page_title( false ) . '" />';
                        }
                    }
                }                
            }
        }
        
    }
    add_action( 'wp_head', 'pikoworks_core_meta_tags' );
}
if(class_exists('RevSliderBaseAdmin')){
    //remove for admin meta
    remove_action('add_meta_boxes', array('RevSliderBaseAdmin', 'onAddMetaboxes'));
}

/**
 * shortcode compare page
 */
if( ! function_exists( 'wooxon_compare_page_shortcode' ) ) {
	
	function wooxon_compare_page_shortcode() {
		ob_start();
		if( class_exists( 'YITH_Woocompare_Frontend' ) ) {
                         wc_get_template_part( 'compare');                        
		} else {
			echo '<p>You need to install YITH Compare plugin for product compare page working</p>';
		}
		
		return ob_get_clean();
	}
}
add_shortcode( 'wooxon_compare_page', 'wooxon_compare_page_shortcode' );

/**
 * working shortcode text widget
 */
add_filter('widget_text','do_shortcode');