<?php
// Include php files
include "vendor/Project/Global_functions.php";

if ( isset( $_POST['submit'] ) ) 
{ 
    DeleteAllUserInfo($userid,$Session_id_user);
}

echo '<html lang="nl">';
	include("modular/head.php");
	echo "<body>";
		include("modular/header.php");
		echo "
            <main>
            <form method=\"post\"> 
            <label for=\"Info\">Weet u zeker dat u al uw gegevens wilt verwijderen. Dit kan niet ongedaan worden!</label><br>
            <br>
            <input class=\"submit\" name=\"submit\" type=\"submit\" value=\"Verwijderen\"></input>
            </form>
		</main>
		";
		include("modular/footer.php");
	echo "</body>";
echo "</html>";
?>