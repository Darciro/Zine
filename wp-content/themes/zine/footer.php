<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Zine
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<h5>Zine Pirata</h5>
			Criado orgulhosamente com <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'zine' ) ); ?>" class="underlined" target="_blank">WordPress</a><br/>
			desenvolvido por <a href="http://galdar.com.br/" rel="designer" target="_blank" class="underlined">Ricardo Carvalho</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<div id="back_to_top">
	<a href="#"><i class="fa fa-angle-double-up"></i></a>
</div>

<?php wp_footer(); ?>

</body>
</html>
