<?php
/**
 * Template Name: Affiches
 *
 * Description: Index des affiches
 *
 */

get_header(); ?>

<div id="contenu" class="contenu" role="main">

  <?php 
  // Main Loop (Page)
  
  if (have_posts()) : while (have_posts()) : the_post();
  endwhile; endif; 
  
  // Loop for Xavier Robel
  // Query for five attachments 
  
  // Note: 'posts_per_page' => 5, 
  // défini dans pre-get-posts.php
  
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
   				'terms'    => 'xavier-robel', // thomas-perrodin
   			),
   	),
  	) );
  
  if ( $c12_affiches_xavier->have_posts() ) : ?>
  
  <div class="bloc-affiches">
  	<h2>Affiches par Xavier Robel</h2>
  		<div class="affiche affiche-pdf">
  		<ul class="ul-horiz-img">
				
  <?php
  while( $c12_affiches_xavier->have_posts() ) : $c12_affiches_xavier->the_post();  ?>
  			<li>
					
					<?php 
					
//					 global $post;
//					 var_dump($post);
					
					echo wp_get_attachment_image(
						get_the_ID(), // Image attachment ID
						'medium', // valid image size, or an array of width and height values in pixels
						false, // Whether the image should be treated as an icon
						'' // Attributes for the image markup
					);
					
					// Concert lié?
					// echo $post->post_parent;
					
					// Utiliser le custom field:
					// c12_spip_linked_article
					
					if ( get_post_meta( get_the_ID(), 'c12_spip_linked_article', true ) ) {
					
						$c12_spip_article_id = get_post_meta( get_the_ID(), 'c12_spip_linked_article', true ); 
						
						$inner_query = new WP_Query(array(
							'meta_key'   => 'c12_spip_article_id',
							'meta_value' => $c12_spip_article_id,
						));
						
						    while ($inner_query->have_posts()) : $inner_query->the_post();
						    
						    	echo '<a href="'.get_the_permalink().'" class="lien-article">'.get_the_title().'</a>';
						        // do something
						        
						       // 16 mars 2015
						      $mem_date = c12_date(get_the_ID());
						       
						      echo date_i18n( "j F Y", $mem_date["start-unix"]); 
						        
						    endwhile;
						
					} 
					
					 ?>
					
					<a href="<?php 
					
					echo wp_get_attachment_url( get_the_ID() ); 
					
					?>">PDF</a>
				
				
				</li>
    <?php
    endwhile; 
  	?>
				</ul>
			</div>
			<p class="affiche-credits">
				 (<a href="/Xavier-Robel">voir +</a>)
			</p>
	</div><!-- .bloc-affiches -->
	<?php
  wp_reset_postdata();
  endif; 
   
  ?>
	
	

</div><!--#contenu-->

<?php get_footer(); ?>
