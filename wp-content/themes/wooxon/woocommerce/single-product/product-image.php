<?php
/**
 * Single Product Image || edit added slick
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $quickview;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
$post_thumbnail_id = $product->get_image_id();
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
$placeholder       = $product->get_image_id() ? 'with-images' : 'without-images';


$img_class = 'images';

$thumb_layout = wooxon_get_option_data( 'optn_woo_single_products_thumbnail', 'bottom');
$super_zoom = wooxon_get_option_data( 'enable_super_zoom', 'piko-lightbox-img');
if($quickview == true){
   $super_zoom = 'quick-view-thumb';
}
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
        $img_class,
        $super_zoom,
	'pr',
	'piko-product-imges'
) );

// cehck verion attachment
if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
	$attachment_count = count( $product->get_gallery_attachment_ids() );
} else {
	$attachment_count = count( $product->get_gallery_image_ids() );
}

// Get page variable option
$options = get_post_meta( get_the_ID(), '_custom_wc_options', true );
$rtl = '';
 if ( is_rtl()){
     $rtl = '"rtl": true,';
 }
// Get product single thumbnail
$slick_attr = '';
$slick_class = array();
if ( $thumb_layout != 'sticky' || $quickview == true) {
	$slick_attr = 'data-slick=\'{"slidesToShow": 1, "slidesToScroll": 1,"arrows": false,'.wp_kses_post( $rtl).' "asNavFor": ".piko-nav", "fade":true}\'';
        $slick_class[] = 'piko-thumb';
	$slick_class[] = 'piko-carousel';	
}
?>

    <div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">	
            <figure class="woocommerce-product-gallery__wrapper <?php echo esc_attr( implode( ' ', $slick_class ) ); ?>"  <?php echo wp_kses_post( $slick_attr ); ?>>
		<?php
			$attributes = array(
			'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
			'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2],
		);

		if ( has_post_thumbnail() ) {
			$html  = '<div class="woocommerce-product-gallery__image piko-image-zoom"><a href="' . esc_url( $full_size_image[0] ) . '">';
			$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
			$html .= '</a></div>';
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
                        
                        
                        
                        

			if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
				$attachment_ids = $product->get_gallery_attachment_ids();
			} else {
				$attachment_ids = $product->get_gallery_image_ids();
			}

			if ( $attachment_ids ) {
				foreach ( $attachment_ids as $attachment_id ) {
					$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
					$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
					$thumbnail_post   = get_post( $attachment_id );
					$image_title      = get_post_field( 'post_title', $post_thumbnail_id );
                                        
                                        $attributes = array(
                                                'title'                   => $image_title,
                                                'data-src'                => $full_size_image[0],
                                                'data-large_image'        => $full_size_image[0],
                                                'data-large_image_width'  => $full_size_image[1],
                                                'data-large_image_height' => $full_size_image[2],
                                        );                                        
                                        
                                        $html  = '<div class="woocommerce-product-gallery__image piko-image-zoom"><a href="' . esc_url( $full_size_image[0] ) . '">';
                                        $html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
                                        $html .= '</a></div>';

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
				}
			}
		?>
            </figure>
	

	<?php
            do_action( 'woocommerce_product_thumbnails' );
	?>
	
</div>