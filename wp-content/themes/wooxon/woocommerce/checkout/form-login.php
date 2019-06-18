<?php
/**
 * Checkout login form | edit print notice
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

echo '<div class="piko_checkout_login f_s18 f_w5 c_s2 t_c">'. __( 'Returning customer?', 'woocommerce' ) . ' <a href="#" class="showlogin">' . __( 'Click here to login', 'woocommerce' ) . '</a>' .'</div>';
woocommerce_login_form(
	array(
		'message'  => __( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
		'redirect' => wc_get_page_permalink( 'checkout' ),
		'hidden'   => true,
	)
);


/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
