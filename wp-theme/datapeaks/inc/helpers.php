<?php
/**
 * Helpers — colors, badges, content fetchers, social rendering.
 *
 * @package DataPeaks
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/** CSS colour variable for a course colour key. */
function datapeaks_color_var( $key ) {
	$map = array(
		'cyan'    => 'var(--cyan)',
		'emerald' => 'var(--emerald)',
		'mle'     => 'var(--blue)',
		'de'      => 'var(--gold)',
		'violet'  => 'var(--violet)',
		'pink'    => 'var(--pink)',
	);
	return isset( $map[ $key ] ) ? $map[ $key ] : 'var(--cyan)';
}

/** Badge class for a course code. */
function datapeaks_badge_class( $code ) {
	$map = array(
		'CDA' => 'badge--cda', 'CDS' => 'badge--cds', 'MLE' => 'badge--mle',
		'DE'  => 'badge--de',  'GAI' => 'badge--gai', 'AAI' => 'badge--aai',
	);
	$code = strtoupper( $code );
	return isset( $map[ $code ] ) ? $map[ $code ] : 'badge';
}

/** All courses — from the `course` CPT if populated, else defaults. */
function datapeaks_get_courses() {
	$posts = get_posts( array(
		'post_type'      => 'course',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order date',
		'order'          => 'ASC',
		'post_status'    => 'publish',
	) );

	if ( empty( $posts ) ) {
		return datapeaks_default_courses();
	}

	$out = array();
	foreach ( $posts as $p ) {
		$levels   = json_decode( (string) get_post_meta( $p->ID, '_dp_levels', true ), true );
		$tools    = json_decode( (string) get_post_meta( $p->ID, '_dp_tools', true ), true );
		$outcomes = json_decode( (string) get_post_meta( $p->ID, '_dp_outcomes', true ), true );
		$out[] = array(
			'id'       => $p->ID,
			'code'     => get_post_meta( $p->ID, '_dp_code', true ),
			'slug'     => $p->post_name,
			'name'     => get_the_title( $p ),
			'color'    => get_post_meta( $p->ID, '_dp_color', true ),
			'tagline'  => get_post_meta( $p->ID, '_dp_tagline', true ),
			'summary'  => get_post_meta( $p->ID, '_dp_summary', true ),
			'tools'    => is_array( $tools ) ? $tools : array(),
			'outcomes' => is_array( $outcomes ) ? $outcomes : array(),
			'levels'   => is_array( $levels ) ? $levels : array(),
		);
	}
	return $out;
}

/** One course by slug. */
function datapeaks_get_course_by_slug( $slug ) {
	foreach ( datapeaks_get_courses() as $c ) {
		if ( $c['slug'] === $slug ) {
			return $c;
		}
	}
	return null;
}

/** Weekly projects — from the `project` CPT if populated, else defaults. */
function datapeaks_get_projects() {
	$posts = get_posts( array(
		'post_type'      => 'project',
		'posts_per_page' => -1,
		'meta_key'       => '_dp_week',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
		'post_status'    => 'publish',
	) );

	if ( empty( $posts ) ) {
		return datapeaks_default_projects();
	}

	$out = array();
	foreach ( $posts as $p ) {
		$tools = json_decode( (string) get_post_meta( $p->ID, '_dp_tools', true ), true );
		$out[] = array(
			'week'    => (int) get_post_meta( $p->ID, '_dp_week', true ),
			'date'    => get_post_meta( $p->ID, '_dp_date', true ),
			'course'  => get_post_meta( $p->ID, '_dp_course', true ),
			'level'   => get_post_meta( $p->ID, '_dp_level', true ),
			'project' => get_the_title( $p ),
			'tools'   => is_array( $tools ) ? $tools : array(),
		);
	}
	return $out;
}

/** Permalink for a course (CPT if available, else prototype-style query). */
function datapeaks_course_link( $course ) {
	if ( ! empty( $course['id'] ) ) {
		return get_permalink( $course['id'] );
	}
	return esc_url( home_url( '/course/' . $course['slug'] . '/' ) );
}

/** Render the social pill row. Pass 'social--top' for the compact top bar. */
function datapeaks_render_social( $variant = '' ) {
	$class = trim( 'social ' . $variant );
	echo '<div class="' . esc_attr( $class ) . '" role="list" aria-label="Follow DataPeaks Solutions on social media">';
	foreach ( datapeaks_social() as $s ) {
		printf(
			'<a href="%s" target="_blank" rel="noopener" aria-label="%s (opens in a new tab)"><span class="si">%s</span><span class="sn">%s</span></a>',
			esc_url( $s['url'] ),
			esc_attr( $s['name'] ),
			$s['svg'], // trusted inline SVG
			esc_html( $s['name'] )
		);
	}
	echo '</div>';
}

/** Render a list of tool tags. */
function datapeaks_tool_tags( $tools ) {
	$out = '';
	foreach ( (array) $tools as $t ) {
		$out .= '<span class="tag">' . esc_html( $t ) . '</span>';
	}
	return $out;
}
