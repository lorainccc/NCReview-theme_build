<?php
/**
 * The template for displaying content in the single.php template
 * @package WordPress
 */
?>

<article id="post-<?php the_ID(); ?>" class="post-content-single">
	<header class="entry-header-single">
				<?php 
	$term_list = wp_get_post_terms($post->ID, 'issue', array("fields" => "all"));
										foreach($term_list as $term_single) {
										echo '<a href="/issue/'.$term_single->slug.'"><h4>'.$term_single->name.'</h4></a>'; //do something here
									}
			the_category();
		?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php
			$value = get_field( "author" );
							if( $value ) { 
    					echo '<h5 class="author-byline">By '.$value.'</h5>';
							} else {
							}		
		?>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ncreview_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="small-12 columns entry-content">
<?php $galleryArray = get_post_gallery_ids($post->ID);
		if (!empty($galleryArray)){
				//Test see IF posts content	is empty	
					if (empty_content($post->post_content)) {
							echo '<div class="small-12 columns medium-12 large-12 columns">';	
										the_content('<p>','</p>'); 
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
													<p><?php the_content(); ?></p> 
					</div>
		<?php
		}
					}else if(has_post_thumbnail()){
		?>
					<div class="small-12 columns medium-5 large-5 columns left-postimage">	
											<?php the_post_thumbnail(); ?>
					</div>			
					<div class="small-12 columns medium-7 large-7 columns">
													<p><?php the_content(); ?></p> 
					</div>
		<?php
		}else{
			?>
				<div class="small-12 medium-12 larg-12 columns">		
						<?php	
											the_content();
						?>
					</div>
					<?php
		}
	?>
		
		
		
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="small-12 columns entry-meta nopadding">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->