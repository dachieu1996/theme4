<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="page" class="site">
        <?php            
            $body_width =  get_post_meta(get_the_ID(),'wooxon_page_layout',true);
            if( class_exists( 'WooCommerce' ) && is_woocommerce() ){
                 $body_width = wooxon_get_option_data('shop-width-content', 'container');
            }
            if (!isset($body_width) || $body_width == '-1' || $body_width == '') {
                $body_width = isset( $GLOBALS['wooxon']['main-width-content'] ) ? $GLOBALS['wooxon']['main-width-content'] : 'container';
            }            
            $menu_style =  get_post_meta(get_the_ID(), 'wooxon_menu_style',true);
            if (!isset($menu_style) || $menu_style == '-1' || $menu_style == '') {
                $menu_style = isset( $GLOBALS['wooxon']['menu_style'] ) ? $GLOBALS['wooxon']['menu_style'] : '1';
            }            
            $wc_cat_header_position = wooxon_get_option_data('wc_cat_header','default');
            if( wooxon_is_wc_activated() && !is_product() ) {
                if($wc_cat_header_position == 'full') {
                    add_action('wooxon_before_main_content','wooxon_wc_get_header_image_html_start',40);
                    add_action('wooxon_before_main_content','wooxon_wc_show_cat_page_title',41);
                    add_action('wooxon_before_main_content','woocommerce_taxonomy_archive_description',45); 
                    add_action('wooxon_before_main_content','wooxon_wc_get_header_image_html_end',60); 
                    remove_action('woocommerce_archive_description','woocommerce_taxonomy_archive_description',10); 
                }else{
                    add_action('woocommerce_before_main_content','wooxon_wc_get_header_image_html_start',40);
                    add_action('woocommerce_before_main_content','wooxon_wc_show_cat_page_title',41);
                    add_action('woocommerce_archive_description','wooxon_wc_get_header_image_html_end',50); 
                }
            }
            $varition_countdown = wooxon_get_option_data('loop_product_countdown', true);
            if(wooxon_is_wc_activated() && $varition_countdown){
                add_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_template_loop_product_coundown', 12 ); // content-product.php
            }
            do_action('election_after_menu_content');
            wooxon_headers_style(); //menu style
         ?>
        <div id="piko-content"> <?php //just div fixed menu layout 3  ?>
            <div class="site-inner <?php echo esc_attr($body_width); ?>">
                <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wooxon' ); ?></a>
                <div id="content" class="site-content">
                    <?php do_action( 'wooxon_before_main_content' ); ?>
                    <div class="row">