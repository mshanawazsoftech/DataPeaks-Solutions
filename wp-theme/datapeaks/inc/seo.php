<?php
/**
 * SEO — favicons, theme-color, Open Graph / Twitter, JSON-LD.
 *
 * @package DataPeaks
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function datapeaks_head() {
	$img = DATAPEAKS_URI . '/assets/img/og-image.png';
	$title = wp_get_document_title();
	$desc  = get_bloginfo( 'description' );
	if ( is_singular() ) {
		$excerpt = get_the_excerpt();
		if ( $excerpt ) { $desc = $excerpt; }
	}
	$url = home_url( add_query_arg( array(), $GLOBALS['wp']->request ? '/' . $GLOBALS['wp']->request . '/' : '/' ) );

	echo "\n<!-- DataPeaks head -->\n";
	echo '<meta name="theme-color" content="#060b18">' . "\n";
	echo '<link rel="icon" type="image/svg+xml" href="' . esc_url( DATAPEAKS_URI . '/assets/img/favicon.svg' ) . '">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( DATAPEAKS_URI . '/assets/img/apple-touch-icon.png' ) . '">' . "\n";

	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:site_name" content="DataPeaks Solutions">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:image" content="' . esc_url( $img ) . '">' . "\n";
	echo '<meta property="og:image:width" content="1200">' . "\n";
	echo '<meta property="og:image:height" content="630">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta name="twitter:image" content="' . esc_url( $img ) . '">' . "\n";

	if ( is_front_page() ) {
		$c = datapeaks_contact();
		$ld = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'EducationalOrganization',
			'name'        => 'DataPeaks Solutions',
			'url'         => home_url( '/' ),
			'logo'        => DATAPEAKS_URI . '/assets/img/logo-mark.svg',
			'image'       => $img,
			'description' => 'Data & AI training institute in Hyderabad with a pharma & life sciences focus. Project-first learning. Level 1 free.',
			'email'       => $c['email'],
			'telephone'   => '+91-75698-41833',
			'address'     => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => 'Ghouse Nagar, Bandlaguda, Chandrayangutta',
				'addressLocality' => 'Hyderabad',
				'addressRegion'   => 'Telangana',
				'addressCountry'  => 'IN',
			),
			'sameAs'      => wp_list_pluck( datapeaks_social(), 'url' ),
		);
		echo '<script type="application/ld+json">' . wp_json_encode( $ld ) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'datapeaks_head', 5 );
