// ///////////////////////////////////////// /////////////////////////////////////////// ACHIEVEMENTS PART


// Beggining of the function to close the ach form
function showAchDiv(){
	$("#achFormDiv").fadeToggle("fast");
}
// end of the function to close the ach form


// Beggining of the function which opens the photofiled input for ach
function openAchPhotoField(){
	var field = document.getElementById("achPhotoField");
	field.disabled = false;
	$("#achPhotoField").val("");
	$("#ach-imageDiv").hide();
	$("#achPhotoError").text("");
	field.click();
}
// End of the function which opens the photofiled input for ach


// BO the : function responsible for validating the content field and enabling the add ach button
function validateAchContentEnableButton1(){
	// alert("doone");
	var title = document.getElementById("ach_title");
	// var photofield = document.getElementById("achPhotoField");
	// var button = document.getElementById("ach_submit");

	if(title.value.trim().length > 100){
		title.style.border = "1px solid red";
		$("#achTitleError").text("Long title not allowed ...");
	}else if(title.value.trim().length < 1){
		title.style.border = "1px solid red";
		$("#achTitleError").text("The title can not be empty ...");
		event.preventDefault();
	}else{
		title.style.border = "1px solid #ced4da";
		$("#achTitleError").text("");
	}
}
function validateAchContentEnableButton2(){
	var content = document.getElementById("ach_content");
	if(content.value.trim().length > 500){
		content.style.border = "1px solid red";
		$("#achContentError").text("Long description not allowed ...");
	}else if(content.value.trim().length < 1){
		content.style.border = "1px solid red";
		$("#achContentError").text("The description can not be empty ...");
		event.preventDefault();
	}else{
		content.style.border = "1px solid #ced4da";
		$("#achContentError").text("");
	}
}
function validateAchContentEnableButton3(){
	var location = document.getElementById("ach_location");
	if(location.value.trim().length > 100){
		location.style.border = "1px solid red";
		$("#achLocationError").text("Too long location info not allowed ...");
	}else if(location.value.trim().length < 1){
		location.style.border = "1px solid red";
		$("#achLocationError").text("The Location can not be empty ...");
		event.preventDefault();
	}else{
		location.style.border = "1px solid #ced4da";
		$("#achLocationError").text("");
	}
	
}
// EO the : function responsible for validating the content field and enabling the add ach button


// BO the : function responsible for validating the form after submit. called on clicking of submit button
function validateAchForm(){
	// alert("doone");
	var title = document.getElementById("ach_title");
	var content = document.getElementById("ach_content");
	var location = document.getElementById("ach_location");
	var photofield = document.getElementById("achPhotoField");
	// var button = document.getElementById("ach_submit");



	if(location.value.trim().length > 100){
		location.focus();
		location.style.border = "1px solid red";
		$("#achLocationError").text("Too long location info not allowed ...");
		event.preventDefault();
	}else if(location.value.trim().length < 1){
		location.focus();
		location.style.border = "1px solid red";
		$("#achLocationError").text("The Location can not be empty ...");
		event.preventDefault();
	}else{
		location.style.border = "1px solid #ced4da";
		$("#achLocationError").text("");
	}
	
	if(content.value.trim().length > 500){
		content.style.border = "1px solid red";
		content.focus();
		$("#achContentError").text("Too long description not allowed ...");
		event.preventDefault();
	}else if(content.value.trim().length < 1){
		content.focus();
		content.style.border = "1px solid red";
		$("#achContentError").text("The description can not be empty ...");
		event.preventDefault();
	}else{
		content.style.border = "1px solid #ced4da";
		$("#achContentError").text("");
	}
	

	if(title.value.trim().length > 100){
		title.focus();
		title.style.border = "1px solid red";
		$("#achTitleError").text("Too long title not allowed ...");
		event.preventDefault();
	}else if(title.value.trim().length < 1){
		title.focus();
		title.style.border = "1px solid red";
		$("#achTitleError").text("The title can not be empty ...");
		event.preventDefault();
	}else{
		title.style.border = "1px solid #ced4da";
		$("#achTitleError").text("");
	}

}
// EO the : function responsible for validating the form after submit


 // Beggining of th function whihc is responsible to show the image on the screen after beign seleccted
function showAchPic(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();

		reader.onload = function(e){
			$("#achPhotoPlaceHolder").attr("src",e.target.result);	
		}

		reader.readAsDataURL(input.files[0]);
	}
}
// End of th function whihc is responsible to show the image on the screen after beign seleccted

// Beggining of the functio which validate the comment image
function showAndValidateAchFile(){
	var field = document.getElementById("achPhotoField");
	var fileType = field.value.split(".").pop().toLowerCase();

	if(fileType == "jpg" || fileType == "bmp" || fileType == "jpeg" || fileType == "png" || fileType == "gif" || fileType == "svg"){
		if(field.files[0].size/1024/1024 < 10){
			$("#ach-imageDiv").show();
			$("#achPhotoError").text("");
			showAchPic(field);
		}else{
			field.value= "";
			$("#ach-imageDiv").hide();
			$("#achPhotoError").text("File too large. max 10MB...");
			event.preventDefault();
		}
	}else{
		field.value= "";
		$("#ach-imageDiv").hide();
		$("#achPhotoError").text("Invalid file. Only photos are allowed...");
		event.preventDefault();
	}
}
// End of of the functio which validate the comment image


// Beggining of the function which load image from db to achiemvents
function loadImage(value){
	$("#ach-img-div-"+value).fadeIn();
	$("body").css("pointer-events","none");
	$(".closeAchImg").css("pointer-events","initial");
	$(".ach-img-links").css("pointer-events","initial");

	event.preventDefault();
	$.ajax({
		method: "POST",
		url: loadAchImage,
		data:{id:value, _token:token}
	}).done(function(response){
		$("#imgLoad-"+value).hide();
		$("#img-"+value).attr("src", '/Storage/images/achievements/'+response['photo']);
		$("#img-"+value).show();
	});
}
// end of the function which load image from db to achiemvents

function deleteAch(value){
	$('#deleteBox').modal('hide')	
	$("#delButtonIcon").hide();
	$("#delButtonText").text("Deleting");
	$("#achDeleteLoad").show();
	$("#delAchButton").css("background-color",'#e3342f');
	$("#delAchButton").css("border-color",'#e3342f');
	$("#delAchButton").css("color",'white');
	event.preventDefault();
	$.ajax({
		method: "DELETE",
		url:achDelete,
		data:{id:value, _token:token}
	}).done(function(response){
		$("#achDeleteMesssage").show();
		$("#delAchButton").hide();
		$("#achFormDiv").slideUp();
	});
	// achDelete
}