<?php

if(!function_exists('wooxon_widgets_init')){
    

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 */
    function wooxon_widgets_init() {
            register_sidebar( array(
                    'name'          => esc_html__( 'Sidebar', 'wooxon' ),
                    'id'            => 'sidebar-1',
                    'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'wooxon' ),
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h4 class="widget-title">',
                    'after_title'   => '</h4>',
            ) );
            register_sidebar( array(
                    'name'          => esc_html__( 'Page Sidebar', 'wooxon' ),
                    'id'            => 'sidebar-2',
                    'description'   => esc_html__( 'Add widgets here to appear in your page sidebar.', 'wooxon' ),
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h4 class="widget-title">',
                    'after_title'   => '</h4>',
            ) );
            register_sidebar( array(
                    'name'          => esc_html__( 'Footer Inner', 'wooxon' ),
                    'id'            => 'sidebar-3',
                    'description'   => esc_html__( 'Add widgets here to appear in your footer inner.', 'wooxon' ),
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h4 class="widget-title">',
                    'after_title'   => '</h4>',
            ) );
            register_sidebar( array(
                    'name'          => esc_html__( 'Footer Inner top', 'wooxon' ),
                    'id'            => 'sidebar-5',
                    'description'   => esc_html__( 'Add widgets here to appear in your footer inner top.', 'wooxon' ),
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h4 class="widget-title">',
                    'after_title'   => '</h4>',
            ) );            
            register_sidebar( array(
                    'name'          => esc_html__( 'Footer Inner top 2', 'wooxon' ),
                    'id'            => 'sidebar-6',
                    'description'   => esc_html__( 'Add widgets here to appear in your footer inner top2.', 'wooxon' ),
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</section>',
                    'before_title'  => '<h4 class="widget-title">',
                    'after_title'   => '</h4>',
            ) );            
            if ( class_exists( 'WooCommerce' ) ):
                register_sidebar( array(
                        'name'          => esc_html__( 'Shop Sidebar', 'wooxon' ),
                        'id'            => 'sidebar-4',
                        'description'   => esc_html__( 'Add widgets here to appear in your shop page sidebar.', 'wooxon' ),
                        'before_widget' => '<section id="%1$s" class="widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<h4 class="widget-title">',
                        'after_title'   => '</h4>',
                ) );
                register_sidebar( array(
                        'name'          => esc_html__( 'Shop Filter Sidebar', 'wooxon' ),
                        'id'            => 'sidebar-7',
                        'description'   => esc_html__( 'Add widgets here to appear in your shop page Canvas sidebar.', 'wooxon' ),
                        'before_widget' => '<section id="%1$s" class="widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<h4 class="widget-title">',
                        'after_title'   => '</h4>',
                ) );
                register_sidebar( array(
                        'name'          => esc_html__( 'Shop Catalog Sidebar', 'wooxon' ),
                        'id'            => 'sidebar-8',
                        'description'   => esc_html__( 'Add widgets here to appear in your After menu shop catalog page.', 'wooxon' ),
                        'before_widget' => '<section id="%1$s" class="widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<h4 class="widget-title">',
                        'after_title'   => '</h4>',
                ) );
            endif;

    }
    add_action( 'widgets_init', 'wooxon_widgets_init' );
}

if(!function_exists('wooxon_get_page_id')) {
	function wooxon_get_page_id() {
		global $post;

		$page = array(
			'id' => 0,
			'type' => 'page'
		);

		if(isset($post->ID) && is_singular('page')) { 
			$page = array(
				'id' => $post->ID,
				'type' => 'page'
			);
		} else if( is_home() || is_archive('post') || is_search() ) {
			$page = array(
				'id' => $id = get_option( 'page_for_posts' ),
				'type' => 'blog'
			);
		} else if( get_post_type() == 'etheme_portfolio' || is_singular( 'etheme_portfolio' ) ) {
			$page = array(
				'id' => etheme_tpl2id( 'portfolio.php' ),
				'type' => 'portfolio'
			);
		}

		if(class_exists('WooCommerce') && (is_shop() || is_product_category() || is_product_tag() || is_singular( "product" ))) {
			$page = array(
				'id' => get_option('woocommerce_shop_page_id'),
				'type' => 'shop'
			);
		}

		return $page;
	}
}
/**
*   Adding custom sidebar ajax
*/

