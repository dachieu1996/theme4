<?php
// Exit if accessed directly
//pikoworks Product brand
if( !defined( 'ABSPATH' ) ) {
	exit;
}
if( function_exists( 'WC' )){
     return;
}
if (!defined('PIKOWORKS_PRODUCT_BRANDS_TAXONOMY')){
    define('PIKOWORKS_PRODUCT_BRANDS_TAXONOMY', 'brands');
}

if (!class_exists('Pikoworks_WC_Brands')) {
    class Pikoworks_WC_Brands
    {
        function __construct()
        {
            add_action('init', array($this, 'register_taxonomies'), 5);        
            if (is_admin()) {
                add_action('admin_menu', array($this, 'addMenuChangeSlug'));
            }
        }

        function register_taxonomies()
        {
            if (taxonomy_exists(PIKOWORKS_PRODUCT_BRANDS_TAXONOMY)) {
                return;
            }

            $post_type = 'product';
            $taxonomy_slug = PIKOWORKS_PRODUCT_BRANDS_TAXONOMY;
            $taxonomy_name = 'Brands';

            $post_type_slug = get_option('piko-' . $post_type . '-config');
            if (isset($post_type_slug) && is_array($post_type_slug) &&
                array_key_exists('taxonomy_slug', $post_type_slug) && $post_type_slug['taxonomy_slug'] != ''
            ) {
                $taxonomy_slug = $post_type_slug['taxonomy_slug'];
                $taxonomy_name = $post_type_slug['taxonomy_name'];
            }
            register_taxonomy(PIKOWORKS_PRODUCT_BRANDS_TAXONOMY, 'product',
                array(
                    'hierarchical' => true,
                    'label' => $taxonomy_name,
                    'query_var' => true,
                    'rewrite' => array('slug' => $taxonomy_slug))
            );
            flush_rewrite_rules();
        }


        function addMenuChangeSlug()
        {
            add_submenu_page('edit.php?post_type=product', 'Setting', 'Settings', 'edit_posts', wp_basename(__FILE__), array($this, 'initPageSettings'));
        }

        function initPageSettings()
        {
            $template_path = ABSPATH . 'wp-content/plugins/pikoworks_custom_post/core/post-type/posttype-settings/settings.php';
            if (file_exists($template_path))
                require_once $template_path;
        }
        
    }
    new Pikoworks_WC_Brands();
}
 

