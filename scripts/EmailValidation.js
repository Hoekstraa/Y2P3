var email;
var username;
var password;
var password2;
function initListeners() {
		email = document.getElementById("email");
		email.addEventListener('input', emailValidation);
		username = document.getElementById("username");
		username.addEventListener('input', usernameValidation);
		password = document.getElementById("password");
		password.addEventListener('input', passwordValidation);
		password2 = document.getElementById("password2");
		password2.addEventListener('input', password2Validation);
}

function usernameValidation() {
		// Empty username
		if (username.value == '') {
				username.classList.remove("valid");
				username.classList.remove("invalid");
				username.classList.add("empty");
				username.style.border = "0.1rem solid #d1d1d1"; 
				username.style.border = "0.1rem solid #d1d1d1"; 
		}
		
		// Valid username
		else if (username.value.length <= 49)
		{
				username.classList.remove("invalid");
				username.classList.remove("empty");
				username.classList.add("valid");
				username.style.border = "0.1rem solid #038A1E;"
				username.style.color = "#038A1E;"
		}
		// Invalid username
		else {
				username.classList.remove("valid");
				username.classList.remove("empty");
				username.classList.add("invalid");
				username.style.border = "0.1rem solid #8A031E !important"
				username.style.color = "#8A031E; !important"
		}
}
// Called when e-mail input changes
function emailValidation() {
		// Empty E-mail
		if (email.value == '') {
				email.classList.remove("valid");
				email.classList.remove("invalid");
				email.classList.add("empty");
				email.style.border = "0.1rem solid #d1d1d1"; 
				email.style.border = "0.1rem solid #d1d1d1"; 
		}
		
		// Valid E-mail
		else if (email.value.length <= 49 && ValidateEmail(email.value))
		{
				email.classList.remove("invalid");
				email.classList.remove("empty");
				email.classList.add("valid");
				email.style.border = "0.1rem solid #038A1E;"
				email.style.color = "#038A1E;"
		}
		// Invalid E-mail
		else {
				email.classList.remove("valid");
				email.classList.remove("empty");
				email.classList.add("invalid");
				email.style.border = "0.1rem solid #8A031E !important"
				email.style.color = "#8A031E; !important"
		}
}

// Returns true on valid e-mail input, false if it's not a valid e-mail address.
function ValidateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(String(email).toLowerCase());
}

function passwordValidation() {
		// Empty input - show gray input box
		if (password.value == '') {
				password.classList.remove("valid");
				password.classList.remove("invalid");
				password.classList.add("empty");
				password.style.border = "0.1rem solid #d1d1d1"; 
				password.style.border = "0.1rem solid #d1d1d1"; 
		}

		// Valid username
		else if (password.value.length <= 49)
		{
				password.classList.remove("invalid");
				password.classList.remove("empty");
				password.classList.add("valid");
				password.style.border = "0.1rem solid #038A1E;"
				password.style.color = "#038A1E;"
		}
		// Invalid username
		else {
				password.classList.remove("valid");
				password.classList.remove("empty");
				password.classList.add("invalid");
				password.style.border = "0.1rem solid #8A031E !important"
				password.style.color = "#8A031E; !important"
		}
}

function password2Validation() {
		if (password2.value == '') {
				password2.classList.remove("valid");
				password2.classList.remove("invalid");
				password2.classList.add("empty");
				password2.style.border = "0.1rem solid #d1d1d1"; 
				password2.style.border = "0.1rem solid #d1d1d1"; 
		}

	else if(password2.value != password.value) {
				password2.classList.remove("valid");
				password2.classList.remove("empty");
				password2.classList.add("invalid");
				password2.style.border = "0.1rem solid #8A031E !important"
				password2.style.color = "#8A031E; !important"
	}
		
		// Valid username
		else if (password2.value.length <= 49)
		{
				password2.classList.remove("invalid");
				password2.classList.remove("empty");
				password2.classList.add("valid");
				password2.style.border = "0.1rem solid #038A1E;"
				password2.style.color = "#038A1E;"
		}
		// Invalid username
		else {
				password2.classList.remove("valid");
				password2.classList.remove("empty");
				password2.classList.add("invalid");
				password2.style.border = "0.1rem solid #8A031E !important"
				password2.style.color = "#8A031E; !important"
		}
}

