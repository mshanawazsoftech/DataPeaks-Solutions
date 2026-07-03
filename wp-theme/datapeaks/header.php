<?php
/**
 * Header — announcement bar, top social, primary nav.
 *
 * @package DataPeaks
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>
<a class="skip-link" href="#main">Skip to main content</a>

<div class="announce" role="region" aria-label="Announcement">
	<div class="container announce-inner">
		<span class="announce-msg">
			<span><?php echo wp_kses_post( __( 'Level 1 of every course is <strong>free</strong> — all concepts, no paywall.', 'datapeaks' ) ); ?></span>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'course' ) ?: home_url( '/courses/' ) ); ?>"><?php esc_html_e( 'Explore free courses', 'datapeaks' ); ?> <span aria-hidden="true">&rarr;</span></a>
		</span>
		<?php datapeaks_render_social( 'social--top' ); ?>
	</div>
</div>

<header class="site-header">
	<nav class="nav container" aria-label="<?php esc_attr_e( 'Primary', 'datapeaks' ); ?>">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img class="logo" src="<?php echo esc_url( DATAPEAKS_URI . '/assets/img/logo-mark.svg' ); ?>" alt="DataPeaks Solutions" width="40" height="40">
			<span class="brand-name">DataPeaks<small>Solutions</small></span>
		</a>
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'nav-links',
				'fallback_cb'    => 'datapeaks_fallback_menu',
			) );
		} else {
			datapeaks_fallback_menu();
		}
		?>
		<div class="nav-cta">
			<a class="btn btn--ghost btn--sm" href="https://youtube.com/@datapeakssolutions" target="_blank" rel="noopener">YouTube</a>
			<a class="btn btn--primary btn--sm" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Enroll', 'datapeaks' ); ?></a>
			<button class="nav-toggle" aria-label="<?php esc_attr_e( 'Menu', 'datapeaks' ); ?>" aria-expanded="false"><span></span></button>
		</div>
	</nav>
</header>
