<?php

/* 
 * woocommerce hooks
 */
// add actions of WooCommcerce

add_action( 'wooxon_after_shop_loop_item_price_deals', 'wooxon_wc_template_loop_price_deals', 11 ); // vc_shortcode


// Remove default actions of WooCommcerce
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10); //archive & single page
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10); //archive & single page
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 ); // content-product.php
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 ); // content-product.php

//archive product hook
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 ); // archive-product.php
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); // archive-product.php
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); // archive-product.php
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );// loop unwanted link remove
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 ); //loop unwanted link remove


//content product
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 ); // content-product.php
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); // content-product.php

add_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_before_shop_loop_item_title_before',6);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 7 );
add_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_woocommerce_add_badge_new_in_list', 8 );
add_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_woocommerce_add_badge_out_of_stock', 9 );
add_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_template_loop_product_thumbnail', 10 ); // content-product.php
add_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_template_loop_product_thumbnail_button_action', 11 ); // content-product.php
add_action( 'woocommerce_before_shop_loop_item_title', 'wooxon_wc_before_shop_loop_item_title_after',15);

add_action( 'wooxon_after_shop_loop_item_title', 'wooxon_wc_template_loop_product_cat_rating', 10 ); // content-product.php

//vc deals product hook

add_action( 'wooxon_woocommerce_toolbar', 'wooxon_wc_toolbar_before_div',70);
add_action( 'wooxon_woocommerce_toolbar', 'wooxon_woocommerce_add_toolbar_per_page', 96 );
add_action( 'wooxon_woocommerce_toolbar', 'wooxon_woocommerce_add_gridlist_toggle_button', 97 );
add_action( 'wooxon_woocommerce_toolbar', 'woocommerce_catalog_ordering', 99 );
add_action( 'wooxon_woocommerce_toolbar', 'wooxon_wc_toolbar_after_div',100);


add_action( 'wooxon_woocommerce_toolbar_after', 'wooxon_woocommerce_add_filter_widgets_on_toolbar', 10 );


add_action( 'woocommerce_before_shop_loop', 'wooxon_woocommerce_add_toolbar' );

//single product content-single-product.php

add_action( 'woocommerce_before_single_product_summary', 'wooxon_wc_product_video', 12 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

add_action( 'woocommerce_single_product_summary', 'wooxon_wc_single_product_summary_before',5);
add_action( 'woocommerce_single_product_summary', 'wooxon_wc_single_product_summary_after_div',15);
add_action( 'woocommerce_single_product_summary', 'wooxon_wc_single_product_summary_after_div_two',15,2);

add_action( 'woocommerce_single_product_summary', 'wooxon_wc_single_product_summary_before_two',30);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 33 );
add_action( 'woocommerce_single_product_summary', 'wooxon_wc_template_loop_product_coundown', 34 );
add_action( 'woocommerce_single_product_summary', 'wooxon_woo_deal_progress_bar', 35 );
add_action( 'woocommerce_single_product_summary', 'wooxon_wc_single_product_summary_after_two',36);
add_action( 'woocommerce_single_product_summary', 'wooxon_wc_template_single_product_miscellaneous', 38 );

add_action( 'woocommerce_single_product_summary', 'wooxon_product_single_share', 42 );


//product tab
add_action( 'woocommerce_product_tabs', 'wooxon_woocommerce_rename_tabs', 98 );
add_filter( 'woocommerce_product_tabs', 'wooxon_woocommerce_add_filter_product_tabs' );
add_filter( 'woocommerce_product_tabs', 'wooxon_woocommerce_add_filter_product_tab_accessories' );
add_filter( 'woocommerce_product_tabs', 'wooxon_woocommerce_add_filter_product_tabs_two' );