add_action( 'admin_enqueue_scripts', 'pikoworks_brand_admin_scripts');
if(!function_exists('pikoworks_brand_admin_scripts')) {
    function pikoworks_brand_admin_scripts() {
        $screen = get_current_screen();
        if ( in_array( $screen->id, array('edit-'.PIKOWORKS_PRODUCT_BRANDS_TAXONOMY) ) )
		  wp_enqueue_media();
    }
}
if(!function_exists('wooxon_product_brand_image')) {
    function wooxon_product_brand_image() {
        global $post;
        $terms = wp_get_post_terms( $post->ID, PIKOWORKS_PRODUCT_BRANDS_TAXONOMY );
        if(! is_wp_error( $terms ) && count($terms)>0 && wooxon_get_option_data('show_brand_image') ) {
            ?>
            <div class="brand-img">
                <?php
                foreach($terms as $brand) {
                    $thumbnail_id 	= absint( get_woocommerce_term_meta( $brand->term_id, 'thumbnail_id', true ) );
                    ?>
                    <a href="<?php echo get_term_link($brand); ?>" title="<?php echo  esc_attr($brand->name). esc_attr__(' All Product', 'pikoworks_custom_post'); ?>">                        
                        <?php 
                        if ($thumbnail_id && wooxon_get_option_data('show_brand_image') ) :
                            echo wp_get_attachment_image( $thumbnail_id, 'thumbnail' );
                        endif; ?>
                    </a>                    
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
}

if(!function_exists('wooxon_product_brand_image_single')) {
    function wooxon_product_brand_image_single() {
        global $post;
        $terms = wp_get_post_terms( $post->ID, PIKOWORKS_PRODUCT_BRANDS_TAXONOMY );
        if(! is_wp_error( $terms ) && count($terms)>0 && wooxon_get_option_data('show_brand_image_single') ) {
            ?>
            <section class="pb-widgets t_c">                
                <?php
                foreach($terms as $brand) {
                    $thumbnail_id 	= absint( get_woocommerce_term_meta( $brand->term_id, 'thumbnail_id', true ) );
                    ?>
                    <?php  if ($thumbnail_id && wooxon_get_option_data('show_brand_title') ) : ?>
                    <div class="brand-name f_s18 f_w5 t_u"><?php echo esc_html($brand->name);?></div>
                    <?php endif; ?>                    
                    <a class="db mt20 mb20" href="<?php echo get_term_link($brand); ?>" title="<?php echo  esc_attr($brand->name). esc_attr__(' All Product', 'pikoworks_custom_post'); ?>">                                               
                        <?php 
                        if ($thumbnail_id ) :
                            echo wp_get_attachment_image( $thumbnail_id, 'full' );
                        else:
                            echo esc_attr($brand->name);
                        endif; ?>
                    </a>
                    <?php if ( wooxon_get_option_data('show_brand_desc') && $brand->description != '' ) : ?>
                    <p class="brand-desc f_s13"><?php echo esc_html($brand->description);?></p>
                    <?php endif; ?>
                    <a href="<?php echo get_term_link($brand); ?>"  class="brand-prduct db"><?php esc_html_e('View all products', 'pikoworks_custom_post'); ?></a>
                    <?php
                }
                ?>
            </section>
            <?php
        }
    }
}

add_action( PIKOWORKS_PRODUCT_BRANDS_TAXONOMY.'_add_form_fields', 'pikoworks_brand_fileds');
if(!function_exists('pikoworks_brand_fileds')) {
	function pikoworks_brand_fileds() {
		global $woocommerce;
		?>
		<div class="form-field">
			<label><?php esc_html_e( 'Thumbnail', 'pikoworks_custom_post' ); ?></label>
			<div id="brand_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo wc_placeholder_img_src(); ?>" width="60px" height="60px" /></div>
			<div style="line-height:60px;">
				<input type="hidden" id="brand_thumbnail_id" name="brand_thumbnail_id" />
				<button type="submit" class="upload_image_button button"><?php esc_html_e( 'Upload/Add image', 'pikoworks_custom_post' ); ?></button>
				<button type="submit" class="remove_image_button button"><?php esc_html_e( 'Remove image', 'pikoworks_custom_post' ); ?></button>
			</div>
			<script type="text/javascript">

				 // Only show the "remove image" button when needed
				 if ( ! jQuery('#brand_thumbnail_id').val() )
					 jQuery('.remove_image_button').hide();

				// Uploading files
				var file_frame;

				jQuery(document).on( 'click', '.upload_image_button', function( event ){

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}

					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php esc_attr_e( 'Choose an image', 'pikoworks_custom_post' ); ?>',
						button: {
							text: '<?php esc_attr_e( 'Use image', 'pikoworks_custom_post' ); ?>',
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						attachment = file_frame.state().get('selection').first().toJSON();

						jQuery('#brand_thumbnail_id').val( attachment.id );
						jQuery('#brand_thumbnail img').attr('src', attachment.url );
						jQuery('.remove_image_button').show();
					});

					// Finally, open the modal.
					file_frame.open();
				});

				jQuery(document).on( 'click', '.remove_image_button', function( event ){
					jQuery('#brand_thumbnail img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
					jQuery('#brand_thumbnail_id').val('');
					jQuery('.remove_image_button').hide();
					return false;
				});

			</script>
			<div class="clear"></div>
		</div>
		<?php
	}
}


add_action( PIKOWORKS_PRODUCT_BRANDS_TAXONOMY.'_edit_form_fields', 'pikoworks_edit_brand_fields', 10,2 );
if(!function_exists('pikoworks_edit_brand_fields')) {
    function pikoworks_edit_brand_fields($term, $taxonomy ) {
    	$thumbnail_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
    	if ($thumbnail_id) :
    		$image = wp_get_attachment_thumb_url( $thumbnail_id );
    	else :
    		$image = wc_placeholder_img_src();
    	endif;
    	?>
    	<tr class="form-field">
    		<th scope="row" valign="top"><label><?php esc_html_e( 'Thumbnail', 'pikoworks_custom_post' ); ?></label></th>
    		<td>
    			<div id="brand_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo wp_kses_post($image); ?>" width="60px" height="60px" /></div>
    			<div style="line-height:60px;">
    				<input type="hidden" id="brand_thumbnail_id" name="brand_thumbnail_id" value="<?php echo esc_attr($thumbnail_id); ?>" />
    				<button type="submit" class="upload_image_button button"><?php esc_html_e( 'Upload/Add image', 'pikoworks_custom_post' ); ?></button>
    				<button type="submit" class="remove_image_button button"><?php esc_html_e( 'Remove image', 'pikoworks_custom_post' ); ?></button>
    			</div>
    			<script type="text/javascript">

    				// Uploading files
    				var file_frame;

    				jQuery(document).on( 'click', '.upload_image_button', function( event ){

    					event.preventDefault();

    					// If the media frame already exists, reopen it.
    					if ( file_frame ) {
    						file_frame.open();
    						return;
    					}

    					// Create the media frame.
    					file_frame = wp.media.frames.downloadable_file = wp.media({
    						title: '<?php esc_attr_e( 'Choose an image', 'pikoworks_custom_post' ); ?>',
    						button: {
    							text: '<?php esc_attr_e( 'Use image', 'pikoworks_custom_post' ); ?>',
    						},
    						multiple: false
    					});

    					// When an image is selected, run a callback.
    					file_frame.on( 'select', function() {
    						attachment = file_frame.state().get('selection').first().toJSON();

    						jQuery('#brand_thumbnail_id').val( attachment.id );
    						jQuery('#brand_thumbnail img').attr('src', attachment.url );
    						jQuery('.remove_image_button').show();
    					});

    					// Finally, open the modal.
    					file_frame.open();
    				});

    				jQuery(document).on( 'click', '.remove_image_button', function( event ){
    					jQuery('#brand_thumbnail img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
    					jQuery('#brand_thumbnail_id').val('');
    					jQuery('.remove_image_button').hide();
    					return false;
    				});

    			</script>
    			<div class="clear"></div>
    		</td>
    	</tr>
    	<?php
    }
}

if(!function_exists('pikoworks_brands_fields_save')) {
    function pikoworks_brands_fields_save($term_id, $tt_id, $taxonomy ) {

    	if ( isset( $_POST['brand_thumbnail_id'] ) )
    		update_woocommerce_term_meta( $term_id, 'thumbnail_id', absint( $_POST['brand_thumbnail_id'] ) );

    	delete_transient( 'wc_term_counts' );
    }
}

add_action( 'created_term', 'pikoworks_brands_fields_save', 10,3 );
add_action( 'edit_term', 'pikoworks_brands_fields_save', 10,3 );

if(class_exists('WP_Widget')) {
//add brand widgets

    class Pikoworks_Brands_Widget extends WP_Widget {
        /**
         * Current Brand.
         *
         * @var bool
         */
         public $current_cat;

        /**
         * Constructor.
         */
         public function __construct() {
                    $widget_ops = array(
                            'classname' => 'sidebar-widget pikoworks_widget_brands',
                            'description' => esc_html__( 'A list or dropdown of product brands.', 'pikoworks_custom_post' ),
                            'customize_selective_refresh' => true,
                    );
                    parent::__construct( 'pikoworks_widget_brands', esc_html__( '[Pikoworks] Product Brands', 'pikoworks_custom_post' ), $widget_ops );
        }

        /**
         * Output widget.
         *
         * @see WP_Widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget( $args, $instance ) {

            $count              = isset( $instance['count'] ) ? $instance['count'] : $this->settings['count']['std'];
            $title              = isset( $instance['title'] ) ? $instance['title'] : $this->settings['title']['std'];
            $dropdown           = isset( $instance['dropdown'] ) ? $instance['dropdown'] : $this->settings['dropdown']['std'];
            $displayType        = isset( $instance['displayType'] ) ? $instance['displayType'] : $this->settings['displayType']['std'];
            $hide_empty         = isset( $instance['hide_empty'] ) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];

            // Setup Current Category
            $this->current_cat   = false;
            $hide_empty = ($hide_empty == 1) ? true : false;
            $args = array(
                'taxonomy' => PIKOWORKS_PRODUCT_BRANDS_TAXONOMY,
                'hide_empty' => $hide_empty,
            );
            $terms =  new WP_Term_Query($args);

            // Dropdown
            echo '<section class="widget pikoworks_widget_brands">
                    <h4 class="widget-title">'. esc_html($title).'</h4>
                    ';

            if ( $dropdown ) { ?>
                    <select name="product_brand" class="dropdown_product_brand">
                        <option value="" selected="selected"><?php esc_attr_e('Select a brand', 'pikoworks_custom_post'); ?></option>
                        <?php foreach ($terms->terms as $brand) {
                            $countProd = ($count == 1) ? "({$brand->count})" : '';
                            ?>
                            <option class="level-0" value="<?php echo esc_attr($brand->name); ?>"><?php echo esc_html($brand->name .' '. $countProd); ?></option>
                        <?php } ?>
                    </select>
                <?php
                wc_enqueue_js( "
                                    jQuery( '.dropdown_product_brand' ).change( function() {
                                            if ( jQuery(this).val() != '' ) {
                                                    var this_page = '';
                                                    var home_url  = '" . esc_js( home_url( '/' ) ) . "';
                                                    if ( home_url.indexOf( '?' ) > 0 ) {
                                                            this_page = home_url + '&brand=' + jQuery(this).val();
                                                    } else {
                                                            this_page = home_url + '?brand=' + jQuery(this).val();
                                                    }
                                                    location.href = this_page;
                                            }
                                    });
                            " );
            // List
            } else {
                echo '<ul>';            
                    foreach ($terms->terms as $brand) {
                        $thumbnail_id = absint(get_woocommerce_term_meta($brand->term_id, 'thumbnail_id', true)); ?>
                         <?php
                            $countProd = ($count == 1) ? "<span class='count'>(" . esc_html($brand->count) .")</span>" : '';
                            $countProd2 = ($count == 1) ? "<span class='count'>" . esc_html($brand->count) ."</span>" : '';
                            if ( $displayType == 'name' ) { ?>
                            <li class="cat-item">
                                <a href="<?php echo esc_url(get_term_link($brand)); ?>">
                                    <?php echo esc_attr($brand->name); ?>
                                    <?php echo wp_kses_post($countProd); ?>
                                </a>
                            </li>    
                            <?php } elseif( $displayType == 'image' ) {
                                $brandImg = wp_get_attachment_image($thumbnail_id, array(100,100) );
                                if (!empty( $brandImg )) { ?>
                                <li class="cat-img">
                                    <a class="brand-logo" href="<?php echo esc_url(get_term_link($brand)); ?>" title="<?php echo esc_attr($brand->name) . ' (' . esc_attr($brand->count) . ')'; ?>">
                                        <?php echo wp_kses_post($brandImg); ?>
                                         <?php echo wp_kses_post($countProd2); ?>
                                    </a>
                                </li>    
                                <?php }
                            } ?>

                    <?php }            
                echo '</ul>';
            }
            echo '</section>';
        }

         function update( $new_instance, $old_instance ) {
                   $instance = $old_instance;

                   /* Strip tags (if needed) and update the widget settings. */
                   $instance['title'] = strip_tags( $new_instance['title'] );
                   $instance['displayType'] = strip_tags( $new_instance['displayType'] );
                   $instance['dropdown'] = strip_tags( $new_instance['dropdown'] );
                   $instance['count'] = strip_tags( $new_instance['count'] );
                   $instance['hide_empty'] = strip_tags( $new_instance['hide_empty'] );               

                   return $instance;
           }
           function form($instance) {               
                   //Defaults
                    $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
                    $title = sanitize_text_field( $instance['title'] );
                    $displayType = isset($instance['displayType']) ? (bool) $instance['displayType'] :false;
                    $dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
                    $count = isset($instance['count']) ? (bool) $instance['count'] :false;
                    $hide_empty = isset( $instance['hide_empty'] ) ? (bool) $instance['hide_empty'] : false;		

                   ?>

                   <p>
                           <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html__('Widget Title:', 'pikoworks_core') ?></label>
                           <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
                   </p>
                   <p>
                        <label for="<?php echo $this->get_field_id( 'displayType' ); ?>"><?php esc_html_e( 'Display type:', 'pikoworks_custom_post' ); ?></label>
                        <select id="<?php echo $this->get_field_id( 'displayType' ); ?>" name="<?php echo $this->get_field_name( 'displayType' ); ?>">
                                <option value="name"><?php esc_html_e( 'Name', 'pikoworks_custom_post' ); ?></option>
                                <option value="image"><?php esc_html_e( 'Image', 'pikoworks_custom_post'  ); ?></option>                            
                        </select>
                    </p>
                    <p>                    
                        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
                        <label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php esc_html_e( 'Display as dropdown', 'pikoworks_custom_post'  ); ?></label><br />

                        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
                        <label for="<?php echo $this->get_field_id('count'); ?>"><?php esc_html_e( 'Show product counts', 'pikoworks_custom_post'  ); ?></label><br />

                        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hide_empty'); ?>" name="<?php echo $this->get_field_name('hide_empty'); ?>"<?php checked( $hide_empty ); ?> />
                        <label for="<?php echo $this->get_field_id('hide_empty'); ?>"><?php esc_html_e( 'Hide empty brands', 'pikoworks_custom_post'  ); ?></label><br />
                    </p>

       <?php
           }

    }
}
 function pikoworks_brand_widgets(){  
    register_widget('Pikoworks_Brands_Widget');
 }
 add_action('widgets_init', 'pikoworks_brand_widgets');