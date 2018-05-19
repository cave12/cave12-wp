<?php 

/* iCal output for Cave12
 *
*/

function cave12_ical_output() {
		
		if( !function_exists('mem_date_of_today') ) {
		
			return;
		
		}
		
		// define line return
		$r = "\r\n";
		
		$ical =  "BEGIN:VCALENDAR"                   .$r;
		$ical .= "VERSION:2.0"                       .$r;
		$ical .= "CALSCALE:GREGORIAN"                .$r;
		$ical .= "PRODID:cave12.org//Agenda 1.0//FR" .$r;
		$ical .= "X-WR-CALNAME;VALUE=TEXT:Cave12"    .$r;
		$ical .= "X-WR-TIMEZONE:Europe/Zurich"       .$r;
		$ical .= "TZID:Europe/Zurich"                .$r;
		
		// Query for Events
		
		$ical_events = cave12_ical_events();
		
		$ical .= $ical_events;

		$ical .= "END:VCALENDAR" .$r;
		
		return $ical;
		
}

function cave12_ical_events() {
	
	// Query for Events
	
	$cave12_cal_events = c12_concerts();
	
	// define line return
	$r = "\r\n";
	$html = "";
	
	// Produce the markup
	// Generate output:
	
	if ( $cave12_cal_events->have_posts() ) :
	
	  while( $cave12_cal_events->have_posts() ) : $cave12_cal_events->the_post(); 
	  
				$current_post_id = get_the_ID();
				$c12_item_date   = c12_date($current_post_id);
				$unixstart        = $c12_item_date["start-unix"];
				$unixend          = $c12_item_date["end-unix"];
				
				if ($unixend <= $unixstart) {
									
				 	// end day is SMALLER: 
				 	// we only want the TIME!!
				 	
				 	// add 2h to end time:
				 	$unixend = $unixend + 7200;
				 	
				}
				
				$icaltitle = get_the_title();
				$icaltitle = str_replace('&#8211;', '–', $icaltitle);
				$icaltitle = str_replace('&rsquo;', '’', $icaltitle);
				
		  	
	  
			  $html .= "BEGIN:VEVENT" .$r;
				$html .= "SUMMARY;LANGUAGE=FR:". $icaltitle .$r;
				$html .= "UID:article".$current_post_id."@cave12.org".$r;
				$html .= "DTSTAMP:".date( "Ymd\THis", $unixstart ).$r;
				$html .= "DTSTART;TZID=Europe/Zurich:".date( "Ymd\THis", $unixstart ).$r;
				$html .= "DTEND;TZID=Europe/Zurich:".  date( "Ymd\THis", $unixend   ).$r;
				$html .= "URL:".c12_future_permalink().$r;
				$html .= "STATUS:CONFIRMED".$r;
				$html .= "END:VEVENT".$r;

	  endwhile; 
  	wp_reset_postdata();
	endif;
	
	return $html;

}
