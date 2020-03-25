<?php
require "classes/NavbarItem.php";

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php"),
	new NavbarItem("Bye", "bye.php"),
	new NavbarItem("Login", "login.php"),
	new NavbarItem("Register", "register.php"),
];
$status = "Hypotheek aangevraagd";
$_SESSION['user'] = "Thimo";
$_SESSION['userId'] = 0;

if (isset($_SESSION['user']) && isset($_SESSION['userId'])) {
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
					<a href=\"logout.php\" class=\"item\" id=\"logout\"><b>
						<i class=\"fas fa-sign-out-alt\"></i><br>
						Uitloggen
					</b></div>
					</a>
				</div>
			</div>
		</main>
		";
		include("modular/footer.php");
}
// If user is not logged in, redirect them from dashboard to homepage
else {
	//header("HTTP/1.1 401 Unauthorized");
	header('Location: index.php');
    exit;
}
	echo "</body>";
echo "</html>";
