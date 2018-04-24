<?php
/**
 * @package WordPress
 * @subpackage HTML5_Boilerplate
 */

get_header(); ?>

<div id="contenu" class="contenu archives">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
  <article class="post texte entry-content" id="post-<?php the_ID(); ?>">
   
   	<div class="surlignable">
   	
    <header>
    
    	<?php 
    	
    	// on crée une liste des archives
    	    	
    	
    	c12_archive_titles();

    	?>
    	
      <h1 class="h1">archives <?php the_title(); ?></h1>
      
    </header>
  	
    <?php the_content(); ?>
    
    <?php 
    
    // auto-display posts of current year.
    
    // get slug of current page: 
    $c12_archive_slug = $post->post_name;
    
    if ( false === ( $c12_archive_year = get_transient( 'c12_archive_year_'.$c12_archive_slug ) ) ) {
        
        // It wasn't there, so we generate the data and save the transient
        $c12_archive_year_start = $c12_archive_slug;
        $c12_archive_year_end = $c12_archive_slug.'-12-32';
        
        if ( $c12_archive_slug == date("Y") ) {
        
        	// Exception: the year is the CURRENT year, so stop at present date (don't show future concerts).
        
        	$c12_archive_year_end = date("Y-m-d");
        
        }
    
       $c12_archive_year = new WP_Query( array(
       	'posts_per_page' => 999,
       	'meta_key' => '_mem_start_date',
       	'meta_value'	=> array( 
       			$c12_archive_year_start, 
       			$c12_archive_year_end ),
       	'meta_compare'	=> 'BETWEEN',
       	'orderby'  => 'meta_value',
       	'order'  => 'ASC',
       	 	) ); 
       	 	
     	 	set_transient(
     	 		'c12_archive_year_'.$c12_archive_slug, 
     	 		$c12_archive_year, 
     	 		120 
     	 	); // 3 heures = 60*60*3
    
    } // end of get_transient test
    
    
    if ( $c12_archive_year->have_posts() ) : ?>
      
      <ul class="articles">
      
      <?php
      while( $c12_archive_year->have_posts() ) : $c12_archive_year->the_post(); 
      
    			$current_post_id = get_the_ID();

    	  	$mem_date = c12_date($current_post_id);
      
      ?>
    		
    			<li>
    				<?php 
    				
    				if ( ! has_excerpt() ) {
    				      echo '';
    				} else { 
    				
//    							echo '<strong>';
//    				      the_excerpt();
//    				     	echo '</strong><br/>';
    				}
    				
    				 ?>
    			  <span class="date"><?php 
    			  
    			  echo date_i18n( "j", $mem_date["start-unix"]);
    			  echo ' ';
    			  echo date_i18n( "F", $mem_date["start-unix"]); ?></span> – 
    			   <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    			</li>
    		
        <?php
      endwhile; 
    	
    	?></ul><?php
    	
    	// Montrer nombre de concerts:
    	
    	echo '<p>'.$c12_archive_year->found_posts ; 
    	echo ' concerts ont eu lieu en '.$c12_archive_slug;
    	echo '.</p>';
    	
     wp_reset_postdata();
    endif; 
    
    
     ?>	
    
    
    </div>

  </article>
  
  <?php endwhile; endif; ?>

</div><!--#contenu-->

<?php get_footer(); ?>

