<?php
/*---------------POST FORMATE--------------- */
if (!function_exists('wooxon_post_format')) {
    function wooxon_post_format($size = '') {
        $html = '';
        $prefix = 'wooxon_';
        $width = '';
        $height = '';
        global $wooxon_image_size;
        if (isset($wooxon_image_size[$size])) {
            $width = $wooxon_image_size[$size]['width'];
            $height = $wooxon_image_size[$size]['height'];
        }
        switch(get_post_format()) {
            case 'image' :
                $args = array(
                    'size' => $size,
                    'meta_key' => $prefix.'post_format_image'
                );
                $image = wooxon_get_image($args);
                if (!$image) break;
                $html = wooxon_get_image_warp($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                break;
            case 'gallery':
                $images = get_post_meta(get_the_ID(), $prefix.'post_format_gallery');
                if (count($images) > 0) {                   
                    $html = '<div class="piko-carousel sh" data-slick="{"slidesToScroll": 1,}">';                    
                    foreach ($images as $image) {

                        if (empty($width) || empty($height)) {
                            $image_src_arr = wp_get_attachment_image_src( $image, $size );
                            if ($image_src_arr) {
                                $image_src = $image_src_arr[0];
                            }
                        } else {
                            $image_src = matthewruddy_image_resize_id($image,$width,$height);
                        }

                        if (!empty($image_src)) {
                            $html .= wooxon_get_image_warp($image_src,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID(),1);
                        }
                    }
                    $html .= '</div>';
                } else {
                    $args = array(
                        'size' => $size,
                        'meta_key' => ''
                    );
                    $image = wooxon_get_image($args);
                    if (!$image) break;
                    $html = wooxon_get_image_warp($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                }
                break;
            case 'video':
                $video = get_post_meta(get_the_ID(), $prefix.'post_format_video');
                if (!is_single()) {
                    $args = array(
                        'size' => $size,
                        'meta_key' => ''
                    );
                    $image = wooxon_get_image($args);
                    if (!$image) {
                        if (count($video) > 0) {                            
                            $video = $video[0];
                            // If URL: show oEmbed HTML
                            if (filter_var($video, FILTER_VALIDATE_URL)) {
                                $args = array(
                                    'wmode' => 'transparent'
                                );
                                $embaded = wp_oembed_get($video, $args);
                                echo '<div class="mb15 embed-responsive embed-responsive-16by9">' . $embaded . '</div>'; 
                            }
                            
                        }
                    } else {
                        if(count($video) > 0){
                               $video = $video[0];
                        }else{
                                $video = '';
                        }
                        if (filter_var($video, FILTER_VALIDATE_URL)) {
                            $html .= wooxon_get_video_warp($image, get_permalink(), the_title_attribute('echo=0'), $video);
                        }
                    }
                } else {
                    if (count($video) > 0) {
                        
                        $video = $video[0];
                        // If URL: show oEmbed HTML
                        if (filter_var($video, FILTER_VALIDATE_URL)) {
                            $args = array(
                                'wmode' => 'transparent'
                            );
                            $embaded = wp_oembed_get($video, $args);
                            echo '<div class="embed-responsive embed-responsive-16by9">' . $embaded . '</div>'; 
                        } // If embed code: just display
                        
                    }
                }
                break;
            case 'audio':
                $audio = get_post_meta(get_the_ID(), $prefix.'post_format_audio');
                if (count($audio) > 0) {
                    $audio = $audio[0];
                    if (filter_var($audio, FILTER_VALIDATE_URL)) {                        
                        $embaded =  wp_oembed_get($audio);
                        echo '<div class="embed-responsive embed-responsive-16by9">' . $embaded . '</div>'; 
                    }
                    $html .= '<div style="clear:both;"></div>';
                }
                break;
            default:
                $args = array(
                    'size' => $size,
                    'meta_key' => ''
                );
                $image = wooxon_get_image($args);
                if (!$image) break;
                $html = wooxon_get_image_warp($image,$size, get_permalink(), the_title_attribute('echo=0'),get_the_ID());
                break;
        }
        return $html;
    }
}
/*------------------------GET POST IMAGE-------------------- */
if (!function_exists('wooxon_get_image')) {
    function wooxon_get_image($args) {
        $default = apply_filters(
            'wooxon_get_image_default_args',
            array(
                'post_id'  => get_the_ID(),
                'size'    => '',
                'width'    => '',
                'height'   => '',
                'attr'     => '',
                'meta_key' => '',
                'scan'     => false,
                'default'  => ''
            )
        );
        $args = wp_parse_args( $args, $default );
        $size = $args['size'];

        $width = '';
        $height = '';

        global $wooxon_image_size;
        if (isset($wooxon_image_size[$size])) {
            $width = $wooxon_image_size[$size]['width'];
            $height = $wooxon_image_size[$size]['height'];
        }
        if ( ! $args['post_id'] ) {
            $args['post_id'] = get_the_ID();
        }
        // Get image from cache
        $key         = md5( serialize( $args ) );
        $image_cache = wp_cache_get( $args['post_id'], 'wooxon_get_image' );

        if ( ! is_array( $image_cache ) ) {
            $image_cache = array();
        }

        if ( empty( $image_cache[$key] ) ) {

            $image_src = '';

            // Get post thumbnail
            if (has_post_thumbnail($args['post_id'])) {
                $post_thumbnail_id   = get_post_thumbnail_id($args['post_id']);

                if (empty($width) || empty($height)) {
                    $image_src_arr = wp_get_attachment_image_src( $post_thumbnail_id, $size );
                    if ($image_src_arr) {
                        $image_src = $image_src_arr[0];
                    }
                } else {
                    $image_src = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
                }
            }

            // Get the first image in the custom field
            if ((!isset($image_src) || empty($image_src))  && $args['meta_key']) {
                $post_thumbnail_id = get_post_meta( $args['post_id'], $args['meta_key'], true );
                if ( $post_thumbnail_id ) {

                    if (empty($width) || empty($height)) {
                        $image_src_arr = wp_get_attachment_image_src( $post_thumbnail_id, $size );
                        if ($image_src_arr) {
                            $image_src = $image_src_arr[0];
                        }
                    } else {
                        $image_src = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
                    }
                }
            }

            // Get the first image in the post content
            if ((!isset($image_src) || empty($image_src)) && ($args['scan'])) {
                preg_match( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );
                if ( ! empty( $matches ) ){
                    $image_src  = $matches[1];
                }
            }

            // Use default when nothing found
            if ( (!isset($image_src) || empty($image_src)) && ! empty( $args['default'] ) ){
                if ( is_array( $args['default'] ) ){
                    $image_src  = $args['src'];
                } else {
                    $image_src = $args['default'];
                }
            }

            if (!isset($image_src) || empty($image_src)) {
                return false;
            }
            $image_cache[$key] = $image_src;
            wp_cache_set( $args['post_id'], $image_cache, 'wooxon_get_image' );
        } else {
            $image_src = $image_cache[$key];
        }
        $image_src = apply_filters( 'wooxon_get_image', $image_src, $args );
        return $image_src;
    }
}

if (!function_exists('wooxon_get_video_warp')) {
    function wooxon_get_video_warp($image, $url, $title, $video_url) {
        return sprintf('<div class="piko-video pr">
                        <a class="piko-embed" href="%4$s" title="%2$s">
                            <img src="%3$s" alt="%2$s"/>
                            <i class="pa_center br50 c_s20 c_w t_c fa fa-play"></i>
                        </a>                       
                      </div>',
            $url,
            $title,
            $image,
            $video_url
        );
    }
}
/*--------------------GET IMAGE WARP------------------------- */
if (!function_exists('wooxon_get_image_warp')) {
    function wooxon_get_image_warp($image,$size, $url, $title, $post_id,$gallery = 0) {
        $attachment_id = wooxon_get_attachment_id_from_url($image);
        
        $image_full_arr = wp_get_attachment_image_src($attachment_id,'full');

        $image_full = $image;

        if (isset($image_full_arr)) {
            $image_full = $image_full_arr[0];
        }

	    $width = '';
	    $height = '';

	    global $wooxon_image_size;
	    if (isset($wooxon_image_size[$size])) {
		    $width = $wooxon_image_size[$size]['width'];
		    $height = $wooxon_image_size[$size]['height'];
	    } else {
		    global $_wp_additional_image_sizes;
		    if ( in_array( $size, array( 'thumbnail', 'medium', 'large' ) ) ) {
			    $width = get_option( $size . '_size_w' );
			    $height = get_option( $size . '_size_h' );

		    } elseif ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
			    $width = $_wp_additional_image_sizes[ $size ]['width'];
			    $height = $_wp_additional_image_sizes[ $size ]['height'];
		    }
	    }

        $prettyPhoto = 'single';
        if ($gallery == 1) {
            $prettyPhoto= 'gallary';
        }

	    if (empty($width) || empty($height)) {
		    return sprintf('<div class="entry-thumbnail">
                        <a href="%1$s" title="%2$s" class="entry-thumbnail_overlay">
                            <img class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>                        
                      </div>',
			    $url,
			    $title,
			    $image,
			    $image_full,
			    $prettyPhoto
		    );
	    } else {               
                
		    return sprintf('<div class="entry-thumbnail">
                        <a href="%1$s" title="%2$s" class="entry-thumbnail_overlay">
                            <img width="%6$s" height="%7$s" class="img-responsive" src="%3$s" alt="%2$s"/>
                        </a>                        
                      </div>',
			    $url,
			    $title,
			    $image,
			    $image_full,
			    $prettyPhoto,
			    $width,
			    $height
		    );
	    }
        }
    }
/*--------------------GET ATTACHMENT ID FROM URL---------------------- */
if (!function_exists('wooxon_get_attachment_id_from_url')) {
    function wooxon_get_attachment_id_from_url($attachment_url = '') {
        global $wpdb;
        $attachment_id = false;
        // If there is no url, return.
        if ( '' == $attachment_url )
            return;
        // Get the upload directory paths
        $upload_dir_paths = wp_upload_dir();
        // Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
        if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
            // If this is the URL of an auto-generated thumbnail, get the URL of the original image
            $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
            // Remove the upload path base directory from the attachment URL
            $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
            // Finally, run a custom database query to get the attachment ID from the modified attachment URL
            $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

        }
        return $attachment_id;
    }
}
/*--------------IMAGE ARCHIVE LOOP RESET---------------*/
if (!function_exists('wooxon_archive_loop_reset')) {
    function wooxon_archive_loop_reset()
    {
        global $wooxon_archive_loop;
        $wooxon_archive_loop['image-size'] = '';
        $wooxon_archive_loop['style'] = '';
    }
}
/**
 * custom pagination fallback
 *
 * @since 1.0
 */
