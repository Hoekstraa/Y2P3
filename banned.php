<?php
// Recuire php files 
include "vendor/Project/Global_functions.php";

// Check if the user is banned
//BannedCheckForBannedPage($IP,$MAC,$Session_banned);

$navigation = [];

echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/navbar.php");
		include("modular/header.php");
		echo "
			<main>
				<h1>Toegang geweigerd</h1>
				<p>U heeft geen toegang tot de opgevraagde pagina.</p>
			</main>
		";
		include("modular/footer.php");
	echo "</body>";
echo "</html>";
?>
