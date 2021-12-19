<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title( '' ); ?></title>

	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<link rel="icon" href="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/dist/images/favicon/favicon.png">
	<!--[if IE]>
	<link rel="shortcut icon" href="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?><?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/dist/images/favicon/favicon.ico">
	<![endif]-->

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/dist/images/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/dist/images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/dist/images/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/dist/images/favicon/site.webmanifest">
	<link rel="mask-icon" href="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/dist/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">

	<!-- Preload fonts -->
	<link rel="preload" href="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/dist/fonts/Roboto/Roboto-Regular.ttf" as="font" type="font/ttf" crossorigin>
	<link rel="preload" href="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/dist/fonts/Roboto/Roboto-Bold.ttf" as="font" type="font/ttf" crossorigin>
	<link rel="preload" href="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/dist/fonts/Playfair_Display/PlayfairDisplay-Regular.ttf" as="font" type="font/ttf" crossorigin>

	<?php wp_head(); ?>

</head>

<body id="body" <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<header class="header <?php echo esc_attr( $header_class ); ?>" role="banner" itemscope itemtype="http://schema.org/WPHeader">

	<div class="header-menu">
		<div class="header-menu__container">
			<div class="header-menu__row">

				<div class="header-menu__logo">
					<a href="/">
						<img src="/" alt="Logo" />
					</a>
				</div>

				<button aria-label="Mobile Menu" class="toggleNav">MENU</button>

				<nav class="nav" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<?php
					wp_nav_menu(
						array(
							'menu' => 'Main Menu',
						)
					);
					?>
				</nav>

			</div>
		</div>
	</div>
</header>
