// Beggining of: the function which shows the profile content based on the clicked button
function openContent(evt,value){
	var tabcontent = document.getElementsByClassName("tab-content");
  	for (i = 0; i < tabcontent.length; i++) {
    	tabcontent[i].style.display = "none";
  	}

  	var tablinks = document.getElementsByClassName("tabLinks");
  	for (i = 0; i < tablinks.length; i++) {
    	tablinks[i].className = tablinks[i].className.replace(" active", "");
  	}

  	 document.getElementById(value).style.display = "block";
 	 evt.currentTarget.className += " active";
}
// End of: the function which shows the profile content based on the clicked button


//comment part ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Begginng of : the function which validate the comment form
function validateCommentForm(postId){
	var field = document.getElementById("commentField-"+postId);
	var photoField = document.getElementById("commentPhotoField-"+postId);

	// This if means if both the photo filed and comment field is empty then throw an error
	if(field.value.trim().length < 1 && photoField.files.length < 1){
		field.focus();
		field.style.border = "1px solid red";
		field.placeholder = "can not add empty comment";
		event.preventDefault();
	}else{
		field.placeholder = "Add Comment to post...";
		field.style.border = "none";
	}

	if(field.value.trim().length >= 65500){
		field.focus();
		$("#fileError-"+postId).show();
		$("#msg-"+postId).text("Too Long Text");
		field.style.border = "1px solid red";
		field.placeholder = "Too long text";
		event.preventDefault();
	}else{
		$("#fileError-"+postId).hide();
		field.style.border = "none";
		field.placeholder = "Add Comment to post..."
	}	
}
// End of : the function which validate the comment form

// Beggining of the function which resize the comment text area when the text increase, AND the function whihc enable the commnet button
function do_resize_and_enable_button(textbox,postId) {
 var maxrows=10; 
  var txt=textbox.value;
  var cols=textbox.cols;
// enable button
if(txt.trim().length > 0 ){
	//  This if is to disable border red if the text area is border red due to any error
	if(textbox.style.border == "1px solid red"){
		textbox.style.border = "none";
		textbox.placeholder = "Add Comment to post...";
	}
	document.getElementById("addCommentBtn-"+postId).disabled = false;
	}else{
		if(document.getElementById("commentPhotoField-"+postId).files.length < 1){
			document.getElementById("addCommentBtn-"+postId).disabled = true;
		}
	}

	// resize
	 var arraytxt=txt.split('\n');

	  var rows=arraytxt.length; 

	 for (i=0;i<arraytxt.length;i++) 
	  rows+=parseInt((arraytxt[i].length)/cols);
	if(rows == 1){
		textbox.setAttribute("style","border-radius:10px !important;");
		
	}else{
		textbox.setAttribute("style","border-radius:0px !important;");
	}

	 if (rows>maxrows){ 
	 	textbox.rows=maxrows;
	 	textbox.setAttribute("style","overflow:auto !important");
	 }else {
	  	textbox.rows=rows;
	}
 }
 // End of the function which resize the comment text area when the text increase, AND the function whihc enable the commnet button


 // Beggining of : the function which open the comment photo field
function openCommentPhotoField(value){
	// var field = document.getElementById("commentPhotoField-"+value);
	var field = document.getElementById("commentPhotoField-"+value);
	field.value = "";
	$("#commentImageDiv-"+value).hide();
	if(document.getElementById("commentField-"+value).value.trim().length < 1){
		document.getElementById("addCommentBtn-"+value).disabled = true;
	}
	field.click();
}
 // End of : the function which open the comment photo field


// Beggining of : the function which open the share options menu
function openShareOptions(value){
	$("#shareOptions-"+value).toggle();
	event.preventDefault();
}
// End of : the function which open the share options menu

// Beggining of th function whihc is responsible to show the image on the screen after beign seleccted
function showpic(input,id){
	if(input.files && input.files[0]){
		var reader = new FileReader();

		reader.onload = function(e){
			$("#commentImg-"+id).attr("src",e.target.result);	
		}

		reader.readAsDataURL(input.files[0]);
	}
}
// End of th function whihc is responsible to show the image on the screen after beign seleccted

