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
	<div class="small-12 medium-8 large-8 columns">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
<?php 	endif; ?>
			
			<?php
$thecategory = single_cat_title( '', false );
$args = array(
	'post_type' => 'post',
	'category_name'=> $thecategory,
	'issue' => 'current-issue',
	);
$query = new WP_Query( $args );
while ( $query->have_posts() ) {
	$query->the_post();
?>	
			<div class="small-12 medium-12 large-12 columns current-issue-post">
							<header class="entry-header">
										<?php 
								$term_list = wp_get_post_terms($post->ID, 'issue', array("fields" => "all"));
										foreach($term_list as $term_single) {
										echo '<a href="/issue/'.$term_single->slug.'"><h2 class="current-issue-tag">'.$term_single->name.'</h2></a>'; //do something here
									}
										?>
										
							</header><!-- .entry-header -->
						<div class="entry-content">
								<?php $galleryArray = get_post_gallery_ids($post->ID);
		if (!empty($galleryArray)){
				//Test see IF posts content	is empty	
					if (empty_content($post->post_content)) {
							echo '<div class="small-12 columns medium-12 large-12 columns">';	
							echo '<header class="entry-header">';
										the_category();
										the_title( '<h2 class="entry-title-tag"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						$value = get_field( "author" );
							if( $value ) { 
    					echo '<h5 class="author-byline">By '.$value.'</h5>';
							} else {
							}					
							echo '</header>';//closes .entry-header
										the_excerpt('<p>','</p>'); 
								echo '</div>';
							echo '<div class="small-12 columns medium-12 large-12 columns">';	
								?>
								<div class="row small-up-2 medium-up-2 large-up-2 mini-photogallery" data-clearing>
												<?php foreach ($galleryArray as $id) { ?>
												<div class="column column-block"><a href="<?php echo wp_get_attachment_url( $id ); ?>"><img src="<?php echo wp_get_attachment_url( $id ); ?>"></a></div>		
															<?php } ?>
								</div>
								<?php
								echo '</div>';
							
					}else{
			?>
					<div class="small-12 columns medium-5 large-5 columns left-postimage">	
												<div class="row small-up-2 medium-up-2 large-up-2 mini-photogallery" data-clearing>
												<?php foreach ($galleryArray as $id) { ?>
												<div class="column column-block"><a href="<?php echo wp_get_attachment_url( $id ); ?>"><img src="<?php echo wp_get_attachment_url( $id ); ?>"></a></div>		
															<?php } ?>
																	</div>
					</div>			
					<div class="small-12 columns medium-7 large-7 columns">
							<header class="entry-header">
										<?php the_category();?>
										<?php 	the_title( '<h2 class="entry-title-tag"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 
								$value = get_field( "author" );
							if( $value ) { 
    					echo '<h5 class="author-byline">By '.$value.'</h5>';
							} else {
							}					
								?>
						</header><!-- .entry-header -->
													<p><?php the_excerpt(); ?></p> 
					</div>
		<?php
		}
					}else if(has_post_thumbnail()){
		?>
							<div class="small-12 columns medium-5 large-5 columns left-postimage">	
											<?php the_post_thumbnail(); ?>
					</div>			
					<div class="small-12 columns medium-7 large-7 columns">
							<header class="entry-header">
										<?php 	the_title( '<h2 class="entry-title-tag"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 
								$value = get_field( "author" );
							if( $value ) { 
    					echo '<h5 class="author-byline">By '.$value.'</h5>';
							} else {
							}					
								?>
						</header><!-- .entry-header -->
													<p><?php the_excerpt(); ?></p> 
					</div>
		<?php
		}else{
			?>
				<header class="entry-header">
						<?php 	the_title( '<h2 class="entry-title-tag"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 
					$value = get_field( "author" );
							if( $value ) { 
    					echo '<h5 class="author-byline">By '.$value.'</h5>';
							} else {
							}					
					?>
				</header><!-- .entry-header -->
				<div class="small-12 medium-12 larg-12 columns">		
						<?php	
											the_excerpt();
						?>
					</div>
					<?php
		}
	?>
						</div><!-- .entry-content -->
			</div>
	<?php 
}

/* Restore original Post Data 
 * NB: Because we are using new WP_Query we aren't stomping on the 
 * original $wp_query and it does not need to be reset with 
 * wp_reset_query(). We just need to set the post data back up with
 * wp_reset_postdata().
 */
wp_reset_postdata();

?>	
		<?php	
	$nonciargs = array(
	'post_type' => 'post',
	'category_name'=> $thecategory,
	'tax_query' => array(
				array(
					'taxonomy' => 'issue',
					'field'    => 'slug',
					'terms'    => 'current-issue',
					'operator' => 'NOT IN'
				),
		),	
	);
$nonciquery = new WP_Query( $nonciargs );	
// The Loop
if ( $nonciquery->have_posts() ) {
	echo '<div class="small-12 columns issue-entries">';
	while ( $nonciquery->have_posts() ) {
		$nonciquery->the_post();
	get_template_part( 'template-parts/content', 'category' );
	}
	echo '</div>';
	echo '<div class="small-12 columns nopadding">';
		?>
			<div id="pagination" class="clearfix">
  <div style="float:left;"><?php previous_posts_link( 'Previous Posts' ); ?></div>
  <div style="float:right;"><?php next_posts_link( 'More Posts', $wp_query->max_num_pages ); ?></div>
			</div>
			
			<?php
	echo '</div>';	
	/* Restore original Post Data */
	wp_reset_postdata();
} else {
	// no posts found
}	
			
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	
	</div>
	<div class="small-12 medium-4 large-4 columns sidebarcontainer">	
<?php
get_sidebar();
?>
	</div>
</div>		
		<?php
get_footer();
