<?php
/**
 * Courses archive (/courses/).
 *
 * @package DataPeaks
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$dp_courses = datapeaks_get_courses();
?>
<main id="main">
	<section class="page-hero">
		<div class="container">
			<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'datapeaks' ); ?></a> <span>/</span> <span><?php esc_html_e( 'Courses', 'datapeaks' ); ?></span></div>
			<span class="eyebrow"><?php esc_html_e( 'Six career tracks', 'datapeaks' ); ?></span>
			<h1><?php echo wp_kses_post( __( 'Every course, <span class="gradient-text">every tool</span>, three levels deep', 'datapeaks' ) ); ?></h1>
			<p><?php esc_html_e( 'From Certified Data Analyst to Agentic AI. Level 1 of each track is fully free — all concepts, all tools, no paywall. Levels 2 & 3 go deeper toward placement-level mastery.', 'datapeaks' ); ?></p>
		</div>
	</section>

	<section class="section--tight">
		<div class="container">
			<div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(280px,1fr))">
				<?php foreach ( $dp_courses as $c ) : $accent = datapeaks_color_var( $c['color'] ); ?>
					<a class="card course-card reveal" style="--accent:<?php echo esc_attr( $accent ); ?>" href="<?php echo esc_url( datapeaks_course_link( $c ) ); ?>" aria-label="<?php echo esc_attr( $c['name'] . ' — Level 1 free' ); ?>">
						<div class="cc-top">
							<div class="course-icon" style="background:<?php echo esc_attr( $accent ); ?>"><?php echo esc_html( $c['code'] ); ?></div>
							<span class="badge badge--free"><span class="dot"></span><?php esc_html_e( 'Level 1 free', 'datapeaks' ); ?></span>
						</div>
						<div>
							<h3><?php echo esc_html( $c['name'] ); ?></h3>
							<p style="margin-top:.4rem"><?php echo esc_html( $c['tagline'] ); ?></p>
						</div>
						<div class="cc-tools"><?php echo datapeaks_tool_tags( array_slice( $c['tools'], 0, 5 ) ); // phpcs:ignore ?></div>
						<div class="cc-foot">
							<span class="badge <?php echo esc_attr( datapeaks_badge_class( $c['code'] ) ); ?>"><span class="dot"></span><?php echo esc_html( $c['code'] ); ?></span>
							<span class="arrow" aria-hidden="true"><?php esc_html_e( 'Explore', 'datapeaks' ); ?> &rarr;</span>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="cta-band">
				<h2><?php esc_html_e( 'Not sure where to start?', 'datapeaks' ); ?></h2>
				<p style="max-width:48ch;margin:.8rem auto 0"><?php esc_html_e( "Tell us your goal and we'll point you to the right track and level.", 'datapeaks' ); ?></p>
				<div class="hero-actions" style="justify-content:center;margin-top:1.4rem">
					<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Talk to us', 'datapeaks' ); ?></a>
					<a class="btn btn--ghost" href="<?php echo esc_url( home_url( '/weekly-log/' ) ); ?>"><?php esc_html_e( 'See the weekly log', 'datapeaks' ); ?></a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
