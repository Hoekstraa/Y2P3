<?php
require_once './vendor/autoload.php';
require './classes/navbaritem.php';

$loader = new \Twig\Loader\FilesystemLoader('./templates/');
$twig = new \Twig\Environment($loader, [
	'cache' => './.cache/',
]);

$pretext_title = "Ritsema Bank | ";
$page_title = "Test!";
$posttext_title = "";

$navigation = [
	new NavbarItem("Home", "index.php"),
	new NavbarItem("Hypotheken", "hypotheken.php")
];

// Render page
echo $twig->render('body.html', [
	'title' => $pretext_title . $page_title . $posttext_title,
	'content' => 'Dit is kwaliteitcontent.',
   	'navigation' => $navigation
]);
?>
