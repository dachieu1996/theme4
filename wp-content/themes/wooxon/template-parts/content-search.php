<?php
/**
 * The template part for displaying results in search pages
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	        
    <?php if ( is_front_page() && ! is_home() ) {
            // The excerpt is being displayed within a front page section, so it's a lower hierarchy than h2.
            the_title( sprintf( '<h3 class="entry-title lh_3 f_s25"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
    } else {
            the_title( sprintf( '<h2 class="entry-title lh_3 f_s25"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
    } ?>
    <div class="entry-excerpt">
        <?php the_excerpt(); ?>
    <?php echo wooxon_read_more_link(); ?>
    </div><!-- /.entry-content -->        
</article><!-- #post-## -->