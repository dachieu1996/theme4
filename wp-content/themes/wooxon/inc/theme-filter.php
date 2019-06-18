<?php
if ( !function_exists( 'wooxon_widget_tag_cloud_args' ) ) {
    function wooxon_widget_tag_cloud_args( $args ) {
            $args['largest'] = 0.92;
            $args['smallest'] = 0.92;
            $args['unit'] = 'em';
            return $args;
    }
    add_filter( 'widget_tag_cloud_args', 'wooxon_widget_tag_cloud_args' );
}
/*remove all redux notice */
if ( ! class_exists( 'reduxNewsflash' ) ){
    class reduxNewsflash {
        public function __construct( $parent, $params ) {}
    }
}
add_filter( 'redux/wooxon/aURL_filter', '__return_empty_string' );

/*remove update notices */
if(class_exists('RevSliderBaseAdmin') || class_exists( 'VC_Manager' ) || class_exists( 'YITH_WCAN' )){
    function wooxon_filter_plugin_updates( $value ) {
        
        if( isset($value) && is_object($value)){
            unset( $value->response['js_composer/js_composer.php'] );
            unset( $value->response['revslider/revslider.php'] ); 
            unset( $value->response['yith-woocommerce-ajax-product-filter-premium/init.php'] );
        }

        return $value;
    }
  add_filter( 'site_transient_update_plugins', 'wooxon_filter_plugin_updates', 10, 1 );
}

if(!function_exists('wooxon_search_form')){
    function wooxon_search_form( $form ){     
        $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<span class="screen-reader-text">' . esc_attr_x( 'Search for:', 'label', 'wooxon' ) . '</span>
					<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder', 'wooxon' ) . '" value="' . get_search_query() . '" name="s" />
				</label>
				<button type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button', 'wooxon' ) .'"><span class="icon-arrow-long-right"></span></button>
			</form>';

        return $form;
    }
   add_filter('get_search_form', 'wooxon_search_form');
}

if ( !function_exists( 'wooxon_slug_post_classes' ) ) {
function wooxon_slug_post_classes( $classes, $class, $post_id ) {
    $prefix = 'wooxon_';
    $id = get_the_ID();
    $wp_default = wooxon_get_option_data('optn_archive_display_type','default');
    $archive_blog_columns = wooxon_get_option_data('optn_archive_display_columns','2');
    $products_per_row = wooxon_get_option_data('optn_woo_products_per_row','4');
    
    if ( get_post_type( get_the_ID() ) == 'post' && !is_singular() && !is_search() ) {   
        
        $classes[] = 'entry'; 
        
        switch ($wp_default) {    
        case 'list':               
                $classes[] = 'blog-list';              
                break;
        case 'masonry':               
                $classes[] = 'entry-grid';              
//                break;
        case 'grid': 
              switch ($archive_blog_columns) {    
                case '2':
                    $classes[] = 'col-md-6 columns-'. esc_attr($archive_blog_columns);
                    break;
                case '3':
                    $classes[] = 'col-xl-4 col-lg-6 col-md-6 columns-'. esc_attr($archive_blog_columns);
                    break;
                case '4':
                    $classes[] = 'col-xl-3 col-lg-4 col-md-6 columns-'. esc_attr($archive_blog_columns);
                    break;
                default :
                    $classes[] = 'col-sm-12 columns-'. esc_attr($archive_blog_columns);
                } 
                     
            break;
        default :
                     
        }        
    }
    if ( get_post_type( get_the_ID() ) == 'post' && is_singular() ) {
       $classes[] = 'entry single';
    }    
    if ( get_post_type( get_the_ID() ) == 'portfolio' && is_singular() ) {
         $classes[] = 'portfolio-single'; 
    }    
    if ( get_post_type( get_the_ID() ) == 'product' && !is_singular() ) {
         switch ($products_per_row) {    
            case '2':
                $classes[] = 'col-12 col-sm-6';
                break;
            case '3':
                $classes[] = 'col-12 col-sm-6 col-md-4';
                break;
            case '4':
                $classes[] =  'col-12 col-sm-6 col-md-4 col-lg-3';
                break;
            default :
                 $classes[] =  'col-12 col-sm-6 col-md-4 col-lg-3 col-xl-20';
            }        
           

    }
    if ( get_post_type( get_the_ID() ) == 'product' && is_singular() && !is_page() ) {
        
        $thumbnail =  get_post_meta(get_the_ID(), $prefix . 'single_products_thumbnail',true);
        if (!isset($thumbnail) || $thumbnail == '-1' || $thumbnail == '') {
            $thumbnail = wooxon_get_option_data('optn_woo_single_products_thumbnail','bottom');
        }
        $classes[] = $thumbnail;
        
        if($thumbnail == '2'){
           $classes[] = 'product-layout-2'; 
        }elseif($thumbnail == '3'){
           $classes[] = 'product-layout-3';
        }
        $classes[] = ( $date = get_post_meta( $id, '_sale_price_dates_from', true ) ) ? esc_attr('product-coundown') : '';
        
        $classes[] = 'product-single';   
    }
 
    return $classes;
}
add_filter( 'post_class', 'wooxon_slug_post_classes', 10, 3 );

}





