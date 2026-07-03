<?php
/**
 * Fallback template (blog index, search, archives).
 *
 * @package DataPeaks
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<main id="main">
	<section class="section">
		<div class="container" style="max-width:820px">
			<?php if ( have_posts() ) : ?>
				<div class="section-head" style="text-align:left;max-width:none">
					<h1><?php echo is_search() ? esc_html__( 'Search results', 'datapeaks' ) : esc_html( get_the_archive_title() ? wp_strip_all_tags( get_the_archive_title() ) : get_bloginfo( 'name' ) ); ?></h1>
				</div>
				<div class="grid" style="gap:1.2rem">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article class="card">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p style="margin-top:.5rem"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>
							<a class="arrow" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'datapeaks' ); ?> &rarr;</a>
						</article>
						<?php
					endwhile;
					?>
				</div>
				<div style="margin-top:2rem"><?php the_posts_pagination(); ?></div>
			<?php else : ?>
				<h1><?php esc_html_e( 'Nothing found', 'datapeaks' ); ?></h1>
				<p><?php esc_html_e( 'Try a different search or head back home.', 'datapeaks' ); ?></p>
				<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>" style="margin-top:1rem"><?php esc_html_e( 'Back to home', 'datapeaks' ); ?></a>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
