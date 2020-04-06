<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "vendor/Project/Global_functions.php";
// stop php errors 
error_reporting(E_ERROR | E_PARSE);
// Check if the user is banned
CheckIfBanned($IP,$MAC,$Session_banned);
// Set the failed login session to 10
Set_session($IP,$MAC,$Session_name_counter,$FailedAttemps);
// Check if the user is logged in
CheckIfLoggedIn($Session_name_user,$page);
// Get the right title and put it in the title variable
$title = GetTitle($page);
// Checks if submit button was pressed
if ( isset( $_POST['submit'] ) ) 
{ 
	// Pull username from post request
	$Username = $_POST['username'];
	// Pull Passwd from post request
	$Passwd = $_POST['password'];
	// Call login validation function
	LogInValidation($IP,$MAC,$Username,$Passwd,$Characters,$Session_name_user,$Session_name_counter,$Session_banned,$FailedAttemps,$Session_id_user);
}

$navigation = [
	new NavbarItem("Ritsema Banken", "index.php"),
	new NavbarItem("Login", "login.php", true),
	new NavbarItem("Register", "register.php"),
];

echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
		include("modular/header.php");
		echo "
		<main>
			<div class=\"login\">
				<h1>Login</h1>
				<p>Voer uw gegevens in om toegang te verkrijgen tot uw account.</p>
				<div class=\"login-box\">
					<form method=\"post\">
						<label for=\"username\">Gebruikersnaam</label><br>
						<input type=\"text\" name=\"username\"></input>
						<br><br>
						<label for=\"password\">Wachtwoord</label><br>
						<input type=\"password\" name=\"password\"></input>
						<br><br>
						<input class=\"submit\" name=\"submit\" type=\"submit\" value=\"Login\"></input>
					</form>
				</div>
			</div>
			<p><a href=\"./register.php\">Klik hier als u nog geen account heeft.</a></p>
			<p><a href=\"./intra/Employee_login.php\">Klik hier als u in wilt loggen als een werknemer bij Ritsema Banken.</a></p>
		</main>
		";
		include("modular/footer.php");
	echo "</body>";
echo "</html>";

// This function validates the users input.
function LogInValidation($IP,$MAC,$Username,$Passwd,$Characters,$Session_name_user,$Session_name_counter,$Session_banned,$FailedAttemps,$Session_id_user)
{
		// Checks if the variable contains 1=1 or <script> if yes the call the ban function if no then call userlogin function
		checkForHarmFullInput($Username);
		checkForHarmFullInput($Passwd);

		// Calls Userlogin function with the userame and password as variables
		UserLogIn($Username,$Passwd,$IP,$MAC,$Session_name_user,$Session_name_counter,$FailedAttemps,$Session_id_user);
}
// This functions logs user in.
function UserLogIn($Username,$Passwd,$IP,$MAC,$Session_name_user,$Session_name_counter,$FailedAttemps,$Session_id_user)
{	
	// This function connects to the database
	$conn = DatabaseConnect();
	// Create perpared statement 
	$result = pg_prepare($conn, "my_query", "SELECT username,password FROM bank WHERE username = $1");
	// Execute the prepared statement with variables
	$result = pg_execute($conn, "my_query", array($Username));
	$login_check = pg_num_rows($result);
	while($row = pg_fetch_row($result))
	{
		$hash = $row[1];
	}
	if (password_verify($Passwd, $hash)) 
	{
		//Checks if login was succesfull 
		if($login_check > 0)
		{
			// Create prepared statement
			$userid = pg_prepare($conn, "userid", "SELECT userid FROM bank WHERE username = $1");
			// Execute prepared statement with variable
			$userid = pg_execute($conn, "userid", array($Username));
			// Get data from sql result
			while ($row = pg_fetch_row($userid)) 
			{
				// Get userid from sql query return
				$user_id = $row[0];
			}
			// Encrypt user id
			$EncryptedUserid = base64_encode($user_id);
			// Put encrypted user id in a session
			$_SESSION[$Session_id_user] = $EncryptedUserid;
			// Encrypt user name
			$EncryptedUsername = base64_encode($Username);
			// Create session Username and put the encrypted username in the session
			$_SESSION[$Session_name_user] = $EncryptedUsername;
			// Reset the failed log in counter
			$Encrypt = base64_encode($FailedAttemps);
			$_SESSION[$Session_name_counter] = $Encrypt;
			// Redirect to dashboard.php
			header("Location: dashboard.php");
		}
		else 
		{
			// Call failedlogin function
			FailedLogIn($IP,$MAC,$Session_name_counter);
		}
		//This function closes database connection
		DatabaseClose($conn);
	}
}
// This function checks if the failed session session is set and not tampered with
function Set_session($IP,$MAC,$Session_name_counter,$FailedAttemps) 
{
	// Check if session name counter is set and not empty
	if(isset($_SESSION[$Session_name_counter]) && !empty($_SESSION[$Session_name_counter])) 
	{
		// Pull the encrypted data from the session
		$encrypted_counter = $_SESSION[$Session_name_counter];
		// Decrypt the data
		$decrypted_counter = base64_decode($encrypted_counter);
		// Check if the counter greater is then 10 if so then the data has been changed then call the ban function // TODO ff overleggen
		if($decrypted_counter > $FailedAttemps)
		{
			// Call the ban function
			Ban($IP,$MAC,$Session_banned);
		}
	}
	elseif(!isset($_SESSION[$Session_name_counter]) && empty($_SESSION[$Session_name_counter])) 
	{
		// Encrypt the data 
		$encrypt_10 =  base64_encode($FailedAttemps); 
		// Put encrypted data in the session
		$_SESSION[$Session_name_counter] = $encrypt_10;
	}
}
// This function checks if the users log in failed not more then 3 times
function FailedLogIn($IP,$MAC,$Session_name_counter)
{
	// Checks if session is set and not empty
	if(isset($_SESSION[$Session_name_counter]) && !empty($_SESSION[$Session_name_counter])) 
	{
		// Pulls encrypted data from session
		$encrypted = $_SESSION[$Session_name_counter];
		// Decrypt the data
		$decrypted = base64_decode($encrypted);
		// Decrease the counter by 1
		$counter = $decrypted - 1;
		// Check if the counter is 0 or lower then call the ban function
		if($counter <= 0)
		{
			// Call the banned function
			Ban($IP,$MAC);
		}
		else
		{
		// Encrypt the counter
		$counter_live = base64_encode($counter);
		// Put the encrypted data in the session
		$_SESSION[$Session_name_counter] = $counter_live;
		}
	}
	}
?>
