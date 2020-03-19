<?php
require "classes/NavbarItem.php";

$title = "Home";
$navigation = [
	new NavbarItem("Hello", "index.php"),
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
