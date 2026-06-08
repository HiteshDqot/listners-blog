<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Listeners_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$site_url = "https://listenersconnect.com";
?>

<main id="primary" class="site-main site-main-404">
	<div class="container">
		<div class="error404-container">
			<div class="error404-icon-container">
				<div class="absolute-heart-1">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart error404-heart-pulse-1" aria-hidden="true">
						<path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path>
					</svg>
				</div>
				<div class="absolute-sparkle">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles error404-sparkle" aria-hidden="true">
						<path d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z"></path>
						<path d="M20 2v4"></path>
						<path d="M22 4h-4"></path>
						<circle cx="4" cy="20" r="2"></circle>
					</svg>
				</div>
				<div class="absolute-heart-2">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart error404-heart-pulse-2" aria-hidden="true">
						<path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"></path>
					</svg>
				</div>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-crack error404-heart-crack" aria-hidden="true">
					<path d="M12.409 5.824c-.702.792-1.15 1.496-1.415 2.166l2.153 2.156a.5.5 0 0 1 0 .707l-2.293 2.293a.5.5 0 0 0 0 .707L12 15"></path>
					<path d="M13.508 20.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5a5.5 5.5 0 0 1 9.591-3.677.6.6 0 0 0 .818.001A5.5 5.5 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5z"></path>
				</svg>
			</div>

			<h1 class="error404-code-title"><?php esc_html_e( '404', 'listeners-blog' ); ?></h1>
			<h2 class="error404-heading"><?php esc_html_e( 'Page Not Found', 'listeners-blog' ); ?></h2>
			<p class="error404-text"><?php esc_html_e( 'The page you are looking for doesn\'t exist or has been moved.', 'listeners-blog' ); ?></p>
			
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-home-404">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left arrow-icon" aria-hidden="true">
					<path d="m12 19-7-7 7-7"></path>
					<path d="M19 12H5"></path>
				</svg>
				<span><?php esc_html_e( 'Return to Home', 'listeners-blog' ); ?></span>
			</a>

			<div class="error404-quote-box">
				<p class="error404-quote-text"><?php esc_html_e( '"Sometimes the wrong path leads us to the right place. Every listener is here to help you find your way."', 'listeners-blog' ); ?></p>
			</div>

			<div class="error404-app-download">
				<p class="app-download-title"><?php esc_html_e( 'Get the Listeners App Download from', 'listeners-blog' ); ?></p>
				<div class="app-download-badges">
					<a href="<?php echo $site_url; ?>/download-application" target="_blank" rel="noopener noreferrer" class="app-badge-link">
						<img src="<?php echo $site_url; ?>/assets/play-store-button.svg" alt="<?php esc_attr_e( 'Get it on Google Play', 'listeners-blog' ); ?>" class="app-badge-img" />
					</a>
					<a href="<?php echo $site_url; ?>/download-application" target="_blank" rel="noopener noreferrer" class="app-badge-link">
						<img src="<?php echo $site_url; ?>/assets/app-Store-button.svg" alt="<?php esc_attr_e( 'Download on the App Store', 'listeners-blog' ); ?>" class="app-badge-img" />
					</a>
				</div>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
