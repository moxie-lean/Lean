<?php
/**
 * Template that displays all pages by default.
 *
 * @package Lean
 * @since 1.0.0
 */

get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'partials/content', 'page' );
			// If comments are open or we have at least one comment.
			if ( comments_open() || 0 !== intval( get_comments_number() ) ) :
					comments_template();
			endif;
		endwhile;
		?>

	</main>
</div>

<?php get_footer(); ?>
