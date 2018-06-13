<?php 

/*
* Display other concerts of same artist
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
				'posts_per_page' => 99,
				'tag_id' => $tag->term_id,
				'order'  => 'ASC',
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
* Display Poster by Tag
 */

function c12_affiches( $auteur ) {

 // Loop for "Xavier Robel"
  // Query for five attachments 
  
  // Note: 'posts_per_page' => 5, 
  // défini dans pre-get-posts.php
  
  $html = '';
  
  $c12_affiches_xavier = new WP_Query( array(
   	'post_type' => 'attachment',
   	'post_status' => 'any',
   	// 'post_mime_type' => 'image/jpeg',
   	'orderby'  => 'name',
   	'order'  => 'ASC',
   	'tax_query' => array(
   			array(
   				'taxonomy' => 'affiches',
   				'field'    => 'slug',
   				'terms'    => $auteur, // thomas-perrodin
   			),
   	),
  	) );
  
  if ( $c12_affiches_xavier->have_posts() ) :
  
  	$html .= '<div class="bloc-affiches">';
  	$html .= '<h2>Affiches ';
  	
  	$term = get_term_by( 'slug', $auteur, 'affiches' ); 
  	
  	$html .= $term->name; // par Thomas Perrodin
  	
  	$html .= '</h2>';
  	
  	$html .= '<div class="affiche affiche-pdf">';
  	$html .= '<ul class="ul-horiz-img">';
				
  
  while( $c12_affiches_xavier->have_posts() ) : $c12_affiches_xavier->the_post();
  			
  			$html .= '<li>';
										
//					 global $post;
//					 var_dump($post);
					$id = get_the_ID();
					
					$html .= wp_get_attachment_image(
						$id, // Image attachment ID
						'medium', // valid image size, or an array of width and height values in pixels
						false, // Whether the image should be treated as an icon
						'' // Attributes for the image markup
					);
					
					// Concert lié?
					// echo $post->post_parent;
					
					// Utiliser le custom field:
					// c12_spip_linked_article
					
					if ( get_post_meta( get_the_ID(), 'c12_spip_linked_article', true ) ) {
										
						$spip_id = get_post_meta( 
							$id, 'c12_spip_linked_article', true ); 
						
						$html .= c12_linked_spip_article( $spip_id );

					} 
					
					$html .= '<a href="'; 
					$html .= wp_get_attachment_url( $id ); 
					$html .= '">PDF</a>';
				
					$html .= '</li>';

    endwhile; 
  	
		$html .= '</ul>';
		$html .= '</div>';
		$html .= '<p class="affiche-credits">';
		
		// Produce link to poster list template...
		
		$html .= '(<a href="/Xavier-Robel">voir +</a>)';
		$html .= '</p>';
		$html .= '</div><!-- .bloc-affiches -->';

  endif; 
  
  return $html;
  
}

/*
* Display linked article
 */

function c12_linked_spip_article( $c12_spip_article_id ) {

	$c12_spip_article_id = get_post_meta( get_the_ID(), 'c12_spip_linked_article', true ); 
	
	$html = '';
	
	$inner_query = new WP_Query(array(
		'meta_key'   => 'c12_spip_article_id',
		'meta_value' => $c12_spip_article_id,
	));
	
    while ($inner_query->have_posts()) : $inner_query->the_post();
    
    	$html .= '<a href="'.get_the_permalink().'" class="lien-article">'.get_the_title().'</a>';
        // do something
        
      $mem_date = c12_date(get_the_ID());
      $html .= date_i18n( "j F Y", $mem_date["start-unix"]); 
        
    endwhile;
    
  return $html;  
	
} 
