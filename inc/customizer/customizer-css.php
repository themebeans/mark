<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Mark
 * @link        https://themebeans.com/themes/mark
 */

function mark_customizer_css() {

	$theme_accent_color        = get_theme_mod( 'theme_accent_color', '#00bac7' );
	$background_color          = get_theme_mod( 'background_color', '#ffffff' );
	$sitetitle_color           = get_theme_mod( 'mark_sitetitle_color', '#000000' );
	$sitetitlehover_color      = get_theme_mod( 'mark_sitetitlehover_color', '#00bac7' );
	$navigationicon_color      = get_theme_mod( 'mark_navigationicon_color', '#000000' );
	$navigationiconhover_color = get_theme_mod( 'mark_navigationiconhover_color', '#000000' );
	$project_color             = get_theme_mod( 'mark_project_color', '#f6f6f6' );
	$projecthover_color        = get_theme_mod( 'mark_projecthover_color', '#000000' );
	$project_modal             = get_theme_mod( 'mark_project_modal', '#ffffff' );
	$footertext_color          = get_theme_mod( 'mark_footertext_color', '#969696' );
	$footertexthover_color     = get_theme_mod( 'mark_footertexthover_color', '#00bac7' );
	$footersocial_color        = get_theme_mod( 'mark_footersocial_color', '#000000' );
	$sidebarsocial_color       = get_theme_mod( 'mark_sidebarsocial_color', '#000000' );
	$badge_color               = get_theme_mod( 'mark_badge_color', '#00bac7' );

	$body_typography_color           = get_theme_mod( 'body_typography_color', '#000' );
	$header_typography_color         = get_theme_mod( 'header_typography_color', '#000' );
	$body_secondary_typography_color = get_theme_mod( 'body_secondary_typography_color', '#969696' );
	$body_font_family                = get_theme_mod( 'body_font_family', 'Karla' );
	$body_font_size                  = get_theme_mod( 'body_font_size', '15' );
	$body_line_height                = get_theme_mod( 'body_line_height', '26' );
	$pagetitle_font_family           = get_theme_mod( 'pagetitle_font_family', 'Karla' );
	$pagetitle_font_size             = get_theme_mod( 'pagetitle_font_size', '26' );
	$pagetitle_line_height           = get_theme_mod( 'pagetitle_line_height', '26' );

	$site_logo_width = get_theme_mod( 'custom_logo_max_width', '40' );

	$theme_accent_color_rgb = mark_hex2rgb( $theme_accent_color );
	if ( empty( $theme_accent_color_rgb ) ) {
		return;
	}
	$rgb_10_opacity = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.075)', $theme_accent_color_rgb );

	$css =
	'
	body {
		background:#' . esc_attr( $background_color ) . ' !important;
	}

	body .site-header,
	body .site-footer {
		background:#' . esc_attr( $background_color ) . ';
	}

	body .custom-logo-link img.custom-logo {
		width: ' . esc_attr( $site_logo_width ) . 'px;
	}

