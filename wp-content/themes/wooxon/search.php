<?php
/**
 * The template for displaying search results pages
 *
 */

get_header();

$sidebar_position = isset( $GLOBALS['wooxon']['optn_search_sidebar_pos'] ) ? trim( $GLOBALS['wooxon']['optn_search_sidebar_pos'] ) : 'right';
$left_sidebar = isset( $GLOBALS['wooxon']['optn_search_sidebar'] ) ? trim( $GLOBALS['wooxon']['optn_search_sidebar'] ) : 'sidebar-1';
$right_sidebar = isset( $GLOBALS['wooxon']['optn_search_sidebar_left'] ) ? trim( $GLOBALS['wooxon']['optn_search_sidebar_left'] ) : '';
$primary_class = wooxon_primary_search_class();
$secondary_class = wooxon_secondary_search_class();

if ( !is_active_sidebar( $left_sidebar ) ) {
    $primary_class = ' col-sm-12';
}

?>
<?php if ( $sidebar_position == 'both' && is_active_sidebar( $right_sidebar ) ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $right_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>

	<section id="primary" class="content-area <?php echo esc_attr( $primary_class ); ?>">
		<main id="main" class="site-main hsc" role="main">

		<?php if ( have_posts() ) : ?>
			<?php
                        /**
                         * wooxon_before_loop_posts hook
                         * 
                         * @hooked wooxon_before_loop_posts_wrap - 10 (locate in inc/template-tags.php )
                         **/ 
                        do_action( 'wooxon_before_loop_posts' ); 
                        
                        
			// Start the loop.
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			// End the loop.
			endwhile;
                        
                        
                        /**
                         * wooxon_after_loop_posts hook
                         * 
                         * @hooked wooxon_after_loop_posts_wrap - 10 (locate in inc/template-tags.php )
                         **/ 
                        do_action( 'wooxon_after_loop_posts' ); 

			 // Previous/next page navigation.
                        wooxon_pagination();

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/archive/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php if ( $sidebar_position != 'fullwidth' && is_active_sidebar( $left_sidebar ) || $sidebar_position == 'both' && is_active_sidebar( $left_sidebar ) ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $left_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
<?php get_footer(); ?>
