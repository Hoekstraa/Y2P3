<?php
require "classes/NavbarItem.php";

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", false),
	new NavbarItem("Thuis", "index.php", false),
	new NavbarItem("Over ons", "login.php", false),
    new NavbarItem("Contact", "register.php", false),
    new NavbarItem("Gebruiker", "dashboard.php", false),
	new NavbarItem("Hypotheek aanvragen", "request_mortgage.php", true),
    new NavbarItem("Status", "status.php", false),
    new NavbarItem("Uitloggen", "logout.php", false)

	//"test"
];

echo '<html lang="nl">';
echo '<script type="text/javascript" src="nameValidation.js"></script>';

	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
		include("modular/header.php");
		echo "
			<main>
			<div class=\"mortgage-request\">
				<h1>Hypotheek aanvragen</h1>
				<p>Vraag hier uw hypotheek aan.</p>
				<div class=\"login-box\">
					<form method=\"post\">
						<label for=\"firstname\">Voornaam</label><br>
						<input type=\"text\" class=\"firstname\" name=\"firstname\"></input>
						<br><br>
						<label for=\"lastname\">Achternaam</label><br>
						<input type=\"text\" class=\"lastname\"name=\"lastname\"></input>
						<br><br>
						<label for=\"address\">Adres</label><br>
						<input type=\"text\" name=\"address\"></input>
						<br><br>
						<label for=\"postalcode\">Postcode</label><br>
						<input type=\"text\" name=\"postalcode\"></input>
                        <br><br>
                        <label for=\"phone-number\">Telefoonnummer</label><br>
						<input type=\"text\" name=\"phone-number\"></input>
                        <br><br>
                        <label for=\"email\">Emailadres</label><br>
						<input type=\"email\" name=\"email\"></input>
						<br><br>
						<input class=\"submit\" type=\"submit\" value=\"Hypotheek aanvragen\"></input>
					</form>
				</div>
			</div>
		</main>
		";
		include("modular/footer.php");
	echo "</body>";
echo "</html>";
?>