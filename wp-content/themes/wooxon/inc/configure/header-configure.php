<?php
/*
 * @author themepiko
 * header | footer content function | body class | slider top
 */

//menu style
if(!function_exists('wooxon_headers_style')){
    function wooxon_headers_style(){
        $prefix = 'wooxon_';
        global $wooxon;
        
        $menu_style =  get_post_meta(get_the_ID(), $prefix . 'menu_style',true);
        if (!isset($menu_style) || $menu_style == '-1' || $menu_style == '') {
            $menu_style = isset( $wooxon['menu_style'] ) ? $wooxon['menu_style'] : '1';
        }      
        switch ($menu_style) {               
                case '6':
                {
                    wooxon_get_template('headers/header', '6');
                    break;
                }
                case '24':
                {
                    wooxon_get_template('headers/header', '24');
                    break;
                }
                case '23':
                {
                    wooxon_get_template('headers/header', '23');
                    break;
                }
                case '22':
                {
                    wooxon_get_template('headers/header', '22');
                    break;
                }
                case '21':
                {
                    wooxon_get_template('headers/header', '21');
                    break;
                }
                case '2':
                {
                    wooxon_get_template('headers/header', '2');
                    break;
                }
                default:
                {
                    wooxon_get_template('headers/header', '1'); 
                }
            }
        wooxon_breadcrumbs(); //breadcrumbs        
    }
}

if ( !function_exists( 'wooxon_get_top_bar_menu' ) ){
	function wooxon_get_top_bar_menu(){
		$arg_default = array(
			'fallback_cb'     => false,
			'container'       => false,
		);
		$args = array_merge($arg_default , apply_filters( 'wooxon_get_top_bar_menu_location' , array(
			'theme_location'  => 'top_menu',
		)) );

		wp_nav_menu($args);
	}
}

if( !function_exists('wooxon_main_menu_fallback') ){
	function wooxon_main_menu_fallback(){
		$output = '<ul class="main-menu mega-menu show-arrow effect-fadein-up subeffect-fadein-left">';
		$menu_fallback = wp_list_pages('number=5&depth=2&echo=0&title_li=');
		$menu_fallback = str_replace('page_item','page_item menu-item',$menu_fallback);
		$menu_fallback = str_replace("<ul class='children'>","<ul class='sub-menu'>",$menu_fallback);
		$output .= $menu_fallback;
		$output .= '</ul>';
		echo wp_kses_post($output);
	}
}

if( !function_exists('wooxon_main_mobile_menu_fallback') ){
	function wooxon_main_mobile_menu_fallback(){
		$output = '<ul class="mobile-main-menu accordion-menu">';
		$menu_fallback = wp_list_pages('echo=0&title_li=');
		$menu_fallback = str_replace('page_item','page_item menu-item',$menu_fallback);
		$menu_fallback = str_replace("<ul class='children'>","<span class='arrow'></span><ul class='sub-menu'>",$menu_fallback);
		$output .= $menu_fallback;
		$output .= '</ul>';
		echo wp_kses_post($output);
	}
}

if ( !function_exists( 'wooxon_get_main_menu' ) ){
	function wooxon_get_main_menu(){
                $menu_anm = wooxon_get_option_data('main_menu_animation','effect-down');
                $submenu_anm = wooxon_get_option_data('sub_menu_animation','subeffect-down');
		if(class_exists('Wooxon_Walker_Top_Nav_Menu')) {
			$arg_default = array(
				'container' => false,
				'menu_class' => 'main-menu mega-menu '.esc_attr($menu_anm . ' ' . $submenu_anm).' show-arrow',
				'fallback_cb' => 'wooxon_main_menu_fallback',
				'walker' => new Wooxon_Walker_Top_Nav_Menu
			);
			$args = array_merge($arg_default , apply_filters( 'wooxon_filter_main_menu_location' , array(
				'theme_location' => 'primary',
			)) );
			wp_nav_menu($args);
		}
	}
}
if ( !function_exists( 'wooxon_get_secondary_menu' ) ){
	function wooxon_get_secondary_menu(){
            $menu_anm = wooxon_get_option_data('main_menu_animation','effect-down');
            $submenu_anm = wooxon_get_option_data('sub_menu_animation','subeffect-down'); 
		if(class_exists('Wooxon_Walker_Top_Nav_Menu')) {
			$arg_default = array(
				'container' => false,
				'menu_class' => 'main-menu mega-menu '.esc_attr($menu_anm . ' ' . $submenu_anm).' show-arrow',
				'fallback_cb' => 'wooxon_main_menu_fallback',
				'walker' => new Wooxon_Walker_Top_Nav_Menu
			);
			$args = array_merge($arg_default , apply_filters( 'wooxon_filter_main_menu_location' , array(
				'theme_location' => 'secondary',
			)) );
			wp_nav_menu($args);
		}
	}
}

