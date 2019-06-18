<?php
/**
 * @author  themepiko
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_categories_menu' );
function pikoworks_categories_menu(){
 
vc_map( array(
     "name"        => esc_html__( "Categories Menu", 'pikoworks_core'),
     "base"        => "categories_menu",
     "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
     "category"    => esc_html__('Pikoworks', 'pikoworks_core' ),
     "description" => esc_html__( "Display Product Categoris list", 'pikoworks_core'),
     "params"      => array(
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Title", 'pikoworks_core' ),
            "param_name"  => "title",
            "admin_label" => true,
        ),
        array(
            "type"        => "dropdown",
            "heading"     => esc_html__("Type Categories", 'pikoworks_core'),
            "param_name"  => "type",
            "admin_label" => true,
            'std'         => 'style-1',
            'value'       => array(
        	esc_html__( 'Style 1', 'pikoworks_core' )    => 'style-1',
                esc_html__( 'Style 2', 'pikoworks_core' )    => 'style-2',
        	),
            "description" => esc_html__("style1 all Category, Style 2 Choose category parent list", 'pikoworks_core'),
        ),
        
        array(
            "type"        => "pikoworks_taxonomy",
            "taxonomy"    => "product_cat",
            "heading"     => esc_html__("Category", 'pikoworks_core'),
            "param_name"  => "taxonomy",
            "value"       => '',
            'parent'      => 0,
            'multiple'    => false,
            'placeholder' => esc_html__('Choose categoy', 'pikoworks_core'),
            "description" => esc_html__("Note:select category(s) above. Only selected categories will be displayed.", 'pikoworks_core'),
            'dependency' => array('element' => 'type', 'value' => array( 'style-2' )),
        ),        
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Number Child Category", 'pikoworks_core' ),
            "param_name"  => "per_page",
            'std'         => 5,
            "admin_label" => false,
            'description' => esc_html__( 'Number child category be showed', 'pikoworks_core' ),
            'dependency' => array('element' => 'type', 'value' => array( 'style-2' )),
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Order by", 'pikoworks_core'),
            "param_name" => "orderby",
            "value"      => array(
                esc_html__('ID', 'pikoworks_core')       => 'ID',
                esc_html__('Name', 'pikoworks_core')     => 'name',
        	),
            'std'         => 'date',
            "description" => esc_html__("Select how to sort retrieved posts.",'pikoworks_core'),
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Order", 'pikoworks_core'),
            "param_name" => "order",
            "value"      => array(
                esc_html__( 'Descending', 'pikoworks_core' ) => 'desc',
                esc_html__( 'Ascending', 'pikoworks_core' )  => 'asc'
        	),
            'std'         => 'DESC',
            "description" => esc_html__("Designates the ascending or descending order.", 'pikoworks_core')
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Disable hierarchy", 'pikoworks_core'),
            "param_name" => "hierarchical",
            "value"      => array(
                esc_html__( 'Enable', 'pikoworks_core' ) => '1',
                esc_html__( 'Disable', 'pikoworks_core' )  => '0'
        	), 
            'dependency' => array('element' => 'type', 'value' => array( 'style-1' )),
            'group'          => esc_html__( 'Advanced Filder', 'pikoworks_core' ),
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Only show children of the current category", 'pikoworks_core'),
            "param_name" => "parent_cat",
            "value"      => array(
                esc_html__( 'No', 'pikoworks_core' ) => '',
                esc_html__( 'Yes', 'pikoworks_core' )  => '0'
        	),
            'dependency' => array('element' => 'type', 'value' => array( 'style-1' )),
            'group'          => esc_html__( 'Advanced Filder', 'pikoworks_core' ),
            
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Show Product counts", 'pikoworks_core'),
            "param_name" => "count",
            "value"      => array(
                esc_html__( 'No', 'pikoworks_core' ) => '0',
                esc_html__( 'Yes', 'pikoworks_core' )  => '1'
        	),
            'dependency' => array('element' => 'type', 'value' => array( 'style-1' )),
            'group'          => esc_html__( 'Advanced Filder', 'pikoworks_core' ),
        ),     
        array(
            'type'           => 'css_editor',
            'heading'        => esc_html__( 'Css', 'pikoworks_core' ),
            'param_name'     => 'css',
            //'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks_core' ),
            'group'          => esc_html__( 'Design options', 'pikoworks_core' ),
            'admin_label'    => false,
		),
        array(
                "type"        => "textfield",
                "heading"     => esc_html__( "Extra class name", 'pikoworks_core' ),
                "param_name"  => "el_class",
                "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks_core" ),
            ),    
        
    )
));
}

class WPBakeryShortCode_Categories_Menu extends WPBakeryShortCode {
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'categories_menu', $atts ) : $atts;
        extract( shortcode_atts( array(
            'title'         => '',
            'type'          => 'style-1',
            'taxonomy'      => '',
            'per_page'      => 5,
            'orderby'       => 'date',
            'order'         => 'desc',
            'hierarchical'  => '1',
            'count'  => '0',
            'parent_cat'    => ' ',
            'css'           => '',  
            'el_class'     =>  '',
        ), $atts ) );
        
        
        $css_class = 'cats-menu widget woocommerce widget_product_categories wow ' . $el_class . ' ' . $type;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;

        include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );
        ob_start(); ?>           
            
                <div class="<?php echo esc_attr( $css_class ) ?>" >
                   <?php if( $type == 'style-1' ): ?>
                    <h4 class="widget-title"><?php echo  esc_html( $title )  ?></h4>
                    <?php                    
                        $list_args  = array( //all cat
                            'show_count' => $count,
                            'hierarchical' => $hierarchical, 
                            'taxonomy' => 'product_cat', 
                            'hide_empty' => 0,
                            'order'     => $order,
                            'orderby'   => $orderby,
                            'parent'    => $parent_cat,
                            'title_li'  => '',
                            'walker'  => new WC_Product_Cat_List_Walker,
                            'current_category_ancestors'  => '',

                        ); 
                        echo '<ul class="product-categories">';
                          wp_list_categories( apply_filters( 'woocommerce_product_categories_widget_args', $list_args ) );
                        echo '</ul>';
                        else:?>
                        <?php                            
                            $term = get_term_by('slug', $taxonomy, 'product_cat');
                             if( ! is_wp_error($term) && $term ):                            
                                $link = get_term_link($term);           
                                    $args = array(//parent
                                       'hierarchical'     => 1,
                                       'show_option_none' => '',
                                       'hide_empty'       => 0,
                                       'parent'           => $term->term_id,
                                       'taxonomy'         => 'product_cat',
                                       'number'           => $per_page,
                                       'order'     => $order,
                                       'orderby'   => $orderby,
                                    );
                                 $subcats = get_terms( 'product_cat', $args );    
                                ?>
                            <h4 class="widget-title"><?php echo  $title ? esc_html( $title ) : esc_html( $term->name ) ?></h4>
                            <ul class="product-categories">
                                <?php foreach( $subcats as $cate ): ?>
                                    <?php $cate_link = get_term_link($cate); ?>
                                <li class="cat-item"><a href="<?php echo esc_url( $cate_link ); ?>"><?php echo esc_html( $cate->name ) ?></a></li>
                                <?php endforeach; ?>
                            </ul>                            
                            <?php 
                            endif; //is_wp_error
                        endif;//style1
                        
                    ?>                    
                </div>
        <?php   
        
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}