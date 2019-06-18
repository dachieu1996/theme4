<?php
if ( ! defined( 'ABSPATH' ) ) { exit;} // Exit if accessed directly

/* 
 * yith @wishlist intrigation;
 * 
 */


function wooxon_yith_withlist_single_page_btn() {
	return;
}
add_filter( 'yith_wcwl_positions', 'wooxon_yith_withlist_single_page_btn' );

/*
* Wishlist notification remove
*/

function wooxon_yith_wcwl_added_to_cart_message( $message ){ 
   return false;
}
add_action( 'yith_wcwl_added_to_cart_message', 'wooxon_yith_wcwl_added_to_cart_message' );


/**
* Remove font wishlist font awesome
**/
function wooxon_yith_font_awesome_css() {
    wp_dequeue_style('yith-wcwl-font-awesome');
    wp_deregister_style('yith-wcwl-font-awesome');
}
add_action('wp_enqueue_scripts','wooxon_yith_font_awesome_css', 100);


if(!function_exists('wooxon_wishlist_number')) {
	function wooxon_wishlist_number() {
		if( class_exists( 'YITH_WCWL' ) ):
			$args  = array();
			if ( defined( 'YITH_WCWL_PREMIUM' ) && is_user_logged_in() ) {
				$args['wishlist_id'] = 'all';
			} else {
				$args['is_default'] = true;
			}
			$products = YITH_WCWL()->get_products( $args );

			if ( ! defined( 'YITH_WCWL_PREMIUM' ) ) {
				$products = array_reverse($products);
			}
			$count = count( $products );
                        echo '<a href="'. esc_url(YITH_WCWL()->get_wishlist_url()).'" class="wishlist-link">'. esc_attr__('Wishlist', 'wooxon') .' <span>('. esc_attr($count). ')</sapn></a>';                        
		endif;
	}
}


if(!function_exists('wooxon_wishlist_widget')) {
	function wooxon_wishlist_widget() {
                $enable = wooxon_get_option_data('show_wishlist_iocn',  false); 
		if( class_exists( 'YITH_WCWL' ) && $enable == true ):
			$args  = array();
			if ( defined( 'YITH_WCWL_PREMIUM' ) && is_user_logged_in() ) {
				$args['wishlist_id'] = 'all';
			} else {
				$args['is_default'] = true;
			}
			$products = YITH_WCWL()->get_products( $args );

			if ( ! defined( 'YITH_WCWL_PREMIUM' ) ) {
				$products = array_reverse($products);
			}
                        $count = count( $products );
			?>
			 <li class="cart-button piko_widget_wishlist">                               
                                <a href="javascript:void(0)">
                                    <span class="tools_button_icon pr"><span class="icon-wishlist" aria-hidden="true"></span><span class="badges"><?php echo esc_attr($count) ?></span></span>                                    
                                </a>
                                <div class="piko-dropdown">                                            
                                    <div class="widget_shopping_cart">
                                            <?php if ( ! empty($products) ) : ?>
						<p class="c_s f_w5"><?php esc_html_e('Recently added item\'s', 'wooxon'); ?></p>
						<ul class="woocommerce-mini-cart cart_list product_list_widget ">
							<?php
							foreach( $products as $item ) {								
								if( function_exists( 'wc_get_product' ) ) {
									$_product = wc_get_product( $item['prod_id'] );
								}
								else{
									$_product = get_product( $item['prod_id'] );
								}

								if( ! $_product ) continue;

								$product_name  = $_product->get_title();
								$thumbnail     = $_product->get_image();
								$product_price = WC()->cart->get_product_price( $_product );
								?>
								<li class="woocommerce-mini-cart-item mini_cart_item">									
                                                                        <a href="<?php echo esc_url( $_product->get_permalink() ); ?>" class="product-mini-image">
                                                                                <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . '&nbsp;';                                                                                        
                                                                                 echo esc_html($product_name);
                                                                                ?>
                                                                        </a>
                                                                        <span class="quantity"><span class="amount"><?php echo wp_kses_post($product_price); ?></span></span>
								</li>
								<?php
							}
							?>
						</ul>

						<p class="buttons mb0 mt25">
                                                    <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>" class="button hover w100 t_c"><?php esc_attr_e( 'View Wishlist', 'wooxon' ); ?></a>
						</p>

					<?php else : ?>
                                                <p class="woocommerce-mini-cart__empty-message wishlist"><?php esc_html_e( 'No products in the wishlist.', 'wooxon' ); ?></p>
					<?php endif; ?>
                                    </div>
                                </div>
			</li>
			<?php
		endif;
	}
}


if(!function_exists('wooxon_wishlist_multilingual_ajax')) {
	add_filter('wcml_multi_currency_is_ajax', 'wooxon_wishlistt_multilingual_ajax');
	function wooxon_wishlist_multilingual_ajax($functions) {
		$functions[] = 'wooxon_wishlist_fragments';
		return $functions;
	}
}
if( ! function_exists('wooxon_wishlist_fragments') ) {
	add_action( 'wp_ajax_wooxon_wishlist_fragments', 'wooxon_wishlist_fragments');
	add_action( 'wp_ajax_nopriv_wooxon_wishlist_fragments', 'wooxon_wishlist_fragments');

	function wooxon_wishlist_fragments() {
		if(! function_exists('wc_setcookie') || ! function_exists('YITH_WCWL') ) return;
		$products = YITH_WCWL()->get_products( array(
			#'wishlist_id' => 'all',
			'is_default' => true
		) );
		// wishlist mini cart
		ob_start();
		wooxon_wishlist_widget();              
		$wishlist = ob_get_clean();
		// Fragments and wishlist mini cart are returned
		$data = array(
			'wishlist' => $wishlist,
			'wishlist_hash' =>  md5( json_encode( $products ) )
		);
		wp_send_json( $data );
	}
}

if( ! function_exists('wooxon_wishlist_maybe_set_cookies') ) {
	add_action( 'wp', 'wooxon_wishlist_maybe_set_cookies', 99 );
	function wooxon_wishlist_maybe_set_cookies() {
		if(! function_exists('wc_setcookie') || ! function_exists('YITH_WCWL') ) return;
		$products = YITH_WCWL()->get_products( array(
			#'wishlist_id' => 'all',
			'is_default' => true
		) );

		if ( ! headers_sent() && did_action( 'wp_loaded' ) ) {
			if ( ! empty( $products ) ) {
				wooxon_wishlist_set_cookies( true );
			} elseif ( isset( $_COOKIE['piko_items_in_wishlist'] ) ) {
				wooxon_wishlist_set_cookies( false );
			}
		}
	}
}

if( ! function_exists('wooxon_wishlist_set_cookies') ) {
	function wooxon_wishlist_set_cookies($set = true ) {
		if(! function_exists('wc_setcookie') || ! function_exists('YITH_WCWL') ) return;
		$products = YITH_WCWL()->get_products( array(
			#'wishlist_id' => 'all',
			'is_default' => true
		) );
		if ( $set ) {
			wc_setcookie( 'piko_items_in_wishlist', 1 );
			wc_setcookie( 'piko_wishlist_hash', md5( json_encode( $products ) ) );
		} elseif ( isset( $_COOKIE['piko_items_in_wishlist'] ) ) {
			wc_setcookie( 'piko_items_in_wishlist', 0, time() - HOUR_IN_SECONDS );
			wc_setcookie( 'piko_wishlist_hash', '', time() - HOUR_IN_SECONDS );
		}
		do_action( 'wooxon_wishlist_set_cookies', $set );
	}
}