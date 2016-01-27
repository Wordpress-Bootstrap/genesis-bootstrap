<?php
/**
 * Bootstrap Genesis Plugin.
 *
 * WARNING: This file is part of the core Bootstrap Genesis Plugin. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package BootstrapGenesis\Header
 * @author  BryanWillis
 * @license GPL-2.0+
 * @link    https://github.com/Wordpress-Development/genesis-bootstrap/
 */


add_filter( 'language_attributes', 'bsg_js_detection_lang_atts' );
/**
 * Add `no-js` class to `<html>` and include javascript check script early
 * 
 * @link http://www.paulirish.com/2009/avoiding-the-fouc-v3/
 * 
 * @since 1.0.0
 */
function bsg_js_detection_lang_atts($output) {
	return $output . ' class="no-js"';
}
add_action( 'genesis_doctype' function() {
	if ( has_filter( 'language_attributes', 'bsg_js_detection_lang_atts' ) ) {
		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
	}
}, 100 );


/**
 * Add `X-UA-compatible` meta tag using send_headers to ensure it's being used by IE9 Intranets and avoid validation errors
 * 
 * @since 1.0.0
 */
is_admin() || add_action( 'send_headers', function() {
function bsg_add_header_xua_compatible() {
	header( 'X-UA-Compatible: IE=edge,chrome=1' );
}, 1 );




add_action('wp_enqueue_scripts', 'genesis_bootstrap_js');
/**
 * Enqueue Bootstrap JS
 * 
 * @since 1.0.0
 */
function genesis_bootstrap_js()  {

	$bootstrap_cdn = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js';
	$bootstrap_local = plugins_url('bootstrap/js/javascript.min.js', __DIR__);

	wp_enqueue_script( 'bootstrap',
		$bootstrap_local,
		array( 'jquery' ),
		false,
		true
	);
	
}



remove_action( 'wp_head', 'genesis_html5_ie_fix' );
add_action('wp_enqueue_scripts', 'genesis_bootstrap_ie_fix');
/**
 * Remove default html5shiv and add custom with respond
 * 
 * @since 1.0.0
 */
function genesis_bootstrap_ie_fix()  {
	wp_enqueue_script( 'html5shiv',
		'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js',
		array(),
		false,
		false
	);
	wp_enqueue_script( 'respond',
		'https://oss.maxcdn.com/respond/1.4.2/respond.min.js',
		array(),
		false,
		false
	);
  	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
  	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
}


remove_action( 'genesis_meta', 'genesis_responsive_viewport', 999 );
add_theme_support( 'genesis-responsive-viewport' );
/**
 * Better Viewport 
 * 
 * Loads earlier and has a filter modify
 * 
 * @since 1.0.0
 */
add_action( 'genesis_doctype', function() {
	return bsg_genesis_responsive_viewport();
});
function bsg_genesis_responsive_viewport( ) {
	if ( ! current_theme_supports( 'genesis-responsive-viewport' ) )
		return;
	$content = apply_filters('genesis_responsive_viewport', 'width=device-width, initial-scale=1');
	echo '<meta name="viewport" content="'.$content.'" />' . "\n";
}

// Example Viewport Filter
/*
add_filter('genesis_responsive_viewport', function(){
    return 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no';
} );
// */


// remove_action( 'wp_head', 'genesis_do_meta_pingback' );
