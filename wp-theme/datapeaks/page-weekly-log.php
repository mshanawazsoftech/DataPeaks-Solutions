<?php
/**
 * Template Name: Weekly Log
 * Weekly project log with track filter.
 *
 * @package DataPeaks
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
$dp_projects = datapeaks_get_projects();
$codes = array( 'all' => 'All', 'CDA' => 'CDA', 'CDS' => 'CDS', 'MLE' => 'MLE', 'DE' => 'DE', 'GAI' => 'GAI', 'AAI' => 'AAI' );
?>
<main id="main">
	<section class="page-hero">
		<div class="container">
			<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'datapeaks' ); ?></a> <span>/</span> <span><?php esc_html_e( 'Weekly Log', 'datapeaks' ); ?></span></div>
			<span class="eyebrow"><?php esc_html_e( 'One project every week', 'datapeaks' ); ?></span>
			<h1><?php echo wp_kses_post( __( 'The <span class="gradient-text">weekly drop</span>', 'datapeaks' ) ); ?></h1>
			<p><?php esc_html_e( 'Every week we publish a new runnable project — building, course by course, toward placement-level mastery of every tool.', 'datapeaks' ); ?></p>
		</div>
	</section>

	<section class="section--tight">
		<div class="container">
			<div class="filterbar" data-log-filter>
				<span style="color:var(--muted);font-size:.85rem;margin-right:.3rem"><?php esc_html_e( 'Filter:', 'datapeaks' ); ?></span>
				<?php foreach ( $codes as $val => $label ) : ?>
					<button class="filter-chip <?php echo 'all' === $val ? 'active' : ''; ?>" data-filter="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $label ); ?></button>
				<?php endforeach; ?>
			</div>
			<div class="table-wrap">
				<table>
					<thead><tr><th><?php esc_html_e( 'Week', 'datapeaks' ); ?></th><th><?php esc_html_e( 'Date', 'datapeaks' ); ?></th><th><?php esc_html_e( 'Course / Level', 'datapeaks' ); ?></th><th><?php esc_html_e( 'Project', 'datapeaks' ); ?></th><th><?php esc_html_e( 'Tools', 'datapeaks' ); ?></th></tr></thead>
					<tbody data-log-body>
						<?php foreach ( $dp_projects as $r ) : ?>
							<tr data-course="<?php echo esc_attr( $r['course'] ); ?>">
								<td><strong>W<?php echo (int) $r['week']; ?></strong></td>
								<td><?php echo esc_html( $r['date'] ); ?></td>
								<td><span class="badge <?php echo esc_attr( datapeaks_badge_class( $r['course'] ) ); ?>"><span class="dot"></span><?php echo esc_html( $r['course'] ); ?></span> <span class="tag"><?php echo esc_html( $r['level'] ); ?></span></td>
								<td><?php echo esc_html( $r['project'] ); ?></td>
								<td><?php echo datapeaks_tool_tags( $r['tools'] ); // phpcs:ignore ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<p class="form-note" style="margin-top:1rem"><?php esc_html_e( 'New projects drop weekly. Subscribe to be notified as each one publishes.', 'datapeaks' ); ?></p>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<div class="cta-band">
				<h2><?php esc_html_e( "Don't miss a drop", 'datapeaks' ); ?></h2>
				<div class="hero-actions" style="justify-content:center;margin-top:1.4rem">
					<a class="btn btn--gold" href="https://youtube.com/@datapeakssolutions" target="_blank" rel="noopener"><?php esc_html_e( 'Subscribe on YouTube', 'datapeaks' ); ?></a>
					<a class="btn btn--ghost" href="<?php echo esc_url( get_post_type_archive_link( 'course' ) ); ?>"><?php esc_html_e( 'Browse courses', 'datapeaks' ); ?></a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
