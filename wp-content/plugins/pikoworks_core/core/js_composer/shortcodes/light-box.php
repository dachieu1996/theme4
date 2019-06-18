<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_light_box' );
function pikoworks_light_box(){
// Setting shortcode lastest
vc_map( array(
    "name"        => esc_html__( "Light box", 'pikoworks_core'),
    "base"        => "pikoworks_light_box",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description" => esc_html__( "light box with content", 'pikoworks_core'),
    'as_parent'               => array('except' => '', 'vc_custom_heading', 'vc_column_text', 'vc_message', 'progress_section', 'pikoworks_icon_block', 'pikoworks_socialpage_link', 'contact-form-7', 'pikoworks_newsletter', 'pikoworks_twitter_feed', 'vc_gmaps'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element"         => true,
    "show_settings_on_create" => true,
    "params"      => array(
        array(
            "type"        => "dropdown",
            "heading"     => esc_html__("Layout type", 'pikoworks-core'),
            "param_name"  => "type",
            "admin_label" => true,
            'value'       => array(
        	esc_html__( 'Image', 'pikoworks-core' ) => 'image',        	
                esc_html__( 'video', 'pikoworks-core' ) => 'video',
                esc_html__( 'Bg Image', 'pikoworks-core' ) => 'bg_image',
        	),
        ),
        array(
                'type' => 'checkbox',
                'heading' => '',
                'param_name' => 'type_pos',
                'value' => array(esc_html__('Image/video position right?', 'pikoworks_core') => 'flex-md-row-reverse'),
                'dependency' => array('element'   => 'type', 'value'  => array('video', 'image')),
        ),
        array(
                'type' => 'checkbox',
                'heading' => '',
                'param_name' => 'no_gutter',
                'value' => array(esc_html__('Space bettwen two cloumn 0', 'pikoworks_core') => 'no-gutters'),
        ),
        array(
            'type' => 'attach_image',
            'param_name' => 'image',
            'admin_label' => true,
            'heading' => esc_html__('Image', 'pikoworks_core'),
            'description' => esc_html__( 'if its layout video image will cover', 'pikoworks_core') 
            
        ), 
        array(
            'type' => 'textfield',
            'param_name' => 'bg_video',
            'heading' => esc_html__('Embaded video Link', 'pikoworks_core'),
            'description'     => sprintf( wp_kses( __( 'Embaded link like as:  <a href="%s" target="__blank"> Click </a>', 'pikoworks_core' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), 'https://youtu.be/U31VGOCyJpM' ),
            'value' => '',
            'dependency' => array('element'   => 'type', 'value'  => 'video'), 
        ),
         array(
            'type' => 'textfield',
            'param_name' => 'bg_height',
            'heading' => esc_html__('Image height', 'pikoworks_core'),
            'value' => '550',
            'dependency' => array('element'   => 'type', 'value'  => array('video', 'bg_image')), 
        ),
         array(
            'type'           => 'css_editor',
            'heading'        => esc_html__( 'Css', 'pikoworks_core' ),
            'param_name'     => 'css',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks_core' ),
            'group'          => esc_html__( 'Design options', 'pikoworks_core' )
	)
    ),
    'js_view' => 'VcColumnView',
));
}
class WPBakeryShortCode_pikoworks_light_box extends WPBakeryShortCodesContainer { 
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'pikoworks_light_box', $atts ) : $atts;
        $atts = shortcode_atts( array(
            'type' => 'image',
            'type_pos' => '',
            'no_gutter' => '',
            'bg_video' => '',
            'bg_height' => '',
            'image'   => '',
            'el_class'           => '',
            'css'           => '',            
            
        ), $atts );
        extract($atts);
        
        $css_class = 'piko-light-box d_flex_md align-items-md-center ' . $type_pos .' '. $el_class .' '. $no_gutter;
        if($type == 'bg_image'){
            $css_class = 'piko-light-box'. $el_class;
        }
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif; 
       
      
        $image_attributes = wp_get_attachment_image_src( $image, 'full' );
        
        ob_start();        
        ?>
        <div class="<?php echo esc_attr($css_class); ?>">
            <?php if($type == 'bg_image'): ?>
            <div class="bg-img video pr" style='height:<?php esc_attr_e($bg_height) ;?>px; background-image: url(<?php echo esc_url($image_attributes[0]); ?>)'>
                <div class="text pa_center">
                    <?php  echo do_shortcode( $content ); ?>                                     
                </div>
            </div>
            <?php else: ?>
            <?php if($type == 'video'): ?>
            <div class="video pr" style='height:<?php esc_attr_e($bg_height) ;?>px; background-image: url(<?php echo esc_url($image_attributes[0]); ?>)'>
                <a href="<?php echo esc_url($bg_video); ?>" class="video-btn"><i class="fa fa-play"></i></a>
            </div>            
            <?php else: ?>
            <div class="col-md-6">
                <img src="<?php echo esc_url($image_attributes[0]); ?>" alt=""/>
            </div>
            <?php endif; ?>
            <div class="col-md-6 text">                
                    <?php  echo do_shortcode( $content ); ?>                                     
            </div>
            <?php endif; ?>
        </div>
        <?php        
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }    
    
}