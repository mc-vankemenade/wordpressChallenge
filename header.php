<!doctype html>
<header>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head() ?>
</header>
<html>
	<body> 
<?php
wp_nav_menu( $args = array(
	'menu'              => 'Main Menu', //name of the menu set in WP to display
	'theme_location'	=>  'header_menu', //use the menu location defined in functions.php
    'fallback_cb'       => false, // dont fallback on standard wp menu if it fails
	));
?>

