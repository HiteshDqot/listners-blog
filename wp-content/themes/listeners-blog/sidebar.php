<?php
/**
 * The sidebar containing the main widget area
 *
 * Displays widgets styled exactly like the sidebar cards in listenersconnect.com/blogs.
 *
 * @package Listeners_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<aside id="secondary" class="sidebar-area">
	<?php
	if ( is_active_sidebar( 'sidebar-1' ) ) :
		ob_start();
		dynamic_sidebar( 'sidebar-1' );
		$sidebar_html = ob_get_clean();
		// Replace "Recent Posts" with "Recent Insights"
		$sidebar_html = str_replace( 'Recent Posts', 'Recent Insights', $sidebar_html );
		echo $sidebar_html;
	else :
		// Fallback Widgets styled exactly like the target site
		?>
		
		<!-- Widget 1: Search -->
		<section class="sidebar-widget">
			<h3 class="sidebar-widget-title"><?php esc_html_e( 'Search here', 'listeners-blog' ); ?></h3>
			<?php get_search_form(); ?>
		</section>

		<!-- Widget 2: Recent Insights -->
		<section class="sidebar-widget">
			<h3 class="sidebar-widget-title"><?php esc_html_e( 'Recent Insights', 'listeners-blog' ); ?></h3>
			<div class="recent-insights-list">
				<?php
				$recent_posts = new WP_Query(
					array(
						'posts_per_page'      => 3,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
					)
				);

				if ( $recent_posts->have_posts() ) :
					while ( $recent_posts->have_posts() ) :
						$recent_posts->the_post();
						?>
						<div class="insight-item">
							<div class="insight-thumb">
								<a href="<?php the_permalink(); ?>">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( array( 64, 64 ) ); ?>
									<?php else : ?>
										<div style="width: 100%; height: 100%; background: var(--gradient-accent); opacity: 0.2;"></div>
									<?php endif; ?>
								</a>
							</div>
							<div class="insight-content">
								<h4 class="insight-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h4>
								<span class="insight-date"><?php echo esc_html( get_the_date( 'j M, Y' ) ); ?></span>
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<p style="color: var(--text-muted); font-size: 0.9rem;"><?php esc_html_e( 'No recent posts found.', 'listeners-blog' ); ?></p>
				<?php
				endif;
				?>
			</div>
		</section>

		<!-- Widget 3: Categories -->
		<section class="sidebar-widget">
			<h3 class="sidebar-widget-title"><?php esc_html_e( 'Categories', 'listeners-blog' ); ?></h3>
			<ul class="categories-widget-list">
				<?php
				$categories = get_categories();
				if ( ! empty( $categories ) ) :
					foreach ( $categories as $category ) :
						?>
						<li>
							<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
								<span><?php echo esc_html( $category->name ); ?></span>
								<span style="font-size: 0.8rem; opacity: 0.6;">(<?php echo esc_html( $category->count ); ?>)</span>
							</a>
						</li>
						<?php
					endforeach;
				else :
					?>
					<li><a href="#"><span><?php esc_html_e( 'Relationship', 'listeners-blog' ); ?></span></a></li>
					<li><a href="#"><span><?php esc_html_e( 'Anxiety Support', 'listeners-blog' ); ?></span></a></li>
					<li><a href="#"><span><?php esc_html_e( 'Dating', 'listeners-blog' ); ?></span></a></li>
				<?php
				endif;
				?>
			</ul>
		</section>

		<!-- Widget 4: Tags -->
		<section class="sidebar-widget">
			<h3 class="sidebar-widget-title"><?php esc_html_e( 'Tags', 'listeners-blog' ); ?></h3>
			<div class="tags-widget-cloud">
				<?php
				$tags = get_tags();
				if ( ! empty( $tags ) ) :
					foreach ( $tags as $tag ) :
						?>
						<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>">
							<?php echo esc_html( $tag->name ); ?>
						</a>
						<?php
					endforeach;
				else :
					?>
					<a href="#"><?php esc_html_e( 'Love', 'listeners-blog' ); ?></a>
					<a href="#"><?php esc_html_e( 'Dating', 'listeners-blog' ); ?></a>
					<a href="#"><?php esc_html_e( 'Anxiety', 'listeners-blog' ); ?></a>
					<a href="#"><?php esc_html_e( 'Marriage', 'listeners-blog' ); ?></a>
				<?php
				endif;
				?>
			</div>
		</section>
		
	<?php
	endif;
	?>
</aside>
