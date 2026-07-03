<?php
/**
 * One-time content seeder — runs when the theme is activated.
 * Creates the 6 courses, 12 weekly projects, and the site pages/menu,
 * so the site matches the approved prototype out of the box.
 *
 * @package DataPeaks
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function datapeaks_after_switch() {
	datapeaks_register_cpts();
	datapeaks_seed_content();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'datapeaks_after_switch' );

function datapeaks_seed_content() {
	if ( get_option( 'datapeaks_seeded' ) ) {
		return;
	}

	// --- Courses ---
	$i = 0;
	foreach ( datapeaks_default_courses() as $c ) {
		if ( get_page_by_path( $c['slug'], OBJECT, 'course' ) ) { $i++; continue; }
		$id = wp_insert_post( array(
			'post_type'    => 'course',
			'post_status'  => 'publish',
			'post_title'   => $c['name'],
			'post_name'    => $c['slug'],
			'post_content' => $c['summary'],
			'menu_order'   => $i++,
		) );
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_dp_code', $c['code'] );
			update_post_meta( $id, '_dp_color', $c['color'] );
			update_post_meta( $id, '_dp_tagline', $c['tagline'] );
			update_post_meta( $id, '_dp_summary', $c['summary'] );
			update_post_meta( $id, '_dp_tools', wp_json_encode( $c['tools'] ) );
			update_post_meta( $id, '_dp_outcomes', wp_json_encode( $c['outcomes'] ) );
			update_post_meta( $id, '_dp_levels', wp_json_encode( $c['levels'] ) );
		}
	}

	// --- Weekly projects ---
	foreach ( datapeaks_default_projects() as $p ) {
		$id = wp_insert_post( array(
			'post_type'   => 'project',
			'post_status' => 'publish',
			'post_title'  => $p['project'],
		) );
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_dp_week', $p['week'] );
			update_post_meta( $id, '_dp_date', $p['date'] );
			update_post_meta( $id, '_dp_course', $p['course'] );
			update_post_meta( $id, '_dp_level', $p['level'] );
			update_post_meta( $id, '_dp_tools', wp_json_encode( $p['tools'] ) );
		}
	}

	// --- Pages ---
	$home    = datapeaks_ensure_page( 'Home', 'home', '', 'front-page.php' );
	$weekly  = datapeaks_ensure_page( 'Weekly Log', 'weekly-log', '', 'page-weekly-log.php' );
	$about   = datapeaks_ensure_page( 'About', 'about', '', 'page-about.php' );
	$contact = datapeaks_ensure_page( 'Contact', 'contact', '', 'page-contact.php' );
	$privacy = datapeaks_ensure_page( 'Privacy Policy', 'privacy-policy', datapeaks_privacy_content(), '' );
	$terms   = datapeaks_ensure_page( 'Terms of Use', 'terms', datapeaks_terms_content(), '' );

	if ( $home ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home );
	}
	if ( $privacy ) {
		update_option( 'wp_page_for_privacy_policy', $privacy );
	}

	// --- Primary menu ---
	datapeaks_seed_menu();

	update_option( 'datapeaks_seeded', 1 );
}

/** Create a page if one with the slug doesn't exist. Returns ID. */
function datapeaks_ensure_page( $title, $slug, $content = '', $template = '' ) {
	$existing = get_page_by_path( $slug );
	if ( $existing ) {
		return $existing->ID;
	}
	$id = wp_insert_post( array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_content' => $content,
	) );
	if ( $id && ! is_wp_error( $id ) && $template ) {
		update_post_meta( $id, '_wp_page_template', $template );
	}
	return ( $id && ! is_wp_error( $id ) ) ? $id : 0;
}

/** Build the primary navigation menu. */
function datapeaks_seed_menu() {
	$name = 'Primary';
	$menu = wp_get_nav_menu_object( $name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $name );
	} else {
		$menu_id = $menu->term_id;
	}
	if ( is_wp_error( $menu_id ) ) { return; }

	// Only seed items once.
	if ( ! wp_get_nav_menu_items( $menu_id ) ) {
		$add = function( $title, $url ) use ( $menu_id ) {
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'  => $title,
				'menu-item-url'    => $url,
				'menu-item-status' => 'publish',
				'menu-item-type'   => 'custom',
			) );
		};
		$add( 'Home', home_url( '/' ) );
		$add( 'Courses', get_post_type_archive_link( 'course' ) ?: home_url( '/courses/' ) );
		$add( 'Weekly Log', home_url( '/weekly-log/' ) );
		$add( 'About', home_url( '/about/' ) );
		$add( 'Contact', home_url( '/contact/' ) );
	}

	$locations = get_theme_mod( 'nav_menu_locations' );
	$locations = is_array( $locations ) ? $locations : array();
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

/* Legal copy (mirrors the prototype). */
function datapeaks_privacy_content() {
	return "DataPeaks Solutions respects your privacy. This policy explains what information we collect when you use our website or enquire about our programs, and how we use and protect it.\n\n"
		. "We collect the enquiry details you provide (name, email, phone/WhatsApp, course of interest, message) and basic usage analytics. We use this to respond to enquiries, improve our programs, and (with your consent) send updates. We do not sell your personal information.\n\n"
		. "Public project code uses only open-source or publicly available datasets; we never publish proprietary student data or paid-course materials. To access, correct, or delete your data, email info@datapeakssolutions.com.";
}

function datapeaks_terms_content() {
	return "By accessing datapeakssolutions.com and using our programs, you agree to these terms.\n\n"
		. "Level 1 of every course is free. Levels 2 and 3 are paid programs; access, fees and refund terms are shared at enrollment. Course materials and the DataPeaks name are our property; paid materials may not be resold or redistributed.\n\n"
		. "Our programs are placement-focused but we do not guarantee employment or specific outcomes. We may update these terms from time to time. Questions: info@datapeakssolutions.com.";
}
