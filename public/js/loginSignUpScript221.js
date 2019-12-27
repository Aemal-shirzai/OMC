// reset form
function enableButtonReset(){
	var email = document.getElementById("email").value.trim().length;

	if(email > 0){
		document.getElementById("form_button").disabled = false;
	}else{
		document.getElementById("form_button").disabled = true;	
	}
}
function enableButtonReset2(){
	var email = document.getElementById("email").value.trim().length;
	var pass = document.getElementById("password").value.trim().length;
	var confirm = document.getElementById("password-confirm").value.trim().length;
	if(email > 0 &&  confirm > 0 && pass > 0){
		document.getElementById("form_button").disabled = false;
	}else{
		document.getElementById("form_button").disabled = true;	
	}
}
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
	var usernamePattern = /^([a-zA-Z]+)([0-9]*)([-._]?)([a-zA-Z0-9]+)$/ig;
		
	
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
	}else if(password.length > 60 ){
		document.getElementById("password").focus();
		document.getElementById("password").style.border = "1px solid red";
		document.getElementById("password").style.color = "red";
		document.getElementById("passwordError").innerHTML = "password must be less than 60 chars";
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
	if(username.length < 3 ){
		document.getElementById("username").focus();
		document.getElementById("username").style.border = "1px solid red";
		document.getElementById("username").style.color = "red";
		document.getElementById("usernameError").innerHTML = "The username must be greater than 2 chars";
		document.getElementById("usernameError").style.color = "red";
		event.preventDefault();
	}else if(username.length > 20){
		document.getElementById("username").focus();
		document.getElementById("username").style.border = "1px solid red";
		document.getElementById("username").style.color = "red";
		document.getElementById("usernameError").innerHTML = "The username must not be greater than 20 chars";
		document.getElementById("usernameError").style.color = "red";
		event.preventDefault();
	}else if(!username.match(usernamePattern)){
		document.getElementById("username").focus();
		document.getElementById("username").style.border = "1px solid red";
		document.getElementById("username").style.color = "red";
		document.getElementById("usernameError").innerHTML = "The username may only contain letters, numbers, maximum one dashe or underscore. should start with a letter only and should end with  letters or numbers";
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

// beggining of: the function which open the fileupload input in more info page
	function openFileUploadInput(){
		// var fileUpload = document.getElementById('fileUpload'); 
		fileUpload.disabled = false;
		fileUpload.value ="";
		$("#userProfilePic").show();
		$("#main-img").hide();
		fileUpload.click();
	}
// End of: the function which open the fileupload input in more info page
// Beggining of : the function which select provice based on country and district based on province
function selectProvinceAndDistrict(value){
	// if the inpput which should be select is province . means when country is changed
	if(value == "province"){
		var country = document.getElementById("country").value;
		var province = document.getElementById("province");
		var district = document.getElementById("district");

		if(country.length > 0){
			province.disabled =false;
			province.style.cursor = "pointer";
			province.setAttribute('title',"Choose a province");
			province.style.color = "#6d6161";
			province.innerHTML = "";
			province.innerHTML = "<option value='' selected>Province</option>";
			district.value = "";
			district.disabled = true;
			district.style.cursor = "not-allowed";
			district.style.color = "lightgray";
			district.setAttribute('title',"Choose a provice first");
			district.innerHTML = "<option value='' selected>District</option>";

			
			var countryProvince = eval("province" + country);
			console.log(countryProvince);
			for(var index in countryProvince){
				var openTag = "<option value='"+ index  +"'>";
				var text = countryProvince[index];
				var closeTag = "</option>";
			 	var result = openTag.concat(text,closeTag);
				province.innerHTML += result;
			}

		}else{
			province.disabled =true;
			province.style.cursor = "not-allowed";
			province.style.color = "lightgray";
			province.setAttribute('title',"Choose a country first");
			province.innerHTML = "<option value='' selected>Province</option>"

			district.disabled =true;
			district.style.cursor = "not-allowed";
			district.style.color = "lightgray";
			district.setAttribute('title',"Choose a province first");
			district.innerHTML = "<option value='' selected>District</option>";
		}
	}else if (value == "district"){ // if its province which is chagned and need to enable the selection of district
		var province = document.getElementById("province").value;
		var district = document.getElementById("district");

		if(province.length > 0){
			district.disabled =false;
			district.style.cursor = "pointer";
			district.setAttribute('title',"Choose a district");
			district.style.color = "#6d6161";
			district.innerHTML = "";
			district.innerHTML = "<option value=''>District</option>";

			
			var provinceDistrict = eval("district" + province); //eval change a string into variable name
			for(var index in provinceDistrict){
				var openTag = "<option value='"+ index  +"'>";
				var text = provinceDistrict[index];
				var closeTag = "</option>";
			 	var result = openTag.concat(text,closeTag);
				district.innerHTML += result;
			}
		}else{
			district.disabled =true;
			district.style.cursor = "not-allowed";
			district.style.color = "lightgray";
			district.setAttribute('title',"Choose a province first");
			district.innerHTML = "<option value='' selected>District</option>"
		} // end of : if the no province is selected
	}


}
// End of : the function which select provice based on country and district based on province



// Beggining of : the function to validate the moreInfo form
function validateMoreInfoForm(){
// inputs
	var country = document.getElementById("country");
	var province = document.getElementById("province");
	var district = document.getElementById("district");
	var street = document.getElementById("street");
	var phone = document.getElementById("phone");
	var year = document.getElementById("year");
	var month = document.getElementById("month");
	var day = document.getElementById("day");
	var biography = document.getElementById("biography");

// Error placheholders
	var countryError = document.getElementById("countryError");
	var provinceError = document.getElementById("provinceError");
	var provinceErrorSmall = document.getElementById("provinceErrorSmall");
	var districtErrorSmall = document.getElementById("districtErrorSmall");
	var districtError = document.getElementById("districtError");
	var streetError = document.getElementById("streetError");
	var phoneError = document.getElementById("phoneError");
	var yearError = document.getElementById("yearError");
	var yearErrorSmall = document.getElementById("yearErrorSmall");
	var monthError = document.getElementById("monthError");
	var monthErrorSmall = document.getElementById("monthErrorSmall");
	var dayError = document.getElementById("dayError");
	var dayErrorSmall = document.getElementById("dayErrorSmall");
	var biographyError = document.getElementById("biographyError");

// Regular Expressions
	var validCountryProvinceDistrictDate = /^[0-9]+$/ig;
	var validateStreet = /^[^<>]*\s*$/ig;
	var validPhone = /^([0-9+() ]+)-*([ 0-9-]+)$/ig;

//Begining of bio field validation
	if(biography.value.trim().length > 200){
		biography.focus();
		biographyError.innerHTML = "Too long maximum 200 charachters...";
		biography.style.border="1px solid red";
		event.preventDefault();
	}else{
		biographyError.innerHTML = "";
		biography.style.border="1px solid #efefef";
	}
//End of bio field validation

//Begining of day field validation
	//this means if its empty allow it because the bellow expression does not allow empty
	if(!day.value.trim().match(validCountryProvinceDistrictDate)){
		day.focus();
		dayError.innerHTML = "Invalid Day used...";
		dayErrorSmall.innerHTML = "Invalid Day used...";
		day.style.border="1px solid red";
		event.preventDefault();
	}else{
		dayError.innerHTML = "";
		dayErrorSmall.innerHTML = "";
		day.style.border="1px solid #efefef";
	}
// End of day field validation

//Begining of month field validation
	//this means if its empty allow it because the bellow expression does not allow empty
	if(!month.value.trim().match(validCountryProvinceDistrictDate)){
		month.focus();
		monthError.innerHTML = "Invalid month used...";
		monthErrorSmall.innerHTML = "Invalid month used...";
		month.style.border="1px solid red";
		event.preventDefault();
	}else{
		monthError.innerHTML = "";
		monthErrorSmall.innerHTML = "";
		month.style.border="1px solid #efefef";
	}
// End of month field validation

//Begining of year field validation
	//this means if its empty allow it because the bellow expression does not allow empty
	if(!year.value.trim().match(validCountryProvinceDistrictDate)){
		year.focus();
		yearError.innerHTML = "Invalid Year used...";
		yearErrorSmall.innerHTML = "Invalid Year used...";
		year.style.border="1px solid red";
		event.preventDefault();
	}else{
		yearError.innerHTML = "";
		yearErrorSmall.innerHTML = "";
		year.style.border="1px solid #efefef";
	}
// End of street field validation


//Begining of phone field validation
	//this means if its empty allow it because the bellow expression does not allow empty
	if(phone.value.trim() == ""){
		 true;
		phoneError.innerHTML = "";
		phone.style.border="1px solid #efefef";
	}else if(phone.value.trim().length > 25){
		phone.focus();
		phoneError.innerHTML = "Too long phone number ...";
		phone.style.border="1px solid red";
		event.preventDefault();
	}else if(phone.value.trim().length < 3){
		phone.focus();
		phoneError.innerHTML = "Too short phone number ...";
		phone.style.border="1px solid red";
		event.preventDefault();
	}else if(!phone.value.trim().match(validPhone)){
		phone.focus();
		phoneError.innerHTML = "Invalid charachters used...";
		phone.style.border="1px solid red";
		event.preventDefault();
	}else{
		phoneError.innerHTML = "";
		phone.style.border="1px solid #efefef";
	}
// End of phone field validation

//Begining of street field validation
	//this means if its empty allow it because the bellow expression does not allow empty
	if(street.value.trim() == ""){
		 true;
		streetError.innerHTML = "";
		street.style.border="1px solid #efefef";
	}else if(street.value.trim().length > 200){
		street.focus();
		streetError.innerHTML = "Too long address... ";
		street.style.border="1px solid red";
		event.preventDefault();
	}else if(!street.value.trim().match(validateStreet)){
		street.focus();
		streetError.innerHTML = "Invalid input type ...";
		street.style.border="1px solid red";
		event.preventDefault();
	}else{
		streetError.innerHTML = "";
		street.style.border="1px solid #efefef";
	}
// End of street field validation

// Begining of district field validation
	// this means if its empty allow it because the bellow expression does not allow empty
	if(district.value.trim() == ""){
		true;
		districtError.innerHTML = "";
		districtErrorSmall.innerHTML = "";
		district.style.border="1px solid #efefef";
	}
	else if(!district.value.trim().match(validCountryProvinceDistrictDate)){
		district.focus();
		districtError.innerHTML = "Invalied district name...";
		districtErrorSmall.innerHTML = "Invalied district name...";
		district.style.border="1px solid red";
		event.preventDefault();
	}else{
		districtError.innerHTML = "";
		districtErrorSmall.innerHTML = "";
		district.style.border="1px solid #efefef";
	}
// End of district field validation

// Begining of province field validation
	// this means if its empty allow it because the bellow expression does not allow empty
	if(province.value.trim() == ""){
		 true;
		 provinceError.innerHTML = "";
		 provinceErrorSmall.innerHTML = "";
		 province.style.border="1px solid #efefef";
	}
	else if(!province.value.trim().match(validCountryProvinceDistrictDate)){
		province.focus();
		provinceError.innerHTML = "Invalied province name...";
		provinceErrorSmall.innerHTML = "Invalied province name...";
		province.style.border="1px solid red";
		event.preventDefault();
	}else{
		provinceError.innerHTML = "";
		provinceErrorSmall.innerHTML = "";
		province.style.border="1px solid #efefef";
	}
// End of province field validation


// Begining of country field validation
	// this means if its empty allow it because the bellow expression does not allow empty
	if(country.value.trim() == ""){
		true;
		countryError.innerHTML = "";
		country.style.border="1px solid #efefef";
	}
	else if(!country.value.trim().match(validCountryProvinceDistrictDate)){
		country.focus();
		countryError.innerHTML = "Invalied country name...";
		country.style.border="1px solid red";
		event.preventDefault();
	}else{
		countryError.innerHTML = "";
		country.style.border="1px solid #efefef";
	}
// End of country field validation


}
// End of : the function to validate the moreInfo form


// Begining of: jquery document
$(document).ready(function(){

// Beggining of : the function which is responsibel for previewing the image after its bieng selected by user in more info page
	function showpic(input){
		// alert(input.files);
		if(input.files && input.files[0]){
			var reader = new FileReader();

			reader.onload = function(e){
				$("#img-placeholder").attr("src",e.target.result);	
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
// Beggining of : the function which is responsibel for previewing the image after its bieng selected by user in more info page

// Beggining of : of the jquery function which determine if the fileupload input is changed then call that above function to show it on the screen
	$("#fileUpload").on("change",function(){
		var file = $(this);
		var fileType = file.val().split(".").pop().toLowerCase(); 
		if(file.val() == "" || fileType == "jpg" || fileType == "bmp" || fileType == "jpeg" || fileType == "png" || fileType == "gif" || fileType == "svg"){
			if(this.files[0].size/1024/1024 < 10){
				showpic(this);
				$("#userProfilePic").hide();
				$("#main-img").show();
				$('#invalidFile').hide();
			}else{
				$('#invalidFile').show();
				$("#FileErrorMsg").text("Too large file");
				$(this).val("");
				$("#userProfilePic").show();
				$("#main-img").hide();
				event.preventDefault();
			}
		}else{
			$('#invalidFile').show();
			$("#FileErrorMsg").text("Invalid File Type");
			$(this).val("");
			$("#userProfilePic").show();
			$("#main-img").hide();
			event.preventDefault();
		}
	});
// End of : of the jquery function which determine if the fileupload input is changed then call that above function to show it on the screen
		
		$("#invalidFileCloseBtn").click(function(){
			$('#invalidFile').hide();
		});

// Beggiing of : the function which determine that if the remove image buton is clicked then remove the pic
	$("#removePicture").click(function(){
		$("#fileUpload").val("");
		$("#userProfilePic").show();
		$("#main-img").hide();
	});
// Beggiing of : the function which determine that if the remove image buton is clicked then remove the pic
	

});
// End of : jquery document