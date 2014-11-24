<?php 


if (is_admin()) {


	
	// SOURCE: 
	// http://marcgratch.com/add-tinymce-to-excerpt/
		
	function lb_editor_remove_meta_box() {
	    global $post_type;
	/**
	 *  Check to see if the global $post_type variable exists
	 *  and then check to see if the current post_type supports
	 *  excerpts. If so, remove the default excerpt meta box
	 *  provided by the WordPress core. If you would like to only
	 *  change the excerpt meta box for certain post types replace
	 *  $post_type with the post_type identifier.
	 */
	    if (isset($post_type) && post_type_supports($post_type, 'excerpt')){
	        remove_meta_box('postexcerpt', $post_type, 'normal');
	    } 
	}
	add_action('admin_menu', 'lb_editor_remove_meta_box');
	 
	function lb_editor_add_custom_meta_box() {
	    global $post_type;
	    /**
	     *  Again, check to see if the global $post_type variable
	     *  exists and then if the current post_type supports excerpts.
	     *  If so, add the new custom excerpt meta box. If you would
	     *  like to only change the excerpt meta box for certain post
	     *  types replace $post_type with the post_type identifier.
	     */
	    if (isset($post_type) && post_type_supports($post_type, 'excerpt')){
	        add_meta_box('postexcerpt', __('Intro'), 'lb_editor_custom_post_excerpt_meta_box', $post_type, 'advanced', 'high');
	    }
	}
	add_action( 'add_meta_boxes', 'lb_editor_add_custom_meta_box' );
	
	// add_action('edit_form_after_title', 'lb_editor_add_custom_meta_box');
	 
	function lb_editor_custom_post_excerpt_meta_box( $post ) {
	
	    /**
	     *  Adjust the settings for the new wp_editor. For all
	     *  available settings view the wp_editor reference
	     *  http://codex.wordpress.org/Function_Reference/wp_editor
	     */
	    $settings = array( 
	    	// 'textarea_rows' => '20', 
	    	// 'quicktags' => false, 
	    	'media_buttons' => false,
	    	'teeny' => false,
	    	'tinymce' => false
	    	);
	
	    /**
	     *  Create the new meta box editor and decode the current
	     *  post_excerpt value so the TinyMCE editor can display
	     *  the content as it is styled.
	     */
	    wp_editor(html_entity_decode(stripcslashes($post->post_excerpt)), 'excerpt', $settings);
	 
	    // The meta box description - adjust as necessary
	    // echo '&lt;p&gt;&lt;em&gt;Excerpts are optional, hand-crafted, summaries of your content.&lt;/em&gt;&lt;/p&gt;';
	}
	
	// And now... move everything up!
	// SOURCE: http://wordpress.stackexchange.com/questions/36600/how-can-i-put-a-custom-meta-box-above-the-editor-but-below-the-title-section-on
	
	add_action('edit_form_after_title', function() {
	    
	    # Get the globals:
	    global $post, $wp_meta_boxes;
	    
	    # Output the "advanced" meta boxes:
	    do_meta_boxes(get_current_screen(), 'advanced', $post);
	    
	    # Remove the initial "advanced" meta boxes:
	    unset($wp_meta_boxes[get_post_type($post)]['advanced']);
	});

}
