<?php
/**
 * @author  themepiko
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'vc_before_init', 'pikoworks_core_popular_category' );
function pikoworks_core_popular_category(){
 
vc_map( array(
     "name"        => esc_html__( "Popular Category", 'pikoworks-core'),
     "base"        => "popular_category",
     "icon" => get_template_directory_uri() . "/assets/images/logo/vc-icon.png",
     "category"    => esc_html__('Pikoworks', 'pikoworks-core' ),
     "description" => esc_html__( "Display popular category", 'pikoworks-core'),
     "params"      => array(
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Title", 'pikoworks-core' ),
            "param_name"  => "title",
            "admin_label" => true,
        ),
        array(
            "type"        => "dropdown",
            "heading"     => esc_html__("Type", 'pikoworks-core'),
            "param_name"  => "type",
            "admin_label" => true,
            'std'         => 'style-1',
            'value'       => array(
        	esc_html__( 'Style 1', 'pikoworks-core' )    => 'style-1',
                esc_html__( 'Style 2', 'pikoworks-core' )    => 'style-2',
                esc_html__( 'Style 3', 'pikoworks-core' )    => 'style-3',
        	),
        ), 
        array(
            'type'        => 'attach_image',
            'heading'     => esc_html__( 'Box background', 'pikoworks-core' ),
            'param_name'  => 'box_background',
            "dependency"  => array("element" => "type","value" => array('style-2', 'style-3')),
            'description' => esc_html__( 'Setup background for the box', 'pikoworks-core' )
        ),
        array(
            "type"        => "pikoworks_taxonomy",
            "taxonomy"    => "product_cat",
            "heading"     => esc_html__("Category", 'pikoworks-core'),
            "param_name"  => "taxonomy",
            "value"       => '',
            'parent'      => 0,
            'multiple'    => false,
            'placeholder' => esc_html__('Choose categoy', 'pikoworks-core'),
            "description" => esc_html__("Note: If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'pikoworks-core')
        ),        
        array(
            "type"        => "textfield",
            "heading"     => esc_html__( "Number Child Category", 'pikoworks-core' ),
            "param_name"  => "per_page",
            'std'         => 5,
            "admin_label" => false,
            'description' => esc_html__( 'Number child category be showed', 'pikoworks-core' )
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
            'std'         => 'date',
            "description" => esc_html__("Select how to sort retrieved posts.",'pikoworks-core'),
        ),
        array(
            "type"       => "dropdown",
            "heading"    => esc_html__("Order", 'pikoworks-core'),
            "param_name" => "order",
            "value"      => array(
                esc_html__( 'Descending', 'pikoworks-core' ) => 'desc',
                esc_html__( 'Ascending', 'pikoworks-core' )  => 'asc'
        	),
            'std'         => 'DESC',
            "description" => esc_html__("Designates the ascending or descending order.", 'pikoworks-core')
        ),
        array(
            'type'          => 'dropdown',
            'heading'       => esc_html__( 'Show Read More Button', 'pikoworks-core' ),
            'param_name'    => 'show_read_more_btn',
            'value' => array(
                esc_html__( 'Yes', 'pikoworks-core' ) => 'yes',
                esc_html__( 'No', 'pikoworks-core' ) => 'no',	    
            ),
            'admin_label' => true, 
            'std'           => 'yes',
        ),
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__( 'Read More Button Text', 'pikoworks-core' ),
            'param_name'    => 'read_more_text',
            'std'           => esc_html__( 'View More', 'pikoworks-core' ),
            'admin_label' => true, 
            'dependency' => array(
                            'element'   => 'show_read_more_btn',
                            'value'     => array( 'yes' ),
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
            //'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks-core' ),
            'group'          => esc_html__( 'Design options', 'pikoworks-core' ),
            'admin_label'    => false,
		),
        
    )
));
}

class WPBakeryShortCode_Popular_Category extends WPBakeryShortCode {
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'popular_category', $atts ) : $atts;
        extract( shortcode_atts( array(
            'title'         => '',
            'type'          => 'style-1',
            'box_background'=> 0,
            'taxonomy'      => '',
            'per_page'      => 5,
            'orderby'       => 'date',
            'order'         => 'desc',
            'show_read_more_btn'    =>  'yes',
            'read_more_text'    =>  '',
            'el_class'     =>  '',
            'css'           => '',           
        ), $atts ) );
        
        
        $css_class = 'sc-subcategory ' . $type . ' ' . $el_class;
        if ( function_exists( 'vc_shortcode_custom_css_class' ) ):
            $css_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), '', $atts );
        endif;
        
        ob_start();
        
        $term = get_term_by('slug', $taxonomy, 'product_cat');
        
        if( ! is_wp_error($term) && $term ):
            $link = get_term_link($term);
            
            $thumbnail_id = absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
    		
            if ( $thumbnail_id ) {
    			$image = wp_get_attachment_image_src( $thumbnail_id, 'full' );
                if( is_array($image) && isset($image[0]) && $image[0] ){
                    $image = $image[0];
                }else{
                    $image = "";
                }
    		} else {
    			$image = "";
    		}
            // get bg
            $bg = wp_get_attachment_image_src( $box_background, 'full');
            $args = array(
               'hierarchical'     => 1,
               'show_option_none' => '',
               'hide_empty'       => 0,
               'parent'           => $term->term_id,
               'taxonomy'         => 'product_cat',
               'number'           => esc_attr($per_page)
            );
            if( $bg ){
                $image = $bg[0];
            }
            $more_btn = '';
            if($show_read_more_btn == 'yes' && $type == 'style-3'){
                $more_btn = '<div class="dn db_lg col-lg-4"><a href=" ' . esc_url( $link ) . ' " class="f_w5 c_g h_l mt10 db">'. esc_attr($read_more_text) .'</a></div>';            

            }elseif($show_read_more_btn == 'yes'){
                $more_btn = '<a href=" ' . esc_url( $link ) . ' " class="f_w5 c_g h_l mt10 db">'. esc_attr($read_more_text) .'</a>';               
            }
            $cols = '4';
            if($show_read_more_btn != 'yes'){
                $cols = '6';
            }
            
            
            
            echo '<div class="'. esc_attr( $css_class ) . '">';
            $subcats = get_categories($args);
            if( $type == 'style-1' ): ?>                              
                    <div class="row gutters7">
                        <?php if( $image): ?>
                        <figure class="col-6 mb0">
                            <a href="<?php echo esc_url( $link ); ?>">
                                <img src="<?php echo esc_url( $image ) ?>" alt="<?php echo esc_attr( $term->name ) ?>" class="popular-cate-img" />
                            </a>
                        </figure>
                        <?php endif;?>
                        <div class="col-6">
                             <h4 class="mb5 f_w5 mt0 lh_2"><a href="<?php echo esc_url( $link ); ?>" class="c_s2"><?php echo  $title ? esc_html( $title ) : esc_html( $term->name ) ?></a></h4>
                             <div class="d_flex flex-column">
                                <?php foreach( $subcats as $cate ): ?>
                                    <?php $cate_link = get_term_link($cate); ?>
                                    <a href="<?php echo esc_url( $cate_link ); ?>" class="f_s14 c_g"><?php echo esc_html( $cate->name ) ?></a>
                                <?php endforeach; ?>
                            </div>
                            <?php echo balanceTags($more_btn); ?>
                        </div>                        
                    </div>
               
            <?php elseif( $type == 'style-2'): ?>
                    <div class="sub-category-img" style="background-image: url('<?php echo esc_url( $image ) ?>');">
                        <div class="d_flex flex-column">
                            <?php foreach( $subcats as $cate ): ?>
                                <?php $cate_link = get_term_link($cate); ?>
                                <a href="<?php echo esc_url( $cate_link ); ?>" class="f_s14 c_g pt5 pb5"><?php echo esc_html( $cate->name ) ?></a>
                            <?php endforeach; ?>
                        </div>
                        <?php echo balanceTags($more_btn); ?>
                    </div>
            <?php else: ?> 
                
                <?php if( $image): ?>
                <figure class="inner-img">
                    <a href="<?php echo esc_url( $link ); ?>">
                        <img src="<?php echo esc_url( $image ) ?>" alt="<?php echo esc_attr( $term->name ) ?>" class="popular-cate-img" />
                    </a>
                </figure>
                <?php endif;
                
                $index = 0;
                ?> 
                <div class="row align-items-center">                    
                    <div class="col-6 col-lg-<?php esc_attr_e($cols) ?>">
                        <?php foreach( $subcats as $cate ): ?>
                            <?php $cate_link = get_term_link($cate);                             
                            $index++;  ?>
                        
                            <a href="<?php echo esc_url( $cate_link ); ?>" class="f_s14 c_g pb5 db"><?php echo esc_html( $cate->name ) ?></a>
                            
                             <?php $cate_link = get_term_link($cate); 
                          
                            if ($index == 5){
                               echo '</div><div class="col-6 col-lg-'.esc_attr($cols).'">';
                            }       
                            ?>
                            
                            
                        <?php endforeach; ?>
                    </div>                    
                    <?php echo balanceTags($more_btn); ?>
                    
                </div>
                
            <?php  endif;
        echo '</div>';
        endif;
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
}