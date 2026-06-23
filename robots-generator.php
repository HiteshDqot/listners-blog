<?php

/**
 * Dynamic robots.txt Generator for Listeners Blog
 */

// Disable loading theme files
if ( ! defined( 'WP_USE_THEMES' ) ) {
	define( 'WP_USE_THEMES', false );
}

// Load WordPress environment
if ( ! defined( 'ABSPATH' ) ) {
	require_once( './wp-load.php' );
}

// Set headers to text/plain
header('Content-Type: text/plain; charset=utf-8');

echo "User-agent: *\n";
echo "Disallow: /wp-admin/\n";
echo "Disallow: /wp-includes/\n";
echo "Allow: /wp-admin/admin-ajax.php\n";
echo "\n";
echo "Sitemap: " . esc_url(home_url('/sitemap.xml')) . "\n";
