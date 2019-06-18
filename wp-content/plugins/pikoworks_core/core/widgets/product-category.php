<?php
/**
 * @class       Pikoworks_Product_Categories
 * @author      themepiko
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( class_exists( 'WP_Widget' ) ) {	
	class Pikoworks_Product_Categories extends WP_Widget {
                /**
                 * Category ancestors.
                 *
                 * @var array
                 */
                public $cat_ancestors;

		/**
		 * Current Category.
		 *
		 * @var bool
		 */
		public $current_cat;

		/**
		 * Current Category Parent.
		 *
		 * @var array
		 */
		public $current_cat_parent;

		public function __construct() {
			$widget_ops = array( 'classname' => 'woocommerce widget_product_categories', 'description' => esc_html__( 'A list of product categories.', 'pikoworks_core' ) );
			parent::__construct( 'pikoworks_product_categories', esc_html__( '[Pikoworks] Product Categories', 'pikoworks_core' ), $widget_ops );
		}

		public function widget($args, $instance) {
			global $wp_query, $post;

			$title = isset( $instance['title'] ) ? $instance['title'] : esc_html__( 'All Categories', 'pikoworks_core' );
			$title_single = isset( $instance['title_single'] ) ? $instance['title_single'] : esc_html__( 'View All Categories', 'pikoworks_core' );
			$count = isset( $instance['count'] ) ? $instance['count'] : false;
			$hide_empty = isset( $instance['hide_empty'] ) ? $instance['hide_empty'] : false;
			$el_class = '';

			$list_args	= array(
				'show_count' => $count,
				'taxonomy' => 'product_cat',
				'orderby' => 'id',
				'echo' => false,
				'hide_empty' => $hide_empty
			);
                        
                        // Setup Current Category
                        $this->cat_ancestors = array();			
			$this->current_cat   = false;
			$this->current_cat_parent = false;

			if ( is_tax( 'product_cat' ) ) {

				$this->current_cat   = $wp_query->queried_object;
				$this->current_cat_parent = $this->current_cat->parent;
                                $this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );

			} elseif ( is_singular( 'product' ) ) {

				$product_category = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent' ) );

				if ( $product_category ) {
					$this->current_cat   = end( $product_category );
					$this->current_cat_parent = $this->current_cat->parent;
				}

			}

			// Show Children Only
			if ( $this->current_cat ) {

				$el_class = 'single-cat';
				$title_single = apply_filters( 'pikoworks_product_categories_show_all_categories_text', $title_single );

				// single top label
				$top_level = wp_list_categories( apply_filters( 'pikoworks_product_categories_top_level_list_categories_args', array(
					'title_li'           => sprintf( '<span class="view-all-cats db h_line_f f_w5 c_s2 f_s18">%1$s</span>', $title_single ),
					'taxonomy'           => 'product_cat',
					'parent'             => 0,
					'hierarchical'       => true,
					'hide_empty'         => false,
					'exclude'            => $this->current_cat->term_id,
					'show_count'         => $count,
					'hide_empty'         => $hide_empty,
					'echo'               => false,
					'use_desc_for_title' => 0
				) ) );                               
                                

				$list_args['title_li'] = '<ul class="all-category">' . $top_level . '</ul>';

				// Direct children show.
				$direct_children = get_terms(
					'product_cat',
					array(
						'fields'       => 'ids',
						'child_of'     => $this->current_cat->term_id,
						'hierarchical' => true,
						'hide_empty'   => false
					)
				);

				$siblings = array();
				if( $this->current_cat_parent ) {
					// Gather siblings show
					$siblings = get_terms(
						'product_cat',
						array(
							'fields'       => 'ids',
							'child_of'     => $this->current_cat_parent,
							'hierarchical' => true,
							'hide_empty'   => false
						)
					);
				}

				$include = array_merge( array( $this->current_cat->term_id, $this->current_cat_parent ), $direct_children, $siblings );

				$list_args['include']     = implode( ',', $include );
				$list_args['depth']       = 3;

				if ( empty( $include ) ) {
					return;
				}

			} else {
				$view_all_cats           = apply_filters( 'pikoworks_product_categories_shop_all_categories_text', $title );
				$list_args['title_li']         = sprintf( '<span class="db h_line_f f_w5 c_s2 f_s18">%1$s</span>', $view_all_cats );
				$list_args['depth']            = 2;
				$list_args['child_of']         = 0;
				$list_args['hierarchical']     = 1;
			}
                        
                        include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );

			$list_args['walker']                     = new WC_Product_Cat_List_Walker;
			$list_args['pad_counts']                 = 1;
			$list_args['show_option_none']           = esc_html__('No product categories exist.', 'pikoworks_core' );
			$list_args['current_category']           = ( $this->current_cat ) ? $this->current_cat->term_id : '';
                        $list_args['current_category_ancestors'] = $this->cat_ancestors;
			$list_args['use_desc_for_title']         = apply_filters( 'pikoworks_use_desc_for_title_product_categories_widget', 0 );

			echo wp_kses_post( $args['before_widget'] );

			$output = wp_list_categories( apply_filters( 'pikoworks_product_categories_args', $list_args ) );

			echo '<ul class="product-categories ' . esc_attr( $el_class ) . '">';

			echo wp_kses_post( $output );

			echo '</ul>';

			echo wp_kses_post( $args['after_widget'] );
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
                        if ( ! empty( $new_instance['title'] ) ) {
				$instance['title'] = sanitize_text_field( $new_instance['title'] );
			}
                        if ( ! empty( $new_instance['title_single'] ) ) {
				$instance['title_single'] = sanitize_text_field( $new_instance['title_single'] );
			}
			if ( ! empty( $new_instance['count'] ) ) {
				$instance['count'] = strip_tags( stripslashes($new_instance['count']) );
			}
			if ( ! empty( $new_instance['hide_empty'] ) ) {
				$instance['hide_empty'] = strip_tags( stripslashes($new_instance['hide_empty']) );
			}
			
			return $instance;
		}

		public function form( $instance ) {
			global $wp_registered_sidebars;
                        
                        $title = isset( $instance['title'] ) ? $instance['title'] : '';                        
			$title_single = isset( $instance['title_single'] ) ? $instance['title_single'] : '';  
			$count = isset( $instance['count'] ) ? $instance['count'] : '';
			$hide_empty = isset( $instance['hide_empty'] ) ? $instance['hide_empty'] : '';			                      

			// If no sidebars exists.
			if ( !$wp_registered_sidebars ) {
				echo '<p>'. esc_html__('No sidebars are available.', 'pikoworks_core' ) .'</p>';
				return;
			}
			?>
                        <p><label for="<?php echo $this->get_field_id('title'); ?>"><strong><?php esc_html_e('Shop Page Title:', 'pikoworks_core'); ?></strong></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
                        <p><label for="<?php echo $this->get_field_id('title_single'); ?>"><strong><?php esc_html_e('Single Page Title:', 'pikoworks_core'); ?></strong></label> <input class="widefat" id="<?php echo $this->get_field_id('title_single'); ?>" name="<?php echo $this->get_field_name('title_single'); ?>" type="text" value="<?php echo esc_attr($title_single); ?>" /></p>
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" type="checkbox" value="1" <?php checked( $count, 1 ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Show Product Count:', 'pikoworks_core' ) ?></label></p>
			<p><input id="<?php echo esc_attr( $this->get_field_id( 'hide_empty' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_empty' ) ); ?>" type="checkbox" value="1" <?php checked( $hide_empty, 1 ); ?> /><label for="<?php echo esc_attr( $this->get_field_id( 'hide_empty' ) ); ?>"><?php esc_html_e( 'Hide Empty:', 'pikoworks_core' ) ?></label></p>
			<?php
		}
	}
}
