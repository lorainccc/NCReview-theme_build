<?php
/**
 * Template Name: Day
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<div class="small-12 medium-12 large-12 columns contentdiv">
	<div class="small-12 medium-12 large-12 columns nopadding">
		<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<?php $myvar = get_query_var('d');
						
		if($myvar != ''){
	$date=strtotime($myvar);
				$event_month=date("F",$date);
				$event_day=date("j",$date);
				$event_year=date("Y",$date);
	}elseif ($m == ""){  
    $dateComponents = getdate();
    $event_month = $dateComponents['month'];
    $myvar_event_month = $dateComponents['mon'];
				$event_year = $dateComponents['year'];
				$event_day = $dateComponents['mday'];
				$myvar = $event_year.'-'.$myvar_event_month.'-'.$event_day;
   } else {
     $event_month = $m;
     $event_year = $y;
     $event_day =$d;
   }
			
			
			?>	
			<div class="small-12 medium-12 large-12 columns">
				<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
				<li><a href="/calendar/?d=<?php echo $myvar;?>"><--- Back to Calendar</a></li>
				<li class="show-for-large-up">&nbsp;</li>
				<li style="text-align:right;"><a href="/week/?d=<?php echo $myvar; ?>">Back To Weekly View</a></li>	
				</ul>
			<h1><?php echo $event_month.' '.$event_day.', '.$event_year.' Events'; ?></h1>
			</div>		
				<div class="small-12 medium-12 large-12 columns pagediv">
										<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'calendarday' );
					endwhile; // End of the loop.
						?>
			</div>
			<div class="small-12 medium-12 large-12 columns events-list">	
						
										<?php 
												$args = array(
														'post_type' => 'lccc_event',
														'meta_query' => array(
																			array(
																						'key' => 'event_start_date',
																						'value' => $myvar,
																						'comapre' > 'BETWEEN',
																						'type' => 'DATE'
																			)
															),
														'orderby' => 'meta_value',
    										'meta_key' => 'event_start_time' ,
														'order'   => 'ASC',
													);
												query_posts( $args );
												// The Query
											$the_query = new WP_Query( $args );
												// The Loop
												if ( $the_query->have_posts() ) {
																while ( $the_query->have_posts() ) {
																	?>
																	<div class="small-12 medium-12 large-12 columns todays-event">
																	<?php	
																			$the_query->the_post();
																			$eventdate = event_meta_box_get_meta('event_start_date');													
																			$date=strtotime($eventdate);
																			$today_event_month=date("m",$date);
																			$today_event_day=date("j",$date);
																			$time=date("h:i A",$date);
																			?><?php the_title('<h2 class="event-title">','</h2>');?><?php
																			echo '<p class="event-time">'.$time.'</p>';
																			the_content('<p>','</p>');
																	?>
																	</div>	
																	<?php
																	}
												} else {
																	// no posts found
												}
											?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

</div>

</div>	
<?php
get_footer();