if ( !function_exists( 'wooxon_get_mobile_main_menu' ) ){
	function wooxon_get_mobile_main_menu(){
            
                $prefix = 'wooxon_';
                global $wooxon;

                $menu_style =  get_post_meta(get_the_ID(), $prefix . 'menu_style',true);
                if (!isset($menu_style) || $menu_style == '-1' || $menu_style == '') {
                    $menu_style = isset( $wooxon['menu_style'] ) ? $wooxon['menu_style'] : '1';
                }
            
		if(class_exists('Wooxon_Walker_Accordion_Nav_Menu') && $menu_style != '24') {
			$arg_default = array(
				'container' => false,
				'menu_class' => 'mobile-main-menu accordion-menu',
				'fallback_cb' => 'wooxon_main_mobile_menu_fallback',
				'walker' => new Wooxon_Walker_Accordion_Nav_Menu
			);
			$args = array_merge($arg_default , apply_filters( 'wooxon_filter_main_menu_location' , array(
				'theme_location' => 'primary',
			)) );
			wp_nav_menu($args);
		}
                

                
		if(class_exists('Wooxon_Walker_Accordion_Nav_Menu') && $menu_style == '6') {
			$arg_default_secondary = array(
				'container' => false,
				'menu_class' => 'mobile-main-menu accordion-menu',
				'fallback_cb' => 'wooxon_main_mobile_menu_fallback',
				'walker' => new Wooxon_Walker_Accordion_Nav_Menu
			);
			$args_secondary = array_merge($arg_default_secondary , apply_filters( 'wooxon_filter_main_menu_location' , array(
				'theme_location' => 'secondary',
			)) );
			wp_nav_menu($args_secondary);
		}
                $vertical_menu = wooxon_get_option_data('enable_main_menu_category', 0);
                if(class_exists('Wooxon_Walker_Accordion_Nav_Menu') && $vertical_menu == 1 && ($menu_style != '2' || $menu_style != '6') ) {
			$arg_default_vertical = array(
				'container' => false,
				'menu_class' => 'mobile-main-menu accordion-menu',
				'fallback_cb' => 'wooxon_main_mobile_menu_fallback',
				'walker' => new Wooxon_Walker_Accordion_Nav_Menu
			);
			$args_vertical = array_merge($arg_default_vertical , apply_filters( 'wooxon_filter_main_menu_location' , array(
				'theme_location' => 'category',
			)) );
			wp_nav_menu($args_vertical);
		}
                
	}
}

if ( !function_exists( 'wooxon_get_topbar_right' ) ){
    function wooxon_get_topbar_right(){
        global $wooxon;
        $top_bar_right_wpml = isset( $wooxon['top_bar_right_wpml'] ) ? $wooxon['top_bar_right_wpml'] : 0;              
        $top_bar_right_option = wooxon_get_option_data('top_bar_right_option', 0);        
        $top_bar_infotext_right = wooxon_get_option_data('top_bar_infotext_right','');        
        
       ?>
       <div id="site-navigation-top-bar" class="top-bar-navigation">
           <?php
           if($top_bar_right_option == 0){
                wooxon_get_top_bar_menu();
           }else{
              echo do_shortcode( $top_bar_infotext_right);  
           }
           if( $top_bar_right_wpml == 1 ){ 
                echo '<ul class="menu">';
                wooxon_lang_switcher();
                echo '</ul>';
            }           
           ?>       
           
        </div>
    <?php        
    }
}

