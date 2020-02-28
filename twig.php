<?php
require_once './vendor/autoload.php';

// Classes
require './classes/navbaritem.php';
//require './classes/script.php';
require './classes/content-block.php';

$loader = new \Twig\Loader\FilesystemLoader('./templates/');
$twig = new \Twig\Environment($loader, [
	'cache' => './.cache/',
]);

// Global variables
$STYLE = "./styles/style.css";
$SCRIPT_FILES = scandir("scripts");