// Beggining of the functio which validate the comment image
function showAndValidateFile(value){
	var field = document.getElementById("commentPhotoField-"+value);
	var button = document.getElementById("addCommentBtn-"+value);
	var commentField = document.getElementById("commentField-"+value);
	var fileType = field.value.split(".").pop().toLowerCase();
	if(fileType == "jpg" || fileType == "bmp" || fileType == "jpeg" || fileType == "png" || fileType == "gif" || fileType == "svg"){
		if(field.files[0].size/1024/1024 < 10){
			$("#commentImageDiv-"+value).show();
			button.disabled =false; // It enable the add comment button because the image is correct
			$("#fileError-"+value).hide();
			showpic(field,value);
		}else{
			$("#fileError-"+value).show();
			field.value= "";
			$("#commentImageDiv-"+value).hide();
			$("#msg-"+value).text("File too large. max 10MB...");
			/* Here the photo is wrong it means the path will be cleared and length will be 0 
			  so now this if checks if the commetn field is also empty the disable the commetn button */
			if(commentField.value.trim().length < 1){
				button.disabled = true;
			}
			event.preventDefault();
		}
	}else{
		/* Here the photo is wrong it means the path will be cleared and length will be 0 
		  so now this if checks if the commetn field is also empty the disable the commetn button */
		if(commentField.value.trim().length < 1 && field.files.length < 1){
				button.disabled = true;
		}
		$("#fileError-"+value).show();
		field.value= "";
		$("#commentImageDiv-"+value).hide();
		$("#msg-"+value).text("Invalid file. Only photos are allowed...");
		event.preventDefault();
	}
}
// End of of the functio which validate the comment image

// Beggining of the function which close the eroror msg while clikcing on the cross button
function closeMsgs(value){
	document.getElementById("fileError-"+value).style.display = "none";
}
// End of the function which close the eroror msg while clikcing on the cross button

// Beggining of the function which Remove the comment image when click remove image
	function removeImage(value){
		var field = document.getElementById("commentPhotoField-"+value);
		var commentField = document.getElementById("commentField-"+value);
		var button = document.getElementById("addCommentBtn-"+value);
		/* By clicking the remove photo field the photo length becomes 0 because the path is cleared  
		   so now this if checks if the commetn field is also empty the disable the commetn button */
		if(commentField.value.trim().length < 1){
			button.disabled = true;
		}
		field.value= "";
		$("#commentImageDiv-"+value).hide();
	}
// Endof of the function which Remove the comment image when click remove image


$(document).ready(function(){
// Adding comment serverside successs
 if(scroll === "on"){
 	$("#successMsg-"+post_id).show();
	$("html,body").animate({
	scrollTop: $("#successMsg-"+post_id).offset().top-350},"fast");
 }
 // Adding comment serverside error
 if(scroll === "on1"){
 	$("#fileError-"+post_id).show();
	$("html,body").animate({
	scrollTop: $("#fileError-"+post_id).offset().top-350},"fast");
 }

});
	
// beggining of: the function which shows all comments
function showAllComments(value){
	$("#allComments-"+value).toggle();
		$("html,body").animate({
		scrollTop: $("#addCommentBtn-"+value).offset().top-200},"slow");
}		
// End of: the function which shows all comments


// Replies part ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// beggining of: the function which shows reply form
function showReplies(value){
	$("#reply-"+value).toggle();
	$('#replyField-'+value).focus();
	$("#allReplies-"+value).toggle();
}
// End of: the function which shows reply form

// Beggining of the function which open the reply photo field
function openReplyPhotoField(commentId) {
	var field = document.getElementById("replyPhotoField-"+commentId);
	var button = document.getElementById("addReplyBtn-"+commentId);
	var replyField = document.getElementById("replyField-"+commentId);

	field.value = "";
	$("#replyImageDiv-"+commentId).hide();
	if(replyField.value.trim().length < 1){
		button.disabled = true;
	}
	field.click();
	event.preventDefault();
}
// End of the function which open the reply photo field

// Begginng of : the function which validate the reply form
function validateReplyForm(commentId){
	var field = document.getElementById("replyField-"+commentId);
	var photoField = document.getElementById("replyPhotoField-"+commentId);

	// This if means if both the photo filed and comment field is empty then throw an error
	if(field.value.trim().length < 1 && photoField.files.length < 1){
		field.focus();
		field.style.border = "1px solid red";
		field.placeholder = "can not add empty Reply";
		event.preventDefault();
	}else{
		field.placeholder = "Add Reply...";
		field.style.border = "none";
	}

	if(field.value.trim().length >= 65500){
		field.focus();
		$("#replyPhotoError-"+commentId).show();
		$("#replymsg-"+commentId).text("Too Long Text");
		field.style.border = "1px solid red";
		field.placeholder = "Too long text";
		event.preventDefault();
	}else{
		$("#replyPhotoError-"+commentId).hide();
		field.style.border = "none";
		field.placeholder = "Add Reply..."
	}	
}
// End of : the function which validate the comment form

// Beggining of th function whihc is responsible to show the image on the screen after beign seleccted for replies
function showReplyPic(input,id){
	if(input.files && input.files[0]){
		var reader = new FileReader();

		reader.onload = function(e){
			$("#replyImg-"+id).attr("src",e.target.result);	
		}

		reader.readAsDataURL(input.files[0]);
	}
}
// End of th function whihc is responsible to show the image on the screen after beign seleccted for replies

