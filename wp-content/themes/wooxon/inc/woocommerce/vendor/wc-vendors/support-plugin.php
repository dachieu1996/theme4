<?php

/* 
 *support fo wc vendor free / pro plugins
 * 
 */
function wooxon_wc_vendor_styles() {
    $custom_skin_bg = wooxon_get_option_data('main_color_scheme', '#f8981d');
    
    $css_wcv = ".wcv-tabs .tabs-nav li.active a{background-color: #eee;}.wcv-grid a:hover{color:" . esc_attr($custom_skin_bg) . "}.mce-toolbar .mce-btn button:hover{background-color: transparent !important} .wcv-store-address-container{background-color:" . esc_attr($custom_skin_bg) ."}.store-info .social-icons [class*='fa-']{color:#222}.wcv-grid h1,.wcv-grid h2,.wcv-grid h3,.wcv-grid h4,.wcv-grid h5,.wcv-grid h6{font-weight:500}table.wcv-table tr td, table.wcv-table tr th{border-bottom-color: #e6e6e6}.products-list .row .product .product-wrap > .product-middle{min-width:350px}.wcv-store-address-container{padding: 10px 0;}.wcv-store-grid__col.store-info{padding:0;display:inherit}.store-info h3{margin:0}.store-info p{margin-top:5px;margin-bottom: 12px;overflow: hidden;text-overflow: ellipsis;max-height: 67.2px;line-height: 1.4;font-size: 16px}.wcvendors-table{border-bottom-width: 1px;margin-top: 25px !important;}.wcv-cols-group .woocommerce-pagination{border:none; margin: 0;} .wcv-form .control-group .control.append-button .wcv-button{top:1.5px; left:-1px;position:relative;border: 1px solid #e6e6e6;}.btn-inverse.btn-small{margin-top:20px}.wcv-form .control-group .control > input,.wp-switch-editor{border-radius: 0}.product_list_widget .variation{display: -ms-flexbox;display: flex;}.product_list_widget .variation .variation-SoldBy p{margin:0}.product_list_widget .variation .variation-SoldBy a{padding-left: 0 !important;height: auto !important;}.wcv_shop_description{margin: 20px 0 30px}.wcv_shop_description,.site-main > h1{text-align: center;padding: 0 15px;}.site-main > h1{text-transform: uppercase;position: relative;}.site-main > h1:after{content: '';position: absolute;width: 120px;background: #555;height: 2px;bottom: -5px;left: 50%;transform: translate(-50%, -50%);}.product-wrap .product-brand .product_meta br + a:not(.wcvendors_cart_sold_by_meta),.product-wrap .product-brand .wcvendors_ships_from,.product-wrap .product-brand .wcvendors_ships_from + br,.product-wrap .product-brand .wcvendors_ships_from + br + a + br,.product-wrap .product-brand .wcvendors_ships_from + br + a + br + a,.product-wrap .wcvendors_sold_by_in_loop,.product-wrap .wcvendors_sold_by_in_loop + br,.entry-summary .wcvendors_ships_from br,.entry-summary .wcvendors_ships_from + br{display: none;}.wcv-form .control-group .select2-container .select2-choice{padding: 8px 10px 8px;height: 42px;} ";
        
    return $css_wcv;     
}