if ( !function_exists( 'wooxon_get_topbar' ) ){
    function wooxon_get_topbar(){ 
        $prefix = 'wooxon_';
        $menu_width =  get_post_meta(get_the_ID(), $prefix . 'manu_width',true);
        if (!isset($menu_width) || $menu_width == '-1' || $menu_width == '') {
            $menu_width = isset( $GLOBALS['wooxon']['full_width_menu'] ) ? $GLOBALS['wooxon']['full_width_menu'] : 'container';
        }
        
        
        $column =  wooxon_get_option_data('top_bar_cols', '2');
        $social =  wooxon_get_option_data('top_bar_social', 'none');
        $center_text =  wooxon_get_option_data('top_bar_infotext_center', '');
        $left_text = wooxon_get_option_data('top_bar_infotext', '');
        $cols = '6';
        $cols_r = '5';
        if($column == 3){
            $cols = '4';
            $cols_r = '12';
        }
        $social_html = '';
        if( $GLOBALS['wooxon']['top_bar_use_social']){
                $social_html .= '<ul>';    
                   foreach ($GLOBALS['wooxon']['top_bar_use_social'] as $key => $val){
                       if(! empty($GLOBALS['wooxon'][$key]) && $val == 1 ){
                          $social_html .= "<li><a target='_blank' href='" .esc_url($GLOBALS['wooxon'][$key]) . "' data-placement='bottom' data-toggle='tooltip' data-original-title='" .esc_attr($key) . "'><i class='fa fa-" .esc_attr($key). "'  aria-hidden='true'></i></a></li>";
                       }
                   }
               $social_html .= '</ul>';  
        }
        
        
        ?>
    <div class="header-top">
        <div class="<?php echo esc_attr($menu_width); ?>">
            <div class="row align-items-center">                                   
                <?php 
                echo '<div class="col-12 col-md-7 col-lg-'.esc_attr($cols).' align-items-lg-start">';
                echo do_shortcode($left_text);
                if($social == 'left') echo wp_kses_post($social_html);
                echo '</div>'; 

                if($column == 3){
                    echo '<div class="col-12 col-md-5 col-lg-4 align-items-lg-center t_c">';
                    echo do_shortcode($center_text);
                    if($social == 'center') echo wp_kses_post($social_html);
                    echo '</div>';                            
                }
                echo '<div class="col-12 col-md-'.esc_attr($cols_r).' col-lg-'.esc_attr($cols).' align-items-lg-end t_r_lg">';
                wooxon_get_topbar_right();
                if($social == 'right') echo wp_kses_post($social_html);
                if ( wooxon_is_wc_activated() ) {			
                        echo wooxon_wmpl_switcher_top(); //wmpl/ theme currency
		}
                echo '</div>'; 
                ?>
            </div>
        </div>
    </div>
    <?php       
    }
}
if ( !function_exists( 'wooxon_get_topbar_inner' ) ){
    function wooxon_get_topbar_inner(){ 
        $inner = wooxon_get_option_data('topbar_inner', false);
        $show = wooxon_get_option_data('topbar_inner_show', false);
        $content = wooxon_get_option_data('topbar_inner_content', '');        
        if($show == true && !is_front_page() ){ return; };
        
        if($inner == true && !empty($content)){
            echo '<div class="top-bar-inner">'.do_shortcode($content).'</div>';
        }
        
    }

}
add_action('election_after_menu_content','wooxon_get_topbar_inner', 1); 

