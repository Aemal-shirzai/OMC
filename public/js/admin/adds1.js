// function to reset all form errors and messages
function resetErrors(type){
	if(type == "addForm"){
		var title = document.getElementById("ads_title");
		var content = document.getElementById("ads_content");
		var category = document.getElementById("ads_category");
		var photofield = document.getElementById("adsPhotoField");
		content.style.border = "1px solid #ced4da";
		title.style.border = "1px solid #ced4da";
		category.style.border = "1px solid #ced4da";
		$("#adsContentError").text("");
		$("#adsTitleError").text("");
		$("#adsCategoryError").text("");
		$("#adsPhotoError").text("");
		$(".alert").hide();
		$("#adsUpdateormDiv").hide();
	}else if(type == "updateForm"){
		
		var title = document.getElementById("ads_update_title");
		var content = document.getElementById("ads_update_content");
		var category = document.getElementById("ads_update_category");
		var photofield = document.getElementById("adsUpdatPhotoField");
		content.style.border = "1px solid #ced4da";
		title.style.border = "1px solid #ced4da";
		category.style.border = "1px solid #ced4da";
		$("#adsContentUpdateError").text("");
		$("#adsTitleUpdateError").text("");
		$("#adsCategoryUpdateError").text("");
		$("#adsPhotoUpdateError").text("");
		$(".alert").hide();
		$("#adsFormDiv").hide();
	}
}


// function which opens the all cat list
function openCatList(){
	$("#adsCategoryContent").slideToggle("fast");
	if($("#openCatIcon").hasClass("fa-chevron-down")){
		$("#openCatIcon").removeClass("fa-chevron-down");
		$("#openCatIcon").addClass("fa-chevron-up");
	}else{
		$("#openCatIcon").removeClass("fa-chevron-up");
		$("#openCatIcon").addClass("fa-chevron-down");
	}
}

// function to open ads cat form
function openAddCatForm(){
	$(".alert").hide();
	$("#cFormDivAdd").fadeIn();
	$("#formField").focus();
	$("body").css("pointer-events","none");
}

// function to close form
function closeForm(value){
	$("#formField").removeClass("errorForm");
	$(".errors").text("");
	$(".done").text("");
	if(value === "Cadd"){
		document.getElementById("adsCategoryAddForm").reset();
		$("#cFormDivAdd").hide();
	}
	if(value === "Cupdate"){
		document.getElementById("adsCategoryUpdateForm").reset();
		$("#cFormDivUpdate").hide();
	}
	$("body").css("pointer-events","initial");
}

// function which open  edit the form for ads categoires
function openUpdateForm(id){
	$("#deleteLoad").show();
	$("body").css("pointer-events","none");
	$.ajax({
		method: "GET",
		url: adCatEdit,
		data:{id:id,_token:token}
	}).done(function(response){
		$("#deleteLoad").hide();
		if(!$.isEmptyObject(response.category)){
			$("#cFormDivUpdate").fadeIn();	
			$("#formFieldUpdate").focus();
			$("#formFieldUpdate").val(response.category['category']);	
			$("#cat_id").val(response.category['id']);
		}
	}).fail(function(response){
		$("#deleteLoad").hide();
		alert("fail");
	});
}





