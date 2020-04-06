<?php
// start the sessions
//namespace Vendor\Project;

session_start();

//Global Variables
$Session_name_counter = "E9Dnz4zRqqdrhPZ3hTGY4Kry0OfcNi2NeuXZGpQdZhqe1Plas8emEp3RaYiX7IO1fARE5h3I02y9rl9RlLtvRWhAMyPC3poj91Gz";
$Session_name_user = "zRIQdtKLvAUWhmc46CpusfQrnpWR2vLHMAnzsgLhlyF7lW6KToPD0A674JWokJ7DxxuKnnGls28nH5jn0WGMCDgpcbnzxoCYGR6h";
$Session_id_user = "AiS7M5emJjrZw3YlWvPwzKsxwMI6wt07kBgjnMwxenaFI9U0Oc15E9dl1DCEL0CNnmwsM6bxpnVUFWQ3gna5TAEAelMwFTN2oXpI";
$Session_banned = "GE9Rr1eyAz3HyyYrUPhZHwMXZenSU78Wobgu2b4kIWwMpFRGASIfEOBAmVVV7cE0ayZ0JafbDaOzlsRSBRHP4XmCTPCMaEyHSUj7";
$Session_name_employee = "zIkUm3aLz7y4UJi84NpNpfjsfsU66BEjDyrKqkS7K3mQGvtQFKfj60Dmf2Kekleqr7fGZssDN4PDU4VQUCgWny6Y8ux5g13mxSc5"; 
//if (isset($_SERVER['REQUEST_URI']))
//{
$page = $_SERVER['REQUEST_URI'];

$token_session = "token";

// Variable 10 
$FailedAttemps = 10;
// Set global ip variable
$IP = GetIP();
// Set global mac variable
$MAC = GetMAC();

