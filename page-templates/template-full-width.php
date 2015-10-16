<?php
/**
 * Template Name: Full-Width, No Sidebars
 *
 * This template display content at full with.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package Lean
 */

get_header(); ?>

		<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

								get_template_part( 'partials/content', 'page' );

					/**
					 * If comments are open or we have at least one comment,
					 * load up the comment template.
					 */
					if ( comments_open() || '0' !== intval( get_comments_number() ) ) :
						comments_template();
					endif;

				endwhile;
				?>

				</main>
		</div>

<?php get_footer(); ?>
