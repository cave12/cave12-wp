<?php
/**
 * @package    WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="contenu" class="contenu vcalendar" role="main">

	<?php if ( have_posts() ) : ?>
	
	<div id="propaganda" class="propaganda">
	
	<div id="titre-sommaire" class="titre-sommaire notc">
		<h3 class="titre-sommaire-h3">PROGRAMME</h3>
	</div>
	
	<div id="programme-pdf" class="programme-pdf prop-item">
			<a href="http://cave12.org/IMG/pdf/cave12_octobre_14_v3.1.pdf" title="Télécharger &ndash; 241.7 ko" type="application/pdf"  target="_blank" class="prop-item-label">.pdf</a>
				
		</div>
	
	<div id="mailing-list" class="newsletter-form prop-item">
		<label for="email" class="inco prop-item-label">Newsletter</label>
		<form action="http://admin.cave12.org/mail/mailinglist_process.php" method='post' name='formulaire' class="inco">
		<input type='hidden' name='maillist' value="aW5mb3JtYXppb25AY2F2ZTEyLm9yZw==" />
		<input type='email' id="email" name='email' placeholder='votre email' class="form-text inco" required>
		<input type='hidden' name='action' value="add">
		<input type='hidden' name='url' value="http://cave12.org/spip.php?article26">
		<input type='submit' name='add' value="s’abonner" class="button inco">
		</form>
	</div>
	
	</div><!--#propaganda-->
	
		<?php while ( have_posts() ) : the_post(); ?>
			
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

		<?php endwhile; ?>

	<?php else : ?>

		<h2 class="h2">Not Found</h2>
		<p>Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>

</div><!--#contenu-->


<?php get_footer(); ?>


