<?php
/**
 * The template for displaying category pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Listeners_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

// Get queried category object
$current_category = get_queried_object();
$category_name    = $current_category->name;
$category_desc    = category_description();
$post_count       = $current_category->count;
$post_count_label = sprintf( _n( '%d Post', '%d Posts', $post_count, 'listeners-blog' ), $post_count );
?>

<section class="category-header-section">
	<div class="container">
		<div class="category-header-card">
			<div class="category-header-left">
				<h1 class="category-header-title"><?php echo esc_html( $category_name ); ?></h1>
				<?php if ( ! empty( $category_desc ) ) : ?>
					<div class="category-header-description">
						<?php echo wp_kses_post( $category_desc ); ?>
					</div>
				<?php else : ?>
					<p class="category-header-description">
						<?php printf( esc_html__( 'Explore the latest articles, insights, and stories in %s.', 'listeners-blog' ), esc_html( $category_name ) ); ?>
					</p>
				<?php endif; ?>
			</div>
			<div class="category-header-right">
				<div class="category-post-count-badge">
					<span class="count-number"><?php echo esc_html( $post_count_label ); ?></span>
					<span class="count-icon">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
							<path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
						</svg>
					</span>
				</div>
			</div>
		</div>
	</div>
</section>

<main id="primary" class="site-main">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="category-posts-grid">
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

			<!-- Pagination -->
			<div class="pagination">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => sprintf( '<span>%s</span>', esc_html__( 'Prev', 'listeners-blog' ) ),
						'next_text' => sprintf( '<span>%s</span>', esc_html__( 'Next', 'listeners-blog' ) ),
					)
				);
				?>
			</div>

		<?php else : ?>
			<div style="text-align: center; padding: 4rem 1.5rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--border-radius-card); margin-bottom: 5rem;">
				<h3 style="margin-bottom: 1rem;"><?php esc_html_e( 'Nothing Found', 'listeners-blog' ); ?></h3>
				<p style="color: var(--text-secondary);"><?php esc_html_e( 'It seems there are no posts published in this category yet.', 'listeners-blog' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
