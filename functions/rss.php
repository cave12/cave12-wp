<?php 

/* RSS output for Cave12
 *
*/

//
function c12_custom_rss() {

	get_template_part( 'page-templates/feed-rss2' );

}
remove_action('do_feed_rss2', 'do_feed_rss2');
add_action('do_feed_rss2', 'c12_custom_rss');
//
//remove_action('do_feed_rss2', 'do_feed_rss2');

// Good resource:
// https://gist.github.com/mjangda/271871
// WordPress Plugin: Feed Killah (or, How to disable all feeds on your site)




// remove_action('do_feed_rss2', 'do_feed_rss2');
//add_action('do_feed_rss2', 'feed_killer');

remove_action('do_feed_rss', 'do_feed_rss');
//add_action('do_feed_rss', 'feed_killer');

remove_action('do_feed_atom', 'do_feed_atom');
//add_action('do_feed_atom', 'feed_killer');

remove_action('do_feed_rdf', 'do_feed_rdf');
//add_action('do_feed_rdf', 'feed_killer');

//function feedkillah($comment_feed) { 
//	wp_die('I just killed your feeds, fool!'); 
//}