$(document).ready(function(e){

	// alert($("#adsCategoryContent a").length);	

	// To add dcategories using ajax
	$("#adsCategoryAddForm").submit(function(e){
		//validation part
		if($("#formField").val().trim().length < 1){
			$("#formField").addClass("errorForm");
			$(".errors").text("The field can not be empty");
			 $("#formField").focus();
			return false;
		}else if($("#formField").val().trim().length < 3){
			$("#formField").addClass("errorForm");
			$(".errors").text("The category must be at least 3 characters");
			 $("#formField").focus();
			return false;
		}else if($("#formField").val().trim().length > 60){
			$("#formField").addClass("errorForm");
			$(".errors").text("The category may not be greater than 60 characters.");
			 $("#formField").focus();
			return false;
		}else{
			$("#formField").removeClass("errorForm");
			$(".errors").text("");
		}

		//ajax request part
		$(".errors").text("");
		$(".done").text("");
		$("#formField").removeClass("errorForm");
		$(".addLoad").show();
		$("#submitButtonAddCat").attr('value','Adding ...')
		$("#submitButtonAddCat").attr('disabled','true')
		event.preventDefault();

		var formData = $(this).serialize();
		$("#formField").attr("disabled","true");
		$.ajax({
			method: "POST",
			url: adCatStore,
			data: formData,
		}).done(function(response){
			$("#submitButtonAddCat").attr('value','Add')
			$("#submitButtonAddCat").removeAttr("disabled");
			$("#formField").removeAttr("disabled");
			$(".addLoad").hide();

			if($.isEmptyObject(response.errors)){
				$(".done").text("category Added!")
				$(".errors").text("")
				 $("#formField").focus();

				document.getElementById("adsCategoryAddForm").reset();
				if($("#adsCategoryContent a").length > 0){
					$("#adsCategoryContent a:first").before("<a href='javascript:void(0)' class='categories' onclick='openUpdateForm("+ response.data['id'] +")' id='row-"+ response.data['id'] +"'><button class='close'><span class='far fa-edit'></span></button>"+ response.data['category'] +"</a>")
				}else if($("#adsCategoryContent a").length < 1){
					$("#adsCategoryContent").append("<a href='javascript:void(0)' class='categories'><button class='close' onclick='openUpdateForm("+ response.data['id'] +")' id='row-"+ response.data['id'] +"'><span class='far fa-edit'></span></button>"+ response.data['category'] +"</a>");
					$("#noCategory").hide();
				}

				$("#row-"+response.data['id']).after("<div class='confirmationBox' id='messageConfirmationBox-"+ response.data['id'] +"'><div class='text'>Are You Sure To Delete?</div><div class='text'><small>Remember: There is no comeback</small></div> <a href='javascript:void(0)' onclick='deleteMessages("+ response.data['id'] +")' class='btn btn-danger btn-sm'>Delete</a><a href='javascript:void(0)' onclick='messageClosePermissionBox("+ response.data['id'] +")' class='btn btn-light btn-sm'>Cancel</a></div>");
			}else{
				 $("#formField").focus();
				 $(".errors").text(response.errors['category']);
				 $(".done").text("");
				 $("#formField").addClass("errorForm");
			}
		}).fail(function(response){
			$("#submitButtonAddCat").attr('value','Add')
			$("#submitButtonAddCat").removeAttr("disabled");
			$("#formField").removeAttr("disabled");
			$(".addLoad").hide();
			$(".errors").text("oops! something went wrong!");
			$(".done").text("");
		});
	});


	// to update ads form using ajax
	$("#adsCategoryUpdateForm").submit(function(e){
		// validation part
		if($("#formFieldUpdate").val().trim().length < 1){
			$("#formFieldUpdate").addClass("errorForm");
			$(".errors").text("The field can not be empty");
			 $("#formFieldUpdate").focus();
			return false;
		}else if($("#formFieldUpdate").val().trim().length < 3){
			$("#formFieldUpdate").addClass("errorForm");
			$(".errors").text("The category must be at least 3 characters");
			 $("#formFieldUpdate").focus();
			return false;
		}else if($("#formFieldUpdate").val().trim().length > 60){
			$("#formFieldUpdate").addClass("errorForm");
			$(".errors").text("The category may not be greater than 60 characters.");
			 $("#formFieldUpdate").focus();
			return false;
		}else{
			$("#formFieldUpdate").removeClass("errorForm");
			$(".errors").text("");
		}

		e.preventDefault();
		var formData = $(this).serialize();
		console.log(formData);
		$(".addLoad").show();
		$("#submitButtonUpdateCat").attr('value','Updating ...');
		$("#submitButtonUpdateCat").attr('disabled','true');
		$("#formFieldUpdate").attr("disabled","true");
		$(".errors").text("");
		$("#formFieldUpdate").removeClass("errorForm");

		$.ajax({
			method: "PUT",
			url:adCatUpdate,
			data: formData,
		}).done(function(response){
			$(".addLoad").hide();
			$("#submitButtonUpdateCat").attr('value','Update');
			$("#submitButtonUpdateCat").removeAttr('disabled');
			$("#formFieldUpdate").removeAttr('disabled');
			if(!$.isEmptyObject(response.errors)){
				$(".errors").text(response.errors["category"]);
				$("#formFieldUpdate").focus();
				$("#formFieldUpdate").addClass("errorForm");
			}else{
				$("body").css("pointer-events","initial");
				$("#cFormDivUpdate").fadeOut();	
				$("#row-"+ response.data['id']).after("<a href='javascript:void(0)' class='categories' onclick='openUpdateForm("+ response.data['id'] +")' id='row-"+ response.data['id'] +"'><button class='close'><span class='far fa-edit'></span></button>"+ response.data['category'] +"</a>");
				$("#row-"+response.data['id']).remove();
			}

		}).fail(function(response){
			$(".addLoad").show();
			$("#submitButtonUpdateCat").attr('value','Updating ...');
			$("#submitButtonUpdateCat").removeAttr('disabled');
			$("#formFieldUpdate").removeAttr('disabled');
		});
	});


});



