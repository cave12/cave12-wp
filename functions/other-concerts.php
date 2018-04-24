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

