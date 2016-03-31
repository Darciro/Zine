<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('zine-posts'); ?>>
	<?php if ( has_post_format( 'video' )) { ?>
	<div class="entry-video-wrapper">
		<?php the_field('link_do_video'); ?>
	</div>
	<?php } ?>

	<?php if ( has_post_format( 'quote' )) { ?>
		<div class="entry-quote">
			<blockquote>
				<h2 class="entry-title entry-title--quoted"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_field('citacao_texto'); ?></a></h2>
				<footer>— <?php the_field('citacao_autor'); ?></footer>
			</blockquote>
		</div>
	<?php } ?>

	<?php if ( !has_post_format() ) { ?>
	<div class="entry-thumb">
		<?php if ( has_post_thumbnail() ) { ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		<?php } ?>
	</div>
	<?php } ?>

	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php zine_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php if ( !has_post_format( 'quote' )):
			if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		endif; ?>
	</header><!-- .entry-header -->

	<?php if ( !has_post_format( 'quote' )): ?>
	<div class="entry-content">
		<?php
			if( is_home() ):
			the_excerpt();

			else:

			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'zine' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			endif;

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zine' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<?php if( !is_single() ): ?>
	<footer class="entry-footer">
		<?php zine_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->

<?php

if( is_single() ){
	require get_template_directory() . '/inc/share-ruler.php';
}

?>