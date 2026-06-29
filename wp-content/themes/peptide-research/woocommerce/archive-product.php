<?php
/**
 * Shop / category archive shell with a clinical header band.
 *
 * Overrides woocommerce/templates/archive-product.php
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header( 'shop' );
?>

<header class="shop-header" data-reveal>
	<div class="container">
		<p class="eyebrow"><?php esc_html_e( 'Catalog', 'peptide-research' ); ?></p>
		<?php woocommerce_page_title(); ?>
		<?php do_action( 'woocommerce_archive_description' ); ?>
	</div>
</header>

<div class="container shop-content">
	<?php do_action( 'woocommerce_before_main_content' ); ?>

	<?php if ( woocommerce_product_loop() ) : ?>

		<?php
		do_action( 'woocommerce_before_shop_loop' );
		woocommerce_product_loop_start();

		if ( wc_get_loop_prop( 'total' ) ) {
			while ( have_posts() ) {
				the_post();
				do_action( 'woocommerce_shop_loop' );
				wc_get_template_part( 'content', 'product' );
			}
		}

		woocommerce_product_loop_end();
		do_action( 'woocommerce_after_shop_loop' );
		?>

	<?php else : ?>

		<?php do_action( 'woocommerce_no_products_found' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_main_content' ); ?>
</div>

<?php
get_footer( 'shop' );
