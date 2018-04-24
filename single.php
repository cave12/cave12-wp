<?php
/**
 * @package    WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="contenu" class="contenu programme vevent clear" role="main">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class="intro-block clear">
			
			<?php
			
			$mem_date = c12_date($post->ID);
			
			if ( $mem_date ) { 
			    	 
			  echo '<div class="date-block">';
			  
			  echo'<div id="date" class="art-date dtstart" title="'.esc_attr($mem_date["start-iso"]).'">';
					echo'<div class="uppercase center day">'.date_i18n( "l", $mem_date["start-unix"]).'</div>';
					echo'<div class="center daynr notc">'.date_i18n( "j", $mem_date["start-unix"]).'</div>';
					echo'<div class="uppercase center month">'.date_i18n( "F", $mem_date["start-unix"]).'</div>';
					echo'<div class="uppercase center year">'.$mem_date["date-year"].'</div>';
				echo '</div></div><!-- .date-block -->';
				
			}
			
			?>
			
			<div id="intro" class="intro">
				<?php 
				
				// add class "intro-redac" if it's a multi-day event
				 ?>
					<div id="map-container" class="hidden"></div>
					<h1 class="summary"><?php the_title(); ?></h1>
				<!-- microformat data -->
					<span class="category">Concert</span>
					<!-- / microformat data -->
			    	<!-- <h2 class="#EDIT{surtitre} surtitre">(#SURTITRE)</h2> -->
			    	<?php 
			    	
			    	if ( ! has_excerpt() ) {
	    	      echo '';
			    	} else { 
			    	
	    				echo '<div id="chapo" class="description chapo">';
	    	      the_excerpt();
	    	     	echo '</div>';
			    	}
			    	
			    	 ?>	
			</div><!-- #intro -->
			
			</div><!-- .intro-block -->
			
			<div id="programme-txt" class="programme-txt">
			<?php 
			
			$c12_content = get_the_content();
			
			$c12_content = tiss_process_hyperlinks($c12_content);
			
			echo apply_filters('the_content',$c12_content);
			
//			the_content( 'Read the rest of this entry &raquo;' ); 
			
			?>
			
	<?php 
	
	echo c12_other_concerts();

	 ?>
	</div><!-- .programme-txt -->
	<?php endwhile;
	else: ?>

		<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>

</div><!--#contenu-->

<?php get_footer(); ?>
