<?php
/**
 * Template Name: Sitemap
 *
 * Description: A custom page template to display a beautiful HTML sitemap.
 *
 * @package Listeners_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<section class="home-hero">
	<div class="container">
		<span class="card-category-badge" style="position: static; display: inline-block; margin-bottom: 1rem; background: var(--gradient-accent); box-shadow: 0 4px 12px rgba(255, 77, 141, 0.25);"><?php esc_html_e( 'DIRECTORY', 'listeners-blog' ); ?></span>
		<h1 class="home-hero-title"><?php esc_html_e( 'Website Sitemap', 'listeners-blog' ); ?></h1>
		<p class="home-hero-desc"><?php esc_html_e( 'Navigate through the structure of Listeners Blog. Find all pages, categories, tags, and articles below.', 'listeners-blog' ); ?></p>
	</div>
</section>

<div class="container">
	<main id="primary" class="site-main site-main-feed">
		
		<div class="sitemap-grid">
			
			<!-- SECTION: MAIN PAGES -->
			<div class="sitemap-card">
				<div class="sitemap-card-header">
					<h3 class="sitemap-card-title">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle; margin-right: 8px;">
							<path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="url(#sitemap-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M2 17L12 22L22 17" stroke="url(#sitemap-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M2 12L12 17L22 12" stroke="url(#sitemap-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<defs>
								<linearGradient id="sitemap-grad" x1="2" y1="2" x2="22" y2="22" gradientUnits="userSpaceOnUse">
									<stop stop-color="#8A2BE2"/>
									<stop offset="1" stop-color="#FF4D8D"/>
								</linearGradient>
							</defs>
						</svg>
						<?php esc_html_e( 'Core Pages', 'listeners-blog' ); ?>
					</h3>
				</div>
				<div class="sitemap-card-body">
					<ul class="sitemap-links">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Homepage', 'listeners-blog' ); ?></a></li>
						<?php
						$pages = get_pages( array(
							'sort_column' => 'post_title',
							'parent'      => 0,
						) );
						foreach ( $pages as $page ) {
							echo '<li><a href="' . esc_url( get_page_link( $page->ID ) ) . '">' . esc_html( $page->post_title ) . '</a></li>';
						}
						?>
					</ul>
				</div>
			</div>

			<!-- SECTION: CATEGORIES -->
			<div class="sitemap-card">
				<div class="sitemap-card-header">
					<h3 class="sitemap-card-title">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle; margin-right: 8px;">
							<path d="M22 19V5C22 3.89543 21.1046 3 20 3H4C2.89543 3 2 3.89543 2 5V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19Z" stroke="url(#sitemap-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M2 7H22" stroke="url(#sitemap-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M9 21V7" stroke="url(#sitemap-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<?php esc_html_e( 'Categories', 'listeners-blog' ); ?>
					</h3>
				</div>
				<div class="sitemap-card-body">
					<ul class="sitemap-links">
						<?php
						$categories = get_categories( array(
							'orderby' => 'name',
							'parent'  => 0,
						) );
						foreach ( $categories as $category ) {
							echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . ' <span class="count-badge">' . $category->count . '</span></a></li>';
						}
						?>
					</ul>
				</div>
			</div>

			<!-- SECTION: POSTS -->
			<div class="sitemap-card sitemap-card-wide">
				<div class="sitemap-card-header">
					<h3 class="sitemap-card-title">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle; margin-right: 8px;">
							<path d="M12 20H21" stroke="url(#sitemap-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M16.5 3.5C16.8978 3.10217 17.4374 2.87868 18 2.87868C18.2786 2.87868 18.5546 2.93355 18.812 3.04015C19.0694 3.14676 19.3033 3.30301 19.5 3.5C19.6967 3.69699 19.8529 3.93085 19.9596 4.18821C20.0662 4.44557 20.1211 4.72143 20.1211 5C20.1211 5.27857 20.0662 5.55443 19.9596 5.81179C19.8529 6.06915 19.6967 6.30301 19.5 6.5L7 19L3 20L4 16L16.5 3.5Z" stroke="url(#sitemap-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<?php esc_html_e( 'Latest Articles', 'listeners-blog' ); ?>
					</h3>
				</div>
				<div class="sitemap-card-body">
					<div class="sitemap-posts-list">
						<?php
						$recent_posts = get_posts( array(
							'numberposts' => 15,
							'post_status' => 'publish',
						) );
						foreach ( $recent_posts as $post ) {
							$post_date = get_the_date( 'M d, Y', $post->ID );
							$post_cat = get_the_category( $post->ID );
							$cat_name = ! empty( $post_cat ) ? $post_cat[0]->name : '';
							?>
							<div class="sitemap-post-item">
								<span class="sitemap-post-date"><?php echo esc_html( $post_date ); ?></span>
								<a class="sitemap-post-link" href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php echo esc_html( $post->post_title ); ?></a>
								<?php if ( $cat_name ) : ?>
									<span class="sitemap-post-category"><?php echo esc_html( $cat_name ); ?></span>
								<?php endif; ?>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>

			<!-- SECTION: TAGS / TOPICS -->
			<div class="sitemap-card sitemap-card-wide">
				<div class="sitemap-card-header">
					<h3 class="sitemap-card-title">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle; margin-right: 8px;">
							<path d="M20.59 13.41L13.41 20.59C13.2243 20.776 13.0037 20.9234 12.761 21.0241C12.5183 21.1247 12.2581 21.1767 11.9953 21.1767C11.7326 21.1767 11.4724 21.1247 11.2297 21.0241C10.987 20.9234 10.7664 20.776 10.58 20.59L2 12V2H12L20.59 10.59C20.963 10.9649 21.1725 11.4722 21.1725 12C21.1725 12.5278 20.963 13.0351 20.59 13.41Z" stroke="url(#sitemap-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M7 7H7.01" stroke="url(#sitemap-grad)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<?php esc_html_e( 'Popular Tags & Topics', 'listeners-blog' ); ?>
					</h3>
				</div>
				<div class="sitemap-card-body">
					<div class="sitemap-tags-cloud">
						<?php
						$tags = get_tags( array(
							'orderby' => 'count',
							'order'   => 'DESC',
							'number'  => 30,
						) );
						if ( ! empty( $tags ) ) {
							foreach ( $tags as $tag ) {
								echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="sitemap-tag-pill">' . esc_html( $tag->name ) . ' <span class="tag-count">(' . $tag->count . ')</span></a>';
							}
						} else {
							echo '<p class="text-muted">' . esc_html__( 'No tags found.', 'listeners-blog' ) . '</p>';
						}
						?>
					</div>
				</div>
			</div>

		</div>
		
	</main>
</div>

<?php
get_footer();
