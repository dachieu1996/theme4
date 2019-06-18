<?php

/* 
 * import data
 */
if(!function_exists('pikoworks_core_admin_css') || !class_exists( 'OCDI_Plugin' )){
    return;
}

function wooxon_importer_files() {
    $main_domain = 'http://themepiko.com/demo/wooxon/';
    $import_notice = esc_attr__( 'After you import this demo, Need to setup the Slider Revolution separately location: Slider Revolution ->import slider. slider dummy found download package main-> dummy data', 'wooxon' );
      

  return array(
    array(
      'import_file_name'             => 'Default',
      'categories'                 => array( 'Demo'),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/importer/dummy/default/dummy.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/importer/dummy/default/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/importer/dummy/default/options.json',
          'option_name' => 'wooxon',
        ),
      ),
      'import_preview_image_url'     => WOOXON_THEME_URI . 'inc/admin/importer/dummy/default/screenshot.jpg',
      'import_notice'                => $import_notice,
      'preview_url'                  => $main_domain .'default',
    ),     
    array(
      'import_file_name'             => 'Electronics',
      'categories'                 => array( 'Demo'),  
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/importer/dummy/electronics/dummy.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/importer/dummy/electronics/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/importer/dummy/electronics/options.json',
          'option_name' => 'wooxon',
        ),
      ),
      'import_preview_image_url'     => WOOXON_THEME_URI . 'inc/admin/importer/dummy/electronics/screenshot.jpg',
      'import_notice'                => $import_notice,
      'preview_url'                  => $main_domain .'electronics',
    ),
     array(
      'import_file_name'             => 'RTL Arabic',
      'categories'                 => array( 'Demo'),  
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/importer/dummy/rtl/dummy.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/admin/importer/dummy/rtl/widgets.json',
      'local_import_redux'           => array(
        array(
          'file_path'   => trailingslashit( get_template_directory() ) . 'inc/admin/importer/dummy/rtl/options.json',
          'option_name' => 'wooxon',
        ),
      ),
      'import_preview_image_url'     => WOOXON_THEME_URI . 'inc/admin/importer/dummy/rtl/screenshot.jpg',
      'import_notice'                => $import_notice,
      'preview_url'                  => $main_domain .'rtl',
    ),  
    array(
      'import_file_name'             => 'Dokan vendor',
      'categories'                 => array( 'Demo'),  
      'import_preview_image_url'     => WOOXON_THEME_URI . 'inc/admin/importer/dummy/dokan/screenshot.jpg',
      'import_notice'                => $import_notice,
      'preview_url'                  => $main_domain .'vendor',
    ),
    array(
      'import_file_name'             => 'Default Homes 1-3',
      'categories'                 => array( 'Homepage'), 
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/importer/dummy/pages/default/dummy.xml',      
      'import_preview_image_url'     => WOOXON_THEME_URI . 'inc/admin/importer/dummy/pages/default/screenshot.jpg',
      'import_notice'                => $import_notice,
      'preview_url'                  => $main_domain .'default',
    ),
    array(
      'import_file_name'             => 'Electronics Homes 1-6',
      'categories'                 => array( 'Homepage'), 
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/admin/importer/dummy/pages/electronics/dummy.xml',      
      'import_preview_image_url'     => WOOXON_THEME_URI . 'inc/admin/importer/dummy/pages/electronics/screenshot.jpg',
      'import_notice'                => $import_notice,
      'preview_url'                  => $main_domain .'electronics',
    ),   
  );
}
add_filter( 'pt-ocdi/import_files', 'wooxon_importer_files' );

function wooxon_after_importer_setup() {
	// Assign menus to their locations.
	$main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );
	$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
	$login_menu = get_term_by( 'name', 'Login Menu', 'nav_menu' );
	$category_menu = get_term_by( 'name', 'Vertical Menu', 'nav_menu' );
	$secondary_menu = get_term_by( 'name', 'Secondary Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $main_menu->term_id,
			'top_menu' => $top_menu->term_id,
			'footer' => $footer_menu->term_id,
			'primary_login' => $login_menu->term_id,
			'category' => $category_menu->term_id,
			'secondary' => $secondary_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'wooxon_after_importer_setup' );
