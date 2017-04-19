<?php
/**
 * Template Name: Next Week
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
<div class="small-12 medium-12 large-12 columns contentdiv">
			<div class="small-12 medium-12 large-12 columns pagediv">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'eventscalendar' );
					endwhile; // End of the loop.
						?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
	<div class="small-12 medium-12 large-12 columns">
<?php 
				$startdate = get_query_var('d');
				$date=strtotime($startdate);
				$startmonth=date("m",$date);
				$startday=date("j",$date);
				$startyear=date("Y",$date);
				$displaycount =1;
				$today = getdate();		
				$currentDay = $today['mday'];
				$lastdaydisplayed = '';
				$startdaylastweek = $currentDay - 8;
				$currentmonthdisplayed = '';
	function todayPosts($month, $currentDay, $year){
				$todaysevents = '';
				$temp = strLen($currentDay);
				$twoDay = '';
	   $nextTwoDay = '';
				if ($temp < 2){
					$twoDay = '0' . $currentDay;
				}else{
					$twoDay = $currentDay;
				}
			 $nextDay = $currentDay + 1;
				if ($temp < 2){
					$nextTwoDay = '0' . $currentDay;
				}else{
					$nextTwoDay = $currentDay;
				}
				$args = array(
						'post_type' => 'lccc_event',
						'meta_key' => 'event_start_date',
						'meta_value' => $year . '-' . $month . '-' . $twoDay,
					'meta_value_num' => time(),
						'orderby' =>'meta_value_num',
						'compare' => 'BETWEEN',
						'type' => 'DATE'
					);
				query_posts( $args );
				// The Query
			$the_query = new WP_Query( $args );
				// The Loop
				if ( $the_query->have_posts() ) {
										$todaysevents .= '<ul class="todayseventslist">';
										while ( $the_query->have_posts() ) {
										$the_query->the_post();
										$eventdate = event_meta_box_get_meta('event_meta_box_event_start_date_and_time_');	
										$date=strtotime($eventdate);
										$today_event_month=date("m",$date);
										$today_event_day=date("j",$date);	
										$todaysevents .= '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
									}
									$todaysevents .= '</ul>';
								} else {
									// no posts found
				}
				/* Restore original Post Data */
				wp_reset_postdata();
		return $todaysevents;
}
function build_calendar($month,$year,$dateArray) {
					global $lastdaydisplayed;
					global $displaycount;
					global $currentmonthdisplayed;
					global $startday;
     // Create array containing abbreviations of days of week.
     $daysOfWeek = array('Sun','Mon','Tues','Wed','Thurs','Fri','Sat');
     // What is the first day of the month in question?
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
     // How many days does this month contain?
     $numberDays = date('t',$firstDayOfMonth);
     // Retrieve some information about the first day of the
     // month in question.
     $dateComponents = getdate($firstDayOfMonth);
     // What is the name of the month in question?
     $monthName = $dateComponents['month'];
     // What is the index value (0-6) of the first day of the
     // month in question.
     $dayOfWeek = $dateComponents['wday'];
     // Create the table tag opener and day headers
     $calendar = "<ul class='calendar'>";
     //$calendar .= "<caption>$monthName $year</caption>";
     //$calendar .= "<li>";
     // Create the calendar headers
     //foreach($daysOfWeek as $day) {
     //     $calendar .= "<th class='header'>$day</th>";
     //} 
     // Create the rest of the calendar
     // Get today's date and extract the day of the month to start on.
	    
					$currentDay = $startday;
	
     // Initiate the day counter, starting with the 1st.
					//$currentDay = 1;
	
					//$calendar .= "<li>";
     
					// The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.
     //if ($dayOfWeek > 0) { 
     //     $calendar .= "<div colspan='$dayOfWeek' class='not-month'>&nbsp;</div>"; 
     //}
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while (($currentDay <= $numberDays) && ($displaycount !=8)) {
          // Seventh column (Saturday) reached. Start a new row.
          if ($dayOfWeek == 7) {
               $dayOfWeek = 0;

															//$calendar .= "</li><li>";
          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          
          $date = "$year-$month-$currentDayRel";
          
          if ($date == date("Y-m-d")){
           $calendar .= "<li class='day today' rel='$date'><span class='today-date'><a class='datelink-currentday' href='/day/?d=$date'>$monthName $currentDay, $year </a></span><span class='event_entries'>".todayPosts($month,$currentDay,$year)."</span></li>";
          }
          else{
           $calendar .= "<li class='day' rel='$date'><span class='day-date'><a class='datelink' href='/day/?d=$date'>$monthName $currentDay, $year </a></span><span class='event_entries'>".todayPosts($month,$currentDay,$year)."</span></li>";
          }
										$currentmonthdisplayed = $month;
										$lastdaydisplayed = $currentDay;
          // Increment counters
          $currentDay++;
          $dayOfWeek++;
										$displaycount++;
     }
     
     
     // Complete the row of the last week in month, if necessary
     //if ($dayOfWeek != 7) { 
     //     $remainingDays = 7 - $dayOfWeek;
     //     $calendar .= "<div colspan='$remainingDays' class='not-month'>&nbsp;</div>"; 
     //}
     
     //$calendar .= "</li>";
					$calendar .= "</ul>";
					$lastdaydisplayed = $date;
     return $calendar;
}
function add_to_list($month,$year,$dateArray) {
					global $lastdaydisplayed;
					global $displaycount;
					global $currentmonthdisplayed;
					$daysinnemonth = 8 - $displaycount;
     // Create array containing abbreviations of days of week.
     $daysOfWeek = array('Sun','Mon','Tues','Wed','Thurs','Fri','Sat');
     // What is the first day of the month in question?
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
     // How many days does this month contain?
     $numberDays = date('t',$firstDayOfMonth);
     // Retrieve some information about the first day of the
     // month in question.
     $dateComponents = getdate($firstDayOfMonth);
     // What is the name of the month in question?
     $monthName = $dateComponents['month'];
     // What is the index value (0-6) of the first day of the
     // month in question.
     $dayOfWeek = $dateComponents['wday'];
     // Create the table tag opener and day headers
     $calendar = "<ul class='calendar'>";
     //$calendar .= "<caption>$monthName $year</caption>";
     //$calendar .= "<li>";
     // Create the calendar headers
     //foreach($daysOfWeek as $day) {
     //     $calendar .= "<th class='header'>$day</th>";
     //} 
     // Create the rest of the calendar
     // Get today's date and extract the day of the month to start on.
	    //$today = getdate();		
					//$currentDay = $today['mday'];
	
     // Initiate the day counter, starting with the 1st.
					$currentDay = 1;
	
					//$calendar .= "<li>";
     
					// The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.
     //if ($dayOfWeek > 0) { 
     //     $calendar .= "<div colspan='$dayOfWeek' class='not-month'>&nbsp;</div>"; 
     //}
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $daysinnemonth) {
          // Seventh column (Saturday) reached. Start a new row.
          if ($dayOfWeek == 7) {
               $dayOfWeek = 0;

															//$calendar .= "</li><li>";
          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          
          $date = "$year-$month-$currentDayRel";
          
          if ($date == date("Y-m-d")){
           $calendar .= "<li class='day today' rel='$date'><span class='today-date'><a class='datelink-currentday' href='/day/?d=$date'>$monthName $currentDay, $year</a></span><span class='event_entries'>".todayPosts($month,$currentDay,$year)."</span></li>";
          }
          else{
           $calendar .= "<li class='day' rel='$date'><span class='day-date'><a class='datelink' href='/day/?d=$date'>$monthName $currentDay, $year</a></span><span class='event_entries'>".todayPosts($month,$currentDay,$year)."</span></li>";
          }
						$lastdaydisplayed = $date;
          // Increment counters
          $currentDay++;
          $dayOfWeek++;
										$displaycount++;
     }
     
     
     // Complete the row of the last week in month, if necessary
     //if ($dayOfWeek != 7) { 
     //     $remainingDays = 7 - $dayOfWeek;
     //     $calendar .= "<div colspan='$remainingDays' class='not-month'>&nbsp;</div>"; 
     //}
     
     //$calendar .= "</li>";

					$calendar .= "</ul>";
     return $calendar;
}
function build_nextWeek($currentmonthdisplayed,$year,$monthString){
 global $lastdaydisplayed;
	global $currentmonthdisplayed;

 return "<div style='width: 33%; display:inline-block;'>&nbsp;</div><div style='width: 33%; display:inline-block; text-align:right;'><a href='/next-week/?d=$lastdaydisplayed'>Next 7 Days -></a></div>";
}
 echo build_calendar($startmonth,$startyear,$dateArray);
		if ($displaycount<8){
	$nxtmonth = $startmonth+1;
	echo add_to_list($nxtmonth,$startyear,$dateArray);
	}
echo build_nextWeek($currentmonthdisplayed,$year,$monthString);	
?>
</div>
</div>	
<?php
get_footer();