if ( !function_exists( 'wooxon_get_brand_logo' ) ){
    function wooxon_get_brand_logo(){
    $logo_default = isset( $GLOBALS['wooxon']['logo_upload'] ) ? $GLOBALS['wooxon']['logo_upload'] : array( 'url' => get_template_directory_uri() . '/assets/images/logo/logo.png' );    
    $site_name = get_bloginfo('name');
    $logo_type = wooxon_get_option_data('enable_text_logo', 'img');
    $svg = wooxon_get_option_data('logo_upload_svg', '');
    $logo_width = wooxon_get_option_data('logo_max_width', '170');
    if($logo_width !=''){
        $logo_width = 'width="'. esc_attr($logo_width) .'"';
    }
    $description = get_bloginfo( 'description', 'display' );
    ?>
        <?php echo (is_front_page() && is_home()) ? '<h1 class="site-logo">' : '<div class="site-logo">' ;?>
        <a class="dib" href="<?php echo esc_url(home_url("/"))?>">
            <?php if($logo_type == 'text'): ?>
            <?php echo '<span>'. esc_attr($site_name) .'</span>';?>
            <?php elseif($logo_type == 'svg'): echo do_shortcode( $svg ); ?>
            <?php else: ?>
                <img src="<?php echo esc_url($logo_default['url']);?>" alt="<?php echo esc_attr($site_name);?>" class="site-logo-image" <?php echo wp_kses_post($logo_width);?>/>
            <?php endif; ?>
        <?php if ( $description && $logo_type == 'text' || is_customize_preview() && $logo_type == 'text') : ?>
                <div class="site-branding-text"><p class="site-description"><?php echo esc_attr($description); ?></p></div>
        <?php endif; ?>
        </a>
        <?php echo (is_front_page() && is_home()) ? '</h1>' : '</div>' ;?> 

    <?php
        
    }
}

if ( !function_exists( 'wooxon_get_sticky_logo' ) ){
    function wooxon_get_sticky_logo(){ 
        
        $logo_default = isset( $GLOBALS['wooxon']['logo_upload'] ) ? $GLOBALS['wooxon']['logo_upload'] : array( 'url' => get_template_directory_uri() . '/assets/images/logo/logo.png' );        
        $site_name = get_bloginfo('name');
        $logo_type = wooxon_get_option_data('enable_text_logo', 'img');
        $svg = wooxon_get_option_data('logo_upload_svg', '');
        ?>
        <div class="sticky-logo">
            <a href="<?php echo esc_url(home_url("/"))?>">
                <?php if($logo_type == 1): ?>
            <?php echo '<span>'. esc_attr($site_name) .'</span>';?>
            <?php elseif($logo_type == 'svg'): echo do_shortcode( $svg ); ?>
            <?php else: ?>
                <img src="<?php echo esc_url($logo_default['url']);?>" alt="<?php echo esc_attr($site_name);?>" class="site-logo-image"/>
            <?php endif; ?>   
            </a>
        </div>
        <?php
    }
}


if ( !function_exists( 'wooxon_get_header_action' ) ){
    function wooxon_get_header_action(){
        global $woocommerce, $wooxon;
        $show_search = isset( $wooxon['menu_search'] ) ? $wooxon['menu_search'] == 1 : 1;
        $show_cart = isset( $wooxon['show_cart_iocn'] ) ? $wooxon['show_cart_iocn'] == 1 : 1;
        $off_canvas = wooxon_get_option_data('mini_cart_layout', 'normal');        
        ?>
        <ul class="ul-no d_flex flex-row-reverse">
                <li class="toggle-menu-mobile dn_lg dn_xl">
                        <a href="#" class="toggle-menu-mobile-button">
                                <span class="tools_button_icon"><span class="icon-line3" aria-hidden="true"></span></span>
                        </a>
                </li>
                <?php
                if( function_exists('wooxon_is_mobile') && wooxon_is_mobile()){
                   echo '<li class="mobile-panel"><a href="javascript:void(0)">
                                    <span class="fa fa-cog" aria-hidden="true"></span>
                                </a></li>';
                }                
                ?>

                <?php if(function_exists('WC') && $show_cart == 1):?>
                        <li class="cart-button">                                
                            <a href="javascript:void(0)">
                                <span class="tools_button_icon pr"><span class="icon-cart" aria-hidden="true"></span><span class="cart-items">0</span></span>                                
                            </a>
                            <?php if($off_canvas == 'normal' || function_exists('wooxon_is_mobile') && wooxon_is_mobile() ||  function_exists('wooxon_is_tablet') && wooxon_is_tablet()) : ?>
                            <div class="piko-dropdown">                                            
                                <div class="widget_shopping_cart">
                                    <div class="widget_shopping_cart_content">                                                        
                                            <div class="cart-loading"></div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </li>
                <?php endif;?>
                       <?php wooxon_header_login_form();
                       
                       if(function_exists('wooxon_wishlist_widget')) {wooxon_wishlist_widget(); }
                       
                       ?>
                <?php if($show_search):?>
                        <li class="search-button">
                                <a href="javascript:void(0)">
                                    <span class="tools_button_icon"><span class="fa fa-search" aria-hidden="true"></span></span>
                                </a>                                
                        </li>
                <?php endif;?>

        </ul>
<?php
        
    }
}

