<?php 
// Include php files
include "Vendor/Project/Global_functions.php";
// Cal function that deletes the username session
if(isset($_SESSION[$Session_name_user]) && !empty($_SESSION[$Session_name_user])) 
		{
            // Unset the username session
            LogOut($Session_name_user);
			
        }
else
{
    // Redirect to dashboard.php
	header("Location: Index.php");
}
?>