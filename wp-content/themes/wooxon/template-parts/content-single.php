<?php
/**
 * The template part for displaying single posts
 *
 */
$size = 'full';
if (isset($GLOBALS['wooxon_archive_loop']['image-size'])) {
    $size = $GLOBALS['wooxon_archive_loop']['image-size'];
}
$related_post = isset( $GLOBALS['wooxon']['optn_blog_single_related_post'] ) ? $GLOBALS['wooxon']['optn_blog_single_related_post'] : 0;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
         <?php
    $thumbnail = wooxon_post_format($size);
    if (!empty($thumbnail)) : ?>
        <figure class="entry-thumbnail-wrap entry-media hsc">
            <?php echo wp_kses_post($thumbnail); ?>
        </figure>
    <?php endif; ?> 
    <?php the_title( '<h3>', '</h3>' ); ?>
	<div class="entry-content clearfix">
            <?php 
            the_content();
            
            wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wooxon' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'wooxon' ) . ' </span>%',
                            'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
            
            ?>
	</div><!-- .entry-content -->
	<footer class="entry-footer row no-gutters align-items-center mt30 mb50">
		 <?php wooxon_entry_footer(); ?>
        </footer><!-- .entry-footer -->
        
        <?php
        if ( '' !== get_the_author_meta( 'description' ) ) {
                        get_template_part( 'template-parts/biography' );
            }  
        ?>        
        
</article><!-- #post-## -->

<?php
    if($related_post == 1){
        get_template_part( 'template-parts/content-related');
     }   
?>  