if ( !function_exists( 'wooxon_get_header_action_two' ) ){
    function wooxon_get_header_action_two(){
        global $woocommerce, $wooxon;
        $show_search = isset( $wooxon['menu_search'] ) ? $wooxon['menu_search'] == 1 : 1;
        $show_cart = isset( $wooxon['show_cart_iocn'] ) ? $wooxon['show_cart_iocn'] == 1 : 1;
        $off_canvas = wooxon_get_option_data('mini_cart_layout', 'off_canvas');  
        
        ?>
        <ul class="ul-no d_flex flex-row-reverse layout-two">                
                <?php if(function_exists('WC') && $show_cart == 1):?>
                        <li class="cart-button">                                
                            <a href="javascript:void(0)">
                                <span class="tools_button_icon pr"><span class="icon-piko-cart" aria-hidden="true"></span><span class="cart-items">0</span></span>
                            </a> 
                            <?php if($off_canvas == 'normal' ||  function_exists('wooxon_is_mobile') && wooxon_is_mobile() ||  function_exists('wooxon_is_tablet') && wooxon_is_tablet() ) : ?>
                            <div class="piko-dropdown">                                            
                                <div class="widget_shopping_cart">
                                    <div class="widget_shopping_cart_content">                                                        
                                            <div class="cart-loading"></div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </li>
                <?php endif;?>
                <?php 
                    wooxon_header_login_form_two();
                    wooxon_get_header_action_help();
                ?>
        </ul>
<?php
        
    }
}
if ( !function_exists( 'wooxon_get_header_action_help' ) ){
    function wooxon_get_header_action_help(){ 
        $need = wooxon_get_option_data('help_text_need', 'Need');
        $help = wooxon_get_option_data('help_text_help', 'Help?');
        $help_content = wooxon_get_option_data('menu_help_content', '');
        
        if(empty($help_content)){ return;}
        
        ob_start();
        echo '<li><a href="#">
                        <span class="t_cate db f_s13">'. esc_attr($need) .'</span>
                        <span class="f_w6 db">'. esc_attr($help) .'</span>
                    </a>
                    <div class="piko-dropdown need-help">';
        echo do_shortcode($help_content);
        echo '</div></li>';
        $return = ob_get_clean();
        echo wp_kses_post( $return, true); 
    }
        
}

if ( !function_exists( 'wooxon_get_header_action_info' ) ){
    function wooxon_get_header_action_info(){    
       $header_info = wooxon_get_option_data('menu_custom_info', 'Custom Text');
       if(empty($header_info)){ return;}
       ob_start();
        echo '<div class="info d_flex flex-row-reverse align-items-center">';
        echo do_shortcode($header_info);
        echo '</div>';
        $return = ob_get_clean();
        echo wp_kses_post( $return, true );
       
      
    }

}

