<?php

$prefix = 'wooxon_';
$thumbnail =  get_post_meta(get_the_ID(), $prefix . 'single_products_thumbnail',true);

/* 
 * woocommerce core function
 */

if(!function_exists('wooxon_header_add_to_cart_fragment')) {
/**
 * woocommerce action
 * */
function wooxon_header_add_to_cart_fragment( $fragments ) { 
    ob_start();
    $count = WC()->cart->cart_contents_count ;  
    ?><span class="cart-items" ><?php echo esc_attr($count); ?></span><?php
 
    $fragments['span.cart-items'] = ob_get_clean();
     
    return $fragments;    
}
add_filter( 'woocommerce_add_to_cart_fragments', 'wooxon_header_add_to_cart_fragment' );
}

if(!function_exists('wooxon_cart_total')) {
	function wooxon_cart_total() {
		global $woocommerce;
		?>
		<span class="shop-text"><span class="total"><?php echo esc_html($woocommerce->cart->get_cart_subtotal()); ?></span></span>
		<?php
	}
}


if(!function_exists('wooxon_cart_number')) {
	function wooxon_cart_number() {
		global $woocommerce;
		?>
		<span class="badge-number" data-items-count="<?php echo esc_attr($woocommerce->cart->cart_contents_count); ?>"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
		<?php
	}
}

if(!function_exists('wooxon_get_fragments')) {
	add_filter('woocommerce_add_to_cart_fragments', 'wooxon_get_fragments', 30);
	function wooxon_get_fragments($array = array()) {
		ob_start();
		wooxon_cart_total();
		$cart_total = ob_get_clean();

		ob_start();
		wooxon_cart_number();
		$cart_number = ob_get_clean();


		$array['span.shop-text'] = $cart_total;
		$array['span.badge-number'] = $cart_number;

		return $array;
	}
}
if( ! function_exists( 'wooxon_quick_view_button' ) ) {
    function wooxon_quick_view_button(){
         global $post;
        echo '<a class="product-label quickview" href="javascript:void(0);" data-product-id="' . esc_attr( $post->ID ) . '">' . esc_html__( 'Quick View', 'wooxon' ) . '</a>';
    }
}

if( ! function_exists( 'wooxon_wc_template_loop_product_thumbnail' ) ) {

function wooxon_wc_template_loop_product_thumbnail() {
 /**
 * woocommerce product thumbnail
 * */    
    global $post, $product;
    $image_html = '';
    $img_count = 0;
    $attachment_ids = $product->get_gallery_image_ids();
    $post_image_title = get_the_title( get_post_thumbnail_id() );
    $post_image_caption = get_post_field( 'post_excerpt', get_post_thumbnail_id() );
    $product_img = wooxon_get_option_data('optn_product_image_type', 'none'); 
				
    if ( has_post_thumbnail() ) {
        $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );
    }
//    wooxon_quick_view_button();
    ?>
    
     <?php if($product_img == 'carousel') :?>
            <figure class="piko-carousel sc psh br" data-slick='{"slidesToShow": 1,"slidesToScroll": 1,}'>                
                    <?php
                    if ( $image_html !== '' ) : ?>
                    
                        <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $post_image_caption) ?>" >
                            <?php  echo wp_kses_post($image_html); ?>
                        </a>
                    
                    <?php
                    else:
                        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'wooxon' ) ), $post->ID ); 
                    endif; ?>
                     <?php                
                    if ($attachment_ids) {
                        foreach ( $attachment_ids as $attachment_id ) {
                            if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                    continue;
                            $img_medium = wp_get_attachment_image_src( $attachment_id, 'shop_catalog');
                            $image_title 	= get_the_title( $attachment_id );
                            $image_caption 	= get_post_field( 'post_excerpt', $attachment_id );

                            ?>
                            
                                <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $image_caption) ?>">
                                    <img src="<?php echo esc_url($img_medium[0]); ?>" alt="<?php esc_attr( $image_title) ?>">
                                </a>
                           
                            <?php
                            $img_count++;
                        }
                    }
                    ?>
            </figure>
       <?php elseif($product_img == 'rollover'):?>                
                <figure>
                    <a href="<?php esc_url( the_permalink()) ?>">
            <?php            
            if ( has_post_thumbnail() ) {
                
                
                if ($attachment_ids) {

                    foreach ( $attachment_ids as $attachment_id ) {
                        if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                continue;
                        echo '<div class="product-image">'. wp_get_attachment_image( $attachment_id, 'shop_catalog' ).'</div>';
                        $img_count++;
                        if ($img_count == 1) break;
                        }
                        echo '<div class="product-image">'. wp_kses_post($image_html) .'</div>';	

                        } else {
                            echo '<div class="product-image">'. wp_kses_post($image_html)  .'</div>';					
                            echo '<div class="product-image">'. wp_kses_post($image_html)  .'</div>';                        
                        }
                
            } else {
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'wooxon' ) ), $post->ID ); 
            } 
            
            ?>
               </a>         
            </figure>           
       <?php else:?>               
            <figure>
                <a href="<?php esc_url( the_permalink()) ?>">
                    <?php if($image_html !== ''){ 
                        echo wp_kses_post($image_html);
                        }else{
                           echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'wooxon' ) ), $post->ID ); 
                        }
                    ?>
                </a>
            </figure> 
      <?php endif;          
}
}
if( ! function_exists( 'wooxon_wc_template_loop_product_thumbnail_single' ) ) {

function wooxon_wc_template_loop_product_thumbnail_single() {
     /**
     * woocommerce product thumbnail
     * */    
        global $post;
        $image_html = '';

        if ( has_post_thumbnail() ) {
            $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );
        }
        wooxon_quick_view_button();
        ?>               
            <figure>
                <a href="<?php esc_url( the_permalink()) ?>">
                    <?php if($image_html !== ''){ 
                        echo wp_kses_post($image_html);
                        }else{
                           echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'wooxon' ) ), $post->ID ); 
                        }
                    ?>
                </a>
            </figure>
          <?php   
    }
}
if( ! function_exists( 'wooxon_wc_template_loop_product_thumbnail_rollover' ) ) {
    function wooxon_wc_template_loop_product_thumbnail_rollover() {
            global $post, $product;
            $image_html = '';
            $img_count = 0;
            $attachment_ids = $product->get_gallery_image_ids();            
             if ( has_post_thumbnail() ) {
                $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );
            } 
            
            ?>                
                <figure>
                    <a href="<?php esc_url( the_permalink()) ?>">
            <?php            
            if (  $image_html !== '' ) {
                
                
                if ($attachment_ids) {

                    foreach ( $attachment_ids as $attachment_id ) {
                        if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                continue;
                        echo '<div class="product-image">'. wp_get_attachment_image( $attachment_id, 'shop_catalog' ).'</div>';
                        $img_count++;
                        if ($img_count == 1) break;
                        }
                        echo '<div class="product-image">'. wp_kses_post($image_html) .'</div>';	

                        } else {
                            echo '<div class="product-image">'. wp_kses_post($image_html)  .'</div>';					
                            echo '<div class="product-image">'. wp_kses_post($image_html)  .'</div>';                        
                        }
                
            } else {
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'wooxon' ) ), $post->ID ); 
            } 
            
            ?>
               </a>         
            </figure>
        <?php
//        wooxon_quick_view_button();
    }
}
if( ! function_exists( 'wooxon_wc_template_loop_product_thumbnail_carousel' ) ) {
    function wooxon_wc_template_loop_product_thumbnail_carousel() {      
        global $post, $product;
        $image_html = '';
        $img_count = 0;
        $attachment_ids = $product->get_gallery_image_ids();
        $post_image_caption = get_post_field( 'post_excerpt', get_post_thumbnail_id() );        
        if ( has_post_thumbnail() ) {
            $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );
        } ?> 


                <figure class="piko-carousel sc psh br" data-slick='{"slidesToShow": 1,"slidesToScroll": 1,}'>                
                        <?php
                        if ( $image_html !== '' ) : ?>

                            <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $post_image_caption) ?>" >
                                <?php  echo wp_kses_post($image_html); ?>
                            </a>

                        <?php
                        else:
                            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'wooxon' ) ), $post->ID ); 
                        endif; ?>
                         <?php                
                        if ($attachment_ids) {
                            foreach ( $attachment_ids as $attachment_id ) {
                                if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                        continue;
                                $img_medium = wp_get_attachment_image_src( $attachment_id, 'shop_catalog');
                                $image_title 	= get_the_title( $attachment_id );
                                $image_caption 	= get_post_field( 'post_excerpt', $attachment_id );

                                ?>

                                    <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $image_caption) ?>">
                                        <img src="<?php echo esc_url($img_medium[0]); ?>" alt="<?php esc_attr( $image_title) ?>">
                                    </a>

                                <?php
                                $img_count++;
                            }
                        }
                        ?>
                </figure>
            <?php
            wooxon_quick_view_button(); 
    }
}
//product list;

