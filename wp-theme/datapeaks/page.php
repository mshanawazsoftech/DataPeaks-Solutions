<?php
/**
 * Generic page (used by Privacy, Terms, and any other page).
 *
 * @package DataPeaks
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<main id="main">
	<section class="page-hero">
		<div class="container legal">
			<div class="crumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'datapeaks' ); ?></a> <span>/</span> <span><?php the_title(); ?></span></div>
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<section class="section--tight">
		<div class="container legal">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
