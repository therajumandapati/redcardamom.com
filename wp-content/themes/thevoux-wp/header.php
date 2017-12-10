<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_site_icon(); ?>
	<?php do_action( 'thb_fb_information' ); ?>
	<?php 
		$header_style = ot_get_option('header_style', 'style1');
		$header_fixed_style = ot_get_option('header_fixed_style', 'style1');
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-84341334-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-84341334-1');
	</script>

</head>
<body <?php body_class(); ?> data-themeurl="<?php echo esc_url(get_template_directory_uri()); ?>">

<div id="wrapper">
	<?php get_template_part( 'inc/templates/header/mobile_menu' ); ?>
	
	<!-- Start Content Container -->
	<section id="content-container">
		<!-- Start Content Click Capture -->
		<div class="click-capture"></div>
		<!-- End Content Click Capture -->
		<?php get_template_part( 'inc/templates/header/fixed-'.$header_fixed_style ); ?>
		<?php get_template_part( 'inc/templates/header/'.$header_style ); ?>
		<div role="main" class="cf">