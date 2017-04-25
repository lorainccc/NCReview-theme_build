<?php
/**
 * The template for displaying content in the single.php template
 * @package WordPress
 */
?>

<article id="post-<?php the_ID(); ?>" class="post-content">
	<header class="entry-header">
				<?php 
	$term_list = wp_get_post_terms($post->ID, 'issue', array("fields" => "all"));
										foreach($term_list as $term_single) {
										echo '<a href="/issue/'.$term_single->slug.'"><h4>'.$term_single->name.'</h4></a>'; //do something here
									} ?>
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

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->