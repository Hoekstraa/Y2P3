<?php
// Require navbar.php
require "classes/NavbarItem.php";
// Include php files
include "Vendor/Project/Global_functions.php";

$title = "Review the mortgage";
$Username = "Piet hendriks rederaar";
$Emailaddress = "Piet@pieterson.com";
$Address = "pieterstraat 15";
$Postalcode = "6969XX";
$Phonenumber = "06123456789";
$Rekeningnummer = "NL77 0123456789";
$bedrag = "69 420";
$E_Mail = "Piet@pieterson.com";
$timeStamp = "12-12-2020 om 19:16";
$employeeId = "69";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", false),
	new NavbarItem("Hypotheek aanvragen", "request_mortgage.php", true),
    new NavbarItem("Uitloggen", "logout.php", false)

];
echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
        include("modular/header.php");
        echo "
        <main>
        <div align='center' class=\"request-review\">
            <h1>Overzicht van aangevraagde hypotheek </h1>
            <div class=\"login-box\">
                <form method=\"post\">
                    <label for=\"Naam\">Naam: </label>$Username
                    <br><br>
                    <label for=\"address\">Adres:</label>
                    $Address
                    <br><br>
                    <label for=\"postalcode\">Postcode:</label>
                    $Postalcode
                    <br><br>
                    <label for=\"phone-number\">Telefoonnummer:</label>
                    $Phonenumber
                    <br><br>
                    <label for=\"email\">Emailadres:</label>
                    $E_Mail
                    <br><br>
                    <label for=\"Rekeningnummer\">Rekeningnummer:</label>
                    $Rekeningnummer
                    <br><br>
                    <label for=\"Bedrag\">Bedrag</label>
                     € $bedrag
                    <br><br>
                    <label for=\"EmlpoyeeID\">Werknemers Id:</label>
                     $employeeId
                    <br><br>
                    <label for=\"TimeStamp\">datum van bevesteging:</label>
                     $timeStamp
                    <br><br>
                    <input class=\"submit\" type=\"submit\" name=\"back\" value=\"afkeuren\"></input>
                    <input class=\"submit\" type=\"submit\" name=\"submit\" value=\"goedkeuren\"></input>
                    
                </form>
                
            </div>
            <br><br>
        </div>
    </main>
    ";
        include("modular/footer.php");
	echo "</body>";
echo "</html>";


?>