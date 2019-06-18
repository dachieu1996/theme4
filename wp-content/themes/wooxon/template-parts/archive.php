<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header();
$sidebar_position = wooxon_get_option_data('optn_blog_sidebar_pos', 'right'); 
$left_sidebar = wooxon_get_option_data('optn_blog_sidebar', 'sidebar-1'); 
$right_sidebar = wooxon_get_option_data('optn_blog_sidebar_left', ''); 
$archive_layout_style = wooxon_get_option_data('optn_archive_display_type', 'default'); 
$archive_display_columns = wooxon_get_option_data('optn_archive_display_columns', '1'); 
$primary_class = wooxon_primary_blog_class();
$secondary_class = wooxon_secondary_blog_class();
$post_count = 0;
$class_row = '';

if ( !is_active_sidebar( $left_sidebar ) ) {
    $primary_class = ' col-sm-12';
}


switch ($archive_layout_style) {    
    case 'list':
            $GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-2cols-image';
            break;
    case 'grid':
        if($archive_display_columns == '1'){
            $GLOBALS['wooxon_archive_loop']['image-size'] = 'full';
        }elseif($archive_display_columns == '2'){
            $GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-2cols-image'; 
        }elseif($archive_display_columns == '3'){
            $GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-3cols-image'; 
        }elseif($archive_display_columns == '4'){
            $GLOBALS['wooxon_archive_loop']['image-size'] = 'wooxon-4cols-image'; 
        }
        $class_row = "row";
       
        break;
}

?>
<?php if ( $sidebar_position == 'both' && is_active_sidebar( $right_sidebar )): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $right_sidebar ); ?>
	</aside><!-- .sidebar left.widget-area -->
<?php endif; ?>

	<div id="primary" class="content-area blog-wrap layout-container <?php echo esc_attr( $primary_class . ' ' . $archive_layout_style ); ?>">
		<main id="main" class="site-main hsc <?php echo esc_attr($class_row); ?>">

		<?php if ( have_posts() ) : ?>
                        
                        <?php                
                        
                        if($archive_layout_style =='masonry'){
                            get_template_part( 'template-parts/archive/content-masonry', get_post_format() ); 
                        }else{                        
                        
			// Start the loop.
			while ( have_posts() ) : the_post(); 
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
                                switch($archive_layout_style){
                                    case 'list':
                                        get_template_part( 'template-parts/archive/content-list', get_post_format() );
                                        break;                                    
                                    case 'grid':
                                        get_template_part( 'template-parts/archive/content', get_post_format() );                                       
                                        break;                                   
                                    default:
                                        get_template_part( 'template-parts/content', get_post_format() );
                                                                              
                                }
                                
			// End the loop.
                        endwhile; }                          
                        wooxon_archive_loop_reset(); 			          
                        
		// If no content, include the "No posts found" template.
		else :
			wooxon_get_template( 'archive/content', 'none' );

		endif;
		?>   

		</main><!-- .site-main -->
                <?php
                // Previous/next page navigation.
                wooxon_pagination();
                ?>
	</div><!-- .content-area -->

<?php if ( $sidebar_position != 'fullwidth' && is_active_sidebar( $left_sidebar ) || $sidebar_position == 'both' && is_active_sidebar( $left_sidebar ) ): ?>
	<aside id="secondary" class="widget-area <?php echo esc_attr( $secondary_class ); ?>" role="complementary">
		<?php dynamic_sidebar( $left_sidebar ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
<?php get_footer(); ?>
