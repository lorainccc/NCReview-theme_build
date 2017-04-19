<?php
/**
 * Template Name: Email Generator
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<div class="small-12 medium-12 large-12 columns contentdiv">
	<div class="small-12 medium-8 large-8 columns nopadding">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
	<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

</div>
	<div class="small-12 medium-4 large-4 columns">
				<?php get_sidebar(); ?>
	</div>
</div>	
<?php
get_footer();