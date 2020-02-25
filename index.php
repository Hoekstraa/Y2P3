<?php
require_once './vendor/autoload.php';
require './classes/navbaritem.php';

$loader = new \Twig\Loader\FilesystemLoader('./templates/');
$twig = new \Twig\Environment($loader, [
	'cache' => './compiled/',
]);

$item = new NavbarItem('Klik op mij', 'https://ddg.gg');
echo $twig->render('navbar.html', ['navigation' => [$item, $item]]);
echo $twig->render('body.html', ['title' => 'test', 'content' => 'heleboel content']);
?>
