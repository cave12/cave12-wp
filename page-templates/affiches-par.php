<?php
/**
 * Template Name: Affiches Par...
 *
 * Description: Affiches par auteur
 *
 * Note: le slug va déterminer l'auteur à utiliser
 */

get_header(); ?>

<div id="contenu" class="contenu" role="main">

  <?php
  
  // Main Loop (Page)
  if (have_posts()) : while (have_posts()) : the_post();
  
  	echo '<h2>'.get_the_title().'</h2>';
  
  endwhile; endif; 

  // Get page slug
  $author = $post->post_name;
  $author = str_replace("affiches-", "", $author);
  
  
  
  echo c12_affiches($author);  
    
  ?>
	
</div><!--#contenu-->

<?php get_footer(); ?>
