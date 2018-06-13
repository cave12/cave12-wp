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
  
  echo c12_affiches('xavier-robel');
  
  echo c12_affiches('thomas-perrodin');
  
  echo c12_affiches('harrisson');
  
    
  ?>
	
</div><!--#contenu-->

<?php get_footer(); ?>
