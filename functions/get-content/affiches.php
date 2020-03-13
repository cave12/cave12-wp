<?php 


/*
* Display Attachment by Tag
*
* Cette fonction va générer une liste d'affiches, 
* en fonction du contexte.
*
*/

function c12_affiches( $auteur ) {
  
  // Note: le nombre d'affiches
  // est défini dans pre-get-posts.php
  // avec 'posts_per_page' => 5, 
  
  $context = '';
  
  // Define context
  if ( is_page_template( 'page-templates/affiches.php' ) ) {
  	
  	$context = 'affiches';
  
  } else if ( is_page_template( 'page-templates/affiches-par.php' ) ) {
  	
  	$context = 'affiches-par';
  
  }
    
  $html = '';
  
  $c12_affiches = new WP_Query( array(
   	'post_type' => 'attachment',
   	'post_status' => 'any',
   	'orderby'  => 'date',
   	'order'  => 'DESC',
   	'tax_query' => array(
   			array(
   				'taxonomy' => 'affiches',
   				'field'    => 'slug',
   				'terms'    => $auteur, // p.ex. thomas-perrodin
   			),
   	),
  	) );
  
  if ( $c12_affiches->have_posts() ) :
  
  	$html .= '<section class="bloc-affiches">';
  	
  	if ( $context == 'affiches' ) {
  	
	  	$html .= '<h2>Affiches ';
	  	
	  	$term = get_term_by( 'slug', $auteur, 'affiches' ); 
	  	
	  	$html .= $term->name; // p.ex. "par Thomas Perrodin"
	  	
	  	$html .= '</h2>';
	  	
	  }
  	
  	$html .= '<div class="liste-affiches">';
  
  while( $c12_affiches->have_posts() ) : $c12_affiches->the_post();
  			
  			global $post;
  			
  			$id = get_the_ID();
  			
  			$pdf = wp_get_attachment_url( $id );
  			
  			$html .= '<figure class="affiche">';
  			$html .= '<a href="'; 
  			// $html .= wp_get_attachment_url( $id ) .'"'; 
  			// get width and height data attributes!
  			$c12_affiche_src = wp_get_attachment_image_src(
  				$id, 
  				'large'
  			);
  			$html .= $c12_affiche_src[0] .'"'; // URL
  			$html .= ' data-width="'.$c12_affiche_src[1] .'"'; 
  			$html .= ' data-height="'.$c12_affiche_src[2] .'"'; 
  			
  			// Add date, in order to debug things.
  			$html .= ' data-date="'.$post->post_date.'"';
  			
  			$html .= '>';

				$html .= wp_get_attachment_image(
					$id, // Image attachment ID
					'medium', // valid image size, or an array of width and height values in pixels
					false, // Whether the image should be treated as an icon
					'' // Attributes for the image markup
				);
					
				$html .= '</a>';
					
				$html .= '<figcaption class="affiche-meta">'; 
					
					// Concert lié?
					
					// 1) Tester le custom field:
					// c12_spip_linked_article 
					// (pour concerts importés depuis SPIP)
					
					if ( get_post_meta( $id, 'c12_spip_linked_article', true ) ) {
										
						$spip_id = get_post_meta( 
							$id, 'c12_spip_linked_article', true ); 
						
						$html .= c12_linked_spip_article( $spip_id );

					} else {
					
						// 2) Tester la relation enfant - parent:
						
						$parent_id = $post->post_parent;
						
						if ( $parent_id ) {
							
							$html .= c12_linked_article( $parent_id );
						
						}
						
					}
					
					$html .= '<div class="extra">';
					
					// Vérifier format (PDF ou JPG?)
					$mime_type = get_post_mime_type( $id );
										
					if ( $mime_type == "application/pdf" ) {
					
						$html .= '<a href="'; 
						$html .= wp_get_attachment_url( $id ); 
						$html .= '">PDF</a>';
						
					}
							
					if ( current_user_can( 'edit_others_pages' ) ) {
//						$html .= ' ( <a href="'; 
//						$html .= admin_url('upload.php?item='.$id);
//						$html .= '">edit</a> )';
					}
					
					$html .= '</div>';
				
				$html .= '</figcaption>';
		
			$html .= '</figure>';

    endwhile; 
  	
		if ( $context == 'affiches' ) {
			
			$html .= '<div class="affiche-credits">';
			$html .= '<a href="/affiches-'.$auteur.'">';
			// posters Xavier Robel
			$html .= 'Voir toutes les affiches ';
			$html .= $term->name;
			$html .= '</a>';
			$html .= '</div>';
			
		}
		
		$html .= '</div>'; // .liste-affiches
		$html .= '</section>'; // .bloc-affiches

  endif; 
  
  return $html;
  
}

