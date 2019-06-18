<?php
if ( ! defined( 'ABSPATH' ) ) { exit;} // Exit if accessed directly
/* 
 *support fo vendor plugins
 * 
 */
if( wooxon_is_compare_activated() ) {
    /**
     * Compare Integration
     */
    require WOOXON_INC_DIR . '/woocommerce/vendor/yith/compare.php';
}
if( wooxon_is_wishlist_activated() ) {
    /**
     * Compare Integration
     */
    require WOOXON_INC_DIR . '/woocommerce/vendor/yith/wishlist.php';
}

if ( wooxon_is_dokan_activated() ) {
    /**
     * Dokan Integration
     */
	require WOOXON_INC_DIR . '/woocommerce/vendor/dokan/support-plugin.php';
}

if ( wooxon_is_wc_vendors_activated() ) {
    /**
     * WC Vendors Integration
     */
	require WOOXON_INC_DIR . '/woocommerce/vendor/wc-vendors/support-plugin.php';
}
if ( wooxon_is_wc_marketplace_activated() ) {
    /**
     * WC Marketplace Integration
     */
	require WOOXON_INC_DIR . '/woocommerce/vendor/wc-marketplace/support-plugin.php';
}