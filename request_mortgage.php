<?php
require "classes/NavbarItem.php";
// Include php files
include "Global_functions.php";
// Set global variable
$DecryptedUsername = GetUsername($Session_name_user);
// Checks if the user is logged in
CheckIfLoggedIn($Session_name_user,$page);
// Check if the user is banned
CheckIfBanned($IP,$MAC,$Session_banned);

//Validate the form data
if (isset($_POST['submit']))
{
	$Address = $_POST['address'];
	$Postalcode = $_POST['postalcode'];
	$Phonenumber = $_POST['phone-number'];
	$bedrag = $_POST['bedrag'];
	$Rekeningnummer = $_POST['Rekeningnummer'];

	$_SESSION['address'] = $_POST['address'];
	$_SESSION['postalcode'] = $_POST['postalcode'];
	$_SESSION['phone-number'] = $_POST['phone-number'];
	$_SESSION['bedrag'] = $_POST['bedrag'];
	$_SESSION['Rekeningnummer'] = $_POST['Rekeningnummer'];

	$errorMsg = '';

	RequestValidation($Address, $Postalcode, $Phonenumber,$bedrag,$Rekeningnummer);
}

$title = "Hypotheek aanvragen";
if(isset($_SESSION[$Session_name_user]) && !empty($_SESSION[$Session_name_user]))
{
	$navigation = [
		new NavbarItem("Ritsema Banken", "index.php", false),
		new NavbarItem("$DecryptedUsername", "dashboard.php", false),
		new NavbarItem("Uitloggen", "logout.php", false)
	];
}
else
{
	$navigation = [
		new NavbarItem("Ritsema Banken", "index.php", true),
		new NavbarItem("Login", "login.php"),
		new NavbarItem("Register", "register.php"),
	];
}
$string = "token";
echo '<html lang="nl">';
include("modular/head.php");
echo "<body onload=\"initListeners()\">";
include("modular/navbar.php");
include("modular/header.php");
echo "<script src=\"scripts/RequestValidation.js\"></script>";
echo "
			<main>
			<div class=\"mortgage-request\">
				<h1>Hypotheek aanvragen</h1>
				<p id=\"head\">Vraag hier uw hypotheek aan.</p>
				<div class=\"login-box\">
					<form method=\"post\"action=\"\">
						<label for=\"address\">Adres</label><br>
						<input type=\"text\" id=\"address\" name=\"address\" placeholder=\"Vul uw adres in\"></input>
						<br><br>
						<label for=\"postalcode\">Postcode</label><br>
						<input type=\"text\" id=\"postalcode\" name=\"postalcode\" placeholder=\"Vul uw postcode vb. 9213WE\"></input>
						<br><br>
						<label for=\"phone-number\">Telefoonnummer</label><br>
						<input type=\"text\" id=\"phone-number\" name=\"phone-number\" placeholder=\"vb. 06 12345678\"></input>
						<br><br>
						<label for=\"Bedrag\">Bedrag</label><br>
						<input type=\"text\" id=\"bedrag\" name=\"bedrag\" placeholder=\"Bedrag\"></input>
						<br><br>
						<label for=\"Rekeningnummer\">Rekeningnummer</label><br>
						<input type=\"text\" id=\"Rekeningnummer\" name=\"Rekeningnummer\" placeholder=\"Rekeningnummer\"></input>
						<br><br>
						<input class=\"submit\" type=\"submit\" name=\"submit\" value=\"Hypotheek aanvragen\"></input>
					</form>
				</div>
			</div>
		</main>
		";
include("modular/footer.php");
echo "</body>";
echo "</html>";

//Check if the data is valid and checks character lengths
function RequestValidation($Address,$Postalcode,$Phonenumber,$bedrag,$Rekeningnummer)
{
	if (!preg_match("/(?=.{1,}$)(?:\d+[a-z]*)$/", $Address)) {
		$errorMsg= 'error : You did not enter a valid address.';
	}
	elseif (!preg_match("/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i", $Postalcode)) {
		$errorMsg= 'error : You did not enter a valid postalcode.';
	}
	elseif (!preg_match("/^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/", $Phonenumber)) {
		$errorMsg= 'error : You did not enter a valid phone number.';
	}
	else
	{
		//final code will execute here.
		header('Location: review.php');
	}
}
?>
