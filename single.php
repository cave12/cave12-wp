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
			
			$id = get_the_ID();
						
			$mem_date = c12_date($id);
			
			if ( $mem_date ) { 
			    	 
			  echo '<div class="date-block">';
			  
			  echo'<div id="date" class="art-date dtstart" title="'.esc_attr($mem_date["start-iso"]).'">';
			  
			  // Nom du jour
					echo'<div class="uppercase center day">'.date_i18n( "l", $mem_date["start-unix"]).'</div>';
				
				// Numéro du jour
				
				$c12_day_nr = date( "j", $mem_date["start-unix"] );
				
				if ( 1 == $c12_day_nr ) {
				
					$c12_day_nr = '1<sup class="sup">er</sup>';
					
				}
				
					echo'<div class="center daynr notc">'.$c12_day_nr.'</div>';
				
				// Mois
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
					<?php 
						
						// Test for ACF field "La cave12 à l’Ecurie 'c12_surtitre'
						if ( get_post_meta( get_the_ID(), 'c12_surtitre', true ) ) : ?>
							<h2 class="surtitre"><?php echo get_post_meta( get_the_ID(), 'c12_surtitre', true ); ?></h2>
						<?php endif;
					
					 ?>
			    	
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
			
			$c12_content = c12_process_hyperlinks($c12_content);
			
			echo apply_filters('the_content',$c12_content);
						
			?>
			
	<?php 
	
	echo c12_other_concerts();
	
	c12_fix_affiches( $id );

	 ?>
	</div><!-- .programme-txt -->
	<?php endwhile;
	else: ?>

		<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>

</div><!--#contenu-->

<?php get_footer(); ?>
