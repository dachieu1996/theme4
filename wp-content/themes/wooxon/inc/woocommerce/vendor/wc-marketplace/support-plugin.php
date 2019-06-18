<?php

/* 
 *support fo wc vendor plugins
 * 
 */

function wooxon_wc_marketplace_styles() {
        $css_wmp = ".widget_wcmp_quick_info form#respond #submit{width: 100%}.wc-tab [class*='wcmp-'] h2, .wc-tab .custqna-title{font-size: 18px}.wcmp_sorted_vendors{border-color:#e6e3e3 !important;}.vendor_sort input{border-radius: 0;border: 1px solid #e6e6e6}.wcmp_sorted_vendors .button{border: none;line-height: inherit}.description_data table td{border-top: none;border-left: none}#product_manager_form [class*='col-']{max-width:100%;flex-basis: 100%}.vendor-products-qna-filters .select2-container .select2-search--inline{margin:0}  .vendor-products-qna-filters form-inline .select2-search__field,[class*='wcmp-'] .btn{height: auto !important;line-height: inherit !important}.wp-switch-editor,.html-active .switch-html, .tmce-active .switch-tmce{border-radius: 0;}select.form-control{padding-top:5px;background-position: calc(100% - 20px) calc(1em - 2px), calc(100% - 15px) calc(1em - 2px), 100% 0;}.vendor-cover-wrap .vendor-profile-pic-wraper .profile-pic-btn button{height:auto}.vendor-cover-wrap .vendor-profile-pic-wraper .profile-pic-btn button:hover{background-color: transparent}.vendor-cover-wrap .cover-pic-button button{padding: 0 25px}.tax-dc_vendor_shop .woocommerce-products-header,.product-wrap .product-brand a + a + br + div + a,.product-wrap #report_abuse_form, .product-wrap #report_abuse,.product-wrap .product-brand a#report_abuse + br{display: none !important;}.entry-summary .product_meta .by-vendor-name-link,.entry-summary .product_meta #report_abuse{display: inline-block !important;margin-right: 10px;margin-bottom: 10px;}.entry-summary .product_meta .by-vendor-name-link:before{font-family: fontpiko;padding-right: 5px;font-size: 85%;color: #535353;}.entry-summary .product_meta .by-vendor-name-link:before{}.entry-summary .product_meta #report_abuse:before{padding-right: 5px;}.entry-summary .product_meta .wcmp-abuse-report-title{font-size: 16px;font-weight: 500;}.entry-summary .product_meta .simplePopup{border: 1px solid}.description_data table td{border-color: #dfdfdf;} ";
        
        return $css_wmp;
}