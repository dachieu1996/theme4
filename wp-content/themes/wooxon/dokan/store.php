<?php
/**
 * The Template for displaying all single posts. || edit loop structure change wc latest
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$store_user   = get_userdata( get_query_var( 'author' ) );
$store_info   = dokan_get_store_info( $store_user->ID );
$map_location = isset( $store_info['location'] ) ? esc_attr( $store_info['location'] ) : '';


$profile = wooxon_get_option_data('vendor_profile_cover', 'full');
$left_sidebar = wooxon_get_option_data('optn_product_sidebar','sidebar-4');

$data = '';
if( wooxon_get_option_data('product_pagination') ){
    $data  = 'data-masonry=\'{"selector":".product","layoutMode":"masonry"}\'';
}else{    
    $data  = 'data-masonry=\'{"selector":".product","layoutMode":"fitRows"}\'';
}

$products_per_row = isset( $GLOBALS['wooxon']['optn_woo_products_per_row'] ) ? trim( $GLOBALS['wooxon']['optn_woo_products_per_row']  ) : 3;
if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) {
  $products_per_row = '3';
}

get_header( 'shop' );
?>
    <?php do_action( 'woocommerce_before_main_content' ); ?>

    <?php
    
    if($profile == 'default'):
    if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) { ?>    
        <aside id="dokan-secondary" class="dokan-clearfix dokan-store-sidebar order-1 order-lg-0 col-12 col-lg-3 mt50-md" role="complementary">
            <div class="dokan-widget-area widget-collapse">
                 <?php do_action( 'dokan_sidebar_store_before', $store_user, $store_info ); ?>
                <?php
                if ( ! dynamic_sidebar( 'sidebar-store' ) ) {

                    $args = array(
                        'before_widget' => '<aside class="widget">',
                        'after_widget'  => '</aside>',
                        'before_title'  => '<h3 class="widget-title">',
                        'after_title'   => '</h3>',
                    );

                    if ( class_exists( 'Dokan_Store_Location' ) ) {
                        the_widget( 'Dokan_Store_Category_Menu', array( 'title' => esc_attr__( 'Store Category', 'wooxon' ) ), $args );

                        if ( dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on'  && !empty( $map_location ) ) {
                            the_widget( 'Dokan_Store_Location', array( 'title' => esc_attr__( 'Store Location', 'wooxon' ) ), $args );
                        }

                        if ( dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
                            the_widget( 'Dokan_Store_Contact_Form', array( 'title' => esc_attr__( 'Contact Vendor', 'wooxon' ) ), $args );
                        }
                    }

                }
                ?>

                <?php do_action( 'dokan_sidebar_store_after', $store_user, $store_info ); ?>
            </div>
        </aside><!-- #secondary .widget-area -->
    <?php
    } else {
       ?>
        <aside id="secondary" class="widget-area sidebar order-1 order-lg-0 col-12 col-lg-3 mt50-md" role="complementary">
		<?php dynamic_sidebar( $left_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
       <?php
    }    
    ?>

    <div class="order-0 order-lg-1 col-12 col-lg-9">
        <div id="dokan-primary" class="dokan-single-store">
            <div id="dokan-content" class="store-page-wrap woocommerce" role="main">

                <?php dokan_get_template_part( 'store-header' ); ?>

                <?php do_action( 'dokan_store_profile_frame_after', $store_user, $store_info ); ?>

                <?php if ( have_posts() ) { ?>

                    <div class="seller-items">

                        <?php woocommerce_product_loop_start();
                        
                        
                        echo '<div class="piko-masonry products row"'. wp_kses_post( $data ).'>'; //custome add                        
                        
                                        while ( have_posts() ) {
                                                the_post();

                                                /**
                                                 * Hook: woocommerce_shop_loop.
                                                 *
                                                 * @hooked WC_Structured_Data::generate_product_data() - 10
                                                 */
                                                do_action( 'woocommerce_shop_loop' );

                                                wc_get_template_part( 'content', 'product' );
                                        }                       
                        
                        echo '</div>'; //custome add
                        
                        woocommerce_product_loop_end(); ?>
                                

                    </div>

                    <?php dokan_content_nav( 'nav-below' ); ?>

                <?php } else { ?>

                    <p class="dokan-info"><?php esc_html_e( 'No products were found of this vendor!', 'wooxon' ); ?></p>

                <?php } ?>
            </div>

        </div><!-- .dokan-single-store -->
    </div>
    <?php 
    
    else://full width  ?>
        
    <div class="col-12">
        <div id="dokan-primary" class="dokan-single-store mb40">
            <div id="dokan-content" class="store-page-wrap woocommerce">
                 <?php dokan_get_template_part( 'store-header' ); ?>
                 <?php do_action( 'dokan_store_profile_frame_after', $store_user, $store_info ); ?>
            </div>
        </div>        
        <div class="row">
            <?php
             if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) { ?>    
                <aside id="dokan-secondary" class="dokan-clearfix dokan-store-sidebar order-1 order-lg-0 col-12 col-lg-3 mt50-md" role="complementary">
                    <div class="dokan-widget-area widget-collapse">
                         <?php do_action( 'dokan_sidebar_store_before', $store_user, $store_info ); ?>
                        <?php
                        if ( ! dynamic_sidebar( 'sidebar-store' ) ) {

                            $args = array(
                                'before_widget' => '<aside class="widget">',
                                'after_widget'  => '</aside>',
                                'before_title'  => '<h3 class="widget-title">',
                                'after_title'   => '</h3>',
                            );

                            if ( class_exists( 'Dokan_Store_Location' ) ) {
                                the_widget( 'Dokan_Store_Category_Menu', array( 'title' => esc_attr__( 'Store Category', 'wooxon' ) ), $args );

                                if ( dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on'  && !empty( $map_location ) ) {
                                    the_widget( 'Dokan_Store_Location', array( 'title' => esc_attr__( 'Store Location', 'wooxon' ) ), $args );
                                }

                                if ( dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
                                    the_widget( 'Dokan_Store_Contact_Form', array( 'title' => esc_attr__( 'Contact Vendor', 'wooxon' ) ), $args );
                                }
                            }

                        }
                        ?>

                        <?php do_action( 'dokan_sidebar_store_after', $store_user, $store_info ); ?>
                    </div>
                </aside><!-- #secondary .widget-area -->
            <?php
            } else {
               ?>
                <aside id="secondary" class="widget-area sidebar order-1 order-lg-0 col-12 col-lg-3 mt50-md" role="complementary">
                        <?php dynamic_sidebar( $left_sidebar ); ?>
                </aside><!-- .sidebar .widget-area -->
               <?php
            }    
            ?>
            
            <div class="order-0 order-lg-1 col-12 col-lg-9">
                <div id="dokan-primary" class="dokan-single-store">
                    <div id="dokan-content" class="store-page-wrap woocommerce" role="main">
                        <?php if ( have_posts() ) { ?>

                            <div class="seller-items">

                                <?php woocommerce_product_loop_start();


                                echo '<div class="piko-masonry products row"'. wp_kses_post( $data ).'>'; //custome add


                                                while ( have_posts() ) {
                                                        the_post();

                                                        /**
                                                         * Hook: woocommerce_shop_loop.
                                                         *
                                                         * @hooked WC_Structured_Data::generate_product_data() - 10
                                                         */
                                                        do_action( 'woocommerce_shop_loop' );

                                                        wc_get_template_part( 'content', 'product' );
                                                }

                                echo '</div>'; //custome add

                                woocommerce_product_loop_end(); ?>


                            </div>

                            <?php dokan_content_nav( 'nav-below' ); ?>

                        <?php } else { ?>

                            <p class="dokan-info"><?php esc_html_e( 'No products were found of this vendor!', 'wooxon' ); ?></p>

                        <?php } ?>
                    </div>

                </div><!-- .dokan-single-store -->
            </div>
            
        </div>
        
        
        
    </div>   
    
    <?php 
        

    endif; //profile
    
    
    
    do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer( 'shop' ); ?>