<?php
/**
 * @vc extension
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('pikoworks_init_vc_global')) {
    add_action('after_setup_theme', 'pikoworks_init_vc_global', 1);
    
    function pikoworks_init_vc_global(){
        if( ! defined( 'WPB_VC_VERSION' )){
            return ;
        }
        if( version_compare( WPB_VC_VERSION , '4.2', '<') ){
            add_action( 'init', 'pikoworks_add_vc_global_params', 100 );
        }else{
            add_action( 'vc_after_mapping', 'pikoworks_add_vc_global_params' );
        }
    }
}
if(!function_exists('pikoworks_add_vc_global_params')) {
    function pikoworks_add_vc_global_params(){
      //  vc_set_shortcodes_templates_dir( PIKOWORKSCORE_CORE . '/js_composer/shortcodes/' );


        global $vc_setting_row, $vc_setting_col, $vc_setting_column_inner, $vc_setting_icon_shortcode;

        vc_add_params( 'vc_icon', $vc_setting_icon_shortcode );
        vc_add_params( 'vc_column', $vc_setting_col );
        vc_add_params( 'vc_column_inner', $vc_setting_column_inner );
        if ( is_admin() ) {
            pikoworks_enqueue_custom_script();
        }
        if( function_exists( 'vc_add_shortcode_param')){
            vc_add_shortcode_param( 'pikoworks_number' , 'pikoworks_vc_number_settings_field');
            vc_add_shortcode_param( 'pikoworks_taxonomy', 'pikoworks_vc_taxonomy_settings_field');
            
        }else{            
            add_shortcode_param( 'pikoworks_number' , 'pikoworks_vc_number_settings_field' );
            add_shortcode_param( 'pikoworks_taxonomy', 'pikoworks_vc_taxonomy_settings_field');

        }
    }
}
if(!function_exists('pikoworks_enqueue_custom_script')) {
    function pikoworks_enqueue_custom_script(){
        wp_enqueue_script( 'pikoworks-chosen-js', PIKOWORKS_CUSTOM_POST_ASSETS.'js/chosen/chosen.jquery.min.js', array( 'jquery' ), '1.4.2', true );
        wp_enqueue_style( 'pikoworks-chosen-css', PIKOWORKS_CUSTOM_POST_ASSETS.'js/chosen/chosen.css' );
    }
}
if(!function_exists('pikoworks_vc_number_settings_field')) {
/**
 * Pikowroks Number field.
 *
 */
    function pikoworks_vc_number_settings_field($settings, $value){
            $dependency = '';
            $param_name = isset( $settings[ 'param_name' ] ) ? $settings[ 'param_name' ] : '';
            $type = isset($settings[ 'type ']) ? $settings[ 'type' ] : '';
            $min = isset($settings[ 'min' ]) ? $settings[ 'min' ] : '';
            $max = isset($settings[ 'max' ]) ? $settings[ 'max'] : '';
            $suffix = isset($settings[ 'suffix' ]) ? $settings[ 'suffix' ] : '';
            $class = isset($settings[ 'class' ]) ? $settings[ 'class' ] : '';
            $output = '<input type="number" min="'.esc_attr( $min ).'" max="'.esc_attr( $max ).'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.esc_attr($value).'" '.$dependency.' style="max-width:100px; margin-right: 10px;" />'.$suffix;
            return $output;
    }
}
if(!function_exists('pikoworks_vc_taxonomy_settings_field')) {
    /**
     * pikoworks Taxonomy checkbox list field.
     *
     */
    function pikoworks_vc_taxonomy_settings_field($settings, $value) {
            $dependency = '';

            $value_arr = $value;
            if ( ! is_array($value_arr) ) {
                    $value_arr = array_map( 'trim', explode(',', $value_arr) );
            }
        $output = '';
        if( isset( $settings['hide_empty'] ) && $settings['hide_empty'] ){
            $settings['hide_empty'] = 1;
        }else{
            $settings['hide_empty'] = 0;
        }
            if ( ! empty($settings['taxonomy']) ) {

            $terms_fields = array();
            if(isset($settings['placeholder']) && $settings['placeholder']){
                $terms_fields[] = "<option value=''>".$settings['placeholder']."</option>";
            }

            $terms = get_terms( $settings['taxonomy'] , array('hide_empty' => false, 'parent' => $settings['parent'], 'hide_empty' => $settings['hide_empty'] ));
                    if ( $terms && !is_wp_error($terms) ) {
                            foreach( $terms as $term ) {
                                $selected = (in_array( $term->slug, $value_arr )) ? ' selected="selected"' : '';                
                                $terms_fields[] = '<option value="' .$term->slug. '" '. $selected .' >' . htmlspecialchars($term->name) . '</option>';
                        }
                    }
            $size = (!empty($settings['size'])) ? 'size="'.$settings['size'].'"' : '';
            $multiple = (!empty($settings['multiple'])) ? 'multiple="multiple"' : '';

            $uniqeID    = uniqid();

            $output = '<select id="pikoworks_taxonomy-'.$uniqeID.'" '.$multiple.' '.$size.' name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select '.$settings['param_name'].' '.$settings['type'].'_field" '.$dependency.'>'
                        .implode( $terms_fields )
                    .'</select>';

            $output .= '<script type="text/javascript">jQuery("#pikoworks_taxonomy-' . $uniqeID . '").chosen();</script>';

            }

        return $output;
    }
}

