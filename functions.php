<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Mark
 * @link        https://themebeans.com/themes/mark
 */

if ( ! defined( 'MARK_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'MARK_DEBUG', true );
endif;

if ( ! defined( 'MARK_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'MARK_DEBUG' ) || true === MARK_DEBUG ) {
		define( 'MARK_ASSET_SUFFIX', null );
	} else {
		define( 'MARK_ASSET_SUFFIX', '.min' );
	}
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mark_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Mark, use a find and replace
	 * to change 'mark' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mark', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/**
	 * Filter Mark's custom-background support argument.
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 * }
	 */
	add_theme_support(
		'custom-background',
		apply_filters(
			'mark_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 140, 140, true );
	add_image_size( 'mark-page-feat', 540, 9999 );
	add_image_size( 'mark-port-full', 9999, 9999, false );
	add_image_size( 'mark-port-grid', 500, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'mark' ),
			'social'  => esc_html__( 'Social Menu', 'mark' ),
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	* Enable support for Post Formats.
	*
	* See: https://codex.wordpress.org/Post_Formats
	*/
	add_theme_support(
		'post-formats', array(
			'video',
			'image',
		)
	);

	/*
	 * Enable support for the WordPress default Theme Logo
	 * See: https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	/*
	 * Enable support for Customizer Selective Refresh.
	 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, icons, and column width.
	*/
	add_editor_style( array( 'css/editor-style.css' ) );

}
add_action( 'after_setup_theme', 'mark_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mark_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mark_content_width', 644 );
}
add_action( 'after_setup_theme', 'mark_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mark_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Theme Sidebar', 'mark' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Appears at the theme flyout sidebar.', 'mark' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>',
		)
	);
}
add_action( 'widgets_init', 'mark_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mark_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'mark-fonts', mark_fonts_url(), false, '@@pkg.version', 'all' );

	// Load theme styles.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'mark-style', get_parent_theme_file_uri( '/style' . MARK_ASSET_SUFFIX . '.css' ), false, '@@pkg.version' );
		wp_enqueue_style( 'mark-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
	} else {
		wp_enqueue_style( 'mark-style', get_theme_file_uri( '/style' . MARK_ASSET_SUFFIX . '.css' ), false, '@@pkg.version' );
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( SCRIPT_DEBUG || MARK_DEBUG ) {

		// Vendor scripts.
		wp_enqueue_script( 'nprogress', get_template_directory_uri() . '/assets/js/vendors/nprogress.js', array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/js/vendors/fitvids.js', array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'lity', get_template_directory_uri() . '/assets/js/vendors/lity.js', array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'mark-photoswipe', get_template_directory_uri() . '/assets/js/vendors/photoswipe.js', array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'mark-photoswipe-ui', get_template_directory_uri() . '/assets/js/vendors/photoswipe-ui-default.js', array( 'jquery' ), '@@pkg.version', true );

		// Custom scripts.
		wp_enqueue_script( 'mark-global', get_template_directory_uri() . '/assets/js/custom/global.js', array( 'jquery' ), '@@pkg.version', true );

		$localize_handle = 'mark-global'; // Variable for wp_localize_script.

	} else {
		wp_enqueue_script( 'mark-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'mark-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery' ), '@@pkg.version', true );

		$localize_handle = 'mark-custom-min'; // Variable for wp_localize_script for minified javascript.
	}

	wp_localize_script(
		$localize_handle, 'mark_site', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'mark_scripts' );

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function mark_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'mark_javascript_detection', 0 );

if ( ! function_exists( 'mark_fonts_url' ) ) :
	/**
	 * Register custom fonts.
	 */
	function mark_fonts_url() {
		$fonts_url     = '';
		$font_families = array();

		/*
		 * Translators: If there are characters in your language that are not
		 * supported by Playfair Display, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$playfair = esc_html_x( 'on', 'Playfair Display font: on or off', '@@textdomain' );

		/*
		 * Translators: If there are characters in your language that are not
		 * supported by Inconsolata, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$inconsolata = esc_html_x( 'on', 'Inconsolata font: on or off', '@@textdomain' );

		// Heading font.
		if ( 'off' !== $playfair ) {
			$font_families[] = 'Playfair Display:400,400i,700,700i';
		}

		// Body font.
		if ( 'off' !== $inconsolata ) {
			$font_families[] = 'Inconsolata';
		}

		$query_args = array(
			'family' => rawurlencode( implode( '|', array_unique( $font_families ) ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

		return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @param  array|array   $urls           URLs to print for resource hints.
 * @param  string|string $relation_type  The relation type the URLs are printed.
 * @return array|array   $urls           URLs to print for resource hints.
 */
function mark_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'mark-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'mark_resource_hints', 10, 2 );

/**
 * Filter the text prepended to the post title for protected posts.
 * Create your own mark_protected_title_format() to override in a child theme.
 *
 * @link https://developer.wordpress.org/reference/hooks/protected_title_format/
 */
function mark_protected_title_format( $title ) {
	return '%s';
}
add_filter( 'protected_title_format', 'mark_protected_title_format' );

/**
 * Filter the HTML output for the protected post password form.
 * Create your own mark_protected_form() to override in a child theme.
 *
 * @link https://developer.wordpress.org/reference/hooks/the_password_form/
 * @link https://codex.wordpress.org/Using_Password_Protection
 */
function mark_protected_form() {
	global $post;

	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );

	$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
<label for="' . esc_attr( $label ) . '">' . esc_html__( 'Password:', 'mark' ) . ' </label><input name="post_password" placeholder="' . esc_attr__( 'Enter password & press enter...', 'mark' ) . '" type="password" placeholder=""/><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'mark' ) . '" />
</form>
';

	return $o;
}
add_filter( 'the_password_form', 'mark_protected_form' );

if ( ! function_exists( 'mark_getPostViews' ) ) :
	/**
	 * Loop by post view count.
	 * Create your own mark_getPostViews() to override in a child theme.
	 */
	function mark_getPostViews( $postID ) {
		$count_key = 'post_views_count';
		$count     = get_post_meta( $postID, $count_key, true );

		if ( $count == '' ) {
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );
			return '0';
		}

		return $count;
	}
endif;

if ( ! function_exists( 'mark_setPostViews' ) ) :
	/**
	 * Output the view count.
	 * Create your own mark_setPostViews() to override in a child theme.
	 */
	function mark_setPostViews( $postID ) {
		$count_key = 'post_views_count';
		$count     = get_post_meta( $postID, $count_key, true );

		if ( $count == '' ) {
			$count = 0;
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );
		} else {
			$count++;
			update_post_meta( $postID, $count_key, $count );
		}
	}
