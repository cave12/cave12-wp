<?php 



add_action( 'init', 'c12_tags_are_artists');

function c12_tags_are_artists()
{
    global $wp_taxonomies;

    // The list of labels we can modify comes from
    //  http://codex.wordpress.org/Function_Reference/register_taxonomy
    //  http://core.trac.wordpress.org/browser/branches/3.0/wp-includes/taxonomy.php#L350
    $wp_taxonomies['post_tag']->labels = (object)array(
        'name' => 'Artistes',
        'menu_name' => 'Artistes',
        'singular_name' => 'Artiste',
        'search_items' => 'Rechercher',
        'popular_items' => 'Les + utilisés',
        'all_items' => 'Tous les artistes',
        'parent_item' => null, // Tags aren't hierarchical
        'parent_item_colon' => null,
        'edit_item' => 'Modifier',
        'update_item' => 'Mettre à jour',
        'add_new_item' => 'Ajouter',
        'new_item_name' => 'Nouvel artiste',
        'separate_items_with_commas' => 'Séparer par des virgules',
        'add_or_remove_items' => 'Ajouter ou supprimer',
        'choose_from_most_used' => 'Choisir parmi les + utilisés',
    );

    $wp_taxonomies['post_tag']->label = 'Artistes';
}


add_action( 'init', 'c12_register_archive_post_type' );

function c12_register_archive_post_type() {
	
	register_post_type(
		'archive',
		array(
			 'label'			   => 'Archives',
			 'labels'			  => array(
				 'name'			   => 'Archives',
				 'singular_name'	  => 'Archive',
				 'add_new'			=> __( 'Ajouter' ),
				 'add_new_item'	   => __( 'Ajouter une nouvelle archive' ),
				 'edit'			   => __( 'Éditer' ),
				 'edit_item'		  => __( 'Éditer l’archive' ),
				 'new_item'		   => __( 'Nouvelle archive' ),
				 'view'			   => __( 'Voir l’archive' ),
				 'view_item'		  => __( 'Voir l’archive' ),
				 'search_items'	   => __( 'Rechercher les archives' ),
				 'not_found'		  => __( 'Pas d’archives trouvées' ),
				 'not_found_in_trash' => __( 'Pas d’archives trouvées dans la Corbeille' ),
				 'parent_item_colon'  => __( 'Archive parente' ),
			 ),
			 'description'		 => __( 'Pages archives.' ),
			 'public'			  => true,
			 'show_ui'			 => true,
			 'publicly_queryable'  => true,
			 'exclude_from_search' => false,
			 'menu_position'	   => 20,
			 'menu_icon' => 'dashicons-welcome-write-blog',
			 'map_meta_cap'		=> true,
			 'hierarchical'		=> false,
			 'has_archive'		 => false,
			 'supports'			=> array(
				 'title',
				 'editor',
				 'author',
				 'thumbnail',
				 'revisions',
			 ),
			 'taxonomies'		  => array( '' ),
			 'rewrite'			 => array( 
			 	'slug'	   => 'archives',
				'with_front' => false,
				'pages' => false
				 ),
		)
	);
	
	}