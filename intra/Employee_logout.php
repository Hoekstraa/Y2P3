<?php
// Include php files
include "../vendor/Project/Global_functions.php";
unset($_SESSION[$Session_name_employee]);
$IP = $_SERVER['SERVER_ADDR'];
header("Location: https://log:out@$IP");
?>
