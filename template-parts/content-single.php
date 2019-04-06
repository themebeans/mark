<?php
/**
 * The template part for displaying single posts
 *
 * @package     Mark
 * @link        https://themebeans.com/themes/mark
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

	the_title( '<h1 class="entry-title">', '</h1>' );

	mark_entry_meta();

	mark_post_thumbnail();

	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'mark' ) );
	}
	?>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content(
				sprintf(
					wp_kses( __( 'Continue reading %s', 'mark' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				)
			);

			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'mark' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'mark' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'mark' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