if( ! function_exists( 'wooxon_wc_template_product_loop_list_start_before' ) ) {
    function wooxon_wc_template_product_loop_list_start_before() {
        echo '<div class="d_flex"><div class="media-list">';
    }
}
if( ! function_exists( 'wooxon_wc_template_product_loop_list_start_after' ) ) {
    function wooxon_wc_template_product_loop_list_start_after() {
        echo '</div>';
    }
}
if( ! function_exists( 'wooxon_wc_template_product_loop_list_end_before' ) ) {
    function wooxon_wc_template_product_loop_list_end_before() {
       echo '<div>';
    }
}
if( ! function_exists( 'wooxon_wc_template_product_loop_list_end_after' ) ) {
    function wooxon_wc_template_product_loop_list_end_after() {
        echo '</div></div>';
    }
}


if( ! function_exists( 'wooxon_wc_template_quick_view_product_thumbnail_carousel' ) ) {
    function wooxon_wc_template_quick_view_product_thumbnail_carousel() {      
        global $post, $product;
        $image_html = '';
        $img_count = 0;
        $post_id = get_the_ID();
        $attachment_ids = $product->get_gallery_image_ids();
        $post_image_caption = get_post_field( 'post_excerpt', get_post_thumbnail_id() );        
        if ( has_post_thumbnail() ) {
            $image_html = wp_get_attachment_image( get_post_thumbnail_id(), array('500', '550') );
        } ?> 


                <figure class="piko-carousel1 piko-slick-viewport dot-in sc psh br for-<?php echo esc_attr($post_id);?>" data-slick='{"slidesToShow": 1,"slidesToScroll": 1,"arrows":false,"dots": true, "asNavFor":".nav-<?php echo esc_attr($post_id); ?>"}'>                
                        <?php
                        if ( $image_html !== '' ) : ?>

                            <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $post_image_caption) ?>" >
                                <?php  echo wp_kses_post($image_html); ?>
                            </a>

                        <?php
                        else:
                            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'wooxon' ) ), $post->ID ); 
                        endif; ?>
                         <?php                
                        if ($attachment_ids) {
                            foreach ( $attachment_ids as $attachment_id ) {
                                if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                        continue;
                                $img_medium = wp_get_attachment_image_src( $attachment_id, array('500', '550'));
                                $image_title 	= get_the_title( $attachment_id );
                                $image_caption 	= get_post_field( 'post_excerpt', $attachment_id );

                                ?>

                                    <a href="<?php esc_url( the_permalink()) ?>" title="<?php esc_attr( $image_caption) ?>">
                                        <img src="<?php echo esc_url($img_medium[0]); ?>" alt="<?php esc_attr( $image_title) ?>">
                                    </a>

                                <?php
                                $img_count++;
                            }
                        }
                        ?>
                </figure>
            <?php
    }
}
if( ! function_exists( 'wooxon_wc_template_quick_view_product_thumbnail' ) ) {
    function wooxon_wc_template_quick_view_product_thumbnail() {      
        global $post, $product;
        $image_html = '';
        $img_count = 0;
        $post_id = get_the_ID();
        $attachment_ids = $product->get_gallery_image_ids();
        if ( has_post_thumbnail() ) {
            $image_html = wp_get_attachment_image( get_post_thumbnail_id(), array('150', '150') );
        } ?>                
                 <div class="piko-carousel1 slick-thumb bttom sc psh br nav-<?php echo esc_attr($post_id)?>" data-slick='{"slidesToShow": 4,"slidesToScroll": 1,"arrows":false,"focusOnSelect": true,"asNavFor":".for-<?php echo esc_attr($post_id); ?>"}'>       
                        <?php
                        if ( $image_html !== '' ) : ?>                            
                            <?php  echo wp_kses_post($image_html); ?>                          

                        <?php
                        else:
                            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'wooxon' ) ), $post->ID ); 
                        endif; ?>
                         <?php                
                        if ($attachment_ids) {
                            foreach ( $attachment_ids as $attachment_id ) {
                                if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                        continue;
                                $img_medium = wp_get_attachment_image_src( $attachment_id, array('150', '150'));
                                $image_title 	= get_the_title( $attachment_id );

                                ?>
                                <img src="<?php echo esc_url($img_medium[0]); ?>" alt="<?php esc_attr( $image_title) ?>">
                                <?php
                                $img_count++;
                            }
                        }
                        ?>
                </div>
            <?php
    }
}
if( ! function_exists( 'wooxon_wc_template_quick_view_product_thumbnail_vartical' ) ) {
    function wooxon_wc_template_quick_view_product_thumbnail_vartical() {      
        global $post, $product;
        $image_html = '';
        $img_count = 0;
        $post_id = get_the_ID();
        $attachment_ids = $product->get_gallery_image_ids();
        if ( has_post_thumbnail() ) {
            $image_html = wp_get_attachment_image( get_post_thumbnail_id(), array('150', '150') );
        }
        $class = 'left';
        if( function_exists( 'election_is_mobile' ) &&  wooxon_is_mobile()){
            $class = 'bottom';
        }
        
        
        ?>                
                 <div class="piko-carousel1 slick-thumb <?php echo esc_attr($class) ?> sc psh br nav-<?php echo esc_attr($post_id);?>" data-slick='{"slidesToShow": 4,"slidesToScroll": 1,"vertical":true,"verticalSwiping":true,"arrows":false,"focusOnSelect": true,"asNavFor":".for-<?php echo esc_attr($post_id); ?>","responsive": [{"breakpoint": 991,"settings":{"slidesToShow":3}},{"breakpoint": 576,"settings":{"slidesToShow":4,"vertical":false,"verticalSwiping":false}}]}'>       
                        <?php
                        if ( $image_html !== '' ) : ?>                            
                            <?php  echo wp_kses_post($image_html); ?>                          

                        <?php
                        else:
                            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'wooxon' ) ), $post->ID ); 
                        endif; ?>
                         <?php                
                        if ($attachment_ids) {
                            foreach ( $attachment_ids as $attachment_id ) {
                                if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                                        continue;
                                $img_medium = wp_get_attachment_image_src( $attachment_id, array('150', '150',''));
                                $image_title 	= get_the_title( $attachment_id );

                                ?>
                                <img src="<?php echo esc_url($img_medium[0]); ?>" alt="<?php esc_attr( $image_title) ?>">
                                <?php
                                $img_count++;
                            }
                        }
                        ?>
                </div>
            <?php
    }
}



if( ! function_exists( 'wooxon_wc_template_loop_product_thumbnail_1x' ) ) {

    function wooxon_wc_template_loop_product_thumbnail_1x() {
     /**
     * woocommerce product thumbnail 1x
     * */    
        global $post;
        $image_html = '';

        if ( has_post_thumbnail() ) {
            $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'thumbnail' );
        } ?> 

            <figure>
                <a href="<?php esc_url( the_permalink()) ?>">
                    <?php if($image_html !== ''){ 
                        echo wp_kses_post($image_html);
                        }else{
                           echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'wooxon' ) ), $post->ID ); 
                        }
                    ?>
                </a>
            </figure>        
        <?php    
    }
}
if( ! function_exists( 'wooxon_wc_template_loop_product_thumbnail_2x' ) ) {
function wooxon_wc_template_loop_product_thumbnail_2x() {
 /**
 * woocommerce product thumbnail 2x
 * */    
    global $post;
    $image_html = '';
				
    if ( has_post_thumbnail() ) {
        $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_single' );
    } ?> 
    
        <figure>
            <a href="<?php esc_url( the_permalink()) ?>">
                <?php if($image_html !== ''){ 
                    echo wp_kses_post($image_html);
                    }else{
                       echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'wooxon' ) ), $post->ID ); 
                    }
                ?>
            </a>
        </figure>
        <?php
        if ( class_exists( 'YITH_WCQV_Frontend' ) ):
            $label = get_option( 'yith-wcqv-button-label' );
            echo '<a href="#" class="btn-quickview yith-wcqv-button" data-product_id="' . get_the_ID() . '">' . esc_html( $label ) . '</a>';
        endif; // YITH_WCQV_Frontend
        ?>
    <?php    
}
}

