<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "Global_functions.php";

// start the sessions
session_start();
// stop php errors 
error_reporting(E_ERROR | E_PARSE);


//functions
$IP = GetIP();
$MAC = GetMAC();
CheckIfBanned($IP,$MAC);


// Checks if submit button was pressed
if ( isset( $_POST['submit'] ) ) 
{ 
	$Mail = $_POST['email'];
	$username = $_POST['username'];
	$password1 = $_POST['password'];
	$password2 = $_POST['repeat-password'];
	LogInValidation($IP,$MAC,$mail,$Username,$password1,$password2);
}

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php"),
	new NavbarItem("Bye", "bye.php"),
	new NavbarItem("Login", "login.php"),
	new NavbarItem("Register", "register.php", true),
];

echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body onload=\"initListeners()\">";
		include("modular/navbar.php");
		include("modular/header.php");
		echo "<script src=\"scripts/EmailValidation.js\"></script>";
		echo "
			<main>
			<div class=\"register\">
				<h1>Registreren</h1>
				<p>Registreer nu om toegang te krijgen tot de services van Ritsema Banken.</p>
				<div class=\"login-box\">
					<form method=\"post\">
						<label for=\"E-mailadres\">E-mailadres</label><br>
						<input type=\"email\" id=\"email\" name=\"email\"></input>
						<br><br>
						<label for=\"username\">Gebruikersnaam</label><br>
						<input type=\"text\" id=\"username\" name=\"username\"></input>
						<br><br>
						<label for=\"password\">Wachtwoord</label><br>
						<input type=\"password\" name=\"password\"></input>
						<br><br>
						<label for=\"repeat-password\">Herhaal uw wachtwoord</label><br>
						<input type=\"password\" name=\"repeat-password\"></input>
						<br><br>
						<input class=\"submit\" name=\"submit\" type=\"submit\" value=\"Login\"></input>
					</form>
				</div>
			</div>
		</main>
		";
		include("modular/footer.php");
	echo "</body>";
echo "</html>";

// This function validates the users input.
function LogInValidation($IP,$MAC,$Mail,$Username,$password1,$password2)
{
	// Checks if the variable contains ' or <script> if yes the call the ban function if no then call userlogin function
	// if (strpos($Mail, "@") == false) 
	// {
	// 	echo '<script type="text/javascript">
	// 		alert("U moet een @ gebruiken");
	// 		window.location.href = "register.php";
	// 		</script>';
	// }
	//else
	if (strpos($Mail, $Characters) !== false) 
	{
		Ban($IP,$MAC);
	}
	elseif (strpos($Username, $Characters) !== false) 
	{
		Ban($IP,$MAC);
	}
	elseif (strpos($password1, $Characters) !== false) 
	{
		Ban($IP,$MAC);
	}
	elseif (strpos($password2, $Characters) !== false) 
	{
		Ban($IP,$MAC);
		
	}
	elseif($password1 != $password2)
	{
		echo '<script type="text/javascript">
		alert("De 2 wachtwoorden moeten gelijk zijn!");
		window.location.href = "register.php";
		</script>';
	}
	else
	{
		SignUp($mail,$Username,$Passwd);
	}
}

function SignUp($mail,$Username,$Passwd)
{
	// This function connects to the database
	$conn = DatabaseConnect();
	// Create perpared statement and executes the statement

	//$result = pg_query($conn, "INSERT INTO bank  (username, email, password) VALUES ('$1','$2','$3')");

	
	$result = pg_prepare($conn, "my_query", "INSERT INTO bank (username, email, password) VALUES ($1,$2,$3)");
	$result = pg_execute($conn, "my_query", array($Username,$mail,$Passwd));
	echo var_dump($result);
	//This function closes database connection
	DatabaseClose($conn);
	
}

?>
