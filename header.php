<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Mark
 * @link        https://themebeans.com/themes/mark
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<div id="page" class="hfeed site clearfix">

		<div class="mobile-menu-toggle close-toggle"><span></span><span></span><span></span></div>

		<header id="masthead" class="site-header clearfix">

			<div class="site-header--left">
				<?php mark_site_logo(); ?>
			</div>

			<div class="site-header--right">

				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<div class="mobile-menu-toggle"><span></span><span></span><span></span></div>
				<?php endif; ?>

			</div>

		</header

		<div id="content" class="site-content clearfix">
