// funtion which enables the login button in login page
function enableButton(){
	var user_email = document.getElementById("email_username").value.trim().length;
	var password = document.getElementById("password").value.trim().length;

	if(user_email > 0 && password > 0){
		document.getElementById("form_button").disabled = false;
	}else{
		document.getElementById("form_button").disabled = true;	
	}
}
// funtion which enables the sign up button in registe page
function enableButtonSignup(){
	var fullName = document.getElementById("fullName").value.trim().length;	
	var username = document.getElementById("username").value.trim().length;	
	var email = document.getElementById("email").value.trim().length;	
	var password = document.getElementById("password").value.trim().length;	
	var passwordConfirm = document.getElementById("password_confirm").value.trim().length;
	var registerAS = document.getElementById("registerAs").value;
	
	if(fullName > 0 && username > 0  && email > 0 && password > 0 && passwordConfirm > 0 && registerAS != ""){
		document.getElementById("form_button").disabled = false;
	}else{
		document.getElementById("form_button").disabled = true;
	}
}

// funtion which validates the login forms
function validateLogInForm(){
	var email_username = document.getElementById("email_username");
	var password = document.getElementById("password");

	// validate login password field 
	if(password.value.trim().length < 1){
		password.focus();
		password.style.border = "1px solid red";
		password.style.color = "red";
		document.getElementById("loginPasswordError").innerHTML = "The Field is required";
		document.getElementById("loginPasswordError").style.color = "red";
		event.preventDefault();
	}else{
		password.style.border = "1px solid #efefef";
		password.style.color = "black";
		document.getElementById("passwordError").innerHTML = "";
	}

	// validate login username_email field 
	if(email_username.value.trim().length < 1){
		email_username.focus();
		email_username.style.border = "1px solid red";
		email_username.style.color = "red";
		document.getElementById("email_usernameError").innerHTML = "The Field is required";
		document.getElementById("email_usernameError").style.color = "red";
		event.preventDefault();
	}else{
		email_username.style.border = "1px solid #efefef";
		email_username.style.color = "black";
		document.getElementById("email_usernameError").innerHTML = "";
	}
} //End of funtion which validates the login forms



// funtion which validates the signup forms
function validateSignUpForm(){
	var fullName = document.getElementById("fullName");
	var username = document.getElementById("username").value.trim();
	var password = document.getElementById("password").value.trim();
	var passwordConfirm = document.getElementById("password_confirm").value.trim();
	var registerAs = document.getElementById("registerAs");
	var email = document.getElementById("email");
	

	// regular expression for username fields
	var usernamePattern = /^([a-zA-Z]+)([0-9]*)-*_*$/ig;
		
	
	// validating password confirm field
	if(passwordConfirm.length < 1){
		document.getElementById("password_confirm").focus();
		document.getElementById("password_confirm").style.border = "1px solid red";
		document.getElementById("password_confirm").style.color = "red";
		document.getElementById("password-confirmError").innerHTML = "The Field is required";
		document.getElementById("password-confirmError").style.color = "red";
		event.preventDefault();
	}else if(password !== passwordConfirm){
		document.getElementById("password_confirm").focus();
		document.getElementById("password_confirm").style.border = "1px solid red";
		document.getElementById("password_confirm").style.color = "red";
		document.getElementById("password-confirmError").innerHTML = "password confirmation does not match";
		document.getElementById("password-confirmError").style.color = "red";
		event.preventDefault();
	}else{
		document.getElementById("password_confirm").focus();
		document.getElementById("password_confirm").style.border = "1px solid #efefef";
		document.getElementById("password_confirm").style.color = "black";
		document.getElementById("password-confirmError").innerHTML = "";
	}

	// validating password field
	if(password.length < 8 ){
		document.getElementById("password").focus();
		document.getElementById("password").style.border = "1px solid red";
		document.getElementById("password").style.color = "red";
		document.getElementById("passwordError").innerHTML = "password must be greater than 8 chars";
		document.getElementById("passwordError").style.color = "red";
		event.preventDefault();
	}else{
		document.getElementById("password").style.border = "1px solid #efefef";
		document.getElementById("password").style.color = "black";
		document.getElementById("passwordError").innerHTML = "";
	}

	//validating RegisterAs field 
	if(registerAs.value.trim().length < 1){
		registerAs.focus();
		registerAs.style.border = "1px solid red";
		document.getElementById("registerAsError").innerHTML = "Please select an option";
		document.getElementById("registerAsError").style.color = "red";
	}else{
		registerAs.style.border = "1px solid #efefef";
		document.getElementById("registerAsError").innerHTML = "";	
	}

	// validating email filed
	if(email.value.trim().length < 1){
		email.focus();
		email.style.border = "1px solid red";
		email.style.color = "red";
		document.getElementById("emailError").innerHTML = "The field is required";
		document.getElementById("emailError").style.color = "red";
	}else{
		email.style.border = "1px solid #efefef";
		email.style.color = "black";
		document.getElementById("emailError").innerHTML = "";	
	}

	// validatng username field
	if(username.length < 4 ){
		document.getElementById("username").focus();
		document.getElementById("username").style.border = "1px solid red";
		document.getElementById("username").style.color = "red";
		document.getElementById("usernameError").innerHTML = "The username must be greater than 3 chars";
		document.getElementById("usernameError").style.color = "red";
		event.preventDefault();
	}else if(!username.match(usernamePattern)){
		document.getElementById("username").focus();
		document.getElementById("username").style.border = "1px solid red";
		document.getElementById("username").style.color = "red";
		document.getElementById("usernameError").innerHTML = "The username may only contain letters, numbers, dashes and underscores. should start with a letter only";
		document.getElementById("usernameError").style.color = "red";
		event.preventDefault();
	}else{
		document.getElementById("username").style.border = "1px solid #efefef";
		document.getElementById("username").style.color = "black";
		document.getElementById("usernameError").innerHTML = "";
	}

	//validating fullName field 
	if(fullName.value.trim().length < 1){
		fullName.focus();
		fullName.style.border = "1px solid red";
		document.getElementById("fullNameError").innerHTML = "The field can not be empty";
		document.getElementById("fullNameError").style.color = "red";
	}else{
		fullName.style.border = "1px solid #efefef";
		document.getElementById("fullNameError").style.color = "black";
		document.getElementById("fullNameError").innerHTML = "";	
	}

} // End of funtion which validates the signup forms 
