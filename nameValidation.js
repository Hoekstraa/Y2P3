function ValidateFirstName(firstname){
    var alphaExp = /^[a-zA-Z]+$/;
    return alphaExp.test(String(firstname).toLowerCase());
}

function ValidateLastName(lastname){
    var alphaExp = /^[a-zA-Z]+$/;
    return alphaExp.test(String(lastname).toLowerCase());
}

function ValidateAddress(address){
    var alphaExp = /^[0-9a-zA-Z]+$/;
    return alphaExp.test(String(address).toLowerCase());
}

function ValidatePostalCode(postalcode) {
    var numericExpression = /^[0-9]+$/;
    return numericExpression.test(String(postalcode).toLowerCase());
}

function ValidatePhoneNumber(phonenumber) {
    var numericExpression = /^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/;
    return numericExpression.test(String(phonenumber).toLowerCase());
}

function ValidateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
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

function emailValidation() {
var email = document.getElementById("email");
email.addEventListener('input', emailValidation);
// Empty E-mail
if (email.value == '') {
    console.log("empty");
    email.classList.remove("valid");
    email.classList.remove("invalid");
    email.classList.add("empty");
    email.style.border = "0.1rem solid #d1d1d1"; 
    email.style.border = "0.1rem solid #d1d1d1"; 
}
// Valid E-mail
else if (ValidateEmail(email.value))
{
    console.log("valid");
    email.classList.remove("invalid");
    email.classList.remove("empty");
    email.classList.add("valid");
    email.style.border = "0.1rem solid #038A1E;"
    email.style.color = "#038A1E;"
}
// Invalid E-mail
else 
{
    console.log("invalid");
    email.classList.remove("valid");
    email.classList.remove("empty");
    email.classList.add("invalid");
    email.style.border = "0.1rem solid #8A031E !important"
    email.style.color = "#8A031E; !important"
    }
}