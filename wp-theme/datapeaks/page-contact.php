<?php
/**
 * Template Name: Contact
 *
 * @package DataPeaks
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$dp_contact = datapeaks_contact();
$sent = isset( $_GET['sent'] ) ? sanitize_text_field( wp_unslash( $_GET['sent'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
?>
<main id="main">
	<section class="page-hero">
		<div class="container">
			<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'datapeaks' ); ?></a> <span>/</span> <span><?php esc_html_e( 'Contact', 'datapeaks' ); ?></span></div>
			<span class="eyebrow"><?php esc_html_e( "Let's talk", 'datapeaks' ); ?></span>
			<h1><?php echo wp_kses_post( __( 'Enroll or <span class="gradient-text">ask us anything</span>', 'datapeaks' ) ); ?></h1>
			<p><?php esc_html_e( "Tell us your goal and we'll point you to the right track and level. Level 1 is always free to start.", 'datapeaks' ); ?></p>
		</div>
	</section>

	<section class="section--tight">
		<div class="container">
			<div class="grid" style="grid-template-columns:1.3fr .9fr;gap:2rem;align-items:start">
				<div class="card" style="padding:1.8rem">
					<?php if ( 'error' === $sent ) : ?>
						<div class="form-success" style="display:block;background:rgba(255,107,107,.12);border-color:rgba(255,107,107,.4);color:#ffc9c9" role="status"><?php esc_html_e( 'Sorry — please check your name and a valid email, then try again.', 'datapeaks' ); ?></div>
					<?php elseif ( '1' === $sent ) : ?>
						<div class="form-success" style="display:block" role="status"><?php esc_html_e( "✓ Thanks! Your enquiry has been sent. We'll be in touch shortly.", 'datapeaks' ); ?></div>
					<?php endif; ?>

					<form class="form" data-contact-form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
						<input type="hidden" name="action" value="dp_enquiry">
						<?php wp_nonce_field( 'dp_enquiry', 'dp_enquiry_nonce' ); ?>
						<div style="position:absolute;left:-5000px" aria-hidden="true"><label>Leave blank<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

						<div class="form-two">
							<div class="field">
								<label for="name"><?php esc_html_e( 'Full name', 'datapeaks' ); ?></label>
								<input id="name" name="name" type="text" placeholder="<?php esc_attr_e( 'Your name', 'datapeaks' ); ?>" autocomplete="name" required>
								<span class="err"></span>
							</div>
							<div class="field">
								<label for="email"><?php esc_html_e( 'Email', 'datapeaks' ); ?></label>
								<input id="email" name="email" type="email" placeholder="you@email.com" autocomplete="email" required>
								<span class="err"></span>
							</div>
						</div>
						<div class="form-two">
							<div class="field">
								<label for="phone"><?php esc_html_e( 'Phone / WhatsApp', 'datapeaks' ); ?></label>
								<input id="phone" name="phone" type="tel" placeholder="+91 …" autocomplete="tel">
								<span class="err"></span>
							</div>
							<div class="field">
								<label for="course"><?php esc_html_e( 'Interested course', 'datapeaks' ); ?></label>
								<select id="course" name="course">
									<option value=""><?php esc_html_e( 'Select a course…', 'datapeaks' ); ?></option>
									<?php foreach ( datapeaks_get_courses() as $c ) : ?>
										<option value="<?php echo esc_attr( $c['code'] ); ?>"><?php echo esc_html( $c['name'] . ' (' . $c['code'] . ')' ); ?></option>
									<?php endforeach; ?>
								</select>
								<span class="err"></span>
							</div>
						</div>
						<div class="field">
							<label for="message"><?php esc_html_e( 'Your goal', 'datapeaks' ); ?></label>
							<textarea id="message" name="message" rows="4" placeholder="<?php esc_attr_e( "e.g. I'm a fresher aiming for a data analyst role in pharma…", 'datapeaks' ); ?>"></textarea>
							<span class="err"></span>
						</div>
						<button class="btn btn--primary btn--block" type="submit"><?php esc_html_e( 'Send enquiry', 'datapeaks' ); ?></button>
						<p class="form-note"><?php esc_html_e( 'By sending, you agree to be contacted about DataPeaks programs. We never share your details.', 'datapeaks' ); ?></p>
					</form>
				</div>

				<aside class="stack">
					<div class="card stack">
						<h3><?php esc_html_e( 'Reach us directly', 'datapeaks' ); ?></h3>
						<a class="btn btn--gold btn--block" href="<?php echo esc_url( $dp_contact['whatsapp'] . '?text=' . rawurlencode( "Hi DataPeaks, I'm interested in your courses!" ) ); ?>" target="_blank" rel="noopener">&#128172; <?php esc_html_e( 'Chat on WhatsApp', 'datapeaks' ); ?></a>
						<a class="btn btn--ghost btn--block" href="mailto:<?php echo esc_attr( $dp_contact['email'] ); ?>">&#9993; <?php echo esc_html( $dp_contact['email'] ); ?></a>
						<a class="btn btn--ghost btn--block" href="tel:+917569841833">&#128222; <?php echo esc_html( $dp_contact['phone'] ); ?></a>
					</div>
					<div class="card stack">
						<h3><?php esc_html_e( 'Visit', 'datapeaks' ); ?></h3>
						<p>Ghouse Nagar, Bandlaguda,<br>Chandrayangutta, Hyderabad, India</p>
						<a class="tag" href="<?php echo esc_url( $dp_contact['maps'] ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Open in Maps', 'datapeaks' ); ?> &rarr;</a>
					</div>
					<div class="card stack">
						<h3><?php esc_html_e( 'Follow the weekly drop', 'datapeaks' ); ?></h3>
						<?php datapeaks_render_social(); ?>
					</div>
				</aside>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