body h1.site-logo-link {
		color: ' . esc_attr( $sitetitle_color ) . ' ;
	}

	body h1.site-logo-link a:hover {
		color: ' . esc_attr( $sitetitlehover_color ) . '!important;
	}

	body .button--close span,
	body .mobile-menu-toggle span {
		background:' . esc_attr( $navigationicon_color ) . ';
	}

	@media screen and (min-width: 940px) {
		body.nav-open .close-toggle span {
			background:' . esc_attr( $navigationicon_color ) . ';
		}
	}

	body .button--close:hover span,
	body .mobile-menu-toggle:hover span {
		background-color:' . esc_attr( $navigationiconhover_color ) . ';
	}

	body .project--color,
	body .projects .pagination a.next {
		background:' . esc_attr( $project_color ) . ';
	}

	body .project--color-hover,
	body .projects .pagination a.next:hover {
		background:' . esc_attr( $projecthover_color ) . ';
	}

	body .site-footer {
		color:' . esc_attr( $footertext_color ) . ';
	}

	body #colophon.site-footer span:not(.badge--hire-me) a:hover {
		color:' . esc_attr( $footertexthover_color ) . ';
	}

	body .site-footer .social-navigation a {
		background:' . esc_attr( $footersocial_color ) . ';
	}

	body .badge--hire-me a {
		border-color:' . esc_attr( $badge_color ) . ';
		color:' . esc_attr( $badge_color ) . ';
	}

	body .badge--hire-me a:hover {
		background:' . esc_attr( $badge_color ) . ';
	}

	body #content a,
	body .widget-area a,
	body #modal-content a {
		color:' . esc_attr( $theme_accent_color ) . ';
	}

	body #nprogress .peg {
		box-shadow: 0 0 10px ' . esc_attr( $theme_accent_color ) . ', 0 0 5px ' . esc_attr( $theme_accent_color ) . ';
	}

	body button,
	body .button,
	body button[disabled]:hover,
	body button[disabled]:focus,
	body input[type="button"],
	body input[type="button"][disabled]:hover,
	body input[type="button"][disabled]:focus,
	body input[type="reset"],
	body input[type="reset"][disabled]:hover,
	body input[type="reset"][disabled]:focus,
	body input[type="submit"],
	body input[type="submit"][disabled]:hover,
	body input[type="submit"][disabled]:focus {
		background-color:' . esc_attr( $theme_accent_color ) . ';
	}

	article .markup--highlight {
		background-image: linear-gradient(to bottom, ' . esc_attr( $rgb_10_opacity ) . ', ' . esc_attr( $rgb_10_opacity ) . ');
	}

	body,
	body.single,
	body.page,
	body.home,
	body.blog,
	body button,
	body input,
	body select,
	body textarea,
	p a:hover,
	body #content a:hover,
	body .widget-area a:hover,
	body #modal-content a:hover {
		color: ' . esc_attr( $body_typography_color ) . ';
	}

	body blockquote {
		border-color: ' . esc_attr( $body_typography_color ) . ';
	}

	body .tagcloud > a,
	body .tagcloud > a:hover,
	body .post-meta a:hover,
	body .project-meta a:hover {
		color: ' . esc_attr( $body_typography_color ) . '!important;
	}


	body .post-meta a,
	body .post-meta span,
	body .post-meta span:before,
	body .project-meta p,
	body .project-meta p:before,
	body .widget_bean_tweets a.twitter-time-stamp  {
		color: ' . esc_attr( $body_secondary_typography_color ) . '!important;
	}

	body blockquote cite,
	body blockquote small,
	body h6.widget-title {
		color: ' . esc_attr( $body_secondary_typography_color ) . ';
	}

	body h1,
	body h2,
	body h3,
	body h4,
	body h5,
	body .main-navigation a {
		color: ' . esc_attr( $header_typography_color ) . ';
	}

	body .sidebar .social-navigation a {
		background:' . esc_attr( $sidebarsocial_color ) . ';
	}

	body .modal-content--show {
		background:' . esc_attr( $project_modal ) . ';
	}

	a:hover,
	a:focus,
	body .site-footer a:hover,
	body .header .project-filter a:hover,
	body .header .main-navigation a:hover,
	body .header .project-filter a.active,
	.logo_text:hover,
	.current-menu-item a,
	.page-links a span:not(.page-links-title):hover,
	.page-links span:not(.page-links-title) { color:' . esc_attr( $theme_accent_color ) . '; }

	.cats,
	h1 a:hover,
	.logo a h1:hover,
	.entry-meta a:hover,
	.header-alt a:hover,
	.post-after a:hover,
	.bean-tabs > li.active > a,
	.bean-panel-title > a:hover,
	.archives-list ul li a:hover,
	.bean-tabs > li.active > a:hover,
	.bean-tabs > li.active > a:focus,
	.bean-pricing-table .pricing-column li.info:hover {
		color:' . esc_attr( $theme_accent_color ) . '!important;
	}

	button:hover,
	button:focus,
	.button:hover,
	.button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus {
		border-color:' . esc_attr( $theme_accent_color ) . ';
	}

	button:hover,
	button:focus,
	.button:hover,
	.button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.bean-btn,
	nav a h1:hover,
	div.jp-play-bar,
	#nprogress .bar,
	div.jp-volume-bar-value,
	.bean-direction-nav a:hover,
	.bean-pricing-table .table-mast,
	.entry-categories a:hover,
	.bean-contact-form .bar:before {
		background-color:' . esc_attr( $theme_accent_color ) . ';
	}

	.bean-btn { border: 1px solid ' . esc_attr( $theme_accent_color ) . '!important; }
	.bean-quote { background-color:' . esc_attr( $theme_accent_color ) . '!important; }
	';

	return wp_strip_all_tags( $css );
}

/**
 * Enqueue the Customizer styles on the front-end.
 */
function mark_customizer_styles() {
	wp_add_inline_style( 'mark-style', mark_customizer_css() );
}
add_action( 'wp_enqueue_scripts', 'mark_customizer_styles' );
