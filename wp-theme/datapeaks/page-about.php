<?php
/**
 * Template Name: About
 *
 * @package DataPeaks
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<main id="main">
	<section class="page-hero">
		<div class="container">
			<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'datapeaks' ); ?></a> <span>/</span> <span><?php esc_html_e( 'About', 'datapeaks' ); ?></span></div>
			<span class="eyebrow"><?php esc_html_e( 'About us', 'datapeaks' ); ?></span>
			<h1><?php echo wp_kses_post( __( 'Scaling the pinnacles of <span class="gradient-text">data &amp; AI</span>, together', 'datapeaks' ) ); ?></h1>
			<p><?php esc_html_e( 'DataPeaks Solutions is a data analytics & AI training institute based in Hyderabad, with a pharma & life sciences specialization. We teach data analytics, data science, data engineering, ML, Generative AI and Agentic AI through real, project-first learning — building toward globally recognized, placement-focused careers.', 'datapeaks' ); ?></p>
		</div>
	</section>

	<section class="section--tight">
		<div class="container stats">
			<div class="stat reveal"><div class="n gradient-text">6</div><div class="l"><?php esc_html_e( 'Career tracks', 'datapeaks' ); ?></div></div>
			<div class="stat reveal"><div class="n gold-text">3</div><div class="l"><?php esc_html_e( 'Levels per track', 'datapeaks' ); ?></div></div>
			<div class="stat reveal"><div class="n gradient-text">Pharma</div><div class="l"><?php esc_html_e( 'Domain focus', 'datapeaks' ); ?></div></div>
			<div class="stat reveal"><div class="n gold-text">Small</div><div class="l"><?php esc_html_e( 'Batch sizes', 'datapeaks' ); ?></div></div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="grid" style="grid-template-columns:1.1fr .9fr;gap:2.5rem;align-items:center">
				<div class="stack reveal">
					<span class="eyebrow"><?php esc_html_e( 'Our approach', 'datapeaks' ); ?></span>
					<h2><?php echo wp_kses_post( __( 'Built different, <span class="gradient-text">on purpose</span>', 'datapeaks' ) ); ?></h2>
					<p><?php esc_html_e( 'Most data programs teach slides and theory. We tie every concept to a real dataset and a real project, so learners finish with a portfolio and the confidence to build from scratch.', 'datapeaks' ); ?></p>
					<p><?php esc_html_e( 'Our pharma & life sciences specialization is a domain most programs skip — opening doors in healthcare, pharma and life sciences data careers, alongside the core data & AI stack.', 'datapeaks' ); ?></p>
				</div>
				<div class="grid reveal" style="gap:.8rem">
					<div class="card feature"><div class="ic">&#9670;</div><h3><?php esc_html_e( 'Pharma & life sciences focus', 'datapeaks' ); ?></h3><p><?php esc_html_e( 'Domain specialization built for healthcare, pharma and life sciences careers.', 'datapeaks' ); ?></p></div>
					<div class="card feature"><div class="ic">&#9650;</div><h3><?php esc_html_e( 'Project-first learning', 'datapeaks' ); ?></h3><p><?php esc_html_e( 'Real datasets and real projects — not just slides and theory.', 'datapeaks' ); ?></p></div>
					<div class="card feature"><div class="ic">&#9679;</div><h3><?php esc_html_e( 'Small batches, real attention', 'datapeaks' ); ?></h3><p><?php esc_html_e( 'Intentionally small cohorts so every learner gets direct mentorship.', 'datapeaks' ); ?></p></div>
				</div>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="cta-band">
				<h2><?php esc_html_e( 'Come build with us', 'datapeaks' ); ?></h2>
				<div class="hero-actions" style="justify-content:center;margin-top:1.4rem">
					<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Talk to us', 'datapeaks' ); ?></a>
					<a class="btn btn--ghost" href="<?php echo esc_url( get_post_type_archive_link( 'course' ) ); ?>"><?php esc_html_e( 'Explore courses', 'datapeaks' ); ?></a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
