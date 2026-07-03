<?php
/**
 * Plugin Name:       DataPeaks Core
 * Plugin URI:        https://datapeakssolutions.com
 * Description:       Content engine for DataPeaks Solutions — registers the Courses and Weekly Projects, their editing screens, and seeds the default content. Keeping this in a plugin means your course/log data is independent of the active theme.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            DataPeaks Solutions
 * Author URI:        https://datapeakssolutions.com
 * License:           MIT
 * Text Domain:       datapeaks-core
 *
 * @package DataPeaksCore
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Marker constant. The DataPeaks theme checks for this: when the plugin is
 * active it defers CPT/meta/seed registration to the plugin (single source of
 * truth). When the plugin is absent the theme registers them itself, so the
 * site works either way.
 */
define( 'DATAPEAKS_CORE', '1.0.0' );
define( 'DATAPEAKS_CORE_DIR', plugin_dir_path( __FILE__ ) );

require_once DATAPEAKS_CORE_DIR . 'inc/data.php';  // default courses / projects / faqs / social / contact
require_once DATAPEAKS_CORE_DIR . 'inc/cpt.php';   // Course + Project CPTs (hooks init)
require_once DATAPEAKS_CORE_DIR . 'inc/meta.php';  // admin meta boxes
require_once DATAPEAKS_CORE_DIR . 'inc/seed.php';  // seeder functions

/** On activation: register CPTs, seed content + pages + menu, flush rewrites. */
function datapeaks_core_activate() {
	if ( function_exists( 'datapeaks_register_cpts' ) ) {
		datapeaks_register_cpts();
	}
	if ( function_exists( 'datapeaks_seed_content' ) ) {
		datapeaks_seed_content();
	}
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'datapeaks_core_activate' );

/** On deactivation: clean rewrite rules (content stays in the database). */
function datapeaks_core_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'datapeaks_core_deactivate' );
