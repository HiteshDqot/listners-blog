<?php
/**
 * The template for displaying author archive pages
 *
 * Displays a beautiful profile header card for the author and a grid layout of their posts.
 * Uses a consistent dark theme matching listenersconnect.com/blogs.
 *
 * @package Listeners_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

// Get queried author object
$author = get_queried_object();
$author_id = $author->ID;
$author_name = get_the_author_meta( 'display_name', $author_id );
$author_desc = get_the_author_meta( 'description', $author_id );
$author_avatar = get_avatar( $author_id, 110 );
$post_count = count_user_posts( $author_id );
$post_count_label = sprintf( _n( '%d Post Written', '%d Posts Written', $post_count, 'listeners-blog' ), $post_count );
?>

<section class="author-header-section">
	<div class="container">
		<div class="author-header-card">
			<div class="author-header-left">
				<div class="author-header-avatar">
					<?php echo $author_avatar; ?>
				</div>
				<div class="author-header-info">
					<span class="author-badge"><?php esc_html_e( 'AUTHOR PROFILE', 'listeners-blog' ); ?></span>
					<h1 class="author-header-title"><?php echo esc_html( $author_name ); ?></h1>
					<?php if ( ! empty( $author_desc ) ) : ?>
						<p class="author-header-description">
							<?php echo esc_html( $author_desc ); ?>
						</p>
					<?php else : ?>
						<p class="author-header-description">
							<?php printf( esc_html__( '%s is a passionate contributor to Listeners. Dedicated to helping individuals find clarity, comfort, and strength.', 'listeners-blog' ), esc_html( $author_name ) ); ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
			<div class="author-header-right">
				<div class="author-post-count-badge">
					<span class="count-number"><?php echo esc_html( $post_count_label ); ?></span>
					<span class="count-icon">
						<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
							<path d="M12 20h9"></path>
							<path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
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
				<p style="color: var(--text-secondary);"><?php esc_html_e( 'It seems there are no posts published by this author yet.', 'listeners-blog' ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