// to open message delete confirmation box
function openMessageConfirmation(){
	var id = $("#cat_id").val();
	$("body").css("pointer-events","none");
	$("#messageConfirmationBox-"+id).fadeIn();
}

// to close message delete confrimation box
function messageClosePermissionBox(id){
	$("body").css("pointer-events","initial");
	$("#messageConfirmationBox-"+id).fadeOut();
}

// Beggining of the function which delete messaes
function deleteMessages(id){
	messageClosePermissionBox(id);
	closeForm("Cupdate");
	$("#row-"+id).text("Deleting...");
	$("#row-"+id).css({"color":"red","opacity":"0.5"});
	$.ajax({
		method: "DELETE",
		url: adCatDelete,
		data:{id:id,_token:token}
	}).done(function(){
		$("#row-"+id).slideUp();
		$("#row-"+id).remove();
		$("#messageConfirmationBox-"+id).remove();
	});
}


// ///////////////////////////////////////// /////////////////////////////////////////// advertisment add form PART



// Beggining of the function to close the ads form
function closeAds(){
	document.getElementById("resetAdsForm").click();
	$("#adsFormDiv").fadeOut("fast");
	$("#ads-imageDiv").hide();
}
// end of the function to close the ads form

// Beggining of the function to close the ads form
function showAdsDiv(){
	resetErrors('addForm');
	$("#adsFormDiv").fadeToggle("fast");
}
// end of the function to close the ads form


// Beggining of the function which opens the photofiled input for ads
function openAdsPhotoField(){
	var field = document.getElementById("adsPhotoField");
	field.disabled = false;
	$("#adsPhotoField").val("");
	$("#ads-imageDiv").hide();
	$("#adsPhotoError").text("");
	field.click();
}
// End of the function which opens the photofiled input for ads


// BO the : function responsible for validating the content field and enabling the add ach button
function validateAdsContentEnableButton1(){
	// alert("doone");
	var title = document.getElementById("ads_title");
	// var photofield = document.getElementById("achPhotoField");
	// var button = document.getElementById("ach_submit");

	if(title.value.trim().length > 100){
		title.style.border = "1px solid red";
		$("#adsTitleError").text("Too long title not allowed ...");
	}else if(title.value.trim().length < 1){
		title.style.border = "1px solid red";
		$("#adsTitleError").text("The title can not be empty ...");
		event.preventDefault();
	}else{
		title.style.border = "1px solid #ced4da";
		$("#adsTitleError").text("");
	}
}
function validateAdsContentEnableButton2(){
	var content = document.getElementById("ads_content");
	if(content.value.trim().length > 500){
		content.style.border = "1px solid red";
		$("#adsContentError").text("Too long description not allowed ...");
	}else if(content.value.trim().length < 1){
		content.style.border = "1px solid red";
		$("#adsContentError").text("The description can not be empty ...");
		event.preventDefault();
	}else{
		content.style.border = "1px solid #ced4da";
		$("#adsContentError").text("");
	}
}


