<?php
/**
 * Template Name: Archives
 *
 * Description: Index des archives
 *
 */

get_header(); ?>

<div id="contenu" class="contenu">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
  <article class="post texte entry-content" id="post-<?php the_ID(); ?>">
   
   	<div class="surlignable">
   	
    <header>
			<?php 
			
			c12_archive_titles();
			
			 ?>
    </header>
  	
    <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
    </div>

  </article>
  
  <?php endwhile; endif; ?>

</div><!--#contenu-->

<?php get_footer(); ?>
