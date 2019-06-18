<?php

add_action("wp_ajax_nopriv_pikoworks_portfolio_load_more", "pikoworks_portfolio_load_more");
add_action("wp_ajax_pikoworks_portfolio_load_more", "pikoworks_portfolio_load_more");
function pikoworks_portfolio_load_more(){
 /**
 * action load more btn
 */
    $current_page = $_REQUEST['current_page'];
    $offset = $_REQUEST['offset'];
    $category = $_REQUEST['category'];
    $portfolioIds = $_REQUEST['portfolioIds'];
    $dataSource = $_REQUEST['dataSource'];
    $posts_per_page = $_REQUEST['postsPerPage'];
    $layout_type = $_REQUEST['layoutType'];
    $overlay_style = $_REQUEST['overlayStyle'];
    $column = $_REQUEST['columns'];
    $padding = $_REQUEST['colPadding'];
    $order = $_REQUEST['order'];
    $short_code = sprintf('[piko_portfolio show_category=""  column="%s" column_masonry="%s" item="%s" show_pagging="1" overlay_style="%s" layout_type="%s" padding="%s" current_page="%s" order="%s" data_source="%s" category="%s" portfolio_ids ="%s" item="%s"]', $column, $column, $posts_per_page, $overlay_style, $layout_type, $padding, $current_page, $order, $dataSource, $category, $portfolioIds, $posts_per_page);
    echo do_shortcode($short_code);
    die();
}
add_action("wp_ajax_nopriv_pikoworks_portfolio_load_by_category", "pikoworks_portfolio_load_by_category");
add_action("wp_ajax_pikoworks_portfolio_load_by_category", "pikoworks_portfolio_load_by_category");
function pikoworks_portfolio_load_by_category(){
/**
 * action load more category
 */
    $current_page = $_REQUEST['current_page'];
    $overlay_style = $_REQUEST['overlay_style'];
    $dataSource =  $_REQUEST['data_source'];
    $dataSectionId = $_REQUEST['data_section_id'];
    $show_paging = $_REQUEST['data_show_paging'];
    $portfolioIds =  $_REQUEST['portfolioIds'];
    $posts_per_page = $_REQUEST['postsPerPage'];
    $layout_type = $_REQUEST['layoutType'];
    $column = $_REQUEST['columns'];
    $padding = $_REQUEST['colPadding'];
    $category = $_REQUEST['category'];
    $order = $_REQUEST['order'];
    $short_code = sprintf('[piko_portfolio category="%s" column="%s" item="%s" show_pagging="%s" layout_type="%s" padding="%s" current_page="%s" order="%s" data_source="%s" portfolio_ids = "%s" ajax_load="%s" overlay_style="%s" data_section_id="%"]', $category, $column,$posts_per_page, $show_paging,$layout_type, $padding, $current_page, $order, $dataSource, $portfolioIds, 1, $overlay_style, $dataSectionId);
    echo do_shortcode($short_code);
    die();
}