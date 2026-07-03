<?php
/**
 * Front page.
 *
 * @package DataPeaks
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$dp_courses = datapeaks_get_courses();
?>
<main id="main">

	<section class="hero">
		<div class="container hero-grid">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Data & AI training institute · Hyderabad', 'datapeaks' ); ?></span>
				<h1><?php echo wp_kses_post( __( 'Scaling the <span class="gradient-text">Pinnacles</span> of Data &amp; AI', 'datapeaks' ) ); ?></h1>
				<p class="lead"><?php esc_html_e( 'Hands-on training in data analytics, data science, ML and Agentic AI — with a pharma & life sciences focus. Every concept taught through real projects, one drop per week.', 'datapeaks' ); ?></p>
				<div class="hero-actions">
					<a class="btn btn--primary" href="<?php echo esc_url( get_post_type_archive_link( 'course' ) ?: home_url( '/courses/' ) ); ?>"><?php esc_html_e( 'Explore courses', 'datapeaks' ); ?></a>
					<a class="btn btn--ghost" href="https://youtube.com/@datapeakssolutions" target="_blank" rel="noopener">&#9654; <?php esc_html_e( 'Watch on YouTube', 'datapeaks' ); ?></a>
				</div>
				<div class="hero-meta">
					<span><strong>6</strong> <?php esc_html_e( 'courses', 'datapeaks' ); ?></span>
					<span><strong>3</strong> <?php esc_html_e( 'levels each', 'datapeaks' ); ?></span>
					<span><strong><?php esc_html_e( 'Level 1', 'datapeaks' ); ?></strong> <?php esc_html_e( 'fully free', 'datapeaks' ); ?></span>
					<span><strong><?php esc_html_e( 'Weekly', 'datapeaks' ); ?></strong> <?php esc_html_e( 'project drops', 'datapeaks' ); ?></span>
				</div>
			</div>
			<div class="hero-card">
				<div class="chip-row">
					<span class="badge badge--cda"><span class="dot"></span>CDA</span>
					<span class="badge badge--cds"><span class="dot"></span>CDS</span>
					<span class="badge badge--mle"><span class="dot"></span>MLE</span>
					<span class="badge badge--de"><span class="dot"></span>DE</span>
					<span class="badge badge--gai"><span class="dot"></span>GAI</span>
					<span class="badge badge--aai"><span class="dot"></span>AAI</span>
				</div>
				<div class="bars" aria-hidden="true">
					<span class="bar" style="height:55%"></span>
					<span class="bar" style="height:78%"></span>
					<span class="bar" style="height:42%"></span>
					<span class="bar" style="height:92%"></span>
					<span class="bar" style="height:66%"></span>
					<span class="bar" style="height:83%"></span>
				</div>
				<div class="hero-card-foot">
					<span style="font-family:var(--font-head);font-weight:700"><?php esc_html_e( 'From zero → placement', 'datapeaks' ); ?></span>
					<span class="badge badge--free"><span class="dot"></span><?php esc_html_e( 'Open datasets', 'datapeaks' ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<section class="section--tight">
		<div class="container stats">
			<div class="stat reveal"><div class="n gradient-text">6</div><div class="l"><?php esc_html_e( 'Career tracks', 'datapeaks' ); ?></div></div>
			<div class="stat reveal"><div class="n gold-text">18</div><div class="l"><?php esc_html_e( 'Levels of depth', 'datapeaks' ); ?></div></div>
			<div class="stat reveal"><div class="n gradient-text">52</div><div class="l"><?php esc_html_e( 'Projects a year', 'datapeaks' ); ?></div></div>
			<div class="stat reveal"><div class="n gold-text">Pharma</div><div class="l"><?php esc_html_e( 'Domain focus', 'datapeaks' ); ?></div></div>
		</div>
	</section>

	<section class="section" id="courses">
		<div class="container">
			<div class="section-head center">
				<span class="eyebrow"><?php esc_html_e( 'The six tracks', 'datapeaks' ); ?></span>
				<h2><?php echo wp_kses_post( __( 'Choose your <span class="gradient-text">path into data &amp; AI</span>', 'datapeaks' ) ); ?></h2>
				<p><?php esc_html_e( 'Start at Level 1 of any track — fully free — or follow the weekly drop in order toward placement-level mastery.', 'datapeaks' ); ?></p>
			</div>
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

	<section class="section" id="why">
		<div class="container">
			<div class="section-head center">
				<span class="eyebrow"><?php esc_html_e( 'Why DataPeaks', 'datapeaks' ); ?></span>
				<h2><?php echo wp_kses_post( __( 'Built different, <span class="gradient-text">on purpose</span>', 'datapeaks' ) ); ?></h2>
				<p><?php esc_html_e( 'A Hyderabad-based institute with a domain specialization most data programs skip.', 'datapeaks' ); ?></p>
			</div>
			<div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(260px,1fr))">
				<div class="card feature reveal"><div class="num-badge">01</div><h3><?php esc_html_e( 'Pharma & life sciences focus', 'datapeaks' ); ?></h3><p><?php esc_html_e( 'A domain specialization most data programs skip — built for healthcare, pharma and life sciences careers.', 'datapeaks' ); ?></p></div>
				<div class="card feature reveal"><div class="num-badge">02</div><h3><?php esc_html_e( 'Project-first learning', 'datapeaks' ); ?></h3><p><?php esc_html_e( 'Every concept is tied to a real dataset and a real project, not just slides and theory.', 'datapeaks' ); ?></p></div>
				<div class="card feature reveal"><div class="num-badge">03</div><h3><?php esc_html_e( 'Small batches, real attention', 'datapeaks' ); ?></h3><p><?php esc_html_e( 'Intentionally small cohorts so every learner gets direct mentorship from instructors.', 'datapeaks' ); ?></p></div>
			</div>
		</div>
	</section>

	<section class="section" style="background:linear-gradient(180deg,transparent,rgba(0,0,0,.2))">
		<div class="container">
			<div class="section-head center">
				<span class="eyebrow"><?php esc_html_e( 'How the hub works', 'datapeaks' ); ?></span>
				<h2><?php echo wp_kses_post( __( 'Learn by <span class="gradient-text">building, every week</span>', 'datapeaks' ) ); ?></h2>
			</div>
			<div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(240px,1fr))">
				<div class="card feature reveal"><div class="num-badge">1</div><h3><?php esc_html_e( 'Pick a track & level', 'datapeaks' ); ?></h3><p><?php esc_html_e( 'Six courses, three levels each. Begin at Level 1 for free, any track, any time.', 'datapeaks' ); ?></p></div>
				<div class="card feature reveal"><div class="num-badge">2</div><h3><?php esc_html_e( 'Run the weekly project', 'datapeaks' ); ?></h3><p><?php esc_html_e( 'A real, runnable pipeline on open datasets — every concept taught by doing.', 'datapeaks' ); ?></p></div>
				<div class="card feature reveal"><div class="num-badge">3</div><h3><?php esc_html_e( 'Build your portfolio', 'datapeaks' ); ?></h3><p><?php esc_html_e( 'Finish each week with something you built, not just notes you took.', 'datapeaks' ); ?></p></div>
				<div class="card feature reveal"><div class="num-badge">4</div><h3><?php esc_html_e( 'Get placement-ready', 'datapeaks' ); ?></h3><p><?php esc_html_e( 'Levels 2 & 3 go deeper toward job-ready, placement-focused mastery.', 'datapeaks' ); ?></p></div>
			</div>
		</div>
	</section>

	<section class="section" id="access">
		<div class="container">
			<div class="section-head center">
				<span class="eyebrow"><?php esc_html_e( 'Access model', 'datapeaks' ); ?></span>
				<h2><?php echo wp_kses_post( __( 'Level 1 is <span class="gold-text">fully free</span>, forever', 'datapeaks' ) ); ?></h2>
			</div>
			<div class="access-grid">
				<div class="access-card is-free reveal">
					<h3><?php esc_html_e( 'Level 1', 'datapeaks' ); ?> <span class="badge badge--free"><span class="dot"></span><?php esc_html_e( 'Free', 'datapeaks' ); ?></span></h3>
					<div class="price gradient-text">&#8377;0</div>
					<p><?php esc_html_e( 'Beginner foundations for every course.', 'datapeaks' ); ?></p>
					<ul class="check-list"><li><?php esc_html_e( 'All concepts & tools', 'datapeaks' ); ?></li><li><?php esc_html_e( 'Weekly runnable projects', 'datapeaks' ); ?></li><li><?php esc_html_e( 'Open / public datasets', 'datapeaks' ); ?></li><li><?php esc_html_e( 'No paywall, ever', 'datapeaks' ); ?></li></ul>
					<a class="btn btn--primary btn--block" href="<?php echo esc_url( get_post_type_archive_link( 'course' ) ?: home_url( '/courses/' ) ); ?>" style="margin-top:1.2rem"><?php esc_html_e( 'Start free', 'datapeaks' ); ?></a>
				</div>
				<div class="access-card reveal">
					<h3><?php esc_html_e( 'Level 2', 'datapeaks' ); ?> <span class="badge"><?php esc_html_e( 'Intermediate', 'datapeaks' ); ?></span></h3>
					<div class="price"><?php esc_html_e( 'Paid program', 'datapeaks' ); ?></div>
					<p><?php esc_html_e( 'Deeper builds and real-world complexity.', 'datapeaks' ); ?></p>
					<ul class="check-list"><li><?php esc_html_e( 'Advanced projects', 'datapeaks' ); ?></li><li><?php esc_html_e( 'Production practices', 'datapeaks' ); ?></li><li><?php esc_html_e( 'Guided mentorship', 'datapeaks' ); ?></li><li><?php esc_html_e( 'Portfolio review', 'datapeaks' ); ?></li></ul>
					<a class="btn btn--ghost btn--block" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="margin-top:1.2rem"><?php esc_html_e( 'Enquire', 'datapeaks' ); ?></a>
				</div>
				<div class="access-card reveal">
					<h3><?php esc_html_e( 'Level 3', 'datapeaks' ); ?> <span class="badge"><?php esc_html_e( 'Advanced', 'datapeaks' ); ?></span></h3>
					<div class="price"><?php esc_html_e( 'Paid program', 'datapeaks' ); ?></div>
					<p><?php esc_html_e( 'Placement-focused, job-ready mastery.', 'datapeaks' ); ?></p>
					<ul class="check-list"><li><?php esc_html_e( 'End-to-end systems', 'datapeaks' ); ?></li><li><?php esc_html_e( 'Interview & placement prep', 'datapeaks' ); ?></li><li><?php esc_html_e( '1:1 guidance', 'datapeaks' ); ?></li><li><?php esc_html_e( 'Certificate', 'datapeaks' ); ?></li></ul>
					<a class="btn btn--ghost btn--block" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="margin-top:1.2rem"><?php esc_html_e( 'Enquire', 'datapeaks' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="section" style="background:linear-gradient(180deg,transparent,rgba(0,0,0,.2))">
		<div class="container" style="max-width:820px">
			<div class="section-head center">
				<span class="eyebrow"><?php esc_html_e( 'FAQ', 'datapeaks' ); ?></span>
				<h2><?php echo wp_kses_post( __( 'Questions, <span class="gradient-text">answered</span>', 'datapeaks' ) ); ?></h2>
			</div>
			<div class="accordion" data-accordion>
				<?php foreach ( datapeaks_faqs() as $i => $f ) : ?>
					<div class="acc-item">
						<button class="acc-btn" aria-expanded="false" aria-controls="faq-<?php echo (int) $i; ?>"><span><?php echo esc_html( $f['q'] ); ?></span><span class="ic" aria-hidden="true">+</span></button>
						<div class="acc-panel" id="faq-<?php echo (int) $i; ?>"><div><?php echo esc_html( $f['a'] ); ?></div></div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="cta-band">
				<span class="eyebrow" style="justify-content:center"><?php esc_html_e( 'Join the weekly drop', 'datapeaks' ); ?></span>
				<h2 style="margin-top:.6rem"><?php echo wp_kses_post( __( 'Start building this <span class="gradient-text">week</span>', 'datapeaks' ) ); ?></h2>
				<div class="hero-actions" style="justify-content:center;margin-top:1.6rem">
					<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Enroll now', 'datapeaks' ); ?></a>
					<a class="btn btn--gold" href="https://youtube.com/@datapeakssolutions" target="_blank" rel="noopener"><?php esc_html_e( 'Subscribe on YouTube', 'datapeaks' ); ?></a>
				</div>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>
