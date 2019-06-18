<?php
/**
 * Enqueues scripts and styles.
 *
 */

/**
 * Enqueue css, js files
 */

if ( !function_exists( 'wooxon_add_action_wp_enqueue_scripts' ) ){
	add_action( 'wp_enqueue_scripts', 'wooxon_add_action_wp_enqueue_scripts', 9999 );
        function wooxon_add_action_wp_enqueue_scripts(){
            global $wooxon;
            $min_suffix = (isset($wooxon['enable_minifile']) && $wooxon['enable_minifile'] == 1) ? '.min' : '';            
            $enable_min = isset( $wooxon['enable_minifile'] ) ? $wooxon['enable_minifile'] : false;
            $custom_add_css = wooxon_get_option_data('custom_css', '');
           
            $handles_style_remove = array(
                'yith-woocompare-widget',
                'jquery-colorbox',
                'woocommerce_prettyPhoto_css',
                'yith-wcwl-font-awesome',
                'yith-wcwl-main',
                'yith-wcan-frontend',
                'woocomposer-front-slick',
                'jquery-colorbox',
                'font-awesome',                
                'magnific-popup',                
                'openswatch',
                'wpa-wcpb-frontend', //bundle
                'fontawsome-css', //social login
                'apsl-frontend-css', //social login
                'dokan-fontawesome', //dokan icon
                'wcml-dropdown-0', //wmpl currency
                'contact-form-7',
                'contact-form-7-rtl',
                'cookie-notice-front',
            );
            $handles_script_remove = array(
                'jquery-colorbox',
                'woocomposer-slick',
                'prettyPhoto',
                'prettyPhoto-init',
                'openswatch',
                'openswatch_custom'
            );
            foreach ($handles_style_remove as $style) {
                if ( wp_style_is( $style, $list = 'registered' ) ) {
                        wp_deregister_style( $style );
                }
            }
            foreach ($handles_script_remove as $script) {
                if ( wp_script_is( $script, $list = 'enqueued' ) ) {
                        wp_dequeue_script( $script );
                }
            }            
            /*
             * Stylesheet
             */
            if(wp_style_is('js_composer_front','registered')){
                wp_enqueue_style('js_composer_front');
            }
            if( !function_exists('pikoworks_core_admin_css')){ //default if not active core plugins
                wp_enqueue_style( 'default-font', 'https://fonts.googleapis.com/css?family=Roboto:400,500,700', false );            
            }
            /*
             * Scripts
             */           
            wp_enqueue_style( 'wooxon-style', get_stylesheet_uri(), WOOXON_THEME_VERSION, true); // Theme stylesheet. 
            wp_style_add_data( 'wooxon-style', 'rtl', 'replace' );
            
            $css_dynamics = $css_dokan = $css_wmp = $css_wcv = $css_buddypress = $rtl_add_js = $compare_url = '';
            if ( wooxon_is_wc_vendors_activated() ) { $css_wcv = wooxon_wc_vendor_styles($css_wcv); } //wc wc vendor
            if ( wooxon_is_wc_marketplace_activated() ) { $css_wmp = wooxon_wc_marketplace_styles($css_wmp); } //wc wmp vendor
            if ( wooxon_is_dokan_activated() ) { $css_dokan = wooxon_dokan_vendor_styles($css_dokan); } //wc dokan vendor
            if ( wooxon_is_buddypress()) { $css_buddypress = wooxon_buddypress_styles($css_buddypress); } //wc dokan vendor
            if ( wooxon_dynamics_style()) { $css_dynamics = wooxon_dynamics_style($css_dynamics); } //theme dynamics style            

            $combine_css = $css_dokan . $css_wmp . $css_wcv . $custom_add_css . $css_buddypress . $css_dynamics;             
             wp_add_inline_style( 'wooxon-style', $combine_css );
             
            
            $enable_preloader = wooxon_get_option_data('optn_enable_loader', true);
            $home_preloader = wooxon_get_option_data('home_preloader', 'various-4');
            if($enable_preloader && $home_preloader == 'slide'){
                wp_enqueue_script('nprogress', WOOXON_JS.'/plugins/nprogress.js', array('jquery'), WOOXON_THEME_VERSION, false); 
            }

           wp_enqueue_script('jqplugin', WOOXON_JS.'/plugins/jqplugin.min.js', array('jquery'), WOOXON_THEME_VERSION, true);
           wp_enqueue_script('background-check', WOOXON_JS.'/plugins/background-check.min.js', array('jquery'), WOOXON_THEME_VERSION, true); 
           wp_enqueue_script('imagesloaded');
           wp_enqueue_script('isotope', WOOXON_JS.'/plugins/isotope.pkgd.min.js', array('jquery'), WOOXON_THEME_VERSION, true);  
           wp_enqueue_script('countdown', WOOXON_JS.'/plugins/jquery.countdown.min.js', array('jquery'), WOOXON_THEME_VERSION, true);  
           wp_enqueue_script('debouncedresize', WOOXON_JS.'/plugins/jquery.debouncedresize.js', array('jquery'), WOOXON_THEME_VERSION, true); 
           wp_enqueue_script('hoverIntent');
           wp_enqueue_script('slick', WOOXON_JS.'/plugins/slick.min.js', array('jquery'), WOOXON_THEME_VERSION, true);  
           wp_enqueue_script('zoom', WOOXON_JS.'/plugins/jquery.zoom.min.js', array('jquery'), WOOXON_THEME_VERSION, true);  
           wp_enqueue_script('magnific-popup', WOOXON_JS.'/plugins/jquery.magnific-popup.min.js', array('jquery'), WOOXON_THEME_VERSION, true);  
           wp_enqueue_script('sticky-kit', WOOXON_JS.'/plugins/sticky-kit.min.js', array('jquery'), WOOXON_THEME_VERSION, true);  
           wp_enqueue_script('chookie', WOOXON_JS.'/plugins/jquery.chookie.min.js', array('jquery'), WOOXON_THEME_VERSION, true);  

            wp_enqueue_script('wooxon-main', WOOXON_JS.'/main'.$min_suffix.'.js', array('jquery'), WOOXON_THEME_VERSION, true); 
            wp_localize_script( 'wooxon-main', 'pikoAjax', array(
                    'ajaxurl' => admin_url( 'admin-ajax.php' ),
                    'nonce' => wp_create_nonce( 'ajax-nonce' ),
            )); 
            /*
             * inline custome Scripts
             */
             if ( is_rtl() && wooxon_rtl_add_js()) { $rtl_add_js = wooxon_rtl_add_js($rtl_add_js); } //when theme rtl language mode   
            $custom_add_script = wooxon_get_option_data('custom_js', '');
            wp_add_inline_script( 'wooxon-main', $custom_add_script.$rtl_add_js);
            
            if( wooxon_is_compare_activated() ) {
                $compare_url = wooxon_get_compare_page_url();
            }
            wp_localize_script( 'wooxon-main', 'wooxon_global_message', apply_filters( 'wooxon_filter_global_message_js', array(			
			'addcart' => array(
				'success' => esc_attr__('has been added to cart','wooxon'),
			),
			'global' => array(
				'error' => esc_attr__('An error occurred ,Please try again !','wooxon'),
				'comment_author'    => esc_attr__('Please enter Name !','wooxon'),
				'comment_email'     => esc_attr__('Please enter valid Email Address !','wooxon'),
				'comment_rating'    => esc_attr__('Please select a rating !','wooxon'),
				'comment_content'   => esc_attr__('Please enter Comment !','wooxon'),
                                'days'   => esc_attr__('Days','wooxon'),
				'hours'   => esc_attr__('Hours','wooxon'),
				'minutes'   => esc_attr__('Mins','wooxon'),
				'seconds'   => esc_attr__('Secs','wooxon'),
				'loadmore'   => esc_attr__('Load More','wooxon'),
				'shownall'   => esc_attr__('All Item Shown','wooxon'),				
				'more'   => esc_attr__('+ More item','wooxon'),
				'less'   => esc_attr__('- Less item','wooxon')
			),
			'enable_sticky_header' => wooxon_get_option_data('sticky_header',false),
			'preloader' => wooxon_get_option_data('optn_enable_loader',false),
			'preloader_slide' => wooxon_get_option_data('home_preloader', 'slide'),
			'popup' => wooxon_get_option_data('popup_enable',false),
			'setTime' => wooxon_get_option_data('popup_time',false),
			'permalink' => ( get_option( 'permalink_structure' ) == '' ) ? 'plain' : '',
                        'compare_url'   => $compare_url
		) ) );
            
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }
        }
}


if ( !function_exists( 'wooxon_add_action_wp_enqueue_scripts_inline_head' ) ){
	add_action( 'wp_enqueue_scripts', 'wooxon_add_action_wp_enqueue_scripts_inline_head', 9999 );
        function wooxon_add_action_wp_enqueue_scripts_inline_head(){
            $nprogress_add_js  = '';
            
            $enable_preloader = wooxon_get_option_data('optn_enable_loader', true);
            $home_preloader = wooxon_get_option_data('home_preloader', 'various-4');
            
           if ( $enable_preloader && $home_preloader == 'slide' && wooxon_nprogress_js()) { $nprogress_add_js = wooxon_nprogress_js($nprogress_add_js); } //when preloader slide
             
            $custom_add_script = wooxon_get_option_data('custom_js', '');
            wp_add_inline_script( 'nprogress', $nprogress_add_js);

        }

}


