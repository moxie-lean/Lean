<?php
/**
 * @package digistarter
 */
?>

<?php tha_entry_before(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemType="http://schema.org/BlogPosting" >
	<?php tha_entry_top(); ?>
	<header class="entry-header">

		<h1 class="entry-title" itemprop="name" ><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<span itemprop="dateModified" style="display:none;">Last modified: <?php the_modified_date(); ?></span>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary" itemprop="description">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content" itemprop="articleBody">
		<?php
			the_content( sprintf(
				__( 'Continue reading%s &rarr;', 'digistarter' ),
				'<span class="screen-reader-text">  '.get_the_title().'</span>'
			)  );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'digistarter' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta" itemprop="keywords">
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link" itemprop="comment" ><?php comments_popup_link( __( 'Leave a comment', 'digistarter' ), __( '1 Comment', 'digistarter' ), __( '% Comments', 'digistarter' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'digistarter' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
	<?php tha_entry_bottom(); ?>
</article><!-- #post-## -->
<?php tha_entry_after(); ?>
