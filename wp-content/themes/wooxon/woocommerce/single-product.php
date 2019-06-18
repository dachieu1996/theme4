<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author 	WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' );



$prefix = 'wooxon_';
$sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
if (($sidebar_position === '') || ($sidebar_position == '-1')) {
    $sidebar_position =  isset( $GLOBALS['wooxon']['optn_product_single_sidebar_pos'] ) ? $wooxon['optn_product_single_sidebar_pos'] : 'fullwidth';

} 

$primary_class = wooxon_primary_product_single_sidebar_class();
$secondary_class = wooxon_secondary_product_single_sidebar_class();

$left_sidebar =  get_post_meta(get_the_ID(), $prefix . 'page_right_sidebar',true);


if (($left_sidebar === '') || ($left_sidebar == '-1')) {    
    $left_sidebar =  isset( $GLOBALS['wooxon']['optn_product_single_sidebar'] ) ? $wooxon['optn_product_single_sidebar'] : 'sidebar-4';
}

$related = isset( $GLOBALS['wooxon']['related_products'] ) ? $wooxon['related_products'] : 'inside';
if( $related == 'outside'){
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    add_action('wooxon_after_main_content', 'woocommerce_output_related_products', 15); 
} elseif($related == 'none') {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

if ( !is_active_sidebar( $left_sidebar )  ) {
    $primary_class = ' col-sm-12';
}

?>
<?php if ( $sidebar_position == 'left' && is_active_sidebar( $left_sidebar )): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php 
                if(function_exists( 'wooxon_product_brand_image_single' ) ){
                   wooxon_product_brand_image_single(); //add brand details 
                }                
                dynamic_sidebar( $left_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
        
    <div id="primary" class="content-area <?php echo esc_attr( $primary_class ); ?>">
	<main id="main" class="site-main" role="main">
	<?php
		/**
                 * @remove hook  woocommerce_output_content_wrapper
                 * 
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
                 * 
                 *  @Remove hook: woocommerce_output_content_wrapper_end
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>
        </main>
    </div>          
        
<?php if ( $sidebar_position == 'right' && is_active_sidebar( $left_sidebar )): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php 
                if(function_exists( 'wooxon_product_brand_image_single' ) ){
                    wooxon_product_brand_image_single(); //add brand details
                }
                dynamic_sidebar( $left_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif;

get_footer( 'shop' ); ?>