if(!function_exists('wooxon_add_sidebar_action')) {
	function wooxon_add_sidebar_action(){
	    if (!wp_verify_nonce($_GET['_wpnonce_piko_widgets'],'piko-add-sidebar-widgets') ) die( 'Security check' );
	    if($_GET['piko_sidebar_name'] == '') die('Empty Name');
	    $option_name = 'wooxon_custom_sidebars';
	    if(!get_option($option_name) || get_option($option_name) == '') delete_option($option_name); 
	    
	    $new_sidebar = $_GET['piko_sidebar_name'];

		$result = wooxon_add_sidebar($new_sidebar);

	    if($result) die($result);
	    else die('error');
	}
}

if( ! function_exists('wooxon_add_sidebar') ) {
	function wooxon_add_sidebar($name) {
		$option_name = 'wooxon_custom_sidebars';
		if(get_option($option_name)) {
			$custom_sidebars = wooxon_get_stored_sidebar();
			$custom_sidebars[] = trim($name);
			$result = update_option($option_name, $custom_sidebars);
		}else{
			$custom_sidebars[] = $name;
			$result2 = add_option($option_name, $custom_sidebars);
		}
		if($result) return 'Updated';
		elseif($result2) return 'added';
		else die('error');
	}
}


/**
*   deleting custom sidebar in ajax 
*/

if(!function_exists('wooxon_delete_sidebar')) {
	function wooxon_delete_sidebar(){
	    $option_name = 'wooxon_custom_sidebars';
	    $del_sidebar = trim($_GET['piko_sidebar_name']);
	        
	    if(get_option($option_name)) {
	        $custom_sidebars = wooxon_get_stored_sidebar();
	        
	        foreach($custom_sidebars as $key => $value){
	            if($value == $del_sidebar)
	                unset($custom_sidebars[$key]);
	        }
	        
	        
	        $result = update_option($option_name, $custom_sidebars);
	    }
	    
	    if($result) die('Deleted');
	    else die('error');
	}
}


/**
*   detault registering sidebars similar custom sidebar
*/

if(!function_exists('wooxon_register_stored_sidebar')) {
	function wooxon_register_stored_sidebar(){
	    $custom_sidebars = wooxon_get_stored_sidebar();
	    if(is_array($custom_sidebars)) {
	        foreach($custom_sidebars as $name){
	            register_sidebar( array(
	                'name' => ''.$name.'',
	                'id' => str_replace(' ','',strtolower ($name)),
	                'class' => 'piko_custom_sidebar',
	                'before_widget' => '<section id="%1$s" class="widget %2$s">',
	                'after_widget' => '</section>',
	                'before_title' => '<h4 class="widget-title">',
	                'after_title' => '</h4>',
	            ) );
	        }
	    }
	}
}

/**
*   Stored all sidebar in array
*/

if(!function_exists('wooxon_get_stored_sidebar')) {
	function wooxon_get_stored_sidebar(){
	    $option_name = 'wooxon_custom_sidebars';
	    return get_option($option_name);
	}
}

/**
*   Add form custom widgets
*/

if(!function_exists('wooxon_sidebar_form')) {
    function wooxon_sidebar_form(){
        ?>	    
        <form action="<?php echo admin_url( 'widgets.php' ); ?>" method="post" id="piko_add_sidebar_form">
            <h4><?php esc_html_e('Custom Sidebar', 'wooxon'); ?></h4>
            <?php wp_nonce_field( 'piko-add-sidebar-widgets', '_wpnonce_piko_widgets', false ); ?>
            <input type="text" name="piko_sidebar_name" id="piko_sidebar_name" />
            <button type="submit" class="button-primary" value="add-sidebar"><?php esc_html_e('Add Sidebar', 'wooxon'); ?></button>
        </form>	   
        <?php
    }
}
add_action( 'sidebar_admin_page', 'wooxon_sidebar_form', 30 );
add_action('wp_ajax_wooxon_add_sidebar', 'wooxon_add_sidebar_action');
add_action('wp_ajax_wooxon_delete_sidebar', 'wooxon_delete_sidebar');
add_action( 'widgets_init', 'wooxon_register_stored_sidebar' );