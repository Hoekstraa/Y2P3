// Valideer firstname with 2-10 character
function ValidateFirstName(firstname){
    var regex = /^(?=.{2,10}$)[a-zA-Z]+(?:[-' ][a-zA-Z]+)*$/;
    return regex.test(String(firstname).toLowerCase());
}
// Validate lastname with 2-10 characters
function ValidateLastName(lastname){
    var regex = /^(?=.{2,10}$)[a-zA-Z]+$/;
    return regex.test(String(lastname).toLowerCase());
}
// Validate Address
function ValidateAddress(address){
    var regex = /(?=.{1,}$)(?:\d+[a-z]*)$/;
    return regex.test(String(address).toLowerCase());
}
// Validate with postalcode
function ValidatePostalCode(postalcode) {
    var regex = /^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i;
    return regex.test(String(postalcode).toLowerCase());
}
// Valideer telefoonummer
function ValidatePhoneNumber(phonenumber) {
    var regex = /^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/;
    return regex.test(String(phonenumber).toLowerCase());
}

function firstNameValidation() {
    var firstname = document.getElementById("firstname");
    firstname.addEventListener('input', firstNameValidation);
    
    if (firstname.value == '') {
        console.log("empty");
        firstname.classList.remove("valid");
        firstname.classList.remove("invalid");
        firstname.classList.add("empty");
        firstname.style.border = "0.1rem solid #d1d1d1"; 
        firstname.style.border = "0.1rem solid #d1d1d1"; 
    }
    // Valid First Name
    else if (ValidateFirstName(firstname.value))
    {
        console.log("valid");
        firstname.classList.remove("invalid");
        firstname.classList.remove("empty");
        firstname.classList.add("valid");
        firstname.style.border = "0.1rem solid #038A1E;"
        firstname.style.color = "#038A1E;"
    }
    // Invalid First name
    else 
    {
        console.log("invalid");
        firstname.classList.remove("valid");
        firstname.classList.remove("empty");
        firstname.classList.add("invalid");
        firstname.style.border = "0.1rem solid #8A031E !important"
        firstname.style.color = "#8A031E; !important"
    }
}

function lastNameValidation() {
    var lastname = document.getElementById("lastname");
    lastname.addEventListener('input', lastNameValidation);
    
    if (lastname.value == '') {
        console.log("empty");
        lastname.classList.remove("valid");
        lastname.classList.remove("invalid");
        lastname.classList.add("empty");
        lastname.style.border = "0.1rem solid #d1d1d1"; 
        lastname.style.border = "0.1rem solid #d1d1d1"; 
    }
    // Valid last Name
    else if (ValidateLastName(lastname.value))
    {
        console.log("valid");
        lastname.classList.remove("invalid");
        lastname.classList.remove("empty");
        lastname.classList.add("valid");
        lastname.style.border = "0.1rem solid #038A1E;"
        lastname.style.color = "#038A1E;"
    }
    // Invalid Last name
    else 
    {
        console.log("invalid");
        lastname.classList.remove("valid");
        lastname.classList.remove("empty");
        lastname.classList.add("invalid");
        lastname.style.border = "0.1rem solid #8A031E !important"
        lastname.style.color = "#8A031E; !important"
    }
}

function addressValidation(){
    var address = document.getElementById("address");
    address.addEventListener('input', addressValidation);
    
    if (address.value == '') {
        console.log("empty");
        address.classList.remove("valid");
        address.classList.remove("invalid");
        address.classList.add("empty");
        address.style.border = "0.1rem solid #d1d1d1"; 
        address.style.border = "0.1rem solid #d1d1d1"; 
    }
    // Valid Address
    else if (ValidateAddress(address.value))
    {
        console.log("valid");
        address.classList.remove("invalid");
        address.classList.remove("empty");
        address.classList.add("valid");
        address.style.border = "0.1rem solid #038A1E;"
        address.style.color = "#038A1E;"
    }
    // Invalid Address
    else 
    {
        console.log("invalid");
        address.classList.remove("valid");
        address.classList.remove("empty");
        address.classList.add("invalid");
        address.style.border = "0.1rem solid #8A031E !important"
        address.style.color = "#8A031E; !important"
    }
}

function postalCodeValidation(){
    var postalcode = document.getElementById("postalcode");
    postalcode.addEventListener('input', postalCodeValidation);
    
    if (postalcode.value == '') {
        console.log("empty");
        postalcode.classList.remove("valid");
        postalcode.classList.remove("invalid");
        postalcode.classList.add("empty");
        postalcode.style.border = "0.1rem solid #d1d1d1"; 
        postalcode.style.border = "0.1rem solid #d1d1d1"; 
    }
    // Valid Postal code
    else if (ValidatePostalCode(postalcode.value))
    {
        console.log("valid");
        postalcode.classList.remove("invalid");
        postalcode.classList.remove("empty");
        postalcode.classList.add("valid");
        postalcode.style.border = "0.1rem solid #038A1E;"
        postalcode.style.color = "#038A1E;"
    }
    // Invalid Postal code
    else 
    {
        console.log("invalid");
        postalcode.classList.remove("valid");
        postalcode.classList.remove("empty");
        postalcode.classList.add("invalid");
        postalcode.style.border = "0.1rem solid #8A031E !important"
        postalcode.style.color = "#8A031E; !important"
    }
}

function phoneNumberValidation(){
    var phonenumber = document.getElementById("phone-number");
    phonenumber.addEventListener('input', phoneNumberValidation);
    
    if (phonenumber.value == '') {
        console.log("empty");
        phonenumber.classList.remove("valid");
        phonenumber.classList.remove("invalid");
        phonenumber.classList.add("empty");
        phonenumber.style.border = "0.1rem solid #d1d1d1"; 
        phonenumber.style.border = "0.1rem solid #d1d1d1"; 
    }
    // Valid Postal code
    else if (ValidatePhoneNumber(phonenumber.value))
    {
        console.log("valid");
        phonenumber.classList.remove("invalid");
        phonenumber.classList.remove("empty");
        phonenumber.classList.add("valid");
        phonenumber.style.border = "0.1rem solid #038A1E;"
        phonenumber.style.color = "#038A1E;"
    }
    // Invalid Postal code
    else 
    {
        console.log("invalid");
        phonenumber.classList.remove("valid");
        phonenumber.classList.remove("empty");
        phonenumber.classList.add("invalid");
        phonenumber.style.border = "0.1rem solid #8A031E !important"
        phonenumber.style.color = "#8A031E; !important"
    }
}