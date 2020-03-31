<?php
require "classes/NavbarItem.php";

$title = "Home";
$navigation = [
    new NavbarItem("Ritsema Banken", "index.php", true),
    new NavbarItem("Bye", "bye.php"),
    new NavbarItem("Login", "login.php"),
    new NavbarItem("Register", "register.php"),
    //"test"
];

 $subjectError = $emailError = $dateError = "";
    if (isset( $_POST['submit'] ) ){
        $subject = $_POST['subject'];
        $question = $_POST['question'];
        $date = $_POST['meetingTime'];
        getAdvisorMeeting($subject,$question,$date);
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
                   <label for=\"subject\">Wat is het onderwerp van uw vraag</label><br>
                   <input id=\"subject\" name=\"subject\" type='text'><br><br>
                   <label for=\"question\" >wat is uw vraag</label><br>
                   <textarea id=\"question\" name=\"question\"></textarea><br><br>
                   <input required type=\"date\" id=\"meetingTime\" name=\"meetingTime\"><br><br>
                   <input class=\"submit\" type=\"submit\" name=\"submit\" value=\"Submit\">
           </div>
        </form>
    </main>
";
include("modular/footer.php");
echo "</body>";
echo "</html>";

function getAdvisorMeeting($subject,$question,$date){
    if(validateInformation($subject,$question,$date)){
        putMeetingInDB($subject,$question,$date);
    }
}
function putMeetingInDB($subject,$question,$date){
    // get user info name last name mailaders ect
    //put the info in the database
    header("Location: index.php");
}

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
function checkforsneakyinput($input){
    if(strpos($input,"<script>") !==false){

        header("Location: login.php");
        return true;
    }

}
?>
