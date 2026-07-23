<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Listeners_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

global $wp_query;
$total_results = $wp_query->found_posts;
?>

<section class="category-header-section search-header-section">
	<div class="container">
		<div class="category-header-card search-header-card">
			<div class="category-header-left">
				<span style="font-size: 0.9rem; font-weight: 600; color: var(--accent-pink); letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 0.5rem; display: block;"><?php esc_html_e( 'Search Results', 'listeners-blog' ); ?></span>
				<h1 class="category-header-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Results for: "%s"', 'listeners-blog' ), esc_html( get_search_query() ) );
					?>
				</h1>
				<p class="category-header-description">
					<?php 
					printf( _n( 'We found %d article matching your query.', 'We found %d articles matching your query.', $total_results, 'listeners-blog' ), $total_results );
					?>
				</p>
			</div>
			<div class="category-header-right">
				<div class="category-post-count-badge">
					<span class="count-number"><?php echo esc_html( sprintf( _n( '%d Result', '%d Results', $total_results, 'listeners-blog' ), $total_results ) ); ?></span>
					<span class="count-icon">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
						</svg>
					</span>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="container">
	<main id="primary" class="site-main">
		<div class="detail-layout-grid">
			<!-- Left Column: Search Results -->
			<div class="detail-content-area">
				<?php if ( have_posts() ) : ?>
					<div class="search-posts-grid">
						<?php
						while ( have_posts() ) :
							the_post();
							?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'listeners-card' ); ?>>
								<!-- Card Thumbnail & Category Badge -->
								<div class="card-img-wrapper">
									<a href="<?php the_permalink(); ?>">
										<?php if ( has_post_thumbnail() ) : ?>
											<?php the_post_thumbnail( 'large' ); ?>
										<?php else : ?>
											<!-- Decorative placeholder gradient matching theme -->
											<div style="width: 100%; height: 100%; background: var(--gradient-accent); opacity: 0.15; position: absolute; top:0; left:0;"></div>
											<div style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--text-muted); font-weight: 700; font-size: 1.5rem; font-family: var(--font-heading);"><?php esc_html_e( 'LISTENERS', 'listeners-blog' ); ?></div>
										<?php endif; ?>
									</a>
									
									<!-- Badge -->
									<?php
									$categories = get_the_category();
									if ( ! empty( $categories ) ) :
										?>
										<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="card-category-badge badge-<?php echo esc_attr( $categories[0]->slug ); ?>">
											<?php echo esc_html( $categories[0]->name ); ?>
										</a>
									<?php endif; ?>
								</div>

								<!-- Card Body -->
								<div class="card-body">
									<h3 class="card-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									
									<div class="card-excerpt">
										<?php the_excerpt(); ?>
									</div>
									
									<a href="<?php the_permalink(); ?>" class="card-readmore-link"><?php esc_html_e( 'READ MORE', 'listeners-blog' ); ?></a>
								</div>
							</article>
							<?php
						endwhile;
						?>
					</div>

					<!-- Load More Button -->
					<?php
					global $wp_query;
					if ($wp_query->max_num_pages > 1) :
					?>
						<div class="load-more-container">
							<button id="load-more-btn" class="load-more-btn"
									data-page="1"
									data-max-pages="<?php echo esc_attr($wp_query->max_num_pages); ?>"
									data-card-style="listeners-card"
									data-query="<?php echo esc_attr(json_encode($wp_query->query_vars)); ?>">
								<span><?php esc_html_e('Load More', 'listeners-blog'); ?></span>
							</button>
						</div>
					<?php endif; ?>

				<?php else : ?>
					<div class="no-results-card" style="text-align: center; padding: 5rem 2rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--border-radius-card); margin-bottom: 2rem; box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);">
						<div class="no-results-icon" style="display: inline-flex; align-items: center; justify-content: center; width: 80px; height: 80px; border-radius: 50%; background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border-color); margin-bottom: 1.5rem; color: var(--accent-pink);">
							<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
								<circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
							</svg>
						</div>
						<h3 style="margin-bottom: 1rem; color: #FFFFFF; font-size: 1.5rem; font-family: var(--font-heading);"><?php esc_html_e( 'No Results Found', 'listeners-blog' ); ?></h3>
						<p style="color: var(--text-secondary); max-width: 450px; margin: 0 auto 2rem; line-height: 1.6;"><?php esc_html_e( 'We couldn\'t find any articles matching your search query. Try searching with different keywords.', 'listeners-blog' ); ?></p>
						<div style="max-width: 400px; margin: 0 auto;">
							<?php get_search_form(); ?>
						</div>
					</div>
				<?php endif; ?>
			</div><!-- .detail-content-area -->

			<!-- Right Column: Sidebar -->
			<div class="sidebar-column">
				<?php get_sidebar(); ?>
			</div>
		</div><!-- .detail-layout-grid -->
	</main><!-- #primary -->
</div><!-- .container -->

<?php
get_footer();

