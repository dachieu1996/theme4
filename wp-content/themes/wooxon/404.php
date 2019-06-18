<?php
/**
 * The template for displaying 404 pages (not found)
 *
 */
get_header(); ?>
<?php
$content_404 = isset( $GLOBALS['wooxon']['optn_404_content'] ) ? $GLOBALS['wooxon']['optn_404_content'] : '<h1>4<span class="c_p">0</span>4</h1><h2>PAGE NOT FOUND</h2><p>Sorry, the page you are looking for is not available.<br /> Maybe you want to perform a search?</p>';

?>
<div id="primary" class="content-area">
    <main id="main" class="error-page">            
        <section class="pa_center-lg t_c mt40-md">                
            <div class="error-page-text">
                <?php echo do_shortcode( $content_404); ?>
                <div class="search-no-results">
                    <div class="no-results mt25 mb40">
                        <div class="not-found">
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div><!-- End .error-page-text -->                
        </section><!-- End .row -->            
    </main><!-- End .error-page -->
</div>        
<?php get_footer(); ?>
