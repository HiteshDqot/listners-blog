<?php

/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up to <div id="content">
 *
 * @package Listeners_Blog
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$Siteurl = "https://www.listenersconnect.com";
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="page" class="site-wrapper">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'listeners-blog'); ?></a>

		<header id="masthead" class="site-header">
			<div class="container">
				<!-- Logo (Far Left) -->
				<div class="site-logo">
					<a href="<?php echo $Siteurl; ?>" rel="home">
						<img src="<?php echo listeners_blog_get_logo_url(); ?>" alt="<?php bloginfo('name'); ?>">
					</a>
				</div>

				<!-- Desktop Navigation & Actions (Far Right) -->
				<div class="header-right-desktop">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-primary',
							'menu_id'        => 'primary-menu',
							'container'      => 'nav',
							'container_class' => 'header-menu-container',
							'fallback_cb'    => false,
						)
					);
					?>
					<div class="header-actions-group">
						<a href="<?php echo $Siteurl ?>/download-application" class="link-download-app"><?php esc_html_e('Download App', 'listeners-blog'); ?></a>
						<a href="<?php echo $Siteurl ?>/listeners" class="btn-talk-listeners"><?php esc_html_e('Talk To Listeners', 'listeners-blog'); ?></a>
						<a href="<?php echo $Siteurl ?>/experts" class="btn-talk-experts"><?php esc_html_e('Talk To Experts', 'listeners-blog'); ?></a>
					</div>
				</div>

				<!-- Mobile Header Actions (Hidden on Desktop) -->
				<div class="header-mobile-actions">
					<a href="<?php echo $Siteurl ?>/download-application" class="btn-mobile-download"><?php esc_html_e('Download App', 'listeners-blog'); ?></a>
					<button class="header-mobile-toggle" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle Menu', 'listeners-blog'); ?>">
						&#9776;
					</button>
				</div>
			</div>
		</header>

		<!-- Mobile Drawer Menu Overlay and Panel (Hidden by default, shown via CSS active state) -->
		<div class="mobile-menu-overlay" style="display: none;">
			<div class="mobile-menu-drawer">
				<!-- Drawer Header -->
				<div class="drawer-header">
					<div class="drawer-logo">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<img src="<?php echo listeners_blog_get_logo_url(); ?>" alt="<?php bloginfo('name'); ?>">
						</a>
					</div>
					<div class="drawer-header-actions">
						<a href="<?php echo $Siteurl ?>/download-application" class="btn-drawer-download"><?php esc_html_e('Download App', 'listeners-blog'); ?></a>
						<button class="mobile-drawer-close" aria-label="<?php esc_attr_e('Close Menu', 'listeners-blog'); ?>">
							&times;
						</button>
					</div>
				</div>

				<!-- Drawer Menu Links -->
				<nav class="drawer-nav">
					<ul class="drawer-menu-list">
						<li><a href="<?php echo esc_url(home_url('/')); ?>" class="drawer-link"><?php esc_html_e('Home', 'listeners-blog'); ?></a></li>
						<li><a href="<?php echo $Siteurl ?>/experts" class="drawer-link"><?php esc_html_e('Find Experts', 'listeners-blog'); ?></a></li>
						<li><a href="<?php echo $Siteurl ?>/download-application" class="drawer-link font-bold-link"><?php esc_html_e('Download App', 'listeners-blog'); ?></a></li>
						<li><a href="<?php echo $Siteurl ?>/listeners" class="drawer-link"><?php esc_html_e('Talk To Listener', 'listeners-blog'); ?></a></li>
						<li><a href="<?php echo $Siteurl ?>/download-application" class="drawer-link text-secondary-link"><?php esc_html_e('Get Mobile App', 'listeners-blog'); ?></a></li>
						<li><a href="<?php echo $Siteurl ?>/contact" class="drawer-link text-secondary-link"><?php esc_html_e('Contact Support', 'listeners-blog'); ?></a></li>
					</ul>
				</nav>

				<!-- Drawer Stacked Buttons at Bottom -->
				<div class="drawer-footer-actions">
					<a href="<?php echo $Siteurl ?>/listeners" class="btn-talk-listeners-pill"><?php esc_html_e('Talk to Listeners', 'listeners-blog'); ?></a>
					<a href="<?php echo $Siteurl ?>/experts" class="btn-talk-experts-pill"><?php esc_html_e('Talk to Experts', 'listeners-blog'); ?></a>
				</div>
			</div>
		</div>

		<div id="content" class="site-content">