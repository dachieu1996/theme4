<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
global $product;
$prefix = 'wooxon_';

$thumbnail =  get_post_meta(get_the_ID(), $prefix . 'single_products_thumbnail',true);
if (!isset($thumbnail) || $thumbnail == '-1' || $thumbnail == '') {
    $thumbnail = wooxon_get_option_data( 'optn_woo_single_products_thumbnail', 'bottom');
}
if( !$product->is_type( 'variable' ) ){
  add_action( 'woocommerce_after_add_to_cart_button', 'wooxon_wc_template_single_product_button_action' ); 
} 

$col_left = 'col-12 col-md-7'; 
$col_right = 'col-12 col-md-5';
if($thumbnail === '3'){  
   $col_left = $col_right = 'max-width'; 
}

if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
	$attachment_ids = $product->get_gallery_attachment_ids();
} else {
	$attachment_ids = $product->get_gallery_image_ids();
}
$attachment_count = count( $attachment_ids );

$gallery_less = ''; 
if ( !$attachment_ids ) {
   $gallery_less = 'gallery-less';
   if($thumbnail != '3'){  
       $col_left = 'col-12 col-md-6'; 
       $col_right = 'col-12 col-md-6';
   }
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        
        <div class="<?php echo esc_attr($col_left . ' '. $gallery_less); ?>">
            
	<?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?> 
                
        </div> <!--piko-woo-left-col-->     
        
        <div class="<?php echo esc_attr($col_right); ?>">        
	<div class="summary entry-summary product-details">

		<?php
                        
			/**
			 * woocommerce_single_product_summary hook.
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
        </div>
       
        
        <meta itemprop="url" content="<?php the_permalink(); ?>" />
        
    </div> <!-- .piko-woo-single-wrap -->   
   
     <?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
    
    
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>