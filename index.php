<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MyLCCC_Theme
 */
get_header(); ?>
<div class="small-12 medium-12 large-12 columns contentdiv">
	<div class="small-12 medium-8 large-8 columns content-container">
					<div id="primary" class="content-area">
								<main id="main" class="site-main" role="main">
									<!-- Home Page Code Starts here -->
									<?php $homequery = new WP_Query( array( 'pagename' => 'homepage') );?>
									<?php if ( $homequery->have_posts() ) : ?>
											<!-- pagination here -->
											<!-- the loop -->
											<?php while ( $homequery->have_posts() ) : $homequery->the_post();?>
											<div class="small-12 medium-12 large-12 columns home-page-content">
																	<p><?php the_content(); ?></p>	
											</div>
											<?php endwhile;?>
									<?php endif; ?>
									<!-- Home Page Code Ends here -->
<?php				
			$active_categories =get_categories( array(
    'order'   => 'ASC',
				'exclude'    => array( 1 ),
) );
foreach( $active_categories as $category ) {
echo 	'<div class="small-12 medium-12 large-12 columns '.$category->slug.'">';
					$apquery = new WP_Query( array( 'category_name' => $category->slug, 'tag' => 'current-issue', ) );
					if ( $apquery->have_posts() ) : 
								 while ( $apquery->have_posts() ) : $apquery->the_post();
									$galleryArray = get_post_gallery_ids($post->ID);
									//Test see IF posts with Galleries
									if (!empty($galleryArray)){
								//Test see IF posts content	is empty	
											if (empty_content($post->post_content)) {
												?>
															<div class="small-12 columns medium-12 large-12 columns">	
																	<?php the_category(); ?>
														<?php 	the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
														<p><?php the_excerpt(); ?></p> 
														</div>
													<div class="small-12 columns medium-12 large-12 columns">	
															<div class="row small-up-2 medium-up-2 large-up-2 mini-photogallery" data-clearing>
															<?php foreach ($galleryArray as $id) { ?>
															<div class="column column-block"><a href="<?php echo wp_get_attachment_url( $id ); ?>"><img src="<?php echo wp_get_attachment_url( $id ); ?>"></a></div>		
															<?php } ?>
													</div>		
												</div>
											<?php	}else{ 
											//This is run when posts has content	and a gallery			
														?>
													<div class="small-12 columns medium-5 large-5 columns left-postimage">	
												<div class="row small-up-2 medium-up-2 large-up-2 mini-photogallery" data-clearing>
															<?php foreach ($galleryArray as $id) { ?>
															<div class="column column-block"><a href="<?php echo wp_get_attachment_url( $id ); ?>"><img src="<?php echo wp_get_attachment_url( $id ); ?>"></a></div>		
															<?php } ?>
													</div>
													</div>
													<div class="small-12 columns medium-7 large-7 columns">
														<?php the_category(); ?>
														<?php 	the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
														<p><?php the_excerpt(); ?></p> 
										</div>
										<?php
											}
										//closes the section that handles posts with Galleries
										//Starts section for when the post has featured image but No Gallery
										//Test to see if post HAS featured image
										} elseif ( has_post_thumbnail() ) {
										?>
										<div class="small-12 columns medium-5 large-5 columns left-postimage">
														<?php the_post_thumbnail();?> 
										</div>
										<div class="small-12 columns medium-7 large-7 columns">
														<?php the_category(); ?>
														<?php 	the_title( '<h3><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
														<p><?php the_excerpt(); ?></p> 
										</div>
									<?php
									}else{
									//Else if posts doesnt have a featured image and does not have a gallery do this	
									?>	
										<div class="small-12 columns medium-12 large-12 columns">				
												<?php the_category(); ?>
												<?php 	the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
											<p><?php the_excerpt(); ?></p>
										</div>
									<?php }						
									endwhile;
					endif;
		
		echo	'<div class="small-12 columns medium-12 large-12 columns see-more-link">';	
		echo	'<a href="category/'.$category->slug.'/" class="button expand">See More '.$category->name.'</a>';							
		echo '</div>';		
echo '</div>';
		}
?>
									
								</main><!-- #main -->
					</div><!-- #primary -->
	</div>
	<div class="small-12 medium-4 large-4 columns sidebarcontainer">
				<?php get_sidebar(); ?>
	</div>
</div>	
<?php
get_footer();
?>