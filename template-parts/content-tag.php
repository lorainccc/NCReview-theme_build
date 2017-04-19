<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MyLCCC_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" class="small-12 medium-12 large-12 columns category-content">
	<div class="entry-content">
<?php $galleryArray = get_post_gallery_ids($post->ID);
		if (!empty($galleryArray)){
			?>
					<div class="small-12 columns medium-5 large-5 columns left-postimage">	
												<ul class="small-block-grid-2 medium-block-grid-2 large-block-grid-2 mini-photogallery" data-clearing>
												<?php foreach ($galleryArray as $id) { ?>
												<li><a href="<?php echo wp_get_attachment_url( $id ); ?>"><img src="<?php echo wp_get_attachment_url( $id ); ?>"></a></li>		
															<?php } ?>
																	</ul>
					</div>			
					<div class="small-12 columns medium-7 large-7 columns">
							<header class="entry-header">
										<?php the_category();?>
										<?php 	the_title( '<h2 class="entry-title-tag"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
						</header><!-- .entry-header -->
													<p><?php the_excerpt(); ?></p> 
					</div>
		<?php
		}else if(has_post_thumbnail()){
		?>
							<div class="small-12 columns medium-5 large-5 columns left-postimage">	
											<?php the_post_thumbnail(); ?>
					</div>			
					<div class="small-12 columns medium-7 large-7 columns">
							<header class="entry-header">
										<?php the_category();?>
										<?php 	the_title( '<h2 class="entry-title-tag"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
						</header><!-- .entry-header -->
													<p><?php the_excerpt(); ?></p> 
					</div>
		<?php
		}else{
			?>
				<header class="entry-header">
						<?php the_category();?>
						<?php 	the_title( '<h2 class="entry-title-tag"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
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
		<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'mylccc-theme' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->