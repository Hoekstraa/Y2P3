<?php
require_once './vendor/autoload.php';

// Classes
require './classes/navbaritem.php';

$loader = new \Twig\Loader\FilesystemLoader('./templates/');
$twig = new \Twig\Environment($loader, [
	'cache' => './.cache/',
]);

// Global variables
$STYLE = "styles/style.css";
