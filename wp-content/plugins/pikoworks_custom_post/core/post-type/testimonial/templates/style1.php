<?php
/**
 * The template part for displaying content
 */
?>
<article class="testimonial pr <?php esc_attr_e($col_class);?>">
    <figure>        
            <?php 
            if($open_icon == 'yes'){
                echo '<span class="quote fa fa-quote-left"></span>';
            }else{
                the_post_thumbnail(); 
            } ?>
    </figure>
        <div class="owner-meta">
        <?php echo '<p class="t_c mt25">'. wp_trim_words( get_the_excerpt(), esc_attr($excerpt) ) . '</p>'; ?>        
            <h4 class="f_s18 t_c mt0"><?php the_title(); ?></h4>
            <div class="t_c f_s14">
                <span class="c_s3"><?php echo esc_html($designation);?></span> - 
                <span class="c_s3 "><?php echo $job  ;?></span>
            </div>
        </div>
</article>