// BO the : function responsible for validating the form after submit
function validateAdsForm(){
	// alert("doone");
	var title = document.getElementById("ads_title");
	var content = document.getElementById("ads_content");
	var category = document.getElementById("ads_category");
	var photofield = document.getElementById("adsPhotoField");


	if(photofield.value.trim().length < 1 ){
		$("#adsPhotoError").text("Image is required ...");
		event.preventDefault();
	}
	
	if(content.value.trim().length > 500){
		content.style.border = "1px solid red";
		content.focus();
		$("#adsContentError").text("Too long description not allowed ...");
		event.preventDefault();
	}else if(content.value.trim().length < 1){
		content.focus();
		content.style.border = "1px solid red";
		$("#adsContentError").text("The description can not be empty ...");
		event.preventDefault();
	}else{
		content.style.border = "1px solid #ced4da";
		$("#adsContentError").text("");
	}



	if(category.value.trim().length < 1){
		category.style.border = "1px solid red";
		category.focus();
		$("#adsCategoryError").text("category must be selected ...");
		category.style.border = "1px solid red";
		event.preventDefault();
	}else{
		category.style.border = "1px solid #ced4da";
		$("#adsCategoryError").text("");

	}

	

	if(title.value.trim().length > 100){
		title.focus();
		title.style.border = "1px solid red";
		$("#adsTitleError").text("Too long title not allowed ...");
		event.preventDefault();
	}else if(title.value.trim().length < 1){
		title.focus();
		title.style.border = "1px solid red";
		$("#adsTitleError").text("The title can not be empty ...");
		event.preventDefault();
	}else{
		title.style.border = "1px solid #ced4da";
		$("#adsTitleError").text("");
	}

}


 // Beggining of th function whihc is responsible to show the image on the screen after beign seleccted
function showAchPic(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();

		reader.onload = function(e){
			$("#adsPhotoPlaceHolder").attr("src",e.target.result);	
		}

		reader.readAsDataURL(input.files[0]);
	}
}
// End of th function whihc is responsible to show the image on the screen after beign seleccted

// Beggining of the functio which validate  image
function showAndValidateAdsFile(){
	var field = document.getElementById("adsPhotoField");
	var fileType = field.value.split(".").pop().toLowerCase();

	if(fileType == "jpg" || fileType == "bmp" || fileType == "jpeg" || fileType == "png" || fileType == "gif" || fileType == "svg"){
		if(field.files[0].size/1024/1024 < 10){
			$("#ads-imageDiv").show();
			$("#adsPhotoError").text("");
			showAchPic(field);
		}else{
			field.value= "";
			$("#ads-imageDiv").hide();
			$("#adsPhotoError").text("File too large. max 10MB...");
			event.preventDefault();
		}
	}else{
		field.value= "";
		$("#ads-imageDiv").hide();
		$("#adsPhotoError").text("Invalid file. Only photos are allowed...");
		event.preventDefault();
	}
}
// End of of the functio which validate  image

// Beggining of the function which Remove the comment image when click remove image
function removeAdsImage(){
	var field = document.getElementById("adsPhotoField");
	$("#adsPhotoField").val("");
	field.disabled = true;
	$("#ads-imageDiv").hide();
	event.preventDefault();
}
// Endof of the function which Remove the comment image when click remove image


// function to show details for ads
function toggleDetails(id){
	$("#ads-details-"+id).toggle();
}

function closeReadMore(){
	$("#readmorediv").fadeOut("fast");
	$("body").css("pointer-events","initial");
}


