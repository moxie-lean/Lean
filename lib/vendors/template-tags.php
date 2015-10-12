<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Lean
 */

// Exit if this fiel is loaded directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'digistarter_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function digistarter_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h4 class="screen-reader-text">
		<?php __( 'Posts navigation', TRANSLATED_TEXT_DOMAIN ); ?>
		</h4>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav prev">&larr;</span> Older posts', 'digistarter' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav next">&rarr;</span>', 'digistarter' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'digistarter_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function digistarter_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h3 class="screen-reader-text">
		<?php __( 'Post navigation', TRANSLATED_TEXT_DOMAIN ); ?>
		</h3>
		<div class="nav-links">

			<?php
			previous_post_link(
				'%link',
				wp_kses(
					_x( '<span class="meta-nav prev">&larr;</span> %title', 'Previous post link', TRANSLATED_TEXT_DOMAIN ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				)
			);
			?>
			<?php
			next_post_link(
				'%link',
				wp_kses(
					_x( '%title <span class="meta-nav next">&rarr;</span>', 'Next post link', TRANSLATED_TEXT_DOMAIN ),
					array(
						'span' => array(
							'class' => array(),
					   	),
					)
				)
			);
			?>


		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'digistarter_categorized_blog' ) ) :
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool Whether we have more than one category or not.
 */
function digistarter_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );
		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );
		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}
	if ( 1 !== $all_the_cool_cats ) {
		// This blog has more than 1 category so some_like_it_neat_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so some_like_it_neat_categorized_blog should return false.
		return false;
	}
}
endif;
