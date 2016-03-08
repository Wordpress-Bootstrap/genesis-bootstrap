<?php
/** 
 * Setup Genesis Defaults for Bootstrap Plugin and Themes
 */

// remove_theme_support( 'genesis-accessibility' );

//* Remove Superfish
function sp_disable_superfish() {
	wp_deregister_script( 'superfish' );
	wp_deregister_script( 'superfish-args' );
}
add_action( 'wp_enqueue_scripts', 'sp_disable_superfish' );
	
/** Add featured image sizes */
add_image_size( 'bsg-featured-image', 1170, 630, true );

/** Custom Post Info and Meta */
add_filter( 'genesis_post_meta', 'sp_post_meta_filter' );
function sp_post_info_filter($post_info) {
	$post_info = '[post_date format="j F, Y" before="<span class=\'post-date text-muted\'>" after="</span>" label="<i class=\'fa fa-clock-o\'></i> "] by [post_author_posts_link] [post_comments before="<span class=\'pull-right\'><span class=\'text-muted fa fa-comments\'></span>" after="</span>" zero=" Leave a Comment" one=" 1 Comment" more=" % Comments"]';
	return $post_info;
}

add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_meta_filter($post_info) {
	$post_info = '';
	return $post_info;
}

//* Add theme support
add_theme_support( 'html5', array( 
	'comment-list', 
	'comment-form', 
	'search-form', 
	'gallery', 
	'caption'  
) );

//* Remove dynamic logo/text from admin customizer
function bsg_remove_genesis_customizer_controls( $wp_customize ) {
    $wp_customize->remove_control( 'blog_title' );
    return $wp_customize;
}
add_action( 'customize_register', 'bsg_remove_genesis_customizer_controls', 20 );
