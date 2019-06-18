<?php
/**
 * Custom heading for visual composer.
 */

function wooxon_vc_add_params_to_custom_heading() {
	vc_add_params(
		'vc_custom_heading',
		array(
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Shortcode Type', 'wooxon' ),
                        'param_name'    => 'type',
                        'value' => array(
                            esc_html__('Custom Heading', 'wooxon') => 'custom_heading',
                            esc_html__('Advance Banner', 'wooxon') => 'custom_banner',
                        ),
                        'std'           => 'custom_heading',
                        'description' => esc_html__('Two type shortcode custom Heading & Advance Banner ', 'wooxon'),
                        'admin_label' => true,
                        'weight'      => 1,
                    ),
                    array(
                        'heading'     => esc_html__( 'Enable divider?', 'wooxon' ),
                        'description' => esc_html__( 'Divider to left and right and divider after to bottom add a thin line of heading.', 'wooxon' ),
                        'type'        => 'dropdown',
                        'param_name'  => 'divider',
                        'weight'      => 1,
                        'value' => array(
                            esc_html__('None', 'wooxon') => '',
                            esc_html__('Divider', 'wooxon') => 'hline',
                            esc_html__('Divider Inside', 'wooxon') => 'hline_inside',
                            esc_html__('Divider after', 'wooxon') => 'hline_after',
                            esc_html__('After full', 'wooxon') => 'hline_full',
                        ),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_heading' )), 
                    ),
                    array(
                        'heading'     => esc_html__( 'Border size', 'wooxon' ),
                        'type'        => 'dropdown',
                        'param_name'  => 'divider_height',
                        'weight'      => 1,
                        'value' => array(
                            esc_html__('1px', 'wooxon') => 'onepx',
                            esc_html__('2px', 'wooxon') => 'twopx',
                            esc_html__('4px', 'wooxon') => 'fourpx',
                            esc_html__('6px', 'wooxon') => 'sixpx',
                        ),
                        'std'           => 'twopx',
                        'dependency' => array('element'   => 'divider','value'     => array( 'hline_inside' )), 
                    ),
                    array(
                        'type' => 'attach_image',
                        'param_name' => 'image',
                        'heading' => esc_html__('Banner Image', 'wooxon'),
                        'weight'      => 1,
                        'description' => esc_html__('The Image size as you want if use grid column use same size', 'wooxon'),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )), 
                        
                    ),  
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Banner Ttile Position', 'wooxon' ),
                        'param_name'    => 'title_position',
                        'admin_label' => true, 
                        'weight'      => 1,
                        'value' => array(
                            esc_html__('Center Center', 'wooxon') => 'center',
                            esc_html__('Center Top', 'wooxon') => 'center-top',
                            esc_html__('Center Bottom', 'wooxon') => 'center-bottom',
                            esc_html__('Right Center', 'wooxon') => 'right-center',
                            esc_html__('Right Top', 'wooxon') => 'right-top',                        
                            esc_html__('Right Bottom', 'wooxon') => 'right-bottom',
                            esc_html__('Left Center', 'wooxon') => 'left-center',
                            esc_html__('Left top', 'wooxon') => 'left-top',
                            esc_html__('Left bottom', 'wooxon') => 'left-bottom',
                        ),
                        'group'          => esc_html__( 'Advance Banner', 'wooxon' ),
                        'std'           => 'center',
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )), 
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Banner Hover Effect', 'wooxon' ),
                        'param_name'    => 'hover_effect',
                        'admin_label' => true, 
                        'weight'      => 1,
                        'value' => array(
                            esc_html__('None', 'wooxon') => '',
                            esc_html__('Zoom image', 'wooxon') => 'h_e1',
                        ),
                        'group'          => esc_html__( 'Advance Banner', 'wooxon' ),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )), 
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Main Title Font size', 'wooxon' ),
                        'param_name'    => 'title_font_size',
                        'admin_label' => true, 
                        'weight'      => 1,
                        'value' => array(
                            'default' => '',
                            'Size: 60px' => 'fs60',
                            'Size: 45px' => 'fs45',
                            'Size: 38px' => 'fs38',
                            'Size: 30px' => 'fs30',
                            'Size: 25px' => 'fs25',
                            'Size: 20px' => 'fs20',
                        ),
                        'description' => esc_html__( 'NB: Dont set general -> Font size. Set fixed font size here font Responsive issue ', 'wooxon' ),                         
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Sub Title Font size', 'wooxon' ),
                        'param_name'    => 'sub_title_font_size',
                        'admin_label' => true, 
                        'weight'      => 1,
                        'value' => array(
                            'Size: 14px' => 'f_s14',
                            'Size: 16px' => 'f_s16',
                            'Size: 20px' => 'fs20',
                            'Size: 25px' => 'fs25',
                            'Size: 30px' => 'fs30',
                            'Size: 38px' => 'fs38',
                            'Size: 48px' => 'fs48',
                            'Size: 60px' => 'fs60',
                        ),
                        'group'          => esc_html__( 'Advance Banner', 'wooxon' ),
                        'std'           => 'f_s14',
                        'description' => esc_html__( 'NB: Responsive issue ', 'wooxon' ),
                        'dependency' => array('element'   => 'type','value' => array( 'custom_banner' )), 
                    ),
                    array(
                        'heading'     => esc_html__( 'Sub Title below Main title', 'wooxon' ),
                        'type'        => 'checkbox',
                        'param_name'  => 'below_title',
                        'weight'      => 1,
                        'value'       => array(
                                esc_html__( 'Yes', 'wooxon' ) => 'yes'
                        ),
                        'group'          => esc_html__( 'Advance Banner', 'wooxon' ),
                        'dependency' => array('element'   => 'type','value' => array( 'custom_banner' )), 
                    ),
                    array(
                            'param_name'  => 'sub_title',
                            'heading'     => esc_html__( 'Sub Title', 'wooxon' ),
                            'description' => esc_html__( 'It shows after the heading', 'wooxon' ),
                            'type'        => 'textarea',
                            'weight'      => 1,
                    ),
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Sub Title Font Family', 'wooxon' ),
                        'param_name'    => 'sub_title_font',
                        'weight'      => 1,
                        'value' => array(
                            'Theme Default' => '',
                            'PlayFair Display' => 'font_2',
                        ),                       
                        'std'           => 'font_2',
                    ),
                    array(
                        'heading'     => esc_html__( 'Secondary Button link', 'wooxon' ),
                        'description' => esc_html__( 'It shows right side heading', 'wooxon' ),
                        'type'        => 'dropdown',
                        'param_name'  => 'secondary_btn',
                        'weight'      => 1,
                        'value' => array(
                            'None' => '',
                            'Right' => '1',
                            'Right with slide arrow' => '2',
                        ),                     
                        'dependency' => array('element'   => 'type','value' => array( 'custom_heading' )), 
                    ), 
                    array(
                        'heading'     => esc_html__( 'Sub title shows after Main title', 'wooxon' ),
                        'type'        => 'checkbox',
                        'param_name'  => 'sub_title_before',
                        'weight'      => 1,
                        'value'       => array(
                                esc_html__( 'Yes', 'wooxon' ) => 'yes'
                        ),
                        'group'          => esc_html__( 'Advance Banner', 'wooxon' ),
                        'dependency' => array('element'   => 'type','value' => array( 'custom_banner' )), 
                    ),                    
                    array(
                        'heading'       => esc_html__( 'Sub Title font color', 'wooxon' ),
                        'type'          => 'colorpicker',                    
                        'param_name'    => 'sub_font_color',
                        'weight'      => 1,
                        'group'          => esc_html__( 'Advance Banner', 'wooxon' ),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )),
                    ),
                    array(
                        'param_name'  => 'sub_font_weight',
                        'heading'     => esc_html__( 'Sub Title font Weight', 'wooxon' ),
                        'type'        => 'pikoworks_number',
                        'weight'      => 1,
                        'description' => esc_html__( 'like as: 600, 900 etc', 'wooxon' ),
                        'group'          => esc_html__( 'Advance Banner', 'wooxon' ),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )),
                    ),
                    array(
                        'heading'       => esc_html__( 'Sub Title font style normal', 'wooxon' ),
                        'type'        => 'checkbox',
                        'param_name'  => 'sub_font_italic',
                        'weight'      => 1,
                        'value'       => array(
                                esc_html__( 'Yes', 'wooxon' ) => 'italic'
                        ),
                        'weight'      => 1,
                        'group'          => esc_html__( 'Advance Banner', 'wooxon' ),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )),
                    ),
                    
                    array(
                        'heading'     => esc_html__( 'Link Button Disable', 'wooxon' ),
                        'type'        => 'checkbox',
                        'param_name'  => 'banner_btn',
                        'weight'      => 1,
                        'value'       => array(
                                esc_html__( 'Yes', 'wooxon' ) => 'yes'
                        ),
                        'group'          => esc_html__( 'Advance Banner', 'wooxon' ),
                        'dependency' => array('element'   => 'type','value'     => array( 'custom_banner' )), 
                    ),
		)
	);
}
add_action( 'vc_after_init', 'wooxon_vc_add_params_to_custom_heading' );