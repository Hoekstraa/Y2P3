<?php
// Require navbar.php
require "classes/NavbarItem.php";
// Include php files
include "Global_functions.php";
// Checks if user is logged in
CheckIfLoggedIn($Session_name_user,$page);
// Get username
$DecryptedUsername = GetUsername($Session_name_user);
// Generate random token
generate_token($token_session);
// Get userid
$userid = GetUserID($Session_id_user);


//Data
$Username = $DecryptedUsername;
$Emailaddress = 
$Address = $_SESSION['address'];
$Postalcode = $_SESSION['postalcode'];
$Phonenumber = $_SESSION['phone-number'];
$Rekeningnummer = $_SESSION['Rekeningnummer'];
$bedrag = $_SESSION['bedrag'];
$E_Mail = GetEmail($Username);
if ( isset( $_POST['back'])) 
{ 
  // Go back to the request page
  header("Location: request_mortgage.php"); 
}

if ( isset( $_POST['submit'])) 
{ 
    CompareToken_mortgage($userid,$Address,$bedrag,$Rekeningnummer,$token_session);
}

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", false),
    new NavbarItem("$DecryptedUsername", "dashboard.php", false),
    new NavbarItem("Uitloggen", "logout.php", false)

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
                    <label for=\"Naam\">Naam</label><br>
                    $Username
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
                    $E_Mail
                    <br><br>
                    <label for=\"Rekeningnummer\">Rekeningnummer</label><br>
                    $Rekeningnummer
                    <br><br>
                    <label for=\"Bedrag\">Bedrag</label><br>
                    $bedrag
                    <br><br>
                    <input type=\"hidden\" name=\"token\" value=\" $_SESSION[$token_session] \"\>
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
//This function adds the mortgage to the database
function AddMortgage($userid,$Address,$bedrag,$Rekeningnummer)
{
    $status = "Aanvraag in werking";
    $rente = "13%";
    //TODO deze werknemer uit ldap database pullen
    $werknemer = 1;
    $conn = DatabaseConnect();
    // Create perpared statement 
	$result = pg_prepare($conn, "my_query", "INSERT INTO hypotheken  (userid,adres,bedrag, rente, werknemer,rekeningnummer,hypotheek_status) VALUES ($1,$2,$3,$4,$5,$6,$7)");
	// Executes the prepared statement with the variables
	$result = pg_execute($conn, "my_query", array($userid,$Address,$bedrag,$rente,$werknemer,$Rekeningnummer,$status));
	//This function closes database connection
    DatabaseClose($conn);
    //header("Location: dashboard.php"); 
}
//This function gets the users email from the database
function GetEmail($Username)
{
	// This function connects to the database
    $conn = DatabaseConnect();
    // Get userid from database
	$UserMail = pg_prepare($conn, "mail", "SELECT email FROM bank WHERE username = $1");
	$UserMail = pg_execute($conn, "mail", array($Username));
		while ($row = pg_fetch_row($UserMail)) 
		{
			// Get userid from sql query return
			$E_Mail = $row[0];
        }
    return $E_Mail;
}
?>