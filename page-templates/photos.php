<?php
/**
 * Template Name: Photos
 *
 * Description: Page des photos
 *
 */

get_header(); ?>

<main id="contenu" class="contenu" role="main">

  <?php 
  // Main Loop (Page)
  
  if (have_posts()) : while (have_posts()) : the_post();
  endwhile; endif; 

  // on veut récupérer des images... 

  // Note: 'posts_per_page' => 5, 
  // défini dans pre-get-posts.php
  
  echo c12_photos('diaporama');
  
 

  ?>
	
</main><!--#contenu-->

<?php get_footer(); ?>