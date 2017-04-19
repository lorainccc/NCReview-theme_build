<?php
/**
 * Template Name: Calender
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();
?>
<div class="small-12 medium-12 large-12 columns contentdiv">
			<div class="small-12 medium-12 large-12 columns pagediv">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'eventscalendar' );
					endwhile; // End of the loop.
						?>
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
						<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-3">
<li><?php do_action( 'lccc_previous_month',$month, $year, $monthString); ?></li>
<?php 	$lastdate =  $year.'-'.$month.'-'.$day; ?>							
<li style="text-align: center;"><a href="/week/?d=<?php echo $lastdate;?>">Weekly View</a></li>
	<li><?php do_action( 'lccc_next_month',$month, $year, $monthString); ?>
 </li>
</ul>	
					<?php
					$args = "$year-$month-$day";
					do_action('lccc_calendar', $day, $month, $year);
						?> 
					</div>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
</div>	
<?php 
get_footer();
?>