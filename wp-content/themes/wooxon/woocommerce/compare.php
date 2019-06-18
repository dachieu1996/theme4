<?php
if ( ! defined( 'ABSPATH' ) ) { exit;} // Exit if accessed directly

/**
 * Compare Template
 *
 * @author themepiko
 */

global $product, $yith_woocompare, $post; 
$products = $yith_woocompare->obj->get_products_list(); 
$fields = $yith_woocompare->obj->fields();
$repeat_price		  = get_option( 'yith_woocompare_price_end' );
$repeat_add_to_cart  = get_option( 'yith_woocompare_add_to_cart_end' );

if( ! empty( $products ) ) : ?>

<div class="piko-compare-table">
    <table class="compare-list">        
        <tbody>

            <?php $fields_displayed = array(); ?>

            <?php if( isset( $fields['image'] ) && isset( $fields['title'] ) ) : ?>
            <tr class="product-thumbnail">
                <th><?php echo esc_html__( 'Product', 'wooxon' ); ?></th>
                <?php foreach( $products as $key => $product ) : ?>
                    <?php $product_id = $product->get_id(); ?>
                <td class="t_c product_<?php echo esc_attr($product->get_id() ); ?>">
                    <a href="<?php echo get_permalink( $product_id ); ?>">
                        <figure>
                                <?php 
                                    if( has_post_thumbnail( $product_id ) ) {
                                        echo get_the_post_thumbnail( $product_id, 'shop_catalog', array( 'class' => 'p-'.$product_id ) );
                                    } elseif( wc_placeholder_img_src() ) {
                                        echo wc_placeholder_img( 'shop_catalog' );
                                    }
                                ?>
                        </figure>
                        <h3 class="product-title mb15 f_s16 lh_2"><?php echo esc_html( $product->fields['title'] ); ?></h3> 
                    </a>                    
                    <div class="d_flex justify-content-center"><?php wc_get_template( 'loop/rating.php', array( 'product', $product ) ); ?></div>                    
                </td>
                <?php 
                    $fields_displayed[] = 'image';
                    $fields_displayed[] = 'title';
                ?>
                <?php endforeach; ?>
            </tr>
            <?php endif; ?>
            
            <?php if( isset( $fields['price'] ) ) : ?>
            <tr class="r-price">
                <th><?php echo wp_kses_post($fields['price']); ?></th>
                <?php foreach( $products as $key => $product ) : ?>
                <td class="price t_c product_<?php echo esc_attr($product->get_id() ); ?>"><?php echo wp_kses_post( $product->fields['price'] ); ?></td>
                <?php $fields_displayed[] = 'price'; ?>
                <?php endforeach; ?>
            </tr>
            <?php endif; ?>
            
            <?php if( isset( $fields['stock'] ) ) : ?>
            <tr class="stock">
                <th><?php echo wp_kses_post($fields['stock']); ?></th>
                <?php foreach( $products as $key => $product ) : ?>
                <td class="t_c product_<?php echo esc_attr($product->get_id() ); ?>"><?php echo wp_kses_post( $product->fields['stock'] ); ?></td>
                <?php $fields_displayed[] = 'stock'; ?>
                <?php endforeach; ?>
            </tr>
            <?php endif; ?>

            <?php if( isset( $fields['description'] ) ) : ?>
            <tr class="description">
                <th><?php echo wp_kses_post($fields['description']); ?></th>
                <?php foreach( $products as $key => $product ) : ?>
                <td class="t_c product_<?php echo esc_attr($product->get_id() ); ?>"><?php echo wp_kses_post( $product->fields['description'] ); ?></td>
                <?php $fields_displayed[] = 'description'; ?>
                <?php endforeach; ?>
            </tr>
            <?php endif; ?>

            <?php foreach( $fields as $field => $name ) : ?>
                <?php if( ! in_array( $field, $fields_displayed ) ) : ?>
                <tr class="<?php echo esc_attr($field) ?>">
                    <th><?php echo wp_kses_post( $name ); ?></th>
                    <?php foreach( $products as $key => $product ) : ?>
                    <td class="t_c product-details product_<?php echo esc_attr($product->get_id() ); ?>">
                        <?php 
                            if( $field === 'add-to-cart' ) {
                                    woocommerce_template_loop_add_to_cart();
                                     if( has_post_thumbnail($product->get_id()) ) {
                                       echo '<img class="dn"  src="'.esc_url(get_the_post_thumbnail_url($product->get_id(), 'shop_catalog')).'" alt="'.esc_attr(get_the_title($product->get_id())).'"/>'; 
                                     }
                            } else {
                                echo empty( $product->fields[$field] ) ? '&nbsp;' : $product->fields[$field];
                            }                            
                        ?>
                    </td>
                    <?php endforeach; ?>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if ( $repeat_price == 'yes' && isset( $fields['price'] ) ) : ?>
                <tr class="r-price repeated">
                    <th><?php echo wp_kses_post($fields['price']); ?></th>
                    <?php foreach( $products as $key => $product ) : ?>
                    <td><div class="price t_c product_<?php echo esc_attr($product->get_id() ); ?>"><?php echo wp_kses_post( $product->fields['price'] ); ?></div></td>
                    <?php $fields_displayed[] = 'price'; ?>
                    <?php endforeach; ?>
                </tr>
            <?php endif; ?>

            <?php if ( $repeat_add_to_cart == 'yes' && isset( $fields['add-to-cart'] ) ) : ?>
                <tr class="add-to-cart repeated">
                    <th><?php echo wp_kses_post( $fields['add-to-cart'] ); ?></th>
                    <?php foreach( $products as $key => $product ) : ?>
                    <td class="t_c product-details product_<?php echo esc_attr($product->get_id() ); ?>">
                        <?php woocommerce_template_loop_add_to_cart();
                                if( has_post_thumbnail($product->get_id()) ) {
                                    echo '<img class="dn"  src="'.esc_url(get_the_post_thumbnail_url($product->get_id(), 'shop_catalog')).'" alt="'.esc_attr(get_the_title($product->get_id())).'"/>'; 
                                }
                        ?>
                    </td>
                    <?php endforeach; ?>
                </tr>
            <?php endif; ?>

            <tr class="remove1">
                <th>&nbsp;</th>
                <?php foreach( $products as $i => $product ) : ?>
                <td class="t_c c_g product_<?php echo esc_attr($product->get_id() ); ?>">
                    <?php 
                        $remove_product_url_args    = array(
                            'action' => $yith_woocompare->obj->action_remove,
                            'id'     => $product->get_id()                            
                        );
                        $remove_product_url = esc_url_raw( add_query_arg( $remove_product_url_args, wooxon_get_compare_page_url() ) );
                    ?>
                    <div class="pr"><a href="<?php echo esc_url( $remove_product_url ); ?>" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" class="remove mfp-close icon-cross2"></a></div>
                </td>
                <?php endforeach ?>
            </tr>

        </tbody>
    </table>

</div><!-- /. end compare table -->

<?php else : ?>
    <div class="woocommerce compare-empty">        
        <p class="cart-empty"> <?php esc_html_e( 'Compare table is currently empty', 'wooxon' ) ?></p>        
        <p class="return-to-shop">
		<a class="wc-backward f_w5 c_p" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
                    <?php esc_html_e( 'Return to shop', 'woocommerce' ); ?>
		</a>
	</p>
    </div>
<?php endif; ?>