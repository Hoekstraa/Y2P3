<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "Global_functions.php";
// Check if the user is banned
//BannedCheckForBannedPage($IP,$MAC,$Session_banned);

$title = "Home";
if($DecryptedUsername) {
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php"),
	new NavbarItem("Bye", "bye.php"),
	new NavbarItem($DecryptedUsername, "Account.php"),
	new NavbarItem("Uitloggen", "logout.php"),
];
}
else {
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php"),
	new NavbarItem("Bye", "bye.php"),
	new NavbarItem("Uitloggen", "logout.php"),
];
}


echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
		include("modular/header.php");
		echo "
			<main>
				<h1>Error 404</h1>
				<p>De opgevraagde pagina is niet beschikbaar.</p>
			</main>
		";
		include("modular/footer.php");
	echo "</body>";
echo "</html>";
?>