function wooxon_wc_template_loop_product_coundown() {
    $id = get_the_ID();
    $time = wooxon_get_max_date_sale( $id );
    $y = date( 'Y', $time );
    $m = date( 'm', $time );
    $d = date( 'd', $time );

    $sale_price_dates_from = ( $date = get_post_meta( $id, '_sale_price_dates_from', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';

    if ( $sale_price_dates_from !== '')  {                    
    ?>                    
        <div class="countdown-lastest" data-y="<?php echo esc_attr( $y );?>" data-m="<?php echo esc_attr( $m );?>" data-d="<?php echo esc_attr( $d );?>" data-h="00" data-i="00" data-s="00" ></div>   
    <?php
    } 
}

function wooxon_wc_template_loop_product_cat_rating() {
    global $product;
    $excerpt = wooxon_get_option_data('product_list_excerpt','25');    
    ?>
    <div class="product-middle">
        <?php wooxon_wc_template_loop_product_brand();  ?>    
        <div class="title-wrap">
            <?php wooxon_wc_template_loop_product_title(); ?>
           <?php if(is_shop() || is_product_category()): ?>
                <div class="list-content"><?php echo wp_trim_words( get_the_excerpt(), esc_attr($excerpt), ' ... ' ); ?></div>
           <?php endif; ?>
        </div>        
        <div class="d_flex align-items-center justify-content-between btn-action">
            <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
            <?php wooxon_wc_template_loop_product_rating(); ?>            
        </div>
    </div>    
    <?php
}
function wooxon_wc_template_loop_product_rating() {
    global  $product;
    
    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();
    
    if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && !$review_count) {
        return;
    }
    ?>        
                        
    <?php if ( $rating_count > 0 ) :  ?>            
        <div class="star-rating" title="<?php printf( esc_attr__( 'Rated %s out of 5', 'wooxon' ), $average ); ?>">
                <span style="width:<?php echo ( ( esc_html($average) / 5 ) * 100 ); ?>%">
                        <strong class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'wooxon' ), '<span>', '</span>' ); ?>
                        <?php printf( esc_html(_n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'wooxon' )), '<span class="rating">' . esc_html($rating_count) . '</span>' ); ?>
                </span>
        </div>
    <?php endif; ?>    
    <?php
    if ( is_product() && $review_count > 0 ) {
            /* translators: 1: reviews count 2: product name */
            echo '<div class="product-ratings-desc">';
            printf(  esc_html( _n( ' %1$s review', '%1$s review&#40;s&#41;', $review_count, 'wooxon' ) ), esc_html($review_count ));
            echo '</div>';
    }
}

function wooxon_wc_template_loop_product_brand() {
    $disable = wooxon_get_option_data('optn_product_rating', 1);
    if($disable == 0){ return; }     
    ?>
    <div class="product-brand d_flex align-items-center justify-content-between mt15">
            <?php wc_get_template_part( 'product-category' ); ?>
    </div><!-- End .product-brand -->
    <?php
}
function wooxon_wc_template_loop_product_title() {
    ?>
    <h3 class="product-title">
        <a href="<?php esc_url( the_permalink()) ?>"><?php the_title(); ?></a>
    </h3>
    <?php
}

function wooxon_wc_template_loop_product_price() {
    global $product;
    $cart_btn = wooxon_get_option_data('catalog_mode','1');
    ?>
        <div class="d_flex align-items-center justify-content-between btn-action">
            <span class="price <?php if(!$cart_btn){echo 'pt5 pb10';} ?>"><?php echo wp_kses_post($product->get_price_html()); ?></span>
            <?php //if($cart_btn){ woocommerce_template_loop_add_to_cart();}            
            
            wooxon_wc_template_loop_product_rating();
            
            ?>
            
        </div><!-- End .product-price-container -->        
    <?php
}


function wooxon_wc_template_loop_product_button_action() {
    ?>
     <div class="btn-action other d_flex align-items-center justify-content-center">
        <?php 
         echo wooxon_wc_wishlist_button();
         do_action('wooxon_wc_loop_product_bottom');
        ?>       
    </div><!-- End .product-action -->
    <?php
}


function wooxon_wc_template_loop_product_thumbnail_button_action() { //new button action
    global $post;
    $cart_btn = wooxon_get_option_data('catalog_mode','1');
    if($cart_btn){ woocommerce_template_loop_add_to_cart();} 
    ?>
     <div class="thumb_action pa t_c">
         
        <?php          
         echo '<a class="btn-ac quickview" href="javascript:void(0);" data-product-id="' . esc_attr( $post->ID ) . '"><span class="icon-eye"></span></a>';        
         echo wooxon_wc_wishlist_button();
         do_action('wooxon_wc_loop_product_bottom');         
        ?>       
    </div><!-- End .product-action -->
    <?php    
}


function wooxon_wc_wishlist_button() {
	global $product, $yith_wcwl;

	if ( ! class_exists( 'YITH_WCWL' ) ) return;

	$url          = YITH_WCWL()->get_wishlist_url();
	$product_type = $product->get_type();
	$exists       = $yith_wcwl->is_product_in_wishlist( $product->get_id() );
	$classes      = 'class="add_to_wishlist"';
	$add          = get_option( 'yith_wcwl_add_to_wishlist_text' );
	$browse       = get_option( 'yith_wcwl_browse_wishlist_text' );
	$added        = get_option( 'yith_wcwl_product_added_text' );

	$add = $browse = $added = $output = '';

	$output  .= '<div class="btn-ac yith-wcwl-add-to-wishlist pr add-to-wishlist-' . esc_attr( $product->get_id() ) . '">';
		$output .= '<div class="yith-wcwl-add-button';
			$output .= $exists ? ' hide" style="display:none;"' : ' show"';
			$output .= '><i class="fa fa-spinner fa-pulse ajax-loading pa" style="visibility:hidden"></i><a href="' . esc_url( htmlspecialchars( YITH_WCWL()->get_wishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->get_id() ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' ><i class="fa fa-heart-o"></i>'. esc_attr($add).'</a>';
			$output .= '';
		$output .= '</div>';

		$output .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a href="' . esc_url( $url ) . '"><i class="fa fa-heart"></i>'.esc_attr($browse).'</a></div>';
		$output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '" ><i class="icon-checkmark"></i>'.esc_attr($added).'</a></div>';
	$output .= '</div>';

	return $output;
}

function wooxon_wc_quickview() {
	// Get product from request.
	if ( isset( $_POST['product'] ) && (int) $_POST['product'] ) {
		global $post, $product, $woocommerce;

		$id      = ( int ) $_POST['product'];
		$post    = get_post( $id );
		$product = get_product( $id );

		if ( $product ) {
			// Get quickview template.
			include WOOXON_THEME_DIR . '/woocommerce/content-quickview-product.php';
		}
	}

	exit;
}
add_action( 'wp_ajax_piko_quickview', 'wooxon_wc_quickview' );
add_action( 'wp_ajax_nopriv_piko_quickview', 'wooxon_wc_quickview' );


//single product
function wooxon_wc_template_single_product_miscellaneous() {     
     if ( get_post_type( get_the_ID() ) == 'product' && is_singular() && !is_page() ) :
         $enable_miscellaneous = wooxon_get_option_data('enable_miscellaneous','0');
         $guide_title = wooxon_get_option_data('size_guide_title','');
         
         $size_guide_id =  get_post_meta(get_the_ID(),'wooxon_size_guide', true);
        $size_guide['url'] =  wp_get_attachment_image_url($size_guide_id, '') ? wp_get_attachment_image_url($size_guide_id, '') : '';
        if (!isset($size_guide['url']) ||  $size_guide['url'] == '') { 
            $size_guide = wooxon_get_option_data('size_guide','');
        }
         
         $policy_title = wooxon_get_option_data('return_policy_title','');
         $return_policy = wooxon_get_option_data('return_policy','');       
     ?>
        <?php if($enable_miscellaneous == '1'): ?>
        <div class="guide-wrap d_flex mb10 f_w6">        
               <?php 
               if(!empty($size_guide['url'])){
                    echo '<a class="piko-lightbox-single" href="'.esc_url($size_guide['url']).'">'.esc_attr($guide_title).'</a>';
               }
               if(!empty($return_policy)){
                    echo  '<a class="return-policy" href="#">'.esc_attr($policy_title).'</a>';  
               }           
               ?>
        </div>
        <?php
       endif; //$enable_miscellaneous
    endif; //post type
}
function wooxon_wc_shipping_terms() {
	// Get shipiping content single page
        $return_policy = wooxon_get_option_data('return_policy',''); 
	if ( ! $return_policy ) return;

	$output = '<div class="return-content">' . $return_policy . '</div>';

	echo wp_kses_post( $output );
	exit;
}
add_action( 'wp_ajax_jas_piko_shipping_terms', 'wooxon_wc_shipping_terms' );
add_action( 'wp_ajax_nopriv_piko_shipping_terms', 'wooxon_wc_shipping_terms' );

if ( !function_exists( 'wooxon_wc_product_video' ) ) {
	function wooxon_wc_product_video()	{
            $video_src = get_post_meta(get_the_ID(), 'wooxon_single_products_video', true );
            if(!empty($video_src)){
                echo '<div class="piko-video">
                    <a href="'. esc_url($video_src) .'" class="piko-embed fa fa-play"></a>
                </div>';
            } 
	}
}

function wooxon_wc_template_cart_page_product_code($sku) {
    global $product;    
   
    if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) :         
          ( $sku = $product->get_sku() ) ? esc_attr($sku) : esc_attr__( 'N/A', 'wooxon' );
          return;
    endif;   
    
}


function wooxon_wc_template_single_product_button_action() {
    echo wooxon_wc_wishlist_button();
}


function wooxon_wc_template_loop_category_thumbnail() { //m-n-u
 /**
 * woocommerce product category thumbnail overlay
 * */
    
    global $post, $product;
    
    $image_html = '';
    $img_count = 0;
    $attachment_ids = $product->get_gallery_image_ids();
				
    if ( has_post_thumbnail() ) {
        $image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );					
    }
    echo '<figure class="category-img-wrap">';    
        if ($attachment_ids) {
            echo '<div class="image-product-gallery">';
            echo '<a href="javascript:void(0)" class="change">' . wp_kses_post($image_html) . '</a>';
            foreach ( $attachment_ids as $attachment_id ) {
                if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
                        continue;
                echo '<a href="javascript:void(0)" class="change">'. wp_get_attachment_image( $attachment_id, 'shop_catalog' ) . '</a>';
                $img_count++;
                if ($img_count == 2) break;
                }
                
                echo '</div><div class="image-product"> <a href="javascript:void(0)" class="woocommerce-main-image">'. wp_kses_post($image_html) .'</a></div>';
                } else {
                    echo '<div class="image-product">'. wp_kses_post($image_html)  .'</div>';					
                    echo '<div class="image-product-gallery">'. wp_kses_post($image_html)  .'</div>';                        
                }
    echo '</figure>';       
}


