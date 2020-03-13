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
	
	<?php 
	
	$c12_page_content = get_the_content();
	
	c12_programme_pdf();
	
	c12_mailing_signup(); 
	
	
	// Intro content
	 if ($c12_page_content) {
	 		
	 		echo '<div class="intro-content prop-item">';
	 		
	 		echo apply_filters('the_content',get_the_content( $c12_page_content ));
	 		
	 		echo '</div>';
	 
	 }
	 
	 
	
	?>
	
	</div><!--#propaganda-->
	
	<?php 
	
	endwhile;
	endif;

	// Concerts
	
	// function c12_concerts() in: functions.php
	
	$c12_concerts = c12_concerts();
	
	$c12_date_now = strtotime("now");
		
	if ( $c12_concerts->have_posts() ) : ?>
	  <?php
	  while( $c12_concerts->have_posts() ) : $c12_concerts->the_post(); ?>
			
			<?php 
			
			$mem_date = c12_date($post->ID);

			$c12_post_class = 'art-box vevent';
			
			if ($mem_date) {

				if ( $mem_date["start-unix"] < $c12_date_now ) {
				
					$c12_post_class .= ' recent';
				
				} else {
				
					if ( ( $mem_date["start-unix"] - $c12_date_now ) < ( 432000 ) ) {
					
					// 432000 = 5 jours
					
						$c12_post_class .= ' demain';
					
					} else {
					
						$c12_post_class .= ' futur';
					
					}
				}
			}
			
			 ?>
			 
			 <article <?php post_class( $c12_post_class ) ?> id="post-<?php the_ID(); ?>">
			 
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
	 
	 if( function_exists('acf_add_local_field_group') ):
	 	the_field('frontpage_footer');
		endif;
		
	 ?>

</div><!--#contenu-->

<?php get_footer(); ?>
