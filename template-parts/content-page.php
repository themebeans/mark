<?php
/**
 * The template used for displaying page content
 *
 * @package     Mark
 * @link        https://themebeans.com/themes/mark
 */
	?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
		if ( has_post_thumbnail() ) {
			echo '<div class="entry-media">';
				the_post_thumbnail( 'page-feat' );
			echo '</div>'; }

		the_content();

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

		/*
		 * Check to see if the page is using specialized page templates.
		 * If so, load the functions below to get the specialized content.
		 * If you want to override this in a child theme, then include the
		 * functions below (located in the template-tags.php file) and
		 * place them in your child theme's functions.php file.
		 */

		if ( is_page_template( 'template-site-map.php' ) ) {
			mark_site_map();
		}

		if ( is_page_template( 'template-archive.php' ) ) {
			mark_site_archive();
		}
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
