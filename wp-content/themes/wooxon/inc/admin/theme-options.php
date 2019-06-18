<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "wooxon";
    $theme = wp_get_theme();

    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => 'Wooxon ' . esc_html__('Options', 'wooxon') . '<a class="admin-theme-link" href="' . admin_url( 'admin.php?page=pikowroks_currency' ) . '">Currency Switcher</a>',
        'display_version'      => esc_html__('Theme Version: ', 'wooxon') . $theme->get( 'Version' ),
        'menu_type'            => 'submenu',
        'allow_sub_menu'       => true,
        'menu_title'           => esc_html__( 'Theme Options', 'wooxon' ),
        'page_title'           => esc_html__( 'Theme Options', 'wooxon' ),
        'google_api_key'       => '',
        'google_update_weekly' => false,
        'async_typography'     => true,
        //'disable_google_fonts_link' => true,
        'admin_bar'            => false,
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => false,
        'customizer'           => true,
        'page_priority'        => 61,
        'page_parent'          => 'themes.php',
        'page_permissions'     => 'manage_options',
        'menu_icon'            => 'dashicons-admin-generic',
        'last_tab'             => '',
        'page_icon'            => 'icon-themes',
        'page_slug'            => 'theme_options',
        'save_defaults'        => true,
        'default_show'         => false,
        'default_mark'         => '',
        'show_import_export'   => true,
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        'output_tag'           => true,
        'database'             => '',
        'use_cdn'              => true,
        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        ),
        'output'                => true,
	'output_tag'            => true,
	'compiler'              => true,
	'page_permissions'      => 'manage_options',
	'save_defaults'         => true,
	'database'              => 'options',
	'transient_time'        => '3600',
	'show_import_export'    => false,
	'network_sites'         => true 
    );
    
    Redux::setArgs( $opt_name, $args );
    //  START general option Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'wooxon' ),
        'id'               => 'basic',        
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'           => array(
            array(
                    'id'      => 'main-width-content',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Main body Content width', 'wooxon' ),                    
                    'options' => array(
                        'container' => 'Container', 
                        'container-fluid' => 'Container Fluid',
                        ), 
                    'default' => 'container'  
            ),            
            array(
                'id'      => 'container_width_custom',
                'type'    => 'text',
                'title'   => esc_html__( 'Container width', 'wooxon' ),
                'default' => '1140',
                'validate' => 'numeric',
                'required' => array( 'main-width-content', '=', 'container', ),
                'desc'    => esc_html__( 'Defined in pixels. Do not add the \'px\' unit and its effect all section tabs container button value.', 'wooxon' ),
            ),
            array(
                'id'      => 'optn_enable_loader',
                'type'    => 'switch',
                'title'   => esc_html__( 'Enable Preloader', 'wooxon' ),
                'default' => '0',
            ),
            array(
                'id'       => 'home_preloader',
                'type'     => 'select',
                'title'    => esc_html__( 'Preloader style', 'wooxon' ),                
                'options' => array(                    
                    'slide'	=> 'Slide top Bar',
                    'round-1'	=> '3 Dot',
                    'various-3'	=> 'Dot Scaleout',
                    'various-4'	=> 'Dot Bounce',
                    'various-5'	=> 'Spinner',
                    'various-8'	=> 'Spinner 02',
                    'various-7'	=> 'Spinner 03',
                ),                
                'default'  => 'various-4',
                'required' => array( 'optn_enable_loader', '=', true, ),
            ),
            array(
                'id'       => 'home_preloader_bg_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Preloader background color', 'wooxon' ),
                'default'  => '',
                'required' => array( 'home_preloader', '!=', 'slide', ),
            ),
            array(
                'id'       => 'home_preloader_spinner_color',
                'type'     => 'color',
                'title'    => esc_html__('Preloader spinner color', 'wooxon'),
                'validate' => 'color',
                'required' => array( 'optn_enable_loader', '=', true, ),
            ),
            array(
                'id'       => 'boxed_site',
                'type'     => 'switch',
                'title'    => esc_html__('Enable Boxed Version', 'wooxon'),
                'default' => '0',
            ),
            array(
                    'id'      => 'main_width_floatled',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Boxed Version', 'wooxon' ),
                    'options' => array(
                        'theme_boxed' => esc_html__('Boxed', 'wooxon'),
                        'theme_float_boxed' => esc_html__('Float Boxed', 'wooxon'), 
                        'theme_float' => esc_html__('Float Full', 'wooxon'),                                               
                        ), 
                    'default' => 'theme_boxed',
                    'required' => array( 'boxed_site', '=', 1),

            ),            
            array(
                'id'       => 'boxed_background_custom_image',
                'type'     => 'background',
                'title'    => esc_html__('Background Image/Pattern', 'wooxon'),
                'required' => array( 'boxed_site', '=', 1),
                'output'   => array('background-image' => 'body')
            ),         
        )
        
    ) );
    // coming soon    
    Redux::setSection( $opt_name, array(
        'title'   => esc_html__( 'Maintanence Mode', 'wooxon' ),
        'subsection' => true,
        'icon'    => 'el el-icon-time',        
        'fields' => array(
            array(
                'id'            => 'enable_coming_soon_mode',
                'type'          => 'switch',
                'title'         => esc_html__( 'Enable maintanence mode', 'wooxon' ),
                'subtitle'          => esc_html__( 'If turn on, All member login then see the site', 'wooxon' ),
                'default'       => 0,
            ),
            array(
                'id'            => 'coming_soon_date',
                'type'          => 'date',
                'title'         => esc_html__('Date setup', 'wooxon'),
                'required'      => array( 'enable_coming_soon_mode', '=', 1 ),
            ),
            array(
                'id'            => 'disable_coming_soon_when_date_small',
                'type'          => 'switch',
                'title'         => esc_html__( 'Coming soon disable when count down date expired', 'wooxon' ),
                'default'       => 1,
                'on'            => esc_html__( 'Disable', 'wooxon' ),
                'off'           => esc_html__( 'Don\'t disable', 'wooxon' ),
                'required'      => array( 'enable_coming_soon_mode', '=', 1 ),
            ),
            array(
                'id' => 'coming_soon_bg',
                'type' => 'background',
                'url' => true,
                'title' => esc_html__('Coming Soon Background image', 'wooxon'),
                'compiler' => 'true',
                'preview' => 'true',                
                'default'  => array(
                   'background-color' => '',
                   'background-image' => ''
                ),
                'output'   => array('background-image'    => '.coming-soon'),
                'required'      => array( 'enable_coming_soon_mode', '=', 1 ),
            ),            
            array(
                'id'            => 'coming_soon_text',
                'type'          => 'editor',
                'title'         => esc_html__('Coming soon text', 'wooxon'),
                'subtitle'      => esc_html__( 'Allow custom html and style', 'wooxon' ),
                'default'       => wp_kses( __('Unfortunately, we are not quite ready yet. But, you can see our progres above. <a href="help@example.com">help@example.com</a>', 'wooxon'), array( 'br', 'a' => array( 'href' => array() ), 'b' ) ),
                'desc' =>   'Mailchimp Shortcode like as: [mc4wp_form id="236"] if collect email address contact form7 shortcode: [contact-form-7 id="5755" title="Sign up"]',
                'required'      => array( 'enable_coming_soon_mode', '=', 1 ),
            ),                               
            array(
                'id'            => 'enable_coming_soon_social',
                'type'          => 'switch',
                'title'         => esc_html__( 'Social Icon', 'wooxon' ),
                'subtitle'      => esc_html__( 'Social icon on/off', 'wooxon' ),
                'required'      => array( 'enable_coming_soon_mode', '=', 1 ),
                'default'       => 0,
                'on'            => esc_html__( 'On', 'wooxon' ),
                'off'           => esc_html__( 'Off', 'wooxon' ),
            ),
            array(
                'id'       => 'coming_soon_social',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Footer Social Media Icons to display', 'wooxon' ),
                'subtitle' => esc_html__( 'NB: If dont show shocial icon just uncheck. The Social urls taken from Social Media settings tab', 'wooxon' ),
                'required'      => array( 'enable_coming_soon_social', '=', 1 ),
                'default' => array(
                    'facebook' => '1', 
                    'twitter' => '1',
                    'instagram' => '1',
                    'flickr' => '1'
                ),
                'options'  => array(
                        'facebook'   => 'Facebook',
                        'twitter'    => 'Twitter',
                        'flickr'     => 'Flickr',
                        'instagram'  => 'Instagram',
                        'behance'    => 'Behance',
                        'dribbble'   => 'Dribbble',                        
                        'git'        => 'Git',
                        'linkedin'   => 'Linkedin',
                        'pinterest'  => 'Pinterest',
                        'yahoo'      => 'Yahoo',
                        'delicious'  => 'Delicious',
                        'dropbox'    => 'Dropbox',
                        'reddit'     => 'Reddit',
                        'soundcloud' => 'Soundcloud',
                        'google'     => 'Google',
                        'google-plus' => 'Google Plus',
                        'skype'      => 'Skype',
                        'youtube'    => 'Youtube',
                        'vimeo'      => 'Vimeo',
                        'tumblr'     => 'Tumblr',
                        'whatsapp'   => 'Whatsapp',
                ),
            ),            
            array(
                'id'       => 'coming_countdown_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__( 'Font color', 'wooxon' ),
                'required'      => array( 'enable_coming_soon_mode', '=', 1 ),
                'output'   => array(
                        'color'    => '.coming-soon .coming-content, .coming-soon .coming-content a,'
                    )
            ),
        ),
    )); 
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Performance', 'wooxon' ),
        'icon'   => 'el el-dashboard',
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'enable_minifile',                
                'type'    => 'switch',
                'title'   => esc_html__( 'Enable Mini File JS', 'wooxon' ),
                'default' => '0',
            ),
        )
    ));
    //404 style    
    Redux::setSection( $opt_name, array(
        'title'   => esc_html__( 'Page 404', 'wooxon' ),
        'icon'    => 'el el-remove-sign',
        'subsection' => true,
        'fields'  => array(
                array(
                    'id'       => 'optn_404_content',
                    'type'     => 'editor',
                    'title'    => esc_html__( 'Body content 404', 'wooxon' ),
                    'args'   => array(
                        'teeny'            => true,
                    ),
                    'default' => '<h1>4<span class="c_p">0</span>4</h1>
<h2>PAGE NOT FOUND</h2>
<p>Sorry, the page you are looking for is not available.<br> Maybe you want to perform a search?</p>'
                ),                
                array(
                    'id'       => 'optn_404_bg_color',
                    'type'     => 'color',
                    'compiler' => true,
                    'title'    => esc_html__( 'background Color', 'wooxon' ),
                    'output'   => array(
                            'background-color'    => '.error404 .site #piko-content'
                        )
                ),
                 array(
                    'id'       => 'optn_404_font_color',
                    'type'     => 'color',
                    'compiler' => true,
                    'title'    => esc_html__( 'Font Color', 'wooxon' ),
                    'subtitle' => esc_html__( 'Color effective follwing html', 'wooxon' ),
                    'output'   => array(
                            'color'    => '.error404 .error-page h1,.error404 .error-page h2,.error404 .error-page p,.error404 .error-btn a,.error404 .c_p'
                        )
                ),
            )
        ));     
    //  header option
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'wooxon' ),        
        'desc'             => esc_html__( 'These are really basic fields!', 'wooxon' ),
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-archive'
    ) );
    
  //header logo, menu
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Logo upload', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(
            array(
                    'id'      => 'enable_text_logo',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Logo Type', 'wooxon' ),
                    'default' => 'img',                               
                    'options' => array(
                        'text' => 'Default',
                        'img' => 'Image', 
                        'svg' => 'SVG',                        
                    ), 
            ),
            array(
                'id'       => 'logo_upload',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Logo upload', 'wooxon' ),
                'compiler' => true,
                'required' => array( 'enable_text_logo', '=', 'img' ),
                'default'  => array(
                    'url' => get_template_directory_uri(). '/assets/images/logo/logo.png'
                )
            ),
            array(
                'id'       => 'logo_upload_svg',
                'type'     => 'textarea',
                'title'    => esc_html__( 'logo SVG Code', 'wooxon' ),
                'desc' => esc_html__( 'NB: Remove svg width, height and should be set inline width,height css property svg line', 'wooxon' ),
                'required' => array( 'enable_text_logo', '=', 'svg' )
                
            ),
            array(
                'id'      => 'logo_max_width',
                'type'    => 'text',
                'title'   => esc_html__( 'Logo Max Width', 'wooxon' ),
                'default' => '170',
                'validate' => 'numeric',
                'required' => array( 'enable_text_logo', '=', 'img' ),
                'desc'    => esc_html__( 'Defined in pixels. Do not add the \'px\' unit.', 'wooxon' ),
            ),           
        )
    ) );
     Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'iOS Site Icon', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id' => 'custom_ios_title',
                'type' => 'text',
                'title' => esc_html__('Custom iOS Bookmark Title', 'wooxon'),
                'subtitle' => esc_html__('Enter a custom title for your site for when it is added as an iOS bookmark.', 'wooxon'),
                'default' => ''
            ),
            array(
                'id' => 'custom_ios_icon57',
                'type' => 'media',
                'url'=> true,
                'title' => esc_html__('Custom iOS 57x57', 'wooxon'),
                'subtitle' => esc_html__('Upload a 57px x 57px Png image that will be your website bookmark on non-retina iOS devices.', 'wooxon'),
            ),
            array(
                'id' => 'custom_ios_icon72',
                'type' => 'media',
                'url'=> true,
                'title' => esc_html__('Custom iOS 72x72', 'wooxon'),
                'subtitle' => esc_html__('Upload a 72px x 72px Png image that will be your website bookmark on non-retina iOS devices.', 'wooxon'),
            ),
            array(
                'id' => 'custom_ios_icon114',
                'type' => 'media',
                'url'=> true,
                'title' => esc_html__('Custom iOS 114x114', 'wooxon'),
                'subtitle' => esc_html__('Upload a 114px x 114px Png image that will be your website bookmark on retina iOS devices.', 'wooxon'),
            ),
            array(
                'id' => 'custom_ios_icon144',
                'type' => 'media',
                'url'=> true,
                'title' => esc_html__('Custom iOS 144x144', 'wooxon'),
                'subtitle' => esc_html__('Upload a 144px x 144px Png image that will be your website bookmark on retina iOS devices.', 'wooxon'),                
            ),
           
        )
    ) ); 
     
    //header top menu 
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Top Bar', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(
             array(
                    'id'      => 'enable_top_bar',
                    'type'    => 'switch',
                    'title'   => esc_html__( 'Enable Top Bar', 'wooxon' ),
                    'default' => '0',
            ),
            array(
                    'id'      => 'top_bar_cols',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Top bar Column', 'wooxon' ),
                    'default' => '2',
                    'options' => array(
                        '2' => esc_html__( '2 Cols', 'wooxon' ),
                        '3' => esc_html__( '3 Cols', 'wooxon' ),
                     ),                    
                    'required' => array( 'enable_top_bar', '=', array('1') )
            ),                       
            array (
                'title' => esc_html__('Top bar left text', 'wooxon'),
                'id' => 'top_bar_infotext',
                'required' => array( 'enable_top_bar', '=', array('1') ),
                'type' => 'textarea',
                'default' => '<ul>
                        <li><i class="fa fa-phone"></i><span>(123) 4567 890</span></li>
                        <li><i class="fa fa-clock-o"></i><span>MON - SAT: 08 am - 17 pm</span></li>
                        <li><i class="fa fa-envelope-o"></i><a href="mailto:support@example.com">Support@example.com</a></li>
                </ul>'
		),
             array (
                'title' => esc_html__('Top bar center text', 'wooxon'),
                'id' => 'top_bar_infotext_center',
                'type' => 'textarea',
                'required' => array( 'top_bar_cols', '=', array('3') ),
                'default' => 'Summer sale 15% off! <a href="#"> Shop Now</a>'
            ),            
            array(
                    'id'      => 'top_bar_right_option',
                    'type'    => 'switch',
                    'title'   => esc_html__( 'Top bar right', 'wooxon' ),
                    'subtitle' => esc_html__('Top menu wp-admin-> appearance->menu->top menu', 'wooxon'),
                    'default' => '0',
                    'on' => esc_html__( 'Custom', 'wooxon' ),
                    'off' => esc_html__( 'Top menu', 'wooxon' ), 
                    'required' => array( 'enable_top_bar', '=', 1),
            ),            
            array(
                'id'    => 'top_currency',
                'type'  => 'switch',
                'title' => esc_html__( 'Currency Switcher', 'wooxon' ),
                'subtitle' => esc_html__('Top bar right', 'wooxon'),
                'default' => false,
                'required' => array( 'enable_top_bar', '=', 1),
            ),
            array(
                    'id'      => 'top_wpml_lang',
                    'type'    => 'switch',
                    'title'   => esc_html__( 'WPML Multilanguage switcher', 'wooxon' ),
                    'subtitle' => esc_html__('Top bar right', 'wooxon'),
                    'default' => false,
                    'required' => array( 'enable_top_bar', '=', 1),
            ),
            array (
                'title' => esc_html__('Custom text right', 'wooxon'),
                'id' => 'top_bar_infotext_right',
                'type' => 'textarea',
                'required' => array( 'top_bar_right_option', '=', 1),
                'default' => 'Custom right text here'
            ),
            array(
                'id'       => 'top_bar_social',
                'type'     => 'button_set',
                'title'    => esc_html__('Social icon position', 'wooxon'),
                'options' => array(
                    'left' => 'Left', 
                    'center' => 'Center',
                    'right' => 'Right',
                    'none' => 'None'
                 ), 
                'default' => 'none',
                'required' => array( 'enable_top_bar', '=', 1),
            ), 
            array(
		'id'       => 'top_bar_use_social',
		'type'     => 'checkbox',
		'title'    => esc_html__( 'Select Social Media Icons to display', 'wooxon' ),
		'subtitle' => esc_html__( 'The Social urls taken from Social Media settings tab please enter first the social Urls.', 'wooxon' ),		
                'required' => array( 'top_bar_social', '=', array('left', 'center','right'), ),
                'default' => array(
                    'facebook' => '1', 
                    'twitter' => '1',
                    'instagram' => '1',
                    'flickr' => '1'
                ),
		'options'  => array(
			'facebook'   => 'Facebook',
                        'twitter'    => 'Twitter',
                        'flickr'     => 'Flickr',
                        'instagram'  => 'Instagram',
                        'behance'    => 'Behance',
                        'dribbble'   => 'Dribbble',                        
                        'git'        => 'Git',
                        'linkedin'   => 'Linkedin',
                        'pinterest'  => 'Pinterest',
                        'yahoo'      => 'Yahoo',
                        'delicious'  => 'Delicious',
                        'dropbox'    => 'Dropbox',
                        'reddit'     => 'Reddit',
                        'soundcloud' => 'Soundcloud',
                        'google'     => 'Google',
                        'google-plus' => 'Google Plus',
                        'skype'      => 'Skype',
                        'youtube'    => 'Youtube',
                        'vimeo'      => 'Vimeo',
                        'tumblr'     => 'Tumblr',
                        'whatsapp'   => 'Whatsapp',
		),
            ),
            array (
                    'id' => 'header_topbar_color_options',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => '<h3>Header Topbar color configure</h3>',
                    'required' => array( 'enable_top_bar', '=', 1),
            ),
            array (
                    'title' => esc_html__('Background Color', 'wooxon'),
                    'id' => 'header_topbar_background_color',
                    'type' => 'color_rgba',
                    'default' => '',
                    'transparent' => true,
                    'output'    => array('background-color' => '.header-top'),
                    'required' => array( 'enable_top_bar', '=', 1),
            ),
            array (
                    'title' => esc_html__('Text-color', 'wooxon'),
                    'id' => 'header_topbar_text_color',
                    'type' => 'color',
                    'default' => '',
                    'transparent' => true,
                    'output'    => array('color' => '.header-top, .header-top a,.header-top ul ul a'),
                    'required' => array( 'enable_top_bar', '=', 1),
            ),           
            array (
                    'title' => esc_html__('link hover color', 'wooxon'),
                    'id' => 'header_topbar_link_hover_color',
                    'type' => 'color',
                    'default' => '',
                    'transparent' => true,
                    'output'    => array('color' => '.header-top a:hover'),
                    'required' => array( 'enable_top_bar', '=', 1),
            ),
            array(
                    'id'      => 'topbar_inner',
                    'type'    => 'switch',
                    'title'   => esc_html__( 'Enable Top Bar Inner', 'wooxon' ),
                    'default' => '0',
            ),
            array(
                    'id'      => 'topbar_inner_show',
                    'type'    => 'switch',
                    'title'   => esc_html__( 'Inner content only show fontpage', 'wooxon' ),
                    'default' => '1',
                    'required' => array( 'topbar_inner', '=', 1 ),
            ),
            array (
                'title' => esc_html__('Top Bar inner content', 'wooxon'),
                'id' => 'topbar_inner_content',
                'type' => 'editor',
                'required' => array( 'topbar_inner', '=', 1),
                'default' => 'Custom text and allow html'
            ),
        )
    ) );     
    //header main menu 
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Menu Layout', 'wooxon' ),
        'desc'       => esc_html__( 'Configure your Main Menu Bellow the Option Available', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(
            array(
                    'id'      => 'full_width_menu',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Manu width', 'wooxon' ),                    
                    'options' => array(
                        'container' => 'Container', 
                        'container-fluid' => 'Container Fluid',
                        ), 
                    'default' => 'container-fluid'  
            ),   
            array(
            'id'       => 'menu_style',
            'type'     => 'image_select',
            'title'    => esc_html__('Layout', 'wooxon'), 
            'options' => array(
                '1' => array('alt'   => 'style 1', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-1.jpg'),
                '2' => array('alt'   => 'style 2', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-2.jpg'),                
                '21' => array('alt'   => 'style 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-3.jpg'),
                '22' => array('alt'   => 'style 4', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-4.jpg'),
                '23' => array('alt'   => 'style 5', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-5.jpg'),
                '24' => array('alt'   => 'style 6', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-51.jpg'),
                '6' => array('alt'   => 'style 7', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/header-6.jpg'),
                ), 
                'default' => '2'
            ),
            array(
                'id'       => 'menu_button_actions',
                'type'     => 'button_set',
                'title'    => esc_html__('Header button Action', 'wooxon'),
                'required' => array( 'menu_style', '=', array('21','22','23','24')),  
                'options' => array(
                    '1' => esc_html__('Icon view', 'wooxon'),
                    '2' => esc_html__('Text View', 'wooxon'),
                    ), 
                'default' => '1'  
            ),
            array(
                'id'       => 'help_text_need',
                'type'     => 'text',
                'title'    => esc_html__( 'Help Custom text Need', 'wooxon' ),
                'default' => 'Need',
                'required' => array( 'menu_button_actions', '=', '2'),
            ),
            array(
                'id'       => 'help_text_help',
                'type'     => 'text',
                'title'    => esc_html__( 'Help Custom text Help', 'wooxon' ),
                'default' => 'Help?',
                'required' => array( 'menu_button_actions', '=', '2'),
            ),
            array(
                'id'       => 'menu_help_content',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Custom help Content', 'wooxon' ),
                'subtitle' => esc_html__('If empty content nothing show', 'wooxon'),
                'required' => array( 'menu_button_actions', '=', '2'),
                'desc'  =>  esc_attr__( 'You can use demo html: <div class="d_flex align-items-center mb15">
                            <i class="icon-telephone4 f_s22"></i>
                            <div class="info-text lh_2 ml10">Call us now <br>4567 890 </div>                            
                        </div>
                        <div class="link">
                            <a href="#">Help Center</a>
                            <a href="#">Why Shop on?</a>
                            <a href="#">Track your order</a>
                            <a href="#">Contact us</a>
                        </div>', 'wooxon'),
                
            ),                        
            array(
                'id'       => 'menu_login_form',
                'type'     => 'button_set',
                'title'    => esc_html__('Login Menu or From', 'wooxon'),
                'subtitle' => esc_html__('Login Menu mean? Primary Login Menu', 'wooxon'),
                'default' => '0',
                'options' => array(
                    '0' => esc_html__('None', 'wooxon'),
                    '1' => esc_html__('Login Menu', 'wooxon'),
                    '2' => esc_html__('Login Form', 'wooxon'),
                    ), 
                'default' => '1'  
            ),
            array(
                'id'        => 'optn_terms_of_use_url',
                'title'     => esc_html__( 'Terms & Condition page', 'wooxon' ),
                'subtitle'  => esc_html__( 'The terms of use link page show on register form', 'wooxon' ),
                'type'      => 'select',
                'data'      => 'pages',
                'required' => array( 'menu_login_form', '=', '2'),
            ),
            array(
                'id'       => 'menu_custom_info',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Custom Text Phone area', 'wooxon' ),
                'subtitle' => esc_html__('If empty content nothing show', 'wooxon'),
                'required' => array( 'menu_style', '=', array('1','21','22','23')),               
                'default'  => '',
                'desc'  =>  esc_attr__( 'You can use demo html: <div class="info-text lh_2">
                            <abbr class="f_w6" title="Support Phone">24/7:</abbr> (123) 4567 890<br>
                            info@yourdomain.com
                            </div><div class="info-media"><i class="icon-headphone"></i></div>', 'wooxon'),
                
            ),
            array(
                    'id'      => 'enable_main_menu_category',
                    'type'    => 'switch',
                    'title'   => esc_html__( 'Enable Vertical Menu', 'wooxon' ),
                    'default' => '0',
                    'required' => array( 'menu_style', '=', array('1','21','22','23')),
            ),
             array(
                'id'       => 'main_menu_category_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Secondary vertical menu title', 'wooxon' ),
                'default'    => esc_html__( 'ALL CATEGORIES', 'wooxon' ),
                'required' => array( 'enable_main_menu_category', '=', 1 ),
            ),
            array(
                    'id'      => 'main_menu_category_open',
                    'type'    => 'switch',
                    'title'   => esc_html__( 'Vertical Menu Open Fontpage', 'wooxon' ),
                    'subtitle' => esc_html__('Fontpage Always show other page show, when hover', 'wooxon'),
                    'default' => '1',
                    'required' => array( 'enable_main_menu_category', '=', 1 ),
            ),
            array(
                'id' => "vertical_menu_animation",
                'type' => 'select',
                'title' => esc_html__('Secondary Vertical Menu Effect', 'wooxon'),
                'options' => array(
                    'effect-fadein-right' => esc_html__('Fade In Right', 'wooxon'),
                    'effect-fadein-left' => esc_html__('Fade In Left', 'wooxon'),
                    'effect-fadein' => esc_html__('Fade In', 'wooxon'),
                    'effect-down' => esc_html__('Drop Down', 'wooxon'),
                    'effect-fadein-up' => esc_html__('Fade In Up', 'wooxon'),
                    'effect-fadein-down' => esc_html__('Fade In Down', 'wooxon'),                    
                ),
                'default' => 'effect-fadein-right',
                'required' => array( 'enable_main_menu_category', '=', 1 ),
            ),
            array(
                'id' => 'vertical_menu_sidebar',
                'type' => 'select',
                'title' => esc_html__('Vertical menu bottom Sidebar', 'wooxon'),
                'subtitle' => "Choose Your sidebar",
                'data'      => 'sidebars',
                'default' => '',
                'required' => array( 'menu_style', '=', array('3')), 
            ),
            array(
                'id'      => 'menu_before_slider_enable',
                'type'    => 'switch',
                'title'   => esc_html__( 'Slider before menu', 'wooxon' ),
                'subtitle'  => esc_html__('Tab Transparency Should be disable', 'wooxon'),                
                'default' => 0,
                'required'  => array('menu_style', '=', 2)
            ),
            array(
                "type"        => "text",
                "title" => esc_html__('Put the slider shortcode', 'wooxon'),
                'subtitle'  => esc_html__('Enter Slider Revolution shortcode', 'wooxon'),
                'desc'  => esc_html__('Like as: [rev_slider alias="home1"]  Here any shortcode works', 'wooxon'),                
                "id"  => "menu_before_slider",
                'required'  => array('menu_before_slider_enable', '=', 1)
            ),
            array(
                "type"        => "switch",
                "title" => esc_html__('Enable Sticky menu', 'wooxon'),
                'subtitle'  => esc_html__('Please read the text important', 'wooxon'),
                'desc'  => esc_html__('!IMPORTANT: slide after menu sticky mode if enable sticky mode perfectly works. if need additional change: Tab Sticky Menu -> Sticky Header option enable then configure', 'wooxon'),
                "id"  => "slide_after_menu_sticky",
                'default' => 0,
                'required'  => array('menu_before_slider_enable', '=', 1)
            ),
            array(
                'id' => 'optn_verticle_menu_sidebar',
                'type' => 'select',
                'title' => esc_html__('Vertical menu bottom Sidebar', 'wooxon'),
                'subtitle' => "Choose Your sidebar",
                'data'      => 'sidebars',
                'default' => '',
                'required' => array( 'menu_style', '=', array('3')), 
            ),
            array(
                'id'       => 'menu_custom_text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Custom Text', 'wooxon' ),
                'subtitle' => esc_html__( 'NB: add Your custom text flowing html', 'wooxon' ),
                'required' => array( 'menu_style', '=', array('5')),               
                'default'  => wp_kses( __( '<ul>
                                <li>
                                   <i class="fa fa-truck"></i>
                                   <span>Free Delivery</span>
                                   <p>on all orders</p>
                                </li>
                                <li>
                                   <i class="fa fa-clock-o"></i>
                                   <span class="text-custom">08:00 - 17:00</span>
                                   <p>monday - saturday</p>
                                </li>
                                <li>
                                   <i class="fa fa-phone"></i>
                                   <span class="text-custom">0203-980-14-79</span>
                                   <p>call us now</p>
                                </li>
                            </ul>', 'wooxon' ), array( 'div' => array( 'class' => array(),  ), 'ul' => array( 'class' => array(),  ), 'li' => array(), 'i' => array( 'class' => array()), 'span' => array(), 'p' => array(),  'a' => array( 'href' => array(), 'target' => array()) ) ),
                
                
            ),
            array (
                    'title' => esc_html__('Logo Background Color', 'wooxon'),
                    'id' => 'header_logo_background_color',
                    'type' => 'color',
                    'default' => '',
                    'transparent' => true,
                    'output'    => array('background-color' => '.header-layout-6 .site-header .site-logo'),
                    'required' => array( 'menu_style', '=', array('6')),
            ),
            array(
                'id' => 'main_menu_bg',
                'type' => 'background',
                'url' => true,
                'title' => esc_html__('Background Image', 'wooxon'),
                'compiler' => 'true',
                'preview' => 'true',
                'preview_media' => 'true',
                'background-size' => 'true',
                'background-attachment' => 'true',
                'output'   => array('background-image'    => '.header-wrapper .site-header')
            ),
        )
    ) );
    //header main menu configure
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Configure', 'wooxon' ),
        'desc'       => esc_html__( 'Configure Main Menu Available Option', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(                     
            array(
                'id' => "main_menu_animation",
                'type' => 'select',
                'title' => esc_html__('Menu Dropdown Effect', 'wooxon'),
                'options' => array(
                    'effect-down' => esc_html__('Drop Down', 'wooxon'),
                    'effect-fadein-up' => esc_html__('Fade In Up', 'wooxon'),
                    'effect-fadein-down' => esc_html__('Fade In Down', 'wooxon'),
                    'effect-fadein' => esc_html__('Fade In', 'wooxon'),
                ),
                'default' => 'effect-down'
            ),
            array(
                'id' => "sub_menu_animation",
                'type' => 'select',
                'title' => esc_html__('Dropdown Sub menu Effect', 'wooxon'),
                'options' => array(
                    'subeffect-down' => esc_html__('Drop Down', 'wooxon'),
                    'subeffect-fadein-left' => esc_html__('Fade In Left', 'wooxon'),
                    'subeffect-fadein-right' => esc_html__('Fade In Right', 'wooxon'),
                    'subeffect-fadein-up' => esc_html__('Fade In Up', 'wooxon'),
                    'subeffect-fadein-down' => esc_html__('Fade In Down', 'wooxon'),
                    'subeffect-fadein' => esc_html__('Fade In', 'wooxon'),
                ),
                'default' => 'subeffect-fadein-left'
            ),
            array(
                    'id'      => 'menu_search',
                    'type'    => 'switch',
                    'title'   => sprintf( wp_kses( __( '<i class="fa fa-search" ></i> Search icon menu bar', 'wooxon' ), array( 'i' => array( 'class' => array(),  ) ) ) ),
                    'default' => '1',   
            ),
            array (
                'id' => 'search_category',
                'type' => 'switch',
                'title' => esc_html__( 'Search category dropdown show', 'wooxon' ),
                'default' => false,
            ),
            array (
                'id' => 'search_ajax',
                'type' => 'switch',
                'title' => esc_html__( 'AJAX Search', 'wooxon' ),
                'default' => false,
            ),
            array (
                'id' => 'search_ajax_post',
                'type' => 'switch',
                'title' => esc_html__( 'Search by posts', 'wooxon' ),
                'default' => false,
            ),
            array (
                'id' => 'search_ajax_product',
                'type' => 'switch',
                'title' => esc_html__( 'Search by products', 'wooxon' ),
                'default' => false,
            ),
            array (
                'id' => 'search_by_sku',
                'type' => 'switch',
                'title' => esc_html__( 'Search by sku', 'wooxon' ),
                'default' => false,
            ),
            array(
                    'id'      => 'show_wishlist_iocn',
                    'type'    => 'switch',
                    'title'   => esc_html__( 'Wishlist icon menu bar', 'wooxon' ),
                    'default' => '0',
            ),
            array(
                    'id'      => 'show_cart_iocn',
                    'type'    => 'switch',
                    'title'   => sprintf( wp_kses( __( '<i class="fa fa-shopping-cart" ></i> Cart icon menu bar', 'wooxon' ), array( 'i' => array( 'class' => array(),  ) ) ) ),
                    'default' => '1',
            ),            
            array(
                'id'      => 'mini_cart_layout',
                'type'    => 'button_set',
                'title'   => esc_html__( 'Cart Layout', 'wooxon' ),                    
                'options' => array(
                    'off_canvas' => 'Canvas', 
                    'normal' => 'Normal',
                    ), 
                'default' => 'normal',
                'required' => array( 'show_cart_iocn', '=', 1 ),
            ),
            array(
                'id'       => 'mini_cart_info',
                'type'     => 'text',
                'title'    => esc_html__( 'Mini cart button text', 'wooxon' ),
                'subtitle' => esc_html__( 'if empty nothing', 'wooxon' ),
                'default' => 'Orders Over $75 Get Free Shipping',
                'required' => array( 'mini_cart_layout', '=', 'off_canvas' ),
            ), 
            array (
                    'id' => 'header_bg_options',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => '<h3>Header Main color configure</h3>',
            ),            
            array(
                'id'        => 'header_background',
                'type'      => 'color_rgba',
                'title'     => 'Header Background Color',
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),
                'output'    => array( 
                        'background-color' => '.header-layout-1 .site-header .header-main .header-right,.header-layout-2 .site-header .header-main,.header-layout-4 .header-wrapper .mega-menu-sidebar,.header-layout-3 .header-wrapper.header-side-nav #header,.header-layout-5 .site-header .header-main .header-right,.header-layout-6 .site-header .header-main',
                        'border-bottom-color' => '.header-layout-1 .site-header .header-main,.header-layout-6 .site-header .header-main,.header-layout-5 .site-header .header-main .header-left',                    
                    ),               
            ),
            array (
                    'title' => esc_html__('Header Link Color', 'wooxon'),
                    'id' => 'header_link_color',
                    'type' => 'color',
                    'default' => '',
                    'transparent' => false,
                    'output'    => array('color' => '.mega-menu > li.menu-item > a,.site-header .header-actions .tools_button .cart-items, .mega-menu-sidebar .main-menu.mega-menu > li.menu-item > a, .mega-menu-sidebar .main-menu.mega-menu > li.menu-item > h5,.header-layout-5 .site-header .main-menu > .menu-item > a'),                  
                    
            ),
            array (
                    'title' => esc_html__('Header Link Background Color', 'wooxon'),
                    'id' => 'header_link_background_color',
                    'type' => 'color',
                    'default' => '',
                    'transparent' => true,
                    'output'    => array('background-color' => '.mega-menu > li.menu-item > a'),
                   
            ),
            array (
                    'title' => esc_html__('Header Link Hover Color', 'wooxon'),
                    'id' => 'header_link_hover_color',
                    'type' => 'color',
                    'default' => '',
                    'transparent' => false,
                    'output'    => array(
                        'color' => '.header-layout-6.header-transparency .site-header:not(.active-sticky) .header-actions .tools_button:hover,.header-layout-6.header-transparency .site-header:not(.active-sticky) .mega-menu > li.menu-item > a:hover,.header-layout-6.header-transparency .site-header:not(.active-sticky) .mega-menu > li.menu-item > h5:hover,.header-layout-5.header-transparency .site-header:not(.active-sticky) .header-actions .tools_button:hover,.header-layout-5.header-transparency .site-header:not(.active-sticky) .mega-menu > li.menu-item > a:hover,.header-layout-5.header-transparency .site-header:not(.active-sticky) .mega-menu > li.menu-item > h5:hover,.header-layout-4.header-transparency .site-header:not(.active-sticky) .header-actions .tools_button:hover,.header-layout-4.header-transparency .site-header:not(.active-sticky) .mega-menu > li.menu-item > a:hover,.header-layout-4.header-transparency .site-header:not(.active-sticky) .mega-menu > li.menu-item > h5:hover,.header-layout-2.header-transparency .site-header:not(.active-sticky) .header-actions .tools_button:hover,.header-layout-2.header-transparency .site-header:not(.active-sticky) .mega-menu > li.menu-item > a:hover,.header-layout-2.header-transparency .site-header:not(.active-sticky) .mega-menu > li.menu-item > h5:hover,.header-layout-1.header-transparency .site-header:not(.active-sticky) .header-actions .tools_button:hover,.header-layout-1.header-transparency .site-header:not(.active-sticky) .mega-menu > li.menu-item > a:hover,.header-layout-1.header-transparency .site-header:not(.active-sticky) .mega-menu > li.menu-item > h5:hover,.mega-menu > li.menu-item:hover > a,.mega-menu > li.menu-item.active > a,.mega-menu > li.menu-item.active > h5,.mega-menu-sidebar .main-menu.mega-menu > li.menu-item.active > a, .mega-menu-sidebar .main-menu.mega-menu > li.menu-item.active > h5, .mega-menu-sidebar .main-menu.mega-menu > li.menu-item:hover > a, .mega-menu-sidebar .main-menu.mega-menu > li.menu-item:hover > h5,.header-layout-5 .mega-menu > li.menu-item:hover > a',
                        ),
                    
            ),
            array (
                    'title' => esc_html__('Header Link Hover Background Color', 'wooxon'),
                    'id' => 'header_link_hover_background_color',
                    'type' => 'color',
                    'default' => '',
                    'transparent' => true,
                    'output'    => array('background-color' => '.mega-menu > li:hover > a, .mega-menu-sidebar .main-menu.mega-menu > li.menu-item.active > a, .mega-menu-sidebar .main-menu.mega-menu > li.menu-item.active > h5, .mega-menu-sidebar .main-menu.mega-menu > li.menu-item:hover > a, .mega-menu-sidebar .main-menu.mega-menu > li.menu-item:hover > h5'),
                    
            ),
            array (
                    'title' => esc_html__('Header Icon color', 'wooxon'),
                    'id' => 'header_action_icon_color',
                    'type' => 'color',
                    'default' => '',
                    'transparent' => false,
                    'output'    => array('color' => '.header-layout-1 .site-header .header-actions > ul a,.header-layout-2 .site-header .header-main .header-right .header-actions > ul a,.header-layout-3 .site-header .header-actions a.tools_button,.header-layout-4 .site-header .header-actions .tools_button,.header-layout-5 .site-header .header-actions .tools_button,.header-layout-6 .site-header .header-actions > ul a'),                  
                    
            ),
            array (
                    'id' => 'header_mega_menu_options',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => '<h3>Header Mega menu Color configure</h3>',
            ),
            array (
                    'title' => esc_html__('Header mega Link Color', 'wooxon'),
                    'id' => 'header_mega_link_color',
                    'type' => 'color',
                    'default' => '',
                    'transparent' => false,
                    'output'    => array('color' => '.mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item > a'),                    
            ),
            array (
                    'title' => esc_html__('Header mega Link Hover Color', 'wooxon'),
                    'id' => 'header_mega_link_hover_color',
                    'type' => 'color',
                    'default' => '',
                    'transparent' => false,
                    'output'    => array('color' => '.mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item > a:hover, .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item > a:focus, .mega-menu .wide .popup > .inner > ul.sub-menu > li.menu-item li.menu-item.current_page_item > a'),                    
            ),
            array (
                    'title' => esc_html__('Header Mega menu Background Color', 'wooxon'),
                    'id' => 'header_mega_menu_background_color',
                    'type' => 'color',
                    'default' => '',
                    'transparent' => true,
                    'output'    => array(
                        'background-color' => '.mega-menu .wide .popup > .inner',
                        'border-color' => '.mega-menu .wide .popup > .inner',
                    ),                   
            ),
        )
    ) );    
    //header active sticky configure
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Sticky Mode', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(
            array (
                    'title' => esc_html__('Sticky Header', 'wooxon'),
                    'id' => 'sticky_header',
                    'type' => 'switch',
                    'default' => 0,
            ),
            array (
                    'title' => esc_html__('Logo In Header Sticky', 'wooxon'),
                    'id' => 'sticky_header_hide_logo',
                    'type' => 'switch',
                    'default' => 0,
                    'required' => array('menu_style','=','1','6')
            ),                                 
        )
    ) );
    //header transparency
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Transparency', 'wooxon' ),
        'desc'       => esc_html__( 'Configure your Main Menu Header Transparency Bellow the Option Available', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(
            array (
                    'title' => esc_html__('Enable menu transparency', 'wooxon'),
                    'id' => 'header_transparency',
                    'type' => 'switch',
                    'default' => 0,
            ),
            array(
                'id'      => 'header_transparency_option',
                'type'    => 'button_set',
                'title'   => esc_html__( 'Transparency Action', 'wooxon' ),                    
                'options' => array(
                    'fontpage' => esc_html__('Font Page', 'wooxon'), 
                    'allpage' => esc_html__('All Page', 'wooxon'),
                    ), 
                'default' => 'fontpage',
                'required' => array( 'header_transparency', '=', 1 ),
            ),            
            array(
                'type'      => 'color_rgba',
                'title' => esc_html__('Border color', 'wooxon'),
                'id' => 'header_transparency_border',             
                'output'    => array('border-bottom-color' => '.header-layout-6 .site-header .header-main,.header-layout-5.header-transparency .site-header .header-main .header-left, .header-layout-5.header-transparency .site-header .header-top,.header-layout-2 .site-header .header-main,.header-layout-1 .site-header .header-main'),
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),
                'required' => array('header_transparency','=','1')
            ),
        )
    ) );  
    
    //Breadcrumb
    Redux::setSection( $opt_name, array(
        'title'   => esc_html__( 'Breadcrumbs', 'wooxon' ),
        'icon'    => 'el el-credit-card',        
        'fields'  => array(
            array (
                    'title' => esc_html__('Enable Breadcrumbs', 'wooxon'),
                    'id' => 'breadcrumbs_disable',
                    'type' => 'switch',
                    'default' => 1,
            ),
            array(
                'id'       => 'breadcrumbs_prefix',
                'type'     => 'text',
                'title'    => esc_html__( 'Breadcrumb prefix', 'wooxon' ),
                'subtitle' => esc_html__( 'if empty nothing', 'wooxon' ),
              'required' => array( 'breadcrumbs_disable', '=', 1 ),
            ),             
            array(
                'id'       => 'optn_breadcrumb_name',
                'type'     => 'text',
                'compiler' => true,
                'title'    => esc_html__( 'Breadcrumb Home Link', 'wooxon' ),
                'default'  => 'Home',
              'required' => array( 'breadcrumbs_disable', '=', 1 ),
            ),
            array(
                'id'       => 'optn_breadcrumb_delimiter',
                'type'     => 'text',
                'compiler' => true,
                'title'    => esc_html__( 'Breadcrumb delimiter', 'wooxon' ),
                'desc'     => sprintf( wp_kses( __( 'Just use class like as: fa fa-angle-right  <a href="%s" target="__blank">Click font awesome</a>', 'wooxon' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), 'https://fontawesome.com/v4.7.0/icons/' ),
                'default'  => 'fa fa-angle-right',
              'required' => array( 'breadcrumbs_disable', '=', 1 ),
            ),
            array(
                        'id' => 'optn_header_img',
                        'type' => 'media',
                        'url' => true,
                        'title' => esc_html__('Background image', 'wooxon'),
                        'compiler' => 'true',
                        'default'  => array(
                                    'url' => get_template_directory_uri(). '/assets/images/page-title.gif'
                        ),
                    'required' => array( 'breadcrumbs_disable', '=', 1 ),
                    ),                
            array(
                'id'       => 'optn_header_img_repeat',
                'type'     => 'button_set',
                'multi'    => false,
                'title'    => esc_html__('Background image repeat', 'wooxon'),
                'options'  => array(  
                    'repeat'   => esc_html__( 'Repeat', 'wooxon' ),
                    'no-repeat'  => esc_html__( 'No repeat', 'wooxon' ),
                    'fixed'  => esc_html__( 'Fixed', 'wooxon' ),
                    ),
                'default'   => 'repeat',
                'required' => array( 'breadcrumbs_disable', '=', 1 ),
            ),            
            array (
                    'id' => 'header_breadcrumb_ifo',
                    'icon' => true,
                    'type' => 'info',
                    'required' => array( 'breadcrumbs_disable', '=', 1 ),
                    'raw' => '<h3>Breadcrumb Color configure</h3>',
            ),
            array(
                    'id'       => 'optn_header_img_bg_color',
                    'type'     => 'color',
                    'compiler' => true,
                    'title'    => esc_html__( 'Bankground Color', 'wooxon' ),
                    'output'    => array('background-color' => '.page-header'),
                    'required' => array( 'breadcrumbs_disable', '=', 1 ),
                    
                ),
            
                array(
                    'id'       => 'page_link_color',
                    'type'     => 'color',
                    'compiler' => true,
                    'title'    => esc_html__( 'Link Color', 'wooxon' ),
                    'required' => array( 'breadcrumbs_disable', '=', 1 ),
                    'output'   => array(
                            'color'    => '.breadcrumb a,.breadcrumb i, .page-header .cat-dsc'
                        )
                ),
                array(
                    'id'       => 'page_link_hover_color',
                    'type'     => 'color',
                    'compiler' => true,
                    'title'    => esc_html__( 'Link hover Color', 'wooxon' ),
                    'required' => array( 'breadcrumbs_disable', '=', 1 ),
                    'output'   => array(
                            'color'    => '.breadcrumb a:hover'
                        )
                ),
                array(
                    'id'       => 'page_link_active',
                    'type'     => 'color',
                    'compiler' => true,
                    'title'    => esc_html__( 'Active & Prefix Color', 'wooxon' ),
                    'required' => array( 'breadcrumbs_disable', '=', 1 ),
                    'output'   => array(
                            'color'    => '.breadcrumb > .current, .breadcrumb .prefix'
                        )
                ),
        )
    ));
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Blog', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(                       
            array(
                'id'       => 'blog_page_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Blog page title', 'wooxon' ),
                'default'  => 'Blog',
                'required' => array( 'breadcrumbs_disable', '=', 1 ),
            ),
            array(
                'id' => 'blog_page_cat',
                'type' => 'select',
                'title' => esc_html__('Category list', 'wooxon'),
                'data' => 'terms',
                'args' => array(
                    'taxonomies' => array( 'category' ),
                ),
                'multi'    => true,
                'required' => array( 'breadcrumbs_disable', '=', 1 ),
            ),
        )
    ));   
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Page', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(                       
            array (
                    'title' => esc_html__('Enable Breadcrumb', 'wooxon'),
                    'id' => 'optn_breadcrubm_layout',
                    'type' => 'switch',
                    'default' => 0,
                    'required' => array( 'breadcrumbs_disable', '=', 1 ),
            ),
            array(
                    'id'             => 'page_title_padding',
                    'type'           => 'spacing',
                    'mode'           => 'padding',
                    'units'          => 'px',
                    'units_extended' => 'false',
                    'title'          => esc_html__('Breadcrumb padding', 'wooxon'),
                    'subtitle'       => esc_html__('This must be numeric (no px)', 'wooxon'),
                    'left'          => false,
                    'right'          => false,
                    'output'        => array('.page .page-header'),                    
                    'required' => array( 'breadcrumbs_disable', '=', 1 ),
            ),
            array(
                'id'       => 'optn_header_title_text_align',
                'type'     => 'button_set',
                'multi'    => false,
                'title'    => esc_html__('Breadcrubm Text Align', 'wooxon'),
                'options'  => array(
                    'l'   => esc_html__( 'Left', 'wooxon' ),
                    'c'  => esc_html__( 'Center', 'wooxon' ),
                    'r'  => esc_html__( 'Right', 'wooxon' ),                            
                ),
                'default'   => 'c',
                'required' => array( 'breadcrumbs_disable', '=', 1 ),
            ),
            array(
                'id'       => 'header_img_bg_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__( 'Bankground Color', 'wooxon' ),
                'output'    => array('background-color' => '.page .page-header'),
                'required' => array( 'breadcrumbs_disable', '=', 1 ),

            ),
            array(
                'id'       => 'page_title_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__( 'Title Color', 'wooxon' ),
                'required' => array( 'breadcrumbs_disable', '=', 1 ),
                'output'   => array(
                        'color'    => '.page .page-header h1'
                    )
            ),
        )
    ));
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Post', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(                   
                array(
                    'id'             => 'optn_page_title_padding',
                    'type'           => 'spacing',
                    'mode'           => 'padding',
                    'units'          => 'px',
                    'units_extended' => 'false',
                    'title'          => esc_html__('Breadcrumb padding', 'wooxon'),
                    'subtitle'       => esc_html__('This must be numeric (no px)', 'wooxon'),
                    'left'          => false,
                    'right'          => false,
                    'output'        => array('.page-header'),
                    'required' => array( 'breadcrumbs_disable', '=', 1 ),
                ),                
        )
    ));
    //page setup
        Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Page Setting', 'wooxon' ),
        'icon'  => 'el el-list-alt',
        'fields'     => array(                      
            array(
                'id'       => 'optn_page_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__('Page sidebar position', 'wooxon'),
                'options'  => array(
                    'fullwidth'      => array(
                        'alt'   => 'Full Width', 
                        'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                    ),
                    'left'      => array(
                        'alt'   => 'Left sidebar', 
                        'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                    ),
                    'right'      => array(
                        'alt'   => 'Right sidebar', 
                        'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                    ),
                    'both'      => array(
                        'alt'   => 'Both sidebar', 
                        'img'  => ReduxFramework::$_url.'assets/img/3cm.png'
                    ),
                ),
                'default' => 'fullwidth'
            ),
            array(
                'id' => 'optn_page_sidebar',
                'type' => 'select',
                'title' => esc_html__('Widget area', 'wooxon'),
                'data'      => 'sidebars',
                'default' => 'sidebar-2',
                'required' => array( 'optn_page_sidebar_pos', '=', array('left', 'right', 'both'), ),
            ),
            array(
                'id' => 'optn_page_sidebar_left',
                'type' => 'select',
                'title' => esc_html__('widget area two', 'wooxon'),
                'data'      => 'sidebars',
                'required' => array( 'optn_page_sidebar_pos', '=', 'both', ),
            ),
            array(
                'id'       => 'optn_page_sidebar_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sidebar Width', 'wooxon' ),              
                'default'  => 'small',
                'options'  => array(
                        'large' => esc_html__( 'Large(1/4)', 'wooxon' ),
                        'small' => esc_html__( 'Small(1/3)', 'wooxon' ),
                ),
                'required' => array( 'optn_page_sidebar_pos', '=', array('left', 'right', 'both'), ),
            ),            
        )
    ));
  
      //footer option
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Footer', 'wooxon' ),        
        'icon'             => 'el el-photo',
        'fields'     => array(
            array(
                    'id'      => 'footer_bottom_width',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Footer bottom width', 'wooxon' ),                    
                    'options' => array(
                        'container' => 'Container', 
                        'container-fluid' => 'Container Fluid',
                        ), 
                    'default' => 'container',
            ),
            array(
                'id'      => 'optn_footer_style',
                'type'    => 'image_select',
                'title'   => esc_html__( 'Footer bottom layout.', 'wooxon' ),
                'default' =>'style1',
                'options'  => array(
                    'style1'      => array(
                        'alt'   => 'style 1', 
                        'img'   => get_template_directory_uri() . '/assets/images/theme-options/footer-layout-5.jpg'
                    ),
                    'style2'      => array(
                        'alt'   => 'style 2', 
                        'img'   => get_template_directory_uri() . '/assets/images/theme-options/footer-layout-4.jpg'
                    ),                                        
                ),
            ),                        
            array(
                'id'       => 'sub_footer_text',
                'type'     => 'editor',
                'title'    => esc_html__( 'Copyright text', 'wooxon' ),
                'args'   => array(
                    'teeny'            => true,
                ),
                'default'  => wp_kses( __( '&copy; 2018. All Right Reserved', 'wooxon' ), array( 'a' => array( 'href' => array() ) ) ),
                
            ),
            array(
                'id'       => 'optn_footer_right',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Right Side Option', 'wooxon' ),                               
                'default'  => '3',
                'required' => array( 'optn_footer_style', '=', 'style2', ),
                'options'  => array(                        
                        '1' => esc_html__( 'Social Icon', 'wooxon' ),
                        '2' => esc_html__( 'Payment Logo', 'wooxon' ),
                        '3' => esc_html__( 'Menu item', 'wooxon' ),
                        '4' => esc_html__( 'Social Icon  +  menu', 'wooxon' ),
                        '5' => esc_html__( 'Payment logo +  menu', 'wooxon' ),
                ),
            ),
            array(
                'id'        => 'optn_payment_logo_upload',
                'type'      => 'gallery',
                'title'    => esc_html__( 'Payment logo', 'wooxon' ),
                'required' => array( 'optn_footer_right', '=',  array('2', '5') ),
                'compiler' => true,
            ),
            array(
                'id'       => 'footer_social',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Footer Social Media Icons to display', 'wooxon' ),
                'subtitle' => esc_html__( 'The Social urls taken from Social Media settings', 'wooxon' ),
                'required' => array(
                        array( 'optn_footer_right', '=', array('1', '4') )
                ),
                'default' => array(
                    'facebook' => '1', 
                    'twitter' => '1',
                    'instagram' => '1',
                    'flickr' => '1'
                ),
                'options'  => array(
                        'facebook'   => 'Facebook',
                        'twitter'    => 'Twitter',
                        'flickr'     => 'Flickr',
                        'instagram'  => 'Instagram',
                        'behance'    => 'Behance',
                        'dribbble'   => 'Dribbble',                        
                        'git'        => 'Git',
                        'linkedin'   => 'Linkedin',
                        'pinterest'  => 'Pinterest',
                        'yahoo'      => 'Yahoo',
                        'delicious'  => 'Delicious',
                        'dropbox'    => 'Dropbox',
                        'reddit'     => 'Reddit',
                        'soundcloud' => 'Soundcloud',
                        'google'     => 'Google',
                        'google-plus' => 'Google Plus',
                        'skype'      => 'Skype',
                        'youtube'    => 'Youtube',
                        'vimeo'      => 'Vimeo',
                        'tumblr'     => 'Tumblr',
                        'whatsapp'   => 'Whatsapp',
                ),
            ),
            array (
                    'id' => 'footer_bottom_color',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => '<h3>Footer Bottom Color</h3>',
            ),
            array(
                'id'        => 'footer_main_bg_color',
                'type'      => 'color_rgba',
                'title'     =>  esc_html__('Background color', 'wooxon'),               
                'output'    => array('background-color' => '.site-footer .main-footer,.site-footer .footer-layout3-wrap .main-footer', 'border-color' => '.site-footer .main-footer', ),                
                
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),                                    
            ),
            array(
                'id'       => 'footer_main_font_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__( 'Fonts color', 'wooxon' ),
                'transparent' => false,
                'output'   => array(
                        'color'    => '.site-info'
                    )
            ),            
            array(
                'id'       => 'footer_main_link_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__( 'Link color', 'wooxon' ),
                'default'  => '',
                'transparent' => false,
                'output'   => array(
                        'color'    => '.site-footer.layout2 .site-info a,.info-center-wrap .site-info a,.main-footer .site-info a,.footer-layout3-wrap .main-footer .social-icon a,.main-footer .social-icon a, .footer-layout3-wrap .main-footer .footer-links-menu li a,.main-footer .footer-links-menu li a '
                    )
            ),            
            array(
                'id'       => 'footer_main_link_hover_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__( 'Link hover color', 'wooxon' ),
                'default'  => '',
                'transparent' => false,
                'output'   => array(
                        'color'    => '.info-center-wrap .site-info a:hover, .info-center-wrap .site-info a:focus,.main-footer .site-info a:hover,.footer-layout3-wrap .main-footer .social-icon a:hover,.main-footer .social-icon a:hover, .footer-layout3-wrap .main-footer .footer-links-menu li a:hover,.main-footer .footer-links-menu li a:hover'
                    )
            ),
            array(
                'id'       => 'footer_main_top_border_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__( 'border color', 'wooxon' ),
                'default'  => '',
                'transparent' => false,
                'output'   => array(
                        'border-color'    => '.site-footer.layout2 .footer-perallx-wrap .info-center-wrap, .site-footer.layout2 .footer-perallx-wrap .main-footer',
                        'border-bottom-color' => '.site-footer .footer-layout3-wrap .sidebar-two,.site-footer .footer-layout3-wrap .sidebar-one'
                    )
            ),
        )
    ));
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Inner Layout', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(
            array(
                    'id'      => 'footer-inner-width',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Footer inner width', 'wooxon' ),                    
                    'options' => array(
                        'container' => 'Container', 
                        'container-fluid' => 'Container Fluid',
                        ), 
                    'default' => 'container'  
            ),            
            array(
                'id'       => 'footer_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Footer Layout', 'wooxon'),
                'options'  => array(
                    'layout1'      => array(
                        'alt'   => 'Layout 1', 
                        'img'   => get_template_directory_uri() . '/assets/images/theme-options/footer-layout-1.jpg'
                    ),
                    'layout2'      => array(
                        'alt'   => 'Layout 2', 
                        'img'   => get_template_directory_uri() . '/assets/images/theme-options/footer-layout-2.jpg'
                    )                   
                ),
                'default' => 'layout1'
            ),
            array(
                'id'      => 'footer_parallax',
                'type'    => 'switch',
                'title'   => esc_html__( 'Enable Footer Parallax.', 'wooxon' ),                 
                'default' => 0,
                'required' => array( 'footer_layout', '=', 'layout2'),
            ),
            array(
                'id'             => 'footer_parallax_padding',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'units'          => 'px',
                'title'          => esc_html__('Set margin according to your footer height', 'wooxon'),
                'left'          => false,
                'right'          => false,
                'top'           => false,
                'output'        => array('.has-footer-parallax .site-inner'),
                'required' => array( 'footer_parallax', '=', 1),
                'default'            => array(
                    'margin-bottom'  => '450px',
                    'units'          => 'px',
                )
            ),
            
            array(
                'id'       => 'footer_background_image_type',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Background Image Type', 'wooxon' ),
                'options'  => array(
                        'footer_bg_default'     => esc_html__( 'Default', 'wooxon' ),
                        'footer_bg_custom'        => esc_html__( 'Custom', 'wooxon' )
                ),
                'default'  => 'footer_bg_default',
                'required' => array( 'footer_parallax', '=', 0),
            ),
            array(
                'id'       => 'footer_background_image',
                'type'     => 'image_select',
                'title'    => esc_html__('Background Image', 'wooxon'),
                'tiles'    => true,
                'options'  => array(                        
                        get_template_directory_uri() . '/assets/images/footer-bg3.jpg'      => array(
                                'img'   => get_template_directory_uri() . '/assets/images/footer-bg3.jpg'
                        )
                ),
                'default'  => get_template_directory_uri() . '/assets/images/footer-bg.jpg',
                'required' => array(
                        array( 'footer_background_image_type', '=', 'footer_bg_default' ),
                ),
                'output'   => array(
                        'background-image' => 'footer.site-footer.layout2'
                )
            ),            
            array(
                'id'       => 'footer_background_custom_image',
                'type'     => 'background',
                'title'    => esc_html__('Custom Background', 'wooxon'),
                'required' => array(
                        array( 'footer_background_image_type', '=', 'footer_bg_custom' ),
                ),
                'output'   => array(
                        'background-image' => 'footer.site-footer.layout2'
                )
            ),
            array(
                'id'        => 'footer_opacity_bg_color',
                'type'      => 'color_rgba',
                'title'     => esc_html__('Background Color', 'wooxon'),            
                'output'    => array('background-color' => 'footer.site-footer.layout2:before'),
                'default'   => array(
                    'color'     => '#fff',
                    'alpha'     => 1
                ),
                'required' => array( 'footer_background_image_type', '=', 'footer_bg_default' ),
            ),
            array (
                    'id' => 'footer_inner_color_con',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => '<h3>Footer Inner color</h3>',
            ),
            array(
                'id'        => 'footer_opacity_bg_two_color',
                'type'      => 'color_rgba',
                'title'     => esc_html__('Background Color', 'wooxon'),              
                'output'    => array(
                    'background-color' => '.site-footer .footer-layout3-wrap .sidebar-two'),
                'default'   => array(
                    'color'     => '',
                    'alpha'     => 1
                ),                                    
            ),
             array(
                    'id'       => 'footer_sidebar3_title_color',
                    'type'     => 'color',
                    'compiler' => true,
                    'transparent' => false,
                    'title'    => esc_html__( 'Widgets Title color', 'wooxon' ),
                    'output'   => array(
                            'color'    => '.sub-footer .widget .widget-title,.sidebar-two .sub-footer .widget .widget-title'
                        )
                ),
            
            array(
                'id'        => 'footer_sidebar_two_color',
                'type'      => 'color',
                'transparent' => false,
                'title'     => esc_html__('Fonts Color', 'wooxon'),
                'output'    => array(
                    'color' => '.sub-footer .widget p,.sub-footer .widget,.sidebar-two .sub-footer .widget p, .sidebar-two .sub-footer .widget address'
                    ),
                'default'   => '',                                 
            ),
            array(
                'id'        => 'footer_sidebar_link_color',
                'type'      => 'color',
                'transparent' => false,
                'title'     => esc_html__('Link Color', 'wooxon'),
                'output'    => array(
                    'color' => '.sub-footer .widget a,.sidebar-two .sub-footer .widget a, .sub-footer .widget ul li a, .sub-footer .widget .comment-author-link a,.sidebar-two .sub-footer .widget .tagcloud a, .sidebar-two .sub-footer .widget ul li a, .sidebar-two .sub-footer .widget a, .sidebar-two .sub-footer .widget abbr'
                    ),
                'default'   => '',                                 
            ),
            array(
                'id'       => 'sub_footer_link_hover',
                'type'     => 'color',
                'compiler' => true,
                'transparent' => false,
                'title'    => esc_html__( 'Link Hover color', 'wooxon' ),
                'output'   => array(
                    'color' => '.sub-footer .widget a:hover,.sub-footer .widget a:focus,.sidebar-two .sub-footer .widget a:hover, .sub-footer .widget ul li a:hover, .sub-footer .widget .comment-author-link a:hover'
                    )
            ),
            
                 
        )
    ) );
     //footer inner color configure   
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Inner widget', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(                       
            array(
                'id'      => 'footer_widgets',
                'type'    => 'switch',
                'title'   => esc_html__( 'Enable Footer Inner widgets', 'wooxon' ),                 
                'default' => 0,
            ),
            array(
                'id'       => 'footer_columns',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Inner columns', 'wooxon' ),             
                'default'  => '4',
                'required' => array( 'footer_widgets', '=', true, ),
                'options'  => array(
                    '1'      => array('alt'   => 'column 1', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/1columns.png'),
                    '2'      => array('alt'   => 'column 2', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'),
                    '23'      => array('alt'   => 'column 2-3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/2-3columns.png'),
                    '3'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/3columns.png'),
                    '4'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/4columns.png'),
                    '5'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/5columns.png'),
                    '5'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/5columns.png'),
                ),
            ),
            array(
                'id' => 'optn_footer_Widgets_one',
                'type' => 'select',
                'title' => esc_html__('Inner widget area', 'wooxon'),
                'data'      => 'sidebars',
                'required' => array( 'footer_widgets', '=', true, ),
                'default'  => 'sidebar-3',
            ),
        )
    ));
      //footer inner color configure   
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Inner Top Widget', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(                       
           array(
                'id'      => 'optn_footer_widgets_two',
                'type'    => 'switch',
                'title'   => esc_html__( 'Footer Inner top widgets', 'wooxon' ),                 
                'default' => 1,
            ),
            array(
                'id'       => 'optn_footer_columns_two',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Inner top Columns', 'wooxon' ),              
                'default'  => '4',
                'required' => array( 'optn_footer_widgets_two', '=', true, ),
                'options'  => array(
                    '1'      => array('alt'   => 'column 1', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/1columns.png'),
                    '2'      => array('alt'   => 'column 2', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'),
                    '23'      => array('alt'   => 'column 2-3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/2-3columns.png'),
                    '3'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/3columns.png'),
                    '4'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/4columns.png'),
                    '5'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/5columns.png'),
                    '5'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/5columns.png'),
                ),
            ),
            array(
                'id' => 'optn_footer_Widgets_two',
                'type' => 'select',
                'title' => esc_html__('Inner top widget area', 'wooxon'),
                'data'      => 'sidebars',
                'required' => array( 'optn_footer_widgets_two', '=', true, ),
                'default'  => 'sidebar-5',
            ),
        )
    ));       
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Inner top 2 widget', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(  
            array(
                'id'      => 'optn_footer_widgets_three',
                'type'    => 'switch',
                'title'   => esc_html__( 'EnableFooter Inner top 2 widgets', 'wooxon' ),                 
                'default' => 0,
            ),
            array(
                    'id'      => 'footer_inner_top_width',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Inner top 2 width', 'wooxon' ),                    
                    'options' => array(
                        'container' => 'Container', 
                        'container-fluid' => 'Container Fluid',
                        ), 
                    'default' => 'container-fluid',
                    'required' => array( 'optn_footer_widgets_three', '=', true, ),
            ), 
            array(
                'id'       => 'optn_footer_columns_three',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Inner top 2 Columns', 'wooxon' ),              
                'default'  => '1',
                'required' => array( 'optn_footer_widgets_three', '=', true, ),
                'options'  => array(
                    '1'      => array('alt'   => 'column 1', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/1columns.png'),
                    '2'      => array('alt'   => 'column 2', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'),
                    '23'      => array('alt'   => 'column 2-3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/2-3columns.png'),
                    '3'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/3columns.png'),
                    '4'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/4columns.png'),
                    '5'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/5columns.png'),
                    '5'      => array('alt'   => 'column 3', 'img'   => get_template_directory_uri() . '/assets/images/theme-options/5columns.png'),
                ),
            ),
            array(
                'id' => 'optn_footer_Widgets_three',
                'type' => 'select',
                'title' => esc_html__('Inner top 2 widget area', 'wooxon'),
                'data'      => 'sidebars',
                'required' => array( 'optn_footer_widgets_three', '=', true, ),
                'default'  => 'sidebar-6',
            ),
            array(
                'id'       => 'footer_inner_top_two_bg_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__( 'Inner top 2 background Color', 'wooxon' ),
                'required' => array( 'optn_footer_widgets_three', '=', true, ),
                'output'   => array(
                        'background-color'    => '.f-sidebar.has-bg-color'
                    )
                ),
            array(
                'id'       => 'footer_inner_top_two_title_color',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__( 'Inner top 2 title color', 'wooxon' ),
                'required' => array( 'optn_footer_widgets_three', '=', true, ),
                'output'   => array(
                        'color'    => '.footer .footer-inner-top .widget .widget-title '
                    )
                ),            
        )
    ));
    
    //Blog setup   
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Blog Setting', 'wooxon' ),
        'icon'  => 'el el-pencil-alt',
        'fields'     => array(
            array(
                'id'       => 'optn_blog_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__('Blog sidebar position', 'wooxon'),
                'options'  => array(
                    'fullwidth'      => array(
                        'alt'   => 'Full Width', 
                        'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                    ),
                    'left'      => array(
                        'alt'   => 'Left sidebar', 
                        'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                    ),
                    'right'      => array(
                        'alt'   => 'Right sidebar', 
                        'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                    ),
                    'both'      => array(
                        'alt'   => 'Both sidebar', 
                        'img'  => ReduxFramework::$_url.'assets/img/3cm.png'
                    ),
                ),
                'default' => 'right'                
            ),
            array(
                'id' => 'optn_blog_sidebar',
                'type' => 'select',
                'title' => esc_html__('Widget area', 'wooxon'),
                'data'      => 'sidebars',
                'default' => 'sidebar-1',
                'required' => array( 'optn_blog_sidebar_pos', '=', array('left', 'right', 'both'), ),
            ),
            array(
                'id' => 'optn_blog_sidebar_left',
                'type' => 'select',
                'title' => esc_html__('Widget area two', 'wooxon'),
                'data'      => 'sidebars',                
                'required' => array( 'optn_blog_sidebar_pos', '=', 'both', ),
            ),
            array(
                'id'       => 'optn_blog_sidebar_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sidebar Width', 'wooxon' ),              
                'default'  => 'small',
                'options'  => array(
                        'large' => esc_html__( 'Large(1/4)', 'wooxon' ),
                        'small' => esc_html__( 'Small(1/3)', 'wooxon' ),
                ),
                'required' => array( 'optn_blog_sidebar_pos', '=', array('left', 'right', 'both'), ),
            ),
           
            array(
                'id' => 'optn_archive_display_type',
                'type' => 'button_set',
                'title' => esc_html__('Blog layout Type', 'wooxon'),
                'default'  => 'default',
                'options'  => array(
                        'default' => esc_html__( 'Default', 'wooxon' ),
                        'grid' => esc_html__( 'Grid', 'wooxon' ),
                        'list' => esc_html__( 'List', 'wooxon' ),
                        'masonry' => esc_html__( 'Masonry', 'wooxon' ),
                ),
            ),           
             array(
                'id' => 'optn_archive_display_columns',
                'type' => 'select',
                'title' => esc_html__('Blog Display Columns', 'wooxon'),
                'options' => array(
                        '1'		=> '1',
                        '2'		=> '2',
                        '3'		=> '3',
                        '4'		=> '4',
                ),
                'default' => '2',
                'required' => array( 'optn_archive_display_type', '=', array('grid'), ),
            ),            
            array(
                'id' => 'opt_blog_continue_reading',
                'type' => 'text',
                'title' => esc_html__('Read More Button Text', 'wooxon'),
                'default' => 'Read More',
            ),
            array(
                'id' => 'optn_archive_except_word',
                'type' => 'text',
                'title' => esc_html__('Excerpt Word', 'wooxon'),
                'default' => '55',
            ),            
        )
    ));
     Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Single Page', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(                      
            array(
                'id'       => 'optn_blog_single_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__('Blog single sidebar position', 'wooxon'),
                'options'  => array(
                    'fullwidth'      => array(
                        'alt'   => 'Full Width', 
                        'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                    ),
                    'left'      => array(
                        'alt'   => 'Left sidebar', 
                        'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                    ),
                    'right'      => array(
                        'alt'   => 'Right sidebar', 
                        'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                    ),
                    'both'      => array(
                        'alt'   => 'Both sidebar', 
                        'img'  => ReduxFramework::$_url.'assets/img/3cm.png'
                    ),
                ),
                'default' => 'right'
            ),
            array(
                'id' => 'optn_blog_single_sidebar',
                'type' => 'select',
                'title' => esc_html__('Widget area', 'wooxon'),
                'data'      => 'sidebars',
                'default' => 'sidebar-1',
                'required' => array( 'optn_blog_single_sidebar_pos', '=', array('left', 'right', 'both'), ),
            ),
            array(
                'id' => 'optn_blog_single_sidebar_left',
                'type' => 'select',
                'title' => esc_html__('Widget area two', 'wooxon'),
                'data'      => 'sidebars',
                'required' => array( 'optn_blog_single_sidebar_pos', '=', 'both', ),
            ),
            array(
                'id'       => 'optn_blog_single_sidebar_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sidebar Width', 'wooxon' ),              
                'default'  => 'small',
                'options'  => array(
                        'large' => esc_html__( 'Large(1/4)', 'wooxon' ),
                        'small' => esc_html__( 'Small(1/3)', 'wooxon' ),
                ),
                'required' => array( 'optn_blog_single_sidebar_pos', '=', array('left', 'right', 'both'), ),
            ),           
            array(
                'id' => 'blog_single_social_share',
                'type' => 'switch',
                'title' => esc_html__('Social share links', 'wooxon'),
                'default' => 0,                
            ),
            array(
                'id'       => 'blog_single_social_share_page',
                'type'     => 'select',
                'multi'    => true,
                'title'    => esc_html__('Choose social item', 'wooxon'),
                'required' => array( 'blog_single_social_share', '=', true, ),
                'options'  => array(
                    'facebook'  => 'Facebook',
                    'gplus'     => 'Google Plus',
                    'twitter'   => 'Twitter',
                    'pinterest' => 'Pinterest',
                    'linkedin'  => 'Linkedin',
                    'tumbr'  => 'Tumbr',
                ),
                'sortable' => true,
                'default'  => array( 'facebook', 'gplus', 'twitter', 'pinterest', 'linkedin' ),
            ),
            array(
                'id'       => 'optn_blog_post_metatag_single',
                'type'     => 'select',
                'multi'    => true,
                'title'    => esc_html__('Add Extra Meta option', 'wooxon'),
                'options'  => array(
                    'format' => esc_html__('Post Format', 'wooxon'),
                    'view' => esc_html__('Post view', 'wooxon'),
                    'love' => esc_html__('Post love', 'wooxon'),
                ),                
            ),
            array(
                'id'      => 'optn_blog_single_related_post',
                'type'    => 'switch',
                'title'   => esc_html__( 'Enable related post', 'wooxon' ),
                'default' => 0,
            ),
            array(
                'id'      => 'optn_blog_single_related_target',
                'type'    => 'button_set',
                'title'   => esc_html__( 'Related post target', 'wooxon' ),
                'default' => 'cats',
                'options'  => array(
                        'cats' => esc_html__( 'Categories', 'wooxon' ),
                        'tags' => esc_html__( 'Tags', 'wooxon' ),
                ),
                'required' => array( 'optn_blog_single_related_post', '=', 1),
            ),
            array(
                "type"        => "text",
                "title"     => esc_html__("Related post load", 'wooxon'),
                "id"  => "optn_blog_single_related_post_per",
                "default"       => "3",
                'validate' => 'numeric',
                'required' => array( 'optn_blog_single_related_post', '=', 1),
            ),
            array(
                "type"        => "select",
                "title"     => esc_html__("Related post Column", 'wooxon'),
                "id"  => "optn_blog_single_related_post_col",
                "default"       => "1",
                'options'  => array(
                        '1' => esc_html__( '1 Column', 'wooxon' ),
                        '2' => esc_html__( '2 Column', 'wooxon' ),
                ),
                'required' => array( 'optn_blog_single_related_post', '=', 1),
            ),
        )
    ));
      Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Search Page', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(                      
            array(
                'id'       => 'optn_search_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__('Search page sidebar positon', 'wooxon'),
                'subtitle' => esc_html__( 'Select Page layout No Sidebar, Left, Right and both', 'wooxon' ),
                'options'  => array(
                    'fullwidth'      => array(
                        'alt'   => 'Full Width', 
                        'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                    ),
                    'left'      => array(
                        'alt'   => 'Left sidebar', 
                        'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                    ),
                    'right'      => array(
                        'alt'   => 'Right sidebar', 
                        'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                    ),
                    'both'      => array(
                        'alt'   => 'Both sidebar', 
                        'img'  => ReduxFramework::$_url.'assets/img/3cm.png'
                    ),
                ),
                'default' => 'right'
            ),
            array(
                'id' => 'optn_search_sidebar',
                'type' => 'select',
                'title' => esc_html__('Widget area', 'wooxon'),
                'data'      => 'sidebars',
                'required' => array( 'optn_search_sidebar_pos', '=', array('left', 'right', 'both'), ),
                'default' => 'sidebar-1',
            ),
            array(
                'id' => 'optn_search_sidebar_left',
                'type' => 'select',
                'title' => esc_html__('Widget area two', 'wooxon'),
                'data'      => 'sidebars',
                'required' => array( 'optn_search_sidebar_pos', '=', 'both', ),
            ),
            array(
                'id'       => 'optn_search_sidebar_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sidebar Width', 'wooxon' ),              
                'default'  => 'small',
                'options'  => array(
                        'large' => esc_html__( 'Large(1/4)', 'wooxon' ),
                        'small' => esc_html__( 'Small(1/3)', 'wooxon' ),
                ),
                'required' => array( 'optn_search_sidebar_pos', '=', array('left', 'right', 'both'), ),
            ),
             array(
                'id' => 'optn_search_except_word',
                'type' => 'text',
                'title' => esc_html__('Excerpt Word', 'wooxon'),
                'default' => '300',
            ), 
        )
    ));
    /**
   * Check if WooCommerce is active
    **/
    if ( class_exists( 'WooCommerce' ) ) {
        Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Woocommerce', 'wooxon' ),
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(            
            array(
                'id'      => 'woo_archive_widget_enable',
                'type'    => 'switch',
                'title'   => esc_html__( 'Enable shop page top widget', 'wooxon' ),                 
                'default' => 0,
            ),            
            array(
                'id' => 'woo_archive_widget',
                'type' => 'select',
                'title' => esc_html__('Shop page widget area', 'wooxon'),
                'data'      => 'sidebars',
                'default' => 'sidebar-8',
                'desc'  => esc_html__('NB: widgets: wp-admin->appearance-> widgets->Shop Catalog Sidebar', 'wooxon'),
                'required'  => array('woo_archive_widget_enable', '=', 1)
            ),
            array (
                'title' => esc_html__('Enable catalog mode', 'wooxon'),
                'desc' => esc_html__('When enabled, the product button disable shop page and product shotcode', 'wooxon'),
                'id' => 'catalog_mode',
                'type' => 'switch',
                'default'  => false,
            ),            
            array (
                    'title' => esc_html__('Topbar per page on Grid Allowed Values', 'wooxon'),
                    'desc' => esc_html__('Comma-separated.','wooxon'),
                    'id' => 'products_per_page',
                    'type' => 'text',
                    'default' => '20,25,35'
            ),
            array (
                    'title' => esc_html__('Topbar per page On Grid Default', 'wooxon'),
                    'id' => 'products_per_page_default',
                    'min' => '1',
                    'step' => '1',
                    'max' => '80',
                    'type' => 'slider',
                    'edit' => '1',
                    'default' => '20',
            ),
            array (
                    'title' => esc_html__('Topbar per page on List Allowed Values', 'wooxon'),
                    'desc' => esc_html__('Comma-separated.','wooxon'),
                    'id' => 'products_per_page_list',
                    'type' => 'text',
                    'default' => '20,25,35'
            ),
            array (
                    'title' => esc_html__('Topbar per page on List Default', 'wooxon'),
                    'id' => 'products_per_page_list_default',
                    'min' => '1',
                    'step' => '1',
                    'max' => '80',
                    'type' => 'slider',
                    'edit' => '1',
                    'default' => '20',
            ),
            array(
                'id'      => 'loop_product_countdown',
                'type'    => 'switch',
                'title'   => esc_html__( 'Enable variation countdown', 'wooxon' ),                 
                'subtitle'   => esc_html__( 'Shop page and product Shortcode ', 'wooxon' ),                 
                'default' => 1,
            ),
            array(
                'id'      => 'optn_show_new_product_label',
                'type'    => 'switch',
                'title'   => esc_html__( 'New product label', 'wooxon' ),                 
                'default' => 1,
            ),
            array(
                "type"        => "text",
                "title" => esc_html__('How many days show', 'wooxon'),
                "id"  => "optn_new_product_label",
                "default"       => "30",
                'validate' => 'numeric',
                'required'  => array('optn_show_new_product_label', '=', 1)
            ),
            array(
                "type"        => "text",
                "title" => esc_html__('Label Text', 'wooxon'),
                "id"  => "optn_new_product_label_text",
                "default"       => "New",                
                'required'  => array('optn_show_new_product_label', '=', 1)
            ),
            array(
                "type"        => "text",
                "title" => esc_html__('Out of stock label', 'wooxon'),
                'subtitle'     => esc_html__('if empty dont show label', 'wooxon'),
                "id"  => "optn_product_out_of_stock_label",
                "default"       => "Out of stock",
            ),
            array (
                    'title' => esc_html__('Product Notification', 'wooxon'),
                    'subtitle'     => esc_html__('Vertical right position in %', 'wooxon'),
                    'id' => 'notify_postion',
                    'min' => '10',
                    'step' => '1',
                    'max' => '95',
                    'type' => 'slider',
                    'edit' => '1',
            ),
        )
    ) );
        
        Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Shop Page', 'wooxon' ),
        'subsection' => true,    
        'fields'     => array(
            array(
                    'id'      => 'shop-width-content',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Shop page content width', 'wooxon' ),                    
                    'options' => array(
                        'container' => 'Container', 
                        'container-fluid' => 'Container Fluid',
                        ), 
                    'default' => 'container'  
            ),
            array(
                    'id'       => 'catalog_display_type_global',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Catalog Display Type','wooxon'),
                    'subtitle' => esc_html__( 'Not effective front end', 'wooxon' ),
                    'default' => 'grid',
                    'options'  => array(
                            'grid'      => esc_html__('Grid', 'wooxon'),
                            'list'      => esc_html__('List', 'wooxon'),
                    )                    
            ),
            array(
                'id'        => 'optn_woo_products_per_row',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Product Column', 'wooxon'),
                'options'   => array(
                    '2' => array('alt' => '2 Column ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/2columns.png'),
                    '3' => array('alt' => '3 Column ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/3columns.png'),
                    '4' => array('alt' => '4 Column ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/4columns.png'),
                    '5' => array('alt' => '5 Column ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/5columns.png')
                ),
                'default'   => '4',
                'required' => array( 'catalog_display_type_global', '=', 'grid', ), 
            ),
            array(
                'id'       => 'optn_woo_products_per_row_mobile',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Product Column Mobile', 'wooxon' ),              
                'default'  => '1',
                'options'  => array(
                        '1' => '1',
                        '2' => '2',
                ),
            ),
            array(
                'id'       => 'optn_product_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__('Shop page sidebar position', 'wooxon'),
                'options'  => array(
                    'fullwidth'      => array(
                        'alt'   => 'Full Width', 
                        'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                    ),
                    'left'      => array(
                        'alt'   => 'Left sidebar', 
                        'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                    ),
                    'right'      => array(
                        'alt'   => 'Right sidebar', 
                        'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                    )
                ),
                'default' => 'fullwidth'
            ),
            array(
                'id' => 'optn_product_sidebar',
                'type' => 'select',
                'title' => esc_html__('Widget area', 'wooxon'),
                'data'      => 'sidebars',
                'default' => 'sidebar-4',
                'desc' => esc_html__('NB: if this widget blank nothing show display widget area. follow: wp admin-> appearance -> widget ->add widgets', 'wooxon'),
                'required' => array( 'optn_product_sidebar_pos', '=', array('left', 'right'), ),
            ),
            array(
                'id'       => 'optn_product_sidebar_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sidebar Width', 'wooxon' ),              
                'default'  => 'small',
                'options'  => array(
                        'large' => esc_html__( 'Large(1/4)', 'wooxon' ),
                        'small' => esc_html__( 'Small(1/3)', 'wooxon' ),
                ),
                'required' => array( 'optn_product_sidebar_pos', '=', array('left', 'right', 'both'), ),
            ),
            array(
                'id'        => 'optn_woo_archive_products_layout',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Shop page product layout', 'wooxon'),
                'options'   => array(
                    '1' => array('alt' => 'layout 1',      'img' => get_template_directory_uri() . '/assets/images/theme-options/product1.jpg'),
                    '2' => array('alt' => 'layout 2',      'img' => get_template_directory_uri() . '/assets/images/theme-options/product2.jpg')
                ),
                'default'   => '1',
            ),
            array (
                    'title' => esc_html__('Product title Color', 'wooxon'),
                    'id' => 'product_title_color',
                    'type' => 'color',
                    'transparent' => false,
                    'output'    => array('color' => '.product-title a'),                  
                    
            ),
            array (
                    'title' => esc_html__('Product title hover Color', 'wooxon'),
                    'id' => 'product_title_color_hover',
                    'type' => 'color',
                    'transparent' => false,
                    'output'    => array('color' => '.product-title a:hover'),                  
                    
            ),
            array(
                'id' => 'optn_product_rating',
                'type' => 'switch',
                'title' => esc_html__('Product Cat/Brand and rating', 'wooxon'),
                'default' => 1,                
            ), 
             array(
                'id'       => 'optn_product_image_type',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Rollover image', 'wooxon' ),
                'options'  => array(
                        'none' => esc_html__( 'None', 'wooxon' ),
                        'rollover' => esc_html__( 'Rollover', 'wooxon' )
                ),
               'default'   => 'none',
            ),
            array(
                'id' => 'product_pagination',
                'type' => 'switch',
                'title' => esc_html__('Product Pagination', 'wooxon'),
                'on' => esc_html__( 'Ajax Action', 'wooxon' ),
                'off' => esc_html__( 'Number', 'wooxon' ),   
                'default' => 0,                
            ), 
            array(
                'id'       => 'product_pagination_ajax',
                'type'     => 'switch',
                'title'    => esc_html__( 'Pagination Layout Action', 'wooxon' ),
                'on' => esc_html__( 'Infinite Scroll', 'wooxon' ),
                'off' => esc_html__( 'Load More', 'wooxon' ),                
                'default'   => false,
                'required' => array( 'product_pagination', '=', true ),
            ),
            array(
                'id'            => 'product_list_excerpt',
                'type'          => 'text',
                'title'         => esc_html__('When List view product description excerpt word', 'wooxon'),
                'validate' => 'numeric',
                'default'       => 25,
            ),
                      
        )
    ));
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Product Page', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'optn_product_single_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__('Product page sidebar position', 'wooxon'),
                'options'  => array(
                    'fullwidth'      => array(
                        'alt'   => 'Full Width', 
                        'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                    ),
                    'left'      => array(
                        'alt'   => 'Left sidebar', 
                        'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                    ),
                    'right'      => array(
                        'alt'   => 'Right sidebar', 
                        'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                    )
                ),
                'default' => 'fullwidth'
            ),
            array(
                'id' => 'optn_product_single_sidebar',
                'type' => 'select',
                'title' => esc_html__('Product page widget area', 'wooxon'),
                'data'      => 'sidebars',
                'default' => 'sidebar-4',
                'required' => array( 'optn_product_single_sidebar_pos', '=', array('left', 'right'), ),
            ),
            array(
                'id'       => 'optn_product_single_sidebar_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sidebar Width', 'wooxon' ),              
                'default'  => 'small',
                'options'  => array(
                        'large' => esc_html__( 'Large(1/4)', 'wooxon' ),
                        'small' => esc_html__( 'Small(1/3)', 'wooxon' ),
                ),
                'required' => array( 'optn_product_single_sidebar_pos', '=', array('left', 'right', 'both'), ),
            ),
             array(
                'id'        => 'optn_woo_single_products_thumbnail',
                'type'      => 'image_select',
                'compiler'  => true,
                'title'     => esc_html__('Product Thumbnai', 'wooxon'),
                'options'   => array(
                    'bottom' => array('alt' => 'layout 1',      'img' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb1.png'),
                    'left' => array('alt' => 'layout 2 ',      'img' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb2.png'),
                    'right' => array('alt' => 'layout 3',      'img' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb3.png'),
                    'sticky' => array('alt' => 'layout 4',      'img' => get_template_directory_uri() . '/assets/images/theme-options/single-thumb4.png'),
                ),
                'default'   => 'bottom',
            ),
            array(
                'id'       => 'enable_super_zoom',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Lightbox Image', 'wooxon' ),              
                'default'  => 'piko-lightbox-img',
                'options'  => array(
                        'piko-lightbox-img' => 'on',
                        ' ' => 'off',
                ),
            ),
            array(
                'id' => 'enable_miscellaneous',
                'type' => 'switch',
                'title' => esc_html__('Enable Miscellaneous', 'wooxon'),
                'default' => 0,
                
            ),
            array(
                'id'            => 'size_guide_title',
                'type'          => 'text',
                'title'         => esc_html__('Size Guide Title', 'wooxon'),
                'default'       => esc_html__('Size Guide', 'wooxon'),
                'required' => array('enable_miscellaneous','=',array('1'))
            ), 
            array(
                'id'       => 'size_guide',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Size Guide Image', 'wooxon' ),
                'compiler' => true,
                'default'  => array(
                    'url' => ''
                ),
                'required' => array('enable_miscellaneous','=',array('1'))
            ),
            array(
                'id'            => 'return_policy_title',
                'type'          => 'text',
                'title'         => esc_html__('Shipping & Return Title', 'wooxon'),
                'default'       => esc_html__('Delivery & Return', 'wooxon'),
                'required' => array('enable_miscellaneous','=',array('1'))
            ),
            array(
                    'id'       => 'return_policy',
                    'type'     => 'editor',
                    'title'    => esc_html__('Shipping & Return Content','wooxon'),
                    'args'   => array(
                            'teeny'            => true,
                            'textarea_rows'    => 10
                    ),
                    'default'    => '',
                    'required' => array('enable_miscellaneous','=',array('1'))
            ),
            array(
                'id' => 'enable_product_single_post_share',
                'type' => 'switch',
                'title' => esc_html__('Social share links', 'wooxon'),
                'default' => 0,                
            ),
            array(
                'id'       => 'single_product_share_socials',
                'type'     => 'select',
                'multi'    => true,
                'title'    => esc_html__('Choose socials name', 'wooxon'),
                'required' => array( 'enable_product_single_post_share', '=', true, ),
                'options'  => array(
                    'facebook'  => 'Facebook',
                    'gplus'     => 'Google Plus',
                    'twitter'   => 'Twitter',
                    'pinterest' => 'Pinterest',
                    'linkedin'  => 'Linkedin',
                    'email'  => 'Email',
                ),
                'sortable' => true,
                'default'  => array( 'facebook', 'gplus', 'twitter', 'pinterest', 'linkedin' ),
            ),
            array (
                    'title' => esc_html__('Related Products', 'wooxon'),
                    'id' => 'related_products',
                    'options'   => array(
                         'outside' => esc_html__( 'Outside', 'wooxon' ),
                         'inside' => esc_html__( 'Inside', 'wooxon' ),
                         'none' => esc_html__( 'None', 'wooxon' ),
                    ),
                    'type' => 'button_set',
                    'default' => 'inside',
            ),            
            array (
                    'title' => esc_html__('Upsell Products', 'wooxon'),
                    'id' => 'upsell_products',
                    'type' => 'switch',
                    'default' => 1,
            ),
            array(
                'id'        => 'optn_woo_single_tab_layout',
                'type'    => 'button_set',
                'title'     => esc_html__('Single product tab style', 'wooxon'),
                'options'   => array(
                     'tabs' => esc_html__( 'Tabs', 'wooxon' ),
                     'accordion' => esc_html__( 'Vertical', 'wooxon' ),
                ),
                'default'   => 'tabs',
            ),
            array (
                    'title' => esc_html__('Review Tab', 'wooxon'),
                    'id' => 'review_tab',
                    'type' => 'switch',
                    'default' => 1,
            ),
            array (
                    'title' => esc_html__('Custom Tab', 'wooxon'),
                    'id' => 'custom_tab',
                    'type' => 'switch',
                    'default' => 0,
            ),
            array(
                    'id'       => 'custom_tab_title',
                    'type'     => 'text',
                    'title'    => esc_html__('Custom Tab Title','wooxon'),
                    'default'  => 'Custom Tab',
                    'required' => array('custom_tab','=','1')
            ),
            array(
                    'id'       => 'custom_tab_content',
                    'type'     => 'editor',
                    'title'    => esc_html__('Custom Tab Content','wooxon'),
                    'args'   => array(
                            'teeny'            => true,
                            'textarea_rows'    => 10
                    ),
                    'default' => 'Your custom tab text here dummy text of the printing and typesetting industry.',
                    'required' => array('custom_tab','=','1')
            ),
            array(
                    'id'       => 'custom_tab_accessories',
                    'type'     => 'text',
                    'title'    => esc_html__('Accessories Tab Title','wooxon'),
                    'default'  => 'Accessories'
            )            
        )
    ));    
     Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Product Brand', 'wooxon' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'      => 'show_brand',
                'type'    => 'switch',
                'title'   => esc_html__( 'Enable Product Brand.', 'wooxon' ),                 
                'default' => 0,
            ),            
            array (
                'id' => 'show_brand_name_achive',
                'type' => 'switch',
                'title' => esc_html__( 'Brand name shop page', 'wooxon' ),
                'subtitle'     => esc_html__( 'It\'s replace product category', 'wooxon' ),
                'default' => true,
                'required' => array(
                    array('show_brand','equals', true),
                )
            ),
            array (
                    'id' => 'header_dropdown_menu_options',
                    'icon' => true,
                    'type' => 'info',
                    'raw' => '<h3>Single Product Page</h3>',
            ),
            array (
                'id' => 'show_brand_image',
                'type' => 'switch',
                'title' => esc_html__( 'Brand Image', 'wooxon' ),
                'subtitle'     => esc_html__( 'It\'s show price inside', 'wooxon' ),
                'default' => false,
                'required' => array(
                    array('show_brand','equals', true),
                )
            ),
            array (
                'id' => 'show_brand_image_single',
                'type' => 'switch',
                'title' => esc_html__( 'Enable Brand widget', 'wooxon' ),
                'subtitle'     => esc_html__( 'It\'s show sidebar top area', 'wooxon' ),
                'default' => false,
                'required' => array(
                    array('show_brand','equals', true),
                )
            ),
            array (
                'id' => 'show_brand_title',
                'type' => 'switch',
                'title' => esc_html__( 'Brand Name', 'wooxon' ),
                'default' => false,
                'required' => array(
                    array('show_brand_image_single','equals', true),
                )
            ),
            array (
                'id' => 'show_brand_desc',
                'type' => 'switch',
                'title' => esc_html__( 'Brand description', 'wooxon' ),
                'default' => false,
                'required' => array(
                    array('show_brand_image_single','equals', true),
                )
            ),
        )
    ));
      Redux::setSection( $opt_name, array(
        'title' => esc_html__('Product Compare', 'wooxon'),
        'subsection' => true,
        'fields'  => array(                
                array(
                        'id'        => 'compare_page_id',
			'title'     => esc_html__( 'Product Comparison Page', 'wooxon' ),
			'subtitle'  => esc_html__( 'Choose a page that will be the product compare.', 'wooxon' ),
			'type'      => 'select',
			'data'      => 'pages',
                        'default'   => 'compare',
                    ),                          
            )
        ));
      Redux::setSection( $opt_name, array(
        'title' => esc_html__('Category Header', 'wooxon'),
        'subsection' => true,
        'fields'  => array(                
                array(
                    'id' => 'wc_cat_header',
                    'type'    => 'button_set',
                    'title'     => esc_html__('Category Header position', 'wooxon'),
                    'options'   => array(
                         'default' => esc_html__( 'Default', 'wooxon' ),
                         'full' => esc_html__( 'Full width', 'wooxon' ),
                    ),
                    'default'   => 'default'
                ),
                array(
                    'id'             => 'wc_cat_header_padding',
                    'type'           => 'spacing',
                    'mode'           => 'padding',
                    'units'          => 'px',
                    'units_extended' => 'false',
                    'title'          => esc_html__('Content spacing', 'wooxon'),
                    'left'          => false,
                    'right'          => false,
                    'output'        => array('.header-wrapper + .pikowc_header_image'),                    
                    'required' => array( 'wc_cat_header', '=', 'full' ),
                ),
            )
     ));
      
      if( class_exists( 'WeDevs_Dokan' ) ){
          Redux::setSection( $opt_name, array(
            'title' => esc_html__('Multi vendor', 'wooxon'),
            'subsection' => true,
            'fields'  => array(                
                    array(
                        'id' => 'vendor_profile_cover',
                        'type'    => 'button_set',
                        'title'     => esc_html__('Vendor Profile', 'wooxon'),
                        'options'   => array(
                             'default' => esc_html__( 'Default', 'wooxon' ),
                             'full' => esc_html__( 'Full width', 'wooxon' ),
                        ),
                        'default'   => 'full'
                    ),
                    array(
                        'id' => 'vendor_seller_name',
                        'type'    => 'button_set',
                        'title'     => esc_html__('Vendor Name', 'wooxon'),
                        'options'   => array(
                             'shop' => esc_html__( 'Only Shop page', 'wooxon' ),
                             'all' => esc_html__( 'All page', 'wooxon' ),
                             'none' => esc_html__( 'None', 'wooxon' ),
                        ),
                        'default'   => 'shop'
                    )
                    
                )
         ));
      }      
    
    
}  //end of woocommece
//popup Settings    
    Redux::setSection( $opt_name, array(
		'title'            => esc_html__( 'Popup Settings', 'wooxon' ),
		'id'               => 'popup_settings',
		'customizer_width' => '400px',
		'icon'             => 'el el-website-alt',
		'fields'           => array(
			array(
				'id'       => 'popup_enable',
				'type'     => 'switch', 
				'title'    => esc_html__('Enable Popup Newsletter', 'wooxon'),
                                'default'  => false,
			),                         
                        array(
                                'id'      => 'popup_page_enable',
                                'type'    => 'button_set',
                                'title'   => esc_html__( 'Popup show', 'wooxon' ),                    
                                'options' => array(
                                    'front' => esc_html__('Front Page', 'wooxon'),
                                    'all' => esc_html__('All Pages', 'wooxon'),
                                    ), 
                                'default' => 'all',
                                'required' => array( 'popup_enable', '=', true ),
                        ),
                        array(
				'id'       => 'popup_time',
				'type'     => 'text',
				'title'    => esc_html__('Popup set Interval time', 'wooxon'),
                                'subtitle' => '1000 value mean 1sec. 300000 value mean 5min ',
                                'required' => array( 'popup_enable', '=', true ),
				'default'  => '300000',
                                'validate' => 'numeric',                                
			),
			array(
				'id'       => 'popup_title',
				'type'     => 'text',
				'title'    => esc_html__('Title', 'wooxon'),
				'default'  => 'Sign Up Newsletter',
                                'required' => array( 'popup_enable', '=', true ),
			),
                        array(
                                'id'             => 'page-popup_title_font_size',
                                'type'           => 'typography',
                                'title'          => esc_html__( 'Title font size', 'wooxon' ),
                                'compiler'       => true,
                                'google'         => true,
                                'font-backup'    => false,
                                'all_styles'     => true,
                                'font-weight'    => true,
                                'font-family'    => true,
                                'text-align'     => true,
                                'font-style'     => false,
                                'subsets'        => false,
                                'font-size'      => true,
                                'line-height'    => false,
                                'word-spacing'   => false,
                                'letter-spacing' => false,
                                'color'          => true,
                                'preview'        => true,
                                'output'         => array( '.popup-news header h2' ),
                                'units'          => 'px',
                                'default'        => array(
                                        'color' => '#fff',
                                ),
                                'required' => array( 'popup_enable', '=', true ),
                        ),
                        array(
				'id' => 'popup_title_bg_img',
                                'type' => 'background',
                                'url' => true,
                                'title' => esc_html__('Title Background Image', 'wooxon'),
                                'compiler' => 'true',
                                'preview' => 'true',
                                'preview_media' => 'true',
                                'background-size' => 'false',
                                'background-attachment' => 'false',                                
                                'output'   => array('background-image'    => '.popup-news header'),
                                'required' => array( 'popup_enable', '=', true ),
			),
                        array(
				'id'       => 'popup_title_bg_height',
				'type'     => 'text',
				'title'    => esc_html__('Background image height', 'wooxon'),
                                'required' => array( 'popup_enable', '=', true ),
				'default'  => '150',
                                'validate' => 'numeric',
                                'subtitle' => esc_html__('This must be numeric value.', 'wooxon'),
			),                        
			array(
				'id'       => 'popup_content',
				'type'     => 'editor',
				'title'    => esc_html__('Main content', 'wooxon'),
				'subtitle' => esc_html__('Added form shortcode description after', 'wooxon'),
                                'required' => array( 'popup_enable', '=', true ),
                                'desc'     => 'Mailchimp Shortcode like as: [mc4wp_form id="236"] if collect email address use contact form7 shortcode: [contact-form-7 id="4439" title="Subscribe Form"]',
				'default'  => '<h3>Sign up our newsletter and save 25% off for the next purchase!</h3> Subscribe to the <strong>Our store</strong> mailing list to receive updates on new arrivals, offers and other discount information.'
			),                        
			array(
				'id'       => 'popup_nomore_text',
				'type'     => 'text',
				'title'    => esc_html__('Don\'t show checkbox text', 'wooxon'),
                                'required' => array( 'popup_enable', '=', true ),
				'default'  => 'Don\'t show it again'
			)		
			
		)
	) );
    //typography    
    Redux::setSection( $opt_name, array(
        'title'   => esc_html__( 'Typography', 'wooxon' ),
        'icon'    => 'el-icon-font',
        'submenu' => true,
        'fields'  => array(
            array(
                    'id'             => 'body_fontfamily',
                    'type'           => 'typography',
                    'title'          => esc_html__( 'Body Font', 'wooxon' ),
                    'compiler'       => true,
                    'google'         => true,
                    'font-backup'    => false,
                    'font-weight'    => false,
                    'all_styles'     => true,
                    'font-style'     => true,
                    'text-align'     => false,
                    'subsets'        => true,
                    'font-size'      => true,
                    'line-height'    => false,
                    'word-spacing'   => false,
                    'letter-spacing' => false,
                    'color'          => true,
                    'preview'        => true,
                    'output'         => array( 'body' ),
                    'units'          => 'px',                    
                    'default'        => array(
                            'color'       => "#888888",
                            'font-weight'       => "400",
                    )
            ),          
            array(
                    'id'             => 'font_heading',
                    'type'           => 'typography',
                    'title'          => esc_html__( 'Heading', 'wooxon' ),
                    'compiler'       => true,
                    'google'         => true,
                    'font-backup'    => false,
                    'font-family'    => true,
                    'all_styles'     => true,
                    'font-weight'    => true,
                    'font-style'     => true,
                    'subsets'        => true,
                    'text-align'     => false,
                    'font-size'      => false,
                    'line-height'    => false,
                    'word-spacing'   => false,
                    'letter-spacing' => true,
                    'color'          => true,
                    'preview'        => true,
                    'units'          => 'px',
                    'output'         => array( 'h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6' ),
                    
            ),
            array(
                    'id'             => 'h1_params',
                    'type'           => 'typography',
                    'title'          => 'H1',
                    'subtitle'       => 'Default 36px',
                    'compiler'       => false,
                    'google'         => false,
                    'font-backup'    => false,
                    'all_styles'     => false,
                    'font-weight'    => false,
                    'font-family'    => false,
                    'text-align'     => false,
                    'font-style'     => false,
                    'subsets'        => false,
                    'font-size'      => true,
                    'line-height'    => false,
                    'word-spacing'   => false,
                    'letter-spacing' => false,
                    'color'          => false,
                    'preview'        => false,
                    'output'         => array( 'h1,.h1' ),
                    'units'          => 'px',
            ),
            array(
                    'id'             => 'h2_params',
                    'type'           => 'typography',
                    'title'          => 'H2',
                    'subtitle'       => 'Default 32px',
                    'compiler'       => false,
                    'google'         => false,
                    'font-backup'    => false,
                    'all_styles'     => false,
                    'font-weight'    => false,
                    'font-family'    => false,
                    'text-align'     => false,
                    'font-style'     => false,
                    'subsets'        => false,
                    'font-size'      => true,
                    'line-height'    => false,
                    'word-spacing'   => false,
                    'letter-spacing' => false,
                    'color'          => false,
                    'preview'        => true,
                    'output'         => array( 'h2,.h2' ),
                    'units'          => 'px',                    
            ),
            array(
                    'id'             => 'h3_params',
                    'type'           => 'typography',
                    'title'          => 'H3',
                    'subtitle'       => 'Default 27px',
                    'compiler'       => false,
                    'google'         => false,
                    'font-backup'    => false,
                    'all_styles'     => false,
                    'font-weight'    => false,
                    'font-family'    => false,
                    'text-align'     => false,
                    'font-style'     => false,
                    'subsets'        => false,
                    'font-size'      => true,
                    'line-height'    => false,
                    'word-spacing'   => false,
                    'letter-spacing' => false,
                    'color'          => false,
                    'preview'        => true,                    
                    'output'         => array( 'h3,.h3' ),
                    'units'          => 'px'
            ),
            array(
                    'id'             => 'h4_params',
                    'type'           => 'typography',
                    'title'          => 'H4',
                    'subtitle'       => 'Default 22px',
                    'compiler'       => false,
                    'google'         => false,
                    'font-backup'    => false,
                    'all_styles'     => false,
                    'font-weight'    => false,
                    'font-family'    => false,
                    'text-align'     => false,
                    'font-style'     => false,
                    'subsets'        => false,
                    'font-size'      => true,
                    'line-height'    => false,
                    'word-spacing'   => false,
                    'letter-spacing' => false,
                    'color'          => false,
                    'preview'        => false,
                    'output'         => array( 'h4,.h4' ),
                    'units'          => 'px',                    
            ),
            array(
                    'id'             => 'h5_params',
                    'type'           => 'typography',
                    'title'          => 'H5',
                    'subtitle'       => 'Default 18px',
                    'compiler'       => false,
                    'google'         => false,
                    'font-backup'    => false,
                    'all_styles'     => false,
                    'font-weight'    => false,
                    'font-family'    => false,
                    'text-align'     => false,
                    'font-style'     => false,
                    'subsets'        => false,
                    'font-size'      => true,
                    'line-height'    => false,
                    'word-spacing'   => false,
                    'letter-spacing' => false,
                    'color'          => false,
                    'preview'        => false,
                    'output'         => array( 'h5,.h5' ),
                    'units'          => 'px',                    
            ),
            array(
                    'id'             => 'h6_params',
                    'type'           => 'typography',
                    'title'          => 'H6',
                    'subtitle'       => 'Default 16px',
                    'compiler'       => false,
                    'google'         => false,
                    'font-backup'    => false,
                    'all_styles'     => false,
                    'font-weight'    => false,
                    'font-family'    => false,
                    'text-align'     => false,
                    'font-style'     => false,
                    'subsets'        => false,
                    'font-size'      => true,
                    'line-height'    => false,
                    'word-spacing'   => false,
                    'letter-spacing' => false,
                    'color'          => false,
                    'preview'        => false,
                    'output'         => array( 'h6,.h6' ),
                    'units'          => 'px'                    
            ),
        )
) );
   //color skin    
    Redux::setSection( $opt_name, array(
        'title'   => esc_html__( 'Color Skin', 'wooxon' ),
        'icon'    => 'el el-brush',
        'fields'  => array(
                array(
                    'id'      => 'color_skin',
                    'type'    => 'button_set',
                    'title'   => esc_html__( 'Color Skin', 'wooxon' ),
                    'default' => 'default',
                    'options' => array(
                            'default'            => esc_html__( 'Default', 'wooxon' ),                          
                            'red'            => esc_html__( 'Red', 'wooxon' ),                          
                            'skin_custom' => esc_html__( 'Custom color', 'wooxon' )
                    ),                   
                ),
                array(
                'id'       => 'main_color_scheme',
                'type'     => 'color',
                'compiler' => true,
                'title'    => esc_html__( 'Main Color Scheme', 'wooxon' ),
                'default'  => '',
                'required' => array( 'color_skin', '=', 'skin_custom' ),
                ),           
            )
        ));        
    //    social media    
    Redux::setSection( $opt_name, array(
    'title'   => esc_html__( 'Social Media link', 'wooxon' ),
    'icon'    => 'el el-network',
    'desc'    => esc_html__( 'Enter social media Page urls here as you want. then enable them for header. Please put the full URLs like this "https://facebook.com/yourpage".', 'wooxon' ),
    'submenu' => true,
    'fields'  => array(
            array(
                    'id'       => 'facebook',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Facebook', 'wooxon' ),
                    'default' => 'https://www.facebook.com/',
                    'desc'     => esc_html__( 'Enter your Facebook URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'twitter',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Twitter', 'wooxon' ),
                    'default' => 'https://www.twitter.com/',
                    'desc'     => esc_html__( 'Enter your Twitter URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'flickr',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Flickr', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Flickr URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'instagram',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Instagram', 'wooxon' ),
                    'default' => 'https://www.instagram.com/',
                    'desc'     => esc_html__( 'Enter your Instagram URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'behance',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Behance', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Behance URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'dribbble',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Dribbble', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Dribbble URL.', 'wooxon' ),
                    'validate' => 'url'
            ),            
            array(
                    'id'       => 'git',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Git', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Git URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'linkedin',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Linkedin', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Linkedin URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'pinterest',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Pinterest', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Pinterest URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'yahoo',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Yahoo', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Yahoo URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'delicious',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Delicious', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Delicious URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'dropbox',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Dropbox', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Dropbox URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'reddit',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Reddit', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Reddit URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'soundcloud',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Soundcloud', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Soundcloud URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'google',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Google', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Google URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'googleplus',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Google+', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Google Plus URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'skype',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Skype', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Skype URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'youtube',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Youtube', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Youtube URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'vimeo',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Vimeo', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your vimeo URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'tumblr',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Tumblr', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Tumblr URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'whatsapp',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Whatsapp', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Whatsapp URL.', 'wooxon' ),
                    'validate' => 'url'
            ),
            array(
                    'id'       => 'whatsapp',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Whatsapp', 'wooxon' ),
                    'desc'     => esc_html__( 'Enter your Whatsapp URL.', 'wooxon' ),
                    'validate' => 'url'
            ),            
        )
    ) );
    

