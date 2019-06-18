<?php
/**
 * The template part for displaying content
 */

$size = 'full';
if (isset($GLOBALS['wooxon_archive_loop']['image-size'])) {
    $size = $GLOBALS['wooxon_archive_loop']['image-size'];
}
$archive_title_position = isset( $GLOBALS['wooxon']['optn_archive_title_position'] ) ? trim( $GLOBALS['wooxon']['optn_archive_title_position'] ) : 'image-bottom';
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
    <?php wooxon_entry_header();?>
    <div class="entry-excerpt mb40">                
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
        <?php echo wooxon_read_more_link(); ?>
    </div>
</article>