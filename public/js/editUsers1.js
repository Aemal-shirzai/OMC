
// Beggining of: the function which shows the profile content based on the clicked button
function openContent(evt,value){
	var tabcontent = document.getElementsByClassName("tab-content");
  	for (i = 0; i < tabcontent.length; i++) {
    	tabcontent[i].style.display = "none";
  	}

  	var tablinks = document.getElementsByClassName("tabLinks");
  	for (i = 0; i < tablinks.length; i++) {
    	tablinks[i].className = tablinks[i].className.replace(" active1", "");
  	}

  	 document.getElementById(value).style.display = "block";
 	 evt.currentTarget.className += " active1";

}
// End of: the function which shows the profile content based on the clicked button

// Beggining of: the function which shows the edit page content based on the previous location. ex. after updating settins
function openContent1(tab,value){
	var tabcontent = document.getElementsByClassName("tab-content");
  	for (i = 0; i < tabcontent.length; i++) {
    	tabcontent[i].style.display = "none";
  	}

  	var tablinks = document.getElementsByClassName("tabLinks");
  	for (i = 0; i < tablinks.length; i++) {
    	tablinks[i].className = tablinks[i].className.replace(" active1", "");
  	}

  	 document.getElementById(value).style.display = "block";
 	 $("#"+tab).addClass("active1");

}
// End of: the function which shows the edit page content based on the previous location. ex. after updating settins

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




// Beggging of the function which make sure user change user photo
function changePhotoConfirmation(){
	$("body").css("pointer-events","none");
	$("#changeConfirmationBox").fadeIn();
}

// End of the function which make sure user delete the comment
function changePhotoConfirmationClose(){
	$("#changeConfirmationBox").fadeOut();
	$("body").css("pointer-events","initial");
}
// Beggining of the function which delete comment


// beggining of: the function which open the fileupload input 
	function openphotoField(){
		var fileUpload = document.getElementById('profilePhotoField'); 
		fileUpload.disabled = false;
		fileUpload.value ="";
		fileUpload.click();
	}
// End of: the function which open the fileupload input 







$(document).ready(function(e){

	// The function which upload the photo to server using ajax + validation
	$("#profilePhotoField").change(function(){

		changePhotoConfirmationClose();
		var file = $(this);
		var fileType = file.val().split(".").pop().toLowerCase(); 
		if(file.val() == "" || fileType == "jpg" || fileType == "bmp" || fileType == "jpeg" || fileType == "png" || fileType == "gif" || fileType == "svg"){
			if(this.files[0].size/1024/1024 < 10){
				$("#photoErrorMessage").hide();
				$("#photoErrorMessage").text("");
				$(".image").css("opacity","0.3");
				$("#loading").show();
				$("#changePhotoLink").css({"pointer-events":"none", "opacity":'0.5'});
				$("#uploadPhotoForm").submit();
			}else{
				$("#photoErrorMessage").show();
				$("#photoErrorMessage").css("display","block");
				$("#photoErrorMessage").text("File too large. max 10MB...");
			}
		}else{
			$("#photoErrorMessage").show();
			$("#photoErrorMessage").css("display","block");
			$("#photoErrorMessage").text("Only photos are allowed...");
		}

		// alert($('#uploadPhotoForm').serialize());
	});

	$("#uploadPhotoForm").submit(function(e){
		e.preventDefault();

		 var formData = new FormData(this);

		 $.ajax({
		 	method: "POST",
		 	url: uploadPhoto,
		 	contentType: false,
		 	cache:false,
		 	processData: false,
		 	data:formData
		 }).done(function(response){
		 	$("#loading").hide();
		 	$(".image").css("opacity","1");
		 	$("#changePhotoLink").css({"pointer-events":"initial", "opacity":'1'});
		 	// to check if error array is empty then it means there is not error in the validation part
		 	if($.isEmptyObject(response.error)){
		 		$(".image").hide();
				$("#notImage").hide();
				$(".newImage").show();
				// 
				$(".removeTextAndDivider").hide();	
				$(".removeForAjax").show();	
				//  if type is doctor then load from doctor folder else load it from normal usrs folder
				if(response["owner_type"] == 'App\\Doctor'){
					$(".newImage").attr("src","/Storage/images/doctors/"+response["photoPath"]);
				}else{
					$(".newImage").attr("src","/Storage/images/normalUsers/"+response["photoPath"]);
				}
		 	}else{ // if the error array is not empty it means there is and error
				$("#photoErrorMessage").show();
				$("#photoErrorMessage").css("display","block");
		 		$("#photoErrorMessage").text(response.error);
			}
		 });

	});
// End of the part or funtion whihc upoload and validate use edit profile pic



});
// End of jquery document

