<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

add_action( 'tgmpa_register', 'wooxon_register_required_plugins' );
function wooxon_register_required_plugins() {
    
    
    
    $wishlist_plugin = $compare_plugin = $Ajax_Product_Filter = $product_bundle = $pikoworks_swatches = $cookienotice =  '';
        
    if(function_exists( 'WC' )){
        $wishlist_plugin = array(
                            'name'      => 'YITH WooCommerce Wishlist',
                            'slug'      => 'yith-woocommerce-wishlist',
                            'required'  => false,
                    );

        $compare_plugin = array(
                            'name'      => 'YITH WooCommerce Compare',
                            'slug'      => 'yith-woocommerce-compare',
                            'required'  => false,
                    );
        $Ajax_Product_Filter = array(
                    'name'      => 'YITH WooCommerce Ajax Product Filter',
                    'slug'     => 'yith-woocommerce-ajax-product-filter-premium',
                    'source'   => 'http://themepiko.com/resources/plugins/yith-woocommerce-ajax-product-filter-premium.zip',
                    'version'  => '3.2',
                );
        $product_bundle = array(
                    'name'     => 'WooCommerce Product Bundle',
                    'slug'     => 'wpa-woocommerce-product-bundle',
                    'source'   => 'http://themepiko.com/resources/plugins/wooxon/wpa-woocommerce-product-bundle.zip',
                    'version'  => '1.0.1',
                );
        $pikoworks_swatches = array(
                    'name'     => 'Variation Swatches',
                    'slug'     => 'pikoworks_swatches',
                    'source'   => 'http://themepiko.com/resources/plugins/pikoworks_swatches.zip',
                    'version'  => '1.0',
                );
        $cookienotice = array(
                        'name'      => 'Cookie Notice',
                        'slug'      => 'cookie-notice',
                        'required'  => false,
                );
    }
       
    
	$plugins = array(
                // This is an example of how to include a plugin bundled with a theme.
                array(
                    'name'               => 'Pikoworks Core',
                    'slug'               => 'pikoworks_core',
                    'source'             => 'http://themepiko.com/resources/plugins/wooxon/pikoworks_core.zip',
                    'required'           => true,
                    'version'            => '1.0',
                    'force_deactivation' => false,
                    'external_url'       => '', 
                    'is_callable'        => '',
		),                
		array(
                    'name'         => ' WPBakery Visual Composer',
                    'slug'         => 'js_composer',
                    'source'       => 'http://themepiko.com/resources/plugins/js_composer.zip',
                    'required'     => true,
                    'version'      => '5.6',
                    'external_url' => '',
		),               
		array(
                    'name'         => 'Slider Revolution',
                    'slug'         => 'revslider',
                    'source'       => 'http://themepiko.com/resources/plugins/revslider.zip',
                    'required'     => false,
                    'version'      => '5.4',
                    'external_url' => '',
		),
                array(
                    'name'         => 'Pikoworks Custom Post',
                    'slug'         => 'pikoworks_custom_post',
                    'source'       => 'http://themepiko.com/resources/plugins/wooxon/pikoworks_custom_post.zip',
                    'required'     => false,
                    'version'      => '1.0',
                    'external_url' => '',
		),
		array(
                    'name'      => 'Contact Form 7',
                    'slug'      => 'contact-form-7',
                    'required'  => false,
		),                               
                // This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
                    'name'      => 'WooCommerce',
                    'slug'      => 'woocommerce',
                    'required'  => false,
                    'version'   => '3.5',
		),
                array(
                    'name'                     => 'Envato Market',
                    'slug'                     => 'envato-market',
                    'source'                   => 'http://themepiko.com/resources/plugins/envato-market.zip',
                    'required'                 => false,
                    'version'                  => '2.0.1',
                ),
                array(
                    'name'      => 'Demo Import',
                    'slug'      => 'one-click-demo-import',
                    'required'  => false,
		),
                $pikoworks_swatches,
                $product_bundle,
                $Ajax_Product_Filter,
                $wishlist_plugin,
                $compare_plugin,
                $cookienotice,
	);	
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		
	);

	tgmpa( $plugins, $config );
}
