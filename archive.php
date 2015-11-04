<?php
/**
 * Template for displaying Archive pages.
 *
 * @package Lean
 * @since 1.0.0
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
				</h1>
				<?php // Show an optional term description. ?>
				<?php $option_description = term_description(); ?>
				<?php if ( ! empty( $option_description ) ) : ?>
					<div class="taxonomy-description">
						<?php esc_html_e( $option_description, TRANSLATED_TEXT_DOMAIN ) ?>
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

			<?php digistarter_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'partials/content', 'none' ); ?>

		<?php endif; ?>

		</main>
	</section>

<?php get_footer(); ?>
