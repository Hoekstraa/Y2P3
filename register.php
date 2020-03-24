<?php
require "classes/NavbarItem.php";

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", false),
	new NavbarItem("Bye", "bye.php", false),
	new NavbarItem("Login", "login.php", false),
	new NavbarItem("Register", "register.php", true),
	//"test"
];

echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
		include("modular/header.php");
		echo "
			<main>
			<div class=\"register\">
				<h1>Registreren</h1>
				<p>Registreer nu om toegang te krijgen tot de services van Ritsema Banken.</p>
				<div class=\"login-box\">
					<form method=\"post\">
						<label for=\"username\">E-mailadres</label><br>
						<input type=\"email\" class=\"email\" name=\"email\"></input>
						<br><br>
						<label for=\"username\">Gebruikersnaam</label><br>
						<input type=\"text\" name=\"email\"></input>
						<br><br>
						<label for=\"password\">Wachtwoord</label><br>
						<input type=\"password\" name=\"password\"></input>
						<br><br>
						<label for=\"repeat-password\">Herhaal uw wachtwoord</label><br>
						<input type=\"password\" name=\"repeat-password\"></input>
						<br><br>
						<input class=\"submit\" type=\"submit\" value=\"Login\"></input>
					</form>
				</div>
			</div>
		</main>
		";
		include("modular/footer.php");
	echo "</body>";
echo "</html>";
?>
