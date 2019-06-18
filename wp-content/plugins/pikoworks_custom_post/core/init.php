<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Load blog
 */
require_once PIKOWORKS_CUSTOM_POST_CORE.'post-type/blog/tags.php';
/**
 * Load brand
 */
require_once PIKOWORKS_CUSTOM_POST_CORE.'post-type/brand/brand.php';
require_once PIKOWORKS_CUSTOM_POST_CORE.'post-type/brand/category-image.php';

/**
 * Load Post type dynamics
 */

require_once PIKOWORKS_CUSTOM_POST_CORE.'post-type/shortcodes.php';