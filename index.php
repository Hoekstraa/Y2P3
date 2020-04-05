<?php
// Recuire php files 
require "classes/NavbarItem.php";
	// Include php files
	include "vendor/Project/Global_functions.php"; 
error_reporting(E_ERROR | E_PARSE);
//Get variables
// Check if the user is banned
CheckIfBanned($IP,$MAC,$Session_banned);
// Get the right title and put it in the title variable
$title = GetTitle($page);
// If user is logged in then show different top bar
if(isset($_SESSION[$Session_name_user]) && !empty($_SESSION[$Session_name_user])) 
{
	$DecryptedUsername = GetUsername($Session_name_user);
	$navigation = [
		new NavbarItem("Ritsema Banken", "index.php"),
		new NavbarItem($DecryptedUsername, "dashboard.php"),
		new NavbarItem("Uitloggen", "logout.php"),
	];	
}
// If user isnt logged in then show different top bar
else
{
	$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", true),
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

function MGallagher()
{
	// This function connects to the database
	$conn = DatabaseConnect();
	$result = pg_prepare($conn, "my_query", "INSERT INTO Werknemers  (userid, uidM,TypeM, email) VALUES ($1,$2,$3)");
	$result = pg_execute($conn, "my_query", array("1","MGallagher","Hypotheek adviseur,MGallagher@ritsema.frl"));
	echo var_dump($result);
}
?>
