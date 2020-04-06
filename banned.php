<?php
// Recuire php files 

// Check if the user is banned
BannedCheckForBannedPage($IP,$MAC,$Session_banned);

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
