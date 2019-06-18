<?php
/**
 * The template for displaying search forms
 *
 */
$ajax['enable'] = wooxon_get_option_data( 'search_ajax' );
$ajax['product'] = wooxon_get_option_data( 'search_ajax_product' );
$ajax['post'] = wooxon_get_option_data( 'search_ajax_post' );
$category = wooxon_get_option_data( 'search_category' );

$ajax['taxonomy'] = $ajax['name'] = 'category';
if( function_exists( 'WC' ) ){
   $ajax['taxonomy'] = $ajax['name'] = 'product_cat';
}

$class 	= '';
if( $ajax['enable'] ) {        
	$class .= 'piko-ajax-search-form';
	if ( $ajax['post'] && $ajax['product'] ) {
		$class .= ' all-results-on';
	} elseif ( $ajax['product'] ) {
		$class .= ' product-results-on';
	} elseif ( $ajax['post'] ) {
		$class .= ' post-results-on';
		$ajax['taxonomy'] = 'category';
		$ajax['name'] = 'cat';
	}
}
$unique_id = uniqid( 'search-form-' );
?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>"   class="header-search-form d_flex flex-nowrap icon-fix <?php echo esc_attr($class); ?> <?php if($category) echo 'cat-dropdown'; ?>">    
       <input id="<?php echo esc_attr($unique_id); ?>" type="text" placeholder="<?php esc_attr_e( 'Tìm kiếm...', 'wooxon' ); ?>" autocomplete="off" class="w100 order-2 border-no" value="<?php echo get_search_query(); ?>" name="s" required />
       <?php if(function_exists( 'WC' ) && $ajax['product']): ?>
       <input type="hidden" name="post_type" value="<?php echo ( function_exists( 'WC' ) && $ajax['product'] ) ? 'product': 'post' ; ?>" />
       <?php endif ?>
       <?php if ( defined( 'ICL_LANGUAGE_CODE' ) && ! defined( 'LOCO_LANG_DIR' ) ) : ?>
            <input type="hidden" name="lang" value="<?php echo ICL_LANGUAGE_CODE; ?>" />
        <?php endif ?>
        <?php if($category): ?>
        <div class="dropdown search-dropdown order-1">
            <div  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="search">
                <?php wp_dropdown_categories(array( 'show_option_all' => esc_html__( 'All categories', 'wooxon' ) ,'taxonomy' => $ajax['taxonomy'], 'id' => uniqid('product_cat-'), 'hierarchical' => true, 'name' => $ajax['name'], 'value_field' => 'slug')) ?>            
            </div>    
        </div><!-- End .dropdown -->
         <?php endif ?>
        <button type="submit" class="loading h_no border-no order-3"><i class="fa fa-circle-o-notch fa-spin fa-fw"></i></button>    
        <a class="button order-4 h_no border-no"><i class="icon-cross1" aria-hidden="true"></i></a>   
    <?php if($ajax['enable']): ?>
            <div class="piko-ajax-results-wrapper o_h"><div class="piko-ajax-results"></div></div>
    <?php endif ?>
</form>
