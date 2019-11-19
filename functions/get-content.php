<?php 

/*
* Display other concerts of same artist
* Used in: single.php
 */
 
function c12_other_concerts() {
	
		/* Montrer mots-clés / artistes
		*/
		
		$posttags = get_the_tags();
		$current_post_id = get_the_ID();
		
		if (empty($posttags)) {
			return;
		}
		
		$html ='<div class="autres-concerts">';
		
		foreach( $posttags as $tag ) {
			
			if ( 1 >= $tag->count ) {
    		continue;
			}
			
			$html .='<hr class="divider" />';
			$html .='<p>Autres concerts de <a href="';
			$html .= get_tag_link($tag->term_id);
			$html .='" class="nom-artiste">'; 
			$html .= $tag->name;
			$html .='</a> à la cave12:</p>';
	
			// Query for other posts linked to this Tag
			// & Exclude current post.
			
			$c12_other_concerts = new WP_Query( array(
				'posts_per_page' => -1,
				'tag_id' => $tag->term_id,
				'order'  => 'DESC',
				'orderby' => 'meta_value',
				'meta_key' => '_mem_start_date',
				'post__not_in' => array( $current_post_id )
			) );
			
			if ( $c12_other_concerts->have_posts() ) :   
			
				$html .= '<ul>';
				
				while( $c12_other_concerts->have_posts() ) : $c12_other_concerts->the_post(); 
					
					$mem_date = c12_date( get_the_ID() );
			
					$html .= '<li class="liste-concerts max-width">
						<span class="date">'.date_i18n( "j F Y", $mem_date["start-unix"]).'</span>: <a href="'.get_the_permalink().'" class="lien-article">'.get_the_title().'</a>';
			  
			  endwhile; 
			  
			  $html .= '</ul>';
				
			 	wp_reset_postdata();
			endif; 
			
			} // end foreach 
	
		  $html .= '</div>';
	
	return $html;
	
}

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

/*
* Display linked article
*
* Utilisé sur la page des affiches, pour lier au concert.
* Le concert est l'article parent de l'affiche.
 */

function c12_linked_article( $c12_article_id ) {

	$html = '';
	
	$inner_query = new WP_Query(array(
		'p' => $c12_article_id,
	));
	
  while ($inner_query->have_posts()) : $inner_query->the_post();
  
  	$html .= c12_linked_article_output();
 
  endwhile;
    
  return $html;  
	
}

/*
* Display linked SPIP article
*
* Utilisé sur la page des affiches, pour lier au concert.
* On utilise le champ 'c12_spip_article_id' pour identifier le concert.
*
 */

function c12_linked_spip_article( $c12_spip_article_id ) {

	$c12_spip_article_id = get_post_meta( get_the_ID(), 'c12_spip_linked_article', true ); 
	
	$html = '';
	
	$inner_query = new WP_Query(array(
		'meta_key'   => 'c12_spip_article_id',
		'meta_value' => $c12_spip_article_id,
	));
	
  while ($inner_query->have_posts()) : $inner_query->the_post();
  
  	$html .= c12_linked_article_output();
      
  endwhile;
    
  return $html;  
	
}

function c12_linked_article_output() {
	
	$output = '';
	
	$output .= '<div class="concert">
		<a href="'.get_the_permalink().'" class="lien-article">'.get_the_title().'</a><br>';
		$mem_date = c12_date( get_the_ID() );
		$output .= date_i18n( "d.m.Y", $mem_date["start-unix"]);
		$output .= '</div>';
	
//	$output .= '<div class="date">';
//	$mem_date = c12_date(get_the_ID());
//	$output .= date_i18n( "j F Y", $mem_date["start-unix"]); 
//	$output .= '</div>';
	
	return $output;

}

/*
 * C12 Fix pour Affiches
 *
 * Fonction utilisée sur le modèle "single.php" (article).
 *
 * Cette fonction sert à donner aux affiches liées au concert montré
 * un champ "post_parent". 
 * Ce champ permet de faire la requête plus facilement quand on est sur l'affiche, 
 * et qu'on veut connaître le concert lié.
 *
 * Cette fonction applique également la date du concert au fichier de l'affiche.
 * 
*/

function c12_fix_affiches( $article_id ) {

	// Tester le champ ACF
	
	$c12_affiches = get_field( 'c12_affiches', $article_id );
	
	if ($c12_affiches) {
  
  		// tester aussi si $c12_affiches[0] > zero
  		// car le champ peut-être là, mais vide.

		if  ( $c12_affiches[0] > 0) {
		
//			if ( current_user_can( 'edit_others_pages' ) ) {
//				echo '<pre>';
//				var_dump($c12_affiches);
//				echo '</pre>';
//			}
									
			foreach ( $c12_affiches as $affiche ) {
			
				// Attention: $affiche peut être un nombre (ID de l'affiche) 
				// ou un array, avec l'ID dans un champ [id].
				// Il faut tester:
				
				if (is_array($affiche)) {
					
					$affiche_id = $affiche["id"];
				
				} else {
				
					$affiche_id = $affiche;
					
				}
				
//				if ( current_user_can( 'edit_others_pages' ) ) {
//					echo '<pre>affiche_id : ';
//					echo $affiche_id ;
//					echo '</pre>';
//				}
			
//				 echo '<p>found attachment: id <a href="'.admin_url('upload.php?item='.$affiche_id).'">'. $affiche_id.'</a></p>';
//				
//				 echo '<p>define post '.$article_id.' as parent of '. $affiche_id.'</p>';
				
				$mem_date = c12_date($article_id);
				$fix_date = $mem_date["start-iso"]; 
				
				$c12_data = array(
			      'ID'            => $affiche_id,
			      'post_parent'   => $article_id,
			      'post_date'     => $fix_date,
			      'post_date_gmt' => get_gmt_from_date( $fix_date )
				  );
				
				wp_update_post( $c12_data );
				
			}
		}
	}
	
	return $c12_affiches; 				

}
