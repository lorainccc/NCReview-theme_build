<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MyLCCC_Theme
 */

get_header(); ?>
<div class="small-12 medium-12 large-12 columns contentdiv">
	<div class="small-12 medium-12 large-12 columns nopadding">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="page-header">
				<h1 class="page-title">LCCC Events</h1>
				<?php
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
		<?php
				$today = getdate();
				$currentDay = $today['mday'];
				$month = $today['mon'];
				$year = $today['year'];
				$firsteventdate ='';
    $nexteventdate ='';
				$todaysevents = '';
				$temp = strLen($currentDay);            
				$twoDay = '';
	   $nextTwoDay = '';
    if ($temp < 2){
							$twoDay = '0' . $currentDay;
				}else{
							$twoDay = $currentDay;
				}
				$twomonth = '';
    $tempmonth = strLen($month);
    if ($tempmonth < 2){
							$twomonth = '0' . $month;
				}else{
							$twomonth = $month;
				}
			 $nextDay = $currentDay + 1;
				if ($temp < 2){
							$nextTwoDay = '0' . $currentDay;
				}else{
							$nextTwoDay = $currentDay;
				}
     $today = "$year-$twomonth-$twoDay";
					
					$eventargs=array(
					'post_type' => 'lccc_event',
					'post_status' => 'publish',
  			'posts_per_page' => $numberofposts,
					'category_name' => $widgetcategory,
					'meta_query' => array(
													'relation' => 'AND', 
													'start_date' => array(
                  'key' => 'event_start_date',
                  'compare' => 'EXISTS',
																		'type' => 'DATE',
              ),									
						 
									'time_order' => array(
              'key' => 'event_start_time',
              'compare' => 'EXISTS',
         ), 			 
							),
						'orderby' => array(
                  'start_date' => 'ASC',
																		'time_order' => 'ASC',
          ),
					);
					$newevents = new WP_Query($eventargs);
					if ( $newevents->have_posts() ) :
							while ( $newevents->have_posts() ) : $newevents->the_post();
	$starteventdate = 
			event_meta_box_get_meta('event_start_date');
		$starteventtime = event_meta_box_get_meta('event_start_time');  
		$endeventdate = event_meta_box_get_meta('event_end_date');
		$endtime = event_meta_box_get_meta('event_end_time');
		

										$starttimevar=strtotime($starteventtime);
										$starttime=	date("h:i a",$starttimevar);
										$starteventtimehours = date("G",$starttimevar);
										$starteventtimeminutes = date("i",$starttimevar);
		
          $startdate=strtotime($starteventdate);
										$eventstartdate=date("Y-m-d",$startdate);
										$eventstartmonth=date("M",$startdate);
										$eventstartday =date("j",$startdate);								
										
										$endeventtimevar=strtotime($endtime);
										$endeventtime = date("h:i a",$endeventtimevar);
										$endeventtimehours = date("G",$endeventtimevar);
										$endeventtimeminutes = date("i",$endeventtimevar);
		
										$enddate=strtotime($endeventdate);
										$endeventdate = date("Y-m-d",$enddate);
						

		
										
		$duration = '';
		if($endeventtimehours == 0){
			$endeventtimehours =24;
		}
		$durationhours =	$endeventtimehours - $starteventtimehours;
		if($durationhours > 0){
				if($durationhours == 24){
				$duration .= '1 day';
				}else{
				$duration .= $durationhours.'hrs'; 
				}
		}
		$durationminutes = $endeventtimeminutes - $starteventtimeminutes;
		if($durationminutes > 0){
			$duration .= $durationminutes.'mins';
		}
										
										$date=strtotime($today);
										$today_event_month=date("M",$date);
          $today_event_day=date("j",$date);
		
          //echo 'Today:'.$today.'<br />';
										//echo 'Event Start Date and Time: '. $starteventdate.'<br />';
										//echo 'Event Start:'.$eventstartdate.'<br />';
										//echo 'Event Start Time:'.$starttime.'<br />';
										//echo 'Event Start Month:'.$eventstartmonth.'<br />';
										//echo 'Event Start Day:'.$eventstartday.'<br />';
										//echo 'Event End Date:'.$endeventdate.'<br />';
									
									echo '<div class="small-12 medium-12 large-12 columns archive-eventcontainer">';
							echo '<div class="small-12 medium-12 large-1 columns calender">';
							echo '<p class="month">'.$eventstartmonth.'</p>';
							echo '<p class="day">'.$eventstartday.'</p>';
							echo '</div>';
							echo '<div class="small-12 medium-12 large-11 columns eventslist">';
													?><a href="<?php the_permalink();?>"><?php the_title('<h3 class="eventtitle">','</h3>');?></a>
								<?php
						echo '<p style="font-weight: bold;margin-bottom: 0;">Start Time: '.$starttime.'</p>';		
					echo '<p>Duration: '.$duration.'</p>';
							the_excerpt('<p>','</p>');
							echo '</div>';
				
							echo '</div>';
							endwhile;
					endif;
			
			
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	</div>

</div>		
		<?php
get_footer();
