<?php
/**
 * The file for displaying the portfolio meta.
 *
 * @package     Mark
 * @link        https://themebeans.com/themes/mark
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the content.
 */
if ( post_password_required() ) {
	return;
}

/*
 * Set variables for the content below.
 */
$portfolio_date      = get_post_meta( $post->ID, '_bean_portfolio_date', true );
$portfolio_client    = get_post_meta( $post->ID, '_bean_portfolio_client', true );
$portfolio_role      = get_post_meta( $post->ID, '_bean_portfolio_role', true );
$portfolio_views     = get_post_meta( $post->ID, '_bean_portfolio_views', true );
$portfolio_cats      = get_post_meta( $post->ID, '_bean_portfolio_cats', true );
$portfolio_tags      = get_post_meta( $post->ID, '_bean_portfolio_tags', true );
$portfolio_permalink = get_post_meta( $post->ID, '_bean_portfolio_permalink', true );
$portfolio_url       = get_post_meta( $post->ID, '_bean_portfolio_url', true );
$portfolio_url_clean = str_replace( 'http://', '', $portfolio_url );
$portfolio_url_clean = preg_replace( '/\s+/', '', $portfolio_url_clean );
?>

<div class="project-meta">

	<?php if ( $portfolio_date == 'on' ) { ?>
		<p class="published">
			<span><?php the_time( 'M Y' ); ?></span>
		</p>
	<?php } ?>

	<?php if ( $portfolio_role ) { ?>
		<p class="role">
			<?php esc_html_e( 'Role: ', 'mark' ); ?><span><?php echo esc_html( $portfolio_role ); ?></span>
		</p>
	<?php } ?>

	<?php if ( $portfolio_client ) { ?>
		<p class="client">
			<?php esc_html_e( 'Client: ', 'mark' ); ?>
			<span>
			<?php if ( $portfolio_url ) { ?>
				<a href="<?php echo esc_url( $portfolio_url ); ?>" target="blank"><?php echo esc_html( $portfolio_client ); ?></a>
			<?php
} else {
	echo esc_html( $portfolio_client );
}
			?>
			</span>
		</p>
	<?php } ?>

	<?php if ( $portfolio_url && ! $portfolio_client ) { ?>
		<p class="url">
			<?php esc_html_e( 'URL: ', 'mark' ); ?><span><a href="<?php echo esc_url( $portfolio_url ); ?>" target="blank"><?php echo esc_html( $portfolio_url_clean ); ?></a></span>
		</p>
	<?php } ?>

	<?php if ( $portfolio_views == 'on' ) { ?>
		<p class="views">
			<?php esc_html_e( 'Views: ', 'mark' ); ?><span><?php echo esc_html( mark_getPostViews( get_the_ID() ) ); ?></span>
		</p>
	<?php } ?>

	<?php if ( $portfolio_permalink == 'on' ) { ?>
		<p class="permalink">
			<span>
				<?php
				printf(
					'<a href="%1s" rel="%2$s">#</a>',
					esc_url( get_the_permalink() ),
					esc_html( get_the_title() )
				);
				?>
			</span>
		</p>
	<?php } ?>

</div>

<?php if ( $portfolio_cats == 'on' or $portfolio_tags == 'on' ) { ?>

	<div class="project-taxonomy">
		<p>
			<?php if ( $portfolio_cats == 'on' ) { ?>
				<?php $terms = get_the_terms( $post->ID, 'portfolio_category' ); ?>
				<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
					<?php the_terms( $post->ID, 'portfolio_category', '', '&nbsp;&nbsp;', '&nbsp;&nbsp;' ); ?>
				<?php endif; ?>
			<?php } ?>

			<?php if ( $portfolio_tags == 'on' ) { ?>
					<?php the_terms( $post->ID, 'portfolio_tag', '', '&nbsp;&nbsp;&nbsp;', '&nbsp;&nbsp;' ); ?>
			<?php } ?>
		</p>
	</div>

<?php } ?>
