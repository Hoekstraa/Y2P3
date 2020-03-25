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


if ( isset( $_POST['submit'] ) ) 
{ 
		$test = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
		$Username = $_POST['username'];
		$Passwd = $_POST['password'];
		LogInValidation($IP,$MAC,$Username,$Passwd,$test);
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
	$host        = "host = localhost";
	$port        = "port = 5432";
	$credentials = "user = postgres password=Xyppyp99";


	$conn_string = "host=localhost port=5432 dbname=test user=postgres password=Xyppyp99";
	$conn = pg_connect($conn_string);

	// query for database creation

	// $result = pg_query($conn, "CREATE TABLE Bank (
	// 	UserId serial PRIMARY KEY,
	// 	Username VARCHAR (50) NOT NULL,
	// 	EMail VARCHAR (50) NOT NULL,
	// 	Password VARCHAR (50) NOT NULL)");
	// echo var_dump($result);	
	
	return $conn;
	
}

// This function closes a connection to the datababase
function DatabaseClose($conn)
{
	pg_close($conn);
}

// This function returns ip adres form the user.
function GetIP()
{
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
	$_SESSION["Banned"] = "True";
    file_put_contents("Banned.txt", PHP_EOL .  $IP, FILE_APPEND);
    file_put_contents("Banned.txt", PHP_EOL .  $MAC, FILE_APPEND);
    header("Location: Banned.php");
}

// This function returns the mac adres from the user.
function GetMAC()
{
	$MAC = exec('getmac');
	$MAC = strtok($MAC, ' ');
	return $MAC;
}

// This checks if ip or mac addres from the user are in the banned.txt file if so then redirect the user to banned.php.
function CheckIfBanned($IP,$MAC)
{
	$filename = 'Banned.txt';
	$contents = file($filename);
	foreach($contents as $line) {
		if($line == $IP)
		{
			header("Location: Banned.php");
		}
		elseif($line == $MAC)
		{
			header("Location: Banned.php");
		}
	}
}
// This function validates the users input.
function LogInValidation($IP,$MAC,$Username,$Passwd,$test)
{
		
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
?>