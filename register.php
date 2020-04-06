<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "vendor/Project/Global_functions.php";
// Stop php errors 
error_reporting(E_ERROR | E_PARSE);
// Check if the user is banned
CheckIfBanned($IP,$MAC,$Session_banned);
// Check if the user is logged in
CheckIfLoggedIn($Session_name_user,$page);
// Get the right title and put it in the title variable
$title = GetTitle($page);
// Checks if submit button was pressed
if ( isset( $_POST['submit'] ) ) 
{ 
	// Get mail variable form post
	$mail = htmlspecialchars($_POST['email']);
	// Get username variable from post
	$username = htmlspecialchars($_POST['username']);
	// Get password 1 variable from post
	$password1 = htmlspecialchars($_POST['password']);
	// Get password 2 variable from post
	$password2 = htmlspecialchars($_POST['repeat-password']);
	// Call login validation function
	LogInValidation($IP,$MAC,$mail,$username,$password1,$password2,$Session_banned);
}

$navigation = [
	new NavbarItem("Ritsema Banken", "index.php"),
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
						<b>Vereisten:</b><br>
							<i id=\"reqminamountchars\">Minimaal 5 karakters</i><br>
							<i id=\"reqmaxamountchars\">Maximaal 50 karakters</i><br>
							<i id=\"requppercase\">Minimaal 1 hoofdletter</i><br>
							<i id=\"reqnonalphanumeric\">Minimaal 1 niet-alfanumeriek symbool</i><br>
						<input id=\"password\" type=\"password\" name=\"password\"></input>
						<br><br>
						<label for=\"repeat-password\">Herhaal uw wachtwoord</label><br>
						<input id=\"password2\" type=\"password\" name=\"repeat-password\"></input>
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
function LogInValidation($IP,$MAC,$mail,$username,$password1,$password2,$Session_banned)
{
	checkForHarmFullInput($mail,$Session_banned);
	checkForHarmFullInput($username,$Session_banned);
	checkForHarmFullInput($password1,$Session_banned);
	checkForHarmFullInput($password2,$Session_banned);
	// Checks if the variable contains ' or <script> if yes the call the ban function if no then call userlogin function
	if (strpos($mail, "@") == false) 
	{
		// This gives a popup and after user clicks on it the user is redirected to register.php
		echo '<script type="text/javascript">
			alert("U moet een @ gebruiken");
			window.location.href = "register.php";
			</script>';
	}
	// Check if string contains any wrong characters

	// Check if password 1 is the same as password 2
	elseif($password1 != $password2)
	{
		// This gives a popup and after user clicks on it the user is redirected to register.php
		echo '<script type="text/javascript">
		alert("De 2 wachtwoorden moeten gelijk zijn!");
		window.location.href = "register.php";
		</script>';
		header("Location: register.php");
	}
	else
	{
		// Call sign up function
		SignUp($mail,$username,$password1);
	}
}
// This function enters the users data in to the database after validation
function SignUp($mail,$username,$password1)
{
	// This function connects to the database
	$conn = DatabaseConnect();
	$hashed_password = password_hash($password1, PASSWORD_BCRYPT);
	// Create perpared statement 
	$result = pg_prepare($conn, "my_query", "INSERT INTO bank  (username, email, password) VALUES ($1,$2,$3)");
	// Executes the prepared statement with the variables
	$result = pg_execute($conn, "my_query", array($username,$mail,$hashed_password));
	//This function closes database connection
	DatabaseClose($conn);
	// Redirect to login.php
	header("Location: login.php");
}
?>
