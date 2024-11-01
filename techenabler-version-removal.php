<?php
/**
 * Plugin Name: TechEnabler Header Links Removal
 * Plugin URI: https://techenabler.com/wordpress-plugins
 * Description: Remove these <link> tags from the header : rsd, wlwmanifest, wp_shortlink, feed_links, feed_links_extra, rest_output_link, discovery_links, rest_output, wp_generator. Also remove Wordpress version from Javascript and CSS.
 * Version: 1.0.0
 * Author: TechEnabler
 * Author URI: https://techenabler.com
 */

//Remove the following <link> tags from the header
remove_action('wp_head', 'rsd_link'); 
remove_action('wp_head', 'wlwmanifest_link'); 
remove_action('wp_head', 'wp_shortlink_wp_head'); 
remove_action('wp_head', 'feed_links', 2 ); 
remove_action('wp_head', 'feed_links_extra', 3 );  
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('wp_head', 'wp_generator');

//Remove Wordpress version from RSS
add_filter('the_generator', '__return_empty_string');

//Remove Wordpress version from Javascripts and CSS
function techenabler_remove_version($file) {
	if (strpos($file, 'ver=')) {
		$file = remove_query_arg('ver', $file);
	}
	return $file;
}
add_filter('style_loader_src', 'techenabler_remove_version', 100);
add_filter('script_loader_src', 'techenabler_remove_version', 100);

?>
