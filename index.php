<?php
require "classes/NavbarItem.php";

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", true),
	new NavbarItem("Bye", "bye.php", false),
	new NavbarItem("Login", "login.php", false),
	new NavbarItem("Register", "register.php", false)
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
