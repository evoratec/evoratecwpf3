<!DOCTYPE html>

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
	
	<meta name="description" content="Evoratec. Wordpress theme based on Foundation Framework and Foundation WordPress Theme" />
	
	<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
	
	<link rel="apple-touch-icon" href="apple-touch-icon.png" />
	<link rel="icon" type="image/ico" href="favicon.ico">
  
	<!-- Included CSS Files -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/stylesheets/foundation.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/stylesheets/app.css">


	<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_url'); ?>">
	
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/stylesheets/ie.css">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie_evoratec.css">
	<![endif]-->
	
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <script src="<?php bloginfo('template_url'); ?>/javascripts/modernizr.foundation.js"></script>
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<!-- Begin Container -->
	<div class="container">
	
		<?php
		evoratec_header();
		evoratec_before_main();
		?>
		<!-- Main Row -->
		<div id="row-content">		