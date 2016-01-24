<?php namespace Leean;
/**
 * Template for displaying 404 pages (Not Found).
 *
 * @package Leean
 * @since 1.0.0
 */

get_header();
?>
	<div class="wrap">
		<main role="main">
			<section class="error-404 not-found">
				<header>
					<h1>
						<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', _TEXT_DOMAIN_ ); ?>
					</h1>
				</header>

				<div class="page__content">
					<p>
						<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', _TEXT_DOMAIN_ ); ?>
					</p>

					<?php
					get_search_form();
					the_widget( 'WP_Widget_Recent_Posts' );

					/* translators: %1$s: smiley */
					$archive_content = '<p>'
						. sprintf(
							__( 'Try looking in the monthly archives. %1$s', _TEXT_DOMAIN_ ),
							convert_smilies( ':)' )
						)
						. '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					the_widget( 'WP_Widget_Tag_Cloud' );
					?>
				</div>
			</section>
		</main>
	</div>
<?php get_footer(); ?>
