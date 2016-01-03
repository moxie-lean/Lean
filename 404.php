<?php namespace Leean;
/**
 * Template for displaying 404 pages (Not Found).
 *
 * @package Leean
 * @since 1.0.0
 */

use Leean\Inc\Helpers;

get_header();
?>
	<div id="primary" class="entry__area">
		<main id="main" class="site__main" role="main">

			<section class="error-404 not-found">
				<header>
					<h1>
						<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', TRANSLATED_TEXT_DOMAIN ); ?>
					</h1>
				</header>

				<div class="page__content">
					<p>
						<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', TRANSLATED_TEXT_DOMAIN ); ?>
					</p>

					<?php
						get_search_form();
						the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<?php if ( Helpers\categorized_blog() ) : ?>
					<div class="widget widget_categories">
						<h2 class="widgettitle">
							<?php esc_html_e( 'Most Used Categories', TRANSLATED_TEXT_DOMAIN ); ?>
						</h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							));
						?>
						</ul>
					</div>
					<?php
					endif;

					/* translators: %1$s: smiley */
						$archive_content = '<p>'
							. sprintf(
								__( 'Try looking in the monthly archives. %1$s', TRANSLATED_TEXT_DOMAIN ),
								convert_smilies( ':)' )
							)
							. '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					the_widget( 'WP_widget_Tag_Cloud' );
					?>
				</div>
			</section>
		</main>
	</div>
<?php get_footer(); ?>
