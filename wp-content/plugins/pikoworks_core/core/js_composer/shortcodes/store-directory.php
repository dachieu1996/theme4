<?php
/**
 * @author  themepiko
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_core_store_directory' );
function pikoworks_core_store_directory(){
 
vc_map( array(
     "name"        => esc_html__( "Store Directory", 'pikoworks-core'),
     "base"        => "store_directory",
     "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
     "category"    => esc_html__('Pikoworks', 'pikoworks-core' ),
     "description" => esc_html__( "Display Product Category", 'pikoworks-core'),
     "params"      => array(
        array(
            "type"        => "dropdown",
            "heading"     => esc_html__("Layout type", 'pikoworks-core'),
            "param_name"  => "type",
            "admin_label" => true,
            'value'       => array(
        	esc_html__( 'layout 1', 'pikoworks-core' )    => '1',
                esc_html__( 'layout 2', 'pikoworks-core' )    => '2'
        	),
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Order by", 'pikoworks-core'),
            "param_name" => "orderby",
            "value"      => array(
        	esc_html__('None', 'pikoworks-core')     => 'none',
                esc_html__('ID', 'pikoworks-core')       => 'ID',
                esc_html__('Author', 'pikoworks-core')   => 'author',
                esc_html__('Name', 'pikoworks-core')     => 'name',
                esc_html__('Date', 'pikoworks-core')     => 'date',
                esc_html__('Modified', 'pikoworks-core') => 'modified',
                esc_html__('Rand', 'pikoworks-core')     => 'rand',
        	),
            'std'         => 'name',
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Order", 'pikoworks-core'),
            "param_name" => "order",
            "value"      => array(                
                esc_html__( 'Ascending', 'pikoworks-core' )  => 'ASC',
                esc_html__( 'Descending', 'pikoworks-core' ) => 'DESC'
        	),
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Hide Empty", 'pikoworks-core'),
            "param_name" => "hide_empty",
            "value"      => array(                
                esc_html__( 'True', 'pikoworks-core' )  => true,
                esc_html__( 'False', 'pikoworks-core' ) => false
        	),
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Extra class name", 'pikoworks_core' ),
            "param_name"  => "el_class",
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks-core" ),
        ), 
        array(
            'type'           => 'css_editor',
            'heading'        => esc_html__( 'Css', 'pikoworks-core' ),
            'param_name'     => 'css',
            'group'          => esc_html__( 'Design options', 'pikoworks-core' ),
            'admin_label'    => false,
		),
        
    )
));
}

class WPBakeryShortCode_Store_Directory extends WPBakeryShortCode {
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'store_directory', $atts ) : $atts;
        extract( shortcode_atts( array(
            'type'          => 'style-1',            
            'orderby'       => 'name',
            'order'         => 'ASC',
            'hide_empty'    => true,
            'el_class'     =>  '',
            'css'           => '',
        ), $atts ) );
        
        
        $css_class = 'store-directory layout-' . $type . ' ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;
        
        ob_start();            
        echo '<div class="'. esc_attr( $css_class ) . '">'; ?>
            <ul class="ul-no">
                <?php wp_list_categories( array(
                    'hide_empty'          => $hide_empty,
                    'hierarchical'        => true,
                    'order'               => $order,
                    'orderby'             => $orderby,
                    'taxonomy' => 'product_cat',
                    'title_li'            => '',
                ) ); ?> 
            </ul>            
        <?php
        echo '</div>';       
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}