<?php
// Recuire php files 
require "classes/NavbarItem.php";
// Include php files
include "Global_functions.php";
// Get Username from session
$DecryptedUsername = GetUsername($Session_name_user);
// Get userid
$userid = GetUserID($Session_id_user);
// Generate random token and put it in a session
generate_token($token_session);

$title = "Home";
$navigation = [
    new NavbarItem("Ritsema Banken", "index.php"),
	new NavbarItem($DecryptedUsername, "Account.php"),
	new NavbarItem("Uitloggen", "logout.php"),
];

 $subjectError = $emailError = $dateError = "";
    if (isset( $_POST['submit'] ) ){
        CompareToken_Consultant($token_session,$userid);
    }

echo '<html lang="nl">';
include("modular/head.php");
include("modular/navbar.php");
echo "<body onload=\"subjectValidation(); questionValidation(); dateTimeValidation()\">";
include("modular/header.php");
echo "<script src=\"scripts/AdvisorConsultantPageValidation.js\"></script>";
echo"
    <main>
        <form method=\"post\" action=\"\">
            <div class='adviser-box'>
            <H2>Maak een afspraak met een adviseur</H2>
                <div>
                   <label for=\"subject\">Wat is het onderwerp van uw vraag?</label><br>
                   <input id=\"subject\" name=\"subject\" type='text'><br><br>
                   <label for=\"question\" >Wat is uw vraag?</label><br>
                   <textarea id=\"question\" name=\"question\"></textarea><br><br>
                   <label for=\"Date\" >Datum?</label><br>
                   <input required type=\"date\" id=\"meetingTime\" name=\"meetingTime\"><br><br>
                   <input type=\"hidden\" name=\"token\" value=\" $_SESSION[$token_session] \"\>
                   <input class=\"submit\" type=\"submit\" name=\"submit\" value=\"Submit\">
           </div>
        </form>
    </main>
";
include("modular/footer.php");
echo "</body>";
echo "</html>";

//validates the information and puts it in the database
function getAdvisorMeeting($subject,$question,$date,$userid){
    if(validateInformation($subject,$question,$date)){
        putMeetingInDB($subject,$question,$date,$userid);
    }
}

// puts the validated infromation in to the database and rederects the user
function putMeetingInDB($subject,$question,$date,$userid){
    $werknemer = 1;
    //get user info name last name mailaders ect
    //put the info in the database
    $conn = DatabaseConnect();
    // Create perpared statement 
	$result = pg_prepare($conn, "my_query", "INSERT INTO afspraken(userid,werknemer,onderwerp,vraag, datum) VALUES ($1,$2,$3,$4,$5)");
	// Executes the prepared statement with the variables
	$result = pg_execute($conn, "my_query", array($userid,$werknemer,$subject,$question,$date));
	//This function closes database connection
    DatabaseClose($conn);
    header("Location: dashboard.php");
}

//validates the information
function validateInformation($subject,$question,$date){
    $validinfo = true;
    if(empty($subject)){
        global $subjectError;
        $subjectError = "vul dit in ";
        $validinfo = false;
    }
    elseif(empty($question)){
        global $questionError;
        $questionError = "vul dit in";
        $validinfo = false;
    }
    if(checkforsneakyinput($subject)){
        $validinfo = false;
    }
    if(checkforsneakyinput($question)){
        $validinfo = false;
    }
    return $validinfo;

}
// check for input that can create vulnerabilities
function checkForSneakyInput($input){
    if(strpos($input,"<script>") !==false){
        Ban($IP,$MAC,$Session_banned);
        return true;
    }
}
?>