function wooxon_wc_template_loop_price_deals(){    
    global $product;   
    ?>
        <footer class="product-footer">            
            <span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>            
            <div class="clearfix"></div>
        </footer>
    <?php
    
}

if( ! function_exists( 'wooxon_woocommerce_custom_sales_price' ) ){
 /**
 * Sale price Percentage
 */
    function wooxon_woocommerce_custom_sales_price( $product ) {       
    
    global $post, $product;
    if ( ! $product->is_in_stock() || $product->is_type('grouped') ) return;
    $sale_price = get_post_meta( $product->get_id(), '_price', true);
    $regular_price = get_post_meta( $product->get_id(), '_regular_price', true);
    if (empty($regular_price) ){ //then this is a variable product
        $available_variations = $product->get_available_variations();
        $variation_id=$available_variations[0]['variation_id'];
        $variation= new WC_Product_Variation( $variation_id );
        $regular_price = $variation ->get_regular_price();
        $sale_price = $variation ->get_sale_price();
        if(empty($sale_price)){
            $variation_id=$available_variations[1]['variation_id'];
            $variation= new WC_Product_Variation( $variation_id );
            $sale_price = $variation ->get_sale_price();
        }
    }
    $percentage = ceil(( ($regular_price - $sale_price) / $regular_price ) * 100);
    if ( !empty( $regular_price ) && !empty( $sale_price ) && $regular_price > $sale_price ) :    
        return sprintf( '<span class="product-label discount">-%1$s</span>', esc_attr($percentage) . esc_attr__('%', 'wooxon') , $post, $product );    
     endif; 
    }    
    add_filter( 'woocommerce_sale_flash', 'wooxon_woocommerce_custom_sales_price' );
}





if( ! function_exists( 'woocommerce_enable_review_rating' ) ){ //m-n-u
 /**
 * comment rating
 */
    function wooxon_wc_template_loop_rating(){   
    
    global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

    
    
    ?>
        
            <?php if ( $rating_count > 0 ) :  ?>            
		<div class="star-rating" title="<?php printf( esc_attr__( 'Rated %s out of 5', 'wooxon' ), esc_html($average) ); ?>">
			<span style="width:<?php echo ( ( esc_html($average) / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( esc_html__( 'out of %s5%s', 'wooxon' ), '<span itemprop="bestRating">', '</span>' ); ?>
				<?php printf( esc_html( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'wooxon' ) ), '<span itemprop="ratingCount" class="rating">' . esc_attr($rating_count) . '</span>' ); ?>
			</span>
		</div>
            <?php endif; ?>
            <div class="clearfix"></div>        
    <?php
    
}

}

if( ! function_exists( 'woocommerce_enable_review_rating_numeric' ) ){ //m-n-u
 /**
 * comment count
 */
    function woocommerce_enable_review_rating_numeric(){ 
    
    global $product;
    if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
            return;
    }

    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();

     if ( $rating_count > 0 ) :  ?>    
        <div class="single-rating" title="<?php printf( esc_attr__( 'Rated %s out of 5', 'wooxon' ), esc_html($average) ); ?>">
            <i class="fa fa-star-o" aria-hidden="true"></i> 
            <span><?php echo esc_html( _n( '%s', '%s', $average, 'wooxon' ) ) . esc_html__( '/5', 'wooxon' ); ?></span>
        </div>            
    <?php endif; 

    }

}

add_filter( 'woocommerce_breadcrumb_defaults', 'wooxon_woo_breadcrumbs' );
function wooxon_woo_breadcrumbs() {
    global $wooxon;
    $breadcrubm_name =  isset( $wooxon['optn_breadcrumb_name'] ) ? $wooxon['optn_breadcrumb_name'] : esc_html__('Home', 'wooxon');
    $breadcrubm_delimiter =  isset( $wooxon['optn_breadcrumb_delimiter'] ) ? $wooxon['optn_breadcrumb_delimiter'] : 'fa fa-angle-right';
//    filtaring breadcrumbs
    return array(
            'delimiter'   => '<i class="'. esc_attr($breadcrubm_delimiter) .'" aria-hidden="true"></i>',
            'wrap_before' => '<nav class="woocommerce-breadcrumb dib">',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => esc_attr($breadcrubm_name),
        );
}

if ( ! function_exists( 'wooxon_woo_deal_progress_bar' ) ) {
	/**
	 * deal progress bar
	 */
	function wooxon_woo_deal_progress_bar() {
		$total_stock_quantity = get_post_meta( get_the_ID(), '_total_stock_quantity', true );
		if( ! empty( $total_stock_quantity ) ) {
			$stock_quantity		= round( $total_stock_quantity );
			$stock_available 	= ( $stock = get_post_meta( get_the_ID(), '_stock', true ) ) ? round( $stock ) : 0;
			$stock_sold 	 	= ( $stock_quantity > $stock_available ? $stock_quantity - $stock_available : 0 );
			$percentage 		= ( $stock_sold > 0 ? round( $stock_sold/$stock_quantity * 100 ) : 0 );
		} else {
			$stock_sold 	 	= ( $total_sales = get_post_meta( get_the_ID(), 'total_sales', true ) ) ? round( $total_sales ) : 0;
			$stock_available 	= ( $stock = get_post_meta( get_the_ID(), '_stock', true ) ) ? round( $stock ) : 0;
			$percentage 		= ( $stock_available > 0 ? round( $stock_sold/$stock_available * 100 ) : 0 );
		}

		if( $stock_available > 0 ) :
		?>
		<div class="piko-stock mt30">
			<div class="d_flex justify-content-between mb10">
                            <span><?php echo esc_html__( 'Already Sold:', 'wooxon' );?> <span class="f_w5"><?php echo esc_html( $stock_sold ); ?></span></span>
				<span><?php echo esc_html__( 'Available:', 'wooxon' );?> <span class="f_w5"><?php echo esc_html( $stock_available ); ?></span></span>
			</div>
			<div class="progress">
				<span class="progress-bar" style="<?php echo esc_attr( 'width:' . $percentage . '%' ); ?>"><?php echo esc_html( $percentage ); ?></span>
			</div>
		</div>
		<?php
		endif;
	}
}

