<?php
/**
 * Footer.
 *
 * @package DataPeaks
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$dp_contact = datapeaks_contact();
?>
<footer class="site-footer">
	<div class="container">
		<div class="footer-grid">
			<div>
				<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img class="logo" src="<?php echo esc_url( DATAPEAKS_URI . '/assets/img/logo-mark.svg' ); ?>" alt="DataPeaks Solutions" width="40" height="40">
					<span class="brand-name">DataPeaks<small>Solutions</small></span>
				</a>
				<p style="margin-top:1rem;max-width:34ch"><?php esc_html_e( 'A data analytics & AI training institute in Hyderabad with a pharma & life sciences specialization — project-first learning across data, ML and AI.', 'datapeaks' ); ?></p>
				<?php datapeaks_render_social(); ?>
			</div>
			<div>
				<h4><?php esc_html_e( 'Courses', 'datapeaks' ); ?></h4>
				<?php foreach ( datapeaks_get_courses() as $c ) : ?>
					<a href="<?php echo esc_url( datapeaks_course_link( $c ) ); ?>"><?php echo esc_html( $c['name'] ); ?></a>
				<?php endforeach; ?>
			</div>
			<div>
				<h4><?php esc_html_e( 'Explore', 'datapeaks' ); ?></h4>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'course' ) ?: home_url( '/courses/' ) ); ?>"><?php esc_html_e( 'All courses', 'datapeaks' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/weekly-log/' ) ); ?>"><?php esc_html_e( 'Weekly log', 'datapeaks' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'datapeaks' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'datapeaks' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy', 'datapeaks' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms', 'datapeaks' ); ?></a>
			</div>
			<div>
				<h4><?php esc_html_e( 'Contact', 'datapeaks' ); ?></h4>
				<a href="mailto:<?php echo esc_attr( $dp_contact['email'] ); ?>"><?php echo esc_html( $dp_contact['email'] ); ?></a>
				<a href="<?php echo esc_url( $dp_contact['whatsapp'] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $dp_contact['phone'] ); ?></a>
				<a href="<?php echo esc_url( $dp_contact['maps'] ); ?>" target="_blank" rel="noopener">Ghouse Nagar, Bandlaguda,<br>Chandrayangutta, Hyderabad</a>
			</div>
		</div>
		<div class="footer-bottom">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> DataPeaks Solutions &middot; Hyderabad, India</span>
			<span>datapeakssolutions.com</span>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
