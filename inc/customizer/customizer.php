<?php
/**
 * Mark Customizer functionality
 *
 * @package     Mark
 * @link        https://themebeans.com/themes/mark
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function mark_customize_register( $wp_customize ) {

	/**
	 * Remove unnecessary controls.
	 */
	$wp_customize->remove_section( 'background_image' );

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . 'class-themebeans-range-control.php' );

	/**
	 * Top-Level Customizer sections and panels.
	 */

	// Add the Theme Options top-level panel.
	$wp_customize->add_panel(
		'mark_theme_options', array(
			'title'       => esc_html__( 'Theme Options', 'mark' ),
			'description' => esc_html__( 'Customize various options throughout the theme with the settings within this panel.', 'mark' ),
			'priority'    => 30,
		)
	);

	/**
	 * Add the site logo max-width options to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => '40',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => '40',
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Max Width', '@@textdomain' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 8,
				'input_attrs' => array(
					'min'  => 30,
					'max'  => 100,
					'step' => 2,
				),
			)
		)
	);

	/**
	 * Theme Customizer Sections.
	 * For more information on Theme Customizer settings and default sections:
	 *
	 * @see https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */

	/**
	 * Colors.
	 */
	$wp_customize->add_setting(
		'body_typography_color', array(
			'default'           => '#000',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'body_typography_color', array(
				'label'   => esc_html__( 'Text Color', 'mark' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'body_secondary_typography_color', array(
			'default'           => '#969696',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'body_secondary_typography_color', array(
				'label'   => esc_html__( 'Secondary Text Color', 'mark' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'header_typography_color', array(
			'default'           => '#000',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'header_typography_color', array(
				'label'   => esc_html__( 'Heading Color', 'mark' ),
				'section' => 'colors',
			)
		)
	);

	$wp_customize->add_setting(
		'theme_accent_color', array(
			'default'           => '#00bac7',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'theme_accent_color', array(
				'label'   => esc_html__( 'Accent Color', 'mark' ),
				'section' => 'colors',
			)
		)
	);

	/**
	 * Add the header section.
	 */
	$wp_customize->add_section(
		'mark_pro_header', array(
			'title' => esc_html__( 'Header', 'mark' ),
			'panel' => 'mark_theme_options',
		)
	);

			$wp_customize->add_setting(
				'nav_social_icons', array(
					'default'           => false,
					'sanitize_callback' => 'mark_sanitize_checkbox',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'nav_social_icons', array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Navigation Social Icons', 'mark' ),
					'description' => esc_html__( 'Display the social icons below the site navigation in the sidebar flyout.', 'mark' ),
					'section'     => 'mark_pro_header',
				)
			);

			$wp_customize->add_setting(
				'mark_sitetitle_color', array(
					'default'           => '#000000',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_sitetitle_color', array(
						'label'   => esc_html__( 'Site Title', 'mark' ),
						'section' => 'mark_pro_header',
					)
				)
			);

			// PRO: Add main accent color setting and control.
			$wp_customize->add_setting(
				'mark_sitetitlehover_color', array(
					'default'           => '#00bac7',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_sitetitlehover_color', array(
						'label'   => esc_html__( 'Site Title Hover', 'mark' ),
						'section' => 'mark_pro_header',
					)
				)
			);

			// PRO: Add main accent color setting and control.
			$wp_customize->add_setting(
				'mark_navigationicon_color', array(
					'default'           => '#000000',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_navigationicon_color', array(
						'label'   => esc_html__( 'Navigation Icon', 'mark' ),
						'section' => 'mark_pro_header',
					)
				)
			);

			// PRO: Add main accent color setting and control.
			$wp_customize->add_setting(
				'mark_navigationiconhover_color', array(
					'default'           => '#000000',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_navigationiconhover_color', array(
						'label'   => esc_html__( 'Navigation Icon Hover', 'mark' ),
						'section' => 'mark_pro_header',
					)
				)
			);

			// PRO: Add main accent color setting and control.
			$wp_customize->add_setting(
				'mark_sidebarsocial_color', array(
					'default'           => '#000000',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_sidebarsocial_color', array(
						'label'   => esc_html__( 'Social Icons', 'mark' ),
						'section' => 'mark_pro_header',
					)
				)
			);

	/**
	 * Add the portfolio section.
	 */
	$wp_customize->add_section(
		'mark_pro_portfolio', array(
			'title' => esc_html__( 'Portfolio', 'mark' ),
			'panel' => 'mark_theme_options',
		)
	);

			$wp_customize->add_setting(
				'mark_portfolio_modal', array(
					'default'           => false,
					'sanitize_callback' => 'mark_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'mark_portfolio_modal', array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Single Portfolio Modal', 'mark' ),
					'description' => esc_html__( 'Acrtive the portfolio modal, instead of linking to individual portfolio posts.', 'mark' ),
					'section'     => 'mark_pro_portfolio',
				)
			);

			$wp_customize->add_setting(
				'portfolio_loop', array(
					'default'           => false,
					'sanitize_callback' => 'mark_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'portfolio_loop', array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Single Portfolio Loop', 'mark' ),
					'description' => esc_html__( 'Activate the portfolio loop on all portfolio posts, which contains a masonry grid of all posts.', 'mark' ),
					'section'     => 'mark_pro_portfolio',
				)
			);

			$wp_customize->add_setting(
				'portfolio_loop_pages', array(
					'default'           => false,
					'sanitize_callback' => 'mark_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'portfolio_loop_pages', array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Single Page Loop', 'mark' ),
					'description' => esc_html__( 'Activate the portfolio loop on all standard WordPress pages, which contains a masonry grid of all posts.', 'mark' ),
					'section'     => 'mark_pro_portfolio',
				)
			);

			$wp_customize->add_setting(
				'portfolio_posts_count', array(
					'default'           => '',
					'sanitize_callback' => 'mark_sanitize_number_intval',
				)
			);

			$wp_customize->add_control(
				'portfolio_posts_count', array(
					'type'        => 'number',
					'label'       => esc_html__( 'Portfolio Count', 'mark' ),
					'description' => esc_html__( 'Set the number of posts to display on the portfolio template. Use "-1" to load them all.', 'mark' ),
					'section'     => 'mark_pro_portfolio',
				)
			);

			$wp_customize->add_setting(
				'mark_project_color', array(
					'default'           => '#f6f6f6',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_project_color', array(
						'label'   => esc_html__( 'Project', 'mark' ),
						'section' => 'mark_pro_portfolio',
					)
				)
			);

			$wp_customize->add_setting(
				'mark_projecthover_color', array(
					'default'           => '#f6f6f6',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_projecthover_color', array(
						'label'   => esc_html__( 'Project Hover', 'mark' ),
						'section' => 'mark_pro_portfolio',
					)
				)
			);

			$wp_customize->add_setting(
				'mark_project_modal', array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_project_modal', array(
						'label'   => esc_html__( 'Project Modal', 'mark' ),
						'section' => 'mark_pro_portfolio',
					)
				)
			);

	/**
	 * Add the footer section.
	 */
	$wp_customize->add_section(
		'mark_theme_options_footer', array(
			'title' => esc_html__( 'Footer', 'mark' ),
			'panel' => 'mark_theme_options',
		)
	);

			// Add the powered by Mark setting and control.
			$wp_customize->add_setting(
				'powered_by_mark', array(
					'default'           => true,
					'sanitize_callback' => 'mark_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'powered_by_mark', array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Powered by Mark', 'mark' ),
					'section' => 'mark_theme_options_footer',
				)
			);

			// Add the powered by WordPress setting and control.
			$wp_customize->add_setting(
				'powered_by_wordpress', array(
					'default'           => false,
					'sanitize_callback' => 'mark_sanitize_checkbox',
				)
			);

			$wp_customize->add_control(
				'powered_by_wordpress', array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'A WordPress run site. Nice.', 'mark' ),
					'section' => 'mark_theme_options_footer',
				)
			);

			// Add the hire me badge selector setting and control.
			$wp_customize->add_setting(
				'mark_hireme_badge', array(
					'default'           => false,
					'sanitize_callback' => 'mark_sanitize_checkbox',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'mark_hireme_badge', array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Footer "Hire Me" Badge', 'mark' ),
					'section' => 'mark_theme_options_footer',
				)
			);

			// Add the hire me badge text selector setting and control.
			$wp_customize->add_setting(
				'mark_hireme_badge_text', array(
					'sanitize_callback' => 'mark_sanitize_nohtml',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'mark_hireme_badge_text', array(
					'type'        => 'text',
					'label'       => esc_html__( 'Text', 'mark' ),
					'description' => esc_html__( 'Text:', 'mark' ),
					'section'     => 'mark_theme_options_footer',
				)
			);

			// Add the hire me badge URL selector setting and control.
			$wp_customize->add_setting(
				'mark_hireme_badge_url', array(
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'mark_hireme_badge_url', array(
					'type'        => 'text',
					'label'       => esc_html__( 'URL', 'mark' ),
					'description' => esc_html__( 'URL:', 'mark' ),
					'section'     => 'mark_theme_options_footer',
				)
			);

			// Add the powered by WordPress setting and control.
			$wp_customize->add_setting(
				'mark_hireme_badge_shake', array(
					'default'           => false,
					'sanitize_callback' => 'mark_sanitize_checkbox',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'mark_hireme_badge_shake', array(
					'type'    => 'checkbox',
					'label'   => esc_html__( 'Shake Animation', 'mark' ),
					'section' => 'mark_theme_options_footer',
				)
			);

			// PRO: Add main accent color setting and control.
			$wp_customize->add_setting(
				'mark_footertext_color', array(
					'default'           => '#969696',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_footertext_color', array(
						'label'   => esc_html__( 'Footer Text', 'mark' ),
						'section' => 'mark_theme_options_footer',
					)
				)
			);

			// PRO: Add main accent color setting and control.
			$wp_customize->add_setting(
				'mark_footertexthover_color', array(
					'default'           => '#00bac7',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_footertexthover_color', array(
						'label'   => esc_html__( 'Footer Text Hover', 'mark' ),
						'section' => 'mark_theme_options_footer',
					)
				)
			);

			// PRO: Add main accent color setting and control.
			$wp_customize->add_setting(
				'mark_footersocial_color', array(
					'default'           => '#000000',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_footersocial_color', array(
						'label'   => esc_html__( 'Social Icons', 'mark' ),
						'section' => 'mark_theme_options_footer',
					)
				)
			);

			// PRO: Add main accent color setting and control.
			$wp_customize->add_setting(
				'mark_badge_color', array(
					'default'           => '#00bac7',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 'mark_badge_color', array(
						'label'   => esc_html__( 'Hire Me Badge', 'mark' ),
						'section' => 'mark_theme_options_footer',
					)
				)
			);

	/**
	 * Set transports for the Customizer.
	 */

	$wp_customize->get_setting( 'blogname' )->transport             = 'postMessage';
	$wp_customize->get_setting( 'powered_by_mark' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'powered_by_wordpress' )->transport = 'postMessage';

}

add_action( 'customize_register', 'mark_customize_register', 11 );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function mark_customize_preview_js() {
	wp_enqueue_script( 'mark-customize-preview', get_theme_file_uri( '/assets/js/admin/customize-preview' . MARK_ASSET_SUFFIX . '.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'mark_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function mark_customize_controls_js() {
	wp_enqueue_script( 'mark-customize-controls', get_theme_file_uri( '/assets/js/admin/customize-controls' . MARK_ASSET_SUFFIX . '.js' ), array( 'customize-controls' ), '@@pkg.version', true );
}
add_action( 'customize_controls_enqueue_scripts', 'mark_customize_controls_js' );
