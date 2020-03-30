<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "Global_functions.php";
// stop php errors 
error_reporting(E_ERROR | E_PARSE);

$IP = GetIP();
$MAC = GetMAC();
CheckIfBanned($IP,$MAC,$Session_banned);

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", true),
	new NavbarItem("Bye", "bye.php"),
	new NavbarItem("Login", "login.php"),
	new NavbarItem("Register", "register.php"),
	//"test"
];

echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
		include("modular/header.php");
		include("modular/body.php");
		include("modular/footer.php");
	echo "</body>";
echo "</html>";
?>
