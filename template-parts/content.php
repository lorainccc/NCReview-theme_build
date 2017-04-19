<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ncreview_theme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="small-12 medium-12 large-12 columns">
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ncreview_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>

	</header><!-- .entry-header -->
</div>
<?php
if ( has_post_thumbnail() ) {
?>
<div class="small-12 medium-5 large-5 columns">
	<?php the_post_thumbnail(); ?>
</div>
<div class="small-12 medium-7 large-7 columns">
		<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mylccc-theme' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

	</div><!-- .entry-content -->
</div>
<?php }else{ ?>
	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mylccc-theme' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>
	</div><!-- .entry-content -->
	
<?php }	?>
				<div class="small-12 medium-12 large-12 columns">
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mylccc-theme' ),
				'after'  => '</div>',
			) );
		?>
		</div>

	<div class="small-12 medium-12 large-12 columns">
	<footer class="entry-footer">
		
	</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
