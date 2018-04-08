<?php 

/*
* Pre-Get Posts
* Change display of posts loop
 */
 
 

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
	
	$c12_future_permalink = get_home_url().'/';
	
	$c12_future_permalink .= get_post_field( 'post_name', get_the_ID() ).'/';
	
	return $c12_future_permalink;

}

/*
 * Build a "yesterday" timecode
*/

function c12_date_yesterday() {
	
	$c12_unix_now = strtotime( date("Y-m-d") );
	$c12_unix_1day = ( 1 * 24 * 60 * 60 ); // 3 jours
	
	$c12_unix_yesterday = ( $c12_unix_now - $c12_unix_1day );
	$c12_date_yesterday = date_i18n( "Y-m-d", $c12_unix_yesterday);
	
	return $c12_date_yesterday;
	
}

