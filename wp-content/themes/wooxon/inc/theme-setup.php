<?php

/* 
 * theme setup
 */
if ( ! function_exists( 'wooxon_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 * Create your own function to override in a child theme.
 *
 */
function wooxon_theme_setup() {
	load_theme_textdomain( 'wooxon', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
        
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1568, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'wooxon' ),
		'primary_login' => esc_html__( 'Primary Login Menu', 'wooxon' ),
		'top_menu' => esc_html__( 'Top Menu', 'wooxon' ),
		'footer'  => esc_html__( 'Footer Menu', 'wooxon' ),
                'category' => esc_html__('Vertical Menu', 'wooxon'),
                'secondary' => esc_html__('Secondary Menu style 7', 'wooxon')
	) );
	add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
	add_theme_support( 'post-formats', array('aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat',) );
        
        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Enqueue editor styles.
        add_editor_style( 'style-editor.css' );
        
        // Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );
        
        // Editor color palette.
        add_theme_support(
                'editor-color-palette',
                array(
                    array(
                        'name' => esc_html__( 'Primary', 'wooxon' ),
                        'slug' => 'primary',
                        'color' => '#f8981d',
                    ),
                    array(
                        'name' => esc_html__( 'Secondary', 'wooxon' ),
                        'slug' => 'secondary',
                        'color' => '#222',
                    ),
                    array(
                        'name' => esc_html__( 'Light Gray', 'wooxon' ),
                        'slug' => 'light-gray',
                        'color' => '#878787',
                    ),
                    array(
                        'name' => esc_html__( 'White', 'wooxon' ),
                        'slug' => 'white',
                        'color' => '#fff',
                    ),
                )
        );      
        
             
         // Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wooxon_custom_background_args', array(
		'default-color' => '',
		'default-image' => '',
	) ) );        
        // Screen reader text
        add_theme_support( 'screen-reader-text' );
        
        // woocommerce support
        add_theme_support( 'woocommerce');
        
        if(defined('WOOCOMMERCE_VERSION')){
                if(version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0){
                        add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
                } else {
                        define( 'WOOCOMMERCE_USE_CSS', false );
                }
        }
        
        /*Thumbnail size*/
        global $wooxon_image_size;
        $wooxon_image_size = array(
            'wooxon-image-full-width' => array('width' => 1170, 'height' => 780 ),
            'wooxon-image-sidebar' => array('width' => 870, 'height' => 580 ),
            'wooxon-medium-image' => array('width' => 400, 'height' => 267 ),
            'wooxon-2cols-image' => array('width' => 570, 'height' => 315),            
            'wooxon-3cols-image' => array('width' => 370, 'height' => 247),
            'wooxon-4cols-image' => array('width' => 255, 'height' => 147),
            
            'wooxon-masonry1' => array('width' => 586, 'height' => 225),
            'wooxon-masonry2' => array('width' => 586, 'height' => 306),
            'wooxon-masonry3' => array('width' => 586, 'height' => 608),
            'wooxon-masonry4' => array('width' => 586, 'height' => 391),
            'wooxon-masonry5' => array('width' => 586, 'height' => 288),
            
            'wooxon-s340' => array('width' => 340, 'height' => 300),
        );
	
}
endif; // pikowork_theme_setup
add_action( 'after_setup_theme', 'wooxon_theme_setup' );


/**
* Enqueue editor styles for Gutenberg
*/
if (!function_exists('wooxon_slug_editor_styles')) { 
    function wooxon_slug_editor_styles() {
        wp_enqueue_style( 'wooxon-slug-editor-style', get_template_directory_uri() . '/assets/css/editor-style.css' );
    }
    add_action( 'enqueue_block_editor_assets', 'wooxon_slug_editor_styles' );
}

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet. *
 * Priority 0 to make it available to lower priority callbacks. *
 * @global int $content_width
 */
if (!function_exists('wooxon_content_width')) {
    function wooxon_content_width() {
            $GLOBALS['content_width'] = apply_filters( 'wooxon_content_width', 840 );
    }
    add_action( 'after_setup_theme', 'wooxon_content_width', 0 );
}