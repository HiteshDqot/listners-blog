<?php
/**
 * Dynamic XML Sitemap Generator for Listeners Blog
 */

// Disable loading theme files
if ( ! defined( 'WP_USE_THEMES' ) ) {
	define( 'WP_USE_THEMES', false );
}

// Load WordPress environment
if ( ! defined( 'ABSPATH' ) ) {
	require_once( './wp-load.php' );
}

// Set headers
header( 'Content-Type: application/xml; charset=utf-8' );
header( 'X-Robots-Tag: noindex, follow', true );

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<?xml-stylesheet type="text/xsl" href="' . esc_url( get_template_directory_uri() . '/assets/sitemap-style.xsl' ) . '"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    
    <!-- Homepage -->
    <url>
        <loc><?php echo esc_url( home_url( '/' ) ); ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <?php
    // Query Pages
    $pages = get_posts( array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    ) );

    foreach ( $pages as $page ) {
        $loc = get_permalink( $page->ID );
        $lastmod = get_the_modified_date( 'c', $page->ID );
        ?>
        <url>
            <loc><?php echo esc_url( $loc ); ?></loc>
            <lastmod><?php echo esc_html( $lastmod ); ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
        <?php
    }

    // Query Posts
    $posts = get_posts( array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    ) );

    foreach ( $posts as $post ) {
        $loc = get_permalink( $post->ID );
        $lastmod = get_the_modified_date( 'c', $post->ID );
        ?>
        <url>
            <loc><?php echo esc_url( $loc ); ?></loc>
            <lastmod><?php echo esc_html( $lastmod ); ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.9</priority>
        </url>
        <?php
    }

    // Query Categories
    $categories = get_terms( array(
        'taxonomy'   => 'category',
        'hide_empty' => true,
    ) );

    if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) {
        foreach ( $categories as $category ) {
            $loc = get_term_link( $category );
            ?>
            <url>
                <loc><?php echo esc_url( $loc ); ?></loc>
                <changefreq>weekly</changefreq>
                <priority>0.6</priority>
            </url>
            <?php
        }
    }

    // Query Tags
    $tags = get_terms( array(
        'taxonomy'   => 'post_tag',
        'hide_empty' => true,
    ) );

    if ( ! is_wp_error( $tags ) && ! empty( $tags ) ) {
        foreach ( $tags as $tag ) {
            $loc = get_term_link( $tag );
            ?>
            <url>
                <loc><?php echo esc_url( $loc ); ?></loc>
                <changefreq>weekly</changefreq>
                <priority>0.4</priority>
            </url>
            <?php
        }
    }
    ?>
</urlset>
