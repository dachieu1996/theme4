<?php
/**
 * The template part for displaying content
 */
$archive_display_columns = wooxon_get_option_data('optn_archive_display_columns', '1');
$archive_layout_style = wooxon_get_option_data('optn_archive_layout_style', ''); 
$charlength = wooxon_get_option_data('optn_archive_except_word', '55'); 
?>

<div id="masonry-grid" class="row max-col-<?php echo esc_attr($archive_display_columns) ?>">
<?php

$post_count = 0;
while ( have_posts() ) : the_post(); 


$post_count++;
if ($post_count % 2 == 0) {
    $GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-masonry2';
}elseif ($post_count % 3 == 0) {
    $GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-masonry3';
}elseif($post_count % 4 == 0){
     $GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-masonry4';
}elseif($post_count % 5 == 0){
     $GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-masonry5';
}elseif($post_count % 6 == 0){
     $GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-masonry1';
}elseif($post_count % 7 == 0){
     $GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-masonry3';
}else{
    $GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-masonry1';
} 

$size = 'full';
if (isset($GLOBALS['wooxon_archive_loop']['image-size'])) {
    $size = $GLOBALS['wooxon_archive_loop']['image-size'];    
}
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php
        $thumbnail = wooxon_post_format($size);
        if (!empty($thumbnail)) : ?>
            <figure class="entry-media">
             <?php echo wp_kses_post($thumbnail); ?>
            </figure>
        <?php endif; ?>       
        <?php wooxon_entry_header();?>
        <div class="entry-content mb35">                
            <?php
                /* translators: %s: Name of current post */                  

                echo '<p>'. wooxon_trim_word($charlength). '</p>';

                wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wooxon' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'wooxon' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                ) );
            ?>                
        </div> 
    </article>
    <?php 
        endwhile;
        wooxon_archive_loop_reset(); 
    ?>
</div>        
      