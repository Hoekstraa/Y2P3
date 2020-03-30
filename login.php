<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "Global_functions.php";
// stop php errors 
error_reporting(E_ERROR | E_PARSE);

//functions
$IP = GetIP();
$MAC = GetMAC();
CheckIfBanned($IP,$MAC);
Set_session($IP,$MAC);
CheckIfLoggedIn();

// Checks if submit button was pressed
if ( isset( $_POST['submit'] ) ) 
{ 
	$Username = $_POST['username'];
	$Passwd = $_POST['password'];
	LogInValidation($IP,$MAC,$Username,$Passwd,$Characters,$Session_name_user);
}
$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php"),
	new NavbarItem("Bye", "bye.php"),
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
		</main>
		";
		include("modular/footer.php");
	echo "</body>";
echo "</html>";

// This function validates the users input.
function LogInValidation($IP,$MAC,$Username,$Passwd,$Characters,$Session_name_user)
{		
		// Checks if the variable contains 1=1 or <script> if yes the call the ban function if no then call userlogin function
		if (strpos($Username, "<script>") || strpos($Username, "1=1") || strpos($Username, "1 =1") || strpos($Username, "1= 1") || strpos($Username, "1 = 1") !== false) 
		{
			Ban($IP,$MAC);
		}
		elseif (strpos($Passwd, "<script>") || strpos($Passwd, "1=1") || strpos($Passwd, "1 =1") || strpos($Passwd, "1= 1") || strpos($Passwd, "1 = 1") !== false) 
		{
			Ban($IP,$MAC);
		}
		else
		{
				// Calls Userlogin function with the userame and password as variables
				UserLogIn($Username,$Passwd,$IP,$MAC,$Session_name_user);
		}
}
// This functions logs user in.
function UserLogIn($Username,$Passwd,$IP,$MAC,$Session_name_user)
{	
	// This function connects to the database
	$conn = DatabaseConnect();
	// Create perpared statement and executes the statement
	$result = pg_prepare($conn, "my_query", "SELECT username,password FROM bank WHERE username = $1 AND password = $2");
	$result = pg_execute($conn, "my_query", array($Username,$Passwd));
	// Checks if login was succesfull 
	$login_check = pg_num_rows($result);
	if($login_check > 0)
	{
		$EncryptedUsername = base64_encode($Username);
		// Create session Username and put the encrypted username in the session
		$_SESSION[$Session_name_user] = $EncryptedUsername;
		// Reset the failed log in counter
		$Encrypt = base64_encode($Int_10);
		$_SESSION[$Session_name] = $Encrypt;
		// Redirect to dashboard.php
		header("Location: dashboard.php");

	}
	else 
	{
		FailedLogIn($IP,$MAC);
	}
	// This function closes database connection
	DatabaseClose($conn);
}
// This function encrypts a int
function Set_session($IP,$MAC) 
{
	if(isset($_SESSION[$Session_name_counter]) && !empty($_SESSION[$Session_name_counter])) 
	{
		// Pull the encrypted data from the session
		$encrypted = $_SESSION[$Session_name_counter];
		// Decrypt the data
		$decrypt = base64_decode($encrypted);
		// Check if the counter greater is then 10 if so then the data has been changed then call the ban function // TODO ff overleggen
		if($counter > $Int_10)
		{
			echo $counter;
			Ban($IP,$MAC);
		}
	}
	else
	{
		// Encrypt the data 
		$encrypt =  base64_encode($Int_10); 
		// Put encrypted data in the session
		$_SESSION[$Session_name] = $encrypt;
	}
}
// This function checks if the users log in failed not more then 3 times
function FailedLogIn($IP,$MAC)
{
	// Checks if session is set and not empty
	if(isset($_SESSION[$Session_name_counter]) && !empty($_SESSION[$Session_name_counter])) 
	{
		// Pulls encrypted data from session
		$encrypted = $_SESSION[$Session_name_counter];
		// Decrypt the data
		$decrypt = base64_decode($encrypted);
		// Decrease the counter by 1
		$counter = $decrypt - 1;
		// Encrypt the counter
		$counter_live = base64_encode($counter);
		// Put the encrypted data in the session
		$_SESSION[$Session_name_counter] = $counter_live;
		// Check if the counter is 0 or lower then call the ban function
		if($counter <= 0)
		{
			Ban($IP,$MAC);
		}
	}
	else
	{
		// Encrypt the data 
		$encrypt =  base64_encode($Int_10); 
		// Put encrypted data in the session
		$_SESSION[$Session_name] = $encrypt;
	}
}
?>