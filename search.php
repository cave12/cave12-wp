<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

  <div id="contenu" class="contenu main" role="main">

  <?php if (have_posts()) : ?>

    <h2 class="h2">Résultats de la recherche</h2>

    
    <?php while (have_posts()) : the_post(); ?>

      <article <?php post_class() ?>>
				
				<?php 
				
				// Test for ACF field "La cave12 à l’Ecurie 'c12_surtitre'
				if ( get_post_meta( get_the_ID(), 'c12_surtitre', true ) ) : ?>
						<strong><?php echo get_post_meta( get_the_ID(), 'c12_surtitre', true ); ?></strong><br/>
				<?php endif;
				
				 ?>	
				
        <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<?php
				
					if ( ! has_excerpt() ) {
					      echo '';
					} else { 
					
//								echo '<div class="introduction entry-content">';
//								echo '<p href="'. c12_future_permalink() .'" rel="bookmark" class="url description">';
//					      the_excerpt();
//					     	echo '</p></div>';
					}
								
					$mem_date = c12_date( get_the_ID() );
				?>
				<time datetime="<?php 
				echo date_i18n( "Y-m-d", $mem_date["start-unix"]) 
				?>"><?php 
				// the_time( 'l, F jS, Y' );
				echo date_i18n( "j F Y", $mem_date["start-unix"]) 
				?></time>

          <?php // the_tags('Tags: ', ', ', '<br />'); ?>           
      </article>

    <?php endwhile; ?>

    <nav>
      <div><?php next_posts_link('&laquo; Older Entries') ?></div>
      <div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    </nav>

  <?php else : ?>

    <h2 class="h2">No posts found. Try a different search?</h2>
    <?php get_search_form(); ?>

  <?php endif; ?>

  </div>

<?php get_footer(); ?>
