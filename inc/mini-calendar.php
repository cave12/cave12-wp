<?php 

			// Check ID of current article:
			$c12_item_id = get_the_ID();
			
			// 2) Check for transient
			
			if ( false === ( $c12_minical_events = get_transient( 'c12_minical_events' ) ) ) {
			    
			    // It wasn't there, so we generate the data and save the transient
			    			
			     $c12_minical_events = new WP_Query( array(
			     	'posts_per_page' => 25,
			     	'post_status' => array( 'publish', 'future' ),
			     	'date_query' => array(
			     		array(
			     			'after'     => date('Y-m-d', strtotime('-60 days')),
			     			'inclusive' => true,
			     		),
			     	),
			     	'meta_query' => array(
			     			array(
			     				'key'     => '_mem_start_date',
			     				'value'   => c12_date_yesterday(),
			     				'compare' => '>=',
			     			),
			     	),
			     	'orderby'  => 'meta_value',
			     	'order'  => 'ASC',
			     //'cat' => '10,12,13,14,18', 
			     	 	) ); 
			     	 	
			     	 	set_transient(
			     	 		'c12_minical_events', 
			     	 		$c12_minical_events, 
			     	 		60*60*3
			     	 	); // 3 heures = 60*60*3 secondes
			
			} // end of get_transient test
			
			// 4) We have defined $c12_minical_events
			// - now, generate output
			
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
