<?php
/**
 * @newsletter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_newsletter' );
function pikoworks_newsletter(){
 
   global $pikoworks_vc_anim_effects_in;
// Setting shortcode lastest
vc_map( array(
    "name"        => esc_html__( "Newsletter Form", 'pikoworks_core'),
    "base"        => "pikoworks_newsletter",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description" => esc_html__( "Mailchimp or Contact form 7", 'pikoworks_core'),
    "params"      => array(
                array(
                    'heading'       => esc_html__( 'Mailchimp For WP Plugin Shortcode', 'pikoworks_core' ),
                    'description' => esc_html__( 'Mailchimp Shortcode like as: [mc4wp_form id="236"] if collect email address contact form7 shortcode: [contact-form-7 id="5755" title="Sign up"]', 'pikoworks_core' ),
                    'type'          => 'textfield',                    
                    'param_name'    => 'mc_shortcode',
                    'admin_label' => true, 
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Layout', 'pikoworks_core' ),
                    'param_name' => 'layout',
                    'value' => array(
                            esc_html__( 'One', 'pikoworks_core' ) => '1',
                            esc_html__( 'Two', 'pikoworks_core' ) => '2',
                    ),
                    'admin_label' => true,
                ), 
                array(
                    'heading'       => esc_html__( 'Title color', 'pikoworks_core' ),
                    'type'          => 'colorpicker',                    
                    'param_name'    => 'text_color',
                ),
                array(
                    'heading'       => esc_html__( 'Small Title', 'pikoworks_core' ),
                    'type'          => 'textfield',                    
                    'param_name'    => 'subscribe_text',
                    'std'           => esc_html__( 'Stay with us', 'pikoworks_core' ),
                    'admin_label' => true,
                ),
                array(
                    'heading'       => esc_html__( 'Short Description', 'pikoworks_core' ),
                    'type'          => 'textfield',                    
                    'param_name'    => 'subscribe_short_desc',
                    'std'           => esc_html__( 'Subscribe our community get 25% off your first three order.', 'pikoworks_core' ),
                ),                                     
                array(
                    "heading"     => esc_html__( "Extra class name", 'pikoworks_core' ),
                    "type"        => "textfield",            
                    "param_name"  => "el_class",
                    "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks_core" ),
                ),
                 array(
                    'heading'        => esc_html__( 'Css', 'pikoworks_core' ),
                    'type'           => 'css_editor',            
                    'param_name'     => 'css',
                    'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks_core' ),
                    'group'          => esc_html__( 'Design options', 'pikoworks_core' )
                )
    )
));
}
class WPBakeryShortCode_pikoworks_newsletter extends WPBakeryShortCode { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_newsletter', $atts ) : $atts;
        $atts = shortcode_atts( array(           
            'subscribe_text'        =>  '',
            'subscribe_short_desc'        =>  '',
            'mc_shortcode' =>  '', 
            'text_color'           => '',
            'layout'           => '',
            'el_class'           => '',
            'css'           => '',
            
            
        ), $atts );
        extract($atts);
        
        $css_class = 'piko-newsletter widget ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;

                 
        $text_style = trim( $text_color ) != '' ? 'color: ' . esc_attr( $text_color ) . ';' : '';
         if ( trim( $text_color ) != '' ) {
            $text_style = 'style="' .  esc_attr($text_style) .  '"';
        }        
        
        if ( ! empty( $subscribe_text ) ) {
		$subscribe_text = '<h5 '.$text_style.' class="dib pr10">'.sanitize_text_field($subscribe_text).'</h5>';
        }
        if ( ! empty( $subscribe_short_desc ) ) {
                $subscribe_short_desc = '<span '.$text_style.' class="pl10">'.sanitize_text_field($subscribe_short_desc).'</span>';
        }
        $subscribe_form_html = do_shortcode($mc_shortcode); 
        
        ob_start(); 
        if($layout == 1){
            echo '<div class="' . esc_attr( $css_class ) . '"><div class="row align-items-center">'; // The textwidget class is for theme styling compatibility.
            echo '<div class="col-12 col-md-7">'.balanceTags($subscribe_text . $subscribe_short_desc).'</div>';
            echo '<div class="col-12 col-md-5 search-form">'.$subscribe_form_html.'</div>';
            echo '</div></div>';
        }  else {
            echo '<div class="news ' . esc_attr( $css_class ) . '"><div class="row">'; // The textwidget class is for theme styling compatibility.
            echo '<div class="col-12">'.balanceTags($subscribe_text . $subscribe_short_desc).'<div><div class="search-form">'. $subscribe_form_html.'</div></div></div>';            
            echo '</div></div>';
        }            
            
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }    
    
}