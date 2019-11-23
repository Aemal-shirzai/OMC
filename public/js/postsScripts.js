// Beggining of: the function which shows the tips content based on the clicked button
function openTIpsContent(value,whichIcon){

	var tipsContent = document.getElementsByClassName("tipsContent");
  	for (i = 0; i < tipsContent.length; i++) {
    	tipsContent[i].style.display = "none";
  	}


  	var icon = document.getElementsByClassName("icon");
  	for (i = 0; i < icon.length; i++) {
    	icon[i].className = icon[i].className.replace("fa-chevron-up", "fa-chevron-down");
  	}

  	 document.getElementById(value).style.display = "block";
  	 $("#icon-"+whichIcon).removeClass("fa-chevron-down");
  	 $("#icon-"+whichIcon).addClass("fa-chevron-up");

}
// End of: the function which shows the tips content based on the clicked button


// Begginng of th function which show all tips in samll screen
function showTipsContent(){
	$("#tipsContent").slideToggle("fast");

	if($("#tipsIconForSmall").hasClass("fa-chevron-down")){
		$("#tipsIconForSmall").removeClass("fa-chevron-down");
  		$("#tipsIconForSmall").addClass("fa-chevron-up");
	}else{
		$("#tipsIconForSmall").removeClass("fa-chevron-up");
  		$("#tipsIconForSmall").addClass("fa-chevron-down");
	}
}
// Begginng of th function which show all tips in samll screen



// things to do while resizeing
$(window).resize(function(){
		if($(window).width() > 1023){
			$("#tipsContent").css("display","inline");
		}else{
			// $("#tipsContent").css("display","none");
			// $("#tipsIconForSmall").removeClass("fa-chevron-up");
			// $("#tipsIconForSmall").addClass("fa-chevron-down");
		}
});

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

// Beggining of the function which opens the photofiled input for adding post

function openPostPhotoField(){
	var field = document.getElementById("PhotoField");
	field.disabled = false;
	$("#PhotoField").val("");
	$("#PhotoParentDiv").hide();
	$("#imageIcon").css('color',"#9ba1a7");
	// $("#imageIcon").show();
	field.click();
}
// End of the function which opens the photofiled input for adding post

// Beggining of : the function responsible for removing photo 

function removePhoto(){
	document.getElementById("PhotoField").disabled = true;
	$("#PhotoField").val("");
	$("#PhotoParentDiv").hide();
	$("#imageIcon").css('color',"#9ba1a7");
}
// Beggining of : the function responsible for removing photo 

// Beggining of th function whihc is responsible to show the image on the screen after beign seleccted 
function showpic(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();

		reader.onload = function(e){
			$("#img-placeholder").attr("src",e.target.result);	
		}

		reader.readAsDataURL(input.files[0]);
	}
}	
// End of th function whihc is responsible to show the image on the screen after beign seleccted 



// Beggining of validating and calling the showing image function for photos

$("#PhotoField").on("change",function(){
	var file = $(this);

	var fileType = file.val().split(".").pop().toLowerCase(); 
	if(file.val() == "" || fileType == "jpg" || fileType == "bmp" || fileType == "jpeg" || fileType == "png" || fileType == "gif" || fileType == "svg"){
		if(this.files[0].size/1024/1024 < 10){
			$("#PhotoParentDiv").show();
			showpic(this);
	 		$('#invalidFile').hide();
	 		$("#imageIcon").css('color','#3fbbc0');
	 		// $("#imageIcon").hide();
	}else{
			$('#invalidFile').show();
			$("#invalidFileMessage").text("File too large. max 10MB...");
			$("#PhotoParentDiv").hide();
			$(this).val("");
			event.preventDefault();
	}
	 }else{
		$('#invalidFile').show();
	 	$("#invalidFileMessage").text("Only photos are allowed...");
	 	$("#PhotoParentDiv").hide();
		$(this).val("");
		event.preventDefault();
	}
});

// End of validating and calling the showing image function for photos



// BO the : function responsible for validating the title field and enabling the add post button
function validateTitleAndEnableButton(){
	var title = document.getElementById("title");
	var content = document.getElementById("content");
	var button = document.getElementById("submitButton");
	if(title.value.trim().length > 0 && content.value.trim().length > 0){
		if(content.value.trim().length < 65500){
			button.disabled = false;
		}
	}else{

		button.disabled = true;
	}

	if(title.value.trim().length > 190){
		title.style.border = "1px solid red";
		$("#errorForTitle").text("Too long text for title, max 190 chars");
		button.disabled = true;

	}else{
		title.style.border = "1px solid #ced4da";
		$("#errorForTitle").text("");
	}
}
// EO the : function responsible for validating the title field and enabling the add post button

// BO the : function responsible for validating the content field and enabling the add post button
function validateContentAndEnableButton(){
	var title = document.getElementById("title");
	var content = document.getElementById("content");
	var button = document.getElementById("submitButton");
	if(title.value.trim().length > 0 && content.value.trim().length > 0){
		if(title.value.trim().length < 191){
			button.disabled = false;
		}
	}else{
		button.disabled = true;
	}

	if(content.value.trim().length > 65500){
		content.style.border = "1px solid red";
		$("#errorForContent").text("Too long text for content");
		button.disabled = true;
	}else{
		content.style.border = "1px solid #ced4da";
		$("#errorForContent").text("");
	}
}
// EO the : function responsible for validating the content field and enabling the add post button

// BO the : function responsible for validating the post form 

function validatePostForm(){
	var title = document.getElementById("title");
	var content = document.getElementById("content");
	var button = document.getElementById("submitButton");
	if($(":checkbox:checked").length > 5){
		$("#addTagLink").addClass("errorButton");
		$("#tags").show();
		$("#tagsNote").css("color","red");
		$("#tagsErrorMessage").text("Only 5 tags are allowed");
		event.preventDefault();
	}	

	if(content.value.trim().length < 1){
		content.style.border = "1px solid red";
		content.focus();
		$("#errorForContent").text("The content field can not be null");
		event.preventDefault();
	}else{
		content.style.border = "1px solid #ced4da";
		$("#errorForContent").text("");
	}

	if(title.value.trim().length < 1){
		title.style.border = "1px solid red";
		title.focus();
		$("#errorForTitle").text("The title field can not be null");
		event.preventDefault();
	}else{
		title.style.border = "1px solid #ced4da";
		$("#errorForTitle").text("");
	}
}
// EO the : function responsible for validating the post form 

// BO the : function responsible for validating the tags based on checbox changing 
function showAndValidateTagsCount(event){
	var count = $(":checkbox:checked").length;
	$("#tagsCount").text(count);
	if(count > 5){
		$("#addTagLink").addClass("errorButton");
		$("#tagsNote").css("color","red");
		$("#tagsErrorMessage").text("Only 5 tags are allowed");	
	}else{
		$("#addTagLink").removeClass("errorButton");
		$("#tagsNote").css("color","#9ba1a7");
		$("#tagsErrorMessage").text("");	
	}
}
//EO the : function responsible for validating the tags based on checbox changing 