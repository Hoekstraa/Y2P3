<?php


namespace Vendor\Project;


class advisorConsultant
{
    function validateInformation($subject,$question,$date){
        // Set validinfo variable to true
        $validinfo = true;
        // Check if subject variable is empty
        if(empty($subject) || strlen($subject) > 200){
            // Create global variable subject error
            global $subjectError;
            // Set subject error variable data to vul dit in
            $subjectError = "vul dit in ";
            // Change valid info variable to false
            $validinfo = false;
        }
        // Check if question variable is empty
        elseif(empty($question) || strLen($question) > 3000){
            // Set global question error variable
            global $questionError;
            // Set question error variable data to vul dit in
            $questionError = "vul dit in";
            // Change validinfo variable to false
            $validinfo = false;
        }
        // Check if sneaky input function returns true
        if($this->CheckForHarmfullInput($subject)){
            // Change valid info variable to false
            $validinfo = false;
        }
        // Check if sneaky input function returns true
        if($this->CheckForHarmfullInput($question)){
            // Change valid info variable to false
            $validinfo = false;
        }
        // Return valid info variable
        return $validinfo;

    }
// This function checks for input that can create vulnerabilities
    public function CheckForHarmfullInput($input){
        // Check if string contains <script>
        if(strpos($input,"<script>") !==false){
            // Call ban function
            //Ban($IP,$MAC,$Session_banned);
            // Return true
            return true;
        }
        return false;
    }
    function hihi(){
        return "hi";
    }
}