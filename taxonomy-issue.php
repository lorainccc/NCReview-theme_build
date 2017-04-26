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
		if ( have_posts() ) : 
			$queried_object = get_queried_object();
			$currentTax = $queried_object->slug;
			if( $currentTax != 'current-issue'){
			echo '<header class="page-header">';
				echo '<h1>Welcome to the North Coast Review</h1>';
					the_archive_title( '<h3 style="text-align: center;">', '</h3>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				echo '<h4 align="center">A Journal of the Creative Writing Institute of<br>
Lorain County Community College,<br>
Bruce Weigl, Director</h4>';
			echo '</header>';// .page-header -->
			}else{
					 //Home Page Code Starts here -->
									$homequery = new WP_Query( array( 'pagename' => 'homepage') );
									if ( $homequery->have_posts() ) : 
											// the loop -->
											 while ( $homequery->have_posts() ) : $homequery->the_post();?>
											<div class="small-12 medium-12 large-12 columns home-page-content">
																	<p><?php the_content(); ?></p>	
											</div>
											<?php endwhile;
									 endif; 
				// Home Page Code Ends here -->
				
			}
			?>

			<?php 	endif; ?>
			<?php	
			if ( have_posts() ) : 
			echo '<div class="small-12 columns issue-entries">';
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'issue-archive' );

			
			endwhile;
echo '</div>';
echo '<div class="small-12 columns nopadding">';
?>
<div id="pagination" class="clearfix">
  <div style="float:left;"><?php previous_posts_link( 'Previous Posts' ); ?></div>
  <div style="float:right;"><?php next_posts_link( 'More Posts', $wp_query->max_num_pages ); ?></div>
</div>			
<?php
echo '</div>';
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

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
