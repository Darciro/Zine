<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Zine
 */

if ( ! function_exists( 'zine_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function zine_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'zine' ),
		'<i class="fa fa-calendar"></i><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'zine' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span> <span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'zine' ) );
		if ( $categories_list && zine_categorized_blog() ) {
			printf( '<span class="cat-links"><i class="fa fa-folder-o"></i>' . esc_html__( '%1$s', 'zine' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

 	}

}
endif;

if ( ! function_exists( 'zine_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function zine_entry_footer() {
		if ( 'post' === get_post_type() ):
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'zine' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fa fa-tags"></i>' . esc_html__( '%1$s', 'zine' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		} ?>
		<div class="quick-share">
			<a class="quick-share--toggler" href="#"><i class="fa fa-share-alt"></i></a>
			<ul>
				<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<li><a href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			</ul>
		</div>
		<?php endif;

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		disqus_count('calvinx');
		echo '<span class="comments-link--zine">';
		// comments_popup_link( esc_html__( 'Leave a comment', 'zine' ), esc_html__( '1 Comment', 'zine' ), esc_html__( '% Comments', 'zine' ) );
		// comments_popup_link( '<i class="fa fa-comment-o"></i>', '<i class="fa fa-comment"></i>', '<i class="fa fa-comment"></i>' );
		echo '<a href="'. get_the_permalink() .'#disqus_thread"><i class="fa fa-comment"></i></a>';
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			// esc_html__( 'Edit %s', 'zine' ),
			'<i class="fa fa-pencil"></i>',
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function zine_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'zine_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'zine_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so zine_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so zine_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in zine_categorized_blog.
 */
function zine_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'zine_categories' );
}
add_action( 'edit_category', 'zine_category_transient_flusher' );
add_action( 'save_post',     'zine_category_transient_flusher' );