if( ! function_exists( 'wooxon_get_max_date_sale') ) {
/**
 * Get max date sale variable 
 **/
    function wooxon_get_max_date_sale( $product_id ) {
        $time = 0;
        // Get variations
        $args = array(
            'post_type'     => 'product_variation',
            'post_status'   => array( 'private', 'publish' ),
            'numberposts'   => -1,
            'orderby'       => 'menu_order',
            'order'         => 'asc',
            'post_parent'   => $product_id
        );
        $variations = get_posts( $args );
        $variation_ids = array();
        if( $variations ){
            foreach ( $variations as $variation ) {
                $variation_ids[]  = $variation->ID;
            }
        }
        $sale_price_dates_to = false;
    
        if( !empty(  $variation_ids )   ){
            global $wpdb;
            $sale_price_dates_to = $wpdb->get_var( "
                SELECT
                meta_value
                FROM $wpdb->postmeta
                WHERE meta_key = '_sale_price_dates_to' and post_id IN(" . join( ',', $variation_ids ) . ")
                ORDER BY meta_value DESC
                LIMIT 1
            " );
    
            if( $sale_price_dates_to != '' ){
                return $sale_price_dates_to;
            }
        }
    
        if( ! $sale_price_dates_to ){
            $sale_price_dates_to = get_post_meta( $product_id, '_sale_price_dates_to', true );

            if($sale_price_dates_to == ''){
                $sale_price_dates_to = '0';
            }

            return $sale_price_dates_to;
        }
    }
}



function wooxon_product_share(){
global $wooxon;
$social_share = isset($wooxon['single_product_share_socials']) ? $wooxon['single_product_share_socials']: array();
    
     if ( !empty( $social_share ) ): ?>               
                <?php if ( in_array( 'facebook', $social_share ) ): ?>                    
                    <li class="social-icon fa fa-facebook">
                    <a class="shear-icon-wrap" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
                       <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on Facebook', 'wooxon' ), get_the_title() ); ?></span>
                    </a>
                    </li>        
                <?php endif; ?>
                <?php if ( in_array( 'twitter', $social_share ) ): ?>
                <li class="social-icon fa fa-twitter">
                    <a class="shear-icon-wrap" href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank">
                       <span class="text"><?php echo sprintf( esc_html__( 'Post status "%s" on Twitter', 'wooxon' ), get_the_title() ); ?></span>
                    </a>
                </li>    
                <?php endif; ?>
                <?php if ( in_array( 'gplus', $social_share ) ): ?>
                <li class="social-icon fa fa-google-plus">
                    <a class="shear-icon-wrap" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank">
                        <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on Google Plus', 'wooxon' ), get_the_title() ); ?></span>
                    </a>
                </li>    
                <?php endif; ?>
                <?php if ( in_array( 'linkedin', $social_share ) ): ?>
                    <li class="social-icon fa fa-linkedin">
                    <a class="shear-icon-wrap" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode( get_the_title() ); ?>&amp;summary=<?php echo urlencode( get_the_excerpt() ); ?>&amp;source=<?php echo urlencode( get_bloginfo( 'name' ) ); ?>" target="_blank">
                        <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on LinkedIn', 'wooxon' ), get_the_title() ); ?></span>
                    </a>
                    </li>
                <?php endif; ?>
                <?php if ( in_array( 'pinterest', $social_share ) ): ?>
                <li class="social-icon fa fa-pinterest">
                    <a class="shear-icon-wrap" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;description=<?php echo urlencode( get_the_excerpt() ); ?>" target="_blank">
                        <span class="text"><?php echo sprintf( esc_html__( 'Pin "%s" on Pinterest', 'wooxon' ), get_the_title() ); ?></span>
                    </a>
                </li>    
                <?php endif; ?>
                <?php if ( in_array( 'email', $social_share ) ): ?>
                <li class="social-icon fa fa-envelope">
                    <a class="shear-icon-wrap" href="mailto:?subject=<?php echo get_the_title(); ?>&amp;body=<?php echo urlencode( get_the_excerpt() ); ?>&amp;title=<?php echo get_the_title(); ?>" title="<?php _e( 'Email', 'wooxon' ) ?>">
                        <span class="text"><?php echo sprintf( esc_html__( 'Share "%s" on Email', 'wooxon' ), get_the_title() ); ?></span>
                    </a>
                </li>    
                <?php endif; ?>
                
    <?php endif; // End if ( !empty( $socials_shared ) )     
}
function wooxon_product_single_share(){
    $enable_share = wooxon_get_option_data( 'enable_product_single_post_share', '1' );
    if($enable_share){
        echo'<ul class="social-icons">';
        wooxon_product_share();
        echo'</ul>';
    }
}


if( ! function_exists( 'wooxon_related_products_args' ) ) {
/**
* Custom item related_products
**/
    function wooxon_related_products_args( $args ) {
        $args['posts_per_page'] = 9; // 4 to 9 related product
        return $args;
    }
}
add_filter( 'woocommerce_output_related_products_args', 'wooxon_related_products_args' );

//tootls bar

if ( !function_exists( 'get' ) ){
	function get($var){
		return isset($_GET[$var]) ? $_GET[$var] : (isset($_REQUEST[$var]) ? $_REQUEST[$var] : '');
	}
}

if ( !function_exists( 'post' ) ){
	function post($var){
		return isset($_POST[$var]) ? $_POST[$var] : null;
	}
}

if ( !function_exists( 'cookie' ) ){
	function cookie($var){
		return isset($_COOKIE[$var]) ? $_COOKIE[$var] : null;
	}
}

if ( !function_exists( 'wooxon_get_the_content_with_formatting' ) ){
	function wooxon_get_the_content_with_formatting() {
		$content = get_the_content();
		$content = apply_filters('the_content', $content);
		$content = do_shortcode($content);
		return $content;
	}
}

if ( !function_exists( 'wooxon_add_formatting' ) ) {
	function wooxon_add_formatting($content){
		$content = do_shortcode($content);
		return $content;
	}
}


if ( !function_exists( 'wooxon_get_current_page_url' ) ){
	function wooxon_get_current_page_url() {
		$current_url = add_query_arg(null,null);
		return esc_url($current_url);
	}
}


if ( !function_exists( 'wooxon_woocommerce_placeholder_img_src' ) ) {
	function wooxon_woocommerce_placeholder_img_src($src){
		$src = get_template_directory_uri() . '/assets/images/placeholder.jpg';
		return esc_url($src);
	}
}
if ( !function_exists( 'wooxon_woocommerce_add_badge_new_in_list' ) ) {
	function wooxon_woocommerce_add_badge_new_in_list()
	{
		global $post, $wooxon;
                $enable_new = isset( $wooxon['optn_show_new_product_label'] ) ? $wooxon['optn_show_new_product_label'] : 1;
                $days_count = isset( $wooxon['optn_new_product_label'] ) ? $wooxon['optn_new_product_label'] : '30';
                $label_text = isset( $wooxon['optn_new_product_label_text'] ) ? $wooxon['optn_new_product_label_text'] : esc_html__('New', 'wooxon');
                if($enable_new == 0){
                    return;
                }
		$post_date = get_the_time( 'Y-m-d', $post );
		$post_date_stamp = strtotime( $post_date );
		$newness = esc_attr($days_count);
		if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $post_date_stamp ) {
			$class = 'product-label';
			echo '<span class="' . $class . '">' . esc_attr($label_text) . '</span>';
		}
	}
}

function wooxon_woocommerce_add_badge_out_of_stock() {
    global $product, $wooxon;    
    $out_of_stock_label = isset( $wooxon['optn_product_out_of_stock_label'] ) ? $wooxon['optn_product_out_of_stock_label'] : esc_html__('Out of stock', 'wooxon');
    if(empty($out_of_stock_label)){
        return;
    }
    if ( !$product->is_in_stock() ) {
        echo '<span class="product-label outofstock">' . esc_attr($out_of_stock_label). '</span>';
    }
}

