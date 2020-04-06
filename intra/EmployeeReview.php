<?php
// Require navbar.php
require "../classes/NavbarItem.php";
// Include php files
include "../vendor/Project/Global_functions.php";
// Get employee data
$Username = base64_decode($_SESSION[$Session_name_employee]);
list ($userid, $type, $email) = GetEmployeeData($Username);
$navigation = [
	new NavbarItem("Overzicht", "EmployeeReview.php", false),
	new NavbarItem("Uitloggen", "Employee_logout.php", false),
];

$Username_display = htmlspecialchars($Username);
$type_display = htmlspecialchars($type);
$email_display = htmlspecialchars($email);


echo '<html lang="nl">';
	include("Ihead.php");
	echo "<body>";
		include("Inavbar.php");
        include("Iheader.php");
        echo "
        <main>
        <div align='center' class=\"request-review\">
            <h1>Overzicht van: $Username</h1>
            <table>
  <tr>
    <th>Werkenemer</th>
    <th>Type</th>
    <th>E-Mail</th>
  </tr>
  <tr>
    <td>$Username_display</td>
    <td>$type_display</td>
    <td>$email_display</td>
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
GetMorts($userid);
function GetEmployeeData($Username)
{
    // This function connects to the database
    $conn = DatabaseConnect();
    // Create prepared statement
    $UserMail = pg_prepare($conn, "info", "SELECT userid,typem,email FROM Werknemers WHERE uidm = $1");
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
    // Closes database connection
    DatabaseClose($conn);
    // return email variable
    return array ($userid, $type, $email);
}
// Get all the mortgages where the current user is the advisor
function GetMorts($userid)
{
    $conn = DatabaseConnect();
    // Create prepared statement
    $morts = pg_prepare($conn, "mort", "SELECT hypotheekid,userid,adres,bedrag,rente,hypotheek_status FROM Hypotheken WHERE werknemer = $1");
    // Execute prepared statement
    $morts = pg_execute($conn, "mort", array($userid));
    echo "<table>"; // start a table tag in the HTML
    echo"<tr><th>hypotheekid</th><th>userid</th><th>adres</th><th>bedrag</th><th>rente</th><th>hypotheek_status</th></tr>";
    while($row = pg_fetch_row($morts)){   //Creates a loop to loop through results
    echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>". $row[2] . "</td><td>". $row[3] . "</td><td>". $row[4] . "</td><td>". $row[5] . "</td></tr>";  //$row['index'] the index here is a field name
    }
    echo "</table>"; //Close the table in HTML
    // Closes database connection
    DatabaseClose($conn);
}
?>
