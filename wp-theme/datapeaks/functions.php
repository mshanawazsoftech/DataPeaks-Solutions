<?php
/**
 * DataPeaks Solutions theme — setup, assets, includes.
 *
 * @package DataPeaks
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'DATAPEAKS_VERSION', '1.0.0' );
define( 'DATAPEAKS_DIR', get_template_directory() );
define( 'DATAPEAKS_URI', get_template_directory_uri() );

/* ---------------------------------------------------------------------
 * Theme setup
 * ------------------------------------------------------------------- */
function datapeaks_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'datapeaks' ),
	) );
}
add_action( 'after_setup_theme', 'datapeaks_setup' );

/* ---------------------------------------------------------------------
 * Assets
 * ------------------------------------------------------------------- */
function datapeaks_assets() {
	// Fonts
	wp_enqueue_style(
		'datapeaks-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap',
		array(),
		null
	);

	// Design system (the prototype stylesheet)
	wp_enqueue_style(
		'datapeaks-styles',
		DATAPEAKS_URI . '/assets/css/styles.css',
		array( 'datapeaks-fonts' ),
		DATAPEAKS_VERSION
	);

	// Interactions
	wp_enqueue_script(
		'datapeaks-theme',
		DATAPEAKS_URI . '/assets/js/theme.js',
		array(),
		DATAPEAKS_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'datapeaks_assets' );

/* ---------------------------------------------------------------------
 * Includes
 * ------------------------------------------------------------------- */
// Presentation layer — always loaded.
require_once DATAPEAKS_DIR . '/inc/helpers.php';        // colors, badges, fetchers, social
require_once DATAPEAKS_DIR . '/inc/seo.php';            // OG / Twitter / JSON-LD / favicons
require_once DATAPEAKS_DIR . '/inc/contact.php';        // enquiry form handler

// Content engine. If the "DataPeaks Core" plugin is active it owns the courses,
// projects and seeder (single source of truth, theme-independent). If the plugin
// is not installed, the theme registers them itself so the site is fully
// functional standalone.
if ( ! defined( 'DATAPEAKS_CORE' ) ) {
	require_once DATAPEAKS_DIR . '/inc/data.php';   // default content arrays
	require_once DATAPEAKS_DIR . '/inc/cpt.php';    // course + project CPTs
	require_once DATAPEAKS_DIR . '/inc/meta.php';   // meta boxes
	require_once DATAPEAKS_DIR . '/inc/seed.php';   // one-time content seeder
}

/** Gentle admin hint recommending the companion plugin (dismissible, non-blocking). */
function datapeaks_plugin_hint() {
	if ( defined( 'DATAPEAKS_CORE' ) || ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	if ( get_user_meta( get_current_user_id(), 'datapeaks_hint_dismissed', true ) ) {
		return;
	}
	echo '<div class="notice notice-info is-dismissible"><p><strong>DataPeaks:</strong> '
		. esc_html__( 'The site is fully working. For best practice, install the "DataPeaks Core" plugin so your Courses & Weekly Log stay independent of the theme.', 'datapeaks' )
		. '</p></div>';
}
add_action( 'admin_notices', 'datapeaks_plugin_hint' );

/* ---------------------------------------------------------------------
 * Body classes + small helpers
 * ------------------------------------------------------------------- */
function datapeaks_body_class( $classes ) {
	$classes[] = 'datapeaks';
	return $classes;
}
add_filter( 'body_class', 'datapeaks_body_class' );

/** Fallback menu if none assigned. */
function datapeaks_fallback_menu() {
	$items = array(
		home_url( '/' )            => __( 'Home', 'datapeaks' ),
		home_url( '/courses/' )    => __( 'Courses', 'datapeaks' ),
		home_url( '/weekly-log/' ) => __( 'Weekly Log', 'datapeaks' ),
		home_url( '/about/' )      => __( 'About', 'datapeaks' ),
		home_url( '/contact/' )    => __( 'Contact', 'datapeaks' ),
	);
	echo '<ul class="nav-links">';
	foreach ( $items as $url => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}
