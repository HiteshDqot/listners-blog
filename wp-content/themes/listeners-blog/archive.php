<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Listeners_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<section class="hero-section">
	<div class="container">
		<?php
		the_archive_title( '<h2 class="hero-title">', '</h2>' );
		the_archive_description( '<div class="hero-desc">', '</div>' );
		?>
	</div>
</section>

<div class="container">
	<main id="primary" class="site-main">
		<div class="content-area-grid">
			
			<div class="content-left">
				<?php if ( have_posts() ) : ?>
					<div class="posts-loop-grid">
						<?php
						while ( have_posts() ) :
							the_post();
							?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
								<div class="post-card-thumbnail">
									<?php if ( has_post_thumbnail() ) : ?>
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'large' ); ?>
										</a>
									<?php else : ?>
										<a href="<?php the_permalink(); ?>">
											<div style="width: 100%; height: 100%; background: var(--gradient-primary); opacity: 0.15; position: absolute; top:0; left:0;"></div>
											<div style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--text-muted); font-weight: 700; font-size: 1.5rem; font-family: var(--font-heading);"><?php esc_html_e( 'LISTEN', 'listeners-blog' ); ?></div>
										</a>
									<?php endif; ?>
									
									<?php
									$categories = get_the_category();
									if ( ! empty( $categories ) ) :
										?>
										<span class="post-badge">
											<?php echo esc_html( $categories[0]->name ); ?>
										</span>
									<?php endif; ?>
								</div>

								<div class="post-card-content">
									<div class="post-card-meta">
										<span class="post-date"><?php echo esc_html( get_the_date() ); ?></span>
										<span class="post-read-time"><?php echo esc_html( listeners_blog_reading_time() ); ?></span>
									</div>

									<h3 class="post-card-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>

									<div class="post-card-excerpt">
										<?php the_excerpt(); ?>
									</div>

									<div class="post-card-footer">
										<div class="post-author">
											<?php echo get_avatar( get_the_author_meta( 'ID' ), 28 ); ?>
											<span><?php the_author(); ?></span>
										</div>
										<a class="post-read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'listeners-blog' ); ?></a>
									</div>
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
									data-card-style="post-card"
									data-query="<?php echo esc_attr(json_encode($wp_query->query_vars)); ?>">
								<span><?php esc_html_e('Load More', 'listeners-blog'); ?></span>
							</button>
						</div>
					<?php endif; ?>

				<?php else : ?>
					<div class="no-posts-found">
						<h2><?php esc_html_e( 'Nothing Found', 'listeners-blog' ); ?></h2>
						<p><?php esc_html_e( 'It seems there are no posts published in this archive yet.', 'listeners-blog' ); ?></p>
					</div>
				<?php endif; ?>
			</div><!-- .content-left -->

			<div class="content-right">
				<?php get_sidebar(); ?>
			</div>

		</div><!-- .content-area-grid -->
	</main><!-- #primary -->
</div><!-- .container -->

<?php
get_footer();
