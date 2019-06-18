<?php
/**
 * The template part for displaying content
 */
$quote = '';
if($open_icon !='yes'){
    $quote = '<span class="quote fa fa-quote-left pr5"></span>';
}
?> 
<article class="testimonial <?php esc_attr_e($col_class);?>">
        <?php echo '<p class="class="lh_4"">'. balanceTags($quote).  wp_trim_words( get_the_excerpt(), esc_attr($excerpt) ) . '</p>'; ?>     
        <div class="owner-meta d_flex align-items-center">
            <div class="br50 o_h">
                <?php 
                if($open_icon == 'yes'){
                    echo '<span class="quote fa fa-quote-left"></span>';
                }else{
                    the_post_thumbnail();
                } ?>       
            </div>
            <h4 class="f_s18 lh_3 ml25"><?php the_title(); ?>
                <br />
                <span class="f_s14 c_s3"><?php echo esc_html($designation);?></span> - 
                <span class="f_s14 c_s3"><?php echo $job  ;?></span>                
            </h4>          
        </div>
</article>