if ( !function_exists( 'wooxon_woocommerce_override_loop_shop_per_page' ) ) {
	function wooxon_woocommerce_override_loop_shop_per_page( $cols )
	{
		$products_per_page = wooxon_get_option_data( 'products_per_page', '20,25,35' );
		$mode_view = apply_filters( 'wooxon_filter_products_mode_view', 'grid' );
		if ( $mode_view == 'list' ) {
			$products_per_page = wooxon_get_option_data( 'products_per_page_list', '20,25,35' );
		}
		$array_per_page = explode( ',', $products_per_page );
		$array_per_page = array_map( 'trim', $array_per_page );
		$per_page = wooxon_get_option_data( 'products_per_page_default', 20 );
		$per_page = apply_filters( 'wooxon_filter_products_per_page', $per_page );
		if ( $per_page && in_array( $per_page, $array_per_page ) ) {
			return $per_page;
		}
		return $cols;
	}
}
if ( !function_exists( 'wooxon_woocommerce_setcookie_default' ) ) {
	function wooxon_woocommerce_setcookie_default()
	{
		$default_cookie_expire = time() + 3600 * 24 * 30;

		if ( !isset( $_COOKIE[ 'wooxon_products_list_per_page' ] ) ) {
			setcookie(
				'wooxon_products_list_per_page',
				wooxon_get_option_data( 'products_per_page_list_default', 20 ),
				$default_cookie_expire,
				COOKIEPATH
			);
		}
		if ( !isset( $_COOKIE[ 'wooxon_products_grid_per_page' ] ) ) {
			setcookie(
				'wooxon_products_grid_per_page',
				wooxon_get_option_data( 'products_per_page_default', 20 ),
				$default_cookie_expire,
				COOKIEPATH
			);
		}
		if ( !isset( $_COOKIE[ 'wooxon_products_mode_view' ] ) ) {
			setcookie(
				'wooxon_products_mode_view',
				'grid',
				$default_cookie_expire,
				COOKIEPATH
			);
		}

		// check mode_view
		if ( in_array( cookie( 'wooxon_products_mode_view' ), array( 'list', 'grid' ) ) ) {
			add_filter(
				'wooxon_filter_products_mode_view', function ( $per_row ) {
				return cookie( 'wooxon_products_mode_view' );
			}, 99 );
		}
		if ( in_array( get( 'view' ), array( 'list', 'grid' ) ) ) {
			add_filter(
				'wooxon_filter_products_mode_view', function ( $mode ) {
				return get( 'view' );
			}, 99 );
			setcookie(
				'wooxon_products_mode_view',
				get( 'view' ),
				$default_cookie_expire,
				COOKIEPATH
			);
		}

		// Check per_row
		if ( absint( cookie( 'wooxon_products_per_row' ) ) ) {
			add_filter(
				'wooxon_filter_products_per_row', function ( $per_row ) {
				return absint( cookie( 'wooxon_products_per_row' ) );
			}, 99 );
		}
		if ( absint( get( 'per_row' ) ) ) {
			add_filter(
				'wooxon_filter_products_per_row', function ( $per_row ) {
				return absint( get( 'per_row' ) );
			}, 99 );
			setcookie(
				'wooxon_products_per_row',
				absint( get( 'per_row' ) ),
				$default_cookie_expire,
				COOKIEPATH
			);
		}

		// check per_page
		$mode_view = in_array( cookie( 'wooxon_products_mode_view' ), array( 'list', 'grid' ) ) ? cookie( 'wooxon_products_mode_view' ) : 'grid';
		if ( in_array( get( 'view' ), array( 'list', 'grid' ) ) ) {
			$mode_view = get( 'view' );
		}

		if ( $mode_view == 'list' ) {
			if ( absint( cookie( 'wooxon_products_list_per_page' ) ) ) {
				add_filter(
					'wooxon_filter_products_per_page', function ( $per_row ) {
					return absint( cookie( 'wooxon_products_list_per_page' ) );
				}, 99 );
			}
			if ( absint( get( 'per_page' ) ) ) {
				add_filter(
					'wooxon_filter_products_per_page', function ( $per_page ) {
					return absint( get( 'per_page' ) );
				}, 99 );
				setcookie(
					'wooxon_products_list_per_page',
					absint( get( 'per_page' ) ),
					$default_cookie_expire,
					COOKIEPATH
				);
			}
		} else {
			if ( absint( cookie( 'wooxon_products_grid_per_page' ) ) ) {
				add_filter(
					'wooxon_filter_products_per_page', function ( $per_row ) {
					return absint( cookie( 'wooxon_products_grid_per_page' ) );
				}, 99 );
			}
			if ( absint( get( 'per_page' ) ) ) {
				add_filter(
					'wooxon_filter_products_per_page', function ( $per_page ) {
					return absint( get( 'per_page' ) );
				}, 99 );
				setcookie(
					'wooxon_products_grid_per_page',
					absint( get( 'per_page' ) ),
					$default_cookie_expire,
					COOKIEPATH
				);
			}
		}

		// check catalog_orderby
		$catalog_orderby_options = apply_filters(
			'woocommerce_catalog_orderby', array(
			'menu_order' => esc_html__( 'Default sorting', 'wooxon' ),
			'popularity' => esc_html__( 'Sort by popularity', 'wooxon' ),
			'rating'     => esc_html__( 'Sort by average rating', 'wooxon' ),
			'date'       => esc_html__( 'Sort by newness', 'wooxon' ),
			'price'      => esc_html__( 'Sort by price: low to high', 'wooxon' ),
			'price-desc' => esc_html__( 'Sort by price: high to low', 'wooxon' )
		) );
		if ( array_key_exists( cookie( 'woocommerce_default_catalog_orderby' ), $catalog_orderby_options ) ) {
			add_filter(
				'woocommerce_default_catalog_orderby', function ( $orderby ) {
				return cookie( 'woocommerce_default_catalog_orderby' );
			}, 99 );
		}
		if ( array_key_exists( get( 'orderby' ), $catalog_orderby_options ) ) {
			add_filter(
				'woocommerce_default_catalog_orderby', function ( $orderby ) {
				return get( 'orderby' );
			}, 99 );
			setcookie(
				'woocommerce_default_catalog_orderby',
				get( 'orderby' ),
				$default_cookie_expire,
				COOKIEPATH
			);
		}
	}
}

if ( !function_exists( 'wooxon_woocommerce_add_toolbar' ) ) {
	function wooxon_woocommerce_add_toolbar()
	{
		wc_get_template( 'loop/toolbar.php' );
	}
}

if ( !function_exists( 'wooxon_woocommerce_add_toolbar_per_page' ) ) {
	function wooxon_woocommerce_add_toolbar_per_page()
	{
		$link = wooxon_get_current_page_url();
		$mode_view = apply_filters( 'wooxon_filter_products_mode_view', 'grid' );
		$products_per_page = wooxon_get_option_data( 'products_per_page', '9,15,30' );
		$per_page = wooxon_get_option_data( 'products_per_page_default', 9 );
		if ( $mode_view == 'list' ) {
			$products_per_page = wooxon_get_option_data( 'products_per_page_list', '5,10,15' );
			$per_page = wooxon_get_option_data( 'products_per_page_list_default', 5 );			
		}
		$products_per_page = explode( ',', $products_per_page );
		$products_per_page = array_map( 'trim', $products_per_page );
		$per_page = apply_filters( 'wooxon_filter_products_per_page', $per_page );
		if ( count( $products_per_page ) > 1 ) {
			?>
			<div class="sort-by-wrapper sort-by-per-page">
				<div class="sort-by-label"><?php esc_attr_e( 'Per Page', 'wooxon' )?></div>
				<div class="sort-by-content">
					<ul>
						<?php foreach ( $products_per_page as $num ) : ?>
							<li<?php if ( $per_page == $num ) echo ' class="active"'; ?>>
								<a href="<?php echo esc_url(add_query_arg( 'per_page', $num, $link )) ?>"><?php echo esc_html( $num ); ?></a>
							</li>
						<?php endforeach;?>
					</ul>
				</div>
			</div>
		<?php
		}
	}
}

