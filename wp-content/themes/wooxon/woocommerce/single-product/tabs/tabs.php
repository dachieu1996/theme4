<?php
/**
 * Single Product tabs | ##edit
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

$tabs_layout = wooxon_get_option_data('optn_woo_single_tab_layout', 'tabs');

if ( ! empty( $tabs ) ) : 
    
    if($tabs_layout == 'tabs'):
    ?>

	<div class="woocommerce-tabs wc-tabs-wrapper mt80 w1340">
		<ul class="tabs wc-tabs ul-no d_flex justify-content-center pr" role="tablist">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
                                    <a class="db f_s18 f_w5" href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php else:
    
$prefix = 'wooxon_';    
$sidebar =  get_post_meta(get_the_ID(), $prefix . 'page_sidebar',true);
if (!isset($sidebar) || $sidebar == '-1' || $sidebar == '') {
    $sidebar = wooxon_get_option_data('optn_product_single_sidebar_pos', 'fullwidth');
}
$cols_before = 'col-md-4';
$cols_after = 'col-md-8';
if($sidebar == 'fullwidth'){
  $cols_before = 'col-md-3';  
  $cols_after = 'col-md-9';  
}
    
    ?>

<div class="woocommerce-tabs wc-tabs-wrapper mt50 w1340 tabs-accordion">
    <div class="row">
        <ul class="tabs wc-tabs ul-no <?php echo esc_attr($cols_before); ?> mt5 mb20 mb10-sm" role="tablist">
                <?php foreach ( $tabs as $key => $tab ) : ?>
                        <li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
                            <a class="db f_s17 f_w5 mg0" href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
                        </li>
                <?php endforeach; ?>
        </ul>
        <div class="<?php echo esc_attr($cols_after); ?>">
        <?php foreach ( $tabs as $key => $tab ) : ?>
                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                        <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
                </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>

<?php endif; ?>
<?php endif; ?>
