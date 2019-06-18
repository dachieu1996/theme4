<?php
/**
 * Checkout coupon form | eidt print notice
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

echo '<div class="piko_checkout_coupon f_s18 f_w5 c_s2 t_c">'. __( 'Have a coupon?', 'woocommerce' ).' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a></div>'

?>
    <form class="checkout_coupon" method="post" style="display:none">
            <p class="mb0"><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></p>
            <p class="form-row form-row-first d_flex pt20">
                    <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
                    <button type="submit" class="button c_w f_s20" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><span class="icon-arrow-long-right"></span></button>

            </p>
    </form>

