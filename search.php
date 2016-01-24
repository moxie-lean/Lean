<?php namespace Leean;
/**
 * The template for displaying Search Results pages.
 *
 * @package Leean
 * @since 1.0.0
 */

get_header();
?>
<section class="wrap">
	<main class="site__main" role="main">

	<?php if ( have_posts() ) : ?>

		<header>
			<h1>
			<?php
			printf(
				esc_html__( 'Search Results for: %s', _TEXT_DOMAIN_ ),
				'<span>' . get_search_query() . '</span>'
			);
			?>
			</h1>
		</header>

		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'partials/content', 'search' );
		endwhile;
		the_posts_pagination();

	else :
		get_template_part( 'partials/content', 'none' );
	endif;
	?>
	</main>
	<?php get_sidebar(); ?>
</section>
<?php get_footer(); ?>
