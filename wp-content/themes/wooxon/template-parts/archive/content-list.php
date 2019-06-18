<?php
/**
 * The template part for displaying content
 */

$size = 'full';
if (isset($GLOBALS['wooxon_archive_loop']['image-size'])) {
    $size = $GLOBALS['wooxon_archive_loop']['image-size'];
}
$charlength = isset( $GLOBALS['wooxon']['optn_archive_except_word'] ) ? trim( $GLOBALS['wooxon']['optn_archive_except_word'] ) : '55';
$thumbnail = wooxon_post_format($size);

$html_before = $html_middle = $html_after = '';
if(!empty($thumbnail) && get_post_format() !== 'audio'){
    $html_before = '<div class="row"><div class="col-md-7">';
    $html_middle = '</div><div class="col-md-5">';
    $html_after = '</div></div>';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>    
        <?php
        echo wp_kses_post($html_before);

        if (!empty($thumbnail)) : ?>
            <figure class="entry-media">
                <?php echo wp_kses_post($thumbnail); ?>
            </figure>
        <?php endif; ?> 

     <?php echo wp_kses_post($html_middle); ?>

        <?php wooxon_entry_header();?>
        <div class="entry-excerpt">                
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
     <?php echo wp_kses_post($html_after); ?>
</article>