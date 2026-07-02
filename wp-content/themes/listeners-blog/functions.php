<?php

/**
 * Listeners Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Listeners_Blog
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (! function_exists('listeners_blog_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function listeners_blog_setup()
	{
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and WordPress will
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1200, 9999); // Unlimited height

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-primary' => esc_html__('Primary Menu', 'listeners-blog'),
				'menu-footer'  => esc_html__('Footer Menu', 'listeners-blog'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for Custom Logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');
	}
endif;
add_action('after_setup_theme', 'listeners_blog_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function listeners_blog_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'listeners-blog'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'listeners-blog'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Footer Widgets
	register_sidebar(
		array(
			'name'          => esc_html__('Footer 1', 'listeners-blog'),
			'id'            => 'footer-1',
			'description'   => esc_html__('First footer widget area.', 'listeners-blog'),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Footer 2', 'listeners-blog'),
			'id'            => 'footer-2',
			'description'   => esc_html__('Second footer widget area.', 'listeners-blog'),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-widget-title">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Footer 3', 'listeners-blog'),
			'id'            => 'footer-3',
			'description'   => esc_html__('Third footer widget area.', 'listeners-blog'),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action('widgets_init', 'listeners_blog_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function listeners_blog_scripts()
{
	// Google Fonts
	wp_enqueue_style('listeners-blog-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap', array(), null);

	// Theme Stylesheet
	wp_enqueue_style('listeners-blog-style', get_stylesheet_uri(), array('listeners-blog-fonts'), filemtime(get_template_directory() . '/style.css'));

	// Theme JS
	wp_enqueue_script('listeners-blog-theme-js', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), wp_get_theme()->get('Version'), true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'listeners_blog_scripts');

/**
 * Calculate post reading time.
 */
function listeners_blog_reading_time($post_id = null)
{
	if (! $post_id) {
		$post_id = get_the_ID();
	}
	$content = get_post_field('post_content', $post_id);
	$word_count = str_word_count(strip_tags($content));
	$readingtime = ceil($word_count / 200); // 200 words per minute average reading speed

	if ($readingtime <= 1) {
		$timer = esc_html__('1 min read', 'listeners-blog');
	} else {
		$timer = $readingtime . ' ' . esc_html__('min read', 'listeners-blog');
	}

	return $timer;
}


add_filter('intermediate_image_sizes_advanced', '__return_empty_array');
add_filter('big_image_size_threshold', '__return_false');

/**
 * Force display of featured images in the Latest Posts Gutenberg block.
 */
add_filter('render_block_data', function ($block) {
	if (isset($block['blockName']) && 'core/latest-posts' === $block['blockName']) {
		$block['attrs']['displayFeaturedImage'] = true;
		$block['attrs']['displayPostDate']      = true;
		if (empty($block['attrs']['featuredImageSizeSlug'])) {
			$block['attrs']['featuredImageSizeSlug'] = 'thumbnail';
		}
		if (empty($block['attrs']['featuredImageAlign'])) {
			$block['attrs']['featuredImageAlign'] = 'left';
		}
	}
	return $block;
}, 10, 1);

/**
 * Remove website url field from comment form.
 */
add_filter('comment_form_default_fields', function ($fields) {
	if (isset($fields['url'])) {
		unset($fields['url']);
	}
	if (isset($fields['cookies'])) {
		$fields['cookies'] = str_replace(
			'Save my name, email, and website',
			'Save my name and email',
			$fields['cookies']
		);
	}
	return $fields;
});

/**
 * Disable comment flood control to allow rapid testing.
 */
add_filter('wp_is_comment_flood', '__return_false');
add_filter('comment_flood_filter', '__return_false');

/**
 * Retrieve dynamic site logo URL with fallback to template asset.
 */
function listeners_blog_get_logo_url()
{
	$custom_logo_id = get_theme_mod('custom_logo');
	if ($custom_logo_id) {
		$logo_image = wp_get_attachment_image_src($custom_logo_id, 'full');
		if ($logo_image) {
			return esc_url($logo_image[0]);
		}
	}
	return esc_url(get_template_directory_uri() . '/assets/listeners-logo.webp');
}

