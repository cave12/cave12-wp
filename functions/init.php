<?php

// Initialize Theme

/* 1. Register CSS and JS
 * 2. Define theme support, menus, image sizes
 * 3. Custom post types and Taxonomies
 * 4. Date variables for MEM plugin
 * 5. 
**************/


/* Allow Automatic Updates
 ******************************
 * http://codex.wordpress.org/Configuring_Automatic_Background_Updates
 */

add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );
add_filter( 'allow_minor_auto_core_updates', '__return_true' );
add_filter( 'allow_major_auto_core_updates', '__return_true' );



function custom_register_styles() {

	/**
	 * Custom CSS
	 */

	// the MAIN stylesheet
	wp_enqueue_style(
			'c12',
			get_stylesheet_directory_uri() . '/css/dev/00-main.css', // main.css
			false, // dependencies
			'20221204a' // version
	);

	// remove some plugin CSS:
	// wp_dequeue_style( 'mailchimpSF_main_css' );


	/**
	 * Custom JavaScript
	 */

	wp_dequeue_script( 'devicepx' ); 
	// some Jetpack stuff - 
	// "That file is used to optionally load retina/HiDPI versions of files (Gravatars etc) which are known to support it, for devices that run at a higher resolution."
	// info: http://wordpress.org/support/topic/plugin-jetpack-by-wordpresscom-unnecessary-java-script-call

	wp_enqueue_script(
			'modernizer_js', // handle
			get_stylesheet_directory_uri() . '/js/libs/modernizr.custom.14446.min.js', //src
			false, // dependencies
			null, // version
			false // in_footer
	);


	wp_enqueue_script(
	// the MAIN JavaScript file
			'main_js', // handle
			get_stylesheet_directory_uri() . '/js/script.js', // scripts.js
			array( 'jquery' ), // dependencies
			null, // version
			false // in_footer
	);

}

add_action( 'wp_enqueue_scripts', 'custom_register_styles', 10 );


/* Some header cleanup
******************************/

remove_action( 'wp_head', 'shortlink_wp_head' );

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );

// Prevents WordPress from testing ssl capability on domain.com/xmlrpc.php?rsd
remove_filter( 'atom_service_url', 'atom_service_url_filter' );


/* Theme Support
******************************/

function c12_theme_setup() {

	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( 'automatic-feed-links' );
	
	
//     set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions  
	// more info: http://codex.wordpress.org/Post_Thumbnails
	
	register_nav_menus(
				array(
						'menu-one'   => __( 'Menu Nr.1' ),
						'menu-two' => __( 'Menu Nr.2' ),
						'menu-three' => __( 'Menu Nr.3' ),
				)
		);
	
	add_theme_support( 'html5', array( 
		'comment-list',
		'comment-form',
		'search-form',
		'gallery', // since 3.9
		'caption'  // since 3.9
	) );
	
	add_theme_support( 'title-tag' );
	
}
add_action( 'after_setup_theme', 'c12_theme_setup' );


/* Custom image sizes
******************************/

if ( function_exists( 'add_image_size' ) ) {
	//add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	//add_image_size( 'landscape', 304, 184, true ); // true = cropped
}


/* Give an Excerpt to Pages - better for SEO!
***************************************************/

add_post_type_support( 'page', 'excerpt');


/* Widget Area
******************************/

register_sidebar( array(
		'name'          => 'Primary Sidebar',
		'id'            => 'sidebar-1',
		'description'   => 'Main sidebar.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
) );


/* Allowed FileTypes
 ********************
 * method based on 
 * http://howto.blbosti.com/?p=329
 * List of defaults: https://core.trac.wordpress.org/browser/tags/3.8.1/src/wp-includes/functions.php#L1948
*/
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {

		// add an extension to the array
		$existing_mimes['svg'] = 'image/svg+xml';
		$existing_mimes['epub'] = 'application/epub+zip';

		// remove existing file types
		unset( $existing_mimes['bmp'] );
		unset( $existing_mimes['tif|tiff'] );

		// and return the new full result
		return $existing_mimes;
}



/*
 * File Upload Sanitization
 
 * Sources: 
 * http://www.geekpress.fr/wordpress/astuce/suppression-accents-media-1903/
 * https://gist.github.com/herewithme/7704370
 
 * See also Ticket #22363
 * https://core.trac.wordpress.org/ticket/22363
 * and #24661 - remove_accents is not removing combining accents
 * https://core.trac.wordpress.org/ticket/24661
*/ 

add_filter( 'sanitize_file_name', 'remove_accents', 10, 1 );
add_filter( 'sanitize_file_name_chars', 'sanitize_file_name_chars', 10, 1 );
 
function sanitize_file_name_chars( $special_chars = array() ) {
	$special_chars = array_merge( array( '’', '‘', '“', '”', '«', '»', '‹', '›', '—', 'æ', 'œ', '€','é','à','ç','ä','ö','ü','ï','û','ô','è' ), $special_chars );
	return $special_chars;
}
  
  
/* Jetpack Stuff
* see: http://jeremyherve.com/2013/11/19/customize-the-list-of-modules-available-in-jetpack/

 * Disable all non-whitelisted jetpack modules.
 *
 * This will allow all of the currently available Jetpack modules to work
 * normally. If there's a module you'd like to disable, simply comment it out
 * or remove it from the whitelist and it will no longer load.
 *
 * @author FAT Media, LLC
 * @link   http://wpbacon.com/tutorials/disable-jetpack-modules/
 */
 
// add_filter( 'jetpack_get_available_modules', 'prefix_kill_all_the_jetpacks' );
 
 function prefix_kill_all_the_jetpacks( $modules ) {
 	// A list of Jetpack modules which are allowed to activate.
 	$whitelist = array(
// 		'after-the-deadline',
// 		'carousel',
// 		'comments',
// 		'contact-form',
// 		'custom-css',
 		'enhanced-distribution',
// 		'gplus-authorship',
// 		'gravatar-hovercards',
// 		'infinite-scroll',
// 		'json-api',
// 		'latex',
// 		'likes',
		'markdown',
// 		'minileven',
// 		'mobile-push',
 		'monitor',
// 		'notes',
 		'omnisearch',
// 		'photon',
// 		'post-by-email',
 		'publicize',
// 		'sharedaddy',
// 		'shortcodes',
// 		'shortlinks',
// 		'sso',
// 		'stats',
// 		'subscriptions',
 		'tiled-gallery',
// 		'vaultpress',
// 		'videopress',
 		'widget-visibility',
// 		'widgets',
 	);
 	// Deactivate all non-whitelisted modules.
 	$modules = array_intersect_key( $modules, array_flip( $whitelist ) );
 	return $modules;
}
 

function my_mem_settings() {
	mem_plugin_settings( array( 'post', 'publications' ), 'full' );
}

add_action( 'mem_init', 'my_mem_settings' );


