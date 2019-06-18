<?php
/**
 * post type vc shortcode
 */
if (!class_exists('piko_custom_post_shortcodes')) {
    class piko_custom_post_shortcodes  {

        private static $instance;

        public static function init()
        {
            if (!isset(self::$instance)) {
                self::$instance = new piko_custom_post_shortcodes;
                add_action('init', array(self::$instance, 'includes'), 0);
                add_action('init', array(self::$instance, 'register_vc_map'), 10);
            }
            return self::$instance;
        }

        public function includes()
        {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
            
            require_once PIKOWORKS_CUSTOM_POST_CORE . '/post-type/custom-fields.php';
          
            include_once(PIKOWORKS_CUSTOM_POST_CORE . 'post-type/testimonial/testimonial.php');
            
            if (!is_plugin_active('js_composer/js_composer.php')) {
                return;
            }
            
        }

        public static function  substr($str, $txt_len, $end_txt = '...')
        {
            if (empty($str)) return '';
            if (strlen($str) <= $txt_len) return $str;

            $i = $txt_len;
            while ($str[$i] != ' ') {
                $i--;
                if ($i == -1) break;
            }
            while ($str[$i] == ' ') {
                $i--;
                if ($i == -1) break;
            }

            return substr($str, 0, $i + 1) . $end_txt;
        }


        public function register_vc_map()
        {

            if (function_exists('vc_map')) {

                    $testimonial_cat = array();
                    $testimonial_categories = get_terms('testimonial_category', array('hide_empty' => 0, 'orderby' => 'ASC'));
                    if (is_array($testimonial_categories)) {
                        foreach ($testimonial_categories as $cat) {
                            $testimonial_cat[$cat->name] = $cat->slug;
                        }
                    }
                    $params1 = array(
                        'name' => esc_html__('Testimonial', 'pikoworks_custom_post'),
                        'description' => esc_html__('Display Differnt style', 'pikoworks_custom_post'),
                        'base' => 'piko_testimonial',
                        'icon' => PIKOWORKS_CUSTOM_POST_ASSETS . 'images/vc-icon.png',
                        'category' => 'Pikoworks',
                        'params'      => array_merge(array(
                            array(
                                'type' => 'dropdown',
                                'param_name' => 'target_team',
                                'value' => array(
                                    esc_html__('All Team Member', 'pikoworks_custom_post') => 'target_team',
                                    esc_html__('Multi Category Team', 'pikoworks_custom_post') => 'cat_team',
                                ),                
                                'heading' => esc_html__('Target Team Member', 'pikoworks_custom_post'),                               
                                'admin_label' => true,
                            ),                           
                            array(
                                 'type' => 'pikoworks_taxonomy',
                                'heading' => esc_html__('Category', 'pikoworks_custom_post'),
                                'param_name' => 'category',
                                'multiple'    => true,
                                'taxonomy' => 'testimonial_category',
                                'dependency' => array('element'   => 'target_team', 'value'     => array( 'cat_team' )),
                            ), 
                            array(
                                'type'          => 'dropdown',
                                'heading'       => esc_html__( 'select style', 'pikoworks_custom_post' ),
                                'param_name'    => 'type',
                                'value' => array(
                                    esc_html__('style 1', 'pikoworks_custom_post') => '1',
                                    esc_html__('style 2', 'pikoworks_custom_post') => '2',
                                    esc_html__('style 3', 'pikoworks_custom_post') => '3',
                                ),
                                'std'           => '1',
                                'admin_label' => true,  
                            ),                            
                            array(                
                                'type' => 'checkbox',                
                                "heading" => '',
                                'param_name' => 'open_icon',
                                'value' => array(esc_html__('Image replace with icon', 'pikoworks_custom_post') => 'yes'),
                                'dependency' => array('element'   => 'type', 'value'     => array( '1','3' )),
                            ),
                            array(                
                                'type' => 'checkbox',                
                                "heading" => '',
                                'param_name' => 'text_color',
                                'value' => array(esc_html__('All text color white', 'pikoworks_custom_post') => 'tl-white'),
                            ),
                            array(
                                "type"        => "pikoworks_number",
                                "heading"     => esc_html__("Number testimonial load", 'pikoworks_custom_post'),
                                "param_name"  => "number",
                                "value"       => 7,
                                "description" => esc_html__('Enter number of estimonial if you use "-1" load all product load. or Enter specific as you want like as 7, 8,10...', 'pikoworks_custom_post')
                            ),    
                            array(
                                "type"       => "dropdown",
                                "heading"    => esc_html__("Order by", 'pikoworks_custom_post'),
                                "param_name" => "orderby",
                                "value"      => array(
                                    esc_html__('None', 'pikoworks_custom_post')     => 'none',
                                    esc_html__('ID', 'pikoworks_custom_post')       => 'ID',
                                    esc_html__('Author', 'pikoworks_custom_post')   => 'author',
                                    esc_html__('Name', 'pikoworks_custom_post')     => 'name',
                                    esc_html__('Date', 'pikoworks_custom_post')     => 'date',
                                    esc_html__('Modified', 'pikoworks_custom_post') => 'modified',
                                    esc_html__('Rand', 'pikoworks_custom_post')     => 'rand',
                                    ),
                                'std'         => 'date',
                                "description" => esc_html__("Select how to sort retrieved posts.",'pikoworks_custom_post')
                            ),
                            array(
                                "type"       => "dropdown",
                                "heading"    => esc_html__("Order", 'pikoworks_custom_post'),
                                "param_name" => "order",
                                "value"      => array(
                                    esc_html__( 'Descending', 'pikoworks_custom_post' ) => 'DESC',
                                    esc_html__( 'Ascending', 'pikoworks_custom_post' )  => 'ASC'
                                    ),
                                'std'         => 'DESC',
                                "description" => esc_html__("Designates the ascending or descending order.",'pikoworks_custom_post')
                            ),
                             array(
                                    'type' => 'textfield',
                                    'param_name' => 'excerpt',
                                    'heading' => esc_html__('Excerpt word', 'pikoworks_custom_post'),
                                    'description' => esc_html__('Default use Excerpt 55 words ', 'pikoworks_custom_post'),
                                    'value' => '55'
                             ),
                            array(
                                "type"        => "textfield",
                                "heading"     => esc_html__( "Extra class name", 'pikoworks_custom_post' ),
                                "param_name"  => "el_class",
                                "description" => esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pikoworks-core" ),
                            ),
                             array(
                                'type'           => 'css_editor',
                                'heading'        => esc_html__( 'Css', 'pikoworks_custom_post' ),
                                'param_name'     => 'css',
                                'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'pikoworks_custom_post' ),
                                'group'          => esc_html__( 'Design options', 'pikoworks_custom_post' )
                            ),
                                ),pikoworks_get_slider_params_enable())
                    );
                    vc_map($params1);                   
                //testimonial
            }
        }
    }

    if (!function_exists('piko_init_custom_post_shortcodes')) {
        function piko_init_custom_post_shortcodes()
        {
            return piko_custom_post_shortcodes::init();
        }

        piko_init_custom_post_shortcodes();
    }
}