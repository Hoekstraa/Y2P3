<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "Global_functions.php";
// stop php errors 
error_reporting(E_ERROR | E_PARSE);
//Get variables
$IP = GetIP();
$MAC = GetMAC();
// Check if the user is banned
CheckIfBanned($IP,$MAC,$Session_banned);



if(isset($_SESSION[$Session_name_user]) && !empty($_SESSION[$Session_name_user])) 
{
	$DecryptedUsername = GetUsername($Session_name_user);
	$title = "Home";
	$navigation = [
		new NavbarItem("Ritsema Banken", "index.php"),
		new NavbarItem("Bye", "bye.php"),
		new NavbarItem("Dashboard", "dashboard.php"),
		new NavbarItem($DecryptedUsername, "Account.php"),
		new NavbarItem("Uitloggen", "logout.php"),
	];	
}
else
{
	$title = "Home";
	$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", true),
	new NavbarItem("Bye", "bye.php"),
	new NavbarItem("Login", "login.php"),
	new NavbarItem("Register", "register.php"),
	];
}

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