function removeprofilePhoto(accountId){
	// alert("done");
	changePhotoConfirmationClose();
	$(".image").css("opacity","0.3");
	$("#loading").show();
	$("#changePhotoLink").css({"pointer-events":"none", "opacity":'0.5'});

	$.ajax({
		method: "DELETE",
		url:removePhoto,
		data:{account_id:accountId, _token:token}


	}).done(function(response){
		$(".image").hide();
		$("#loading").hide();
		$("#photoErrorMessage").hide();
		$("#photoErrorMessage").text("");
		// to hide th remove text and aslo the divider line because there is no photo to remove 
		$(".removeTextAndDivider").hide();	
		// to hide the noimage icon and enable clicking change photo
		$("#notImage").show();
		$("#changePhotoLink").css({"pointer-events":"initial", "opacity":'1'});

	});
}

// Begginng of the functions which display and hide how to add tag info
function showTagInfo(){
	$("#tagInfo").toggle();
}
// End of the functions which display and hide how to add tag info

// Begginng of the functions which display and hide how to add tags
function showTags(){
	$("#tags").toggle();
}
// End of the functions which display and hide how to add tags


// ///////////////////////////////// for edit page
function removeTags(tagId){
	var count = $(":checkbox:checked").length;
	document.getElementById("tag-"+tagId).checked = false;
	document.getElementById("oldTag-"+tagId).style.display = "none";
	$("#tagsCount").text(parseInt($("#tagsCount").text())-1);
	if(count < 7){
		$("#addTagLink").removeClass("errorButton");
		$("#tagsNote").css("color","#9ba1a7");
		$("#tagsErrorMessage").text("");	
	}else{
		
	}
	event.preventDefault();
}




// BO the : function responsible for validating the tags based on checbox changing 
function showAndValidateTagsCountEdit(value){
	var count = $(":checkbox:checked").length;
	$("#oldTag-"+value).hide();
	$("#tagsCount").text(count);
	if(count > 5){
		$("#addTagLink").addClass("errorButton");
		$("#tagsNote").css("color","red");
		$("#tagsErrorMessage").text("Only 5 fields are allowed");	
	}else{
		$("#addTagLink").removeClass("errorButton");
		$("#tagsNote").css("color","#9ba1a7");
		$("#tagsErrorMessage").text("");	
	}
}
//EO the : function responsible for validating the tags based on checbox changing 

// This function validate user profile edit field
function validateProfileEditForm(){
	var fullName = document.getElementById("fullName");
	var country = document.getElementById("country");
	var province = document.getElementById("province");
	var district = document.getElementById("district");
	var biography = document.getElementById("biography")

	// Regular Expressions
	var validateStreet = /^[^<>]*\s*$/ig;
	var validPhone = /^([0-9+() ]+)-*([ 0-9-]+)$/ig;
	
	if($(":checkbox:checked").length > 5){
		$("#addTagLink").addClass("errorButton");
		$("#tags").show();
		$("#tagsNote").css("color","red");
		$("#tagsErrorMessage").text("Only 5 fields are allowed");
		event.preventDefault();
	}

//Begining of bio field validation
	if(biography.value.trim().length > 200){
		biography.focus();
		document.getElementById('bioError').innerHTML = "Too long, maximum 200 charachters...";
		biography.style.border="1px solid red";
		event.preventDefault();
	}else{
		document.getElementById('bioError').innerHTML = "";
		biography.style.border="1px solid #efefef";
	}
//End of bio field validation

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
		streetError.innerHTML = "Invalied address name...";
		street.style.border="1px solid red";
		event.preventDefault();
	}else{
		streetError.innerHTML = "";
		street.style.border="1px solid #efefef";
	}
// End of street field validation


	// validate the address field 
	if(province.value.trim().length < 1){
		if(district.value.trim().length > 0){
			province.focus();
			province.style.border = "1px solid red";
			document.getElementById("addressError").innerHTML = "You have to select a province first";
			event.preventDefault();
		}
	}else{
		province.style.border = "1px solid #efefef";
		document.getElementById("addressError").innerHTML = "";
	}

	if(country.value.trim().length < 1){
		if(province.value.trim().length > 0){
			country.focus();
			country.style.border = "1px solid red";
			document.getElementById("addressError").innerHTML = "You have to select a country first";
			event.preventDefault();
		}
	}else{
		country.style.border = "1px solid #efefef";
		document.getElementById("addressError").innerHTML = "";
	}

	//validating fullName field 
	if(fullName.value.trim().length < 1){
		fullName.focus();
		fullName.style.border = "1px solid red";
		document.getElementById("fullNameError").innerHTML = "The fullName can not be empty";
		event.preventDefault();
	}else if(fullName.value.trim().length > 60){
		fullName.focus();
		fullName.style.border = "1px solid red";
		document.getElementById("fullNameError").innerHTML = "Long input for fullName field";
		event.preventDefault();
	}else{
		fullName.style.border = "1px solid #efefef";
		document.getElementById("fullNameError").innerHTML = "";	
	}


}



