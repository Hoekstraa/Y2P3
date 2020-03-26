<?php
require "classes/NavbarItem.php";
//Validate the form data
if (isset($_POST['submit'])) 
{ 

 $Firstname = $_POST['firstname'];
 $Lastname = $_POST['lastname'];
 $Address = $_POST['address'];
 $Postalcode = $_POST['postalcode'];
 $Phonenumber = $_POST['phone-number'];
 $Emailaddress = $_POST['email'];
 $errorMsg = '';

 RequestValidation($Firstname, $Lastname, $Address, $Postalcode, $Phonenumber, $Emailaddress);

} else{
echo "niet gelukt";
}


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

/*
$_SESSION['user'] = "Sang";
$_SESSION['userId'] = 0;
*/
echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body onload=\"emailValidation(); firstNameValidation(); lastNameValidation(); addressValidation(); postalCodeValidation(); phoneNumberValidation()\">";
	echo $errorMsg;
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
					<form method=\"post\" action=\"\">
						<label for=\"firstname\">Voornaam</label><br>
						<input type=\"text\" id=\"firstname\" name=\"firstname\" placeholder=\"Vul uw voornaam in (2-10 tekens)\"></input>
						<br><br>
						<label for=\"lastname\">Achternaam</label><br>
						<input type=\"text\" id=\"lastname\" name=\"lastname\" placeholder=\"Vul uw achternaam in (2-10 tekens)\"></input>
						<br><br>
						<label for=\"address\">Adres</label><br>
						<input type=\"text\" id=\"address\" name=\"address\" placeholder=\"Vul uw adres in\"></input>
						<br><br>
						<label for=\"postalcode\">Postcode</label><br>
						<input type=\"text\" id=\"postalcode\" name=\"postalcode\" placeholder=\"Vul uw postcode vb. 9213WE\"></input>
                        <br><br>
                        <label for=\"phone-number\">Telefoonnummer</label><br>
						<input type=\"text\" id=\"phone-number\" name=\"phone-number\" placeholder=\"vb. 06 12345678\"></input>
                        <br><br>
                        <label for=\"email\">Emailadres</label><br>
						<input type=\"email\" id=\"email\" name=\"email\" placeholder=\"Vul uw emailadres in\"></input>
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

//Check if the data is valid
function RequestValidation($Firstname,$Lastname,$Address,$Postalcode,$Phonenumber, $Emailaddress)
{	
	if (!preg_match("/^(?=.{2,50}$)[a-zA-Z]+(?:[-' ][a-zA-Z]+)*$/", $Firstname)) {
		$errorMsg= 'error : You did not enter a valid firstname.';
	}
	elseif (!preg_match("/^(?=.{2,50}$)[a-zA-Z]+$/", $Lastname)) {
		$errorMsg= 'error : You did not enter a valid lastname.';
	}
	elseif (!preg_match("/(?=.{1,}$)(?:\d+[a-z]*)$/", $Address)) {
		$errorMsg= 'error : You did not enter a valid adres.';
	}
	elseif (!preg_match("/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i", $Postalcode)) {
		$errorMsg= 'error : You did not enter a valid postalcode.';
	}
	elseif (!preg_match("/^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/", $Phonenumber)) {
		$errorMsg= 'error : You did not enter a valid phone number.';
	} 
	//check for valid email 
	elseif (!preg_match("/^(([^<>()\[\]\\.,;:\s@]+(\.[^<>()\[\]\\.,;:\s@]+)*)|(.+))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", $Emailaddress)) {
	  $errorMsg= 'error : You did not enter a valid email.';
	}
	else{
		//final code will execute here.
		header('Location: review.php');
		echo "Success";
	}
}
?>