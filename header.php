<?php namespace Leean;
/**
 * The main header file.
 *
 * @package Leean
 * @since 1.0.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="hfeed site">
	<div class="wrap">
		<header class="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
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
				$args = [
					'theme_location' => 'primary-navigation',
					'items_wrap' =>
					'<ul id="%1$s" class="%2$s">%3$s</ul>',
				];
				wp_nav_menu( $args );
				?>
			</nav>

		</header>
