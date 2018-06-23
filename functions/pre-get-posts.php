<?php 

/*
* Pre-Get Posts
* Change display of posts loop
* Number of posts in archive pages
 */

function c12_archive_pages( $query ) {

  if ( is_archive() ) {
  	 $query->set( 'posts_per_page', 42);
  }
  
  /*
   * Note:
   * Affecte le nombre d'années, 
   * sur les pages Archives par année
  */
  
  if ( is_page_template( 'page-templates/affiches.php' ) ) {
  
  	$query->set( 'posts_per_page', 3);
  
  } else if ( is_page_template( 'page-templates/affiches-par.php' ) ) {
  	
  	$query->set( 'posts_per_page', -1);
  
  }
  
  

}
add_filter( 'pre_get_posts', 'c12_archive_pages' );


/*
 * Show Scheduled articles:
 * http://wordpress.stackexchange.com/questions/16794/show-scheduled-posts-in-archive-page
 *
******************************/

function cave12_include_future( $query ) {
  if ( $query->is_date() || $query->is_single() )
    $GLOBALS[ 'wp_post_statuses' ][ 'future' ]->public = true;
}

if ( !is_admin() ) {
	add_filter( 'pre_get_posts', 'cave12_include_future' );
}

/*
 * Produce a permalink that works for future articles
 * NOTE: may return in form of /?p=191
*/

function c12_future_permalink() {

	// get_the_permalink() 
	
	$link = get_home_url().'/';
	
	$link .= get_post_field( 'post_name', get_the_ID() ).'/';
	
	return $link;

}

/*
 * Build a "yesterday" timecode
*/

function c12_date_today() {
	
	$now = strtotime( date("Y-m-d") );
	
	$today = date_i18n( "Y-m-d", $now);
	
	return $today;
	
}

function c12_date_yesterday() {
	
	$now = strtotime( date("Y-m-d") );
	$day = 86400; // ( 24 * 60 * 60 )
	
	$yesterday = ( $now - $day );
	$yesterday = date_i18n( "Y-m-d", $yesterday);
	
	return $yesterday;
	
}

