<?php
/**
 * Enquiry form handler — emails the institute and redirects back.
 *
 * @package DataPeaks
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function datapeaks_handle_enquiry() {
	if ( ! isset( $_POST['dp_enquiry_nonce'] ) || ! wp_verify_nonce( $_POST['dp_enquiry_nonce'], 'dp_enquiry' ) ) {
		wp_safe_redirect( home_url( '/contact/?sent=error' ) );
		exit;
	}

	$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$course  = sanitize_text_field( wp_unslash( $_POST['course'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

	// Honeypot (bots fill hidden field).
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( home_url( '/contact/?sent=1' ) );
		exit;
	}

	if ( '' === $name || ! is_email( $email ) ) {
		wp_safe_redirect( home_url( '/contact/?sent=error' ) );
		exit;
	}

	$contact = datapeaks_contact();
	$to      = $contact['email'];
	$subject = sprintf( '[Website enquiry] %s — %s', $name, $course ? $course : 'General' );
	$body    = "New enquiry from the DataPeaks website:\n\n"
		. "Name: {$name}\n"
		. "Email: {$email}\n"
		. "Phone/WhatsApp: {$phone}\n"
		. "Course: {$course}\n\n"
		. "Message:\n{$message}\n";
	$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>' );

	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( home_url( '/contact/?sent=1' ) );
	exit;
}
add_action( 'admin_post_nopriv_dp_enquiry', 'datapeaks_handle_enquiry' );
add_action( 'admin_post_dp_enquiry', 'datapeaks_handle_enquiry' );