/**
 * Provide a fallback site icon (favicon) URL if not set.
 */
add_filter('get_site_icon_url', 'listeners_blog_site_icon_fallback', 10, 3);
function listeners_blog_site_icon_fallback($url, $size, $blog_id)
{
	if (empty($url)) {
		return esc_url(get_template_directory_uri() . '/assets/favicon.ico');
	}
	return $url;
}

/**
 * Register customizer settings for social links.
 */
function listeners_blog_customize_register($wp_customize)
{
	$wp_customize->add_section('listeners_blog_social_section', array(
		'title'    => __('Social Media Links', 'listeners-blog'),
		'priority' => 30,
	));

	// Facebook
	$wp_customize->add_setting('listeners_blog_facebook_link', array(
		'default'           => 'https://facebook.com/listenersconnect',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('listeners_blog_facebook_link', array(
		'label'    => __('Facebook URL', 'listeners-blog'),
		'section'  => 'listeners_blog_social_section',
		'type'     => 'url',
	));

	// Instagram
	$wp_customize->add_setting('listeners_blog_instagram_link', array(
		'default'           => 'https://instagram.com/listenersconnect',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('listeners_blog_instagram_link', array(
		'label'    => __('Instagram URL', 'listeners-blog'),
		'section'  => 'listeners_blog_social_section',
		'type'     => 'url',
	));

	// LinkedIn
	$wp_customize->add_setting('listeners_blog_linkedin_link', array(
		'default'           => 'https://linkedin.com/company/listenersconnect',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('listeners_blog_linkedin_link', array(
		'label'    => __('LinkedIn URL', 'listeners-blog'),
		'section'  => 'listeners_blog_social_section',
		'type'     => 'url',
	));

	// YouTube
	$wp_customize->add_setting('listeners_blog_youtube_link', array(
		'default'           => 'https://youtube.com/listenersconnect',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('listeners_blog_youtube_link', array(
		'label'    => __('YouTube URL', 'listeners-blog'),
		'section'  => 'listeners_blog_social_section',
		'type'     => 'url',
	));

	// Footer Settings Section
	$wp_customize->add_section('listeners_blog_footer_section', array(
		'title'    => __('Footer Settings', 'listeners-blog'),
		'priority' => 31,
	));

	// Footer Description Setting
	$wp_customize->add_setting('listeners_blog_footer_description', array(
		'default'           => __('Listeners Connect is an online emotional support and relationship guidance platform where you can talk freely with supportive listeners for dating advice, relationship clarity, breakup healing, anxiety support, and meaningful human connection — anytime, anywhere.', 'listeners-blog'),
		'sanitize_callback' => 'sanitize_textarea_field',
	));
	$wp_customize->add_control('listeners_blog_footer_description', array(
		'label'    => __('Footer Description', 'listeners-blog'),
		'section'  => 'listeners_blog_footer_section',
		'type'     => 'textarea',
	));

	// Copyright Text Setting
	$wp_customize->add_setting('listeners_blog_copyright_text', array(
		'default'           => __('Copyright &copy; 2026 Listeners - All Rights Reserved.', 'listeners-blog'),
		'sanitize_callback' => 'wp_kses_post',
	));
	$wp_customize->add_control('listeners_blog_copyright_text', array(
		'label'    => __('Copyright Text', 'listeners-blog'),
		'section'  => 'listeners_blog_footer_section',
		'type'     => 'text',
	));
}
add_action('customize_register', 'listeners_blog_customize_register');

/**
 * Programmatically create a Sitemap page if it doesn't exist.
 */
function listeners_blog_create_sitemap_page()
{
	if (get_option('listeners_blog_sitemap_created')) {
		return;
	}

	$sitemap_slug = 'sitemap';
	$page_exists = get_page_by_path($sitemap_slug);

	if (! $page_exists) {
		$page_id = wp_insert_post(array(
			'post_title'   => 'Sitemap',
			'post_name'    => $sitemap_slug,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		));

		if ($page_id && ! is_wp_error($page_id)) {
			update_post_meta($page_id, '_wp_page_template', 'template-sitemap.php');
			update_option('listeners_blog_sitemap_created', 1);
		}
	} else {
		update_option('listeners_blog_sitemap_created', 1);
	}
}
add_action('init', 'listeners_blog_create_sitemap_page');

/**
 * Custom Rewrite Rules for XML Sitemap and Robots.txt
 */
add_action('init', 'listeners_blog_custom_rewrite_rules');
function listeners_blog_custom_rewrite_rules()
{
	add_rewrite_rule('^sitemap\.xml$', 'index.php?custom_sitemap=1', 'top');
	add_rewrite_rule('^robots\.txt$', 'index.php?custom_robots=1', 'top');

	// Flush rewrite rules dynamically once when these rules are added/modified
	if (! get_option('listeners_blog_rewrites_flushed_v1')) {
		flush_rewrite_rules(false);
		update_option('listeners_blog_rewrites_flushed_v1', 1);
	}
}

add_filter('query_vars', 'listeners_blog_custom_query_vars');
function listeners_blog_custom_query_vars($vars)
{
	$vars[] = 'custom_sitemap';
	$vars[] = 'custom_robots';
	return $vars;
}

add_action('template_redirect', 'listeners_blog_custom_template_redirect');
function listeners_blog_custom_template_redirect()
{
	if (get_query_var('custom_sitemap')) {
		if (ob_get_length()) {
			ob_clean();
		}
		include ABSPATH . 'sitemap-generator.php';
		exit;
	}
	if (get_query_var('custom_robots')) {
		if (ob_get_length()) {
			ob_clean();
		}
		include ABSPATH . 'robots-generator.php';
		exit;
	}
}

/**
 * Programmatically disable Yoast SEO's built-in XML sitemaps to prevent conflicts
 * with our custom sitemap and robots.txt.
 */
add_filter('wpseo_enable_xml_sitemap', '__return_false');

/**
 * Limit frontend list pages (home, archive, search) to 8 posts per page.
 */
function listeners_blog_set_posts_per_page($query)
{
	if (! is_admin() && $query->is_main_query()) {
		if ($query->is_home() || $query->is_archive() || $query->is_search()) {
			$query->set('posts_per_page', 8);
		}
	}
}
add_action('pre_get_posts', 'listeners_blog_set_posts_per_page');

/**
 * Customize the title tag for the home page.
 */
function listeners_blog_custom_home_title($title)
{
	if (is_front_page() || is_home()) {
		return "India's Trusted Emotional Support & Relationship Platform | Listeners Connect";
	}
	return $title;
}
add_filter('pre_get_document_title', 'listeners_blog_custom_home_title', 999);

/**
 * Add custom meta description and keywords for the home page.
 */
function listeners_blog_custom_home_meta_tags()
{
	if (is_front_page() || is_home()) {
		$description = "Feeling low, lonely, or heartbroken? Talk to compassionate listeners & relationship experts on Listeners Connect — judgment-free, private & available anytime. Start feeling better today!";
		$keywords = "Emotional Support Platform India, Talk to Someone Online India, Relationship Guidance Online, Online Listener for Anxiety, Breakup Recovery Support India, talk to a Expert";

		echo '<meta name="description" content="' . esc_attr($description) . '" />' . "\n";
		echo '<meta name="keywords" content="' . esc_attr($keywords) . '" />' . "\n";
	}
}
add_action('wp_head', 'listeners_blog_custom_home_meta_tags', 1);

/**
 * Helper function to extract YouTube video ID from URL
 */
function listeners_blog_get_youtube_id($url)
{
	$pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i';
	if (preg_match($pattern, $url, $matches)) {
		return $matches[1];
	}
	if (preg_match('/^[a-zA-Z0-9_-]{11}$/', trim($url))) {
		return trim($url);
	}
	return false;
}

/**
 * Register YouTube Shorts Custom Post Type
 */
function listeners_blog_register_youtube_shorts_cpt()
{
	$labels = array(
		'name'               => _x('YouTube Shorts', 'post type general name', 'listeners-blog'),
		'singular_name'      => _x('YouTube Short', 'post type singular name', 'listeners-blog'),
		'menu_name'          => _x('YouTube Shorts', 'admin menu', 'listeners-blog'),
		'name_admin_bar'     => _x('YouTube Short', 'add new on admin bar', 'listeners-blog'),
		'add_new'            => _x('Add New', 'youtube-short', 'listeners-blog'),
		'add_new_item'       => __('Add New YouTube Short', 'listeners-blog'),
		'new_item'           => __('New YouTube Short', 'listeners-blog'),
		'edit_item'          => __('Edit YouTube Short', 'listeners-blog'),
		'view_item'          => __('View YouTube Short', 'listeners-blog'),
		'all_items'          => __('All YouTube Shorts', 'listeners-blog'),
		'search_items'       => __('Search YouTube Shorts', 'listeners-blog'),
		'parent_item_colon'  => __('Parent YouTube Shorts:', 'listeners-blog'),
		'not_found'          => __('No YouTube Shorts found.', 'listeners-blog'),
		'not_found_in_trash' => __('No YouTube Shorts found in Trash.', 'listeners-blog')
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'youtube-short'),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		// 'menu_position'      => 30,
		'menu_icon'          => 'dashicons-video-alt3',
		'supports'           => array('title'),
	);

	register_post_type('youtube-short', $args);
}
add_action('init', 'listeners_blog_register_youtube_shorts_cpt');

/**
 * Add Metabox for YouTube Short Details
 */
function listeners_blog_add_youtube_short_metabox()
{
	add_meta_box(
		'listeners_blog_youtube_short_meta',
		__('YouTube Short Details', 'listeners-blog'),
		'listeners_blog_youtube_short_metabox_callback',
		'youtube-short',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'listeners_blog_add_youtube_short_metabox');

function listeners_blog_youtube_short_metabox_callback($post)
{
	wp_nonce_field('listeners_blog_youtube_short_save', 'listeners_blog_youtube_short_nonce');
	$value = get_post_meta($post->ID, '_youtube_short_url', true);
?>
	<p>
		<label for="listeners_blog_youtube_short_url" style="display:block; font-weight:bold; margin-bottom: 0.5rem;">
			<?php _e('YouTube Video URL or Video ID', 'listeners-blog'); ?>
		</label>
		<input type="text" id="listeners_blog_youtube_short_url" name="listeners_blog_youtube_short_url" value="<?php echo esc_attr($value); ?>" style="width: 100%; padding: 0.5rem; font-size: 1rem;" placeholder="e.g. https://www.youtube.com/shorts/VKmEhHlDr34 or VKmEhHlDr34" />
	</p>
	<p class="description">
		<?php _e('Enter the full YouTube Short URL, standard YouTube URL, or just the 11-digit video ID.', 'listeners-blog'); ?>
	</p>
<?php
}

/**
 * Save Metabox data
 */
function listeners_blog_save_youtube_short_meta($post_id)
{
	if (!isset($_POST['listeners_blog_youtube_short_nonce'])) {
		return;
	}
	if (!wp_verify_nonce($_POST['listeners_blog_youtube_short_nonce'], 'listeners_blog_youtube_short_save')) {
		return;
	}
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (isset($_POST['listeners_blog_youtube_short_url'])) {
		$url = sanitize_text_field($_POST['listeners_blog_youtube_short_url']);
		update_post_meta($post_id, '_youtube_short_url', $url);
	}
}
add_action('save_post', 'listeners_blog_save_youtube_short_meta');

/**
 * Add canonical tag to 404 pages.
 */
function listeners_blog_add_404_canonical()
{
	if (is_404()) {
		$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$canonical_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $request_uri;
		echo '<link rel="canonical" href="' . esc_url($canonical_url) . '" />' . "\n";
	}
}
add_action('wp_head', 'listeners_blog_add_404_canonical', 2);
