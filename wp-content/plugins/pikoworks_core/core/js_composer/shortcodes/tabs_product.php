<?php
/**
 * @tabs product
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_tabs_product' );
function pikoworks_tabs_product(){
    $brand = 'product_cat';
    if (defined('PIKOWORKS_PRODUCT_BRANDS_TAXONOMY') && taxonomy_exists(PIKOWORKS_PRODUCT_BRANDS_TAXONOMY)) {
        $brand = PIKOWORKS_PRODUCT_BRANDS_TAXONOMY;
    }

$params = array(
    "name"                    => esc_html__( "Product Tabs", 'pikoworks_core'),
    "base"                    => "tabs_product",
    "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
    "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
    "description"             => esc_html__( "Tabs Product categories", 'pikoworks_core'),
    "as_parent"               => array('only' => 'tab_section'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element"         => true,
    "show_settings_on_create" => true,
    "params"      => array_merge(array(
        array(
            "type"        => "checkbox",
            "heading"     => '',
            "param_name"  => "bg_gray",
            'value' => array(esc_html__('Layout background color gray?', 'pikoworks_core') => 'bg-gray'),
        ),
        array(
            "type"        => "checkbox",
            "heading"     => '',
            "param_name"  => "tab_vertical",
            'value' => array(esc_html__('Enable vertical tabs?', 'pikoworks_core') => 'tab-vertical'),
        ),
        array(
            "type"        => "checkbox",
            "heading"     => '',
            "param_name"  => "tabs_title_open",
            'value' => array(esc_html__('Tabs Title Open?', 'pikoworks_core') => 'yes'),
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Tabs Title", 'pikoworks_core' ),
            "param_name"  => "tabs_title",
            "description" => esc_html__('if empty nothing show', 'pikoworks_core'),
            "dependency"  => array("element" => "tabs_title_open", "value" => array('yes')),
        ),
        array(
            "type"        => "dropdown",
            "heading"     => esc_html__("Tabs Title icon", 'pikoworks_core'),
            "param_name"  => "tabs_icon",
            "admin_label" => true,
            'value'       => array(
                esc_html__( 'None', 'pikoworks_core' ) => 'none',
                esc_html__( 'Font Awesome icon', 'pikoworks_core' ) => 'awesome',
                esc_html__( 'Font piko icon', 'pikoworks_core' ) => 'fontpiko',
                esc_html__( 'Custom Image icon', 'pikoworks_core' ) => 'image_icon',                
            ),
            'description' => esc_html__( 'Heading icon show before Title', 'pikoworks_core' ),
            "dependency"  => array("element" => "tabs_title_open", "value" => array('yes')),
        ),
        array(
            'type' => 'iconpicker',
            'param_name' => 'block_icon',
            'heading' => esc_html__('Icon', 'pikoworks_core'),
            "dependency"  => array("element" => "tabs_icon", "value" => array('awesome')),
        ),
        array(
            'type' => 'iconpicker',
            'param_name' => 'fontpiko_icon',
            'heading' => esc_html__('icon', 'pikoworks_core'),
            'settings' => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type' => 'fontpiko',
                    'iconsPerPage' => 1000, // default 100, how many icons per/page to display
            ),
            'dependency' => array('element' => 'tabs_icon', 'value' => 'fontpiko'),

        ),
        array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Custom image Icon', 'pikoworks_core' ),
            'param_name'  => 'custom_icon',
            'dependency'  => array('element' => 'tabs_icon','value' => array('image_icon')),
            'description' => esc_html__( 'Setup custome image icon .png formate, size: 32x32px', 'pikoworks_core' ),
    	),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Tab Panel', 'pikoworks_core' ),
            'param_name'    => 'panel_layout',
            'value' => array(
                esc_html__('style 01', 'pikoworks_core') => '',
                esc_html__('style 02', 'pikoworks_core') => '2',                
            ),
            "admin_label" => true,
        ),
        array(
            "type"        => "checkbox",
            "heading"     => '',
            "param_name"  => "tabs_panels",
            'value' => array(esc_html__('Tabs Panel', 'pikoworks_core') => 'yes'),                
            "description" => esc_html__('Uncheck to Tabs Fitler Panel hidden', 'pikoworks_core'),
            'std'           => 'yes',
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Tabs Panel Alignment', 'pikoworks_core' ),
            'param_name'    => 'tabs_panels_align',
            'value' => array(                    
                esc_html__('Center', 'pikoworks_core') => 'center',
                esc_html__('Left', 'pikoworks_core') => 'start',
                esc_html__('Right', 'pikoworks_core') => 'end',                     
            ),
            'dependency' => array('element'   => 'tabs_panels', 'value'     => array( 'yes')),
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Tabs layouts', 'pikoworks_core' ),
            'param_name'    => 'tabs_type',
            'value' => array(
                esc_html__('Layout 01', 'pikoworks_core') => '1',
                esc_html__('Layout 02 big image', 'pikoworks_core') => '2',                
                esc_html__('Layout 03 border', 'pikoworks_core') => '3',                
            ),
            'std'           => '1',
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Product type', 'pikoworks_core' ),
            'param_name'    => 'product_grid',
            'value' => array(
                esc_html__('Grid', 'pikoworks_core') => 'grid',
                esc_html__('List', 'pikoworks_core') => 'list',       
            ),
            'dependency' => array('element'   => 'tabs_type', 'value'     => array( '1','3')),
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Thumbnail Position', 'pikoworks_core' ),
            'param_name'    => 'thumb_align',
            'value' => array(
                'Left' => '',
                'Right' => 'thumb-right',                
            ),
            'dependency' => array('element'   => 'tabs_type', 'value'     => array('3')),
            "description" => esc_html__('It\'s only working product type: "List"', 'pikoworks_core'),
        ),
//        array(
//            'type'          => 'dropdown',
//            'heading'       => esc_html__( 'Product style', 'pikoworks_core' ),
//            'param_name'    => 'category_layout',
//            'value' => array(
//                esc_html__('style 01', 'pikoworks_core') => '1',
//                esc_html__('style 02', 'pikoworks_core') => '2',                
//            ),
//            'std'           => '1',
//            "admin_label" => true,
//        ),        
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Product Image effect', 'pikoworks_core' ),
            'param_name'    => 'product_img',
            'value' => array(
                esc_html__('None', 'pikoworks_core') => 'none',
                esc_html__('Rollover', 'pikoworks_core') => 'rollover',        
            ),
            'std'           => 'none',
            "admin_label" => true,
            'dependency' => array('element'   => 'tabs_type', 'value'     => array('1','2')),
        ),
        array(
            "type"        => "dropdown",
            "heading"     => esc_html__('Distance between 2 item', 'pikoworks_core'),
            "param_name"  => "no_gutters",
            'value' => array(
                esc_html__('Default', 'pikoworks_core') => '',
                esc_html__('0px', 'pikoworks_core') => 'no-gutters',
                esc_html__('5px', 'pikoworks_core') => 'gutters5',        
                esc_html__('7px', 'pikoworks_core') => 'gutters7',        
            ),
            'std'         => 'gutters5',
            'dependency' => array('element'   => 'tabs_type', 'value'     => array('1','2')),
        ),
        array(
            "type"        => "pikoworks_number",
            "heading"     => esc_html__( "Product Load", 'pikoworks_core' ),
            "param_name"  => "per_page",
            'std'         => 6,
            'description' => esc_html__( 'NB:-1 is available product load in this section', 'pikoworks_core' )
        ),               
//        array(
//            'type'  => 'dropdown',
//            'value' => array(
//                esc_html__( 'No', 'pikoworks_core' )  => false,
//                esc_html__( 'Yes', 'pikoworks_core' ) => true,
//            ),
//            'heading'     => esc_html__( 'Enable AJAX', 'pikoworks_core' ),
//            'param_name'  => 'ajax',
//            'admin_label' => true,
//	),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Tabs After menu type', 'pikoworks_core' ),
            'param_name'    => 'tab_cat_by',
            'value' => array(
                esc_html__('Product Cat', 'pikoworks_core') => 'product_cat',
                esc_html__('Product Band', 'pikoworks_core') => $brand                 
            )
        ),
        array(
            "type"        => "pikoworks_taxonomy",
            "taxonomy"    => "product_cat",
            "heading"     => esc_html__("Display Product Category menu", 'pikoworks_core'),
            "description" => esc_html__('Showing tab bottom area if empty nothing show', 'pikoworks_core'), 
            "param_name"  => "tab_cat",
            "value"       => '',
            'parent'      => '',
            'multiple'    => true,
            'hide_empty'  => false,
            'placeholder' => esc_html__('Choose categoy', 'pikoworks_core'),
            'dependency' => array('element'   => 'tab_cat_by', 'value'     => array( 'product_cat')),
        ),
        array(
            "type"        => "pikoworks_taxonomy",
            "taxonomy"    => $brand,
            "heading"     => esc_html__("Display product Brand menu", 'pikoworks_core'),
            "description" => esc_html__('Showing tab bottom area if empty nothing show', 'pikoworks_core'), 
            "param_name"  => "brand_cat",
            "value"       => '',
            'parent'      => '',
            'multiple'    => true,
            'hide_empty'  => false,
            'placeholder' => esc_html__('Choose brand categoy', 'pikoworks_core'),
            'dependency' => array('element'   => 'tab_cat_by', 'value'     => array( $brand)),
        ),
        array(
            "type" => "colorpicker",
            "heading" => __( "Category menu bg color", "pikoworks_core" ),
            "param_name" => "catbg_color",
            "value" => '#f8981d',
         ),
        array(
            "type" => "colorpicker",
            "heading" => __( "Font color", "pikoworks_core" ),
            "param_name" => "catbg_font_color",
            "value" => '',
         ),
        array(
            'type'        => 'css_editor',
            'heading'     => esc_html__( 'Css', 'pikoworks_core' ),
            'param_name'  => 'css',
            'group'       => esc_html__( 'Design options', 'pikoworks_core' ),
            'admin_label' => false,
	),        
        
    ),
    pikoworks_get_slider_params_enable()),       
    "js_view" => 'VcColumnView'
);

vc_map($params);
vc_map( array(
    "name"            => esc_html__("Section Tab", 'pikoworks_core'),
    "base"            => "tab_section",
    "content_element" => true,
    "as_child"        => array('only' => 'tabs_product'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params"          => array(
        // add params same as with any other content element
         array(
            "type"        => "dropdown",
            "heading"     => esc_html__("Panel Type", 'pikoworks_core'),
            "param_name"  => "heading_icon",
            "admin_label" => true,
            'value'       => array(
                esc_html__( 'None', 'pikoworks_core' ) => 'none',
                esc_html__( 'Font Awesome icon', 'pikoworks_core' ) => 'awesome',
                esc_html__( 'Font piko icon', 'pikoworks_core' ) => 'fontpiko',
                esc_html__( 'Custom Image icon', 'pikoworks_core' ) => 'image_icon',                
            ),
            'description' => esc_html__( 'Heading icon show before Title', 'pikoworks_core' ),
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Header Title", 'pikoworks_core' ),
            "param_name"  => "header",
            "std" => "Tab Name",
            'description' => esc_html__( 'If Empty nothing show title', 'pikoworks_core' ),
        ),
        array(
            'type' => 'iconpicker',
            'param_name' => 'block_icon',
            'heading' => esc_html__('Icon', 'pikoworks_core'),
            "dependency"  => array("element" => "heading_icon", "value" => array('awesome')),
        ),
        array(
            'type' => 'iconpicker',
            'param_name' => 'fontpiko_icon',
            'heading' => esc_html__('icon', 'pikoworks_core'),
            'settings' => array(
                    'emptyIcon' => true, // default true, display an "EMPTY" icon?
                    'type' => 'fontpiko',
                    'iconsPerPage' => 1000, // default 100, how many icons per/page to display
            ),
            'dependency' => array('element' => 'heading_icon', 'value' => 'fontpiko'),

        ),
        array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Custom image Icon', 'pikoworks_core' ),
            'param_name'  => 'custom_icon',
            'dependency'  => array('element' => 'heading_icon','value' => array('image_icon')),
            'description' => esc_html__( 'Setup custome image icon .png formate, size: 32x32px', 'pikoworks_core' ),
    	),        
        array(
            "type"        => "dropdown",
            "heading"     => esc_html__("Section Type", 'pikoworks_core'),
            "param_name"  => "section_type",
            "admin_label" => true,
            'std'         => 'best-seller',
            'value'       => array(
        	esc_html__( 'Best Sellers', 'pikoworks_core' ) => 'best-seller',
                esc_html__( 'Most Reviews', 'pikoworks_core' ) => 'most-review',
                esc_html__( 'New Arrivals', 'pikoworks_core' ) => 'new-arrival',
                esc_html__( 'Featured', 'pikoworks_core' )     => 'featured',
                esc_html__( 'On Sales', 'pikoworks_core' )     => 'on-sales',
                esc_html__( 'By Ids', 'pikoworks_core' )       => 'by-ids',
                esc_html__( 'Category', 'pikoworks_core' )     => 'category',
                esc_html__( 'Custom', 'pikoworks_core' )       => 'custom'
        	),
        ),
        array(
            "type"        => "pikoworks_taxonomy",
            "taxonomy"    => "product_cat",
            "heading"     => esc_html__("Display product certain category", 'pikoworks_core'),
            "param_name"  => "section_cate",
            "value"       => '',
            'parent'      => '',
            'multiple'    => true,
            'hide_empty'  => false,
            'placeholder' => esc_html__('Choose categoy', 'pikoworks_core'),
            "dependency"  => array("element" => "section_type", "value" => array('category')),
        ), 
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Order by", 'pikoworks_core'),
            "param_name" => "orderby",
            "value"      => array(
                esc_html__('None', 'pikoworks_core')       => 'none',
                esc_html__('ID', 'pikoworks_core')         => 'ID',
                esc_html__('Author', 'pikoworks_core')     => 'author',
                esc_html__('Name', 'pikoworks_core')       => 'name',
                esc_html__('Date', 'pikoworks_core')       => 'date',
                esc_html__('Modified', 'pikoworks_core')   => 'modified',
                esc_html__('Rand', 'pikoworks_core')       => 'rand',
                esc_html__('Sale Price', 'pikoworks_core') => '_sale_price'
        	),
            'std'         => 'date',
            "description" => esc_html__("Select how to sort retrieved posts.",'pikoworks_core'),
            "dependency"  => array("element" => "section_type", "value" => array('custom', 'on-sales', 'category')),
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Ids", 'pikoworks_core' ),
            "param_name"  => "ids",
            "admin_label" => true,
            "description" => esc_html__("Get product by list ids.( Input IDs which separated by a comma ',' )",'pikoworks_core'),
            "dependency"  => array("element" => "section_type", "value" => array( 'by-ids' ) ),
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Order", 'pikoworks_core'),
            "param_name" => "order",
            "value"      => array(
                esc_html__('ASC', 'pikoworks_core')  => 'ASC',
                esc_html__('DESC', 'pikoworks_core') => 'DESC'
        	),
            'std'         => 'DESC',
            "description" => esc_html__("Designates the ascending or descending order.",'pikoworks_core'),
            "dependency"  => array("element" => "section_type", "value" => array('custom', 'on-sales', 'category')),
        ),
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Extra class name", "pikoworks_core" ),
            "param_name"  => "el_class",
            "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks_core" ),
            'admin_label' => false,
        ),
    )
) );

}
class WPBakeryShortCode_Tabs_Product extends WPBakeryShortCodesContainer {
    
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'tabs_product', $atts ) : $atts;
        extract( shortcode_atts( array(            
            'bg_gray' => '',
            'tab_vertical' => '',
            'tabs_title_open' => '',
            'tabs_title' => '',
            'tabs_icon' => '',
            'block_icon' => '',
            'fontpiko_icon' => '',
            'custom_icon' => '',
            
            'panel_layout' => '',
            'product_grid' => 'grid',
            'thumb_align' => '',
            'category_layout' => '1',
            'tabs_type' => '1',
            'per_page'       => '6',
            'category'       => 0,
            'term_link'     => '',
           
            'tabs_panels' => 'yes',
            'tabs_panels_align' => '', 
            'product_img' => 'none',
            'no_gutters' => 'gutters5', 
            
            'images'     => '',            
            'ajax'      => false,
            'tab_cat_by'   => 'product_cat',
            'tab_cat'   => '',
            'brand_cat'   => '',
            'catbg_color'   => '',
            'catbg_font_color'   => '',
            
            //Carousel  
            'use_responsive' => '1',
            'is_slider' => '',                  
            'slides_scroll' => "",
            'autoplay'      => "false",
            'loop'          => "false",
            'navigation'    => "true",
            'navigation_btn' => '',
            'btn_hover_show'    => '',
            'btn_light'    => '',            
            'dots'         => "false",
            'margin'       => '',
            'items_very_large_device'   => 6,
            'items_large_device'   => 4,
            'items_mobile_device'   => 1,

            'el_class'     =>  '',
            'css' => ''    
            
        ), $atts ) );
        
        global $woocommerce_loop;
        $item_cols = '';
        if($use_responsive == '1'){
            $item_cols= 'columns-'.  $items_very_large_device;
        }
       
        $css_class = 'p-cats-tab-' . $category_layout.' type-tab-' .$tabs_type.' s-item-'.$use_responsive. ' '.  $item_cols. ' '.$bg_gray.' '.$thumb_align.' ' .$tab_vertical.' '. $el_class ;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;
        
        $tabs = pikoworks_core_get_all_attributes( 'tab_section', $content );
            
        
        if( count( $tabs ) > 0 ):
            $id = uniqid($category);
        
            $id_tab_fitler = '.tab-' . $id . '-' . 0;

            $col_lg = round(12/$items_large_device);                                
            if($items_large_device == '4'){
              $col_md =  ($col_lg + 1);  
            }elseif($items_large_device == '3'){
                $col_md =  ($col_lg + 2); 
            }elseif($items_large_device == '6'){
                $col_md =  ($col_lg + 1); 
            }else{
                $col_md =  $col_lg; 
            }                                

            if( ! pikoworks_is_mobile() ){ 
                $col_class[] = 'col-xl-'.round(12/$items_very_large_device);
                $col_class[] = 'col-lg-'.$col_lg;
                $col_class[] = 'col-md-'.$col_md;
                $col_class[] = 'col-sm-6';
                $col_class = esc_attr( implode(' ', $col_class) );

            }
            
            //    for mobile 2 cloumn
            $row_mobile =  '';
            if($items_mobile_device == '2'){
                $row_mobile = 'mobile';
            }


            $no_gap = $no_gutters;
            if($no_gutters == ''){
                $no_gap = 'sip';
            }

             $slide_before = $slide_after = $slide_class = $data_masonry = $data_slick = $data_filter_dot = $tabs_slide = $list_class = $slides_scroll_lg = '';

            if($slides_scroll != 1 && !pikoworks_is_mobile()){
                $slides_scroll_lg = ',"slidesToScroll": '. esc_attr($items_large_device);
            }

            if($is_slider == 'yes' || pikoworks_is_mobile() && !pikoworks_is_tablet()){
                $col_class = '';
                $tabs_slide = 'fix-p-hover';
                $data_class = 'piko-tab-slide hsc ' . $no_gap . ' ' .$row_mobile;
                $slide_class = 'piko-carousel ' . ' ' . $navigation_btn . ' ' . $btn_light. ' ' . $btn_hover_show.' '.$margin; 

                $res_large = $use_responsive ? '"slidesToShow":'.esc_attr($items_very_large_device).', "slidesToScroll": '.esc_attr($slides_scroll).',' : '';
                $res_media = $use_responsive ? '"responsive":[{"breakpoint": 1200,"settings":{"slidesToShow":'.esc_attr($items_very_large_device).'}},{"breakpoint": 992,"settings":{"slidesToShow":'.esc_attr($items_large_device . $slides_scroll_lg ).'}},{"breakpoint": 768,"settings":{"slidesToShow": 2,"slidesToScroll": 1}},{"breakpoint": 576,"settings":{"slidesToShow":  '.esc_attr($items_mobile_device).', "slidesToScroll": 1}}]' : '';

                $data_slick = '{'.$res_large.'"arrows":'.esc_attr($navigation).',"dots":'.esc_attr($dots).',"infinite":'.esc_attr($loop).',"autoplay":'.esc_attr($autoplay).','.$res_media.'}'; 

                if(pikoworks_is_mobile() && !pikoworks_is_tablet()){
                    $data_slick = '{'.$res_large.'"arrows":false,"dots":true,"infinite":'.esc_attr($loop).',"autoplay":'.esc_attr($autoplay).','.$res_media.'}'; 
                }
                
                $slide_before = "<div class='" . esc_attr($slide_class) . "' data-slick='" .  $data_slick ."'>";
                $slide_after  = '</div>';
            }else{
                $data_class = 'piko-masonry row '. $no_gutters . ' ' .$row_mobile;
                $data_filter_dot = '.';
                $data_masonry = 'data-masonry=\'{"selector":".product", "layoutMode":"fitRows", "filter":"'.esc_attr($id_tab_fitler).'" ,"columnWidth":".product"' . ( is_rtl() ? ',"rtl": true' : ',"rtl": false' ) . '}\'';
            
            }
            
            if( $product_grid == 'list' && ! pikoworks_is_mobile()){
                $list_class = 'p_list';
            }        
        
            $term = get_term( $category, 'product_cat' );
            
            if( file_exists( PIKOWORKSCORE_CORE . 'js_composer/includes/tab-1.php' ) ){
                
                $args = array(
                   'hierarchical'     => 1,
                   'show_option_none' => '',
                   'hide_empty'       => 0,
                   'taxonomy'         => 'product_cat'
                );
                
                if( ! is_wp_error( $term ) && $term ){
                    $args [ 'parent' ] = $term->term_id;
                    $term_link = get_term_link( $term );
                }else{
                    $term = false;
                }
                
                $subcats = get_categories($args);
                
               
                ob_start();
                
                @include( PIKOWORKSCORE_CORE . 'js_composer/includes/tab-1.php' );
                return ob_get_clean();
            }
        endif;
    }
}

function pikoworks_core_generate_tabs($id, $term_id = 0, $per_page = 6, $tabs = array(), $ajax = false,$data_filter_dot, $items_very_large_device = 4 ){   
    foreach( $tabs as $i => $tab ): $class = ""; ?>
        <?php
            extract( shortcode_atts( array(
                'heading_icon' => 'title',
                'header'       => '',
                'block_icon' => '',
                'fontpiko_icon' => '',
                'custom_icon' => '',                
                'section_type' => 'best-seller',
                'section_cate' => '',
                'orderby'      => 'date',
                'order'        => 'DESC',
                'ids'          => '',                
            ), $tab ) );
              
            
        ?>
        <?php if( $i == 0 ): $class .= ' active'; endif; ?>
        <?php if( $ajax ): 
            if(empty($header)){
                return;
            }             
        ?>
            <?php if( $i != 0 ): $class .= ' enable_ajax'; endif; ?>
            <li class="<?php echo esc_attr( $class ) ?>" data-number_column="<?php echo esc_attr($items_very_large_device); ?>" data-bannerleft="<?php echo esc_attr( $banner_left ) ?>" data-per_page="<?php echo esc_attr( $per_page ) ?>"   data-section_type="<?php echo esc_attr( $section_type ) ?>" data-ids="<?php echo esc_attr( $ids ) ?>" data-order="<?php echo esc_attr( $order ) ?>" data-orderby="<?php esc_attr( $orderby ) ?>"  data-section_cate="<?php echo esc_attr( $section_cate ) ?>" data-term="<?php echo esc_attr( $term_id ) ?>">
        <?php else: 
            if($ajax == false):
            if(empty($header)){
                return;
            }    
            ?>
            <li>
        <?php endif; ?>
               
            <a class="db f_s17 f_w5 <?php echo esc_attr( $class ) ?>" data-filter="<?php echo esc_attr( $data_filter_dot .'tab-'. $id . '-' . $i) ?>" href="javascript:void(0);">
                <?php
                if($heading_icon == 'awesome'){
                   echo '<span class="panel-img ' . esc_attr( $block_icon ) . '"></span>'; 
                }elseif($heading_icon == 'fontpiko'){
                   echo '<span class="panel-img ' . esc_attr( $fontpiko_icon ) . '"></span>'; 
                }else{
                    $thumbnail = wp_get_attachment_image( $custom_icon, 'full', '', array( "class" => "panel-img" ));
                    echo balanceTags($thumbnail);
                }                 
                echo '<span class="panel-text"> ' . esc_html( $header ) . '</span>'; 
                
                ?>                
            </a>
        </li>
    <?php
    endif; //end header
    endforeach;
}

/**
 * Handle request then generate response using WP_Ajax_Response
 * 
*/
function pikoworks_core_tab_part1( $products, $id, $class = "", $col_class, $category_layout, $slide_before, $slide_after,$product_grid,$product_img,$tabs_type){    
    echo balanceTags($slide_before); 
    $post_count = 0;
    if ( $products->have_posts() ) : ?>
            <?php while ( $products->have_posts() ) : $products->the_post();           
            $post_count++; 
            if($tabs_type == '2'){
                $col_class = "grid-size";
                if($post_count == '2'){ // == fixed layout one
                    $col_class = "grid-size-two";
                    remove_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_template_loop_product_thumbnail', 10 );
                    add_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_template_loop_product_thumbnail_2x', 10 );                                            
                }else{
                   remove_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_template_loop_product_thumbnail_2x', 10 );
                   add_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_template_loop_product_thumbnail', 10 );
                }
            }else{
              if($product_img == 'rollover'){
                    remove_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_template_loop_product_thumbnail', 10 );
                    add_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_template_loop_product_thumbnail_rollover', 10 );
                }else{
//                    remove_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_template_loop_product_thumbnail', 10 );
//                    add_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_template_loop_product_thumbnail_single', 10 ); 
                }              
            }
            ?>
            <article <?php post_class($col_class . ' '. $id); ?> data-slick-tab="<?php esc_attr_e($id); ?>">
                 <div class="product-wrap pl-<?php echo esc_attr($category_layout); ?>">                                                    
                    <?php 
                    if($tabs_type == '3'){
                        if( $product_grid == 'list'){ 
                            wc_get_template_part( 'vc-tabs-list', 'product-deals' );
                         }else{
                            wc_get_template_part( 'vc-tabs', 'produt-deals' );
                         }                        
                    } else {
                        if( $product_grid == 'list' && ! pikoworks_is_mobile()){ 
                            wc_get_template_part( 'vc-tabs-list', 'product' );
                         }else{
                            wc_get_template_part( 'vc-tabs', 'product' );   
                         }                        
                    }
                    
                    
                     
                    ?>                                                        
                </div>
            </article>
            <?php endwhile; // end of the loop. ?>
        
    <?php endif;
    wp_reset_query();
    wp_reset_postdata();
    echo balanceTags($slide_after );
}
/**
 * Execute query to get  product
 * 
 * @param $tab array all the setting of section tab
 * @param $term int term_id unique tab
 * @param $meta_query array default empty array
 * @param $per_page int default 5
 * @param $atts array shortcode setting default empty array
 * @return $products array
 * */
