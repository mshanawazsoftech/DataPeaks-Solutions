<?php
/**
 * 404.
 *
 * @package DataPeaks
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<main id="main">
	<section class="notfound">
		<div class="container">
			<div class="code gradient-text">404</div>
			<h1 style="margin-top:1rem"><?php esc_html_e( "This peak isn't on the map", 'datapeaks' ); ?></h1>
			<p style="max-width:46ch;margin:1rem auto 0"><?php esc_html_e( "The page you're looking for moved or never existed. Let's get you back on the trail.", 'datapeaks' ); ?></p>
			<div class="hero-actions" style="justify-content:center;margin-top:1.8rem">
				<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'datapeaks' ); ?></a>
				<a class="btn btn--ghost" href="<?php echo esc_url( get_post_type_archive_link( 'course' ) ); ?>"><?php esc_html_e( 'Browse courses', 'datapeaks' ); ?></a>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
