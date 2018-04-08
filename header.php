<?php
/**
 * @package    WordPress
 * @subpackage Cave12
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		
		<?php wp_head(); ?>

		<!-- Mobile viewport optimized: h5bp.com/viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon" />
		
		<style>.hidden {display: none;}</style>

		<!-- Wordpress Head Items -->
		<link rel="alternate" type="application/rss+xml" title="RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<link rel="profile" href="http://microformats.org/profile/hcalendar">

	</head>
<body <?php

// init variable
$nfo_body_var = '';

if ( is_single() ) {

	// test categories
	include( get_template_directory() . '/inc/categories-list.php' );

}

$nfo_body_var .= 'no-js';

body_class( $nfo_body_var );

?>>
<div id="page">
	
	<div id="header" class="header">
	<h1 class="site-title"><a rel="start home" href="<?php echo get_option( 'home' ); ?>/"><?php bloginfo( 'name' ); ?></a></h1>

	<? 
	
	// afficher les dates actuelles
	include( get_template_directory() . '/inc/mini-calendar.php' );
	
	 ?> 


	<div class="menu-link">
		<a href="#navigation">menu</a>
	</div>
	
	</div><!--#header-->
	
