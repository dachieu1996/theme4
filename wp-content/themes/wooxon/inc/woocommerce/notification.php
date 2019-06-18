<?php
if ( ! defined( 'ABSPATH' ) ) { exit;} // Exit if accessed directly

/* 
 * custom notification intrigation;
 * 
 */
if( wooxon_get_option_data('notification_mode', 1) ) {
	add_filter('wc_add_to_cart_message_html', 'wooxon_notify_add_to_cart', 10, 2);
	function wooxon_notify_add_to_cart( $message, $product_id) {
		$img = false;

		if (isset($_POST['variation_id'])) {
			$id = $_POST['variation_id'];
			$img = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'shop_catalog' );
		}                

		if ($img === false || empty($img)) {
			$img = wp_get_attachment_image_src( get_post_thumbnail_id(key($product_id)), 'shop_catalog' );
		}


		$img_url = $img[0];

		$added_to_cart = '<div class="notify_w"><img class="notfy_img" src="'.esc_url($img_url).'" alt="'.esc_attr(the_title_attribute()).'"/><div class="notify-text f_s13 lh_2">'.$message.'</div></div>';
		return $added_to_cart;
	}
}
/* 
 * success * 
 */

add_filter('woocommerce_add_success', 'wooxon_notify_add_success', 10, 1);
function wooxon_notify_add_success($message) {
	if (strpos($message, 'notfy_img') === false):
		return '<div class="notify_w d_t"><div class="notfy_img f_s25 pt20"><i class="fa fa-bell c_w" aria-hidden="true"></i></div><div class="notify-text f_s13 lh_2 d_tc">'.$message.'</div></div>';
	else:
		return $message;
	endif;
}
/* 
 * notice * 
 */
add_filter('woocommerce_add_notice', 'wooxon_notify_add_notice', 10, 1);
function wooxon_notify_add_notice($message) {
	if (strpos($message, 'notfy_img') === false):
		return '<div class="notify_w d_t"><div class="notfy_img f_s25 db pt20"><i class="fa fa-bell c_w" aria-hidden="true"></i></div><div class="notify-text f_s13 lh_2 d_tc">'.$message.'</div></div>';
	else:
	endif;
}