if( ! function_exists( 'pikoworks_get_slider_params_enable' ) ) {
	function pikoworks_get_slider_params_enable() {
		return array(
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__('Carousel Style', 'pikoworks_core'),
                            'param_name' => 'is_slider',
                            'value' => array(
                                esc_html__('Yes', 'pikoworks_core') => 'yes',
                                esc_html__('No', 'pikoworks_core') => 'no',
                                ),
                            'std'         => 'no',
                            'weight'      => 1,
                            'admin_label' => true,
                        ),
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_core' ) => 'true',
                                esc_html__( 'No', 'pikoworks_core' )  => 'false'
                            ),
                            'std'         => 'true',
                            'heading'     => esc_html__( 'Navigation', 'pikoworks_core' ),
                            'param_name'  => 'navigation',
                            'description' => esc_html__( "Show buton 'next' and 'prev' buttons.", 'pikoworks_core' ),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),
                            'admin_label' => true,
                        ),                           
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Center', 'pikoworks_core' ) => '',
                                esc_html__( 'Top Center', 'pikoworks_core' )  => 'tc',
                                esc_html__( 'Small Center', 'pikoworks_core' )  => 'sc',
                                esc_html__( 'Small top Center right', 'pikoworks_core' )  => 'stcr',
                            ),                
                            'heading'     => esc_html__( 'Next/Prev Button', 'pikoworks_core' ),
                            'param_name'  => 'navigation_btn',
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
                        ),
                        array(                
                            'type' => 'checkbox',                
                            "heading" => '',
                            'param_name' => 'btn_hover_show',
                            'value' => array(esc_html__('Hover show Next/Prev Button', 'pikoworks_core') => 'sh'),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
                        ),
                        array(                
                            'type' => 'checkbox',                
                            "heading" => '',
                            'param_name' => 'btn_light',
                            'value' => array(esc_html__('Button Light', 'pikoworks_core') => 'al'),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'navigation', 'value'     => array( 'true' )),
                        ),            
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_core' ) => 'true',
                                esc_html__( 'No', 'pikoworks_core' )  => 'false'
                            ),
                            'std'         => 'false',
                            'heading'     => esc_html__( 'Bullets', 'pikoworks_core' ),
                            'param_name'  => 'dots',
                            'description' => esc_html__( "Show Carousel bullets bottom", 'pikoworks_core' ),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),
                            'admin_label' => true,
                        ),                        
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_core' ) => 'true',
                                esc_html__( 'No', 'pikoworks_core' )  => 'false'
                            ),
                            'std'         => 'false',
                            'heading'     => esc_html__( 'AutoPlay', 'pikoworks_core' ),
                            'param_name'  => 'autoplay',
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' ))
                        ),
                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Yes', 'pikoworks_core' ) => 'true',
                                esc_html__( 'No', 'pikoworks_core' )  => 'false'
                            ),
                            'std'         => 'false',
                            'heading'     => esc_html__( 'Loop', 'pikoworks_core' ),
                            'param_name'  => 'loop',
                            'description' => esc_html__( "Inifnity loop. Duplicate last and first items to get loop illusion.", 'pikoworks_core' ),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' ))
                            ),
                        array(
                            'type'  => 'textfield',
                            'value' => '1',
                            'heading'     => esc_html__( 'Slides To Scroll', 'pikoworks_core' ),
                            'param_name'  => 'slides_scroll',
                            'description' => esc_html__( "Next slide show", 'pikoworks_core' ),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),
                        ),    
                        array(
                            "type"        => "checkbox",
                            "heading"     => '',
                            "param_name"  => "margin",
                            'value' => array(esc_html__('No Gap', 'pikoworks_core') => 'no-gap'),                
                            "description" => esc_html__('Distance( or space) between 2 item ', 'pikoworks_core'),
                            'dependency' => array('element'   => 'is_slider', 'value'     => array( 'yes' )),
                            'group'       => esc_html__( 'Carousel settings', 'pikoworks_core' )
                                ),

                        array(
                            'type'  => 'dropdown',
                            'value' => array(
                                esc_html__( 'Multiple item', 'pikoworks_core' ) => 1,
                                esc_html__( 'Single item', 'pikoworks_core' )  => 0
                            ),
                            'std'         => 1,
                            'heading'     => esc_html__( 'Carosuel type', 'pikoworks_core' ),
                            'param_name'  => 'use_responsive',
                            'description' => esc_html__( "NB: Single item not working below option", 'pikoworks_core' ),
                            'group'       => esc_html__( 'Responsive', 'pikoworks_core' ),
                            'dependency' => array('element'   => 'is_slider','value'     => array( 'yes' )),               
                        ),            
                        array(
                            "type"        => "dropdown",
                            "heading"     => esc_html__("Items large Device", 'pikoworks_core'),
                            "param_name"  => "items_very_large_device",
                            'value' => array(2 => 2,3 => 3,4 => 4,6 => 6,),
                            'std'         => '4',
                            "description" => esc_html__('Screen resolution of device >= 1200px', 'pikoworks_core'),                
                            'group'       => esc_html__( 'Responsive', 'pikoworks_core' )
                          ),            
                        array(
                            'type' => 'dropdown',
                            "heading"     => esc_html__("Items on Medium Device", 'pikoworks_core'),
                            'param_name' => 'items_large_device',
                            'value' => array(2 => 2,3 => 3,4 => 4,6 => 6,),
                            'std'         => '4',
                            'description' => esc_html__('Resolution < 1200px || Tablet and Mobile auto fixed', 'pikoworks_core'),                            
                            'group'       => esc_html__( 'Responsive', 'pikoworks_core' )
                        ),
			
		);
	}
}