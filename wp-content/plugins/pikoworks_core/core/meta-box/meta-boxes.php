<?php
/*
*Meta Box Function admin 
*------------------------
*/
global $meta_boxes;

if( 'wooxon' == get_option( 'template' ) ) {
    // theme active wooxon
  }

/**
 * Register meta boxes
 * @return void
 */
function piko_register_meta_boxes()
{
	global $meta_boxes;
	$prefix = 'wooxon_';
	/* menu list */
	$menu_list = array();
	$sidebar_list = array();
	if ( function_exists( 'piko_get_menu_list' ) ) {
		$menu_list = piko_get_menu_list();
	}
        /* widgets list */
	if ( function_exists( 'piko_get_widgets_list' ) ) {
		$widgets_list = piko_get_widgets_list();
	}
        
        
  // POST FORMAT: Video
//--------------------------------------------------
    $meta_boxes[] = array(
            'title' => esc_html__('Post Format: Video', 'pikoworks_core'),
            'id' => $prefix . 'meta_box_post_format_video',
            'post_types' => array('post'),
            'fields' => array(
                    array(
                            'name' => esc_html__( 'Video Embeded URL', 'pikoworks_core' ),
                            'id'   => $prefix . 'post_format_video',
                            'type' => 'oembed',
                    ),
            ),
    );

// POST FORMAT: Audio
//--------------------------------------------------
    $meta_boxes[] = array(
            'title' => esc_html__('Post Format: Audio', 'pikoworks_core'),
            'id' => $prefix . 'meta_box_post_format_audio',
            'post_types' => array('post'),
            'fields' => array(
                    array(
                            'name' => esc_html__( 'Audio  Embeded url', 'pikoworks_core' ),
                            'id'   => $prefix . 'post_format_audio',
                            'type' => 'oembed',
                    ),
            ),
    );      

// POST FORMAT: Image
//--------------------------------------------------
    $meta_boxes[] = array(
            'title' => esc_html__('Post Format: Image', 'pikoworks_core'),
            'id' => $prefix .'meta_box_post_format_image',
            'post_types' => array('post'),
            'fields' => array(
                    array(
                            'name' => esc_html__('Image', 'pikoworks_core'),
                            'id' => $prefix . 'post_format_image',
                            'type' => 'image_advanced',
                            'max_file_uploads' => 1,
                            'desc' => esc_html__('Select a image for post','pikoworks_core')
                    ),
            ),
    );

// POST FORMAT: Gallery
//--------------------------------------------------
    $meta_boxes[] = array(
            'title' => esc_html__('Post Format: Gallery', 'pikoworks_core'),
            'id' => $prefix . 'meta_box_post_format_gallery',
            'post_types' => array('post'),
            'fields' => array(
                    array(
                            'name' => esc_html__('Images Multiple', 'pikoworks_core'),
                            'id' => $prefix . 'post_format_gallery',
                            'type' => 'image_advanced',
                            'desc' => esc_html__('Select images gallery for post','pikoworks_core')
                    ),
            ),
    );

// POST FORMAT: QUOTE
//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => esc_html__('Post Format: Quote', 'pikoworks_core'),
        'id' => $prefix . 'meta_box_post_format_quote',
        'post_types' => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__( 'Quote', 'pikoworks_core' ),
                'id'   => $prefix . 'post_format_quote',
                'type' => 'textarea',
            ),
            array(
                'name' => esc_html__( 'Author', 'pikoworks_core' ),
                'id'   => $prefix . 'post_format_quote_author',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Author Url', 'pikoworks_core' ),
                'id'   => $prefix . 'post_format_quote_author_url',
                'type' => 'url',
            ),
        ),
    );
    // POST FORMAT: LINK
	//--------------------------------------------------
    $meta_boxes[] = array(
        'title' => esc_html__('Post Format: Link', 'pikoworks_core'),
        'id' => $prefix . 'meta_box_post_format_link',
        'post_types' => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__( 'Url', 'pikoworks_core' ),
                'id'   => $prefix . 'post_format_link_url',
                'type' => 'url',
            ),
            array(
                'name' => esc_html__( 'Text', 'pikoworks_core' ),
                'id'   => $prefix . 'post_format_link_text',
                'type' => 'text',
            ),
        ),
    );  
    
    $meta_boxes[] = array(
		'id' => $prefix . 'product_setting_meta_box',
		'title' => esc_html__('Product setting', 'pikoworks_core'),
		'post_types' => array('product'),
		'tab' => true,
		'fields' => array(
                        array(
				'name'  => esc_html__( 'Single Product Thumbnail', 'pikoworks_core' ),
				'id'    => $prefix . 'single_products_thumbnail',
				'type'  => 'image_set',
				'allowClear' => true,
                                'desc'  => esc_html__( 'If check mark overite theme-option', 'pikoworks_core' ),
				'options' => array(
					'bottom' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb1.png',
					'left' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb2.png',
					'right' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb3.png'					
				),
				'std'	=> '',
				'multiple' => false,

			),
                        array(
                            'name' => esc_html__( 'Product Video url', 'pikoworks_core' ),
                                'id'   => $prefix . 'single_products_video',
                                'desc'  => esc_html__( 'Youtube, Vimeo embaded link', 'pikoworks_core' ),
                                'type' => 'oembed',
                        ),
                        array(
                            'name' => esc_html__( 'Product Size Guide image', 'pikoworks_core' ),
                                'id'   => $prefix . 'size_guide',
                                'desc'  => esc_html__( 'Override size guide image', 'pikoworks_core' ),
                                'type' => 'image_advanced',
                                'max_file_uploads' => 1,
                        ),
                        
		)
	);
        // product single tabs
	$meta_boxes[] = array(
		'id' => $prefix . 'product_tabs_layout_meta_box',
		'title' => esc_html__('Product Tabs', 'pikoworks_core'),
		'post_types' => array('product'),
		'tab' => true,
		'fields' => array(
                        array(
				'name'  => esc_html__( 'Enable Product Custom Tab.', 'pikoworks_core' ),
				'desc'  => esc_html__( 'Override theme option', 'pikoworks_core' ),
				'id'    => $prefix . 'enable_custom_tab_html',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
                        array (
				'name' 	=> esc_html__('Custom Tab heading', 'pikoworks_core'),
				'id' 	=> $prefix . 'product_custom_tab_heading',
				'type' 	=> 'text',
				'std' 	=> '',
                                'required-field' => array($prefix . 'enable_custom_tab_html','=',array('1')),
			),
                        array(
				'name'  => esc_html__( 'Custom Tab Content.', 'pikoworks_core' ),
				'id'    => $prefix . 'product_custom_tab_content',
				'type'  => 'wysiwyg',
                                'required-field' => array($prefix . 'enable_custom_tab_html','=',array('1')),
			),                        
                        array(
				'name'  => esc_html__( 'Enable Product Custom Tab Two.', 'pikoworks_core' ),
				'id'    => $prefix . 'enable_custom_tab_html2',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
                        array (
				'name' 	=> esc_html__('Custom Tab heading', 'pikoworks_core'),
				'id' 	=> $prefix . 'product_custom_tab_heading2',
				'type' 	=> 'text',
				'std' 	=> '',
                                'required-field' => array($prefix . 'enable_custom_tab_html2','=',array('1')),
			),
                        array(
				'name'  => esc_html__( 'Custom Tab Content.', 'pikoworks_core' ),
				'id'    => $prefix . 'product_custom_tab_content2',
				'type'  => 'wysiwyg',
                                'required-field' => array($prefix . 'enable_custom_tab_html2','=',array('1')),
			)               
                        
		)
	);        
	// PAGE LAYOUT
	$meta_boxes[] = array(
		'id' => $prefix . 'page_layout_meta_box',
		'title' => esc_html__('Page Layout', 'pikoworks_core'),
		'post_types' => array('post', 'page',  'portfolio', 'lookbook'),
		'tab' => true,
		'fields' => array(
                        array(
				'name'  => esc_html__( 'Page Layout', 'pikoworks_core' ),
				'id'    => $prefix . 'page_layout',
				'type'  => 'button_set',
				'options' => array(
					'-1'    => esc_html__('Global','pikoworks_core'),
					'container' => esc_html__('Container','pikoworks_core'),
					'container-fluid'  => esc_html__('Container Fluid','pikoworks_core'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),						
			array(
				'name'  => esc_html__( 'Page Sidebar', 'pikoworks_core' ),
				'id'    => $prefix . 'page_sidebar',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'fullwidth' => PIKOWORKSCORE_ADMIN_URL.'/assets/images/theme-options/sidebar-none.png',
					'left'	  => PIKOWORKSCORE_ADMIN_URL.'/assets/images/theme-options/sidebar-left.png',
					'right'	  => PIKOWORKSCORE_ADMIN_URL.'/assets/images/theme-options/sidebar-right.png',
					'both'	  => PIKOWORKSCORE_ADMIN_URL.'/assets/images/theme-options/sidebar-both.png'
				),
				'std'	=> '',
				'multiple' => false,

			),
			array (
				'name' 	=> esc_html__('Page Sidebar', 'pikoworks_core'),
				'id' 	=> $prefix . 'page_right_sidebar',
				'type' 	=> 'select',
				'placeholder' => esc_html__('Select Sidebar','pikoworks_core'),
				'options' 	=> $widgets_list,
				'required-field' => array($prefix . 'page_sidebar','=',array('left','right','both')),
			),

			array (
				'name' 	=> esc_html__('Left Sidebar', 'pikoworks_core'),
				'id' 	=> $prefix . 'page_left_sidebar',
				'type' 	=> 'select',
				'placeholder' => esc_html__('Select Sidebar','pikoworks_core'),
				'options' 	=> $widgets_list,
				'required-field' => array($prefix . 'page_sidebar','=',array('both')),
			),
			array (
				'name' 	=> esc_html__('Page Class Extra', 'pikoworks_core'),
				'id' 	=> $prefix . 'page_class_extra',
				'type' 	=> 'text',
				'std' 	=> ''
			),
		)
	);
	// breadcrumb
	$meta_boxes[] = array(
		'id' => $prefix . 'page_breadcrumb_meta_box',
		'title' => esc_html__('Title and Breadcrumb', 'pikoworks_core'),
		'post_types' => array('page'),
		'tab' => true,
		'fields' => array(
			array(
                            'name' => esc_html__( 'Show header title section', 'pikoworks_core' ),
                            'id' => $prefix . 'single_header_title_section',
                            'type' => 'button_set',
                            'options' => array(
                                'global' => esc_html__( 'Global', 'pikoworks_core' ),
                                '1' => esc_html__( 'Custom', 'pikoworks_core' ),
                                'dont_show' => esc_html__( 'Don\'t show', 'pikoworks_core' ),
                            ),
                            'std' => 'global',
			),
                        array(
                               'name' => esc_html__( 'Custom Title', 'pikoworks_core' ),                              
                               'id' => $prefix . 'custom_header_title',
                               'type' => 'text',
                                'required-field' => array($prefix . 'single_header_title_section','=',array('1')),
                        ),
                        array(
                                'name' => esc_html__( 'Show Breadcrubm', 'pikoworks_core' ),
                                'id' => $prefix . 'disable_breadcrubm_layout',
                                'type' => 'button_set',
                                'options' => array(
                                    '1' => esc_html__( 'Global', 'pikoworks_core' ),
                                    '2' => esc_html__( 'Show', 'pikoworks_core' ),
                                    '0' => esc_html__( 'Don\'t show', 'pikoworks_core' ),
                                ),
                                'std' => '1',
                            ),
		)
	);
        // header
	$meta_boxes[] = array(
		'id' => $prefix . 'header_layout_meta_box',
		'title' => esc_html__('Header', 'pikoworks_core'),
		'post_types' => array('page'),
		'tab' => true,
		'fields' => array(
                        array(
				'name'  => esc_html__( 'Manu width', 'pikoworks_core' ),
				'id'    => $prefix . 'manu_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'    => esc_html__('Global','pikoworks_core'),
					'container' => esc_html__('Container','pikoworks_core'),
					'container-fluid'  => esc_html__('Container Fluid','pikoworks_core'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),                        
			array(
				'name'  => esc_html__( 'Layout', 'pikoworks_core' ),
				'id'    => $prefix . 'menu_style',
				'type'  => 'image_set',
				'options' => array(
					'-1' => PIKOWORKSCORE_ADMIN_URL.'/assets/images/theme-options/theme-default.jpg',
					'1' => get_template_directory_uri() . '/assets/images/theme-options/header-1.jpg',
                                        '2' => get_template_directory_uri() . '/assets/images/theme-options/header-2.jpg',
                                        '24' => get_template_directory_uri() . '/assets/images/theme-options/header-51.jpg',
                                        '21' => get_template_directory_uri() . '/assets/images/theme-options/header-3.jpg',
                                        '22' => get_template_directory_uri() . '/assets/images/theme-options/header-4.jpg',
                                        '23' => get_template_directory_uri() . '/assets/images/theme-options/header-5.jpg',
                                        '6' => get_template_directory_uri() . '/assets/images/theme-options/header-6.jpg',
				),
				'std'	=> '-1',
				'multiple' => false,
			),
                        array(
				'name'  => esc_html__( 'Top menu', 'pikoworks_core' ),
				'id'    => $prefix . 'enable_top_bar',
				'type'  => 'checkbox',
				'std'	=> 0,
			),                                              		
                        array(
				'name'  => esc_html__( 'Header Transparency', 'pikoworks_core' ),
				'id'    => $prefix . 'header_transparency',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
			
		)
	);
          // footer
	$meta_boxes[] = array(
		'id' => $prefix . 'footer_layout_meta_box',
		'title' => esc_html__('Footer', 'pikoworks_core'),
		'post_types' => array('page'),
		'tab' => true,
		'fields' => array(                      
                        array(
				'name'  => esc_html__( 'Footer inner top 2 widgets', 'pikoworks_core' ),
				'id'    => $prefix . 'widgets_area_three',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
                        array(
				'name'  => esc_html__( 'Inner top 2 width', 'pikoworks_core' ),
				'id'    => $prefix . 'footer_inner_top_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'    => esc_html__('Global','pikoworks_core'),
					'container' => esc_html__('Container','pikoworks_core'),
					'container-fluid'  => esc_html__('Container Fluid','pikoworks_core'),
				),
				'std'	=> '-1',
				'multiple' => false,
                                'required-field' => array($prefix . 'widgets_area_three','=',array('1')),
			),
                        array(
				'name'  => esc_html__( 'Inner top 2 cloumn', 'pikoworks_core' ),
				'id'    => $prefix . 'footer_cloumn_three',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'1' => get_template_directory_uri() .'/assets/images/theme-options/1columns.png',
					'2' => get_template_directory_uri().'/assets/images/theme-options/2columns.png',
					'23' => get_template_directory_uri().'/assets/images/theme-options/2-3columns.png',
					'3' => get_template_directory_uri().'/assets/images/theme-options/3columns.png',					
					'4' => get_template_directory_uri().'/assets/images/theme-options/4columns.png',                                  
					'5' => get_template_directory_uri().'/assets/images/theme-options/5columns.png',                                  
                                    
				),
				'std'	=> '',
				'multiple' => false,
                                'required-field' => array($prefix . 'widgets_area_three','=',array('1')),

			),
                        array (
				'name' 	=> esc_html__('Inner top widget area', 'pikoworks_core'),
				'id' 	=> $prefix . 'footer_sidebar_three',
				'type' 	=> 'select',
				'placeholder' => esc_html__('Select Sidebar','pikoworks_core'),
				'options' 	=> $widgets_list,
				'required-field' => array($prefix . 'widgets_area_three','=',array('1')),
			),                       
                        array(
				'name'  => esc_html__( 'Footer inner width', 'pikoworks_core' ),
				'id'    => $prefix . 'footer_inner_width',
				'type'  => 'button_set',
				'options' => array(
					'-1'    => esc_html__('Global','pikoworks_core'),
					'container' => esc_html__('Container','pikoworks_core'),
					'container-fluid'  => esc_html__('Container Fluid','pikoworks_core'),
				),
				'std'	=> '-1',
				'multiple' => false,
			),
                        array(
				'name'  => esc_html__( 'Inner top widgets.', 'pikoworks_core' ),
				'id'    => $prefix . 'widgets_area_two',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
                        array(
				'name'  => esc_html__( 'Inner top cloumn', 'pikoworks_core' ),
				'id'    => $prefix . 'footer_cloumn_two',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'1' => get_template_directory_uri() .'/assets/images/theme-options/1columns.png',
					'2' => get_template_directory_uri().'/assets/images/theme-options/2columns.png',
                                        '23' => get_template_directory_uri().'/assets/images/theme-options/2-3columns.png',
					'3' => get_template_directory_uri().'/assets/images/theme-options/3columns.png',					
					'4' => get_template_directory_uri().'/assets/images/theme-options/4columns.png',                                  
					'5' => get_template_directory_uri().'/assets/images/theme-options/5columns.png',                                  
                                    
				),
				'std'	=> '',
				'multiple' => false,
                                'required-field' => array($prefix . 'widgets_area_two','=',array('1')),

			),
                        array (
				'name' 	=> esc_html__('Inner top widget area', 'pikoworks_core'),
				'id' 	=> $prefix . 'footer_sidebar_two',
				'type' 	=> 'select',
				'placeholder' => esc_html__('Select Sidebar','pikoworks_core'),
				'options' 	=> $widgets_list,
				'required-field' => array($prefix . 'widgets_area_two','=',array('1')),
			),
                        array(
				'name'  => esc_html__( 'Inner widgets', 'pikoworks_core' ),
				'id'    => $prefix . 'widgets_area',
				'type'  => 'checkbox',
				'std'	=> 0,
			),
                        array(
				'name'  => esc_html__( 'Inner cloumn', 'pikoworks_core' ),
				'id'    => $prefix . 'footer_cloumn',
				'type'  => 'image_set',
				'allowClear' => true,
				'options' => array(
					'1' => get_template_directory_uri() .'/assets/images/theme-options/1columns.png',
					'2' => get_template_directory_uri().'/assets/images/theme-options/2columns.png',
                                        '23' => get_template_directory_uri().'/assets/images/theme-options/2-3columns.png',
					'3' => get_template_directory_uri().'/assets/images/theme-options/3columns.png',					
					'4' => get_template_directory_uri().'/assets/images/theme-options/4columns.png',                                  
					'5' => get_template_directory_uri().'/assets/images/theme-options/5columns.png',					
				),
				'std'	=> '',
				'multiple' => false,
                                'required-field' => array($prefix . 'widgets_area','=',array('1')),

			),
                        array (
				'name' 	=> esc_html__('Inner widget area', 'pikoworks_core'),
				'id' 	=> $prefix . 'footer_sidebar_one',
				'type' 	=> 'select',
				'placeholder' => esc_html__('Select Sidebar','pikoworks_core'),
				'options' 	=> $widgets_list,
				'required-field' => array($prefix . 'widgets_area','=',array('1')),
			),
		)
	);      
        
        
        
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if (class_exists('RW_Meta_Box')) {
            foreach ($meta_boxes as $meta_box) {
                    new RW_Meta_Box($meta_box);
            }
	}
}

add_action('admin_init', 'piko_register_meta_boxes');
