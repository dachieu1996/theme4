<?php
/**
 * theme functions
 **/
if (!function_exists('wooxon_get_template')) {
    /*
     * get template parts
     */
	function wooxon_get_template($template, $name = null){
		get_template_part( 'template-parts/' . $template, $name);
	}
}

if (!function_exists('wooxon_meta_tags')) {
    /**
     * favicon
     **/
    function wooxon_meta_tags() {
        // add favicon
       global $wooxon;
       
       if (isset($wooxon['custom_ios_title']) && !empty($wooxon['custom_ios_title'])) {
            echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr($wooxon['custom_ios_title']) . '">';
        }       
       //retina favicon
       if (isset($wooxon['custom_ios_icon144']['url']) && !empty($wooxon['custom_ios_icon144']['url'])) {
             echo '<link rel="apple-touch-icon" sizes="144x144" href=" '. esc_url($wooxon['custom_ios_icon144']['url']). '">';
        }
       if (isset($wooxon['custom_ios_icon114']['url']) && !empty($wooxon['custom_ios_icon114']['url'])){
            echo '<link rel="apple-touch-icon" sizes="114x114" href="' . esc_url($wooxon['custom_ios_icon114']['url']).'">';
       }
       if (isset($wooxon['custom_ios_icon72']['url']) && !empty($wooxon['custom_ios_icon72']['url'])) {
            echo '<link rel="apple-touch-icon" sizes="72x72" href="' .  esc_url($wooxon['custom_ios_icon72']['url']) . '">';
        }
        if (isset($wooxon['custom_ios_icon57']['url']) && !empty($wooxon['custom_ios_icon57']['url'])) {
            echo '<link rel="apple-touch-icon" sizes="57x57" href="' . esc_url($wooxon['custom_ios_icon57']['url']) . '">';
        }
    }
    add_action( 'wp_head', 'wooxon_meta_tags' );
}


if ( !function_exists( 'wooxon_get' ) ){
	function wooxon_get($var){
		return isset($_GET[$var]) ? $_GET[$var] : (isset($_REQUEST[$var]) ? $_REQUEST[$var] : '');
	}
}
if ( !function_exists( 'wooxon_get_option_data' ) ){
	function wooxon_get_option_data($id, $fallback = false, $param = false){
		global $wooxon;
		$wooxon = apply_filters('wooxon_filter_option_data',$wooxon);
		if ( $fallback == false ){
			$fallback = '';
		}
		if(isset($wooxon[$id]) && $wooxon[$id] !== ''){
			$output = $wooxon[$id];
		}
		else{
			$output = $fallback;
		}
		if ( !empty( $wooxon[$id] ) && $param ) {
			if(isset($wooxon[$id][$param])){
				$output = $wooxon[$id][$param];
			}
			else{
				$output = $fallback;
			}
		}
		return $output;
	}
}

if ( !function_exists( 'wooxon_add_formatting' ) ) {
	function wooxon_add_formatting($content){
		$content = do_shortcode($content);
		return $content;
	}
}

if ( !function_exists( 'wooxon_newsletter_popup' ) ) {
	function wooxon_newsletter_popup()	{
        $enable = wooxon_get_option_data('popup_enable', false);
        $front_page = wooxon_get_option_data('popup_page_enable', 'front');
        $h_height = wooxon_get_option_data('popup_title_bg_height', '150');
       
         global $wooxon;
         if ( $enable == false ) { return;}         
         if($front_page == 'front' && !is_front_page()){return;}
        ?>            
            <div class="popup-news piko-newsletter pr o_h dn"  id="newsletterModal">
                  <header class="pr d_t" style="height:<?php echo esc_attr($h_height); ?>px">
                        <a href="javascript:void(0)" class="pa f_s13 pop-close"><span class="icon-cross1"></span></a>
                        <h2 class="d_tc t_c lh_3 f_s18 pr"><?php echo esc_attr( $wooxon['popup_title'] ); ?></h2>
                  </header>
                  <div class="pop-content t_c">                          
                      <?php echo do_shortcode( wpautop( $wooxon['popup_content'] ) ); ?>
                    <span class="fix-checkbox mt20">
                            <input type="checkbox" id="showagain" value="do-not-show">
                            <label for="showagain" class="checkbox"></label> <span><?php echo esc_html( $wooxon['popup_nomore_text'] ); ?></span>
                    </span>			            	
                  </div>
            </div>		
        <?php
	}
}