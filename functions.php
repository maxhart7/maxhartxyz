<?php

class theme
{
	public function __construct()
	{
		// Add post thumbnail support
		add_theme_support('post-thumbnails');

		// Add custom image sizes here - (name, width, height, crop)
		add_image_size( 'square', 400, 400, true );

		// Add SVG Support
		add_filter( 'upload_mimes', array( __CLASS__, 'add_svg_to_mime_types' ) );
		
		// Various WordPress Functions
		remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
		remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
		remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
		remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
		remove_action('wp_head', 'index_rel_link'); // Index link
		remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
		remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
		remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
		remove_action('wp_head', 'rel_canonical');
		remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

		// Enqueue JS and CSS
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
		
		// Disable theme and plugin editors
		define( 'DISALLOW_FILE_EDIT', true );
	}

	/**
	 * Enable svg uploads to media
	 * @param $mimes
	 *
	 * @return mixed
	 */
	public static function add_svg_to_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	/**
	 * Enqueue all javascript and css files
	 */
	public static function enqueue_scripts()
	{
		$js_cache_buster = date("YmdHi", filemtime( get_stylesheet_directory() . '/dist/scripts/scripts.js' ) );
		$css_cache_buster = date("YmdHi", filemtime( get_stylesheet_directory() . '/dist/styles/style.css' ) );

		wp_enqueue_script('gsap', get_stylesheet_directory_uri() . '/dist/vendor/gsap.js', array('jquery'), '3.8.0', true);
		wp_enqueue_script('ScrollTo', get_stylesheet_directory_uri() . '/dist/vendor/ScrollToPlugin.js', array('gsap'), '3.8.0', true);
		wp_enqueue_script('MorphSVG', get_stylesheet_directory_uri() . '/dist/vendor/MorphSVGPlugin.js', array('gsap'), '3.8.0', true);
		wp_enqueue_script('ScrollTrigger', get_stylesheet_directory_uri() . '/dist/vendor/ScrollTrigger.js', array('gsap'), '3.8.0', true);
		wp_enqueue_script('glidejs', 'https://cdn.jsdelivr.net/npm/@glidejs/glide', array(), '3.4.1', true);
		wp_enqueue_script('themejs', get_stylesheet_directory_uri() . '/dist/scripts/scripts.js', array('jquery'), $js_cache_buster, true );

		wp_enqueue_style('themecss', get_stylesheet_directory_uri() . '/dist/styles/style.css', array(), $css_cache_buster);
	}
}

new theme();