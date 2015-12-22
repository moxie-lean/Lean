<?php
/**
 * The main header file.
 *
 * @package Lean
 * @since 1.0.0
 */

?>
<!DOCTYPE html>
<?php tha_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
	<?php tha_head_top(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php tha_head_bottom(); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php tha_body_top(); ?>
<div id="page" class="hfeed site">
	<div class="wrap">
		<?php tha_header_before(); ?>
		<header id="masthead" class="header" role="banner"
				itemscope="itemscope" itemtype="http://schema.org/WPHeader">
			<?php tha_header_top(); ?>
			<div class="header__branding">
				<div class="header__title">
					<h1>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
				</div>
				<div class="header__description">
					<?php bloginfo( 'description' ) ?>
				</div>
			</div>

			<nav role="navigation" itemscope="itemscope"
				itemtype="http://schema.org/SiteNavigationElement">
				<?php
				$args = array(
					'theme_location' => 'primary-navigation',
					'items_wrap' =>
					'<ul data-breakpoint=" '.
					esc_attr( get_theme_mod( 'digistarter_mobile_min_width' ) ) .
					' " id="%1$s" class="%2$s">%3$s</ul>',
				);
				wp_nav_menu( $args );
				?>
			</nav>
			<?php tha_header_bottom(); ?>

		</header>
		<?php tha_header_after(); ?>

		<?php tha_content_before(); ?>
			<?php tha_content_top(); ?>
