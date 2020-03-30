<?php
require "classes/NavbarItem.php";
session_start();

$Firstname = $_SESSION['firstname'];
$Lastname = $_SESSION['lastname'];
$Address = $_SESSION['address'];
$Postalcode = $_SESSION['postalcode'];
$Phonenumber = $_SESSION['phone-number'];
$Emailaddress = $_SESSION['email'];

if ( isset( $_POST['back'] ) ) 
{ 
  //Go back to the request page
  header("Location: request_mortgage.php"); 
}

if ( isset( $_POST['submit'] ) ) 
{ 
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "demo");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO persons (first_name, last_name, email) VALUES ('Peter', 'Parker', 'peterparker@mail.com')";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);

$conn = DatabaseConnect();
// Create perpared statement and executes the statement
$result = pg_prepare($conn, "my_query", "SELECT username,password FROM bank WHERE username = $1 AND password = $2");
$result = pg_execute($conn, "my_query", array($Username,$Passwd));
// Checks if login was succesfull 
$login_check = pg_num_rows($result);
}

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", true),
	new NavbarItem("Bye", "bye.php"),
	new NavbarItem("Login", "login.php"),
	new NavbarItem("Register", "register.php"),
	//"test"
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
                    <label for=\"firstname\">Voornaam</label><br>
                    $Firstname
                    <br><br>
                    <label for=\"lastname\">Achternaam</label><br>
                    $Lastname
                    <br><br>
                    <label for=\"address\">Adres</label><br>
                    $Address
                    <br><br>
                    <label for=\"postalcode\">Postcode</label><br>
                    $Postalcode
                    <br><br>
                    <label for=\"phone-number\">Telefoonnummer</label><br>
                    $Phonenumber
                    <br><br>
                    <label for=\"email\">Emailadres</label><br>
                    $Emailaddress
                    <br><br>
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
?>