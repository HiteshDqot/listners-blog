<?php

/**
 * The main template file
 *
 * Displays the homepage blog posts loop exactly like listenersconnect.com/blogs.
 * Includes a centered hero title & description and a full-width 4-column grid layout (no sidebar).
 *
 * @package Listeners_Blog
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<!-- Hero Section -->
<section class="home-hero">
	<div class="container">
		<h1 class="home-hero-title"><?php esc_html_e('Listeners — Someone Who Truly Listens', 'listeners-blog'); ?></h1>
		<p class="home-hero-desc">
			<?php esc_html_e('You Don\'t Have To Face Love, Heartbreak, Or Loneliness Alone. Talk To Compassionate Listeners And Experts Who Understand Your Feelings And Help You Find Clarity, Comfort, And Strength.', 'listeners-blog'); ?>
		</p>
	</div>
</section>

<!-- Blog Grid Main Feed -->
<main id="primary" class="site-main-feed">
	<div class="container">
		<?php if (have_posts()) : ?>
			<div class="home-posts-grid">
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
			<div style="text-align: center; padding: 4rem 1.5rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--border-radius-card);">
				<h3 style="margin-bottom: 1rem;"><?php esc_html_e('Nothing Found', 'listeners-blog'); ?></h3>
				<p style="color: var(--text-secondary);"><?php esc_html_e('It seems there are no posts published yet.', 'listeners-blog'); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<!-- Visual Stories Section -->
<?php
$paged_stories = isset($_GET['paged_stories']) ? max(1, intval($_GET['paged_stories'])) : 1;
$stories_per_page = 10; // 5 columns on desktop, 10 stories shows 2 complete rows

$stories_query = new WP_Query(array(
	'post_type'      => 'web-story',
	'post_status'    => 'publish',
	'posts_per_page' => $stories_per_page,
	'paged'          => $paged_stories,
));

if ($stories_query->have_posts()) :
?>
	<section id="stories-section" class="home-web-stories-section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php esc_html_e('Visual Stories', 'listeners-blog'); ?></h2>
				<p class="section-desc">
					<?php esc_html_e('Swipe through our quick and visually engaging mental health & relationship stories.', 'listeners-blog'); ?>
				</p>
			</div>

			<div class="stories-grid">
				<?php
				while ($stories_query->have_posts()) :
					$stories_query->the_post();
					$story_id = get_the_ID();

					// Get poster image from plugin metadata, fallback to standard featured image
					$poster_url = '';
					$poster_meta = get_post_meta($story_id, 'web_stories_poster', true);
					if (is_array($poster_meta) && !empty($poster_meta['url'])) {
						$poster_url = $poster_meta['url'];
					} else {
						$poster_url = get_the_post_thumbnail_url($story_id, 'large');
					}

					// Final fallback inline gradient placeholder if no image exists
					$has_image = !empty($poster_url);
				?>
					<a href="<?php the_permalink(); ?>" class="story-card" target="_blank" rel="noopener">
						<div class="story-poster-wrapper">
							<?php if ($has_image) : ?>
								<img src="<?php echo esc_url($poster_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" />
							<?php else : ?>
								<div style="width: 100%; height: 100%; background: var(--gradient-accent); opacity: 0.15; position: absolute; top: 0; left: 0;"></div>
								<div style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--text-muted); font-weight: 700; font-size: 1.2rem; font-family: var(--font-heading); text-align: center; padding: 1rem;"><?php esc_html_e('STORY', 'listeners-blog'); ?></div>
							<?php endif; ?>
						</div>
						<div class="story-overlay"></div>
						<div class="story-content">
							<span class="story-badge"><?php esc_html_e('Story', 'listeners-blog'); ?></span>
							<h3 class="story-title"><?php the_title(); ?></h3>
						</div>
					</a>
				<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>

			<?php if ($stories_query->max_num_pages > 1) : ?>
				<div class="stories-pagination pagination">
					<nav class="navigation" role="navigation">
						<div class="nav-links">
							<?php
							$big = 999999999;
							echo paginate_links(array(
								'base'      => str_replace($big, '%#%', esc_url(add_query_arg('paged_stories', $big))) . '#stories-section',
								'format'    => '?paged_stories=%#%',
								'current'   => $paged_stories,
								'total'     => $stories_query->max_num_pages,
								'prev_text' => sprintf('<span>%s</span>', esc_html__('Prev', 'listeners-blog')),
								'next_text' => sprintf('<span>%s</span>', esc_html__('Next', 'listeners-blog')),
								'type'      => 'plain',
							));
							?>
						</div>
					</nav>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>

<!-- YouTube Shorts Section -->
<?php
$shorts_query = new WP_Query(array(
	'post_type'      => 'youtube-short',
	'post_status'    => 'publish',
	'posts_per_page' => 5,
	'orderby'        => 'date',
	'order'          => 'DESC',
));

$shorts_to_display = array();

if ($shorts_query->have_posts()) {
	while ($shorts_query->have_posts()) {
		$shorts_query->the_post();
		$url = get_post_meta(get_the_ID(), '_youtube_short_url', true);
		$video_id = listeners_blog_get_youtube_id($url);
		if ($video_id) {
			$shorts_to_display[] = array(
				'title'    => get_the_title(),
				'video_id' => $video_id,
			);
		}
	}
	wp_reset_postdata();
}

// Fallbacks if no custom posts are published yet
if (empty($shorts_to_display)) {
	$shorts_to_display = array(
		array('title' => 'YouTube Short 1', 'video_id' => 'VKmEhHlDr34'),
		array('title' => 'YouTube Short 2', 'video_id' => 'VKmEhHlDr34'),
		array('title' => 'YouTube Short 3', 'video_id' => 'VKmEhHlDr34'),
		array('title' => 'YouTube Short 4', 'video_id' => 'VKmEhHlDr34'),
		array('title' => 'YouTube Short 5', 'video_id' => 'VKmEhHlDr34'),
	);
}

if (!empty($shorts_to_display)) :
?>
	<section class="home-youtube-shorts-section">
		<div class="container">
			<div class="section-header">
				<h2 class="section-title"><?php esc_html_e('YouTube Shorts', 'listeners-blog'); ?></h2>
				<p class="section-desc">
					<?php esc_html_e('Watch our latest quick video tips and insights on emotional guidance and relationship health.', 'listeners-blog'); ?>
				</p>
			</div>

			<div class="youtube-shorts-grid">
				<?php foreach ($shorts_to_display as $short) : ?>
					<div class="short-card-wrapper">
						<iframe
							src="<?php echo esc_url('https://www.youtube.com/embed/' . $short['video_id']); ?>"
							title="<?php echo esc_attr($short['title']); ?>"
							frameborder="0"
							allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
							referrerpolicy="strict-origin-when-cross-origin"
							allowfullscreen>
						</iframe>
						<div class="short-ai-blocker"></div>
						<div class="short-overlay" data-video-id="<?php echo esc_attr($short['video_id']); ?>" style="background-image: url('https://img.youtube.com/vi/<?php echo esc_attr($short['video_id']); ?>/hqdefault.jpg');">
							<div class="short-play-btn-wrapper"></div>
							<div class="short-overlay-title-wrapper">
								<span class="short-overlay-badge"><?php esc_html_e('Short', 'listeners-blog'); ?></span>
								<h3 class="short-overlay-title"><?php //echo esc_html($short['title']); 
																?></h3>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
get_footer();
