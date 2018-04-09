<?php
/**
 * Template Name: Programme
 *
 * Description: Programme des concerts
 *
 */

get_header(); ?>

<div id="contenu" class="contenu vcalendar" role="main">

	<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
	
	<div id="propaganda" class="propaganda">
	
	<div id="titre-sommaire" class="titre-sommaire notc">
		<h3 class="titre-sommaire-h3"><?php the_title(); ?></h3>
	</div>
	
	<?php c12_programme_pdf(); ?>
	
	<?php c12_mailing_signup(); ?>
	
	</div><!--#propaganda-->
	
	<?php 
	
	endwhile;
	endif;

	// Concerts
	
	$c12_concerts = c12_concerts();
		
	if ( $c12_concerts->have_posts() ) : ?>
	  <?php
	  while( $c12_concerts->have_posts() ) : $c12_concerts->the_post(); ?>
			
			<?php 
			
			$mem_date = '';
			
			if ( function_exists( 'mem_date_processing' ) ) {
			
				$mem_date = mem_date_processing( 
					get_post_meta($post->ID, '_mem_start_date', true) , 
					get_post_meta($post->ID, '_mem_end_date', true)
				);
			
			}
			
			// classes: recent / demain / futur
			// 
			
			 ?>
			 
			 <article <?php post_class('art-box vevent') ?> id="post-<?php the_ID(); ?>">
			 
			 <?php 
			 
			 if ($mem_date) {
			 
			  ?>
			 
			 <div class="art-date dtstart" role="article">
			 	<?php  
			 	
			 	echo '<a href="'. get_the_permalink() .'" rel="bookmark" class="value-title" title="'.esc_attr($mem_date["start-iso"]).'"><div class="uppercase center day">'.date_i18n( "l", $mem_date["start-unix"]).'</div>';
			 	echo '<div class="center daynr">'.date_i18n( "j", $mem_date["start-unix"]).'</div>';
			 	echo '<div class="uppercase center month">'.date_i18n( "F", $mem_date["start-unix"]).'</div></a>';
			 ?>
			 </div><!-- .art-date -->
			 <?php 
			 
			 }
			 
			  ?>
			 <!-- microformat data -->
			 	<span class="summary"><?php the_title(); ?></span>
			 	<span class="category">Concert</span>
			 <!-- / microformat data -->
							
				<div class="art-sommaire">
					<!-- <h2 class="entry-title"><a href="#URL_ARTICLE" rel="bookmark">#SURTITRE</a></h2> -->
										
					<?php 
					
					if ( ! has_excerpt() ) {
					      echo '';
					} else { 
					
								echo '<div class="introduction entry-content">';
								echo '<a href="'. c12_future_permalink() .'" rel="bookmark" class="url description">';
					      the_excerpt();
					     	echo '</a></div>';
					}
					
					 ?>
					
				</div>
				
			</article>
	
	<?php
		 endwhile; 
	  wp_reset_postdata();
	 endif; 
	
	 ?>

</div><!--#contenu-->

<?php get_footer(); ?>
