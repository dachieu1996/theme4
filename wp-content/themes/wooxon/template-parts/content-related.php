<?php
 //related post
$GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-medium-image'; 
$size = 'full';
if (isset($GLOBALS['wooxon_archive_loop']['image-size'])) {
    $size = $GLOBALS['wooxon_archive_loop']['image-size'];    
}
$target_post = isset( $GLOBALS['wooxon']['optn_blog_single_related_target'] ) ? trim( $GLOBALS['wooxon']['optn_blog_single_related_target'] ) : '';
$post_per_page = isset( $GLOBALS['wooxon']['optn_blog_single_related_post_per'] ) ? trim( $GLOBALS['wooxon']['optn_blog_single_related_post_per'] ) : '3';
$column = isset( $GLOBALS['wooxon']['optn_blog_single_related_post_col'] ) ? trim( $GLOBALS['wooxon']['optn_blog_single_related_post_col'] ) : '2';
$excerpt = '18';
if($column == '1'){
  $excerpt = '40';  
}
 
$orig_post = $post;
global $post;
if($target_post == 'tags'){
    $categories = wp_get_post_tags($post->ID);
}else{
    $categories = get_the_category($post->ID); 
}

    if ($categories) {
        $category_ids = array();
        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
        if($target_post == 'tags'){
            $args=array(
                'tag__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page'=> esc_attr($post_per_page), // Number of related posts that will be shown.
            );
        }else{
            $args=array(
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page'=> esc_attr($post_per_page), // Number of related posts that will be shown.
            );
        } 
        $navigation = $dots = '';
        if(function_exists(wooxon_is_mobile()) ){  
            $navigation = '"arrows":false,'; 
            $dots = '"dots":true,';
        }
        $col_before = $col_middle = $col_after = '';
        if($column == 1 ){
            $col_before = '<div class="row"><div class="col-md-6">';
            $col_middle = '</div><div class="col-md-6">';
            $col_after = '</div></div>';
        }

        $related_post = new wp_query( $args );
        if( $related_post->have_posts() ): ?>
        <div class="hsc mb50 related-column-<?php echo esc_attr($column); ?>">
            <h3 class="h_line_f mb40"><?php esc_html_e( 'You may also like', 'wooxon' ); ?></h3>
            <div class="piko-carousel sh" data-slick='{"slidesToShow": <?php echo esc_attr($column .','. $navigation . $dots  ); ?>"slidesToScroll": 1,"responsive":[{"breakpoint": 768,"settings":{"slidesToShow": 1}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>
                <?php while ( $related_post->have_posts() ) : $related_post->the_post(); ?>
                        <div class="entry entry-grid">
                                <?php echo  wp_kses_post( $col_before ); ?>
                                <figure>
                                    <?php $thumbnail = wooxon_post_format($size);
                                    if (!empty($thumbnail)) : ?>                                            
                                            <?php echo wp_kses_post($thumbnail); ?>                                            
                                    <?php endif; ?>
                                </figure>
                                <?php echo  wp_kses_post( $col_middle ); ?>
                                <?php wooxon_entry_header();?>
                                <div class="entry-content">
                                  <?php 
                                  if ( ! has_excerpt() ) {
                                        echo '<p>'. wp_trim_words( get_the_content(), esc_attr($excerpt), ' ... ' ) . '</p>';
                                    } else { 
                                        echo '<p>'. wp_trim_words( get_the_excerpt(), esc_attr($excerpt), ' ... ' ) .  '</p>';
                                    }                                      
                                  ?> 
                                </div><!-- End .entry-content -->                                

                            <?php  echo wp_kses_post( $col_after ); ?>
                        </div>                 
                <?php endwhile; ?>                
             </div>
        </div>
        <?php    
        endif;
    }
$post = $orig_post;
wp_reset_postdata();