/*---------------------------------------
 * header body class configure
 * 
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 *
 * ------------------------------------ */ 
 if(!function_exists('wooxon_body_class')){
    function wooxon_body_class( $classes ) {
        $prefix = 'wooxon_';
        global $wooxon, $post;        
        
        $breadcrubm_layout =  get_post_meta(get_the_ID(), $prefix . 'breadcrubm_layout',true);
        $archive_slider =  isset( $wooxon['woo_archive_side_shortcode'] ) ? $wooxon['woo_archive_side_shortcode'] : '';         
        $popup_news = wooxon_get_option_data('popup_enable', true);
        $top_menu =  get_post_meta(get_the_ID(), $prefix . 'enable_top_bar',true);
        if (!isset($top_menu) || $top_menu == '0') {
            $top_menu = wooxon_get_option_data('enable_top_bar', true);
        }
        $wmpl = wooxon_get_option_data('menu_bar_right_wpml', false); 
        $wmpl_top_left = wooxon_get_option_data('menu_top_bar_wpml_area', 'left'); 
        $cat_menu_enable = wooxon_get_option_data('enable_main_menu_category', 1); 
        $cat_menu_fontpage = wooxon_get_option_data('main_menu_category_open', 1); 
        
        $page_class_extra =  get_post_meta(get_the_ID(), $prefix . 'page_class_extra',true);
       
        $theme_box = isset( $wooxon['boxed_site'] ) ? $wooxon['boxed_site']: 0;
        $theme_default = isset( $wooxon['main_width_floatled'] ) ? $wooxon['main_width_floatled']: '';
       
        
        $coming_soon_body_class = isset( $wooxon['enable_coming_soon_mode'] ) ? $wooxon['enable_coming_soon_mode'] : 0;      
        
        

        $footer_parallax = isset( $wooxon['footer_parallax'] ) ? $wooxon['footer_parallax'] : '';  

        
        $menu_style =  get_post_meta(get_the_ID(), $prefix . 'menu_style',true);
        if (!isset($menu_style) || $menu_style == '-1' || $menu_style == '') {
            $menu_style = isset( $wooxon['menu_style'] ) ? $wooxon['menu_style'] : '1';
        } 
        
        $footer_layout =  get_post_meta(get_the_ID(), $prefix . 'footer_layout',true);
        if (!isset($footer_layout) || $footer_layout == '-1' || $footer_layout == '') {
            $footer_layout = isset( $wooxon['footer_layout'] ) ? $wooxon['footer_layout'] : 'layout1';
        }       
        
        $transparency_meta =  get_post_meta(get_the_ID(), $prefix . 'header_transparency',true);
        $transparency = wooxon_get_option_data('header_transparency',false);
        $transparency_option = wooxon_get_option_data('header_transparency_option','fontpage');
        $compare_id = wooxon_get_option_data( 'compare_page_id', 0);
        
        $wp_default = wooxon_get_option_data('optn_archive_display_type','fixdefault'); //fix 404 page
        
        $slide_after_menu_meta =  get_post_meta(get_the_ID(), $prefix . 'slide_after_menu_sticky',true);
            if($theme_box == 1){    
                switch ($theme_default){
                    case 'theme_float':
                        {
                        $classes[] = 'theme_float_full';
                        $classes[] = 'theme_float';
                        break;    
                        }
                    case 'theme_float_boxed':
                        {                    
                        $classes[] = 'theme_float';
                        $classes[] = 'home-box-wapper';
                        break;    
                        }
                    case 'theme_boxed':
                        {
                        $classes[] = 'home-box-wapper';
                        break;    
                        }
                }
            }
            if( $wp_default == 'fixdefault' ){
                    $classes[] = 'fixdefault';
            }                  
            if( $coming_soon_body_class == 1 ){
                    $classes[] = 'coming-soon';
            }                  
            if ( $footer_parallax == 1 && $footer_layout == 'layout2'  ) {	
                $classes[] = 'has-footer-parallax';
            }
            if(wooxon_get_option_data('sticky_header_hide_logo',false)){
                $classes[] = 'sticky-header-hide-logo';
            }
            if(wooxon_get_option_data('sticky_header_hide_search',false)){
                $classes[] = 'sticky-header-hide-search';
            }            
            if(wooxon_get_option_data('sticky_header_hide_cart',false)){
                $classes[] = 'sticky-header-hide-cart';
            }
            if(wooxon_get_option_data('slide_after_menu_sticky',false) && is_front_page() || $slide_after_menu_meta == '1'){
                $classes[] = 'slide-after-menu';
            }          
            
            // Adds a class of custom-background-image to sites with a custom background image.
            if ( get_background_image() ) {
                    $classes[] = 'custom-background-image';
            }
            // Adds a class of group-blog to sites with more than 1 published author.
            if ( is_multi_author() ) {
                    $classes[] = 'group-blog';
            }
            // Adds a class of hfeed to non-singular pages.
            if ( ! is_singular() ) {
                    $classes[] = 'hfeed';
            }            
            if (is_single() ) {
                foreach((wp_get_post_terms( $post->ID)) as $term) {
                    // add category slug to the $classes array
                    $classes[] = esc_attr( $term->slug );
                }
                foreach((wp_get_post_categories( $post->ID, array('fields' => 'slugs'))) as $category) {
                    // add category slug to the $classes array
                    $classes[] = esc_attr( $category );
                }
            }            
            if(function_exists('WC')){
                if ( $archive_slider != '' && ( is_shop() || is_product_category() || is_product_tag()) ) {	
                    $classes[] = 'archive-woocommerce';
                } 
            }
           if($breadcrubm_layout != ''){
               $classes[] = esc_attr($breadcrubm_layout);
            } 
           if($transparency && $transparency_option == 'fontpage' && is_front_page() || $transparency_meta == true){
                $classes[] = 'header-transparency';
            }
            if($transparency && $transparency_option == 'allpage'){
                $classes[] = 'header-transparency';
            }
            if($top_menu){
                $classes[] = 'open-top-menu';
            } 
            if($cat_menu_enable == '1'){
                $classes[] = 'category-menu';
            }       
            if($cat_menu_fontpage == '1' && is_front_page()){
                $classes[] = 'category-menu-open';
            }       
            if($popup_news){
                $classes[] = 'open-popup';
            }            
            if($wmpl == true ){
               $classes[] = 'wmpl-wrap';
            }
            if( $wmpl_top_left != 'none'){
               $classes[] = 'wmpl-wrap-top-'. $wmpl_top_left;
            }
            if( is_page() && $compare_id == $post->ID ){
               $classes[] = 'piko-compare';
            }
            if ( wooxon_get_option_data('notification_mode', 1) ) {
                $classes[] = 'piko-notify';
            }            
            if($menu_style == '21' || $menu_style == '22' || $menu_style == '23' || $menu_style == '24'){
                $classes[] = 'header-layout-2';
            }            
            $classes[] = 'page-parent header-layout-' . esc_attr($menu_style);           
            
            $classes[] = esc_attr($page_class_extra); 
            
            return $classes;
    }

    add_filter( 'body_class', 'wooxon_body_class', 1000 );
}

//preset layout
add_filter( 'wooxon_filter_option_data', 'wooxon_add_filter_theme_options_presets');
if(!function_exists('wooxon_add_filter_theme_options_presets')){
	function wooxon_add_filter_theme_options_presets($options){
            if ( ! class_exists( 'Redux' ) ) {
                return;
            }
		if($_preset = wooxon_get('set')){
			$_file = WOOXON_OPTIONS_PRESET . '/'.$_preset.'.json';
			if ( file_exists( $_file )) {
				require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-base.php';
				require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-direct.php';
				$piko_fs = new WP_Filesystem_Direct(false);
				if(!is_wp_error($piko_fs)){
					$_content = $piko_fs->get_contents($_file);
					$_options = json_decode( $_content, true );
					$options = array_merge( $options, $_options );
				}
			}
		}
		return $options;
	}
}