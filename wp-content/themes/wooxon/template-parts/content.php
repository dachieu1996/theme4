<?php
/**
 * The template part for displaying content
 */

$size = 'full';
if (isset($GLOBALS['wooxon_archive_loop']['image-size'])) {
    $size = $GLOBALS['wooxon_archive_loop']['image-size'];
}

$charlength = isset( $GLOBALS['wooxon']['optn_archive_except_word'] ) ? trim( $GLOBALS['wooxon']['optn_archive_except_word'] ) : '55';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>  
        
    <?php
    $thumbnail = wooxon_post_format($size);
    if (!empty($thumbnail)) : ?>
        <figure class="entry-media">
            <?php echo wp_kses_post($thumbnail); ?>
        </figure>
    <?php endif; ?> 
    <?php 
    wooxon_entry_header();
    wooxon_default_entry_header_meta_bottom();
    ?>    
    <div class="entry-excerpt clearfix">
        <p><?php wooxon_trim_word($charlength); ?></p>
        <?php
            wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wooxon' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'wooxon' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
            ) );
        ?>
        <?php echo wooxon_read_more_link(); ?>
    </div>
</article>