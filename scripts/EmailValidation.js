// Called when e-mail input changes
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
		else {
				console.log("invalid");
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