function readMore(id){
	event.preventDefault();
	$("#readmorediv").fadeIn("fast");
	$("#readmoreLoad").show();
	$("body").css("pointer-events","none");

	$.ajax({
		method: "GET",
		url: readFull,
		data:{id:id,_token:token}
	}).done(function(response){
		if(!$.isEmptyObject(response.data)){
			$("#readmoreHeading").text(response.data["title"]);
			$("#readmoredivContent").text(response.data["content"]);
			$("#readmoreLoad").hide();
		}
	}).fial(function(response){
		alert("fail");
	});
}


// function to show the confirmation box for ads
function showAdsDeleteConfirmation(id){
	$("#adsConfirmationBox-"+id).fadeIn("fast");
	$("body").css("pointer-events","none");
}

// close  confirmation box for ads
function closeAdsDeleteConfirmation(id){
	$("#adsConfirmationBox-"+id).fadeOut("fast");
	$("body").css("pointer-events","initial");
}

// function delete ads using ajax
function deleteAds(id){
	closeAdsDeleteConfirmation(id);
	$("#deleteAdsIcon-"+id).text("Deleting...");
	$("#deleteAdsIcon-"+id).css("color","red");

	$.ajax({
		method: "DELETE",
		url:adsDelete,
		data:{id:id,_token:token}
	}).done(function(response){
		$("#ads-"+id).remove();
	}).fail(function(response){

	});

}


// to close the update from
function closeAdsUpdate(){
	document.getElementById("resetAdsUpdateForm").click();
	$("#adsUpdateormDiv").fadeOut("fast");
	$("#ads-imageDiv").hide();
}


// function load data to edit form of advertisemnt
function loadEditData(id){
	resetErrors("updateForm");
	$("#adsUpdateormDiv").fadeIn();
		$("html,body").animate({
	scrollTop: $("#adsUpdateormDiv").offset().top-110},"fast");
	$("#updateLoad").show();
	$("#adsUpdateormDiv").css("pointer-events","none");
	$.ajax({
		method: "GET",
		url:adsEdit,
		data:{id:id,_token:token}
	}).done(function(response){
		$("#updateLoad").hide();
		$("#adsUpdateormDiv").css("pointer-events","initial");
		if(!$.isEmptyObject(response.data)){
			$("#ads_update_title").val(response.data['title']);
			$("#ads_update_content").val(response.data['content']);
			$("#ads_update_id").val(response.data['id']);
			$("#ads_update_category option[value='"+ response.data['advertisement_category_id'] +"']").prop("selected",true);
			$("#ads_update_year option[value='"+ response.year +"']").prop("selected",true);
			$("#ads_update_month option[value='"+ response.month +"']").prop("selected",true);
			$("#ads_update_day option[value='"+ response.day +"']").prop("selected",true);
			if(response.path !== "empty"){
				$("#ads-update-imageDiv").show();
				$("#adsPhotoUpdatePlaceUpdateHolder").attr("src","/Storage/images/advertisements/"+response.path);
			}
		}
	}).fail(function(response){
		$("#updateLoad").hide();
		$("#adsUpdateormDiv").css("pointer-events","initial");
		alert("not done");
	});
}

// BO the : function responsible for validating the content field and enabling the add ach button
function validateAdsUpdateContentEnableButton1(){
	// alert("doone");
	var title = document.getElementById("ads_update_title");
	// var photofield = document.getElementById("achPhotoField");
	// var button = document.getElementById("ach_submit");

	if(title.value.trim().length > 100){
		title.style.border = "1px solid red";
		$("#adsTitleUpdateError").text("Too long title not allowed ...");
	}else if(title.value.trim().length < 1){
		title.style.border = "1px solid red";
		$("#adsTitleUpdateError").text("The title can not be empty ...");
		event.preventDefault();
	}else{
		title.style.border = "1px solid #ced4da";
		$("#adsTitleUpdateError").text("");
	}
}
function validateAdsUpdateContentEnableButton2(){
	var content = document.getElementById("ads_update_content");
	if(content.value.trim().length > 500){
		content.style.border = "1px solid red";
		$("#adsContentUpdateError").text("Too long description not allowed ...");
	}else if(content.value.trim().length < 1){
		content.style.border = "1px solid red";
		$("#adsContentUpdateError").text("The description can not be empty ...");
		event.preventDefault();
	}else{
		content.style.border = "1px solid #ced4da";
		$("#adsContentUpdateError").text("");
	}
}



