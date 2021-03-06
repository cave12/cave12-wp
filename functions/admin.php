<?php


// Admin Interface improvement


function custom_admin_head() {
	echo '<style>
	
	</style>';
	
	echo "<link rel='stylesheet' id='c12-admin-css'  href='";
	echo get_stylesheet_directory_uri() . "/admin/admin.css?ver=";
	echo time();
	echo "' type='text/css' media='all' />";
}

add_action( 'admin_head', 'custom_admin_head' );


/**
 * remove WordPress Howdy
 * http://www.redbridgenet.com/?p=653
 ******************************/
function goodbye_howdy( $wp_admin_bar ) {
	$avatar = get_avatar( get_current_user_id(), 16 );
	if ( ! $wp_admin_bar->get_node( 'my-account' ) ) {
		return;
	}
	$wp_admin_bar->add_node( array(
			'id'    => 'my-account',
			'title' => sprintf( '%s', wp_get_current_user()->display_name ) . $avatar,
	) );
}

add_action( 'admin_bar_menu', 'goodbye_howdy' );


/**
 * Modify the admin footer text
 * http://www.rvamedia.com/wordpress/how-to-white-label-wordpress
 ******************************/

function modify_footer_admin() {
	echo '<span id="footer-thankyou">&nbsp;</span>';
}

add_filter( 'admin_footer_text', 'modify_footer_admin' );


/* Edit screen improvements
******************************/

function remove_edit_fields() {

	/* Slug meta box. */
//	remove_meta_box( 'slugdiv', 'post', 'normal' );
	// remove comments status
	remove_meta_box( 'commentstatusdiv', 'post', 'normal' );
	// remove comments
	remove_meta_box( 'commentsdiv', 'post', 'normal' );
	// remove author 
	remove_meta_box( 'authordiv', 'post', 'normal' );
	/* Post format meta box. */
	remove_meta_box( 'formatdiv', 'post', 'normal' );
	/* Trackbacks meta box. */
	remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
	/* Custom fields meta box. */
	remove_meta_box( 'postcustom', 'post', 'normal' );

}

add_action( 'add_meta_boxes', 'remove_edit_fields' );

// src: http://codex.wordpress.org/Function_Reference/remove_meta_box
// http://justintadlock.com/archives/2011/04/13/uncluttering-the-post-editing-screen-in-wordpress


/* Dashboard improvement
******************************/

// http://wp.tutsplus.com/tutorials/customizing-wordpress-for-your-clients/
// http://www.wpbeginner.com/wp-tutorials/how-to-remove-wordpress-dashboard-widgets/

function tabula_remove_dashboard_widgets() {
	// Globalize the metaboxes array, this holds all the widgets for wp-admin
	global $wp_meta_boxes;
	
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );

	// unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );

	// RSS feeds:
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );

}
add_action( 'wp_dashboard_setup', 'tabula_remove_dashboard_widgets' );



/**
 * end of functions-admin.php
 */
