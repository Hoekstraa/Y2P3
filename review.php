<?php
// Require navbar.php
require "classes/NavbarItem.php";
// Include php files
include "vendor/Project/Global_functions.php";
// Checks if user is logged in
CheckIfLoggedIn($Session_name_user,$page);
// Get username
$DecryptedUsername = GetUsername($Session_name_user);
// Generate random token
generate_token($token_session);
// Get userid
$userid = GetUserID($Session_id_user);
// Get the right title and put it in the title variable
$title = GetTitle($page);
// Set username variable as decryptedusername
$Username = $DecryptedUsername;
// Set address variable to session
$Address = $_SESSION['address'];
// Set postal code variable to session
$Postalcode = $_SESSION['postalcode'];
// Set phonenumber variable to session
$Phonenumber = $_SESSION['phone-number'];
// Set rekeningnummer variable to session
$Rekeningnummer = $_SESSION['Rekeningnummer'];
// Set bedrag variable to session
$bedrag = $_SESSION['bedrag'];
// Set email variable as the return value of getemail function
$E_Mail = GetEmail($Username);
// Check if post back is set
if ( isset( $_POST['back'])) 
{ 
  // Redirect to request_mortgage.php
  header("Location: request_mortgage.php"); 
}
// Check if submit post is set
if ( isset( $_POST['submit'])) 
{ 
    // Call compare token mortgage function
    CompareToken_mortgage($userid,$Address,$bedrag,$Rekeningnummer,$token_session);
}

$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", false),
    new NavbarItem(htmlspecialchars($DecryptedUsername), "dashboard.php", false),
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
                    htmlspecialchars($Username)
                    <br><br>
                    <label for=\"address\">Adres</label><br>
                    htmlspecialchars($Address)
                    <br><br>
                    <label for=\"postalcode\">Postcode</label><br>
                    htmlspecialchars($Postalcode)
                    <br><br>
                    <label for=\"phone-number\">Telefoonnummer</label><br>
                    htmlspecialchars($Phonenumber)
                    <br><br>
                    <label for=\"email\">Emailadres</label><br>
                    htmlspecialchars($E_Mail)
                    <br><br>
                    <label for=\"Rekeningnummer\">Rekeningnummer</label><br>
                    htmlspecialchars($Rekeningnummer)
                    <br><br>
                    <label for=\"Bedrag\">Bedrag</label><br>
                    htmlspecialchars($bedrag)
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
    // Set status function
    $status = "Aanvraag in werking";
    // Set rente variable
    $rente = "13%";
    //TODO deze werknemer uit ldap database pullen
    $werknemer = 1;
    // Connect to the database and put connection in conn variable
    $conn = DatabaseConnect();
    // Create perpared statement 
	$result = pg_prepare($conn, "my_query", "INSERT INTO hypotheken  (userid,adres,bedrag, rente, werknemer,rekeningnummer,hypotheek_status) VALUES ($1,$2,$3,$4,$5,$6,$7)");
	// Executes the prepared statement with the variables
	$result = pg_execute($conn, "my_query", array($userid,$Address,$bedrag,$rente,$werknemer,$Rekeningnummer,$status));
	//This function closes database connection
    DatabaseClose($conn);
    // Redirect to dashboard.php
    header("Location: dashboard.php"); 
}
//This function gets the users email from the database
function GetEmail($Username)
{
	// This function connects to the database
    $conn = DatabaseConnect();
    // Create prepared statement
    $UserMail = pg_prepare($conn, "mail", "SELECT email FROM bank WHERE username = $1");
    // Execute prepared statement
    $UserMail = pg_execute($conn, "mail", array($Username));
        // Get data from sql return
		while ($row = pg_fetch_row($UserMail)) 
		{
			// Get userid from sql query return
			$E_Mail = $row[0];
        }
    // return email variable
    DatabaseClose($conn);
    return $E_Mail;
}
?>