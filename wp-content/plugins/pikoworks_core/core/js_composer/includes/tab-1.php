<?php 
/**
 * @Tabs part
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$v_class = '';
if($tab_vertical = 'tab-vertical'){
    $v_class = 'cols-wrap';
}

$brand = 'product_cat';
if (defined('PIKOWORKS_PRODUCT_BRANDS_TAXONOMY') && taxonomy_exists(PIKOWORKS_PRODUCT_BRANDS_TAXONOMY)) {
    $brand = PIKOWORKS_PRODUCT_BRANDS_TAXONOMY;
}

?>
<div class="<?php echo esc_attr( $css_class.' '.$tabs_slide . ' ' .$list_class); ?>">    
    <?php  if($tabs_panels == 'yes'): ?>
        <ul class="tabs piko-filter ul-no d_flex justify-content-<?php echo esc_attr( $tabs_panels_align .' panel-'. $panel_layout); ?> mb30 mb20-sm pr" data-tab-ids="<?php esc_attr_e($id); ?>">
            <?php if($tabs_title_open == 'yes'): ?>
            <li class="tabs-title">
                <a class="db pr f_s19 f_w6 t_u t_nowrap c_s" href="javascript:void(0);">
            <?php                
               if($tabs_icon == 'awesome'){
                   echo '<span class="panel-img ' . esc_attr( $block_icon ) . '"></span>'; 
                }elseif($tabs_icon == 'fontpiko'){
                   echo '<span class="panel-img ' . esc_attr( $fontpiko_icon ) . '"></span>'; 
                }elseif($tabs_icon == 'image_icon'){
                    $thumbnail = wp_get_attachment_image( $custom_icon, 'full', '', array( "class" => "panel-img" ));
                    echo balanceTags($thumbnail);
                }
                 if($tabs_title != ''){echo '<span>'.esc_attr($tabs_title).'</span>';}
                ?>  
                </a>
            </li>
            <?php endif; ?>
            
            <?php  pikoworks_core_generate_tabs($id, $term->term_id, $per_page, $tabs, $ajax, $data_filter_dot ); ?>            
        </ul>
    <?php endif; ?>
    <?php  $meta_query = WC()->query->get_meta_query(); ?>
    <div class="<?php echo esc_attr( $v_class ) ?>">
    <div class="products <?php echo esc_attr( $data_class ) ?>" <?php echo balanceTags( $data_masonry ) ?>>
    <?php if( ! $ajax ): ?>
        <?php foreach( $tabs as $i => $tab ): 
            $products = pikoworks_single_tab_products( $tab, $term->term_id, $meta_query, $per_page, $atts); 

            $id_section_tab = 'tab-' . $id . '-' . $i;

            $class_section_tab = "";
            if( $i == 0 ){
                $class_section_tab = "active";
            }
            pikoworks_core_tab_part1( $products, $id_section_tab, $class_section_tab, $col_class, $category_layout, $slide_before, $slide_after,$product_grid,$product_img,$tabs_type )
        ?>

        <?php endforeach; ?>
    <?php else: ?>
        <?php if( isset( $tabs[0] ) && is_array( $tabs[0] ) && count( $tabs[0] ) > 0 ): ?>
            <?php $products = pikoworks_single_tab_products( $tabs[0], $term->term_id, $meta_query, $per_page, $atts ); ?>
            <?php pikoworks_core_tab_part1( $products, 'tab-' . $id . '-0', "active" );            
            
            ?>
        
        <?php endif; ?>
    <?php endif; ?>
    </div><!-- End .products -->
    
    <?php 
    if( $tab_cat != '' || $brand_cat != ''): 
        $args = array(
            'orderby'           => 'name', 
            'order'             => 'ASC'

        );
    if($tab_cat_by == $brand){
        $args['slug'] = explode( ",", $brand_cat );
    }else{
       $args['slug'] = explode( ",", $tab_cat );    
    }  

    $term_tabs_cat = get_terms($tab_cat_by, $args);    

$cat_bg = trim( $catbg_color ) != '' ? 'background-color:' . esc_attr( $catbg_color ) . ';' : '';
$font_color = trim( $catbg_font_color ) != '' ? 'color:' . esc_attr( $catbg_font_color ) . ';' : '';
$c_w = 'c_w';
if ( ( $cat_bg  || $font_color ) != '' ) {
    $cat_style = 'style="' .  esc_attr($cat_bg.$font_color) .  '"';
}
if ( $font_color != '' ) {
   $c_w = ''; 
}
    
          
    echo '<div class="tabs-menu" '.$cat_style.'>';
        foreach ($term_tabs_cat as $term_tab){
            echo '<a href="'. esc_url(get_term_link($term_tab)) .'" class="dib '.esc_attr($c_w).'">'. esc_attr($term_tab->name) .'</a>';
        }
    echo '</div>';
    endif;
    ?>
    </div><!-- End .products -->   
</div><!-- End tab-container -->

