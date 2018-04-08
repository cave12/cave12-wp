<?php 

			// Check ID of current article:
			$c12_item_id = get_the_ID();
		
			$c12_minical_events = c12_concerts();
			
			// Generate output:
			
			if ( $c12_minical_events->have_posts() ) : ?>
			  
			  <style>.concert-no-<?php echo $c12_item_id; ?> a {
			  	background: #ce0000;
			  	color:#fff;
			  	box-shadow: inset 0 0 8px rgb(122, 11, 11);
			  }
			  .concert-no-<?php echo $c12_item_id; ?> a:hover {
			  	color: #fff;
			  }
			  
			  </style>
			  <ul class="mini-cal">
			  
			  <?php
			  while( $c12_minical_events->have_posts() ) : $c12_minical_events->the_post(); 
			  
						$current_post_id = get_the_ID();
						
						if ( function_exists( 'mem_date_processing' ) ) {
						
					  	$c12_item_date = mem_date_processing( 
					  		get_post_meta($current_post_id, '_mem_start_date', true) , 
					  		get_post_meta($current_post_id, '_mem_end_date', true)
					  	);
				  	
				  	}
			  
			  ?>
					
					<li class="mini-cal-box concert-no-<?php echo $current_post_id; ?>">
						<a href="<?php echo c12_future_permalink(); ?>" title="<?php the_title(); ?>">
						<?php 
						
						$c12_item_day_nr = date( "d", $c12_item_date["start-unix"] );
						
						if (1 == $c12_item_day_nr) {
						
							echo '1<sup class="sup">er</sup>';
							
						} else {
						
							echo $c12_item_day_nr;
						}
						
						 ?>
						</a></li>
					
			    <?php
			  endwhile; 
				
				?></ul><?php
				
			 wp_reset_postdata();
			endif; 

 ?>
