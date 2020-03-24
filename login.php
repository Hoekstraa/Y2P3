<?php
require "classes/NavbarItem.php";

$title = "Home";
$navigation = [
	new NavbarItem("Hello", "index.php", false),
	new NavbarItem("Bye", "bye.php", true),
	new NavbarItem("Login", "login.php", false),
	new NavbarItem("Register", "register.php", false),
	//"test"
];

echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
		include("modular/header.php");
		include("modular/footer.php");
	echo "</body>";
echo "</html>";
?>
