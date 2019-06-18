<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}
 //Check Mobile tablet device
if( ! class_exists( 'Mobile_Detect' ) ){
    require_once PIKOWORKS_CUSTOM_POST_LIBS.'classes/Mobile_Detect.php';
}
$detect = new Mobile_Detect;
if( ! function_exists( 'pikoworks_is_mobile' ) ){
    function pikoworks_is_mobile(){
        global $detect;
        return $detect->isMobile();
    }
}
if( ! function_exists( 'wooxon_is_mobile' ) ){ //for theme use
    function wooxon_is_mobile(){
        global $detect;
        return $detect->isMobile();
    }
}
if( ! function_exists( 'pikoworks_is_tablet' ) ){
    function pikoworks_is_tablet(){
        global $detect;
        return $detect->isTablet();
    }
}
if( ! function_exists( 'wooxon_is_tablet' ) ){
    function wooxon_is_tablet(){
        global $detect;
        return $detect->isTablet();
    }
}