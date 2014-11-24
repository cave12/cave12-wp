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

		<!-- Use the .htaccess and remove these lines to avoid edge case issues.
					 More info: h5bp.com/i/378 -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php if ( is_front_page() ) {
				bloginfo( 'name' );
			} else {
				wp_title( '&mdash;', true, 'right' );
				bloginfo( 'name' );
			}
			?></title>

		<?php // ** DESCRIPTION v.0.3 **
		if ( is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post();
			?>
			<meta name="description" content="<?php
			$descr = get_the_excerpt();
			$text = str_replace( '/\r\n/', ', ', trim( $descr ) );
			echo esc_attr( $text );
			?>" />
		<?php endwhile; endif;
		elseif ( is_home() ) :
			?>
			<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
		<?php endif; ?>

		<meta name="author" content="">

		<?php // ** SEO OPTIMIZATION v.0.2 **
		if ( is_attachment() ) {
			?>
			<meta name="robots" content="noindex,follow" /><?php
		} else {
			if ( is_single() || is_page() || is_home() ) {
				?>
				<meta name="robots" content="all,index,follow" /><?php
			} else {
				if ( is_category() || is_archive() ) {
					?>
					<meta name="robots" content="noindex,follow" /><?php
				}
			}
		}
		?>

		<!-- Mobile viewport optimized: h5bp.com/viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Place favicon.ico and apple-touch-icon.png in the root of your domain and delete these references : mathiasbynens.be/notes/touch-icons -->
		<link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon" />
		
		<style>.hidden {display: none;}</style>

		<!-- Wordpress Head Items -->
		<link rel="alternate" type="application/rss+xml" title="RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<link rel="profile" href="http://microformats.org/profile/hcalendar">

		<?php wp_head(); ?>

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
	
