<?php
/**
 * This is the template that displays all pages by default.
 *
 * @package lean
 */
get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

				<?php
				        // If comments are open or we have at least one comment, load up the comment template
				        if ( comments_open() || '0' != get_comments_number() ) :
				                comments_template();
				        endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