// this part is to validate the edit account settings form
function validateAccountForm(){
	var username = document.getElementById("formUsername");
	var usernameError = document.getElementById("usernameError");
	var email = document.getElementById("email");
	var emailError = document.getElementById("emailError");
	var oPhone = document.getElementById("oPhone");
	var oPhoneError = document.getElementById("oPhoneError");
	var pPhone = document.getElementById("pPhone");
	var pPhoneError = document.getElementById("pPhoneError");

	// regex
	var validPhone = /^([0-9+() ]+)-*([ 0-9-]+)$/ig;
	var usernamePattern = /^([a-zA-Z]+)([0-9]*)([-._]?)([a-zA-Z0-9]+)$/ig;

// validate person phone part
//Begining of psersonal phone field validation
	//this means if its empty allow it because the bellow expression does not allow empty
	if(pPhone.value.trim() == ""){
		 true;
		pPhoneError.innerHTML = "";
		pPhone.style.border="1px solid #efefef";
	}else if(pPhone.value.trim().length > 25){
		pPhone.focus();
		pPhoneError.innerHTML = "Long phone number";
		pPhone.style.border="1px solid red";
		event.preventDefault();
	}else if(pPhone.value.trim().length < 3){
		pPhone.focus();
		pPhoneError.innerHTML = "Too short phone number ...";
		pPhone.style.border="1px solid red";
		event.preventDefault();
	}else if(!pPhone.value.trim().match(validPhone)){
		pPhone.focus();
		pPhoneError.innerHTML = "Invalid phone number";
		pPhone.style.border="1px solid red";
		event.preventDefault();
	}else{
		pPhoneError.innerHTML = "";
		pPhone.style.border="1px solid #efefef";
	}
// End of personal phone field validation

//Begining of office phone field validation
	//this means if its empty allow it because the bellow expression does not allow empty
	if(oPhone.value.trim() == ""){
		 true;
		oPhoneError.innerHTML = "";
		oPhone.style.border="1px solid #efefef";
	}else if(oPhone.value.trim().length > 25){
		oPhone.focus();
		oPhoneError.innerHTML = "Long phone number";
		oPhone.style.border="1px solid red";
		event.preventDefault();
	}else if(oPhone.value.trim().length < 3){
		oPhone.focus();
		oPhoneError.innerHTML = "Too short phone number ...";
		oPhone.style.border="1px solid red";
		event.preventDefault();
	}else if(!oPhone.value.trim().match(validPhone)){
		oPhone.focus();
		oPhoneError.innerHTML = "Invalid phone number";
		oPhone.style.border="1px solid red";
		event.preventDefault();
	}else{
		oPhoneError.innerHTML = "";
		oPhone.style.border="1px solid #efefef";
	}
// End of phone field validation


// Begginng of email validation
	if(email.value.trim().length < 1){
		email.focus();
		email.style.border = "1px solid red";
		emailError.innerHTML = "The email can not be empty";
		emailError.style.color = "red";
		event.preventDefault();
	}else{
		email.style.border = "1px solid #efefef";
		emailError.innerHTML = "";	
	}
// End fo email validation

// validatng username field
	if(username.value.trim().length < 3 ){
		username.focus();
		username.style.border = "1px solid red";
		usernameError.innerHTML = "Short username, add atleast 3 charachters";
		event.preventDefault();
	}else if(username.value.trim().length > 20){
		username.focus();
		username.style.border = "1px solid red";
		usernameError.innerHTML = "Long usernames are not supported, max 20 charachters";
		event.preventDefault();
	}else if(!username.match(usernamePattern)){
		username.focus();
		username.style.border = "1px solid red";
		usernameError.innerHTML = "The username may only contain letters, numbers, maximum one dashe or underscore. should start with a letter only and should end with  letters or numbers";
		event.preventDefault();
	}else{
		username.style.border = "1px solid #efefef";
		usernameError.innerHTML = "";
	}
}  //end of main function

function enableAccountBtn(){
	document.getElementsByClassName("accountSubmitButton")[0].disabled = false;
}