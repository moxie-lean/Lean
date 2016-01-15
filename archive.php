<?php namespace Leean;
/**
 * Template for displaying Archive pages.
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
					<?php the_archive_title( '<h1>', '</h1>' ); ?>
				</h1>
				<?php $option_description = term_description(); ?>
				<?php if ( ! empty( $option_description ) ) : ?>
					<div class="taxonomy-description">
						<?php esc_html_e( $option_description, _TEXT_DOMAIN_ ) ?>
					</div>
				<?php endif; ?>
			</header>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/**
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'partials/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php Helpers\pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'partials/content', 'none' ); ?>

		<?php endif; ?>

		</main>
	</section>

<?php get_footer(); ?>
