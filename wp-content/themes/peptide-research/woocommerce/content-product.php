<?php
/**
 * Custom product card for the clinical catalog grid.
 *
 * Overrides woocommerce/templates/content-product.php
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'product-card', $product ); ?> data-reveal>
	<a class="product-card__media" href="<?php the_permalink(); ?>">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'medium' );
		} else {
			echo '<div class="product-card__placeholder" aria-hidden="true"></div>';
		}
		?>
		<?php if ( $product->is_on_sale() ) : ?>
			<span class="product-card__badge"><?php esc_html_e( 'Sale', 'peptide-research' ); ?></span>
		<?php endif; ?>
	</a>

	<div class="product-card__body">
		<p class="product-card__purity">
			<?php
			$purity = $product->get_attribute( 'purity' );
			echo esc_html( $purity ? $purity . ' ' . __( 'Purity', 'peptide-research' ) : __( 'Research Grade', 'peptide-research' ) );
			?>
		</p>
		<h3 class="product-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<div class="product-card__price"><?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
		<?php woocommerce_template_loop_add_to_cart(); ?>
	</div>
</li>
