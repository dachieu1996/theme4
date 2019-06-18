<?php
/**
 * @author themepiko
 * @vc product tabs list
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

do_action( 'woocommerce_before_shop_loop_item' );
echo '<div class="d_flex"><div class="media-list">';
wooxon_wc_template_loop_product_thumbnail();
echo '</div><div>';
do_action( 'wooxon_after_shop_loop_item_title' );
echo '</div></div>';
do_action( 'woocommerce_after_shop_loop_item' );

?>
	
