<?php
/**
 * Product Loop Start | edit
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

global $woocommerce_loop , $wp_rewrite , $wp_query;

$products_per_column = wooxon_get_option_data('optn_woo_products_per_row',3);
$per_row_mobile = wooxon_get_option_data( 'optn_woo_products_per_row_mobile', 1);
if($per_row_mobile == 2){
  $per_row_mobile  = 'mobile';
}

$mode_view = 'grid';
$class = '';

if( is_archive() || is_product_taxonomy() ){
	$mode_view = apply_filters('wooxon_filter_products_mode_view','grid');
}
$class = esc_attr($mode_view) . ' products-'.esc_attr($mode_view).' columns-'.esc_attr($products_per_column .' '. $per_row_mobile);

?>

<div class="<?php echo esc_attr($class)?>">