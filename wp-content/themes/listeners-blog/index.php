<?php
/**
 * The main template file
 *
 * Displays the homepage blog posts loop exactly like listenersconnect.com/blogs.
 * Includes a centered hero title & description and a full-width 4-column grid layout (no sidebar).
 *
 * @package Listeners_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<!-- Hero Section -->
<section class="home-hero">
	<div class="container">
		<h1 class="home-hero-title"><?php esc_html_e( 'Listeners — Someone Who Truly Listens', 'listeners-blog' ); ?></h1>
		<p class="home-hero-desc">
			<?php esc_html_e( 'You Don\'t Have To Face Love, Heartbreak, Or Loneliness Alone. Talk To Compassionate Listeners And Experts Who Understand Your Feelings And Help You Find Clarity, Comfort, And Strength.', 'listeners-blog' ); ?>
		</p>
	</div>
</section>

<!-- Blog Grid Main Feed -->
<main id="primary" class="site-main-feed">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="home-posts-grid">
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
			<div style="text-align: center; padding: 4rem 1.5rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--border-radius-card);">
				<h3 style="margin-bottom: 1rem;"><?php esc_html_e( 'Nothing Found', 'listeners-blog' ); ?></h3>
				<p style="color: var(--text-secondary);"><?php esc_html_e( 'It seems there are no posts published yet.', 'listeners-blog' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
