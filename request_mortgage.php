<?php
require "classes/NavbarItem.php";

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", false),
	new NavbarItem("Thuis", "index.php", false),
	new NavbarItem("Over ons", "index.php", false),
    new NavbarItem("Contact", "register.php", false),
    new NavbarItem("Gebruiker", "dashboard.php", false),
	new NavbarItem("Hypotheek aanvragen", "request_mortgage.php", true),
    new NavbarItem("Status", "status.php", false),
    new NavbarItem("Uitloggen", "logout.php", false)

	//"test"
];

echo '<html lang="nl">';

	include("modular/head.php");
	echo "<body onload=\"emailValidation(); firstNameValidation(); lastNameValidation(); addressValidation(); postalCodeValidation(); phoneNumberValidation()\">";
		include("modular/navbar.php");
        include("modular/header.php");
		echo "<script src=\"scripts/RequestValidation.js\"></script>";
		echo "<script src=\"scripts/EmailValidation.js\"></script>";
		echo "
			<main>
			<div class=\"mortgage-request\">
                <h1>Hypotheek aanvragen</h1>
                <p id=\"head\">Vraag hier uw hypotheek aan.</p>
				<div class=\"login-box\">
					<form method=\"post\">
						<label for=\"firstname\">Voornaam</label><br>
						<input type=\"text\" id=\"firstname\" name=\"firstname\" placeholder=\"Vul uw voornaam in (2-10 tekens)\"></input>
						<br><br>
						<label for=\"lastname\">Achternaam</label><br>
						<input type=\"text\" id=\"lastname\"name=\"lastname\" placeholder=\"Vul uw achternaam in (2-10 tekens)\"></input>
						<br><br>
						<label for=\"address\">Adres</label><br>
						<input type=\"text\" id=\"address\" placeholder=\"Vul uw adres in\"></input>
						<br><br>
						<label for=\"postalcode\">Postcode</label><br>
						<input type=\"text\" id=\"postalcode\" placeholder=\"Vul uw postcode vb. 9213WE\"></input>
                        <br><br>
                        <label for=\"phone-number\">Telefoonnummer</label><br>
						<input type=\"text\" id=\"phone-number\" placeholder=\"vb. 06 12345678\"></input>
                        <br><br>
                        <label for=\"email\">Emailadres</label><br>
						<input type=\"email\" id=\"email\" name=\email\ placeholder=\"Vul uw emailadres in\"></input>
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