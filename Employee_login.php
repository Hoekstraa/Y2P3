<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "vendor/Project/Global_functions.php";
// Include php files
include "Global_functions_LDAP.php";
// stop php errors 
error_reporting(E_ERROR | E_PARSE);
// Check if the user is banned
CheckIfBanned($IP,$MAC,$Session_banned);
// Get ldap connection
$ldap = LDAPConnect();
// Checks if submit button was pressed
if ( isset( $_POST['submit'] ) ) 
{ 
	$Username = $_POST['username'];
	$Passwd = $_POST['password'];
}

echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
		include("modular/header.php");
		echo "
		<main>
			<div align='center' class=\"login\">
				<h1>Werknemers Login</h1>
				<p>Voer uw gegevens in om toegang te verkrijgen tot uw account.</p>
				<div class=\"login-box\">
					<form method=\"post\">
						<label for=\"username\">Gebruikersnaam</label><br>
						<input type=\"text\" name=\"username\">
						<br><br>
						<label for=\"password\">Wachtwoord</label><br>
						<input type=\"password\" name=\"password\"><br>
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
function LogInValidation($IP,$MAC,$Username,$Passwd,$Characters,$Session_name_user,$Session_name_counter,$Session_banned,$FailedAttemps,$Session_id_user)
{		
		// Checks if the variable contains 1=1 or <script> if yes the call the ban function if no then call userlogin function
		if (strpos($Username, "<script>") || strpos($Username, "1=1") || strpos($Username, "1 =1") || strpos($Username, "1= 1") || strpos($Username, "1 = 1") !== false) 
		{
			Ban($IP,$MAC,$Session_banned);
		}
		elseif (strpos($Passwd, "<script>") || strpos($Passwd, "1=1") || strpos($Passwd, "1 =1") || strpos($Passwd, "1= 1") || strpos($Passwd, "1 = 1") !== false) 
		{
			Ban($IP,$MAC,$Session_banned);
		}
		else
		{
			LDAPLogin($ldap);
		}
}
?>
