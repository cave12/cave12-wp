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
  
  $c12_affiches_xavier = new WP_Query( array(
   	'posts_per_page' => 5,
   	'post_type' => 'attachment',
   	'post_status' => 'any',
   	// 'post_mime_type' => 'image/jpeg',
   	'orderby'  => 'name',
   	'order'  => 'ASC',
   	'tax_query' => array(
   			array(
   				'taxonomy' => 'affiches',
   				'field'    => 'slug',
   				'terms'    => 'thomas-perrodin',
   			),
   	),
  	) ); 
  	
//  echo '<pre>';
//  var_dump($c12_affiches_xavier);
//  echo '</pre>';
  
  if ( $c12_affiches_xavier->have_posts() ) : ?>
  
  <div class="bloc-affiches">
  	<h2>Affiches par Xavier Robel</h2>
  		<div class="affiche affiche-pdf">
  		<ul class="ul-horiz-img">
				
  <?php
  while( $c12_affiches_xavier->have_posts() ) : $c12_affiches_xavier->the_post();  ?>
  			<li><a href="<?php echo c12_future_permalink(); ?>"><?php the_title(); ?></a></li>
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
