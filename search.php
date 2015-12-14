<?php namespace Lean;
/**
 * The template for displaying Search Results pages.
 *
 * @package Lean
 * @since 1.0.0
 */

use Lean\Inc\Helpers as Helpers;

get_header();
?>
<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
			<?php
			printf(
				esc_html__( 'Search Results for: %s', TRANSLATED_TEXT_DOMAIN ),
				'<span>' . get_search_query() . '</span>'
			);
			?>
			</h1>
		</header>

		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'partials/content', 'search' );
		endwhile;
			Helpers\pagination();
		else :
		get_template_part( 'partials/content', 'none' );
		?>

	<?php endif; ?>
	</main>
</section>
<?php get_footer(); ?>
