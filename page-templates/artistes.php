<?php
/**
 * Template Name: Artistes
 *
 * Description: Index des artistes
 *
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
		
		<ul class="toc-alphabetic ul-unstyled ul-horiz">
			<li class="link-A"><a href="#noms-A">A</a></li>
			<li class="link-B"><a href="#noms-B">B</a></li>
			<li class="link-C"><a href="#noms-C">C</a></li>
			<li class="link-D"><a href="#noms-D">D</a></li>
			<li class="link-E"><a href="#noms-E">E</a></li>
			<li class="link-F"><a href="#noms-F">F</a></li>
			<li class="link-G"><a href="#noms-G">G</a></li>
			<li class="link-H"><a href="#noms-H">H</a></li>
			<li class="link-I"><a href="#noms-I">I</a></li>
			<li class="link-J"><a href="#noms-J">J</a></li>
			<li class="link-K"><a href="#noms-K">K</a></li>
			<li class="link-L"><a href="#noms-L">L</a></li>
			<li class="link-M"><a href="#noms-M">M</a></li>
			<li class="link-N"><a href="#noms-N">N</a></li>
			<li class="link-O"><a href="#noms-O">O</a></li>
			<li class="link-P"><a href="#noms-P">P</a></li>
			<li class="link-Q"><a href="#noms-Q">Q</a></li>
			<li class="link-R"><a href="#noms-R">R</a></li>
			<li class="link-S"><a href="#noms-S">S</a></li>
			<li class="link-T"><a href="#noms-T">T</a></li>
			<li class="link-U"><a href="#noms-U">U</a></li>
			<li class="link-V"><a href="#noms-V">V</a></li>
			<li class="link-W"><a href="#noms-W">W</a></li>
			<li class="link-X"><a href="#noms-X">X</a></li>
			<li class="link-Y"><a href="#noms-Y">Y</a></li>
			<li class="link-Z"><a href="#noms-Z">Z</a></li>
		</ul>
		<?php

		$output = '<div class="post_tags">';
		
		$initialcounter = 1;
		$prev_initiale = '';
		
		$tags = get_tags();
		
		foreach ( $tags as $tag ) {
			$tag_link = get_tag_link( $tag->term_id );
			
			
			$nom_entier = $tag->slug ;
			$nom_initiale = strtoupper(mb_substr($nom_entier,0,1, "utf-8"));
			
			if ($nom_initiale != $prev_initiale) {
				
				if ($initialcounter != 1) {
					$output .= '</ul>'; // close previous initiale
				}
				
				$output .= '<span id="noms-'. $nom_initiale .'"></span>
				<h2 class="toc-anchor">'. $nom_initiale .'</h2>';
				
				$output .= '<ul class="ul-initiale clean unstyled rel">';
					
			} 
					
			$output .= "<li class='lien-mot'><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
			$output .= "{$tag->name}</a></li>";
			
			// increment counter
			$prev_initiale = $nom_initiale;
			$initialcounter++;
			
		}
		
		// close the final "ul-initiale"
		$output .= '</ul>';
		
		$output .= '</div>'; // close div.post_tags
		echo $output;
		
		 ?>

  </article>
  
  <?php endwhile; endif; ?>

</div><!--#contenu-->

<?php get_footer(); ?>