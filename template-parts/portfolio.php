<?php
/**
 * The template for displaying posts in the standard post format.
 *
 * @package     Mark
 * @link        https://themebeans.com/themes/mark
 */

?>
<div class="projects clearfix">

	<?php
	$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count' );

	$paged = 1;
	if ( get_query_var( 'paged' ) ) {
		$paged = get_query_var( 'paged' );
	}

	if ( get_query_var( 'page' ) ) {
		$paged = get_query_var( 'page' );
	}

	if ( is_tax() ) {

		global $query_string;

		query_posts( "{$query_string}&posts_per_page=-1" );

		if ( have_posts() ) :

			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/portfolio-loop' );

			endwhile;

		endif;

		wp_reset_postdata();

	} else {

		do_action( 'mark_before_portfolio' );

		$args = array(
			'post_type'      => 'portfolio',
			'paged'          => $paged,
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'posts_per_page' => $portfolio_posts_count,
		);

		$wp_query = new WP_Query( apply_filters( 'mark_portfolio_args', $args ) );

		if ( $wp_query->have_posts() ) :

			while ( $wp_query->have_posts() ) :
				$wp_query->the_post();

				get_template_part( 'template-parts/portfolio-loop' );

			endwhile;

		endif;

		wp_reset_postdata();

		do_action( 'mark_after_portfolio' );

	}

	the_posts_pagination(
		array(
			'prev_text'          => esc_html__( 'Previous', 'mark' ),
			'next_text'          => esc_html__( 'Next', 'mark' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'mark' ) . ' </span>',
			'mid_size'           => 0,
		)
	);
	?>
</div><!-- .projects -->

