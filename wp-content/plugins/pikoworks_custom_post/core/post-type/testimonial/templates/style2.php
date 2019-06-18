<?php
/**
 * The template part for displaying content
 */
?>
<article class="testimonial pr <?php esc_attr_e($col_class);?>">
    <figure>
        <span class="quote fa fa-quote-left"></span>
    </figure>
    <div class="owner-meta">
        <?php echo '<p class="mt25">'. wp_trim_words( get_the_excerpt(), esc_attr($excerpt) ) . '</p>'; ?>
        <div class="d_flex align-items-center">
            <div class="br50 o_h"><?php the_post_thumbnail(); ?></div>
            <h4 class="f_s18 lh_3 ml25"><?php the_title(); ?>
                <br />
                <span class="f_s14 c_s3"><?php echo esc_html($designation);?></span> - 
                <span class="f_s14 c_s3"><?php echo $job  ;?></span>                
            </h4>
        </div>
    </div> 
</article>


