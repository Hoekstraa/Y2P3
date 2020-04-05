<?php
// Include php files
include "../vendor/Project/Global_functions.php";
if (isset($_SESSION[$Session_name_employee]) && !empty($_SESSION[$Session_name_employee])) {
    unset($_SESSION[$Session_name_employee]);
unset($_SERVER['AUTHENTICATE_UID']);
header("Location: index.php");
}
else
{
    header("Location: index.php");
}


?>