// This function checks if the user is logged in and ifnot redirect to login.php
function CheckIfLoggedIn($Session_name_user, $page)
{
    switch($page)
    {
        case "login.php":
            if (isset($_SESSION[$Session_name_user]) && !empty($_SESSION[$Session_name_user])) {
                // Redirect to dashboard.php
                header("Location: Dashboard.php");
            }
        break;
        case "register.php":
            if (isset($_SESSION[$Session_name_user]) && !empty($_SESSION[$Session_name_user])) {
                // Redirect to dashboard.php
                header("Location: Dashboard.php");
            }
        break;
        case "dashboard.php":
            if (isset($_SESSION[$Session_name_user]) && !empty($_SESSION[$Session_name_user])) {
                // Redirect to dashboard.php
                header("Location: login.php");
            }
        break;
        case "request_morgage.php":
            if (isset($_SESSION[$Session_name_user]) && !empty($_SESSION[$Session_name_user])) {
                // Redirect to dashboard.php
                header("Location: login.php");
            }
        break;
        case "review.php":
            if (isset($_SESSION[$Session_name_user]) && !empty($_SESSION[$Session_name_user])) {
                // Redirect to dashboard.php
                header("Location: login.php");
            }
        break;
    }
}
// This function bannes the user when called.
function Ban($IP, $MAC, $Session_banned)
{
    // Encrypt true string
    $Encrypted_true = base64_encode("True");
    // Set Banned session to true
    $_SESSION[$Session_banned] = $Encrypted_true;
    // Open banned.txt and write IP to it and new line
    file_put_contents("Banned.txt", PHP_EOL . $IP, FILE_APPEND);
    // Open banned.txt and write MAC to it and new line
    file_put_contents("Banned.txt", PHP_EOL . $MAC, FILE_APPEND);
    // Redirect to banned.php
    header("Location: Banned.php");
}
// This function returns the mac adres from the user.
function GetMAC()
{
    // Get mac addres and put it in the $mac variable
    $MAC = exec('getmac');
    $MAC = strtok($MAC, ' ');
    // Return mac variable
    return $MAC;
}
// This function returns ip adres form the user.
function GetIP()
{
    // Get the users ip and put it in the $IP variable
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $IP = $_SERVER["HTTP_CLIENT_IP"];
    } else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        $IP = $_SERVER["REMOTE_ADDR"];
    }
    // Return ip variable
    return $IP;
}
// This checks if ip or mac addres from the user are in the banned.txt file if so then redirect the user to banned.php.
function CheckIfBanned($IP, $MAC, $Session_banned)
{
    // Check if session banned is set and not empty
    if (isset($_SESSION[$Session_banned]) && !empty($_SESSION[$Session_banned])) {
        // Pull encrypted data from session
        $Encrypted_status = $_SESSION[$Session_banned];
        // Decrypt the data
        $Decrypted_status = base64_decode($Encrypted_status);
        // Check if data = true if so then redirect to banned.php
        if ($Decrypted_status == "True") {
            // Redirect to banned.php
            header("Location: Banned.php");
        }
    }
    // Declare file
    $contents = file("Banned.txt");

    // Loop through the file line by line
    foreach ($contents as $line) {
        // Check if line is the same as the ip or MAC of the user if yes then redirect
        if ($line == $IP || $line == $MAC) {

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
		Password VARCHAR (900) NOT NULL)");
    // Show if query was succesfull
    echo var_dump($result);
}
// This function creates the morgage database 
function DatabaseMortgage($conn)
{
    // calls data baseconnect function
    $conn = DatabaseConnect();
    //query for database creation
    $result = pg_query($conn, "CREATE TABLE Hypotheken (
		HypotheekID serial PRIMARY KEY,
		userid VARCHAR (50) NOT NULL,
		Adres VARCHAR (100) NOT NULL,
		Bedrag VARCHAR (100) NOT NULL,
		Rente VARCHAR (100) NOT NULL,
		Werknemer VARCHAR (100) NOT NULL,
		Rekeningnummer VARCHAR (25) NOT NULL,
		Hypotheek_status VARCHAR (100) NOT NULL)");
    // Show if query was succesfull
    echo var_dump($result);
}
function Afspraken()
{
    // calls data baseconnect function
    $conn = DatabaseConnect();
    //query for database creation
    $result = pg_query($conn, "CREATE TABLE Afspraken (
		userid VARCHAR (50) NOT NULL,
		Werknemer VARCHAR (100) NOT NULL,
		Onderwerp VARCHAR (100) NOT NULL,
		Vraag VARCHAR (900) NOT NULL,
		Datum VARCHAR (100) NOT NULL)");
    // Show if query was succesfull
}
function Werknemers()
{
    // calls data baseconnect function
    $conn = DatabaseConnect();
    //query for database creation
    $result = pg_query($conn, "CREATE TABLE Werknemers (
		userid VARCHAR (50) NOT NULL,
		uidM VARCHAR (100) NOT NULL,
		TypeM VARCHAR (900) NOT NULL,
		email VARCHAR (900) NOT NULL)");
    // Show if query was succesfull
}
// This function closes a connection to the datababase
function DatabaseClose($conn)
{
    // Close database connection
    pg_close($conn);
}
// This function opens a connection to the datababase
function DatabaseConnect()
{
    // Declare connection variables
    $conn_string = "host=localhost port=5432 dbname=bank user=postgres password=GoedeTaartenEtenMensen";
    // Execute connection string
    $conn = pg_connect($conn_string);
    // Return $conn variable
    return $conn;
}
// This function pulls the users username form the session
function GetUsername($Session_name_user)
{
    // Check if session user name is set and not empty
    if (isset($_SESSION[$Session_name_user]) && !empty($_SESSION[$Session_name_user])) {
        // Get encrypted username form session
        $EncryptedUsername = $_SESSION[$Session_name_user];
        // Decrypt the encrypted username
        $DecryptedUsername = base64_Decode($EncryptedUsername);
      // Return the Decrypted username
        return $DecryptedUsername;
    } else {
        // Redirect to login.php
        header("Location: login.php");
    }
}
// This function checks if the users a admin
Function CheckIfAdmin()
{
    // Set users mac addres into a variable
    $MAC = GetMAC();
    // Set users ip addres into a variable
    $IP = GetIP();
    // Set the file name into a variable
    $filename = 'Admins.txt';
    $contents = file($filename);
    // Set a variable found to false
    $found = false;
    // Loop through the file line by line
    foreach ($contents as $admin) {
        // If the current line is the same as the users ip or mac set the found variable then break out of the loop
        if ($admin == $MAC And $admin == $IP) {
            // set the found variable to true
            $found = true;
            // Break out of the loop
            break;
        }
    }
    // Check if the found variable is true
    if ($found) {
        // if found is true then pop up window with the text welkom
        echo '<script type="text/javascript">alert("U bent ingelogd als administrator.");</script>';
	}
	else {
        // If found is false then pop up window and redirect to home
        echo '<script type="text/javascript"> alert("U beschikt niet over administratorrechten. Om toegang te krijgen kunt u contact opnemen met de beheerders van Ritsema Bank.")</script>';
        header("Location: index.php");
    }
}

// This function Logs user out
function LogOut($Session_name_user)
{
    // Delete the session username
    unset($_SESSION[$Session_name_user]);
    // Redirect to index.php
    header("Location: index.php");
}
// This function checks if the user is banned or not
function BannedCheckForBannedPage($IP, $MAC, $Session_banned)
{
    // If users session isnt set and empty then redirect to index.php
    if (!isset($_SESSION[$Session_banned]) && empty($_SESSION[$Session_banned])) {
        // Redirect to index.php
        header("Location: index.php");
    }
    // Declare file
    $contents = file("Banned.txt");
    // Create found variable and set to false
    $found = false;
    // Loop through the file line by line
    foreach ($contents as $line) {
        // Check if line is the same as the ip of the user if yes then redirect
        if ($line == $IP) {
            // Change found variable to true
            $found = true;
        } // Check if line is the same as the mac of the user if yes then redirect
        elseif ($line == $MAC) {
            // Change found variable to true
            $found = true;
        }
    }
    // If found = true meaning user isnt banned then redirect to index.php
    if ($found = false) {
        // Redirect to index.php
        header("Location: index.php");
    }
}
// This function generates a token
function generate_token($token_session)
{
    // Checks if the session is set
    if (!isset($_SESSION[$token_session])) {
        // If not set then create random token and put it in the session
        $_SESSION[$token_session] = md5(uniqid(mt_rand(), true));
    }
}
// This function compares the token fomr hidden field with session token
function CompareToken_mortgage($userid, $Address, $bedrag, $Rekeningnummer, $token_session)
{
    // Get token 1 from post
    $token1 = $_POST['token'];
    // Get token 2 from session
    $token2 = $_SESSION[$token_session];
    // Delete spaces form token 1 string
    $token3 = str_replace(' ', '', $token1);
    // Check if post request is set
    if (!isset($_POST['token'])) {
        // Redirect to index.php
        header("Location: index.php");
    }
    if ($token3 == $token2) {
        // Delete session
        unset($_SESSION[$token_session]);
        // Call addmortgage fucntion
        AddMortgage($userid, $Address, $bedrag, $Rekeningnummer);
        // Redirect to dashboard.php
        header("Location: dashboard.php");
    } else {
        // Redirect to index.php
        header("Location: index.php");
    }
}
// This function gets the user id from the session and decrypts it 
function GetUserID($Session_id_user)
{
    // Get username variable from session
    $e_userid = $_SESSION[$Session_id_user];
    // Decrypt username variable
    $userid = base64_decode($e_userid);
    // Return variable
    return $userid;
}

// This function compares the token fomr hidden field with session token
function CompareToken_Consultant($token_session, $userid)
{
    // Get token 1 from post
    $token1 = $_POST['token'];
    // Get token 2 from session
    $token2 = $_SESSION[$token_session];
    // Delete spaces form token 1 string
    $token3 = str_replace(' ', '', $token1);
    // Check if post request is set
    if (!isset($_POST['token'])) {
        // Redirect to index.php
        header("Location: index.php");
    }
    if ($token3 == $token2) {
        // Delete session
        unset($_SESSION[$token_session]);
        // Get subject variable from post
        $subject = $_POST['subject'];
        // Get question variable from post
        $question = $_POST['question'];
        // Get date variable from post
        $date = $_POST['meetingTime'];
        // Call get advisormeeting function
        getAdvisorMeeting($subject, $question, $date, $userid);
        // Redirect to dashboard.php
        header("Location: dashboard.php");
    } else {
        // Redirect to index.php
        header("Location: index.php");
    }
}
// This function gets the right tilte
function GetTitle($page)
{
    // Changes to right title
    switch($page)
    {
        case "login.php":
            $title = "Login";
            break;
        case  "register.php";
            $title = "Registreren";
            break;
        case "dashboard.php";
            $title = "Dashboard";
            break;
        case "request_mortgage.php";
            $title = "Hypotheekaanvragen";
            break;
        case "index.php";
            $title = "index";
            break;
        case "advisorConsultant.php";
            $title = "Gesprek aanvragen";
            break;
        case "review.php";
            $title = "Hypotheek aanvragen";
            break;
        case "DeleteAll.php";
            $title = "Verwijderen";
            break;
        default:
            $title = "Ritsema";
            break;
    }
// Return the title variable
    return $title;
}
// This function adds mcallagher to the database
function MCallagher()
{
	// This function connects to the database
	$conn = DatabaseConnect();
	$result = pg_prepare($conn, "my_query", "INSERT INTO Werknemers  (userid, uidm,typem, email) VALUES ($1,$2,$3,$4)");
	$result = pg_execute($conn, "my_query", array("1","MCallagher","Hypotheek adviseur","MCallagher@ritsema.frl"));
}
// This function creates all the databases
function Create_all_databases($conn)
{
	echo var_dump($conn);
    DatabaseCreation($conn);
    DatabaseMortgage($conn);
    Afspraken();
    Werknemers();
    MCallagher();
    // DOCUMENTATIE
}
// This function deletes all the user info
function DeleteAllUserInfo($userid,$Session_id_user,$Session_name_user)
{
    // Delete the session username
    unset($_SESSION[$Session_name_user]);
    // Get encrypted user id from sssion
    $encrypted_userid = $_SESSION[$Session_id_user];
	// Decrypt the encrypted username
	$userid = base64_decode($encrypted_userid);
    // This function connects to the database
    $conn = DatabaseConnect();
    // Create perpared statement 
	$delete1 = pg_prepare($conn, "delete1", "DELETE from bank WHERE userid =$1");
	$delete2 = pg_prepare($conn, "delete2", "DELETE from afspraken WHERE userid =$1");
	$delete3 = pg_prepare($conn, "delete3", "DELETE from hypotheken WHERE userid =$1");
	// Executes the prepared statement with the variables
	$delete1 = pg_execute($conn, "delete1", array($userid));
	$delete2 = pg_execute($conn, "delete2", array($userid));
    $delete3 = pg_execute($conn, "delete3", array($userid));
	//This function closes database connection
    DatabaseClose($conn);
    header("Location: index.php");
}
function checkForHarmFullInput($input) {
    if(strpos($input, "<script>") || strpos($input, "1=1") || strpos($input, "1 =1") || strpos($input, "1= 1") || strpos($input, "1 = 1") !== false)
    {
        $IP = GetIP();
        $MAC = GetMAC();
        // Call the ban function
        Ban($IP,$MAC,$Session_banned);
    }
}
?>
