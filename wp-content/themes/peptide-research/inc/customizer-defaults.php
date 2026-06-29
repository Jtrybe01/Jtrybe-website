<?php
/**
 * Sets sensible defaults so the storefront looks complete before any
 * content has been entered (placeholder copy, fallback hero, etc.).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function peptide_get_option( $key, $default = '' ) {
	$value = get_theme_mod( $key, $default );
	return $value ? $value : $default;
}
