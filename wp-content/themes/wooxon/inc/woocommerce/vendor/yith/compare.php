<?php
if ( ! defined( 'ABSPATH' ) ) { exit;} // Exit if accessed directly

/* 
 * yith @compare intrigation;
 * 
 */
global $yith_woocompare;
//update default hook
function wooxon_yith_compare_single_page_btn() {
	update_option('yith_woocompare_compare_button_in_product_page', '0', '');
}
add_action( 'admin_init', 'wooxon_yith_compare_single_page_btn', 1 );
remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj , 'add_compare_link' ), 35 ); // fallback

function wooxon_update_compare_options( $options ) {
		
        foreach( $options['general'] as $key => $option ) {

                if( $option['id'] == 'yith_woocompare_auto_open' ) {
                        $options['general'][$key]['std'] = 'no';
                        $options['general'][$key]['default'] = 'no';
                }
        }
        return $options;
}
	
add_filter( 'yith_woocompare_tab_options', 'wooxon_update_compare_options' );

//compare funtion

function wooxon_add_to_compare_link() {		
    global $product, $yith_woocompare;
    $product_id = $product->get_id();

    $button_text = get_option( 'yith_woocompare_button_text');
    $button_text = '';
    $button_text = function_exists( 'icl_translate' ) ? icl_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text ) : $button_text;

    if( ! is_admin() ) {
            echo apply_filters( 'wooxon_add_to_compare_link', sprintf( 
                            '<a href="%s" class="%s" data-product_id="%d"><i class="fa fa-spinner fa-pulse pa"></i><i class="icon-compare">%s</i></a>',
                            $yith_woocompare->obj->add_product_url( $product_id ),
                            'btn-ac compare-btn pr',
                            $product_id,
                            $button_text
                    ) );
    }
}

add_action( 'wooxon_single_product_action_buttons', 	'wooxon_add_to_compare_link', 20 ); //single
add_action( 'wooxon_wc_loop_product_bottom', 	'wooxon_add_to_compare_link', 20 ); //loop

if( ! function_exists( 'wooxon_get_compare_page_id' ) ) {
        /**
         * Gets page ID of product compare page
         */
        function wooxon_get_compare_page_id() {
                $compare_page_id = wooxon_get_option_data( 'compare_page_id', 0);

                if( 0 !== $compare_page_id && function_exists( 'icl_object_id' ) ) {
                        $compare_page_id = icl_object_id( $compare_page_id, 'page' );
                }
                return $compare_page_id;
        }
}

if( ! function_exists( 'wooxon_get_compare_page_url' ) ) {
        /**
         * Returns URL of Product compare Page         *
         * @return string
         */
        function wooxon_get_compare_page_url() {
                $compare_page_id = wooxon_get_compare_page_id();
                $compare_page_url = '#';

                if( 0 !== $compare_page_id ) {
                        $compare_page_url = get_permalink( $compare_page_id );
                }

                return $compare_page_url;
        }
}
        
        
        

if ( ! function_exists( 'wooxon_compare_number') ) {
        function wooxon_compare_number() { 
                global $yith_woocompare; ?>
<a href="<?php echo esc_url( wooxon_get_compare_page_url() ); ?>" class="compare-link"><?php echo esc_html__('Compare', 'wooxon') .' <span>('. count( $yith_woocompare->obj->products_list ); ?>)</sapn></a><?php
        }
}