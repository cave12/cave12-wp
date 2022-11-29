<?php 

/*
 * Contient les fonctions suivantes:
 
 * 1) Renommer les Tags en "Artistes"
 * 
 * 2) Création de custom post type: Archive
 *
 * 3) Création de taxonomies:
 *
 * * a) affiches
 * * b) lieux
 * 
*/

add_action( 'init', 'c12_tags_are_artists');

function c12_tags_are_artists() {

    global $wp_taxonomies;

    // The list of labels we can modify comes from
    //  http://codex.wordpress.org/Function_Reference/register_taxonomy
    //  http://core.trac.wordpress.org/browser/branches/3.0/wp-includes/taxonomy.php#L350
    
    // Info:
    // http://wordpress.stackexchange.com/questions/4182/can-the-default-post-tags-taxonomy-be-renamed
    // https://core.trac.wordpress.org/browser/branches/4.3/src/wp-includes/taxonomy.php#L496
    
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
        'view_item' => 'Voir artiste',
        'update_item' => 'Mettre à jour',
        'add_new_item' => 'Ajouter',
        'new_item_name' => 'Nouvel artiste',
        'separate_items_with_commas' => 'Séparer par des virgules',
        'add_or_remove_items' => 'Ajouter ou supprimer',
        'choose_from_most_used' => 'Choisir parmi les + utilisés',
        'not_found' => 'Rien trouvé',
        'no_terms' => 'Pas d’artiste',
        'items_list_navigation' => 'Artist list navigation',
        'items_list' => 'Artist list',
        'most_used' => 'Most Used',
        'back_to_items' => '&larr; Back to Tags',
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

add_action( 'init', 'c12_register_taxonomies' );
function c12_register_taxonomies() {

	/*
	 * Affiches
	*/

	$labels = array(
		"name" => "Affiches",
		"label" => "Affiches",
		"search_items" => "Recherche",
		"popular_items" => "Les + utilisées",
		"all_items" => "Tous les éléments",
		"parent_item" => "Eléments parents",
		"parent_item_colon" => "Elément parent",
		"edit_item" => "Modifier",
		"update_item" => "Enregistrer",
		"add_new_item" => "Nouvel élément",
		"new_item_name" => "Titre",
		);

	$args = array(
		"labels" => $labels,
		"hierarchical" => true,
		"label" => "Affiches",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'affiches', 'with_front' => false ),
		"show_admin_column" => true,
	);
	register_taxonomy( 'affiches', array( 'attachment' ), $args );
	
	/*
	 * Photos
	*/

	$labels = array(
		"name" => "Photos",
		"label" => "Photos",
		"search_items" => "Recherche",
		"popular_items" => "Les + utilisées",
		"all_items" => "Tous les éléments",
		"parent_item" => "Eléments parents",
		"parent_item_colon" => "Elément parent",
		"edit_item" => "Modifier",
		"update_item" => "Enregistrer",
		"add_new_item" => "Nouvel élément",
		"new_item_name" => "Titre",
		);

	$args = array(
		"labels" => $labels,
		"hierarchical" => true,
		"label" => "Photos",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'photos', 'with_front' => false ),
		"show_admin_column" => true,
	);
	register_taxonomy( 'photos', array( 'attachment' ), $args );
	
	
	/*
	 * Lieux
	*/
	
	$labels = array(
			"name" => "Lieux",
			"label" => "Lieux",
			"search_items" => "Recherche",
			"popular_items" => "Les + utilisées",
			"all_items" => "Tous les éléments",
			"parent_item" => "Eléments parents",
			"parent_item_colon" => "Elément parent",
			"edit_item" => "Modifier",
			"update_item" => "Enregistrer",
			"add_new_item" => "Nouvel élément",
			"new_item_name" => "Titre",
			);
	
		$args = array(
			"labels" => $labels,
			"hierarchical" => false,
			"label" => "Lieux",
			"show_ui" => true,
			"query_var" => true,
			"show_in_nav_menus" => false,
			"rewrite" => array( 'slug' => 'lieux', 'with_front' => false ),
			"show_admin_column" => false,
		);
		register_taxonomy( 'lieux', array( 'post' ), $args );

// End cptui_register_my_taxes
}