endif;



if ( ! function_exists( 'mark_load_ajax_content' ) ) :
	/**
	 * Return the post content to the AJAX call.
	 * Create your own mark_load_ajax_content() to override in a child theme.
	 */
	function mark_load_ajax_content() {

		$args = array(
			'post_type'      => 'portfolio',
			'posts_per_page' => '1',
			'p'              => $_POST['post_id'],
		);

		$wp_query = new WP_Query( $args );

		// Start the loop.
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();

			// Retrieve the post content.
			get_template_part( 'template-parts/portfolio-single' );

			// End the loop.
		endwhile;

		wp_reset_query();
		wp_reset_postdata();

		exit;
	}
	add_action( 'wp_ajax_nopriv_load-content', 'mark_load_ajax_content' );
	add_action( 'wp_ajax_load-content', 'mark_load_ajax_content' );
endif;



/**
 * Convert HEX to RGB.
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 * HEX code, empty array otherwise.
 */
function mark_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) == 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) == 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}



if ( ! function_exists( 'mark_comments' ) ) :
	/**
	 * Define custom callback for comment output.
	 * Based strongly on the output from Twenty Sixteen.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
	 * @link https://wordpress.org/themes/twentysixteen/
	 *
	 * Create your own mark_comments() to override in a child theme.
	 */
	function mark_comments( $comment, $args, $depth ) {

		global $post;

		$GLOBALS['comment'] = $comment;
		extract( $args, EXTR_SKIP );

		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}

		$allowed_html_array = array(
			'a'      => array(
				'href'  => array(),
				'title' => array(),
			),
			'b'      => array(
				'class' => array(),
			),
			'span'   => array(
				'class' => array(),
			),
			'br'     => array(),
			'cite'   => array(),
			'em'     => array(),
			'strong' => array(),
		);
		?>

		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">

	<?php if ( 'div' != $args['style'] ) : ?>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
	<?php endif; ?>

		<footer class="comment-meta">

			<div class="comment-author vcard">
				<div class="avatar-wrapper">
					<?php
					if ( $args['avatar_size'] != 0 ) {
						echo get_avatar( $comment, $args['avatar_size'] );}