// Beggining of the function which opens the photofiled input for ads
function openAdsUpdatePhotoField(){
	var field = document.getElementById("adsUpdatePhotoField");
	field.disabled = false;
	$("#adsUpdatePhotoField").val("");
	$("#ads-Update-imageDiv").hide();
	$("#adsUpdatePhotoError").text("");
	field.click();
}
// End of the function which opens the photofiled input for ads


 // Beggining of th function whihc is responsible to show the image on the screen after beign seleccted
function showadsUpdatePic(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();

		reader.onload = function(e){
			$("#adsPhotoUpdatePlaceUpdateHolder").attr("src",e.target.result);	
		}

		reader.readAsDataURL(input.files[0]);
	}
}
// End of th function whihc is responsible to show the image on the screen after beign seleccted

// Beggining of the functio which validate  image
function showAndValidateAdsUpdateFile(){
	var field = document.getElementById("adsUpdatePhotoField");
	var fileType = field.value.split(".").pop().toLowerCase();

	if(fileType == "jpg" || fileType == "bmp" || fileType == "jpeg" || fileType == "png" || fileType == "gif" || fileType == "svg"){
		if(field.files[0].size/1024/1024 < 10){
			$("#ads-update-imageDiv").show();
			$("#adsPhotoUpdateError").text("");
			showadsUpdatePic(field);
		}else{
			field.value= "";
			$("#ads-update-imageDiv").hide();
			$("#adsPhotoUpdateError").text("File too large. max 10MB...");
			event.preventDefault();
		}
	}else{
		field.value= "";
		$("#ads-update-imageDiv").hide();
		$("#adsPhotoUpdateError").text("Invalid file. Only photos are allowed...");
		event.preventDefault();
	}
}
// End of of the functio which validate  image

// Beggining of the function which Remove the comment image when click remove image
function removeAdsUpdateImage(){
	var field = document.getElementById("adsUpdatePhotoField");
	$("#adsUpdatePhotoField").val("");
	field.disabled = true;
	$("#ads-update-imageDiv").hide();
	event.preventDefault();
}
// Endof of the function which Remove the comment image when click remove image

// EO the : function responsible for validating the form after submit// BO the : function responsible for validating the form after submit
function validateAdsUpdateForm(){
	// alert("doone");
	var title = document.getElementById("ads_update_title");
	var content = document.getElementById("ads_update_content");
	var category = document.getElementById("ads_update_category");
	
	if(content.value.trim().length > 500){
		content.style.border = "1px solid red";
		content.focus();
		$("#adsContentUpdateError").text("Too long description not allowed ...");
		event.preventDefault();
	}else if(content.value.trim().length < 1){
		content.focus();
		content.style.border = "1px solid red";
		$("#adsContentUpdateError").text("The description can not be empty ...");
		event.preventDefault();
	}else{
		content.style.border = "1px solid #ced4da";
		$("#adsContentUpdateError").text("");
	}



	if(category.value.trim().length < 1){
		category.style.border = "1px solid red";
		category.focus();
		$("#adsCategoryUpdateError").text("category must be selected ...");
		category.style.border = "1px solid red";
		event.preventDefault();
	}else{
		category.style.border = "1px solid #ced4da";
		$("#adsCategoryUpdateError").text("");

	}

	

	if(title.value.trim().length > 100){
		title.focus();
		title.style.border = "1px solid red";
		$("#adsTitleUpdateError").text("Too long title not allowed ...");
		event.preventDefault();
	}else if(title.value.trim().length < 1){
		title.focus();
		title.style.border = "1px solid red";
		$("#adsTitleUpdateError").text("The title can not be empty ...");
		event.preventDefault();
	}else{
		title.style.border = "1px solid #ced4da";
		$("#adsTitleUpdateError").text("");
	}

}
// EO the : function responsible for validating the form after submit