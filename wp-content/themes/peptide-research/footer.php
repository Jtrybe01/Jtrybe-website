<?php
/**
 * Footer template.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</main>

<footer class="site-footer" data-reveal>
	<div class="container site-footer__grid">
		<div class="site-footer__brand">
			<span class="site-brand__text"><?php bloginfo( 'name' ); ?></span>
			<p><?php esc_html_e( 'Pharmaceutical-grade peptides synthesized, tested, and shipped for qualified laboratory research.', 'peptide-research' ); ?></p>
		</div>

		<nav class="site-footer__nav" aria-label="<?php esc_attr_e( 'Footer', 'peptide-research' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'site-footer__list',
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

		<div class="site-footer__contact">
			<p><?php esc_html_e( 'Need a custom synthesis or bulk research order?', 'peptide-research' ); ?></p>
			<a class="btn btn--ghost" href="mailto:research@example.com">research@example.com</a>
		</div>
	</div>

	<div class="container">
		<?php peptide_research_disclaimer( 'general' ); ?>
		<p class="site-footer__copy">&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'peptide-research' ); ?></p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
