<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MyLCCC_Theme
 */

?>

	</div><!-- #content -->
</div>
	<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="row footerrow">
						<div class="small-12 medium-2 large-2 columns">
						<h2><a href="#">	<img src="<?php  echo get_theme_mod( 'custom_logo' ); ?>"alt="mobile-Logo" /></a></h2>
						</div>
						<div class="small-12 medium-10 large-10 columns footer-copyright">
								<p>&copy; <?php echo date("Y") ?> North Coast Review</p>
						</div>
			</div>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
</div>
</body>
</html>
