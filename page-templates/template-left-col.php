<?php
/**
 * Template Name: Two Column, Left-Sidebar
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lean
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				/**
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include
				 * a file called content-___.php (where ___ is the Post
				 * Format name) and that will be used instead.
				 */
				get_template_part( 'partials/content', 'page' );

				/**
				 * If comments are open or we have at least one comment,
				 * load up the comment template.
				 */
				if ( comments_open() || '0' !== intval( get_comments_number() ) ) :
					comments_template();
				endif;

			endwhile;

			digistarter_paging_nav();

		else :

			get_template_part( 'partials/content', 'none' );

		endif;
		?>

	</main>
	</div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>