if ( !function_exists( 'wooxon_woocommerce_add_toolbar_position' ) ) {
	function wooxon_woocommerce_add_toolbar_position()
	{
		$link = wooxon_get_current_page_url();
		?>
		<div class="sort-by-wrapper sort-by-order">
			<div class="sort-by-label"><?php esc_attr_e( 'Position', 'wooxon' )?></div>
			<div class="sort-by-content">
				<ul>
					<li<?php if ( strtolower( get( 'order' ) ) == 'asc' ) echo ' class="active"'; ?>>
						<a href="<?php echo esc_url(add_query_arg( 'order', 'asc', $link ))?>"><?php esc_attr_e( 'Ascending', 'wooxon' )?></a>
					</li>
					<li<?php if ( strtolower( get( 'order' ) ) == 'desc' ) echo ' class="active"'; ?>>
						<a href="<?php echo esc_url(add_query_arg( 'order', 'desc', $link ))?>"><?php esc_attr_e( 'Descending', 'wooxon' )?></a>
					</li>
				</ul>
			</div>
		</div>
	<?php
	}
}

if ( !function_exists( 'wooxon_woocommerce_add_gridlist_toggle_button' ) ) {
	function wooxon_woocommerce_add_gridlist_toggle_button()
	{
		global $wp;
		$mode_views = array(
			'list' => array(
				esc_html__( 'List view', 'wooxon' ),
				'<span><i class="icon-list"></i></span>'
			),
                        'grid' => array(
				esc_html__( 'Grid view', 'wooxon' ),
				'<span><i class="icon-grid"></i></span>'
			)
		);
		$active = apply_filters( 'wooxon_filter_products_mode_view', 'grid' );
		$params = array();
		if ( isset( $_GET ) ) {
			foreach ( $_GET as $key => $val ) {
				$params[ $key ] = $val;
			}
		}
		if ( '' == get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'per_page', 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}
		?>
		<div class="gridlist-toggle-wrapper">
			<nav class="gridlist_toggle">
				<?php 
                                if ( is_active_sidebar( 'sidebar-7' ) ) {
                                    echo '<a href="javascript:void(0);" class="filter-trigger" title=" '. esc_attr__('Filter', 'wooxon').'"><i class="fa fa-sliders"></i></a>';
                                }                                
                                
                                foreach ( $mode_views as $k => $v ) { ?>
					<a id="<?php echo esc_attr( $k ); ?>" 
                                            <?php 
                                            if($active == $k){
                                                echo wp_kses( 'class="active" href="javascript:;"', array( 'a' => array( 'class' => array(), 'href' => array() )) );
                                            }else{
                                                echo wp_kses( 'href="' . esc_url( add_query_arg( 'view', $k, $form_action ) ) . '"', array( 'a' => array( 'href' => array() )) );                                               
                                            } ?>
					   title="<?php echo esc_attr( $v[ 0 ] ) ?>"><?php echo do_shortcode($v[ 1 ]) ?></a>
				<?php }?>
			</nav>
		</div>
	<?php
	}
}

if ( !function_exists( 'wooxon_woocommerce_add_filter_widgets_on_toolbar' ) ) {
	function wooxon_woocommerce_add_filter_widgets_on_toolbar()
	{
		ob_start();
		if ( is_active_sidebar( 'sidebar-7' ) ) {
			dynamic_sidebar( 'sidebar-7' );
		}
		$return = ob_get_clean();
		echo do_shortcode( $return, true );
	}
}

