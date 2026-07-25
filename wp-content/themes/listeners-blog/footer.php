<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 * Matches listenersconnect.com/blogs footer exactly.
 *
 * @package Listeners_Blog
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
$siteUrl = "https://www.listenersconnect.com";
?>
</div><!-- #content -->

<footer id="colophon" class="site-footer">
	<!-- SVG waves decoration at the top of the footer -->
	<div class="footer-waves">
		<svg viewBox="0 0 1440 200" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
			<!-- Layer 1: Back wave (lightest) -->
			<path d="M0,90 C320,130 560,180 840,140 C1120,100 1280,60 1440,80 L1440,200 L0,200 Z" fill="#181422" />
			<!-- Layer 2: Middle wave -->
			<path d="M0,120 C360,60 720,165 1080,125 C1260,105 1350,135 1440,115 L1440,200 L0,200 Z" fill="#100C17" />
			<!-- Layer 3: Front wave (matches footer bg) -->
			<path d="M0,150 C400,110 800,180 1120,140 C1280,120 1360,165 1440,155 L1440,200 L0,200 Z" fill="#08080A" />
		</svg>
	</div>

	<div class="container">
		<div class="footer-grid">
			<!-- Column 1: Brand Info & Socials -->
			<div class="footer-brand-column">
				<div class="footer-logo-container">
					<!-- Logo SVG -->
					<div class="footer-logo">
						<a href="<?php echo $siteUrl; ?>" rel="home">
							<img src="<?php echo listeners_blog_get_logo_url(); ?>" alt="<?php bloginfo('name'); ?>">
						</a>
					</div>
				</div>
				<p class="footer-description">
					<?php
					echo esc_html(get_theme_mod('listeners_blog_footer_description', __('Listeners Connect is an online emotional support and relationship guidance platform where you can talk freely with supportive listeners for dating advice, relationship clarity, breakup healing, anxiety support, and meaningful human connection — anytime, anywhere.', 'listeners-blog')));
					?>
				</p>

				<!-- Social Media Links -->
				<div class="footer-socials">
					<?php
					$facebook_url  = get_theme_mod('listeners_blog_facebook_link', 'https://facebook.com/listenersconnect');
					$instagram_url = get_theme_mod('listeners_blog_instagram_link', 'https://instagram.com/listenersconnect');
					$linkedin_url  = get_theme_mod('listeners_blog_linkedin_link', 'https://linkedin.com/company/listenersconnect');
					$youtube_url   = get_theme_mod('listeners_blog_youtube_link', 'https://youtube.com/listenersconnect');
					?>
					<?php if (! empty($facebook_url)) : ?>
						<a href="<?php echo esc_url($facebook_url); ?>" class="social-btn" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c4.56-.93 8-4.96 8-9.75z" />
							</svg>
						</a>
					<?php endif; ?>
					<?php if (! empty($instagram_url)) : ?>
						<a href="<?php echo esc_url($instagram_url); ?>" class="social-btn" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
							</svg>
						</a>
					<?php endif; ?>
					<?php if (! empty($linkedin_url)) : ?>
						<a href="<?php echo esc_url($linkedin_url); ?>" class="social-btn" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
							</svg>
						</a>
					<?php endif; ?>
					<?php if (! empty($youtube_url)) : ?>
						<a href="<?php echo esc_url($youtube_url); ?>" class="social-btn" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
							<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path d="M23.498 6.163a3.003 3.003 0 00-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.517 0-9.388.508a3.003 3.003 0 00-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 002.11 2.11c1.871.508 9.388.508 9.388.508s7.517 0 9.388-.508a3.003 3.003 0 002.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
							</svg>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<!-- Column 2: Explore Services -->
			<div>
				<h3 class="footer-title"><?php esc_html_e('Explore Services', 'listeners-blog'); ?></h3>
				<ul class="footer-links-list">
					<li><a href="<?php echo $siteUrl ?>/experts/dating">
							<h4><?php esc_html_e('Dating', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/experts/relationship">
							<h4><?php esc_html_e('Relationship', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/experts/breakup-recovery">
							<h4><?php esc_html_e('Breakup Recovery', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/experts/pre-marital">
							<h4><?php esc_html_e('Pre-Marital', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/experts/marriage-guidance">
							<h4><?php esc_html_e('Marriage Guidance', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/experts/divorce-healing">
							<h4><?php esc_html_e('Divorce Healing', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/experts/anxiety-support">
							<h4><?php esc_html_e('Anxiety Support', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/experts/spiritual-healing">
							<h4><?php esc_html_e('Spiritual Healing', 'listeners-blog'); ?></h4>
						</a></li>
				</ul>
			</div>

			<!-- Column 3: Useful Links -->
			<div>
				<h3 class="footer-title"><?php esc_html_e('Useful Links', 'listeners-blog'); ?></h3>
				<ul class="footer-links-list">
					<li><a href="<?php echo $siteUrl ?>/contact">
							<h4><?php esc_html_e('Contact Us', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/about">
							<h4><?php esc_html_e('About Us', 'listeners-blog'); ?></h4>
						</a></li>
					<li>
						<a href="<?php echo $siteUrl ?>/become-a-partner"><?php esc_html_e('Join as', 'listeners-blog'); ?>&nbsp;
							<span class="expert-link" style="color: #FF4D8D; display: inline-block;">
								<h4><?php esc_html_e('a Listener', 'become-a-partner'); ?></h4>
							</span>
						</a>
					</li>
					<li><a href="<?php echo $siteUrl ?>/safety">
							<h4><?php esc_html_e('Safety Guidelines', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/register-guidelines">
							<h4><?php esc_html_e('Register Guidelines', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/community">
							<h4><?php esc_html_e('Community Guidelines', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/faqs">
							<h4><?php esc_html_e('FAQs', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/terms">
							<h4><?php esc_html_e('Terms & Conditions', 'listeners-blog'); ?></h4>
						</a></li>
					<li><a href="<?php echo $siteUrl ?>/privacy">
							<h4><?php esc_html_e('Privacy Policy', 'listeners-blog'); ?></h4>
						</a></li>
				</ul>
			</div>

			<!-- Column 4: App Badges (Official SVG Badges side-by-side) -->
			<div>
				<h3 class="footer-title"><?php esc_html_e('Get Download Our App', 'listeners-blog'); ?></h3>
				<div class="footer-app-badges">
					<a href="<?php echo $siteUrl ?>/download-application" target="_blank" rel="noopener noreferrer" class="footer-app-link">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/play-store-button.svg" alt="Get it on Google Play" />
					</a>
					<a href="<?php echo $siteUrl ?>/download-application" target="_blank" rel="noopener noreferrer" class="footer-app-link">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/app-store-button.svg" alt="Download on the App Store" />
					</a>
				</div>
			</div>
		</div>

		<!-- Footer Bottom -->
		<div class="footer-bottom">
			<div class="footer-copyright">
				<p style="text-align:center;">
					<?php
					$copyright_text = get_theme_mod('listeners_blog_copyright_text');
					if (empty($copyright_text)) {
						$copyright_text = __('Copyright © 2026 Listeners - All Rights Reserved.', 'listeners-blog');
					}
					echo wp_kses_post($copyright_text);
					?>
				</p>
			</div>
			<nav class="footer-nav" aria-label="<?php esc_attr_e('Footer Menu', 'listeners-blog'); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-footer',
						'menu_id'        => 'footer-menu',
						'fallback_cb'    => false,
						'container'      => false,
						'depth'          => 1,
					)
				);
				?>
			</nav>
		</div>
	</div>
</footer>
</div><!-- #page -->

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var expertLinks = document.querySelectorAll('.expert-link h4');
		if (expertLinks.length === 0) {
			expertLinks = document.querySelectorAll('.expert-link');
		}
		if (expertLinks.length === 0) return;
		
		var showListener = false;
		setInterval(function() {
			expertLinks.forEach(function(el) {
				el.style.transition = 'opacity 400ms';
				el.style.opacity = '0';
				
				setTimeout(function() {
					if (showListener) {
						el.textContent = 'a Listener';
					} else {
						el.textContent = 'an Expert';
					}
					el.style.opacity = '1';
				}, 400);
			});
			showListener = !showListener;
		}, 3000);
	});
</script>

<?php wp_footer(); ?>
</body>

</html>