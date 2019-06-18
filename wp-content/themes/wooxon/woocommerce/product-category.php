<?php
/**
 * @author themepiko
 * Product category* and brand
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
$enable_brand = wooxon_get_option_data('show_brand', '1');
$enable_show = wooxon_get_option_data('show_brand_name_achive', '1');

$brand = 'product_cat';
if (defined('PIKOWORKS_PRODUCT_BRANDS_TAXONOMY') && taxonomy_exists(PIKOWORKS_PRODUCT_BRANDS_TAXONOMY)) {
    $brand = PIKOWORKS_PRODUCT_BRANDS_TAXONOMY;
}    
 

?>
<div class="product_meta">
	<?php do_action( 'woocommerce_product_meta_start' ); ?>
	<?php    
            $terms = get_the_terms( $post->ID, $brand ); 
            if($enable_brand == 1 && $enable_show == 1 &&  is_array($terms) && !empty($terms) ){       
                foreach( $terms as $term ) {
                    echo '<a href="'.get_term_link($term->term_id).'">'.esc_attr($term->name).'</a>'; 
                }
            }else{                
                if(!class_exists( 'WC_Vendors' )){
                   echo  wc_get_product_category_list( $post->ID, ', ', '<span class="posted_in">', '</span>' );  
                }
            }
        ?>    
	<?php do_action( 'woocommerce_product_meta_end' ); ?>
</div>

