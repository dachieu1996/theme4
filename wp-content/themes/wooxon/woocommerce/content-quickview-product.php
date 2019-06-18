<?php
/**
 * The content-quickview-product.php template
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $quickview, $product;
$quickview = true;

if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
	$attachment_ids = $product->get_gallery_attachment_ids();
} else {
	$attachment_ids = $product->get_gallery_image_ids();
}
$attachment_count = count( $attachment_ids );

$gallery_less = ''; 
if ( !$attachment_ids ) {
   $gallery_less = 'gallery-less';
}

?>
<div id="product-<?php the_ID(); ?>" <?php post_class('product-quickview pr left'); ?>>
	<div class="row">
		<div class="col-xl-7 col-md-6 col-12 <?php echo esc_attr($gallery_less); ?>" style="transition: all .45s ease-in-out;">
			<?php do_action( 'woocommerce_quickview_before_thumbnail' ); 
			 do_action( 'woocommerce_before_single_product_summary' ); 		
			 do_action( 'woocommerce_quickview_after_thumbnail' ); ?>
		</div><!-- .end col -->		
		<div class="col-xl-5 col-md-6 col-12" style="transition: all .45s ease-in-out;">
			<?php do_action( 'woocommerce_quickview_before_summary' ); ?>
			<div class="content-quickview entry-summary product-details">
				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>
			</div><!-- .summary -->
			<?php do_action( 'woocommerce_quickview_after_summary' ); ?>
		</div><!-- .end col -->
	</div><!-- .row -->
</div><!-- .product-quickview -->