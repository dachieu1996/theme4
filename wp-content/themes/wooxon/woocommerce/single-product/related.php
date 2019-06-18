<?php
/**
 * Related Products || edit carousel
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$full_width = wooxon_get_option_data( 'main-width-content', 'container' );
$sidebar = wooxon_get_option_data( 'optn_product_single_sidebar_pos', 'fullwidth' );
$slide =  '6';
if($full_width == 'container' && $sidebar == 'fullwidth'){
    $slide = '4';
}elseif ($full_width == 'container' && $sidebar != 'fullwidth') {
    $slide = '3';
}
$per_row_mobile = wooxon_get_option_data( 'optn_woo_products_per_row_mobile', 1 );
$row_mobile= '';
if($per_row_mobile == 2){
    $row_mobile = 'mobile';
}

if ( $related_products ) : ?>    
    <div class="order-6">
	<section class="related products sip hsc mt90 mt50-sm mb50 mb30-md clearfix w-1380 <?php echo esc_attr($row_mobile) ?>">
            <h3 class="pa_ba h-line mb40"><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h3>
                        <div class="piko-carousel sh" data-slick='{"slidesToShow": <?php echo esc_attr($slide); ?>,"slidesToScroll": 1,"arrows": false,"responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 3}},{"breakpoint": 768,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": <?php echo esc_attr($per_row_mobile); ?>}}]}'>
			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>
                        </div>

	</section>
    </div>
<?php
wp_reset_postdata();

endif;


