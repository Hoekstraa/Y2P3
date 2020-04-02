var email;
var username;
function initListeners() {
		email = document.getElementById("email");
		email.addEventListener('input', emailValidation);
		username = document.getElementById("username");
		username.addEventListener('input', usernameValidation);
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
