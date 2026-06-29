<?php
/**
 * WooCommerce content wrapper so shop/archive/single pages inherit
 * the theme's header, footer, and page chrome.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<div class="container woocommerce-page-wrap" data-reveal>
	<?php woocommerce_content(); ?>
</div>
<?php
get_footer();
