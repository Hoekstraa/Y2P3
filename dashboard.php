<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "Global_functions.php";
// Set global variable
$DecryptedUsername = GetUsername($Session_name_user);

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php"),
	new NavbarItem("Bye", "bye.php"),
	new NavbarItem($DecryptedUsername, "Account.php"),
	new NavbarItem("Uitloggen", "register.php"),
];
$status = "Hypotheek aangevraagd";

echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
		include("modular/header.php");
		echo "
			<main>
			<div class=\"login\">
				<h1>Dashboard</h1>
				<p>Voer uw gegevens in om toegang te verkrijgen tot uw account.</p>
				<div class=\"status\">" . $status . "</div>
				<div class=\"dashboard\">
					<a href=\"hypotheek.php\" class=\"item\" id=\"hypotheek\">
					<b>
						<i class=\"fas fa-money-check-alt\"></i>
						<br>
						Hypotheek aanvragen
					</b>
					</a>
					<a href=\"contact.php\" class=\"item\" id=\"contact\">
					<b>
						<i class=\"fas fa-address-card\"></i>
						<br>
						Contact opnemen
					</b>
					</a>
					<a href=\"logout.php\" class=\"item\" id=\"logout\">
					<b>
						<i class=\"fas fa-sign-out-alt\"></i><br>
						Uitloggen
					</b></div>
					</a>
				</div>
			</div>
		</main>
		";
		include("modular/footer.php");
	echo "</body>";
echo "</html>";
