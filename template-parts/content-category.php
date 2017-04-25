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
				//Test see IF posts content	is empty	
					if (empty_content($post->post_content)) {
							echo '<div class="small-12 columns medium-12 large-12 columns">';	
							echo '<header class="entry-header">';
						//Do something if a specific array value exists within a post
							$term_list = wp_get_post_terms($post->ID, 'issue', array("fields" => "all"));
										foreach($term_list as $term_single) {
										echo '<a href="/issue/'.$term_single->slug.'"><h4>'.$term_single->name.'</h4></a>'; //do something here
									}
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
										<?php 	
												//Do something if a specific array value exists within a post
							$term_list = wp_get_post_terms($post->ID, 'issue', array("fields" => "all"));
										foreach($term_list as $term_single) {
										echo '<a href="/issue/'.$term_single->slug.'"><h4>'.$term_single->name.'</h4></a>'; //do something here
									}
						the_title( '<h2 class="entry-title-tag"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
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
										<?php 	
									//Do something if a specific array value exists within a post
							$term_list = wp_get_post_terms($post->ID, 'issue', array("fields" => "all"));
										foreach($term_list as $term_single) {
										echo '<a href="/issue/'.$term_single->slug.'"><h4>'.$term_single->name.'</h4></a>'; //do something here
									}
			the_title( '<h2 class="entry-title-tag"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 
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
						<?php 
									//Do something if a specific array value exists within a post
							$term_list = wp_get_post_terms($post->ID, 'issue', array("fields" => "all"));
										foreach($term_list as $term_single) {
										echo '<a href="/issue/'.$term_single->slug.'"><h4>'.$term_single->name.'</h4></a>'; //do something here
									}
			the_title( '<h2 class="entry-title-tag"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 
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