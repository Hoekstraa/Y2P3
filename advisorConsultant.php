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
    if ( isset( $_POST['submit'] ) ){
    }


echo '<html lang="nl">';
include("modular/head.php");
echo "<body>";
include("modular/navbar.php");
include("modular/header.php");
echo "<body onload=\"subjectValidation(); questionValidation()\">";
echo "<script src=\"scripts/AdvisorConsultantPageValidation.js\"></script>";
echo"
    <main>
        <form>
            <div class='adviser-box'>
            <H2>Maak een afspraak met een adviseur</H2>
                <div>
                   <label for=\"subject\">Wat is het onderwerp van uw vraag</label><br>
                   <input id=\"subject\" name=\"subject\" type='text'><br><br>
                   <label for=\"question\" >wat is uw vraag</label><br>
                   <textarea id=\"question\" name=\"question\"></textarea><br><br>
                   <input type='datetime-local' id='meeting-time' name='meeting-time'><br><br>
                   <input type='submit' value='Submit'>
           </div>
        </form>
    </main>
";
include("modular/footer.php");
echo "</body>";
echo "</html>";
?>