if ( !function_exists( 'wooxon_woocommerce_get_catalog_ordering_args' ) ) {
	function wooxon_woocommerce_get_catalog_ordering_args( $args )
	{
		$orderby_value = isset( $_GET[ 'orderby' ] ) ? wc_clean( $_GET[ 'orderby' ] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
		$orderby_value = explode( '-', $orderby_value );
		$orderby = esc_attr( $orderby_value[ 0 ] );

		if ( in_array( strtoupper( get( 'order' ) ), array( 'DESC', 'ASC' ) ) ) {
			$order = strtoupper( get( 'order' ) );
		} else {
			$order = !empty( $orderby_value[ 1 ] ) ? $orderby_value[ 1 ] : 'ASC';
		}
		$args[ 'order' ] = $order;
		switch ( $orderby ) {
			case 'popularity' :
				add_filter( 'posts_clauses', 'wooxon_woocommerce_add_filter_order_by_popularity_post_clauses' );
				break;
			case 'rating' :
				add_filter( 'posts_clauses', 'wooxon_woocommerce_add_filter_order_by_rating_post_clauses' );
				break;
		}

		return $args;
	}
}

if ( !function_exists( 'wooxon_woocommerce_add_filter_order_by_popularity_post_clauses' ) ) {
	function wooxon_woocommerce_add_filter_order_by_popularity_post_clauses( $args )
	{
		global $wpdb;
		$order = in_array( strtoupper( get( 'order' ) ), array( 'DESC', 'ASC' ) ) ? strtoupper( get( 'order' ) ) : 'DESC';
		if(isset($args[ 'orderby' ])){
			if( strpos($args['orderby'], "$wpdb->postmeta.meta_value+0") !== FALSE ){
				$args[ 'orderby' ] = "$wpdb->postmeta.meta_value+0 $order, $wpdb->posts.post_date DESC";
			}
		}

		return $args;
	}
}

if ( !function_exists( 'wooxon_woocommerce_add_filter_order_by_rating_post_clauses' ) ) {
	function wooxon_woocommerce_add_filter_order_by_rating_post_clauses( $args )
	{
		global $wpdb;
		$order = in_array( strtoupper( get( 'order' ) ), array( 'DESC', 'ASC' ) ) ? strtoupper( get( 'order' ) ) : 'DESC';
		if(isset($args[ 'orderby' ])) {
			if( strpos($args['orderby'], "average_rating") !== FALSE ){
				$args['orderby'] = "average_rating $order, $wpdb->posts.post_date DESC";
			}
		}
		return $args;
	}
}


if ( !function_exists( 'wooxon_woocommerce_custom_stock_html' ) ) {
	function wooxon_woocommerce_custom_stock_html()
	{
		if ( is_product() ) {
			global $product;
			// Availability
			$availability = $product->get_availability();
			$availability_html = empty( $availability[ 'availability' ] ) ? '' : '<p class="stock ' . esc_attr( $availability[ 'class' ] ) . '"><span>' . esc_html__( 'Availability:', 'wooxon' ) . '</span> ' . esc_html( $availability[ 'availability' ] ) . '</p>';
			echo do_shortcode($availability_html);
		}
	}
}

if ( !function_exists( 'wooxon_woocommerce_single_super_zoom' ) ) {
	function wooxon_woocommerce_single_super_zoom()
	{  
            $enable = wooxon_get_option_data( 'enable_super_zoom', true ); 
		if ( !wooxon_get_option_data( 'enable_super_zoom') ) {                    
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
	}
}
if ( !function_exists( 'wooxon_woocommerce_show_upsell_related_products' ) ) {
	function wooxon_woocommerce_show_upsell_related_products()	{
		
		if ( !wooxon_get_option_data( 'upsell_products' ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		}
	}
}


function wooxon_woocommerce_rename_tabs( $tabs ) {
	// Rename the  tab        
        global $product;	
        if( $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) { 
            $tabs['additional_information']['title'] = esc_html__( 'Details', 'wooxon' );
        }       

	return $tabs;
}
if ( !function_exists( 'wooxon_woocommerce_add_filter_product_tab_accessories' ) ) {
	function wooxon_woocommerce_add_filter_product_tab_accessories( $tabs )
	{
		global $product, $post;
                $enable 	= get_post_meta( get_the_ID(), 'wpa_wcpb', true );
                $accessories = wooxon_get_option_data( 'custom_tab_accessories', 'Accessories' );
		if ( $enable) {
			$tabs[ 'custom_tab_accessories' ] = array(
				'title'    => $accessories,
				'priority' => 2,
				'callback' => 'wooxon_woocommerce_add_custom_product_tab_accessories_callback'
			);
		}
		return $tabs;
	}
}

if ( !function_exists( 'wooxon_woocommerce_add_custom_product_tab_accessories_callback' ) ) {
	function wooxon_woocommerce_add_custom_product_tab_accessories_callback(){
            do_action('wooxon_wc_product_bundle');
	}
}
if ( !function_exists( 'wooxon_woocommerce_add_filter_product_tabs' ) ) {
	function wooxon_woocommerce_add_filter_product_tabs( $tabs )
	{
		global $product, $post;
                
                $custom_html_enable =  get_post_meta(get_the_ID(), 'wooxon_enable_custom_tab_html',true);
                if (!isset($custom_html_enable) || $custom_html_enable == '-1' || $custom_html_enable == '') {
                    $custom_html_enable = wooxon_get_option_data( 'custom_tab' );                    
                }
                $custom_tab_heading =  get_post_meta(get_the_ID(), 'wooxon_product_custom_tab_heading',true);
                if (!isset($custom_tab_heading) || $custom_tab_heading == '-1' || $custom_tab_heading == '') {
                    $custom_tab_heading = wooxon_get_option_data( 'custom_tab_title', esc_html__('Custom Tab', 'wooxon') );
                }
                
		if ( $custom_html_enable ) {
			$tabs[ 'custom_tab' ] = array(
				'title'    => $custom_tab_heading,
				'priority' => 21,
				'callback' => 'wooxon_woocommerce_add_custom_product_tab_callback'
			);
		}
		if ( !wooxon_get_option_data( 'review_tab' ) ) {
			if ( isset( $tabs[ 'reviews' ] ) ) {
				unset( $tabs[ 'reviews' ] );
			}
		}
		return $tabs;
	}
}

if ( !function_exists( 'wooxon_woocommerce_add_custom_product_tab_callback' ) ) {
	function wooxon_woocommerce_add_custom_product_tab_callback()
	{
            $custom_html_tab =  get_post_meta(get_the_ID(), 'wooxon_product_custom_tab_content',true);
            if (!isset($custom_html_tab) || $custom_html_tab == '-1' || $custom_html_tab == '') {
                $custom_html_tab = wooxon_get_option_data( 'custom_tab_content' );
            }
		echo wooxon_add_formatting( $custom_html_tab );
	}
}
if ( !function_exists( 'wooxon_woocommerce_add_filter_product_tabs_two' ) ) {
	function wooxon_woocommerce_add_filter_product_tabs_two( $tabs )
	{
		global $product, $post;
                
                $custom_html_enable =  get_post_meta(get_the_ID(), 'wooxon_enable_custom_tab_html2',true);                
                $custom_tab_heading =  get_post_meta(get_the_ID(), 'wooxon_product_custom_tab_heading2',true);               
                
		if ( $custom_html_enable ) {
			$tabs[ 'custom_tab_two' ] = array(
				'title'    => $custom_tab_heading,
				'priority' => 22,
				'callback' => 'wooxon_woocommerce_add_custom_product_tab_callback_two'
			);
		}
		
		return $tabs;
	}
}
if ( !function_exists( 'wooxon_woocommerce_add_custom_product_tab_callback_two' ) ) {
	function wooxon_woocommerce_add_custom_product_tab_callback_two()
	{
            $custom_html_tab =  get_post_meta(get_the_ID(), 'wooxon_product_custom_tab_content2',true);
            echo wooxon_add_formatting( $custom_html_tab );
	}
}

function wooxon_woocommerce_product_short_description( ) {
    global $post;
    if ( ! $post->post_excerpt ) {
            return;
    }   
    echo '<p>'. wp_trim_words( get_the_excerpt(), esc_attr(12), ' ... ' ) . '<p>';
}


if ( !function_exists( 'wooxon_woocommerce_init_sortable_taxonomies_brand' ) ) {
	add_filter('woocommerce_sortable_taxonomies','wooxon_woocommerce_init_sortable_taxonomies_brand');
	function wooxon_woocommerce_init_sortable_taxonomies_brand( $return )
	{
		global $current_screen;
		$return[ ] = 'product_brand';
		if ( is_object( $current_screen ) && in_array( $current_screen->id, array( 'edit-product_brand' ) ) ) {
			wp_enqueue_media();
		}
		return $return;
	}
}

add_action( 'init', 'wooxon_woocommerce_setcookie_default' );

add_filter( 'loop_shop_per_page', 'wooxon_woocommerce_override_loop_shop_per_page', 20 );


add_filter( 'woocommerce_placeholder_img_src', 'wooxon_woocommerce_placeholder_img_src' );
add_filter( 'woocommerce_get_catalog_ordering_args', 'wooxon_woocommerce_get_catalog_ordering_args' );


if ( !function_exists( 'wooxon_wc_add_widgets_on_shop' ) ) {
	function wooxon_wc_add_widgets_on_shop()
	{
            
       $enable_widget = wooxon_get_option_data('woo_archive_widget_enable', 0);
       $woo_archive_widget = wooxon_get_option_data('woo_archive_widget', 'sidebar-8');
            ob_start();
            if ( $enable_widget == 1 && !is_product() && is_active_sidebar( $woo_archive_widget ) ) { //for shop page
                echo '<div class="woo-archive-widget mb30">';
                    dynamic_sidebar( $woo_archive_widget );
                echo '</div>';
            }
            $return = ob_get_clean();
            echo do_shortcode( $return, true );
	}
}

//category header image
if ( !function_exists( 'wooxon_wc_show_cat_page_title' ) ) {
	function wooxon_wc_show_cat_page_title(){  
            
          if ( apply_filters( 'woocommerce_show_page_title', true ) && !is_shop() ) : ?>
                <header class="woocommerce-products-header pr">
                    <h1 class="woocommerce-products-header__title page-title lh_2 f_s25 f_w5" data-title="<?php woocommerce_page_title(); ?>"><?php woocommerce_page_title(); ?></h1>
                    <?php woocommerce_result_count(); ?>
                </header>
            <?php endif;
        
    }
}


if ( !function_exists( 'wooxon_wc_get_header_image_url' ) ) {
	function wooxon_wc_get_header_image_url($cat_ID = false){            
           if ($cat_ID==false && is_product_category()){
                    global $wp_query;

                    // get the query object
                    $cat = $wp_query->get_queried_object();

                    // get the thumbnail id user the term_id
                    $cat_ID = $cat->term_id;
            }

        $thumbnail_id = get_woocommerce_term_meta($cat_ID, 'header_id', true );

        // get the image URL
       return wp_get_attachment_url( $thumbnail_id ); 
    }
}
if ( !function_exists( 'wooxon_wc_get_header_image_html_start' ) ) {
	function wooxon_wc_get_header_image_html_start(){ 
            if(! function_exists('pikoworks_wc_get_header_image_url') ) return;
            $src = pikoworks_wc_get_header_image_url();
            if(empty($src)) return;
            echo '<div class="pikowc_header_image pr" style="background-image:url('.esc_url($src).')">';
            
    }
}
if ( !function_exists( 'wooxon_wc_get_header_image_html_end' ) ) {
	function wooxon_wc_get_header_image_html_end(){
            if(! function_exists('pikoworks_wc_get_header_image_url') ) return;
            $src = pikoworks_wc_get_header_image_url();
            if(empty($src)) return;
            echo '</div>';
    }
}

if ( !function_exists( 'wooxon_wc_before_shop_loop_item_title_before' ) ) {
	function wooxon_wc_before_shop_loop_item_title_before(){
            echo '<div class="product-top p_r o_h">';
    }
}
if ( !function_exists( 'wooxon_wc_before_shop_loop_item_title_after' ) ) {
	function wooxon_wc_before_shop_loop_item_title_after(){
            echo '</div>';
    }
}
//single page
if ( !function_exists( 'wooxon_wc_single_product_summary_before' ) ) {
	function wooxon_wc_single_product_summary_before(){
            echo '<div class="shear-brand mt15"><div class="item">';
    }
}
if ( !function_exists( 'wooxon_wc_single_product_summary_after_div' ) ) {
	function wooxon_wc_single_product_summary_after_div(){
            echo '</div>';
    }
}
if ( !function_exists( 'wooxon_wc_single_product_summary_after_div_two' ) ) {
	function wooxon_wc_single_product_summary_after_div_two(){
            echo '</div>';
    }
}
if ( !function_exists( 'wooxon_wc_single_product_summary_before_two' ) ) {
	function wooxon_wc_single_product_summary_before_two(){
            echo '<div class="btn-details-action mt25">';
    }
}
if ( !function_exists( 'wooxon_wc_single_product_summary_after_two' ) ) {
	function wooxon_wc_single_product_summary_after_two(){
             echo '</div>';
    }
}

//toolbars
if ( !function_exists( 'wooxon_wc_toolbar_before_div' ) ) {
	function wooxon_wc_toolbar_before_div(){
             echo '<div class="col-12 t_r">';
    }
}
if ( !function_exists( 'wooxon_wc_toolbar_after_div' ) ) {
	function wooxon_wc_toolbar_after_div(){
              echo '</div>';
    }
}