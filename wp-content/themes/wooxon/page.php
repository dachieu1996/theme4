<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 */

get_header();

$prefix = 'wooxon_';
$sidebar_position =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
if ( !isset($sidebar_position) || ($sidebar_position === '') || ($sidebar_position == '-1')) {
    $sidebar_position = isset( $GLOBALS['wooxon']['optn_page_sidebar_pos'] ) ? $GLOBALS['wooxon']['optn_page_sidebar_pos'] : 'fullwidth';
} 
$primary_class = wooxon_primary_page_sidebar_class();
$secondary_class = wooxon_secondary_page_sidebar_class();


$left_sidebar =  get_post_meta(get_the_ID(), $prefix . 'page_right_sidebar',true);
if (!isset($left_sidebar) || ($left_sidebar === '') || ($left_sidebar == '-1')) {
    $left_sidebar = isset( $GLOBALS['wooxon']['optn_page_sidebar'] ) ? $GLOBALS['wooxon']['optn_page_sidebar'] : '';
}
$right_sidebar =  get_post_meta(get_the_ID(), $prefix . 'page_left_sidebar',true);
if (!isset($right_sidebar) || ($right_sidebar === '') || ($right_sidebar == '-1')) {    
    $right_sidebar = isset( $GLOBALS['wooxon']['optn_page_sidebar_left'] ) ? $GLOBALS['wooxon']['optn_page_sidebar_left'] : '';
}

if ( !is_active_sidebar( $left_sidebar ) ) {
    $primary_class = ' col-sm-12';
}


?>
<?php if ( $sidebar_position == 'both'  && is_active_sidebar( $right_sidebar ) ): ?>
    <aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
            <?php dynamic_sidebar( $right_sidebar ); ?>
    </aside><!-- .sidebar .widget-area -->
<?php endif; ?>
        
    <div id="primary" class="content-area <?php echo esc_attr( $primary_class ); ?>">
            <main id="main" class="site-main">
                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();

                            // Include the page content template.
                            get_template_part( 'template-parts/content', 'page' );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) {
                                    comments_template();
                            }
                            // End of the loop.
                    endwhile;
                    ?>

            </main><!-- .site-main -->
    </div><!-- .content-area -->


<?php if ( $sidebar_position != 'fullwidth'  && is_active_sidebar( $left_sidebar ) || $sidebar_position == 'both'  && is_active_sidebar( $left_sidebar ) ): ?>
    <aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
            <?php dynamic_sidebar( $left_sidebar ); ?>
    </aside><!-- .sidebar .widget-area -->
<?php endif; ?>
<?php get_footer(); ?>
