<?php
/**
 * Theme setup, asset loading, and WooCommerce integration for Peptide Research.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PEPTIDE_THEME_VERSION', '1.0.0' );

/**
 * Theme support.
 */
function peptide_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'peptide-research' ),
			'footer'  => __( 'Footer Menu', 'peptide-research' ),
		)
	);
}
add_action( 'after_setup_theme', 'peptide_theme_setup' );

/**
 * Declare WooCommerce compatibility.
 */
function peptide_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'peptide_woocommerce_support' );

/**
 * Enqueue styles and scripts.
 */
function peptide_enqueue_assets() {
	wp_enqueue_style(
		'peptide-fonts',
		'https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:wght@400;700&family=Crimson+Pro:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'peptide-main', get_template_directory_uri() . '/assets/css/main.css', array(), PEPTIDE_THEME_VERSION );

	wp_enqueue_script( 'peptide-animations', get_template_directory_uri() . '/assets/js/animations.js', array(), PEPTIDE_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'peptide_enqueue_assets' );

/**
 * Register widget areas.
 */
function peptide_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Shop Sidebar', 'peptide-research' ),
			'id'            => 'shop-sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'peptide_widgets_init' );

/**
 * Research-use-only disclaimer banner, shown sitewide above the footer
 * and reinforced on every product/cart/checkout touchpoint.
 */
function peptide_research_disclaimer( $context = 'general' ) {
	$copy = array(
		'general' => __( 'All products listed on this site are sold strictly for laboratory and research use. They are not intended for human or animal consumption, diagnostic use, or therapeutic use of any kind.', 'peptide-research' ),
		'product' => __( 'Research Use Only (RUO): This product is not a drug, food, or cosmetic and is not intended for human consumption. Not for diagnostic or therapeutic use. By purchasing, you confirm you are a qualified researcher or institution.', 'peptide-research' ),
		'cart'    => __( 'By completing this order you confirm every item is intended for in-vitro laboratory research only, not for human or animal use.', 'peptide-research' ),
	);

	$message = isset( $copy[ $context ] ) ? $copy[ $context ] : $copy['general'];
	?>
	<div class="ruo-disclaimer ruo-disclaimer--<?php echo esc_attr( $context ); ?>" role="note">
		<svg class="ruo-disclaimer__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
			<path d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
		<p><strong><?php esc_html_e( 'Research Use Only.', 'peptide-research' ); ?></strong> <?php echo esc_html( $message ); ?></p>
	</div>
	<?php
}

/**
 * Inject the disclaimer just above the WooCommerce single-add-to-cart form
 * and at the top of the cart/checkout totals.
 */
add_action( 'woocommerce_single_product_summary', function () {
	peptide_research_disclaimer( 'product' );
}, 25 );

add_action( 'woocommerce_before_cart', function () {
	peptide_research_disclaimer( 'cart' );
} );

add_action( 'woocommerce_before_checkout_form', function () {
	peptide_research_disclaimer( 'cart' );
}, 5 );

/**
 * Require an explicit research-use acknowledgement checkbox at checkout.
 */
add_action( 'woocommerce_review_order_before_submit', function () {
	?>
	<p class="form-row ruo-acknowledgement">
		<label for="ruo_acknowledge">
			<input type="checkbox" id="ruo_acknowledge" name="ruo_acknowledge" required />
			<?php esc_html_e( 'I confirm these products are for laboratory research use only and will not be used for human or animal consumption.', 'peptide-research' ); ?>
		</label>
	</p>
	<?php
} );

add_action( 'woocommerce_checkout_process', function () {
	if ( empty( $_POST['ruo_acknowledge'] ) ) {
		wc_add_notice( __( 'Please confirm the Research Use Only acknowledgement before placing your order.', 'peptide-research' ), 'error' );
	}
} );

/**
 * Trust badges shown under the add-to-cart button.
 */
function peptide_trust_badges() {
	$badges = array(
		array(
			'label' => __( 'Third-Party Tested', 'peptide-research' ),
			'icon'  => 'flask',
		),
		array(
			'label' => __( 'COA With Every Batch', 'peptide-research' ),
			'icon'  => 'document',
		),
		array(
			'label' => __( 'Cold-Chain Shipping', 'peptide-research' ),
			'icon'  => 'snowflake',
		),
	);
	?>
	<ul class="trust-badges">
		<?php foreach ( $badges as $badge ) : ?>
			<li class="trust-badges__item">
				<?php peptide_icon( $badge['icon'] ); ?>
				<span><?php echo esc_html( $badge['label'] ); ?></span>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}
add_action( 'woocommerce_single_product_summary', 'peptide_trust_badges', 26 );

/**
 * Minimal inline SVG icon set (no emoji icons, per design system rules).
 */
function peptide_icon( $name ) {
	$icons = array(
		'flask'     => '<path d="M9 2v6.2L4.6 16a2 2 0 0 0 1.7 3h11.4a2 2 0 0 0 1.7-3L15 8.2V2M7 2h10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
		'document'  => '<path d="M7 3h7l3 3v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm7 0v3h3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
		'snowflake' => '<path d="M12 2v20M5 6.3 19 17.7M19 6.3 5 17.7M2 12h20" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" fill="none"/>',
		'arrow'     => '<path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
	);

	if ( ! isset( $icons[ $name ] ) ) {
		return;
	}

	printf(
		'<svg class="icon icon--%1$s" width="22" height="22" viewBox="0 0 24 24" aria-hidden="true">%2$s</svg>',
		esc_attr( $name ),
		$icons[ $name ] // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline icon paths.
	);
}

/**
 * Custom product loop columns to suit the clinical card layout.
 */
add_filter( 'loop_shop_columns', function () {
	return 3;
} );

/**
 * Fallback nav when no menu has been assigned yet.
 */
function peptide_default_nav() {
	$items = array(
		'shop'    => __( 'Shop Peptides', 'peptide-research' ),
		'science' => __( 'The Science', 'peptide-research' ),
		'coa'     => __( 'Certificates of Analysis', 'peptide-research' ),
		'contact' => __( 'Contact', 'peptide-research' ),
	);
	echo '<ul class="site-nav__list">';
	foreach ( $items as $slug => $label ) {
		printf( '<li><a href="#%1$s">%2$s</a></li>', esc_attr( $slug ), esc_html( $label ) );
	}
	echo '</ul>';
}

require_once get_template_directory() . '/inc/customizer-defaults.php';
