<?php
/**
 * The template for displaying search forms
 *
 * @package Listeners_Blog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-widget-box">
		<input type="search" class="search-widget-input" placeholder="<?php echo esc_attr_x( 'Search Topics...', 'placeholder', 'listeners-blog' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="search-widget-submit"><?php echo esc_html_x( 'Search', 'submit button', 'listeners-blog' ); ?></button>
	</div>
</form>
