<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 */
$size = 'full';
if (isset($GLOBALS['wooxon_archive_loop']['image-size'])) {
    $size = $GLOBALS['wooxon_archive_loop']['image-size'];
}
$archive_title_position = isset( $GLOBALS['wooxon']['optn_archive_title_position'] ) ? trim( $GLOBALS['wooxon']['optn_archive_title_position'] ) : 'image-bottom';
$charlength = isset( $GLOBALS['wooxon']['optn_archive_except_word'] ) ? trim( $GLOBALS['wooxon']['optn_archive_except_word'] ) : '55';

$prefix = 'wooxon_';

$quote_content = get_post_meta(get_the_ID(), $prefix.'post_format_quote', true);
$quote_author = get_post_meta(get_the_ID(), $prefix.'post_format_quote_author', true);
$quote_author_url = get_post_meta(get_the_ID(), $prefix.'post_format_quote_author_url', true);

$class = array();
$class[]= "clearfix";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php wooxon_entry_header();?>       
    <div class="entry-content">
        <?php if (empty($quote_content) || empty($quote_author)) : ?>
        <div class="entry-excerpt mb30"> 
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
        <?php else : ?>
            <blockquote>
                <p><?php echo esc_html($quote_content); ?></p>
                <cite><a href="<?php echo esc_url($quote_author_url) ?>" title="<?php echo esc_attr($quote_author); ?>"><?php echo esc_attr($quote_author); ?></a></cite>
            </blockquote>
        <?php endif; ?>
        </div>
    </div>
</article>
