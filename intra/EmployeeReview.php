<?php
// Require navbar.php
require "../classes/NavbarItem.php";
// Include php files
include "../vendor/Project/Global_functions.php";
// Get employee data
$username = base64_decode($_SESSION[$Session_name_employee]);
GetEmployeeData($Username);
$navigation = [
	new NavbarItem("Ritsema Banken", "index.php", false),
	new NavbarItem("Hypotheek aanvragen", "request_mortgage.php", true),
    new NavbarItem("Uitloggen", "logout.php", false)
];
echo '<html lang="nl">';
	include("Ihead.php");
	echo "<body>";
		include("Inavbar.php");
        include("Iheader.php");
        echo "
        <main>
        <div align='center' class=\"request-review\">
            <h1>Overzicht van aangevraagde hypotheek </h1>
            <table>
  <tr>
    <th>Werkenemer</th>
    <th>Type</th>
    <th>E-Mail</th>
  </tr>
  <tr>
    <td>$username</td>
    <td>$type</td>
    <td>$email</td>
  </tr>
            <br><br>
        </div>
        <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
    </main>
    ";
    
        include("Ifooter.php");
	echo "</body>";
echo "</html>";

function GetEmployeeData($Username)
{
    // This function connects to the database
    $conn = DatabaseConnect();
    // Create prepared statement
    $UserMail = pg_prepare($conn, "info", "SELECT userid,typeM,email FROM Werknemers WHERE uidm = $1");
    // Execute prepared statement
    $UserMail = pg_execute($conn, "info", array($Username));
        // Get data from sql return
		while ($row = pg_fetch_row($UserMail)) 
		{
			// Get userid from sql query return
            $userid = $row[0];
            $type = $row[1];
            $email = $row[2];
        }
        $GLOBALS[$userid];
        $GLOBALS[$type];
        $GLOBALS[$email];
    // return email variable
    DatabaseClose($conn);
}
// Get mortgages with employee id 
function GetMortages($userid)
{
    $emails = array();
    // This function connects to the database
    $conn = DatabaseConnect();
    // Create prepared statement
    $Mort_info = pg_prepare($conn, "mort", "SELECT HypotheekID,userid,Adres,Bedrag,Rente,Rekeningnummer,Hypotheek_status FROM Hypotheken WHERE Werknemer = $1");
    // Execute prepared statement
    $Mort_info = pg_execute($conn, "mort", array($userid));
    while ($row = pg_fetch_row($Mort_info)) 
		{
            while ($row = pg_fetch_row($UserMail)) 
		{
			// Get userid from sql query return
            echo($row[0]);
            echo($row[1]);
            echo($row[2]);
            echo($row[3]);
            echo($row[4]);
            echo($row[6]);
            echo($row[7]);
        }
        }
}
?>
