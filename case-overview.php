<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "Global_functions.php";

$array = array("status","datum","aanvrager","aanvraagnummer","bedrag");

// stop php errors 
error_reporting(E_ERROR | E_PARSE);
//Get variables
// Check if the user is banned
CheckIfBanned($IP,$MAC,$Session_banned);

// If user is logged in then show different top bar
if(isset($_SESSION[$Session_name_user]) && !empty($_SESSION[$Session_name_user])) 
{
	$DecryptedUsername = GetUsername($Session_name_user);
	$title = "Overzicht van hypotheek aanvragen";
	$navigation = [
	new NavbarItem("Ritsema Banken", "index.php"),
	new NavbarItem($DecryptedUsername, "Account.php"),
	new NavbarItem("Uitloggen", "logout.php"),
	];	
}
// If user isnt logged in then show different top bar
else
{
	$title = "Overzicht van hypotheek aanvragen";
	$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", true),
	new NavbarItem("Login", "login.php"),
	new NavbarItem("Register", "register.php"),
	];
}

echo '<html lang="nl">';
	include("modular/head.php");
    echo "<body onload=\"ClickOnRow()\">";
        include("modular/navbar.php");
        include("modular/header.php");
        echo "<script src=\"scripts/ClickableRow.js\"></script>";
		echo "
        <main>
        <h1> Lijst van hypotheken aanvragen</h1>
        <table class=\"table\" style=\"border: 2px solid black;\">
            <tr>
                <th>Status</th>
                <th>Datum</th>
                <th>Aanvrager</th>
                <th>Aanvraagnummer</th>
                <th>Bedrag</th>
            </tr>
        ";
            for($i=0;$i<4;$i++){
                echo '<tr>'; 
                 for($i=0;$i<5;$i++){ 
                   echo '<td>'.$array[$i].'</td>'; 
                 } 
                echo '</tr>'; 
           }
        echo "</table>";
        include("modular/footer.php");
	echo "</body>";
echo "</html>";
?>