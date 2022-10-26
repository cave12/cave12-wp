<?php
/**
 * @package    WordPress
 * @subpackage HTML5_Boilerplate
 */


require_once( 'functions/init.php' );

require_once( 'functions/taxonomies.php' );

require_once( 'functions/metabox.php' );

require_once( 'functions/acf.php' );

require_once( 'functions/ical.php' );

require_once( 'functions/rss.php' );

require_once( 'functions/pre-get-posts.php' );

require_once( 'functions/get-content.php' );

/**
 * Optional: Add theme support for lazyloading images.
 *
 * @link https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video/
 */
require get_template_directory() . '/pluggable/lazyload/lazyload.php';

/* admin interface
******************************/

if ( is_user_logged_in() ) {
		require_once('functions/admin.php');
}


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

add_filter( 'login_headertext', 'my_login_logo_url_title' );

/* Process special characters such as _ to allow line returns */

function c12_process_chars($c12_content) {
			
	$c12_content = str_replace("_", "_<wbr>", $c12_content);
	return $c12_content;
}

function c12_process_slashes($c12_content) {
			
	$c12_content = str_replace("/", "/<wbr>", $c12_content);
	return $c12_content;
}

/* Turn links into hyperlinks
******************************/

function c12_process_hyperlinks($tiss_content) {
			
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


function c12_concerts() {
	
	if ( false === ( $c12_concerts = get_transient( 'c12_concert_query' ) ) ) {
	    
	 	$c12_concerts = new WP_Query( array(
 			'posts_per_page' => 42,
 			'post_status' => array( 'publish', 'future' ),
 			'date_query' => array(
 				array(
 					'after'     => date('Y-m-d', strtotime('-360 days')),
 					'inclusive' => true,
 				),
 			),
 			'meta_query' => array(
				array(
					'key'     => '_mem_start_date',
					'value'   => c12_date_today(),
					'compare' => '>=',
				),
 			),
 			'orderby'  => 'meta_value',
 			'order'  => 'ASC',
	 	) ); 
	 	 	
	 	set_transient(
	 		'c12_concert_query', 
	 		$c12_concerts, 
	 		300 
	 	); // heures = 60*60*N
	
	} // end of get_transient test
	
	return $c12_concerts;
	
}

/*
* Delete transient on publish
* On élimine le transient lorsqu'un nouveau concert est publié
*/

function c12_delete_query_transient( $ID, $post ) {
    // Deletes the transient when a new post is published
    delete_transient( 'c12_concert_query' );
}
add_action( 'publish_post', 'c12_delete_query_transient', 10, 2 );



function c12_date($postID) {

	$mem_date = '';
	if ( function_exists( 'mem_date_processing' ) ) {
		$mem_date = mem_date_processing( 
			get_post_meta($postID, '_mem_start_date', true) , 
			get_post_meta($postID, '_mem_end_date', true)
		);
	}
	
	return $mem_date;

}


function c12_archive_titles() {

	if ( false === ( $c12_archive_titles = get_transient( 'c12_archive_titles' ) ) ) {
	    
   	$c12_archive_titles = new WP_Query( array(
	   	'posts_per_page' => 55,
	   	'post_type' => 'archive',
	   	'orderby'  => 'name',
	   	'order'  => 'ASC',
   	) );
   	 	
 	 	set_transient(
 	 		'c12_archive_titles', 
 	 		$c12_archive_titles, 
 	 		120 
 	 	); // heures = 60*60*N
	
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

/* Newsletter Signup Form
******************************/

function c12_mailing_signup() {

	?>
	<div id="mailing-list" class="newsletter-form prop-item">
		<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://app.mailjet.com/widget/iframe/3QUt/bAe" width="100%"></iframe>
	</div>	
	<?php
	
}

/* Output monthly PDF
******************************/

function c12_programme_pdf() {

	// Get ACF custom field c12_programme_pdf
	
	if ( function_exists('get_field')) {
	
    $file = get_field('c12_programme_pdf');
    if ($file) {
      ?>
      <div id="programme-pdf" class="programme-pdf prop-item">
        <a target="_blank" href="<?php 
          echo $file['url']; ?>" title=" Télécharger <?php 
          echo $file['title']; ?>" type="application/pdf" class="prop-item-label">.pdf</a>
			</div>
      <?php 
    } // end if file
	}
	
}

/* 
 * Custom NOINDEX rules
 * For : sommaire-top, desinscription-reussie
*/

function cave12_noindex() {
	// your custom condition
	if ( is_page( array( 
		'desinscription-reussie', 
		'inscription-reussie' 
		) ) ) {
		wp_no_robots();
	}
		
}
add_action( 'wp_head', 'cave12_noindex', 1 );


// end of functions.php