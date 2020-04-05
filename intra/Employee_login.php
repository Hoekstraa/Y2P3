<?php
// Include php files
include "../vendor/Project/Global_functions.php";
// Set uid in a session
$Encrypted_uid = base64_encode($_SERVER["AUTHENTICATE_UID"]);
$_SESSION[$Session_name_employee] = $Encrypted_uid;
// Check if user is admin
//CheckIfAdmin(); // Todo rechten aan dit bestand geven!
// Redirect to employee review
header("Location: EmplyeeReview.php");
?>
