 // var t = /^\S*$/;

// var abc = /^([a-zA-Z]+)([0-9]*)\-*_*\S*$/;
// // var re= /^[a-z]{0,2}$/;
// var text = "f dsafd";

// if(text.match(abc)){
// 	alert("good");
// }else{
// 	alert("not done");
// }


function enableButton(){
	var user_email = document.getElementById("email_username").value.trim().length;
	var password = document.getElementById("password").value.trim().length;

	if(user_email > 0 && password > 0){
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
	
	if(fullName > 0 && username > 0  && email > 0 && password > 0 && passwordConfirm > 0 && registerAS != ""){
		document.getElementById("form_button").disabled = false;
	}else{
		document.getElementById("form_button").disabled = true;
	}

}





function validateSignUpForm(){
	var username = document.getElementById("username").value.trim();
	var password = document.getElementById("password").value.trim();
	var passwordConfirm = document.getElementById("password-confirm").value;
	var email = document.getElementById("email").value.trim().length;

	var usernamePattern = /^([a-zA-Z]+)([0-9]*)-*_*$/ig;
		
	
	if(username.length < 6 ){
		document.getElementById("username").focus();
		document.getElementById("username").style.border = "1px solid red";
		document.getElementById("username").style.color = "red";
		document.getElementById("usernameError").innerHTML = "The username must be greater than 5 chars";
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

	if(password.length < 8 ){
		document.getElementById("password").focus();
		document.getElementById("password").style.border = "1px solid red";
		document.getElementById("password").style.color = "red";
		document.getElementById("passwordError").innerHTML = "password must be greater than 8 chars";
		document.getElementById("passwordError").style.color = "red";
		event.preventDefault();
	}else{
		document.getElementById("password").focus();
		document.getElementById("password").style.border = "1px solid #efefef";
		document.getElementById("password").style.color = "black";
		document.getElementById("passwordError").innerHTML = "";
	}

	if(password !== passwordConfirm){
		document.getElementById("password-confirm").focus();
		document.getElementById("password-confirm").style.border = "1px solid red";
		document.getElementById("password-confirm").style.color = "red";
		document.getElementById("password-confirmError").innerHTML = "password confirmation does not match";
		document.getElementById("password-confirmError").style.color = "red";
		event.preventDefault();
	}else{
		document.getElementById("password-confirm").focus();
		document.getElementById("password-confirm").style.border = "1px solid #efefef";
		document.getElementById("password-confirm").style.color = "black";
		document.getElementById("password-confirmError").innerHTML = "";
	}

}
