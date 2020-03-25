<?php
require "classes/NavbarItem.php";

// start the sessions
session_start();
// stop php errors 
error_reporting(E_ERROR | E_PARSE);

//Variables

//functions
$IP = GetIP();
$MAC = GetMAC();
CheckIfBanned($IP,$MAC);

// Checks if submit button was pressed
if ( isset( $_POST['submit'] ) ) 
{ 
		$Username = $_POST['username'];
		$Passwd = $_POST['password'];
		LogInValidation($IP,$MAC,$Username,$Passwd);
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


// This function opens a connection to the datababase
function DatabaseConnect()
{
	// Declare connection variables
	$conn_string = "host=localhost port=5432 dbname=test user=postgres password=Xyppyp99";
	// Execute connection string
	$conn = pg_connect($conn_string);
	// Return $conn variable
	return $conn;
	
}

// This function creates the database
function DatabaseCreation($conn)
{
	// calls data baseconnect function
	$conn = DatabaseConnect();
	//query for database creation
	$result = pg_query($conn, "CREATE TABLE Bank (
		UserId serial PRIMARY KEY,
		Username VARCHAR (50) NOT NULL,
		EMail VARCHAR (50) NOT NULL,
		Password VARCHAR (50) NOT NULL)");
	// Show if query was succesfull
	echo var_dump($result);
}

// This function closes a connection to the datababase
function DatabaseClose($conn)
{
	pg_close($conn);
}

// This function returns ip adres form the user.
function GetIP()
{
	// Get the users ip and put it in the $IP variable
	if(!empty($_SERVER["HTTP_CLIENT_IP"]))
	{
    $IP = $_SERVER["HTTP_CLIENT_IP"];
	}
	else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
    $IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	else
 	{
    $IP = $_SERVER["REMOTE_ADDR"];
	} 
	return $IP;
}
// This function bannes the user when called.
function Ban($IP,$MAC)
{
	// Set Banned session to true
	$_SESSION["Banned"] = "True";
	// Open banned.txt and write IP to it and new line
	file_put_contents("Banned.txt", PHP_EOL .  $IP, FILE_APPEND);
	// Open banned.txt and write MAC to it and new line
	file_put_contents("Banned.txt", PHP_EOL .  $MAC, FILE_APPEND);
	// Redirect to banned.php
    header("Location: Banned.php");
}

// This function returns the mac adres from the user.
function GetMAC()
{
	// Get mac addres and put it in the $mac variable
	$MAC = exec('getmac');
	$MAC = strtok($MAC, ' ');
	return $MAC;
}

// This checks if ip or mac addres from the user are in the banned.txt file if so then redirect the user to banned.php.
function CheckIfBanned($IP,$MAC)
{
	// Declare file
	$filename = 'Banned.txt';
	$contents = file($filename);
	// Loop through the file line by line
	foreach($contents as $line) {
		// Check if line is the same as the ip of the user if yes then redirect
		if($line == $IP)
		{
			// Redirect to banned.php
			header("Location: Banned.php");
		}
		// Check if line is the same as the mac of the user if yes then redirect
		elseif($line == $MAC)
		{
			// Redirect to banned.php
			header("Location: Banned.php");
		}
	}
}
// This function validates the users input.
function LogInValidation($IP,$MAC,$Username,$Passwd)
{
		// Checks if the variable contains ' or <script> if yes the call the ban function if no then call userlogin function
		if (strpos($Username, "'") !== false) 
		{
			Ban($IP,$MAC);
		}
		elseif(strpos($Passwd,"'") !== false)
		{
			Ban($IP,$MAC);
		}
		elseif(strpos($Username,"<script>") !== false)
		{
			Ban($IP,$MAC); 
		}
		elseif(strpos($Passwd,"<script>") !== false)
		{
			Ban($IP,$MAC);
		}
		else
		{	
				// Calls Userlogin function with the userame and password as variables
				UserLogIn($Username,$Passwd);
		}
}

// This functions logs user in.
function UserLogIn($Username,$Passwd)
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
		// Create session Username and put the username in the session
		$_SESSION["Username"] = $Username;
		// Redirect to Dashboard.php
		header("Location: Dashboard.php");
	}
	else 
	{
		
	}
	// This function closes database connection
	DatabaseClose($conn);
}
// This function checks if the user is logged in
function CheckIfLoggedIn()
{

}
?>