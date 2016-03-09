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
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'zine' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'zine' ), 'WordPress' ); ?></a><br/>
			<a href="http://galdar.com.br/" rel="designer" target="_blank">Ricardo Carvalho</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
