<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package alep
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="expires" content="-1">
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=9"> -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel="icon" type="png" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/favicon.png"> <!-- Standard favicon -->
	<link rel="icon" sizes="192x192" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon/android-chrome-192x192.png"> <!-- Android chrome icon  -->
	<meta name="theme-color" content="#212225"> <!-- Android Chrome theme color -->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- Push-in-navigation-wrapper -->
<nav id="c-menu--push-left" class="c-menu c-menu--push-left no-print">
<button class="c-menu__close"><i class="cancel alep-icon" aria-hidden="true"></i></button>
			<p class="site-description mobile"><?php bloginfo( 'description' ); ?></p>
			<?php get_template_part( 'menu' ); ?>
</nav>

<!-- Push-in-navigation-overlay -->
<div id="c-mask" class="c-mask no-print"></div>
<!-- #Push-in-navigation-overlay -->

	<div id="site-container">
		<aside id="site-sidebar" class="no-print">
				<div id="site-sidebar-logo">

				<?php
				
				// Display the Custom Logo
				the_custom_logo('mobile-header-logo');
				// No Custom Logo, just display the site's name
				if (!has_custom_logo()) {
				?>
				<a href="<?php
					echo get_site_url();
				?>"><h1 class="site-title" style="text-align:center;"><?php
					bloginfo('name');
				?></h1></a>
								<?php
				}
				?>

				</div>

				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			
			<?php get_template_part( 'menu' ); ?>

		</aside>
		<div id="site-main">
			<header id="site-header" class="no-print">

					<button id="c-button--push-left" class="c-button">
						<i class="menu alep-icon" aria-hidden="true"></i>
						<span class="mobile-menu-button-text"></span>
					</button>

					<span class="mobile-header-logo no-print"><?php add_filter( 'image_downsize', 'mobile_header_logo', 10, 3 ); the_custom_logo(); ?></span>
			</header>
			<?php //custom_breadcrumbs(); ?>




