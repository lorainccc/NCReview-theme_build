<?php
/**
 * Template Name: Week
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
$myvar = get_query_var('d');
   //parse_str($_SERVER['QUERY_STRING']);  
 if($myvar != ''){
	$date=strtotime($myvar);
				$month=date("m",$date);
				$day=date("j",$date);
				$year=date("Y",$date);
	}elseif ($m == ""){  
    $dateComponents = getdate();
    $month = $dateComponents['mon'];
    $year = $dateComponents['year'];
				$day = $dateComponents['mday'];
   } else {
     $month = $m;
     $year = $y;
     $day =$d;
   }

$monthString = array();
$dateArray = array();

?>
<?php 	$lastdate =  $year.'-'.$month.'-'.$day; ?>
			<a href='/calendar/?d=<?php echo $lastdate;?>'><-- Back To The Calendar</a><br />	
<ul class="small-block-grid-1 small-block-grid-3 large-block-grid-3">		
						<li>
							<?php
							 do_action( 'lccc_prev_week',$year, $month, $day);
						?>
	</li>
							<li><div style='display:inline-block;'>&nbsp;</div><div style='text-align:center;'><a href="/week">Today</a></div></li>
						<li><?php do_action( 'lccc_next_week',$year, $month, $day); ?></li>
</ul>
<?php

//Code for calling functions to generate page
do_action('lccc_week',$month,$year,$day);
	
	// What is the first day of the month in question?
					$firstDayOfMonth = mktime(0,0,0,$month,1,$year);
	// How many days does this month contain?
					$numberDays = date('t',$firstDayOfMonth);
     $daydisplaycounter = '';
					if($day+7 > $numberDays){
							$nxtmonth = $month+1;	
							$day = 1;
								if ($nxtmonth == 13){
										$nxtmonth = 1;
										$year ++;
									}
							do_action('lccc_add_to_list',$nxtmonth,$year,$day);
					}
?>
</div>
</div>	
<?php
get_footer();
