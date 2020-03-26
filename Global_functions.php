<?php
// This function bannes the user when called.
function Ban($IP,$MAC)
{
	$Encrypted_true = base64_encode("True");
	// Set Banned session to true
	$_SESSION[$Session_banned] = $Encrypted_true;
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
// This checks if ip or mac addres from the user are in the banned.txt file if so then redirect the user to banned.php.
function CheckIfBanned($IP,$MAC)
{
	if(isset($_SESSION[$Session_banned]) && !empty($_SESSION[$Session_banned])) {
		// Pull encrypted data from session
		$Encrypted_status = $_SESSION[$Session_banned];
		// Decrypt the data
		$Decrypted_status = base64_decode($Encrypted_status);
		// Check if data = true if so then redirect to banned.php
	 if ($Decrypted_status == "True")
	 header("Location: Banned.php");
	}
	// Declare file
	$contents = file("Banned.txt");
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
?>