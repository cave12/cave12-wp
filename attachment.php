<?php
/**
 * @package    WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="contenu" class="contenu clear" role="main">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class="intro-block clear">
			
			<?php
			
			$id = get_the_ID();
									
			?>
			
			<div id="intro" class="intro">
				<?php 
				
				// add class "intro-redac" if it's a multi-day event
				 ?>
					<div id="map-container" class="hidden"></div>
					<h1 class="summary"><?php the_title(); ?></h1>
			    	
			</div><!-- #intro -->
			
			</div><!-- .intro-block -->
			
			<div id="programme-txt" class="programme-txt">
			<?php 
			
			$c12_content = get_the_content();
			
			$c12_content = c12_process_hyperlinks($c12_content);
			
			echo apply_filters('the_content',$c12_content);
						
			?>
			

	</div><!-- .programme-txt -->
	<?php endwhile;
	else: ?>

		<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>

</div><!--#contenu-->

<?php get_footer(); ?>
