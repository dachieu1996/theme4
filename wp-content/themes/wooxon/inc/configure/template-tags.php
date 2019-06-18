<?php
/**
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 */

if ( ! function_exists( 'wooxon_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * Create your own wooxon_entry_meta() function to override in a child theme.
 *
 */
function wooxon_entry_footer() {
        $social_shear = wooxon_get_option_data('blog_single_social_share', true);
        $archive_layout_style = wooxon_get_option_data('optn_archive_display_type', 'default');
        $format = get_post_format() ? get_post_format() : esc_html__('Standard', 'wooxon');
        $format_link = get_post_format_link($format);
        if (function_exists('wooxon_setPostViews')) { wooxon_setPostViews(get_the_ID());}
        $categories_list = get_the_category_list( esc_html__( ', ', 'wooxon' ) );
        $tags_list = get_the_tag_list( '', esc_html__( ', ', 'wooxon' ) );
        $metaTag = wooxon_get_option_data('optn_blog_post_metatag_single', array(''));
        $col_class = '';
        ?>
        <div class="meta-wrap">              
            <a class="meta-author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i><?php the_author(); ?></a>
            <span><i class="fa fa-clock-o" aria-hidden="true"></i><?php wooxon_entry_date();?> </span>  
            <?php if ( !empty( $metaTag ) ): ?>
            <?php if ( in_array( 'format', $metaTag ) ): ?>                        
              <span><a class="meta-format" href="<?php echo esc_url($format_link);?>"><i class="fa fa-cog" aria-hidden="true"></i><?php echo esc_html($format);?></a></span>
             <?php endif; ?>
            <?php if(is_single() && function_exists('wooxon_post_love_display') && in_array( 'love', $metaTag )): ?>           
             <span><i class="fa fa-heart-o" aria-hidden="true"></i><?php  wooxon_post_love_display(); ?></span>           
             <?php endif; ?>
            <?php if ( function_exists('wooxon_getPostViews') && in_array( 'view', $metaTag ) ): ?>
            <span class="meta-view"><i class="fa fa-eye" aria-hidden="true"></i><?php  echo esc_html__('View: ', 'wooxon') . wooxon_getPostViews(get_the_ID()); ?></span>            
            <?php endif; ?>
            <?php endif; ?>
            <span class="meta-comment">
                <i class="fa fa-comments-o" aria-hidden="true"></i><?php echo comments_popup_link( esc_html__( '0 Comment', 'wooxon' ), esc_html__( '1 Comment', 'wooxon' ), esc_html__( '% Comments', 'wooxon' ) ); ?>
            </span>
            <?php 
            
            if ( $categories_list ) {
                    printf( '<span class="entry-cat"><i class="fa fa-tags" aria-hidden="true"></i>' . esc_html__( '%1$s ', 'wooxon' ) . '</span>', $categories_list);
            }       
            
            ?>            
        </div><!-- End .entry-meta-container -->
        
        <?php if($social_shear == 1 && is_singular()){ 
            wooxon_post_share();      
        }
         if(is_singular()){ 
           $col_class = 'col-12';
        }
        if ( $tags_list &&  $archive_layout_style == 'default' || $tags_list && is_singular() ) {            
                printf( '<span class="meta-wrap dib mt10 '. esc_attr($col_class).'">' . esc_html__( '%1$s ', 'wooxon' ) . '</span>', $tags_list);
        }
}
endif; //end entry footer

if ( ! function_exists( 'wooxon_grid_blog_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 */
function wooxon_grid_blog_meta() {
        ?>
        <div class="meta-wrap">              
            <div><i class="fa fa-clock-o" aria-hidden="true"></i><?php wooxon_entry_date();?></div>
        </div>       
        <?php       
        
}
endif; //end grid blog meta



function wooxon_post_share(){
global $wooxon;
$social_share = isset($wooxon['blog_single_social_share_page']) ? $wooxon['blog_single_social_share_page']: array();
     if ( !empty( $social_share ) ): ?>
            <ul class="social-icons xs ml-auto-sm d_flex pt15-sm">
                <?php if ( in_array( 'facebook', $social_share ) ): ?>                    
                    <li class="social-icon fa fa-facebook">
                    <a class="shear-icon-wrap" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=540,width=600');return false;">
                       <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on Facebook', 'wooxon' ), get_the_title() ); ?></span>
                    </a>
                    </li>        
                <?php endif; ?>
                <?php if ( in_array( 'twitter', $social_share ) ): ?>
                <li class="social-icon fa fa-twitter">
                    <a class="shear-icon-wrap" href="https://twitter.com/home?status=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=540,width=600');return false;">
                       <span class="text"><?php echo sprintf( esc_html__( 'Post status "%s" on Twitter', 'wooxon' ), get_the_title() ); ?></span>
                    </a>
                </li>    
                <?php endif; ?>
                <?php if ( in_array( 'gplus', $social_share ) ): ?>
                <li class="social-icon fa fa-google-plus">
                    <a class="shear-icon-wrap" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=540,width=600');return false;">
                        <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on Google Plus', 'wooxon' ), get_the_title() ); ?></span>
                    </a>
                </li>    
                <?php endif; ?>
                <?php if ( in_array( 'pinterest', $social_share ) ): ?>
                <li class="social-icon fa fa-pinterest">
                    <a class="shear-icon-wrap" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;description=<?php echo urlencode( get_the_excerpt() ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=540,width=600');return false;">
                        <span class="text"><?php echo sprintf( esc_html__( 'Pin "%s" on Pinterest', 'wooxon' ), get_the_title() ); ?></span>
                    </a>
                </li>    
                <?php endif; ?>
                <?php if ( in_array( 'linkedin', $social_share ) ): ?>
                    <li class="social-icon fa fa-linkedin">
                    <a class="shear-icon-wrap" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode( get_the_title() ); ?>&amp;summary=<?php echo urlencode( get_the_excerpt() ); ?>&amp;source=<?php echo urlencode( get_bloginfo( 'name' ) ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=540,width=600');return false;">
                        <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on LinkedIn', 'wooxon' ), get_the_title() ); ?></span>
                    </a>
                    </li>
                <?php endif; ?>
                <?php if ( in_array( 'tumbr', $social_share ) ): ?>
                    <li class="social-icon fa fa-tumblr">
                    <a class="shear-icon-wrap" href="//tumblr.com/widgets/share/tool?canonicalUrl=<?php esc_url( the_permalink() ); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=540,width=600');return false;">
                        <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on Tumbr', 'wooxon' ), get_the_title() ); ?></span>
                    </a>                      
                    </li>
                <?php endif; ?>
            </ul>
    <?php endif; // End if ( !empty( $socials_shared ) )     
}

if ( ! function_exists( 'wooxon_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own wooxon_entry_date() function to override in a child theme.
 *
 */
function wooxon_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" style="display:none" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		esc_html(_x( 'Posted on', 'Used before publish date.', 'wooxon' )),
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;

if(!function_exists('wooxon_entry_header')):
 /**
 * entry header blog list.
 */
    function wooxon_entry_header(){
    $archive_class = wooxon_get_option_data('optn_archive_display_type', 'default');
    $archive_display_columns = wooxon_get_option_data('optn_archive_display_columns', '1'); 
    $m_class = 'mb10';
    if($archive_class == 'grid' && $archive_display_columns != '1' || $archive_class == 'masonry' && $archive_display_columns != '1' ){
        $m_class = 'mb5';
    }
    ?> 
        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="d_flex justify-content-between align-items-center <?php echo esc_attr($m_class) ?>"> 
            <?php the_title( sprintf( '<h3 class="entry-title lh_3"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );  ?>
            <?php
                if ( is_sticky() && is_home() && ! is_paged() ) {
                    printf( '<span class="sticky-post f_s13 c_w bgc_p">%s</span>', esc_html__( 'Featured', 'wooxon' ) );
                }
                if ( has_post_format('quote') ) {
                    printf( '<span class="sticky-post f_s13 c_w bgc_p">%s</span>', esc_html__( 'Quote', 'wooxon' ) );
                }
                if ( has_post_format('link') ) {
                    printf( '<span class="sticky-post f_s13 c_w bgc_p">%s</span>', esc_html__( 'Link', 'wooxon' ) );
                }
            ?>
        </div>
        <?php endif;
    }
endif; //wooxon_entry_header


if ( !function_exists( 'wooxon_read_more_link' ) ) {
    function wooxon_read_more_link( $more_link_text = null,  $strip_teaser = false ) {
        global $wooxon, $page, $more, $preview, $pages, $multipage;
        $read_more_text = isset( $wooxon['opt_blog_continue_reading'] ) ? sanitize_text_field( $wooxon['opt_blog_continue_reading'] ) : esc_html__( 'Read More', 'wooxon' );
        if($read_more_text == ''){
            return;
        } 
	$post = get_post();

	if ( null === $more_link_text ) {
		$more_link_text = sprintf(
			'<span aria-label="%1$s">%2$s</span>',
			sprintf(
				/* translators: %s: Name of current post */
				$read_more_text,
				the_title_attribute( array( 'echo' => false ) )
			),
			$read_more_text
		);
	}

	$output = '';

	if ( $page >  $pages  ) // if the requested page doesn't exist
		$page =  $pages ; // give them the highest numbered page that DOES exist
        
	$content = $pages[$page - 1];
	if ( preg_match( '/<!--more(.*?)?-->/', $content, $matches ) ) {
		$content = explode( $matches[0], $content, 2 );
		if ( ! empty( $matches[1] ) && ! empty( $more_link_text ) )
			$more_link_text = strip_tags( wp_kses_no_null( trim( $matches[1] ) ) );
	}

	if ($content > 1 ) {		
			if ( ! empty( $more_link_text ) )

				/**
				 * Filters the Read More link text.
				 *
				 * @since 2.8.0
				 *
				 * @param string $more_link_element Read More link element.
				 * @param string $more_link_text    Read More text.
				 */
			$output .= '<a href="' . get_permalink() . '#more-'.esc_attr($post->ID).'" class="read_more f_w5 f_s14">' . esc_attr($read_more_text) . '</a>';			
		
        }else{
            $output .= '<a href="' . get_permalink() . '" class="read_more f_w5 f_s14">' . esc_attr($read_more_text) . '</a>';

        }

	if ( $preview ) // Preview fix for JavaScript bug with foreign languages.
		$output =	preg_replace_callback( '/\%u([0-9A-F]{4})/', '_convert_urlencoded_to_entities', $output );

	return $output;
       
    }
    add_filter( 'the_content_more_link', 'wooxon_read_more_link' );
}
if(!function_exists('wooxon_default_entry_header_meta_bottom'))  {
  function wooxon_default_entry_header_meta_bottom(  ) {
        $categories_list = get_the_category_list( esc_html__( ', ', 'wooxon' ) );
        ?>
        <div class="meta-wrap">              
            <a class="meta-author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i><?php the_author(); ?></a>
            <span><i class="fa fa-clock-o" aria-hidden="true"></i><?php wooxon_entry_date();?> </span> 
            <?php             
            if ( $categories_list ) {
                    printf( '<span class="entry-cat"><i class="fa fa-tags" aria-hidden="true"></i>' . esc_html__( '%1$s ', 'wooxon' ) . '</span>', $categories_list);
            }
            ?>            
        </div>        
        <?php
  }
}

if(!function_exists('wooxon_remove_vc_from_excerpt'))  {
  function wooxon_remove_vc_from_excerpt( $excerpt ) {
    $patterns = "/\[[\/]?vc_[^\]]*\]/";
    $replacements = "";
    return preg_replace($patterns, $replacements, $excerpt);
  }
}
if(!function_exists('wooxon_trim_word')) {
  function wooxon_trim_word($charlength) { 
    global $word_count, $post; 
    $word_count = isset($word_count) && $word_count != "" ? $word_count : $charlength; 
    $post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content); $clean_excerpt = strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;
    $clean_excerpt = strip_shortcodes(wooxon_remove_vc_from_excerpt($clean_excerpt));
    $excerpt_word_array = explode (' ',$clean_excerpt);
    $excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count); 
    $excerpt = implode (' ', $excerpt_word_array).'...'; echo ''.$excerpt.''; 
  } 
}


/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own wooxon_categorized_blog() function to override in a child theme.
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function wooxon_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'wooxon_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'wooxon_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so wooxon_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so wooxon_categorized_blog should return false.
		return false;
	}
}

/**
 * Flushes out the transients used in wooxon_categorized_blog().
 *
 * @since wooxon
 */
function wooxon_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'wooxon_categories' );
}
add_action( 'edit_category', 'wooxon_category_transient_flusher' );
add_action( 'save_post',     'wooxon_category_transient_flusher' );
