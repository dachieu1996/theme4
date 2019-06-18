<?php
/**
 * @author themepiko
 * @vc product tabs deals
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}
/**
 * woocommerce hook.
 */
do_action( 'woocommerce_before_shop_loop_item' );
wooxon_wc_template_quick_view_product_thumbnail_carousel();
wooxon_wc_template_quick_view_product_thumbnail();
echo '<div class="deals">';
echo '<span class="db pb10 t_c">' .esc_html__('Don\'t Waste Time! Offer Valid:', 'wooxon').'</span>';
wooxon_wc_template_loop_product_coundown();
wooxon_woo_deal_progress_bar();
echo '</div>';
wooxon_wc_template_loop_product_title();
echo '<div class="product-bottom">';
wooxon_wc_template_loop_product_price();
echo '</div>';
do_action( 'woocommerce_after_shop_loop_item' );

?>
	