if ( !function_exists( 'wooxon_get_primary_login_menu' ) ){
	function wooxon_get_primary_login_menu(){
		$arg_default = array(
			'fallback_cb'     => false,
			'container'       => false,
			'menu_class'       => 'header-dropdown account-dropdown login-menu',
		);
		$args = array_merge($arg_default , apply_filters( 'wooxon_get_primary_login_menu_location' , array(
			'theme_location'  => 'primary_login',
		)) );

		wp_nav_menu($args);
	}
}
if( ! function_exists('wooxon_header_login_form') ){
    function wooxon_header_login_form(){        
        $loginform = wooxon_get_option_data('menu_login_form', '1');         
         if($loginform == '1'):
             wooxon_get_primary_login_menu();  
         ?>
        <?php elseif ($loginform == '2'):?>
          <li class="login-button">             
                <a href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <?php if(is_user_logged_in()): ?>
                            <span title=" <?php echo esc_attr( $GLOBALS['current_user']->display_name) ?>"><i class="icon-header icon-user" aria-hidden="true"></i></span>                             
                            <?php else: ?>
                            <span><i class="icon-header icon-user" aria-hidden="true"></i></span>
                    <?php endif;?>
                </a>
            <?php get_template_part( 'template-parts/headers/login' ); ?>         
        </li>
        <?php
        endif;
    }

}
if( ! function_exists('wooxon_header_login_form_two') ){
    function wooxon_header_login_form_two(){        
         $loginform = wooxon_get_option_data('menu_login_form', '1');
         if($loginform == '1'):
             wooxon_get_primary_login_menu();  
         ?>
        <?php elseif ($loginform == '2'):?>
          <li class="login-button">
                <a href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="t_cate db f_s13">
                     <?php if(is_user_logged_in()):
                         echo esc_attr($GLOBALS['current_user']->display_name);
                        else: 
                           esc_attr_e('User','wooxon'); 
                        endif;?>
                    </span>        
                    <span class="f_w6 db"><?php esc_attr_e('Account','wooxon'); ?></span>
                </a>              
            <?php get_template_part( 'template-parts/headers/login' ); ?>            
        </li>
        <?php
        endif;
    }

}


//CATEGORY MENU

if ( !function_exists( 'wooxon_get_menu_category' ) ){
	function wooxon_get_menu_category(){
            $menu_anm = wooxon_get_option_data('vertical_menu_animation','effect-fadein-right');
            $submenu_anm = wooxon_get_option_data('sub_menu_animation','subeffect-down'); 
		if(class_exists('Wooxon_Walker_Top_Nav_Menu')) {
			$arg_default = array(
				'container' => false,
				'menu_class' => 'menu-category-menu main-menu mega-menu  '.esc_attr($menu_anm . ' ' . $submenu_anm).' show-arrow',
				'fallback_cb' => 'wooxon_main_menu_fallback',
				'walker' => new Wooxon_Walker_Top_Nav_Menu
			);
			$args = array_merge($arg_default , apply_filters( 'wooxon_filter_main_menu_location' , array(
				'theme_location' => 'category',
			)) );
			wp_nav_menu($args);
		}
	}
}
if ( !function_exists( 'wooxon_get_menu_category_wrap' ) ){
	function wooxon_get_menu_category_wrap(){
            $menu_category = wooxon_get_option_data('enable_main_menu_category', 1);
            $category_title = wooxon_get_option_data('main_menu_category_title', esc_html__('ALL CATEGORIES', 'wooxon'));
            if($menu_category == 1): ?>
                <div class="secondary-menu-wrapper">
                    <div class="secondary-title c_s f_w6"><?php echo esc_attr($category_title); ?></div>
                    <div class="secondary-menu">
                     <?php wooxon_get_menu_category();?>  
                    </div>
                </div>
            <?php endif;            
		
	}
}

if ( !function_exists( 'wooxon_get_header_cart_canvas' ) ){
    function wooxon_get_header_cart_canvas(){
        $show_cart = wooxon_get_option_data('show_cart_iocn', 1);
        $off_canvas = wooxon_get_option_data('mini_cart_layout', 'normal');        
        $info = wooxon_get_option_data('mini_cart_info', '');        
         if(function_exists('WC') && $show_cart == 1 && $off_canvas == 'off_canvas' && ( function_exists('wooxon_is_mobile') && !wooxon_is_mobile() ||  function_exists('wooxon_is_tablet') && !wooxon_is_tablet() )):?>
            <div  class="off-canvas-cart">
                <button class="mfp-close close-cart icon-cross2 pa t_c f_s18 c_w"></button>
                <div class="cart-button">                                          
                    <div class="widget_shopping_cart">
                            <div class="widget_shopping_cart_content">                                                        
                                    <div class="cart-loading"></div>
                            </div>
                    </div>         
                </div>
                <?php if($info !='' ){ echo '<div class="cart-info t_c c_w f_w5 lh_1 f_s15 pt15 pb15">' . do_shortcode($info) . '</div>'; } ?>
            </div>        
        <?php endif;
    }
}


/*
 * ------------------------------------
 *          configure footer
 * ----------------------------------- 
 */
