<?php
require "classes/NavbarItem.php";
session_start();

//Data
$Firstname = $_SESSION['firstname'];
$Lastname = $_SESSION['lastname'];
$Address = $_SESSION['address'];
$Postalcode = $_SESSION['postalcode'];
$Phonenumber = $_SESSION['phone-number'];
$Emailaddress = $_SESSION['email'];

if ( isset( $_POST['back'])) 
{ 
  //Go back to the request page
  header("Location: request_mortgage.php"); 
}

if ( isset( $_POST['submit'])) 
{ 
//Insert values into the database

}

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", true),
	new NavbarItem("Bye", "bye.php"),
	new NavbarItem("Login", "login.php"),
	new NavbarItem("Register", "register.php"),
	//"test"
];
echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
        include("modular/header.php");
        echo "
        <main>
        <div class=\"request-review\">
            <h1>Overzicht van uw hypotheek aanvraag</h1>
            <p id=\"head\">Kloppen uw gegevens hieronder?</p>
            <div class=\"login-box\">
                <form method=\"post\">
                    <label for=\"firstname\">Voornaam</label><br>
                    $Firstname
                    <br><br>
                    <label for=\"lastname\">Achternaam</label><br>
                    $Lastname
                    <br><br>
                    <label for=\"address\">Adres</label><br>
                    $Address
                    <br><br>
                    <label for=\"postalcode\">Postcode</label><br>
                    $Postalcode
                    <br><br>
                    <label for=\"phone-number\">Telefoonnummer</label><br>
                    $Phonenumber
                    <br><br>
                    <label for=\"email\">Emailadres</label><br>
                    $Emailaddress
                    <br><br>
                    <input class=\"submit\" type=\"submit\" name=\"back\" value=\"Terug gaan\"></input>
                    <input class=\"submit\" type=\"submit\" name=\"submit\" value=\"Bevestigen\"></input>
                </form>
            </div>
        </div>
    </main>
    ";
        include("modular/footer.php");
	echo "</body>";
echo "</html>";
?>