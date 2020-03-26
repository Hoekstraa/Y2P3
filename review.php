<?php
require "classes/NavbarItem.php";

$Firstname = $_POST['firstname'];
$Lastname = $_POST['lastname'];
$Address = $_POST['address'];
$Postalcode = $_POST['postalcode'];
$Phonenumber = $_POST['phone-number'];
$Emailaddress = $_POST['email'];

if ( isset( $_POST['back'] ) ) 
{ 
  //Go back to the request page
  header("Location: request_mortgage.php"); 
}

if ( isset( $_POST['submit'] ) ) 
{ 
  //Insert database query
  /*
 $host = 'localhost';
 $user = 'root';
 $pass = ' ';

 mysql_connect($host, $user, $pass);
 mysql_select_db('demo');

 $insertdata=" INSERT INTO user_data VALUES( '$Firstname','$Lastname','$Address','$Postalcode','$Phonenumber','$Emailaddress' ) ";
 mysqli_query($insertdata);
 */
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
            <p id=\"head\">Overzicht van uw hypotheek aanvraag</p>
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