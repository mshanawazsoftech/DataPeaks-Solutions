<?php
/**
 * Meta boxes for course + project editing in wp-admin.
 *
 * @package DataPeaks
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ------------------------- Register boxes ------------------------- */
function datapeaks_meta_boxes() {
	add_meta_box( 'dp_course', __( 'Course details', 'datapeaks' ), 'datapeaks_course_box', 'course', 'normal', 'high' );
	add_meta_box( 'dp_project', __( 'Project details', 'datapeaks' ), 'datapeaks_project_box', 'project', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'datapeaks_meta_boxes' );

/* ------------------------- Course box ----------------------------- */
function datapeaks_course_box( $post ) {
	wp_nonce_field( 'dp_course_save', 'dp_course_nonce' );
	$code     = get_post_meta( $post->ID, '_dp_code', true );
	$color    = get_post_meta( $post->ID, '_dp_color', true );
	$tagline  = get_post_meta( $post->ID, '_dp_tagline', true );
	$summary  = get_post_meta( $post->ID, '_dp_summary', true );
	$tools    = json_decode( (string) get_post_meta( $post->ID, '_dp_tools', true ), true );
	$outcomes = json_decode( (string) get_post_meta( $post->ID, '_dp_outcomes', true ), true );
	$levels   = get_post_meta( $post->ID, '_dp_levels', true );
	$levels_pretty = $levels ? wp_json_encode( json_decode( $levels, true ), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) : '';
	$colors   = array( 'cyan', 'emerald', 'mle', 'de', 'violet', 'pink' );

	echo '<p><label><strong>Code</strong> (e.g. CDA)<br><input type="text" name="dp_code" value="' . esc_attr( $code ) . '" class="widefat"></label></p>';
	echo '<p><label><strong>Badge colour</strong><br><select name="dp_color">';
	foreach ( $colors as $c ) {
		printf( '<option value="%s"%s>%s</option>', esc_attr( $c ), selected( $color, $c, false ), esc_html( $c ) );
	}
	echo '</select></label></p>';
	echo '<p><label><strong>Tagline</strong><br><input type="text" name="dp_tagline" value="' . esc_attr( $tagline ) . '" class="widefat"></label></p>';
	echo '<p><label><strong>Summary</strong><br><textarea name="dp_summary" rows="2" class="widefat">' . esc_textarea( $summary ) . '</textarea></label></p>';
	echo '<p><label><strong>Tools</strong> (comma separated)<br><input type="text" name="dp_tools" value="' . esc_attr( is_array( $tools ) ? implode( ', ', $tools ) : '' ) . '" class="widefat"></label></p>';
	echo '<p><label><strong>Outcomes</strong> (one per line)<br><textarea name="dp_outcomes" rows="4" class="widefat">' . esc_textarea( is_array( $outcomes ) ? implode( "\n", $outcomes ) : '' ) . '</textarea></label></p>';
	echo '<p><label><strong>Levels</strong> (JSON — Beginner/Intermediate/Advanced, each a list of {wk,title,desc,tools})<br><textarea name="dp_levels" rows="10" class="widefat code" style="font-family:monospace">' . esc_textarea( $levels_pretty ) . '</textarea></label></p>';
}

function datapeaks_save_course( $post_id ) {
	if ( ! isset( $_POST['dp_course_nonce'] ) || ! wp_verify_nonce( $_POST['dp_course_nonce'], 'dp_course_save' ) ) { return; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	update_post_meta( $post_id, '_dp_code', sanitize_text_field( wp_unslash( $_POST['dp_code'] ?? '' ) ) );
	update_post_meta( $post_id, '_dp_color', sanitize_text_field( wp_unslash( $_POST['dp_color'] ?? 'cyan' ) ) );
	update_post_meta( $post_id, '_dp_tagline', sanitize_text_field( wp_unslash( $_POST['dp_tagline'] ?? '' ) ) );
	update_post_meta( $post_id, '_dp_summary', sanitize_textarea_field( wp_unslash( $_POST['dp_summary'] ?? '' ) ) );

	$tools = array_filter( array_map( 'trim', explode( ',', wp_unslash( $_POST['dp_tools'] ?? '' ) ) ) );
	update_post_meta( $post_id, '_dp_tools', wp_json_encode( array_values( $tools ) ) );

	$outcomes = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', wp_unslash( $_POST['dp_outcomes'] ?? '' ) ) ) );
	update_post_meta( $post_id, '_dp_outcomes', wp_json_encode( array_values( $outcomes ) ) );

	$levels_raw = trim( (string) wp_unslash( $_POST['dp_levels'] ?? '' ) );
	if ( '' !== $levels_raw ) {
		$decoded = json_decode( $levels_raw, true );
		if ( JSON_ERROR_NONE === json_last_error() ) {
			update_post_meta( $post_id, '_dp_levels', wp_json_encode( $decoded ) );
		}
	} else {
		update_post_meta( $post_id, '_dp_levels', '' );
	}
}
add_action( 'save_post_course', 'datapeaks_save_course' );

/* ------------------------- Project box ---------------------------- */
function datapeaks_project_box( $post ) {
	wp_nonce_field( 'dp_project_save', 'dp_project_nonce' );
	$week   = get_post_meta( $post->ID, '_dp_week', true );
	$date   = get_post_meta( $post->ID, '_dp_date', true );
	$course = get_post_meta( $post->ID, '_dp_course', true );
	$level  = get_post_meta( $post->ID, '_dp_level', true );
	$tools  = json_decode( (string) get_post_meta( $post->ID, '_dp_tools', true ), true );
	$codes  = array( 'CDA', 'CDS', 'MLE', 'DE', 'GAI', 'AAI' );

	echo '<p><label><strong>Week #</strong><br><input type="number" name="dp_week" value="' . esc_attr( $week ) . '" min="1"></label></p>';
	echo '<p><label><strong>Date</strong> (e.g. Jul 7, 2026)<br><input type="text" name="dp_date" value="' . esc_attr( $date ) . '" class="widefat"></label></p>';
	echo '<p><label><strong>Course</strong><br><select name="dp_course">';
	foreach ( $codes as $c ) {
		printf( '<option value="%s"%s>%s</option>', esc_attr( $c ), selected( $course, $c, false ), esc_html( $c ) );
	}
	echo '</select></label></p>';
	echo '<p><label><strong>Level</strong> (e.g. L1)<br><input type="text" name="dp_level" value="' . esc_attr( $level ? $level : 'L1' ) . '"></label></p>';
	echo '<p><label><strong>Tools</strong> (comma separated)<br><input type="text" name="dp_tools" value="' . esc_attr( is_array( $tools ) ? implode( ', ', $tools ) : '' ) . '" class="widefat"></label></p>';
}

function datapeaks_save_project( $post_id ) {
	if ( ! isset( $_POST['dp_project_nonce'] ) || ! wp_verify_nonce( $_POST['dp_project_nonce'], 'dp_project_save' ) ) { return; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	update_post_meta( $post_id, '_dp_week', (int) ( $_POST['dp_week'] ?? 0 ) );
	update_post_meta( $post_id, '_dp_date', sanitize_text_field( wp_unslash( $_POST['dp_date'] ?? '' ) ) );
	update_post_meta( $post_id, '_dp_course', sanitize_text_field( wp_unslash( $_POST['dp_course'] ?? '' ) ) );
	update_post_meta( $post_id, '_dp_level', sanitize_text_field( wp_unslash( $_POST['dp_level'] ?? 'L1' ) ) );

	$tools = array_filter( array_map( 'trim', explode( ',', wp_unslash( $_POST['dp_tools'] ?? '' ) ) ) );
	update_post_meta( $post_id, '_dp_tools', wp_json_encode( array_values( $tools ) ) );
}
add_action( 'save_post_project', 'datapeaks_save_project' );
