<?php namespace Lean;
/**
 * Template that displays all pages by default.
 *
 * @package Lean
 * @since 1.0.0
 */

get_header();

use Lean\Load;
?>
<div class="wrap">
	<main class="site__main" role="main">

		<?php
		while ( have_posts() ) : the_post();
			Load::partial( 'content' );
			// If comments are open or we have at least one comment.
			if ( comments_open() || 0 !== intval( get_comments_number() ) ) :
					comments_template();
			endif;
		endwhile;
		?>

	</main>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
