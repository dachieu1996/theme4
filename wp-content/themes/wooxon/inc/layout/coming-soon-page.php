<?php
/*
 *@Coming soon redirect
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

//coming soon mode
if ( !function_exists( 'wooxon_coming_soon_redirect' ) ) {
    function wooxon_coming_soon_redirect() {
        global $wooxon;
        
        $is_coming_soon_mode = isset( $wooxon['enable_coming_soon_mode'] ) ? $wooxon['enable_coming_soon_mode'] == '1' : false;
        $disable_if_date_smaller_than_current = isset( $wooxon['disable_coming_soon_when_date_small'] ) ? $wooxon['disable_coming_soon_when_date_small'] == '1' : false;
        $coming_date = isset( $wooxon['coming_soon_date'] ) ? $wooxon['coming_soon_date'] : '';
        
        $today = date( 'm/d/Y' );
        
        if ( trim( $coming_date ) == '' || strtotime( $coming_date ) <= strtotime( $today ) ) {
            if ( $disable_if_date_smaller_than_current ) {
                $is_coming_soon_mode = false;
            }
        }
        
        // Dont't show coming soon page if not coming soon mode on or  is user logged in.
        if ( is_user_logged_in() || !$is_coming_soon_mode ) {
            return;
        }
        
        wooxon_coming_soon_template();
        
        exit();
    }
    add_action( 'template_redirect', 'wooxon_coming_soon_redirect' );
}

if ( !function_exists( 'wooxon_coming_soon_mode_admin_toolbar' ) ) {
    // Add Toolbar Menus
    function wooxon_coming_soon_mode_admin_toolbar() {
    	global $wp_admin_bar, $wooxon;
        
        $is_coming_soon_mode = isset( $wooxon['enable_coming_soon_mode'] ) ? $wooxon['enable_coming_soon_mode'] == '1' : false;
        $disable_if_date_smaller_than_current = isset( $wooxon['disable_coming_soon_when_date_small'] ) ? $wooxon['disable_coming_soon_when_date_small'] == '1' : false;
        $coming_date = isset( $wooxon['coming_soon_date'] ) ? $wooxon['coming_soon_date'] : '';
        
        $today = date( 'm/d/Y' ); 
        
        if ( trim( $coming_date ) == '' || strtotime( $coming_date ) <= strtotime( $today ) ) {
            if ( $disable_if_date_smaller_than_current && $is_coming_soon_mode ) {
                $is_coming_soon_mode = false;
                $menu_item_class = 'piko_coming_soon_expired';
                if ( current_user_can( 'administrator' ) ) { // Coming soon date expired
                    
                    $date = isset( $wooxon['coming_soon_date'] ) ? $wooxon['coming_soon_date'] : date();
                    
                    $args = array(
                		'id'     => 'piko_coming_soon',
                		'parent' => 'top-secondary',
                		'title'  => esc_html__( 'Coming Soon Mode Expired', 'wooxon' ),
                		'href'   => esc_url( admin_url( 'themes.php?page=theme_options' ) ),
                		'meta'   => array(
                			'class'          => 'piko_coming_soon_expired',
                			'title'          => esc_html__( 'Coming soon mode is actived but expired', 'wooxon' )
                		),
                	);
                	$wp_admin_bar->add_menu( $args );   
                }
            }
        }        
        
        if ( current_user_can( 'administrator' ) && $is_coming_soon_mode ) {
            
            $date = isset( $wooxon['coming_soon_date'] ) ? $wooxon['coming_soon_date'] : date();
            
            $args = array(
        		'id'     => 'piko_coming_soon',
        		'parent' => 'top-secondary',
        		'title'  => esc_html__( 'Coming Soon Actived', 'wooxon' ),
        		'href'   => esc_url( admin_url( 'themes.php?page=theme_options' ) ),
        		'meta'   => array(
        			'class'          => 'coming_soon piko-countdown-wrap countdown-admin-menu piko-cms-date_' . esc_attr( $date ),
        			'title'          => esc_html( 'Showing date '.esc_attr( $date ).' Coming soon ended')
        		),
        	);
        	$wp_admin_bar->add_menu( $args );   
        }
    
    }
    add_action( 'wp_before_admin_bar_render', 'wooxon_coming_soon_mode_admin_toolbar', 999 );
}



if ( !function_exists( 'wooxon_coming_soon_template' ) ) {
    
    function wooxon_coming_soon_template() {
        global $wooxon;        
        $date = isset( $wooxon['coming_soon_date'] ) ? $wooxon['coming_soon_date'] : date();
        $text = wooxon_get_option_data('coming_soon_text', '');
        $content_pos = wooxon_get_option_data('coming_content_position', 'left');
        $social_icon = wooxon_get_option_data('enable_coming_soon_social', '0');       

        
        get_header( 'coming' );
        
        $html = '';
        $count_down_html = '';
        $social_icon_html = '';
        
         
        if($social_icon == 1 ){
            $value= '';
            foreach ($GLOBALS['wooxon']['coming_soon_social'] as $key => $val){
               if(! empty($GLOBALS['wooxon'][$key]) && $val == 1 ){
                   $value .=  "<a target='_blank' href='".esc_url($GLOBALS['wooxon'][$key])."'><i class='social-icon fa fa-" .esc_attr($key) ."'></i></a>". " ";
                   }
               } 
           $social_icon_html =  '<div class="clearfix mt20 mt10-xs"><div class="social-icons">' . do_shortcode($value) . '</div></div>';
            
        }
        
        
        if(isset($date) && $date != ''){            
            $date = (explode("/",$date));           
            $count_down_html = '<div class="countdown-lastest m0a countdown-show4 coming-countdown mt30 mt20-xs" data-y="' .esc_attr( $date[2] ).'" data-m="'.esc_attr($date[0] ).'" data-d="'. esc_attr( $date[1] ).'" data-h="00" data-i="00" data-s="00" ></div>';
        }
        
        $html .= '<div class="piko-newsletter pa_center t_c coming-content f_s20 c_s3">
                       ' . do_shortcode($text) . '     
                           <div class="clearfix mb30 mb20-xs"></div>
                        ' . $count_down_html . '
                        ' . $social_icon_html . '
                    </div>';
        
        
        echo do_shortcode( $html );
        get_footer( 'coming' );
        
    }    
    
}
