<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #page div and all content after
 *
 * @package     Mark
 * @link        https://themebeans.com/themes/mark
 */
?>

		</div><!-- .site-content -->

		<?php get_sidebar(); ?>

		<?php
		/**
		 * Display the portfolio post modal on the portfolio template and portfolio index.
		 * We're onlying displaying the modal if the option is selected in the Customizer.
		 */
		get_template_part( 'template-parts/portfolio-modal' );
		?>

		<footer id="colophon" class="site-footer">

			<div class="site-info">

				<span class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?></a>
				</span>

				<?php if ( get_theme_mod( 'powered_by_mark' ) || is_customize_preview() ) : ?>
					<?php $visibility = ( false == get_theme_mod( 'powered_by_mark' ) ) ? 'hidden' : ''; ?>
					<span class="site-theme <?php echo esc_attr( $visibility ); ?>">
						<a href="https://themebeans.com/themes/mark/" class="powered-by-mark"><?php printf( esc_html__( '%1$s by %2$s', 'mark' ), 'Mark', 'ThemeBeans' ); ?></a>
					</span>
				<?php endif; ?>

				<?php if ( get_theme_mod( 'powered_by_wordpress' ) || is_customize_preview() ) : ?>
					<?php $visibility = ( false == get_theme_mod( 'powered_by_wordpress' ) ) ? 'hidden' : ''; ?>
					<span class="powered-by <?php echo esc_attr( $visibility ); ?>">
						<a href="https://wordpress.org/" class="powered-by-wordpress"><?php printf( esc_html__( 'Powered by %s', 'mark' ), 'WordPress' ); ?></a>
					</span>
				<?php endif; ?>

				<?php
				/**
				 * Display the portfolio post modal on the portfolio template and portfolio index.
				 * We're onlying displaying the modal if the option is selected in the Customizer.
				 */
				if ( get_theme_mod( 'mark_hireme_badge' ) || is_customize_preview() ) :
					/*
                     * If selected in the Customizer.
                     * The visibility classes area used to show/hide the elements in the Customizer live preview.
                     */
					$visibility = ( false == get_theme_mod( 'mark_hireme_badge' ) ) ? 'hidden' : '';

					printf(
						'<span class="badge--hire-me %1s"><a href="%2s">%3s</a></span>',
						esc_attr( $visibility ),
						esc_url( get_theme_mod( 'mark_hireme_badge_url' ) ),
						esc_html( get_theme_mod( 'mark_hireme_badge_text' ) )
					);
				endif;
				?>

			</div>

			<?php mark_social_navigation(); ?>

		</footer><!-- .site-footer -->

	</div><!-- .site -->

	<?php wp_footer(); ?>

	</body>
</html>
