function enableButton(){
	var user_email = document.getElementById("email_username").value.trim().length;
	var password = document.getElementById("password").value.trim().length;

	if(user_email >=5 && password >= 8){
		document.getElementById("form_button").disabled = false;
	}else{
		document.getElementById("form_button").disabled = true;	
	}

}

function enableButtonSignup(){
	var fullName = document.getElementById("fullName").value.trim().length;	
	var username = document.getElementById("username").value.trim().length;	
	var email = document.getElementById("email").value.trim().length;	
	var password = document.getElementById("password").value.trim().length;	
	var passwordConfirm = document.getElementById("password-confirm").value.trim().length;
	var registerAS = document.getElementById("registerAS").value;
	
	if(fullName > 0 && username >= 5 && email >= 5 && password >= 8 && passwordConfirm >= 8 && registerAS != ""){
		document.getElementById("form_button").disabled = false;
	}else{
		document.getElementById("form_button").disabled = true;
	}

}

	// alert('done with murtaza');
	// var email_username = document.getElementById('email_username').lenght();
	// var password = document.getElementById('password').lenght();