function pikoworks_single_tab_products( $tab , $term, $meta_query = array(), $per_page = 6, $atts = array() ){             
    $newargs = array(
        'post_type'	=> 'product',
        'post_status'	=> 'publish',
        'ignore_sticky_posts'	=> 1,
        'posts_per_page' => esc_attr($per_page),
        'meta_query' 	=> $meta_query,
        'suppress_filter'       => true
	);
    if( $term ){
        $newargs [ 'tax_query' ] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $term,
                'operator' => 'IN'
            )
        );
    }
    extract( shortcode_atts( array(
        'header'       => 'Tab Name',
        'section_type' => 'best-seller',
        'section_cate' => '',
        'orderby'      => 'date',
        'order'        => 'DESC',
        'ids'          => ''
    ), $tab ) );
    
    if( $section_type == 'new-arrival' ){
        $newargs['orderby'] = 'date';
        $newargs['order'] 	 = 'DESC';
    }elseif( $section_type == 'featured' ){   
        $product_visibility_term_ids = wc_get_product_visibility_term_ids();
        $newargs = array(            
            'no_found_rows'  => 1,
            'tax_query'      => array(
                    'relation' => 'AND',
                array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'term_taxonomy_id',
                        'terms'    => $product_visibility_term_ids['featured'],
                ),
            ),
	);
    }elseif( $section_type == 'on-sales' ){
        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $product_ids_on_sale[]  = 0;
	$newargs['post__in'] = $product_ids_on_sale;
        
        if( $orderby == '_sale_price' ){
            $orderby = 'date';
            $order   = 'DESC';
        }
        $newargs['orderby'] = esc_attr($orderby);
        $newargs['order'] 	= esc_attr($order);
    }elseif( $section_type == 'custom' ){
        if( $orderby == '_sale_price' ){
            $newargs['meta_query'] = array(
                'relation' => 'OR',
                array( // Simple products type
                    'key'           => '_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                ),
                array( // Variable products type
                    'key'           => '_min_variation_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            );
        }else{
            $newargs['orderby'] = esc_attr($orderby);
            $newargs['order'] 	= esc_attr($order);
        }
    }elseif( $section_type == 'most-review'){
        add_filter( 'posts_clauses', 'pikoworks_core_order_by_rating_post_clauses' );
    }elseif( $section_type == 'category' ){
        $chil_term = get_term( $section_cate, 'product_cat' );

        if( $section_cate ){
            $newargs['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => explode( ",", $section_cate )
                ),
            );
        }
        if( $orderby == '_sale_price' ){
            $newargs['meta_query'] = array(
                'relation' => 'OR',
                array( // Simple products type
                    'key'           => '_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                ),
                array( // Variable products type
                    'key'           => '_min_variation_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            );
        }else{
            $newargs['orderby'] = esc_attr($orderby);
            $newargs['order'] 	= esc_attr($order);
        }
    }elseif( $section_type == 'by-ids' && $ids ){
        $newargs['post__in'] = explode( ',', $ids );
        $newargs['orderby'] = 'ID';
    }else{
        $newargs['meta_key'] = 'total_sales';
        $newargs['orderby']  = 'meta_value_num';
    }
    $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $newargs, $atts ) );
    
    if( $section_type == 'most-review'){
        remove_filter( 'posts_clauses', 'pikoworks_core_order_by_rating_post_clauses' );
    }
    return $products;
}
function pikoworks_core_products_on_sale_in_category( $term_id = 0,$per_page = 6 ){
    $product_ids_on_sale = wc_get_product_ids_on_sale();
    $product_ids_on_sale[]  = 0;
    $deal_args = array(
    	'posts_per_page'    => esc_attr($per_page),
        'post_type'         => 'product',
        'orderby'           => 'date',
        'order'             => 'DESC',
    	'post_status'       => 'publish',
    	'meta_query'        => $meta_query,
    	'post__in'  => $product_ids_on_sale
    );
    if( $term_id ){
        $deal_args [ 'tax_query' ] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $term_id,
                'operator' => 'IN'
            )
        );
    }
    $deal_product = new WP_Query( $deal_args );
    if( $deal_product->have_posts() ){
        while($deal_product->have_posts()): $deal_product->the_post();
            wc_get_template_part( 'content', 'tab-category-deal' );
        endwhile;
    }
}
/**
 * order_by_rating_post_clauses function.
 *
 * @access public
 * @param array $args
 * @return array
 */
function pikoworks_core_order_by_rating_post_clauses( $args ) {
	global $wpdb;

	$args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";

	$args['where'] .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";

	$args['join'] .= "
		LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
		LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
	";

	$args['orderby'] = "average_rating DESC, $wpdb->posts.post_date DESC";

	$args['groupby'] = "$wpdb->posts.ID";

	return $args;
}