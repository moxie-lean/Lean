<?php namespace Leean;
/**
 * The template for displaying Search Results pages.
 *
 * @package Leean
 * @since 1.0.0
 */

use Leean\Inc\Helpers;

get_header();
?>
<section id="primary" class="entry__area">
	<main id="main" class="site__main" role="main">

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
		Helpers\pagination();

	else :
		get_template_part( 'partials/content', 'none' );
	endif;
	?>
	</main>
</section>
<?php get_footer(); ?>
