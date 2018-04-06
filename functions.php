<?php
/**
 * @package    WordPress
 * @subpackage HTML5_Boilerplate
 */


require_once( 'functions/init.php' );

require_once( 'functions/taxonomies.php' );

require_once( 'functions/metabox.php' );

require_once( 'functions/acf.php' );

require_once( 'functions/pre-get-posts.php' );


/* login interface
******************************/

//custom Login
function custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo( 'template_directory' ) . '/login/login.css" />';
}

add_action( 'login_head', 'custom_login' );

// src: http://codex.wordpress.org/Customizing_the_Login_Form

// change the link values so the logo links to your WordPress site
function my_login_logo_url() {
	return get_bloginfo( 'url' );
}

add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
	return 'Your Site Name and Info';
}

add_filter( 'login_headertitle', 'my_login_logo_url_title' );


/* admin interface
******************************/

if ( is_user_logged_in() ) {
		require_once('functions/admin.php');
}

/* turn links into hyperlinks
******************************/

function tiss_process_hyperlinks($tiss_content) {
			
			$tiss_content = ' ' . $tiss_content;
			$attribs = ''; 
			$tiss_content = preg_replace(
				array(
					'#([\s>])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is',
					'#([\s>])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is',
					'#([\s>])([a-z0-9\-_.]+)@([^,< \n\r]+)#i'
					),
				array(
					'$1<a href="$2"' . $attribs . '>$2</a>',
					'$1<a href="http://$2"' . $attribs . '>$2</a>',
					'$1<a href="mailto:$2@$3">$2@$3</a>'),$tiss_content);
			$tiss_content = preg_replace("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", $tiss_content);
			$tiss_content = trim($tiss_content);
			
			return $tiss_content;
}

function tissParseHyperlinks($string) {
    // Add <a> tags around all hyperlinks in $string
    return ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "</a><a href=\"\\0\">\\0</a>", $string);
}



function c12_archive_titles() {

	if ( false === ( $c12_archive_titles = get_transient( 'c12_archive_titles' ) ) ) {
	    
	    // It wasn't there, so we generate the data and save the transient
	
	     $c12_archive_titles = new WP_Query( array(
	     	'posts_per_page' => 55,
	     	'post_type' => 'archive',
	     	'orderby'  => 'name',
	     	'order'  => 'ASC',
	     	 	) ); 
	     	 	
	     	 	set_transient(
	     	 		'c12_archive_titles', 
	     	 		$c12_archive_titles, 
	     	 		10 
	     	 	); // 3 heures = 60*60*3
	
	} // end of get_transient test
	
	
	if ( $c12_archive_titles->have_posts() ) : ?>
	  <ul class="top-archive separateurs notc">
	  <?php
	  while( $c12_archive_titles->have_posts() ) : $c12_archive_titles->the_post(); 
			
			echo '<li><a href="'.get_the_permalink().'">';
			echo get_the_title().'</a></li>';
	
		 endwhile; 
	 	?></ul><?php
	  wp_reset_postdata();
	 endif; 

}



// end of functions.php