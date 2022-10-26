<?php 

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

	// need to fix title typography
	$c12_article_title = c12_process_slashes(get_the_title());
	
	$output .= '<div class="concert">
		<a href="'.get_the_permalink().'" class="lien-article">'.$c12_article_title.'</a><br>';
		$mem_date = c12_date( get_the_ID() );
		$output .= date_i18n( "d.m.Y", $mem_date["start-unix"]);
		$output .= '</div>';
	
//	$output .= '<div class="date">';
//	$mem_date = c12_date(get_the_ID());
//	$output .= date_i18n( "j F Y", $mem_date["start-unix"]); 
//	$output .= '</div>';
	
	return $output;

}

