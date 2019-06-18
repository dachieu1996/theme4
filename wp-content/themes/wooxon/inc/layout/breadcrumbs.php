<?php

if(!function_exists('wooxon_breadcrumbs')){
    function wooxon_breadcrumbs() {
      //page title style
      global $wooxon;
      // Get header layout style
      
    if( function_exists( 'is_woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || is_product() || is_tax('brand') )){
       add_action( 'wooxon_before_main_content', 'woocommerce_breadcrumb', 10);
       add_action( 'woocommerce_before_main_content', 'wooxon_wc_add_widgets_on_shop',5 );       
       return;
       
    }else{
      $header_img = isset( $wooxon['optn_header_img'] ) ? $wooxon['optn_header_img'] : array( 'url' => get_template_directory_uri() . '/assets/images/page-title.gif' );  
      $header_title_text_align =  isset( $wooxon['optn_header_title_text_align'] ) ? $wooxon['optn_header_title_text_align'] : 'c'; 
      
        $page_header_title =  isset( $wooxon['page_header_title'] ) ? $wooxon['page_header_title'] : 1;
    }
    $breadcrubm_layout =  get_post_meta(get_the_ID(),'wooxon_disable_breadcrubm_layout',true);
    if (!isset($breadcrubm_layout) || $breadcrubm_layout == '1') {
        $breadcrubm_layout =  isset( $wooxon['optn_breadcrubm_layout'] ) ? $wooxon['optn_breadcrubm_layout'] : 1;        
    }
    
    $breadcrubm_width =  isset( $wooxon['main-width-content'] ) ? $wooxon['main-width-content'] : 'container';    
    $breadcrumb_disable =  isset( $wooxon['breadcrumbs_disable'] ) ? $wooxon['breadcrumbs_disable'] : 1;
     
    
    $breadcrubm_name =  isset( $wooxon['optn_breadcrumb_name'] ) ? $wooxon['optn_breadcrumb_name'] : esc_html__('Home', 'wooxon');
    $breadcrubm_delimiter =  isset( $wooxon['optn_breadcrumb_delimiter'] ) ? $wooxon['optn_breadcrumb_delimiter'] : 'fa fa-angle-right';
    $header_img_repeat =  isset( $wooxon['optn_header_img_repeat'] ) ? $wooxon['optn_header_img_repeat'] : 'repeat';
    $breadcrumbs_prefix =  isset( $wooxon['breadcrumbs_prefix'] ) ? $wooxon['breadcrumbs_prefix'] : '';  
    $page_sub_title = strip_tags(term_description());    
    
    $sub_title_html = '';
    $breadcrumbs_prefix_html ='';
   if ($page_sub_title != '') :
        $sub_title_html = '<span class="cat-dsc dib mt10"> ' . esc_attr($page_sub_title) .'</span>';
     endif;    
   if ($breadcrumbs_prefix != '') :
        $breadcrumbs_prefix_html = '<span class="prefix"> ' . esc_attr($breadcrumbs_prefix) .'</span>';
     endif;

$showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
$delimiter = '<i class="'. esc_attr($breadcrubm_delimiter) .'" aria-hidden="true"></i> '; // delimiter between crumbs
$home = $breadcrubm_name; // text for the 'Home' link
$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
$before = '<span class="current">'; // tag before the current crumb
$after = '</span>'; // tag after the current crumb


    
$top_banner_class = '';
$top_banner_style = '';
if ( trim( $header_img['url'] ) != '' ) {
    $top_banner_class .= ' has-bg-img';
    $top_banner_style = 'style="background: ' . esc_attr(isset($wooxon['optn_header_img_bg_color']) ? $wooxon['optn_header_img_bg_color'] : '#f4f4f4' ) .' url(' . esc_url( $header_img['url'] ) . ') ' . esc_attr( $header_img_repeat ) . ' center center;"';
}
else{
    $top_banner_class .= ' no-bg-img';
}


$title = '';

if ( is_front_page() && is_home() ) {
    // Default homepage
    
} elseif ( is_front_page() ) {
    // static homepage
    
} elseif ( is_home() ) {
    // blog page
    $post_id = get_option( 'page_for_posts' );
    $title =  wooxon_get_option_data('blog_page_title','Blog');
    $top_banner_style = wooxon_single_header_bg_style( $post_id );
    
    if ( trim( $top_banner_style ) != '' ) {
        $top_banner_class = 'has-bg-img';
    }
    else{
        $top_banner_class = 'no-bg-img';
    }
    
} else {
    
     if ( is_404() ) { //404 page return
         return;
     }
    //everything else
    
    // Is a singular
    if ( is_singular()) {
        
        $title = get_post_meta( get_the_ID(), 'wooxon_custom_header_title', true );
        if (!isset($title) || $title == '-1' || $title == '') {
            $title = get_the_title( get_the_ID() );
        }
       
        $show_single = get_post_meta( get_the_ID(), 'wooxon_single_header_title_section', 'global' );
        if ( $show_single == 'dont_show' && $breadcrubm_layout == '0' ) {
            echo '<div class="just-wraper"></div>';            
            return;
        }elseif($show_single == 'dont_show' && $breadcrubm_layout == '1' || $show_single == 'dont_show' && $breadcrubm_layout == '2'){
            $title = '';
        }
        $top_banner_style = wooxon_single_header_bg_style();
        $header_title_text_align =  isset( $wooxon['optn_header_title_text_align'] ) ? $wooxon['optn_header_title_text_align'] : 'c';
        if($show_single == 'dont_show'){
           $header_title_text_align =  'l bread';
        }
        
    }else{
        // Is archive or taxonomy
        if ( is_archive() ) {            
            if( is_post_type_archive() ){
                 $title = post_type_archive_title( '', false );
            }else{
                $title = single_cat_title('', false);
            }
            
        }else{           
            if ( is_404() ) {
                $title = isset( $wooxon['optn_404_breadcrumb'] ) ? $wooxon['optn_404_breadcrumb'] : esc_html__( 'Oops 404 !', 'wooxon' );
            }else{ 
                if ( is_search() ) {
                    $title = sprintf( esc_html__( 'Search results for: %s', 'wooxon' ), get_search_query() );
                }
                else{
                    // is category, is tag, is tax
                    $title = single_cat_title( '', false );   
                } 
            }
        }        
    }
}

if ( trim( $top_banner_style ) != '' ) {
    $top_banner_class = 'has-bg-img';
}
else{
    $top_banner_class = 'no-bg-img';
}

$top_banner_text_align = '';
$top_banner_text_align .= ' t_' .$header_title_text_align ;

$title_html = '';
if(!empty($title)){
   $title_html = '<h1>' . esc_html($title) . '</h1>' . wp_kses_post($sub_title_html);
}
    // custom breadcrumbs
      global $post;
      $homeLink = home_url( '/' );

      if (is_front_page()) {

        if ($showOnHome == 1)  echo '<div class="just-wraper"></div>';

      }else {
          
          if($breadcrumb_disable == 0 || is_tax('dc_vendor_shop') || function_exists( 'dokan_is_store_page' ) && dokan_is_store_page()  ){
                echo '<div class="just-wraper"></div>';
                return;
            }
           echo '<section class="page-header '. esc_attr($top_banner_class . ' ' . $top_banner_text_align).'" '.  wp_kses_post($top_banner_style) .'>
                <div class="' . esc_attr($breadcrubm_width) . '">';
           if(!is_single()){
               echo wp_kses_post($title_html);
           }
           
           if(is_home()){
               $cat_id =  wooxon_get_option_data('blog_page_cat', array()); 
               if($cat_id != ''){
                    echo '<ul class="ul-no mt25">';               
                    wp_list_categories(array('include'=> $cat_id, 'orderby' => 'name', 'child_of' => 0, 'title_li' => ''));
                    echo '</ul>';
               }
            }           
           
           if( $breadcrubm_layout == 1 && !is_home() || $breadcrubm_layout == 2 && !is_home() || is_single() || is_day() || is_month() || is_year() || is_author()){
              if( is_tax('brand')){
                    echo '</div></section>';
                    return; //stop the next code when show breadcrubm brand
                }  
              echo '<div class="breadcrumb">' . wp_kses_post($breadcrumbs_prefix_html);
              echo  '<a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a> ' . wp_kses_post($delimiter) . ' ';
            }else{
                echo '</div></section>';
                return; //stop the next code when not show breadcrubm
            }          

        if ( is_category() ) {
          $thisCat = get_category(get_query_var('cat'), false);
          if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
          echo wp_kses_post($before)  . single_cat_title('', false) . wp_kses_post($after);

        }elseif ( is_home() ) {            
          echo wp_kses_post($before) . get_the_title( get_the_ID() ) . wp_kses_post($after);
        } elseif ( is_search() ) {
          echo wp_kses_post($before) . esc_html__('Search results for ', 'wooxon') . '"' . get_search_query() . '"' . wp_kses_post($after);

        } elseif ( is_day() ) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
          echo wp_kses_post($before) . get_the_time('d') . wp_kses_post($after);

        } elseif ( is_month() ) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo wp_kses_post($before) . get_the_time('F') . wp_kses_post($after);

        } elseif ( is_year() ) {
          echo wp_kses_post($before) . get_the_time('Y') . wp_kses_post($after);

        } elseif ( is_single() && !is_attachment() ) {
          if ( get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . esc_url($homeLink) . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
            if ($showCurrent == 1) echo ' ' . wp_kses_post($delimiter) . ' ' . wp_kses_post($before) . get_the_title() . wp_kses_post($after);
          } else {
            $cat = get_the_category(); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
            echo wp_kses_post($cats);
            if ($showCurrent == 1) echo wp_kses_post($before) . get_the_title() . wp_kses_post($after);
          }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
          $post_type = get_post_type_object(get_post_type());
          echo wp_kses_post($before) . $post_type->labels->singular_name . wp_kses_post($after);

        } elseif ( is_attachment() ) {
          $parent = get_post($post->post_parent);
          $cat = get_the_category($parent->ID); $cat = $cat[0];
          echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
          if ($showCurrent == 1) echo ' ' . wp_kses_post($delimiter) . ' ' . wp_kses_post($before) . get_the_title() . wp_kses_post($after);

        } elseif ( is_page() && !$post->post_parent ) {
         if(wooxon_is_buddypress()){ //buddy press since v 1.0
            if ( bp_is_group() ) {
                echo '<a href="' . esc_url( bp_get_groups_directory_permalink()) . '">' . esc_html__('Groups', 'wooxon') . '</a>' . ' ' . $delimiter;
              } elseif ( bp_is_user() ) {
                echo '<a href="' . esc_url( bp_get_members_directory_permalink()) . '">' . esc_html__('Members', 'wooxon') . '</a>' . ' ' . $delimiter;
              }             
          }
          
          if ($showCurrent == 1) echo wp_kses_post($before) . get_the_title() . wp_kses_post($after);

        } elseif ( is_page() && $post->post_parent ) {
          $parent_id  = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id  = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo wp_kses_post($breadcrumbs[$i]);
            if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
          }
          if ($showCurrent == 1) echo ' ' . wp_kses_post($delimiter) . ' ' . wp_kses_post($before) . get_the_title() . wp_kses_post($after);

        } elseif ( is_tag() ) {
          echo wp_kses_post($before) . esc_html__('Tags ', 'wooxon') . '"' . single_tag_title('', false) . '"' . wp_kses_post($after);

        } elseif ( is_author() ) {
           global $author;
          $userdata = get_userdata($author);
          echo wp_kses_post($before) . esc_html__('Posted by ', 'wooxon') . wp_kses_post($userdata->display_name .$after);

        } elseif ( is_404() ) {
          echo wp_kses_post($before) . esc_html__('Error 404 ', 'wooxon') . wp_kses_post($after);
        }

        if ( get_query_var('paged') ) {
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
          
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

        if(!is_home()){
            echo'</div> </div>';
        }    
        echo '</section>';

      }
    } 
} // end wooxon_breadcrumbs()

