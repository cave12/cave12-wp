<?php 

/* ACF Setup for Cave12
 *
 * Adds the following field groups:
 *
 * 1) Photos et affiches
 * 2) Sur-titre
 * 3) Programme PDF
 *
*/


if( function_exists('acf_add_local_field_group') ):

	/*
	 * Photos et affiches
	*/
	
	require_once( 'acf/photos-affiches.php' );
	
	/*
	 * Sur-titre
	*/
	
	require_once( 'acf/sur-titre.php' );
	
	/*
	 * Programme PDF
	*/
	
	require_once( 'acf/programme-pdf.php' );
	


endif;

