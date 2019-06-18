<?php
/**
 * The Template for displaying all reviews. || edit reviews
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

$store_user = get_userdata( get_query_var( 'author' ) );
$store_info = dokan_get_store_info( $store_user->ID );
$map_location = isset( $store_info['location'] ) ? esc_attr( $store_info['location'] ) : '';

$profile = wooxon_get_option_data('vendor_profile_cover', 'full');
$left_sidebar = wooxon_get_option_data('optn_product_sidebar','sidebar-4');

get_header( 'shop' );
?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

<?php
if($profile == 'default'):

if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) { ?>
    <aside id="dokan-secondary" class="dokan-clearfix dokan-store-sidebar order-1 order-lg-0 col-12 col-lg-3 mt50-md" role="complementary">
        <div class="dokan-widget-area widget-collapse">
            <?php
            if ( ! dynamic_sidebar( 'sidebar-store' ) ) {

                $args = array(
                    'before_widget' => '<aside class="widget">',
                    'after_widget'  => '</aside>',
                    'before_title'  => '<h3 class="widget-title">',
                    'after_title'   => '</h3>',
                );

                if ( class_exists( 'Dokan_Store_Location' ) ) {
                    the_widget( 'Dokan_Store_Category_Menu', array( 'title' => __( 'Store Category', 'wooxon' ) ), $args );
                    if( dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on' ) {
                        the_widget( 'Dokan_Store_Location', array( 'title' => __( 'Store Location', 'wooxon' ) ), $args );
                    }
                    if( dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
                        the_widget( 'Dokan_Store_Contact_Form', array( 'title' => __( 'Contact Vendor', 'wooxon' ) ), $args );
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

<div id="dokan-primary" class="dokan-single-store order-0 order-lg-1 col-12 col-lg-9">
    <div id="dokan-content" class="store-review-wrap woocommerce" role="main">

        <?php dokan_get_template_part( 'store-header' ); ?>


        <?php
        $dokan_template_reviews = Dokan_Pro_Reviews::init();
        $id                     = $store_user->ID;
        $post_type              = 'product';
        $limit                  = 20;
        $status                 = '1';
        $comments               = $dokan_template_reviews->comment_query( $id, $post_type, $limit, $status );
        ?>

        <div id="reviews">
            <div id="comments">

              <?php do_action( 'dokan_review_tab_before_comments' ); ?>

                <h2 class="headline"><?php esc_html_e( 'Vendor Review', 'wooxon' ); ?></h2>

                <ol class="commentlist">
                    <?php echo wp_kses_post($dokan_template_reviews->render_store_tab_comment_list( $comments , $store_user->ID)); ?>
                </ol>

            </div>
        </div>

        <?php
        echo wp_kses_post( $dokan_template_reviews->review_pagination( $id, $post_type, $limit, $status ));
        ?>

    </div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php 
else: ?>

<div class="col-12">
        <div id="dokan-primary" class="dokan-single-store mb40">
            <div id="dokan-content" class="store-page-wrap woocommerce">
                 <?php dokan_get_template_part( 'store-header' ); ?>
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
            
            <div id="dokan-primary" class="dokan-single-store order-0 order-lg-1 col-12 col-lg-9">
                <div id="dokan-content" class="store-review-wrap woocommerce" role="main">

                    <?php
                    $dokan_template_reviews = Dokan_Pro_Reviews::init();
                    $id                     = $store_user->ID;
                    $post_type              = 'product';
                    $limit                  = 20;
                    $status                 = '1';
                    $comments               = $dokan_template_reviews->comment_query( $id, $post_type, $limit, $status );
                    ?>

                    <div id="reviews">
                        <div id="comments">

                          <?php do_action( 'dokan_review_tab_before_comments' ); ?>

                            <h2 class="headline"><?php esc_html_e( 'Vendor Review', 'wooxon' ); ?></h2>

                            <ol class="commentlist">
                                <?php echo wp_kses_post($dokan_template_reviews->render_store_tab_comment_list( $comments , $store_user->ID)); ?>
                            </ol>

                        </div>
                    </div>

                    <?php
                    echo wp_kses_post($dokan_template_reviews->review_pagination( $id, $post_type, $limit, $status ));
                    ?>

                </div><!-- #content .site-content -->
            </div><!-- #primary .content-area -->
            
        </div>
        
    </div>   
    
    <?php 

    
endif; //profile

do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer(); ?>
