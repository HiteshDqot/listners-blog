<?php

/**
 * The template for displaying tag pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Listeners_Blog
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header();

// Get queried tag object
$current_tag      = get_queried_object();
$tag_name         = $current_tag->name;
$tag_desc         = tag_description();
$post_count       = $current_tag->count;
$post_count_label = sprintf(_n('%d Post', '%d Posts', $post_count, 'listeners-blog'), $post_count);
?>

<section class="tag-header-section">
	<div class="container">
		<div class="tag-header-card">
			<div class="tag-header-left">
				<h1 class="tag-header-title"><?php echo esc_html($tag_name); ?></h1>
				<?php if (! empty($tag_desc)) : ?>
					<div class="tag-header-description">
						<?php echo wp_kses_post($tag_desc); ?>
					</div>
				<?php else : ?>
					<p class="tag-header-description">
						<?php printf(esc_html__('Explore the latest articles, insights, and stories tagged with "%s".', 'listeners-blog'), esc_html($tag_name)); ?>
					</p>
				<?php endif; ?>
			</div>
			<div class="tag-header-right">
				<div class="tag-post-count-badge">
					<span class="count-number"><?php echo esc_html($post_count_label); ?></span>
					<span class="count-icon">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
							<line x1="7" y1="7" x2="7.01" y2="7"></line>
						</svg>
					</span>
				</div>
			</div>
		</div>
	</div>
</section>

<main id="primary" class="site-main">
	<div class="container">
		<?php if (have_posts()) : ?>
			<div class="tag-posts-grid">
				<?php
				while (have_posts()) :
					the_post();
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class('listeners-card'); ?>>
						<!-- Card Thumbnail & Category Badge -->
						<div class="card-img-wrapper">
							<a href="<?php the_permalink(); ?>">
								<?php if (has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('large'); ?>
								<?php else : ?>
									<!-- Decorative placeholder gradient matching theme -->
									<div style="width: 100%; height: 100%; background: var(--gradient-accent); opacity: 0.15; position: absolute; top:0; left:0;"></div>
									<div style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--text-muted); font-weight: 700; font-size: 1.5rem; font-family: var(--font-heading);"><?php esc_html_e('LISTENERS', 'listeners-blog'); ?></div>
								<?php endif; ?>
							</a>

							<!-- Badge -->
							<?php
							$categories = get_the_category();
							if (! empty($categories)) :
							?>
								<a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="card-category-badge badge-<?php echo esc_attr($categories[0]->slug); ?>">
									<?php echo esc_html($categories[0]->name); ?>
								</a>
							<?php endif; ?>
						</div>

						<!-- Card Body -->
						<div class="card-body">
							<h2 class="card-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>

							<div class="card-excerpt">
								<?php the_excerpt(); ?>
							</div>

							<a href="<?php the_permalink(); ?>" class="card-readmore-link"><?php esc_html_e('READ MORE', 'listeners-blog'); ?></a>
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
			<div style="text-align: center; padding: 4rem 1.5rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--border-radius-card); margin-bottom: 5rem;">
				<h3 style="margin-bottom: 1rem;"><?php esc_html_e('Nothing Found', 'listeners-blog'); ?></h3>
				<p style="color: var(--text-secondary);"><?php esc_html_e('It seems there are no posts tagged with this tag.', 'listeners-blog'); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
