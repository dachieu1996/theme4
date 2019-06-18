<?php
/**
 * sidebar congifure function css class
 */
if ( !function_exists( 'wooxon_primary_page_sidebar_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function wooxon_primary_page_sidebar_class( $class = '' ) {
        global $wooxon;
        
        $prefix = 'wooxon_';
             
         $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
         $sidebar_width = $wooxon['optn_page_sidebar_width'];
             
       
        if (($sidebar_position === '') || ($sidebar_position == '-1')) {            
            $sidebar_position = isset( $wooxon['optn_page_sidebar_pos'] ) ? $wooxon['optn_page_sidebar_pos'] : 'fullwidth';
        }
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-9 col-xl-8 ';
                } else {
                        $content_col = 'col-lg-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-3 col-xl-4 ';
                } else {
                        $content_col = 'col-lg-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-sm-12 col-md-12 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'wooxon_secondary_page_sidebar_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function wooxon_secondary_page_sidebar_class( $class = '' ) {
        global $wooxon;
        
        $prefix = 'wooxon_';        
            
            $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
            $sidebar_width = $wooxon['optn_page_sidebar_width'];
            
        if (($sidebar_position === '') || ($sidebar_position == '-1')) {
            $sidebar_position = $wooxon['optn_page_sidebar_pos'];
        } 
        
        $sidebar_col = 'col-lg-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-lg-3 col-xl-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-sm-12 col-md-12 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}
/*----------------------------blog -----------------------------------------*/
if ( !function_exists( 'wooxon_primary_blog_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function wooxon_primary_blog_class( $class = '' ) {
        global $wooxon;        
          
        $sidebar_position = isset( $wooxon['optn_blog_sidebar_pos'] ) ? trim( $wooxon['optn_blog_sidebar_pos'] ) : 'right'; 
        $sidebar_width = isset( $wooxon['optn_blog_sidebar_width'] ) ? trim( $wooxon['optn_blog_sidebar_width'] ) : 'small';
       
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-9 col-xl-8 ';
                } else {
                        $content_col = 'col-lg-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-3 col-xl-4 ';
                } else {
                        $content_col = 'col-lg-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-sm-12 col-md-12 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'wooxon_secondary_blog_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function wooxon_secondary_blog_class( $class = '' ) {
        global $wooxon;        
        
        $sidebar_position = isset( $wooxon['optn_blog_sidebar_pos'] ) ? trim( $wooxon['optn_blog_sidebar_pos'] ) : 'right'; 
        $sidebar_width = isset( $wooxon['optn_blog_sidebar_width'] ) ? trim( $wooxon['optn_blog_sidebar_width'] ) : 'small';
        
        $sidebar_col = 'col-lg-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-lg-3 col-xl-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-sm-12 col-md-12 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}

/*-------------------------------blog single--------------------------------------*/
if ( !function_exists( 'wooxon_primary_blog_single_sidebar_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function wooxon_primary_blog_single_sidebar_class( $class = '' ) {
        global $wooxon;
        
        $prefix = 'wooxon_';       
        
        $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
         $sidebar_width = $wooxon['optn_blog_single_sidebar_width'];       
        
        if (($sidebar_position === '') || ($sidebar_position == '-1')) { 
            $sidebar_position = isset( $wooxon['optn_blog_single_sidebar_pos'] ) ? $wooxon['optn_blog_single_sidebar_pos'] : 'right';
        }
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-9 col-xl-8 ';
                } else {
                        $content_col = 'col-lg-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-3 col-xl-4 ';
                } else {
                        $content_col = 'col-lg-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-sm-12 col-md-12 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'wooxon_secondary_blog_single_sidebar_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function wooxon_secondary_blog_single_sidebar_class( $class = '' ) {
        global $wooxon;
        
        $prefix = 'wooxon_';       
        
        $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
         $sidebar_width = $wooxon['optn_blog_single_sidebar_width'];
        
        if (($sidebar_position === '') || ($sidebar_position == '-1')) {
            $sidebar_position = $wooxon['optn_blog_single_sidebar_pos'];
        } 
        
        $sidebar_col = 'col-lg-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-lg-3 col-xl-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-sm-12 col-md-12 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}
/*--------------------------------search-------------------------------------*/
if ( !function_exists( 'wooxon_primary_search_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function wooxon_primary_search_class( $class = '' ) {
        global $wooxon;        
          
        $sidebar_position = isset( $wooxon['optn_search_sidebar_pos'] ) ? trim( $wooxon['optn_search_sidebar_pos'] ) : 'right'; 
        $sidebar_width = isset( $wooxon['optn_search_sidebar_width'] ) ? trim( $wooxon['optn_search_sidebar_width'] ) : 'small';
       
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-9 col-xl-8 ';
                } else {
                        $content_col = 'col-lg-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-3 col-xl-4 ';
                } else {
                        $content_col = 'col-lg-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-sm-12 col-md-12 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'wooxon_secondary_search_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function wooxon_secondary_search_class( $class = '' ) {
        global $wooxon;
        
        $sidebar_position = isset( $wooxon['optn_search_sidebar_pos'] ) ? trim( $wooxon['optn_search_sidebar_pos'] ) : 'right'; 
        $sidebar_width = isset( $wooxon['optn_search_sidebar_width'] ) ? trim( $wooxon['optn_search_sidebar_width'] ) : 'small';
        
        $sidebar_col = 'col-lg-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-lg-3 col-xl-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-sm-12 col-md-12 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}
/*----------------------------Archive product -----------------------------------------*/
if ( !function_exists( 'wooxon_primary_product_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function wooxon_primary_product_class( $class = '' ) {
        global $wooxon;        
          
        $sidebar_position = isset( $wooxon['optn_product_sidebar_pos'] ) ? trim( $wooxon['optn_product_sidebar_pos'] ) : 'fullwidth'; 
        $sidebar_width = isset( $wooxon['optn_product_sidebar_width'] ) ? trim( $wooxon['optn_product_sidebar_width'] ) : 'small';
       
        
        //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-9 col-xl-8 ';
                } else {
                        $content_col = 'col-lg-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-3 col-xl-4 ';
                } else {
                        $content_col = 'col-lg-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-sm-12 col-md-12 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'wooxon_secondary_product_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function wooxon_secondary_product_class( $class = '' ) {
        global $wooxon;        
        
        $sidebar_position = isset( $wooxon['optn_product_sidebar_pos'] ) ? trim( $wooxon['optn_product_sidebar_pos'] ) : 'fullwidth'; 
        $sidebar_width = isset( $wooxon['optn_product_sidebar_width'] ) ? trim( $wooxon['optn_product_sidebar_width'] ) : 'small';
        
        $sidebar_col = 'col-lg-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-lg-3 col-xl-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-sm-12 col-md-12 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}
/*-------------------------------product single--------------------------------------*/
if ( !function_exists( 'wooxon_primary_product_single_sidebar_class' ) ) {    
    /**
     * Add class to #primary
     * @return string 
     **/
    function wooxon_primary_product_single_sidebar_class( $class = '' ) {
        global $wooxon;
        
        $prefix = 'wooxon_';                
        $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
        $sidebar_width = $wooxon['optn_product_single_sidebar_width'];            
       
        if (($sidebar_position === '') || ($sidebar_position == '-1')) {            
            $sidebar_position = isset( $wooxon['optn_product_single_sidebar_pos'] ) ? $wooxon['optn_product_single_sidebar_pos'] : 'fullwidth';
        }       
 
        
       //calculating cloumn
        if ($sidebar_position == 'left' || $sidebar_position == 'right') {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-9 col-xl-8 ';
                } else {
                        $content_col = 'col-lg-9 ';
                }
        }
        if ($sidebar_position == 'both' ) {
                if ($sidebar_width == 'large') {
                        $content_col = 'col-lg-3 col-xl-4 ';
                } else {
                        $content_col = 'col-lg-6 ';
                }
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-6 '. esc_attr($content_col);
        }else{
            $class .= ' col-sm-12 col-md-12 '. esc_attr($content_col) . ' has-sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }
    
}
if ( !function_exists( 'wooxon_secondary_product_single_sidebar_class' ) ) {    
    /**
     * Add class to #secondary
     * @return string 
     **/
    function wooxon_secondary_product_single_sidebar_class( $class = '' ) {
        global $wooxon;
        
        $prefix = 'wooxon_';               
        $sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
        $sidebar_width = $wooxon['optn_product_single_sidebar_width'];
        
        if (($sidebar_position === '') || ($sidebar_position == '-1')) {
            $sidebar_position = $wooxon['optn_product_single_sidebar_pos'];
        }
        
        
        $sidebar_col = 'col-lg-3 ';        
        if ($sidebar_width == 'large') {
            $sidebar_col = 'col-lg-3 col-xl-4 ';
        }
        
        if ( $sidebar_position == 'fullwidth' ) {
            $class .= ' col-sm-12 content-area-fullwidth';
        }elseif($sidebar_position == 'both'){
            $class .= ' col-sm-12 col-md-3 ' . esc_attr($sidebar_col) ;
        }
        else{
            $class .= ' col-sm-12 col-md-12 ' . esc_attr($sidebar_col) . 'sidebar sidebar-' . esc_attr( $sidebar_position );
        }
        
        return esc_attr( $class );        
    }    
}