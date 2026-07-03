<?php
/**
 * Single course.
 *
 * @package DataPeaks
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
while ( have_posts() ) :
	the_post();
	$slug = get_post_field( 'post_name', get_the_ID() );
	$c    = datapeaks_get_course_by_slug( $slug );
	if ( ! $c ) {
		$c = array(
			'code' => get_post_meta( get_the_ID(), '_dp_code', true ),
			'name' => get_the_title(),
			'color' => get_post_meta( get_the_ID(), '_dp_color', true ),
			'tagline' => get_post_meta( get_the_ID(), '_dp_tagline', true ),
			'summary' => get_post_meta( get_the_ID(), '_dp_summary', true ),
			'tools' => array(), 'outcomes' => array(), 'levels' => array(),
		);
	}
	$accent = datapeaks_color_var( $c['color'] );
	$others = array_filter( datapeaks_get_courses(), function ( $x ) use ( $slug ) { return $x['slug'] !== $slug; } );
	?>
	<main id="main">
		<section class="page-hero">
			<div class="container">
				<div class="crumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'datapeaks' ); ?></a> <span>/</span>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'course' ) ); ?>"><?php esc_html_e( 'Courses', 'datapeaks' ); ?></a> <span>/</span>
					<span><?php echo esc_html( $c['name'] ); ?></span>
				</div>
				<div class="hero-grid" style="align-items:flex-start">
					<div>
						<span class="badge <?php echo esc_attr( datapeaks_badge_class( $c['code'] ) ); ?>"><span class="dot"></span><?php echo esc_html( $c['code'] ); ?></span>
						<h1 style="margin-top:1rem"><?php echo esc_html( $c['name'] ); ?></h1>
						<p class="lead"><?php echo esc_html( $c['tagline'] ); ?></p>
						<p style="margin-top:.6rem"><?php echo esc_html( $c['summary'] ); ?></p>
						<div style="margin-top:1.2rem"><?php echo datapeaks_tool_tags( $c['tools'] ); // phpcs:ignore ?></div>
						<div class="hero-actions">
							<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Enroll in this track', 'datapeaks' ); ?></a>
							<a class="btn btn--ghost" href="<?php echo esc_url( home_url( '/weekly-log/' ) ); ?>"><?php esc_html_e( 'Weekly log', 'datapeaks' ); ?></a>
						</div>
					</div>
					<aside class="hero-card">
						<div class="course-icon" style="width:64px;height:64px;font-size:1.2rem;border-radius:16px;background:<?php echo esc_attr( $accent ); ?>"><?php echo esc_html( $c['code'] ); ?></div>
						<h3 style="margin-top:1rem"><?php esc_html_e( "What you'll be able to do", 'datapeaks' ); ?></h3>
						<ul class="check-list" style="margin-top:.6rem">
							<?php foreach ( $c['outcomes'] as $o ) : ?>
								<li><?php echo esc_html( $o ); ?></li>
							<?php endforeach; ?>
						</ul>
					</aside>
				</div>
			</div>
		</section>

		<section class="section--tight">
			<div class="container">
				<div class="section-head" style="margin-bottom:1.4rem;max-width:none;text-align:left">
					<span class="eyebrow"><?php esc_html_e( 'Curriculum', 'datapeaks' ); ?></span>
					<h2><?php echo wp_kses_post( __( 'Three levels, <span class="gradient-text">weekly projects</span>', 'datapeaks' ) ); ?></h2>
				</div>
				<?php $levels = $c['levels']; if ( ! empty( $levels ) ) : ?>
					<div class="tabs" role="tablist" aria-label="<?php esc_attr_e( 'Course levels', 'datapeaks' ); ?>">
						<?php $li = 0; foreach ( $levels as $lvl => $items ) : ?>
							<button class="tab <?php echo 0 === $li ? 'active' : ''; ?>" role="tab" id="cdtab-<?php echo (int) $li; ?>" aria-selected="<?php echo 0 === $li ? 'true' : 'false'; ?>" aria-controls="cdpanel-<?php echo (int) $li; ?>" tabindex="<?php echo 0 === $li ? 0 : -1; ?>" data-i="<?php echo (int) $li; ?>"><?php echo esc_html( $lvl ); ?></button>
						<?php $li++; endforeach; ?>
					</div>
					<?php $li = 0; foreach ( $levels as $lvl => $items ) : ?>
						<div class="tab-panel" role="tabpanel" id="cdpanel-<?php echo (int) $li; ?>" aria-labelledby="cdtab-<?php echo (int) $li; ?>" data-i="<?php echo (int) $li; ?>" <?php echo 0 === $li ? '' : 'hidden'; ?>>
							<div style="display:flex;align-items:center;gap:.6rem;margin-bottom:1rem">
								<strong style="font-family:var(--font-head)"><?php echo esc_html( $lvl ); ?></strong>
								<?php echo 0 === $li ? '<span class="badge badge--free"><span class="dot"></span>Free</span>' : '<span class="badge">Paid program</span>'; ?>
							</div>
							<div class="level-list">
								<?php foreach ( $items as $it ) : ?>
									<div class="level-row">
										<span class="wk"><?php echo esc_html( $it['wk'] ); ?></span>
										<div>
											<h4><?php echo esc_html( $it['title'] ); ?></h4>
											<p><?php echo esc_html( $it['desc'] ); ?></p>
											<div style="margin-top:.5rem"><?php echo datapeaks_tool_tags( $it['tools'] ); // phpcs:ignore ?></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php $li++; endforeach; ?>
				<?php endif; ?>
			</div>
		</section>

		<section class="section">
			<div class="container">
				<div class="section-head center"><span class="eyebrow"><?php esc_html_e( 'Keep exploring', 'datapeaks' ); ?></span><h2><?php esc_html_e( 'Other tracks', 'datapeaks' ); ?></h2></div>
				<div class="grid" style="grid-template-columns:repeat(auto-fit,minmax(200px,1fr))">
					<?php foreach ( $others as $x ) : ?>
						<a class="card course-card reveal in" style="--accent:<?php echo esc_attr( datapeaks_color_var( $x['color'] ) ); ?>" href="<?php echo esc_url( datapeaks_course_link( $x ) ); ?>">
							<div class="cc-top"><div class="course-icon" style="background:<?php echo esc_attr( datapeaks_color_var( $x['color'] ) ); ?>"><?php echo esc_html( $x['code'] ); ?></div></div>
							<h3 style="font-size:1.1rem"><?php echo esc_html( $x['name'] ); ?></h3>
							<span class="arrow"><?php esc_html_e( 'Explore', 'datapeaks' ); ?> &rarr;</span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	</main>
	<?php
endwhile;
get_footer();
