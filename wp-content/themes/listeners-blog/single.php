<?php
/**
 * The template for displaying all single posts
 *
 * Displays the blog post detail page exactly like listenersconnect.com/blogs detail page.
 * Uses a 2-column layout (70% content left, 30% sidebar right).
 *
 * @package Listeners_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<div class="container">
	<div class="detail-layout-grid">
		<!-- Left: Post Content Area -->
		<div class="detail-content-area">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
					<!-- Large Featured Image -->
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="detail-featured-image">
							<?php the_post_thumbnail( 'full' ); ?>
						</div>
					<?php endif; ?>

					<!-- Post Title -->
					<h1 class="detail-title"><?php the_title(); ?></h1>

					<!-- Post Metadata (Author, Date, Reading Time, Category) -->
					<div class="detail-meta">
						<span class="meta-author">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 24 ); ?>
							<span><?php esc_html_e( 'By', 'listeners-blog' ); ?> <strong><?php the_author(); ?></strong></span>
						</span>
						<span class="meta-date">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
							<?php echo esc_html( get_the_date() ); ?>
						</span>
						<span class="meta-read-time">
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
							<?php echo esc_html( listeners_blog_reading_time() ); ?>
						</span>
						<?php
						$categories = get_the_category();
						if ( ! empty( $categories ) ) :
							?>
							<span class="meta-category">
								<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
								<a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
							</span>
						<?php endif; ?>
					</div>


					<!-- Post Body Content (Directly follows the title, exactly like the target site) -->
					<div class="detail-body">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'listeners-blog' ),
								'after'  => '</div>',
							)
						);
						?>
					</div>

					<!-- Post Tags -->
					<?php
					$tags = get_the_tags();
					if ( ! empty( $tags ) ) :
						?>
						<div class="post-tags" style="margin-top: 2.5rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
							<?php
							foreach ( $tags as $tag ) {
								echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" style="font-size: 0.8rem; background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border-color); padding: 0.4rem 0.85rem; border-radius: 8px; color: var(--text-secondary);">' . esc_html( $tag->name ) . '</a>';
							}
							?>
						</div>
					<?php endif; ?>

					<!-- Author Profile Section (Author Box) -->
					<div class="author-profile-box">
						<div class="author-profile-avatar">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 90 ); ?>
						</div>
						<div class="author-profile-info">
							<span class="author-label"><?php esc_html_e( 'WRITTEN BY', 'listeners-blog' ); ?></span>
							<h4 class="author-name">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
									<?php the_author(); ?>
								</a>
							</h4>
							<p class="author-bio">
								<?php 
								$author_description = get_the_author_meta( 'description' );
								if ( ! empty( $author_description ) ) {
									echo esc_html( $author_description );
								} else {
									/* translators: %s: Author name */
									printf(
										esc_html__( '%s is a passionate writer and emotional wellness advocate contributing to Listeners. Dedicated to helping individuals find clarity, comfort, and strength in their relationship and personal growth journeys.', 'listeners-blog' ),
										esc_html( get_the_author() )
									);
								}
								?>
							</p>
							<div class="author-profile-footer">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-posts-link">
									<?php 
									/* translators: %s: Author name */
									printf( esc_html__( 'View all articles by %s', 'listeners-blog' ), esc_html( get_the_author() ) ); 
									?> &rarr;
								</a>
							</div>
						</div>
					</div>

					<!-- Post Navigation (Previous/Next) -->
					<?php
					$prev_post = get_previous_post();
					$next_post = get_next_post();

					if ( $prev_post || $next_post ) :
						?>
						<div class="post-navigation-section">
							<div class="post-navigation-grid">
								<!-- Previous Post -->
								<div class="post-navigation-col prev-col">
									<?php if ( $prev_post ) : ?>
										<div class="navigation-label"><?php esc_html_e( 'Previous Post', 'listeners-blog' ); ?></div>
										<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="navigation-card">
											<div class="navigation-thumb">
												<?php if ( has_post_thumbnail( $prev_post->ID ) ) : ?>
													<?php echo get_the_post_thumbnail( $prev_post->ID, 'large' ); ?>
												<?php else : ?>
													<div class="nav-placeholder-gradient"></div>
													<div class="nav-placeholder-text"><?php esc_html_e( 'LISTENERS', 'listeners-blog' ); ?></div>
												<?php endif; ?>
											</div>
											<h4 class="navigation-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></h4>
										</a>
									<?php endif; ?>
								</div>

								<!-- Next Post -->
								<div class="post-navigation-col next-col">
									<?php if ( $next_post ) : ?>
										<div class="navigation-label"><?php esc_html_e( 'Next Post', 'listeners-blog' ); ?></div>
										<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="navigation-card">
											<div class="navigation-thumb">
												<?php if ( has_post_thumbnail( $next_post->ID ) ) : ?>
													<?php echo get_the_post_thumbnail( $next_post->ID, 'large' ); ?>
												<?php else : ?>
													<div class="nav-placeholder-gradient"></div>
													<div class="nav-placeholder-text"><?php esc_html_e( 'LISTENERS', 'listeners-blog' ); ?></div>
												<?php endif; ?>
											</div>
											<h4 class="navigation-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></h4>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php
					endif;
					?>

					<!-- Comments Stream -->
					<?php
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				</article>
				<?php
			endwhile;
			?>
		</div>

		<!-- Right: Sidebar Column -->
		<div class="sidebar-column">
			<!-- Table of Contents Widget -->
			<section id="blog-toc-widget" class="sidebar-widget toc-widget" style="display: none;">
				<h3 class="sidebar-widget-title"><?php esc_html_e( 'Table of Contents', 'listeners-blog' ); ?></h3>
				<div class="toc-content"></div>
			</section>

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php
get_footer();
