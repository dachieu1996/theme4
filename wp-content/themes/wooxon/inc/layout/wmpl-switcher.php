<?php 
/* 
 * language wpml
 */
if ( !function_exists( 'wooxon_wc_get_currency' ) ) {
	function wooxon_wc_get_currency(){
         if ( ! class_exists( 'Pikoworks_Currency_Switcher' ) ) return;
	$currency = Pikoworks_Currency_Switcher::getCurrencies();
        
        if (  $currency > 0  ) :
		$woocurrency = Pikoworks_Currency_Switcher::woo_currency();
		$woocode = $woocurrency['currency'];
		if ( ! isset( $currency[$woocode] ) ) {
			$currency[$woocode] = $woocurrency;
		}
		$default = Pikoworks_Currency_Switcher::woo_currency();
		$current = isset( $_COOKIE['piko_currency'] ) ? $_COOKIE['piko_currency'] : $default['currency'];

		$output = '';

		$output .= '<div class="piko-currency"><ul>';
			$output .= '<li><a href="javascript:void(0);" class="current"><i class="fa fa-money" aria-hidden="true"></i>' . esc_html( $current ) . '<i class="fa fa-angle-down ml10"></i></a>';
			$output .= '<ul>';
				foreach( $currency as $code => $val ) :
					$output .= '<li>';
						$output .= '<a class="currency-name" href="javascript:void(0);" data-currency="' . esc_attr( $code ) . '">' . esc_html( $code ) . '</a>';
					$output .= '</li>';
				endforeach;
			$output .= '</ul>';
		$output .= '</li></ul></div>';
	endif;
	return apply_filters( 'wooxon_wc_currency', $output );
        
        
    }
}


if( ! function_exists( 'wooxon_wmpl_lang_switcher' ) ){
    function wooxon_wmpl_lang_switcher() {
        $wpml = wooxon_get_option_data('top_wpml_lang', false);
        
        if( function_exists( 'icl_get_languages' ) && $wpml == 1 ){
                $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
                $output = '';
                if ( ! empty( $languages ) ) {
                        $output .= '<div><ul class="lang"><li> <a href="javascript:void(0);"><i class="fa fa-globe" aria-hidden="true"></i>'. ICL_LANGUAGE_NAME_EN .'</a>';
                        $output .= '<ul>';
                        foreach ( $languages as $l ) {
                                if ( ! $l['active'] ) {
                                        $output .= '<li>';
                                        $output .= '<a href="' . $l['url'] . '"> <img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
                                        $output .= icl_disp_language( $l['native_name'] );
                                        $output .= '</a>';
                                        $output .= '</li>';
                                }
                        }
                        $output .= '</ul>';
                        $output .= '</li></ul></div>';
                        echo wp_kses_post( $output );
                }
        }
    }
}

if( ! function_exists( 'wooxon_wmpl_switcher_top' ) ){
    function wooxon_wmpl_switcher_top() {
        $wpml = wooxon_get_option_data('top_wpml_lang', false);
        $currency = wooxon_get_option_data('top_currency', false);
        
        if( $currency == true ){ 
            echo wooxon_wc_get_currency(); //theme default 
        }
        
        if( class_exists('SitePress') && $currency == true ){
           echo'<div class="currency">' . (do_shortcode('[currency_switcher]')). '</div>';
        }        
        
        if( function_exists( 'icl_get_languages' ) && $wpml == true ){
                $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
                $output = '';
                if ( ! empty( $languages ) ) {
                        $output .= '<div><ul class="lang"><li> <a href="javascript:void(0);">'. ICL_LANGUAGE_NAME_EN .'</a>';
                        $output .= '<ul>';
                        foreach ( $languages as $l ) {
                                if ( ! $l['active'] ) {
                                        $output .= '<li>';
                                        $output .= '<a href="' . $l['url'] . '"> <img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
                                        $output .= icl_disp_language( $l['native_name'] );
                                        $output .= '</a>';
                                        $output .= '</li>';
                                }
                        }
                        $output .= '</ul>';
                        $output .= '</li></ul></div>';
                        echo wp_kses_post( $output );
                }
        }
    }
}