if ( ! function_exists( 'wooxon_pagination' ) ) {
	function wooxon_pagination( $nav_query = false ) {

		global $wp_query, $wp_rewrite;

		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
                
		$query        = $nav_query ? $nav_query : $wp_query;
		$max          = $query->max_num_pages;
		$current_page = max( 1, get_query_var( 'paged' ) );
		$big          = 999999;
		?>
		<nav class="piko-pagination">
			<?php
				echo '' . paginate_links(
					array(
						'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'    => '?paged=%#%',
						'current'   => $current_page,
						'total'     => $max,
						'type'      => 'list',
						'prev_text' => esc_html__( 'Prev', 'wooxon' ),
						'next_text' => esc_html__( 'Next', 'wooxon' ),
					)
				) . ' ';
			?>
		</nav> <!-- .piko-pagination -->
		<?php
	}
}
    
/**
 * custom comment fallback
 *
 * @since 1.0
 */
if ( ! function_exists( 'wooxon_comment_callback' ) ) {
	function wooxon_comment_callback( $comment, $args, $depth ) {
	
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :

			case 'pingback'  :
			case 'trackback' :
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<p>
						<?php
							echo esc_html__( 'Pingback: ', 'wooxon' );
							comment_author_link();
                                                        edit_comment_link( wp_kses_post( '<span class="pl10 c_p f_s14 f_w5">' . esc_html__( 'Edit', 'wooxon' ) . '</span>', 'wooxon' ) );
						?>
					</p>
				<?php
			break;

			default :
				global $post;
				?>
				<li <?php comment_class('mt30'); ?> id="li-comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>" class="comment_container">
                    	<?php echo get_avatar( $comment, 80 ); ?>

						<div class="comment-text">
							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'wooxon' ); ?></p>
							<?php endif; ?>

							<?php
								printf(
								'<div class="comment-author f_w5 f_s16">%1$s</div>',
									get_comment_author_link(),
									( $comment->user_id == $post->post_author ) ? '<span class="author-post">' . esc_html__( 'Post author', 'wooxon' ) . '</span>' : ''
								);
                                                                printf(
                                                                        '<span class="mb10 db f_s14">%3$s</span>',
                                                                        esc_url( get_comment_link( $comment->comment_ID ) ),
                                                                        '',
                                                                        sprintf( wp_kses_post( '%1$s %2$s', 'wooxon' ), get_comment_date(), '' )
                                                                );
							?>     
							<div>
								<?php comment_text(); ?>
							</div>


							<div class="f_w5 f_s14">
								<?php
									edit_comment_link( wp_kses_post( '<span class="pr10 c_p">' . esc_html__( 'Edit', 'wooxon' ) . '</span>', 'wooxon' ) );
									comment_reply_link(
										array_merge(
											$args,
											array(
												'reply_text' => wp_kses_post( '<span  class="c_p">' . esc_html__( 'Reply', 'wooxon' ) . '</span>', 'wooxon' ),
												'depth'      => $depth,
												'max_depth'  => $args['max_depth'],
											)
										)
									);
								?>
							</div><!-- .action-link -->
						</div><!-- .comment-content -->
					</article><!-- #comment- -->
				<?php
			break;

		endswitch;
	}
}