//    custom css
    Redux::setSection( $opt_name, array(
        'title'   => esc_html__( 'Custom Code', 'wooxon' ),
        'icon'    => 'el el-icon-css',        
        'fields'  => array(
                array(
                    'id'       => 'custom_css',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'CSS Code', 'wooxon' ),
                    'subtitle' => esc_html__( 'Wirte or Paste your custom CSS code here.', 'wooxon' ),
                    'mode'     => 'css',
                    'default'  => ''
                ),
                array(
                    'id'       => 'custom_js',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Javascript custom code', 'wooxon' ),
                    'mode'     => 'javascript',
                )
        )
    ));
    // import export    
    Redux::setSection( $opt_name, array(
        'title'   => esc_html__( 'theme Options', 'wooxon' ),
        'icon'    => 'el el-refresh',
        'fields'    => array(
            array(
                'id'            => 'piko-import-export',
                'type'          => 'import_export',
                'full_width'    => true,
            ),
        ),
    ));
    
  
    /*
     * <--- END SECTIONS
     */
    
    function compiler_action($options) {
            
    }
    function wooxon_redux_update_options_user_can_register( $options ) {
            global $wooxon;
            $users_can_register = isset( $wooxon['opt-users-can-register'] ) ? $wooxon['opt-users-can-register'] : 0;
            update_option( 'users_can_register', $users_can_register );
    }
    function wooxon_redux_update_options_post_type_portfolio( $options ) {
            global $wooxon;
            $post_type_portfolio = isset( $wooxon['optn_enable_portfolio'] ) ? $wooxon['optn_enable_portfolio'] : 0;
            update_option( 'optn_enable_portfolio', $post_type_portfolio );
    }
    
    
    if ( ! function_exists( 'wooxon' ) ) {
	function wooxon( $id, $fallback = false, $key = false ) {
		global $wooxon;
		if ( $fallback == false ) {
			$fallback = '';
		}
		$output = ( isset( $wooxon[ $id ] ) && $wooxon[ $id ] !== '' ) ? $wooxon[ $id ] : $fallback;
		if ( ! empty( $wooxon[ $id ] ) && $key ) {
			$output = $wooxon[ $id ][ $key ];
		}

		return $output;
	}
    }