?>
				</div>

				<div class="comment-metadata">
					<?php printf( wp_kses( __( '<b class="fn">%s</b> <span class="says">says:</span>', 'mark' ), $allowed_html_array ), get_comment_author_link() ); ?>

					<span class="comment-date">
						<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php
						/* translators: 1: date, 2: time */
							printf( wp_kses( __( '%1$s at %2$s', 'mark' ), $allowed_html_array ), get_comment_date(), get_comment_time() );
							?>
							</a>
							<?php
							edit_comment_link( __( 'Edit', 'mark' ), '', '' );
						?>
						<?php
						comment_reply_link(
							array_merge(
								$args, array(
									'add_below' => $add_below,
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
								)
							)
						);
?>

						<?php if ( $comment->comment_approved == '0' ) : ?>
							<span class="comment-awaiting-moderation"><?php esc_html_e( 'Awaiting moderation', 'mark' ); ?></span>
						<?php endif; ?>
						</span>
					</div>

				</div>

			</footer>

			<div class="comment-content">
				<?php comment_text(); ?>
			</div>

		<?php if ( 'div' != $args['style'] ) : ?>
		</article>
	<?php
	endif;
	}
endif;

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function mark_widget_tag_cloud_args( $args ) {
	$args['largest']  = .8;
	$args['smallest'] = .8;
	$args['unit']     = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'mark_widget_tag_cloud_args' );

/**
 * Add the secondary post thumbnail to the portfolio post type.
 */
if ( class_exists( 'MultiPostThumbnails' ) ) {
	new MultiPostThumbnails(
		array(
			'label'     => esc_html__( 'Hover Featured Image', 'mark' ),
			'id'        => 'secondary-image',
			'post_type' => 'portfolio',
		)
	);
}

if ( ! function_exists( 'mark_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function mark_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
		}
	}
	add_action( 'wp_head', 'mark_pingback_header' );
endif;



/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function mark_enqueue_admin_style() {
	wp_register_style( 'mark-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', false, '@@pkg.version' );
	wp_enqueue_style( 'mark-admin-style' );
	wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'mark_enqueue_admin_style' );

/**
 * Enqueue a script in the WordPress admin, for edit.php, post.php and post-new.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function mark_enqueue_admin_script( $hook ) {
	global $pagenow, $wp_customize;

	if ( 'widgets.php' === $pagenow || isset( $wp_customize ) ) {
		wp_enqueue_media();
		wp_enqueue_script( 'widget-image-upload', get_template_directory_uri() . '/assets/js/admin/admin.js', array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
	}

	if ( $hook != 'edit.php' ) {
		wp_enqueue_script( 'meta', get_template_directory_uri() . '/inc/meta/js/meta.js', array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'wp-color-picker' );
	}

}
add_action( 'admin_enqueue_scripts', 'mark_enqueue_admin_script' );

/**
 * TinyMCE callback to insert 'styleselect' into the $buttons array
 */
function mark_mce_formats_button( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'mce_buttons_2', 'mark_mce_formats_button' );

/**
 * TinyMCE Callback to filter the MCE settings
 */
function mark_mce_before_init_insert_formats( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title'   => esc_html__( 'Highlight', 'mark' ),
			'inline'  => 'span',
			'classes' => 'markup--highlight',
			'wrapper' => false,
		),
		array(
			'title'   => esc_html__( 'Button', 'mark' ),
			'inline'  => 'span',
			'classes' => 'button',
			'wrapper' => false,
		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;
}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'mark_mce_before_init_insert_formats' );

/**
 * Post meta additions.
 */
if ( is_admin() ) {
	require get_theme_file_path( '/inc/meta/metaboxes.php' );
	require get_theme_file_path( '/inc/meta/meta-post.php' );
	require get_theme_file_path( '/inc/meta/meta-portfolio.php' );
}

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/sanitization.php' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_theme_file_path( '/inc/template-functions.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_theme_file_path( '/inc/jetpack.php' );

/**
 * SVG icons functions and filters.
 */
require get_theme_file_path( '/inc/icons.php' );

/**
 * Add Widgets.
 */
require get_theme_file_path( '/inc/widgets/widget-flickr.php' );
require get_theme_file_path( '/inc/widgets/widget-portfolio-menu.php' );
require get_theme_file_path( '/inc/widgets/widget-profile.php' );

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Merlin WP.
 */
function themebeans_merlin() {}

/**
 * Disable Dashboard Doc.
 */
function themebeans_guide() {}