if ( !function_exists( 'wooxon_single_header_bg_style' ) ) {
    function wooxon_single_header_bg_style( $post_id = 0 ) {
        global $wooxon;
        $top_banner_style = '';
        
        $header_img = array(
            'url' => get_template_directory_uri() . '/assets/images/page-title.gif'
        );
        $header_img_repeat = 'repeat';
        $header_img_repeat =  isset( $wooxon['optn_header_img_repeat'] ) ? $wooxon['optn_header_img_repeat'] : 'repeat';
           
        
        if ( trim( $header_img['url'] ) != '' ) {
            if ( $header_img_repeat == 'no-repeat' ) {                
             $top_banner_style = 'style="background: '. esc_attr(isset($wooxon['optn_header_img_bg_color']) ? $wooxon['optn_header_img_bg_color'] : '#f4f4f4' ) .' url(' . esc_url( $header_img['url'] ) . ') ' . esc_attr( $header_img_repeat ) . ' center center; background-size: cover !important;"';   
            }
            elseif ( $header_img_repeat == 'fixed' ) {                
             $top_banner_style = 'style="background: '. esc_attr(isset($wooxon['optn_header_img_bg_color']) ? $wooxon['optn_header_img_bg_color'] : '#f4f4f4' ) .' url(' . esc_url( $header_img['url'] ) . ') ' . esc_attr( $header_img_repeat ) . ' center center; background-size: cover !important; background-attachment: fixed; background-position: 50% 50%"';   
            }
            else{
                $top_banner_style = 'style="background: '. esc_attr(isset($wooxon['optn_header_img_bg_color']) ? $wooxon['optn_header_img_bg_color'] : '#f4f4f4' ) .' url(' . esc_url( $header_img['url'] ) . ') ' . esc_attr( $header_img_repeat ) . ' center center;"';
            }
        }        
        return $top_banner_style;
        
    }
}