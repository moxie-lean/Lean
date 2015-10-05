<?php
// The template for displaying Search Results pages.
get_header();
?>
<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
			<?php printf( __( 'Search Results for: %s', 'lean' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>
		</header>

		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'partials/content', 'search' );
		endwhile;
			digistarter_paging_nav();
		else :
		get_template_part( 'partials/content', 'none' );
		?>

	<?php endif; ?>
	</main>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
