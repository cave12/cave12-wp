<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="contenu" class="contenu">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
  <article class="post texte entry-content" id="post-<?php the_ID(); ?>">
   
   	<div class="surlignable">
   	
    <header>
      <h1 class="h1"><?php the_title(); ?></h1>
    </header>
  	
    <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
    </div>

  </article>
  
  <?php endwhile; endif; ?>

</div><!--#contenu-->

<?php get_footer(); ?>