// Beggining of the functio which validate the replies image
function showAndValidateReplyFile(value){
	var field = document.getElementById("replyPhotoField-"+value);
	var button = document.getElementById("addReplyBtn-"+value);
	var replyField = document.getElementById("replyField-"+value);
	var fileType = field.value.split(".").pop().toLowerCase();
	if(fileType == "jpg" || fileType == "bmp" || fileType == "jpeg" || fileType == "png" || fileType == "gif" || fileType == "svg"){
		if(field.files[0].size/1024/1024 < 10){
			$("#replyImageDiv-"+value).show();
			button.disabled =false; // It enable the add comment button because the image is correct
			$("#replyPhotoError-"+value).hide();
			showReplyPic(field,value);
		}else{
			$("#replyPhotoError-"+value).show();
			field.value= "";
			$("#replyImageDiv-"+value).hide();
			$("#replymsg-"+value).text("File too large. max 10MB...");
			//  Here the photo is wrong it means the path will be cleared and length will be 0 
			//   so now this if checks if the commetn field is also empty the disable the commetn button 
			if(commentField.value.trim().length < 1){
				button.disabled = true;
			}
			 event.preventDefault();
		}
	}else{
		/* Here the photo is wrong it means the path will be cleared and length will be 0 
		  so now this if checks if the commetn field is also empty the disable the commetn button */
		if(replyField.value.trim().length < 1 && field.files.length < 1){
				button.disabled = true;
		}
		$("#replyPhotoError-"+value).show();
		field.value= "";
		$("#replyImageDiv-"+value).hide();
		$("#replymsg-"+value).text("Invalid file. Only photos are allowed...");
		event.preventDefault();
	}
}
// // End of of the functio which validate the replies image

// Beggining of the function which close the eroror msg while clikcing on the cross button in replieds
function closeReplyMsgs(value){
	document.getElementById("replyPhotoError-"+value).style.display = "none";
}
// End of the function which close the eroror msg while clikcing on the cross button in replies

// Beggining of the function which Remove the reokues image when click remove image
function removeReplyImage(value){
	var field = document.getElementById("replyPhotoField-"+value);
	var replyField = document.getElementById("replyField-"+value);
	var button = document.getElementById("addReplyBtn-"+value);
	/* By clicking the remove photo field the photo length becomes 0 because the path is cleared  
	   so now this if checks if the commetn field is also empty the disable the commetn button */
	if(replyField.value.trim().length < 1){
		button.disabled = true;
	}
	field.value= "";
	$("#replyImageDiv-"+value).hide();
}
// Endof of the function which Remove the replies image when click remove image

// Beggining of the function which resize the reply text area when the text increase, AND the function which enable the reply button
function do_resize_and_enable_reply_button(textbox,commentId) {
	var button = document.getElementById("addReplyBtn-"+commentId);
	var field = document.getElementById("replyPhotoField-"+commentId);
	  var maxrows=10; 
	  var txt=textbox.value;
	  var cols=textbox.cols;
// enable button
if(txt.trim().length > 0 ){
	//  This if is to disable border red if the text area is border red due to any error
	if(textbox.style.border == "1px solid red"){
		textbox.style.border = "none";
		textbox.placeholder = "Add Repy...";
	}
	button.disabled = false;
	}else{
		if(field.files.length < 1){
			button.disabled = true;
		}
	}

	// resize
	 var arraytxt=txt.split('\n');

	  var rows=arraytxt.length; 

	 for (i=0;i<arraytxt.length;i++) 
	  rows+=parseInt((arraytxt[i].length)/cols);
	if(rows == 1){
		textbox.setAttribute("style","border-radius:10px !important;");
		
	}else{
		textbox.setAttribute("style","border-radius:0px !important;");
	}

	 if (rows>maxrows){ 
	 	textbox.rows=maxrows;
	 	textbox.setAttribute("style","overflow:auto !important");
	 }else {
	  	textbox.rows=rows;
	}
 }
 // End of the function which resize the reply text area when the text increase, AND the function which enable the reply button

// Beggining of the function which readmore and readless the post content and comment contents 
 function showComplete(value,type){
 	if(type == "post"){
	 	$("#halfPost-"+value).hide();
	 	$("#completePost-"+value).show();
 	}else if(type == "comment"){
 		$("#halfComment-"+value).hide();
	 	$("#completeComment-"+value).show();
 	}else if(type == "reply"){
 		$("#halfReply-"+value).hide();
	 	$("#completeReply-"+value).show();
 	}
 }

 function showLess(value,type){
 	if(type == "post"){
	 	$("#completePost-"+value).hide();
	 	$("#halfPost-"+value).show();
 	}else if(type == "comment"){
 		$("#halfComment-"+value).show();
	 	$("#completeComment-"+value).hide();
 	}else if(type == "reply"){
 		$("#halfReply-"+value).show();
	 	$("#completeReply-"+value).hide();
 	}
 }
 // End of the function which readmore and readless the post content and comment content