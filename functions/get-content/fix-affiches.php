<?php 



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

				// Ceci met à jour les données du fichier-affiche.
				
			}
		}
	}
	
	return $c12_affiches; 				

}
