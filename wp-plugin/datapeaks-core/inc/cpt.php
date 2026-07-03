<?php
/**
 * Custom post types: course + project (weekly log).
 *
 * @package DataPeaks
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function datapeaks_register_cpts() {

	register_post_type( 'course', array(
		'labels' => array(
			'name'          => __( 'Courses', 'datapeaks' ),
			'singular_name' => __( 'Course', 'datapeaks' ),
			'add_new_item'  => __( 'Add New Course', 'datapeaks' ),
			'edit_item'     => __( 'Edit Course', 'datapeaks' ),
			'menu_name'     => __( 'Courses', 'datapeaks' ),
		),
		'public'        => true,
		'has_archive'   => 'courses',
		'menu_icon'     => 'dashicons-welcome-learn-more',
		'menu_position' => 20,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'rewrite'       => array( 'slug' => 'course', 'with_front' => false ),
		'show_in_rest'  => true,
	) );

	register_post_type( 'project', array(
		'labels' => array(
			'name'          => __( 'Weekly Projects', 'datapeaks' ),
			'singular_name' => __( 'Project', 'datapeaks' ),
			'add_new_item'  => __( 'Add New Project', 'datapeaks' ),
			'edit_item'     => __( 'Edit Project', 'datapeaks' ),
			'menu_name'     => __( 'Weekly Log', 'datapeaks' ),
		),
		'public'        => true,
		'has_archive'   => false,
		'menu_icon'     => 'dashicons-calendar-alt',
		'menu_position' => 21,
		'supports'      => array( 'title', 'editor' ),
		'rewrite'       => array( 'slug' => 'project', 'with_front' => false ),
		'show_in_rest'  => true,
	) );
}
add_action( 'init', 'datapeaks_register_cpts' );
