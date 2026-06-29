<?php
/**
 * Front page: hero, trust strip, featured research lines, CTA.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="hero" data-reveal>
	<div class="container hero__grid">
		<div class="hero__copy">
			<p class="eyebrow"><?php esc_html_e( 'Research-Grade Peptides', 'peptide-research' ); ?></p>
			<h1><?php esc_html_e( 'Precision peptides, verified for the lab.', 'peptide-research' ); ?></h1>
			<p class="hero__lede"><?php esc_html_e( 'Every batch is synthesized above 99% purity, third-party HPLC/MS tested, and shipped cold-chain with a certificate of analysis attached. Built for researchers who can\'t afford to guess.', 'peptide-research' ); ?></p>
			<div class="hero__actions">
				<a class="btn btn--primary" href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'shop' ) : '#shop' ); ?>">
					<?php esc_html_e( 'Browse Catalog', 'peptide-research' ); ?>
					<?php peptide_icon( 'arrow' ); ?>
				</a>
				<a class="btn btn--ghost" href="#coa"><?php esc_html_e( 'View Sample COA', 'peptide-research' ); ?></a>
			</div>
			<ul class="hero__stats">
				<li><strong>99.2%</strong><span><?php esc_html_e( 'Avg. HPLC Purity', 'peptide-research' ); ?></span></li>
				<li><strong>3rd-Party</strong><span><?php esc_html_e( 'Lab Verified', 'peptide-research' ); ?></span></li>
				<li><strong>&minus;20&deg;C</strong><span><?php esc_html_e( 'Cold-Chain Shipping', 'peptide-research' ); ?></span></li>
			</ul>
		</div>
		<div class="hero__visual" aria-hidden="true">
			<div class="hero__vial hero__vial--a"></div>
			<div class="hero__vial hero__vial--b"></div>
			<div class="hero__grid-lines"></div>
		</div>
	</div>
</section>

<section class="trust-strip" data-reveal>
	<div class="container trust-strip__grid">
		<div class="trust-strip__item">
			<?php peptide_icon( 'flask' ); ?>
			<p><?php esc_html_e( 'HPLC + Mass Spec tested every batch', 'peptide-research' ); ?></p>
		</div>
		<div class="trust-strip__item">
			<?php peptide_icon( 'document' ); ?>
			<p><?php esc_html_e( 'COA shipped with every order', 'peptide-research' ); ?></p>
		</div>
		<div class="trust-strip__item">
			<?php peptide_icon( 'snowflake' ); ?>
			<p><?php esc_html_e( 'Insulated, cold-chain fulfillment', 'peptide-research' ); ?></p>
		</div>
	</div>
</section>

<?php if ( class_exists( 'WooCommerce' ) ) : ?>
<section class="featured-products" data-reveal>
	<div class="container">
		<div class="section-heading">
			<p class="eyebrow"><?php esc_html_e( 'Catalog', 'peptide-research' ); ?></p>
			<h2><?php esc_html_e( 'Featured research lines', 'peptide-research' ); ?></h2>
		</div>
		<?php echo do_shortcode( '[products limit="6" columns="3" orderby="popularity"]' ); ?>
	</div>
</section>
<?php endif; ?>

<section class="science-band" id="coa" data-reveal>
	<div class="container science-band__grid">
		<div class="science-band__copy">
			<p class="eyebrow"><?php esc_html_e( 'Transparency', 'peptide-research' ); ?></p>
			<h2><?php esc_html_e( 'Every vial is traceable to its test data.', 'peptide-research' ); ?></h2>
			<p><?php esc_html_e( 'Scan the batch QR code on any vial to pull the exact HPLC trace, mass spec result, and endotoxin screen for that lot &mdash; not a generic spec sheet.', 'peptide-research' ); ?></p>
			<a class="btn btn--ghost" href="#"><?php esc_html_e( 'Download Sample COA (PDF)', 'peptide-research' ); ?></a>
		</div>
		<div class="science-band__panel" aria-hidden="true">
			<div class="data-line" style="--w:92%"></div>
			<div class="data-line" style="--w:78%"></div>
			<div class="data-line" style="--w:99%"></div>
			<div class="data-line" style="--w:64%"></div>
		</div>
	</div>
</section>

<section class="cta-band" data-reveal>
	<div class="container cta-band__inner">
		<h2><?php esc_html_e( 'Ordering for a lab or institution?', 'peptide-research' ); ?></h2>
		<p><?php esc_html_e( 'Get volume pricing, NET terms, and a dedicated account contact.', 'peptide-research' ); ?></p>
		<a class="btn btn--primary" href="mailto:research@example.com"><?php esc_html_e( 'Talk to Research Sales', 'peptide-research' ); ?></a>
	</div>
</section>

<?php
get_footer();
