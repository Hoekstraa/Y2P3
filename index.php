<?php
require 'twig.php';

$page_title = "Test!";

$navigation = [
	new NavbarItem("Home", "index.php"),
	new NavbarItem("Hypotheken", "hypotheken.php")
];

// Render page
echo $twig->render('body.html', [
	'title' => $page_title,
	'style' => $STYLE,
   	'navigation' => $navigation,
	'content' => 'Dit is kwaliteitcontent.'
]);
?>
