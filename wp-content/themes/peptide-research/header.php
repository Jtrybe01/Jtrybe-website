<?php
/**
 * Header template.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#primary"><?php esc_html_e( 'Skip to content', 'peptide-research' ); ?></a>

<header class="site-header" data-reveal>
	<div class="container site-header__inner">
		<a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span class="site-brand__mark" aria-hidden="true">
				<svg width="28" height="28" viewBox="0 0 24 24" fill="none">
					<path d="M9 2v6.2L4.6 16a2 2 0 0 0 1.7 3h11.4a2 2 0 0 0 1.7-3L15 8.2V2M7 2h10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</span>
			<span class="site-brand__text">
				<?php bloginfo( 'name' ); ?>
			</span>
		</a>

		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'peptide-research' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'site-nav__list',
					'fallback_cb'    => 'peptide_default_nav',
				)
			);
			?>
		</nav>

		<div class="site-header__actions">
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<a class="header-icon-link" href="<?php echo esc_url( wc_get_account_endpoint_url( '' ) ); ?>" aria-label="<?php esc_attr_e( 'Account', 'peptide-research' ); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm-7 9a7 7 0 0 1 14 0" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
				</a>
				<a class="header-icon-link header-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'Cart', 'peptide-research' ); ?>">
					<svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M3 4h2l2.4 12.2a2 2 0 0 0 2 1.6h7.4a2 2 0 0 0 2-1.6L21 8H6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
					<span class="header-cart__count"><?php echo absint( WC()->cart ? WC()->cart->get_cart_contents_count() : 0 ); ?></span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</header>

<main id="primary" class="site-main">
