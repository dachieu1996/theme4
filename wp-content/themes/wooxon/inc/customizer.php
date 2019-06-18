<?php
/**
 *Theme Customizer.
 *
 */
if (!function_exists('wooxon_customize_register')) {
    /**
     * Add postMessage support for site title and description for the Theme Customizer.
     *
     * @param WP_Customize_Manager $wp_customize Theme Customizer object.
     */
    function wooxon_customize_register( $wp_customize ) {
            $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
            $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
            $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
            
            $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'twentyseventeen_customize_partial_blogdescription',
            ) );
            $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-logo'
            ) );
            
    }
    add_action( 'customize_register', 'wooxon_customize_register' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Twenty Seventeen 1.0
 * @see twentyseventeen_customize_register()
 *
 * @return void
 */
function twentyseventeen_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


if (!function_exists('wooxon_customize_js_preview')) {
    /**
     * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
     */
    function wooxon_customize_js_preview() {
            wp_enqueue_script( 'wooxon_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'jquery','customizer-preview' ), '', true );
    }
    add_action( 'customize_preview_init', 'wooxon_customize_js_preview' );
}
if (!function_exists('wooxon_custom_header_and_background')) {
    function wooxon_custom_header_and_background() {

            add_theme_support( 'custom-background', apply_filters( 'wooxon_custom_background_args', array(
                    'default-color' => '',
            ) ) );


            add_theme_support( 'custom-header', apply_filters( 'wooxon_custom_header_args', array(
                    'default-text-color'     => '',

            ) ) );
    }
    add_action( 'after_setup_theme', 'wooxon_custom_header_and_background' );
}