if(!function_exists('wooxon_footer_style')){
    function wooxon_footer_style(){
        $prefix = 'wooxon_';
        global $wooxon;
        
        $footer_layout =  get_post_meta(get_the_ID(), $prefix . 'footer_layout',true);
        if (!isset($footer_layout) || $footer_layout == '-1' || $footer_layout == '') {
            $footer_layout = isset( $wooxon['footer_layout'] ) ? $wooxon['footer_layout'] : 'layout1';
        }
        $footer_parallax =  get_post_meta(get_the_ID(), $prefix . 'footer_parallax',true);
        if ($footer_parallax == '1') {
            $footer_layout = 'layout2';
        } 
        
        
        switch ($footer_layout) {
                case 'layout2':
                {
                    get_template_part('template-parts/footer/footer-layout', 'two');
                    break;
                }
                default:
                {
                    get_template_part('template-parts/footer/footer-layout', 'one'); 
                }
            }
    }
}


if(!function_exists('wooxon_footer_sidebar_one')){
    function wooxon_footer_sidebar_one(){
        $prefix = 'wooxon_';
        global $wooxon;
        
        $footer_width =  get_post_meta(get_the_ID(), $prefix . 'footer_inner_width',true);
        if (!isset($footer_width) || $footer_width == '-1' || $footer_width == '') {
            $footer_width = isset( $GLOBALS['wooxon']['footer-inner-width'] ) ? $GLOBALS['wooxon']['footer-inner-width'] : 'container';
        } 
        
        $footer_widgets =  get_post_meta(get_the_ID(), $prefix . 'widgets_area',true);
        if (!isset($footer_widgets) || $footer_widgets == '0' || $footer_widgets == '') {
            $footer_widgets = isset( $wooxon['footer_widgets'] ) ? $wooxon['footer_widgets'] : true;
        } 
        $footer_columns =  get_post_meta(get_the_ID(), $prefix . 'footer_cloumn',true);
        if (!isset($footer_columns) || $footer_columns == '-1' || $footer_columns == '') {
            $footer_columns = isset( $wooxon['footer_columns'] ) ? $wooxon['footer_columns'] : 4;
        } 
        $footer_sidebar_one =  get_post_meta(get_the_ID(), $prefix . 'footer_sidebar_one',true);
        if (!isset($footer_sidebar_one) || $footer_sidebar_one == '-1' || $footer_sidebar_one == '') {
            $footer_sidebar_one = isset( $wooxon['optn_footer_Widgets_one'] ) ? $wooxon['optn_footer_Widgets_one'] : 'sidebar-3';
        } 
        
        if ( is_active_sidebar( $footer_sidebar_one ) && $footer_widgets == true ) {
            $widget_areas = $footer_columns;
		if( ! $widget_areas ){
			$widget_areas = 4;
		}
                ?>
                <div class="f-sidebar">
                    <div class="<?php echo esc_attr($footer_width); ?> ">                        
                        <div class="row sub-footer <?php echo 'cols_' . esc_attr( $widget_areas ); ?>">
                            <?php dynamic_sidebar( $footer_sidebar_one ); ?>
                        </div>                        
                    </div>
                </div>
            <?php
        }
        
    }
}
if(!function_exists('wooxon_footer_sidebar_two')){
    function wooxon_footer_sidebar_two(){
        $prefix = 'wooxon_';
        global $wooxon;
        
        $footer_width =  get_post_meta(get_the_ID(), $prefix . 'footer_inner_width',true);
        if (!isset($footer_width) || $footer_width == '-1' || $footer_width == '') {
            $footer_width = isset( $GLOBALS['wooxon']['footer-inner-width'] ) ? $GLOBALS['wooxon']['footer-inner-width'] : 'container';
        } 
        $footer_widgets_two =  get_post_meta(get_the_ID(), $prefix . 'widgets_area_two',true);
        if (!isset($footer_widgets_two) || $footer_widgets_two == '0' || $footer_widgets_two == '') {
            $footer_widgets_two = isset( $wooxon['optn_footer_widgets_two'] ) ? $wooxon['optn_footer_widgets_two'] : true;
        }
        
        $footer_columns_two =  get_post_meta(get_the_ID(), $prefix . 'footer_cloumn_two',true);
        if (!isset($footer_columns_two) || $footer_columns_two == '-1' || $footer_columns_two == '') {
            $footer_columns_two = isset( $wooxon['optn_footer_columns_two'] ) ? $wooxon['optn_footer_columns_two'] : 4;
        }
        
        $footer_sidebar_two =  get_post_meta(get_the_ID(), $prefix . 'footer_sidebar_two',true);
        if (!isset($footer_sidebar_two) || $footer_sidebar_two == '-1' || $footer_sidebar_two == '') {
            $footer_sidebar_two = isset( $wooxon['optn_footer_Widgets_two'] ) ? $wooxon['optn_footer_Widgets_two'] : 'sidebar-5';
        }
        
        
        if ( is_active_sidebar( $footer_sidebar_two ) && $footer_widgets_two == true ){
            $widget_areas_two = $footer_columns_two;
		if( ! $widget_areas_two ){
			$widget_areas_two = 4;
		}
                ?>
                <div class="f-sidebar middle">
                    <div class="<?php echo esc_attr($footer_width); ?> ">
                        <div class="row sub-footer <?php echo 'cols_' . esc_attr( $widget_areas_two ); ?>">
                            <?php dynamic_sidebar( $footer_sidebar_two ); ?>
                        </div>
                    </div>
                </div>                
            <?php
        }
    }
}
if(!function_exists('wooxon_footer_sidebar_three')){
    //newsletter widgets
    function wooxon_footer_sidebar_three(){
        $prefix = 'wooxon_';
        global $wooxon;
        
        $footer_widgets_two =  get_post_meta(get_the_ID(), $prefix . 'widgets_area_three',true);
        if (!isset($footer_widgets_two) || $footer_widgets_two == '0' || $footer_widgets_two == '') {
            $footer_widgets_two = isset( $wooxon['optn_footer_widgets_three'] ) ? $wooxon['optn_footer_widgets_three'] : true;
        }
        
        $footer_inner_width =  get_post_meta(get_the_ID(), $prefix . 'footer_inner_top_width',true);
        if (!isset($footer_inner_width) || $footer_inner_width == '-1' || $footer_inner_width == '') {
            $footer_inner_width = isset( $wooxon['footer_inner_top_width'] ) ? $wooxon['footer_inner_top_width'] : 'container';
        }
        
        $footer_columns_two =  get_post_meta(get_the_ID(), $prefix . 'footer_cloumn_three',true);
        if (!isset($footer_columns_two) || $footer_columns_two == '-1' || $footer_columns_two == '') {
            $footer_columns_two = isset( $wooxon['optn_footer_columns_three'] ) ? $wooxon['optn_footer_columns_three'] : 1;
        }
        
        $footer_sidebar_two =  get_post_meta(get_the_ID(), $prefix . 'footer_inner_top_bg_color',true);
        $footer_sidebar_two =  get_post_meta(get_the_ID(), $prefix . 'footer_sidebar_three',true);
        if (!isset($footer_sidebar_two) || $footer_sidebar_two == '-1' || $footer_sidebar_two == '') {
            $footer_sidebar_two = isset( $wooxon['optn_footer_Widgets_three'] ) ? $wooxon['optn_footer_Widgets_three'] : 'sidebar-6';
        }
        if($footer_widgets_two == '2'){
            $footer_sidebar_two = '';
        }
        $footer_bg_color = wooxon_get_option_data('footer_inner_top_two_bg_color', '');
        $bg_color = 'two';
        if($footer_bg_color !=''){
            $bg_color = 'has-bg-color';
        }
        
        if ( is_active_sidebar( $footer_sidebar_two ) && $footer_widgets_two == true ){
            $widget_areas_two = $footer_columns_two;
		if( ! $widget_areas_two ){
			$widget_areas_two = 1;
		}
                ?>
                <div class="f-sidebar <?php echo esc_attr($bg_color);?>">
                    <div class="<?php echo esc_attr($footer_inner_width); ?>">                                                  
                        <div class="row sub-footer <?php echo 'cols_' . esc_attr( $widget_areas_two ); ?>">
                            <?php dynamic_sidebar( $footer_sidebar_two ); ?>
                        </div>                        
                    </div>
                </div>
            <?php
        }
    }
}