<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "Global_functions.php";
// Get username
$DecryptedUsername = GetUsername($Session_name_user);
// Get status
$status = GetStatus($Session_id_user);
// Check if the user is logged in
CheckIfLoggedIn($Session_name_user,$page);
// Check if the user is banned
CheckIfBanned($IP,$MAC,$Session_banned);

$title = "Home";
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php"),
	new NavbarItem($DecryptedUsername, "Account.php"),
	new NavbarItem("Uitloggen", "logout.php"),
];


echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
		include("modular/header.php");
		echo "
			<main>
			<div class=\"login\">
				<h1>Dashboard</h1>
				<p>Voer uw gegevens in om toegang te verkrijgen tot uw account.</p>
				<div class=\"status\">" . $status . "</div>
				<div class=\"dashboard\">
					<a href=\"request_mortgage.php\" class=\"item\" id=\"hypotheek\">
					<b>
						<i class=\"fas fa-money-check-alt\"></i>
						<br>
						Hypotheek aanvragen
					</b>
					</a>
					<a href=\"advisorConsultant.php\" class=\"item\" id=\"contact\">
					<b>
						<i class=\"fas fa-address-card\"></i>
						<br>
						Contact opnemen
					</b>
					</a>
					<a href=\"logout.php\" class=\"item\" id=\"logout\">
					<b>
						<i class=\"fas fa-sign-out-alt\"></i><br>
						Uitloggen
					</b></div>
					</a>
				</div>
			</div>
		</main>
		";
		include("modular/footer.php");
	echo "</body>";
echo "</html>";

// This function gets the status from the database
function GetStatus($Session_id_user)
{
	// Get userid from session
	$encrypted_userid = $_SESSION[$Session_id_user];
	// Decrypt the encrypted username
	$userid = base64_decode($encrypted_userid);
	// calls data baseconnect function
	$conn = DatabaseConnect();
	// Create perpared statement 
	$result = pg_prepare($conn, "status", "SELECT Hypotheek_status FROM hypotheken WHERE userid = $1");
	// Execute prepared statement with variable
	$result = pg_execute($conn, "status", array($userid));
	// Get data from sql return
	while ($row = pg_fetch_row($result)) 
		{
			// Get userid from sql query return
			$status = $row[0];
	}
	// return status variable
	return $status;
}
?>