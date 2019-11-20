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
 	$("#allComments-"+post_id).show();
	$("html,body").animate({
	scrollTop: $("#successMsg-"+post_id).offset().top-350},"fast");
 }
 // Adding comment serverside error
 if(scroll === "on1"){
 	$("#fileError-"+post_id).show();
 	$("#allComments-"+post_id).show()
	$("html,body").animate({
	scrollTop: $("#fileError-"+post_id).offset().top-350},"fast");
 }


// Beggingin of: reply success messages scrols 
 if(scroll === "toReplySuccess"){
 	$("#allComments-"+post_id).show();
 	$("#allReplies-"+comment_id).show();
 	$("#reply-"+comment_id).show();
 	$("#replySuccessMsg-"+comment_id).show();

 	$("html,body").animate({
		scrollTop: $("#allComments-"+post_id).offset().top-100},"fast");	
 	$("div#allComments-"+post_id).animate({
		scrollTop: $("#allComments-"+post_id).scrollTop() + $("#allCommentsContent-"+comment_id).position().top},"fast");	
 }
// End of reply success messsgae scroll

// Beggingin of: reply error messages scrols 
 if(scroll === "toReplyError"){
 	$("#allComments-"+post_id).show();
 	$("#allReplies-"+comment_id).show();
 	$("#reply-"+comment_id).show();
 	$("#replyPhotoError-"+comment_id).show();

 	$("html,body").animate({
		scrollTop: $("#allComments-"+post_id).offset().top-100},"fast");	
 	$("div#allComments-"+post_id).animate({
		scrollTop: $("#allComments-"+post_id).scrollTop() + $("#allCommentsContent-"+comment_id).position().top},"fast");	
 }
// End of reply error messsgae scroll

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
	// $('#replyField-'+value).focus();
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


 // Call the function of which chagne the pososition of tags div in profile page 
window.onscroll = function() {changeTagsPosition()};	
// Beggining of the function which change the pososition of tags div in profile page 
function changeTagsPosition(){
	if(document.documentElement.scrollTop > 360){
	document.getElementById('tags').setAttribute("style","position:fixed; right:130px;top: 130px; padding:12px 15px; transition: 0.5s; width:200px;");
	}else{
		document.getElementById('tags').setAttribute("style","float: right; position: relative;right: 130px; width:200px; top: 130px;padding: 12px 15px; transition: 0.5s;")
	}
}
// End of the function which change the pososition of tags div in profile page 

// This if statement checks if the page is refreshed when the scroll in more that 310 then alsom apply these style to tags in profile page
// RElated to above on scroll function
if(document.documentElement.scrollTop > 360){
	document.getElementById('tags').setAttribute("style","position:fixed;right:130px;top:130px; padding:12px 15px; width:200px; transition: 0.5s;");
}


//Beggining of : The function which add and update vote to post
function vote(postId,type){
	if(type == "upVote"){
		$("#postOptionsVoteUpText-"+postId).text("Loading..");
	}else{
		$("#postOptionsDownVoteText-"+postId).text("Loading..");
	}
	event.preventDefault();
	$.ajax({
		//sending data using post method
		method: "post",
		// The url is passed from the profile blade
		url : postVote,
		// the token is also passed from profile blade
		data : {voteType:type,post_id:postId, _token: token},

	})
		.done(function(){ // if the request is done seccessfully thn:

			if(type == "upVote"){ // if the up voted is clicked
				if($("#upVotedCheck-"+postId).hasClass("fa-check")){ // if the up voted button has the class fa-check
					$("#upVotedCheck-"+postId).removeClass("fas fa-check upVotedCheck"); // then remove that class from it, it means we click up vote for two reason to get our vote back or to vote someting and this is the first case
			 		$("#postOptionsVoteUpIcon-"+postId).css("color","#666"); // change icon color
				 	$("#postOptionsVoteUpText-"+postId).css("color","#666");// changed text color
				 	$("#postOptionsVoteUpText-"+postId).text("Up-vote"); // change button text
				 	$("#postOptionsVoteUpCount-"+postId).text(parseInt($("#postOptionsVoteUpCount-"+postId).text())-1); // and substruct one from the up votes because we are not adding new vote we are just taking our vote back
				 	
				}else{ // if the voted button has no class fa-check it means we vote here not taking our vote back
					if($("#downVotedCheck-"+postId).hasClass("fa-check")){ // here if the down the current user has down voted the post
						$("#downVotedCheck-"+postId).removeClass("fas fa-check upVotedCheck"); // then remove the class from down voted votes
						$("#postOptionsDownVoteText-"+postId).css("color","#666"); // changed down voted votes color to simple
						$("#postOptionsDownVoteText-"+postId).text("Down-vote"); //change its text aswell
				 		$("#postOptionsDownVoteUpIcon-"+postId).css("color","#666"); // change its icon color
				 		$("#postOptionsVoteDownCount-"+postId).text(parseInt($("#postOptionsVoteDownCount-"+postId).text())-1); // and stubsturct one from the downvotes because adding the up vote because one user cant up vote and down vote a post at same time
					}
					$("#upVotedCheck-"+postId).addClass("fas fa-check upVotedCheck"); // if there is not class fa-check then add up vote that class
			 		$("#postOptionsVoteUpIcon-"+postId).css("color","#3fbbc0"); //change icon color to green
				 	$("#postOptionsVoteUpText-"+postId).css("color","#3fbbc0"); // change text color
				 	$("#postOptionsVoteUpText-"+postId).text("Up-voted");	// change button text
				 	$("#postOptionsVoteUpCount-"+postId).text(parseInt($("#postOptionsVoteUpCount-"+postId).text())+1); // and add one to the total of up voted votes
				}
			}
			if(type == "voteDown"){ // if the user is clicking the down vote button
				if($("#downVotedCheck-"+postId).hasClass("fa-check")){ // now if the down voted is already clicked it means it that the user has already down voted the post
					$("#downVotedCheck-"+postId).removeClass("fas fa-check upVotedCheck"); // then remove it . because clicking one button for the second time should take the vote back
					$("#postOptionsDownVoteText-"+postId).css("color","#666"); // change text color to simple
					$("#postOptionsDownVoteText-"+postId).text("Down-vote");	//change button text
			 		$("#postOptionsDownVoteUpIcon-"+postId).css("color","#666"); // change the icon color
			 		$("#postOptionsVoteDownCount-"+postId).text(parseInt($("#postOptionsVoteDownCount-"+postId).text())-1); // and substrruct one from downvotes because we are taking our vote back
				}else{ // if the user is clickin the down vote for first time
					if($("#upVotedCheck-"+postId).hasClass("fa-check")){ // now if the user has already up voted the post then
						$("#upVotedCheck-"+postId).removeClass("fas fa-check upVotedCheck"); // remove the upvoted from the user
				 		$("#postOptionsVoteUpIcon-"+postId).css("color","#666"); // romve icon color
					 	$("#postOptionsVoteUpText-"+postId).css("color","#666"); // change text color
					 	$("#postOptionsVoteUpText-"+postId).text("Up-vote"); //chagne button text
					 	$("#postOptionsVoteUpCount-"+postId).text(parseInt($("#postOptionsVoteUpCount-"+postId).text())-1);// and sustruct one fro the up votes because one user can not vote up and down at the same time
					}
					$("#downVotedCheck-"+postId).addClass("fas fa-check upVotedCheck"); // now add the class to down vote button because we are downvoting
					$("#postOptionsDownVoteText-"+postId).css("color","#3fbbc0"); //change the text color
					$("#postOptionsDownVoteText-"+postId).text("Down-voted"); //change the button text
					$("#postOptionsDownVoteUpIcon-"+postId).css("color","#3fbbc0"); //change the icon color
					$("#postOptionsVoteDownCount-"+postId).text(parseInt($("#postOptionsVoteDownCount-"+postId).text())+1); // and add one to the total of the down voted votes
				}
			}
		});  // done function end
}
//End of : The function which add and update vote to post




//Beggining of : The function which add and update vote to commnets
function voteComments(commentId,type){
	if(type == "upVote"){
		$("#commentOptionsLoadingUpText-"+commentId).text("Loading...");
	}else{
		$("#commentOptionsLoadingDownText-"+commentId).text("Loading...");	
	}
	event.preventDefault();
	$.ajax({
		//sending data using post method
		method: "post",
		// The url is passed from the profile blade
		url : commentVote,
		// the token is also passed from profile blade
		data : {voteType:type,comment_id:commentId, _token: token},

	})
		.done(function(){ // if the request is done seccessfully thn:

			if(type == "upVote"){ // if the up voted is clicked
				if($("#commentVotedUpCheck-"+commentId).hasClass("fa-check")){ // if the up voted button has the class fa-check
					$("#commentVotedUpCheck-"+commentId).removeClass("fas fa-check upVotedCheck"); // then remove that class from it, it means we click up vote for two reason to get our vote back or to vote someting and this is the first case
			 		$("#commentOptionsVoteUpIcon-"+commentId).css("color","#666"); // change icon color
			 		$("#commentOptionsLoadingUpText-"+commentId).text("");
				 	$("#commentOptionsVoteUpCount-"+commentId).text(parseInt($("#commentOptionsVoteUpCount-"+commentId).text())-1); // and substruct one from the up votes because we are not adding new vote we are just taking our vote back
				 	
				}else{ // if the voted button has no class fa-check it means we vote here not taking our vote back
					if($("#commentVotedDownCheck-"+commentId).hasClass("fa-check")){ // here if the down the current user has down voted the post
						$("#commentVotedDownCheck-"+commentId).removeClass("fas fa-check upVotedCheck"); // then remove the class from down voted votes
				 		$("#commentOptionsVoteDownIcon-"+commentId).css("color","#666"); // change its icon color
				 		$("#commentOptionsLoadingDownText-"+commentId).text("");
				 		$("#commentOptionsVoteDownCount-"+commentId).text(parseInt($("#commentOptionsVoteDownCount-"+commentId).text())-1); // and stubsturct one from the downvotes because adding the up vote because one user cant up vote and down vote a post at same time
					}
					$("#commentVotedUpCheck-"+commentId).addClass("fas fa-check upVotedCheck"); // if there is not class fa-check then add up vote that class
			 		$("#commentOptionsVoteUpIcon-"+commentId).css("color","#3fbbc0"); //change icon color to green
			 		$("#commentOptionsLoadingUpText-"+commentId).text("");
				 	$("#commentOptionsVoteUpCount-"+commentId).text(parseInt($("#commentOptionsVoteUpCount-"+commentId).text())+1); // and add one to the total of up voted votes
				}
			}if(type == "downVote"){ // if the user is clicking the down vote button
				if($("#commentVotedDownCheck-"+commentId).hasClass("fa-check")){ // now if the down voted is already clicked it means it that the user has already down voted the post
					$("#commentVotedDownCheck-"+commentId).removeClass("fas fa-check upVotedCheck"); // then remove it . because clicking one button for the second time should take the vote back
			 		$("#commentOptionsVoteDownIcon-"+commentId).css("color","#666"); // change the icon color
			 		$("#commentOptionsLoadingDownText-"+commentId).text("");
			 		$("#commentOptionsVoteDownCount-"+commentId).text(parseInt($("#commentOptionsVoteDownCount-"+commentId).text())-1); // and substrruct one from downvotes because we are taking our vote back
				}else{ // if the user is clickin the down vote for first time
					if($("#commentVotedUpCheck-"+commentId).hasClass("fa-check")){ // now if the user has already up voted the post then
						$("#commentVotedUpCheck-"+commentId).removeClass("fas fa-check upVotedCheck"); // remove the upvoted from the user
				 		$("#commentOptionsVoteUpIcon-"+commentId).css("color","#666"); // romve icon colors
				 		$("#commentOptionsLoadingUpText-"+commentId).text("");
					 	$("#commentOptionsVoteUpCount-"+commentId).text(parseInt($("#commentOptionsVoteUpCount-"+commentId).text())-1);// and sustruct one fro the up votes because one user can not vote up and down at the same time
					}
					$("#commentVotedDownCheck-"+commentId).addClass("fas fa-check upVotedCheck"); // now add the class to down vote button because we are downvoting
					$("#commentOptionsVoteDownIcon-"+commentId).css("color","#3fbbc0"); //change the icon color
					$("#commentOptionsLoadingDownText-"+commentId).text("");
					$("#commentOptionsVoteDownCount-"+commentId).text(parseInt($("#commentOptionsVoteDownCount-"+commentId).text())+1); // and add one to the total of the down voted votes
				}
			}



		});  // done function end
}
//End of : The function which add and update vote to comments


// Begginign of the function which vote the replies

function voteReplies(replyId,type)
{
	if(type == "upVote"){
		$("#replyOptionsLoadingUpText-"+replyId).text("Loading...");
	}else{
		$("#replyOptionsLoadingDownText-"+replyId).text("Loading...");
	}
	event.preventDefault();
	$.ajax({
		//sending data using post method
		method: "post",
		// The url is passed from the profile blade
		url : replyVote,
		// the token is also passed from profile blade
		data : {voteType:type,reply_id:replyId, _token: token},

	})
		.done(function(){
			if(type == "upVote"){ // if the up voted is clicked
				if($("#replyVotedUpCheck-"+replyId).hasClass("fa-check")){ // if the up voted button has the class fa-check
					$("#replyVotedUpCheck-"+replyId).removeClass("fas fa-check upVotedCheck"); // then remove that class from it, it means we click up vote for two reason to get our vote back or to vote someting and this is the first case
			 		$("#replyOptionsVoteUpIcon-"+replyId).css("color","#666"); // change icon color
			 		$("#replyOptionsLoadingUpText-"+replyId).text("");
				 	$("#replyOptionsVoteUpCount-"+replyId).text(parseInt($("#replyOptionsVoteUpCount-"+replyId).text())-1); // and substruct one from the up votes because we are not adding new vote we are just taking our vote back
				 	
				}else{ // if the voted button has no class fa-check it means we vote here not taking our vote back
					if($("#replyVotedDownCheck-"+replyId).hasClass("fa-check")){ // here if the down the current user has down voted the post
						$("#replyVotedDownCheck-"+replyId).removeClass("fas fa-check upVotedCheck"); // then remove the class from down voted votes
				 		$("#replyOptionsVoteDownIcon-"+replyId).css("color","#666"); // change its icon color
				 		$("#replyOptionsLoadingDownText-"+replyId).text("");
				 		$("#replyOptionsVoteDownCount-"+replyId).text(parseInt($("#replyOptionsVoteDownCount-"+replyId).text())-1); // and stubsturct one from the downvotes because adding the up vote because one user cant up vote and down vote a post at same time
					}
					$("#replyVotedUpCheck-"+replyId).addClass("fas fa-check upVotedCheck"); // if there is not class fa-check then add up vote that class
			 		$("#replyVotedUpCheck-"+replyId).css("color","#3fbbc0"); //change icon color to green
			 		$("#replyOptionsLoadingUpText-"+replyId).text("");
				 	$("#replyOptionsVoteUpCount-"+replyId).text(parseInt($("#replyOptionsVoteUpCount-"+replyId).text())+1); // and add one to the total of up voted votes
				}
			}if(type == "downVote"){ // if the user is clicking the down vote button
				if($("#replyVotedDownCheck-"+replyId).hasClass("fa-check")){ // now if the down voted is already clicked it means it that the user has already down voted the post
					$("#replyVotedDownCheck-"+replyId).removeClass("fas fa-check upVotedCheck"); // then remove it . because clicking one button for the second time should take the vote back
			 		$("#replyOptionsVoteDownIcon-"+replyId).css("color","#666"); // change the icon color
			 		$("#replyOptionsLoadingDownText-"+replyId).text("");
			 		$("#replyOptionsVoteDownCount-"+replyId).text(parseInt($("#replyOptionsVoteDownCount-"+replyId).text())-1); // and substrruct one from downvotes because we are taking our vote back
				}else{ // if the user is clickin the down vote for first time
					if($("#replyVotedUpCheck-"+replyId).hasClass("fa-check")){ // now if the user has already up voted the post then
						$("#replyVotedUpCheck-"+replyId).removeClass("fas fa-check upVotedCheck"); // remove the upvoted from the user
				 		$("#replyOptionsVoteUpIcon-"+replyId).css("color","#666"); // romve icon colors
				 		$("#replyOptionsLoadingUpText-"+replyId).text("");
					 	$("#replyOptionsVoteUpCount-"+replyId).text(parseInt($("#replyOptionsVoteUpCount-"+replyId).text())-1);// and sustruct one fro the up votes because one user can not vote up and down at the same time
					}
					$("#replyVotedDownCheck-"+replyId).addClass("fas fa-check upVotedCheck"); // now add the class to down vote button because we are downvoting
					$("#replyOptionsVoteDownIcon-"+replyId).css("color","#3fbbc0"); //change the icon color
					$("#replyOptionsLoadingDownText-"+replyId).text("");
					$("#replyOptionsVoteDownCount-"+replyId).text(parseInt($("#replyOptionsVoteDownCount-"+replyId).text())+1); // and add one to the total of the down voted votes
				}
			}
		});	
}
// End of the function which vote the replies


// Beggining of the : Function responsible for following the posts by normal users
function followPost(postId){
	$("#followOptionText-"+postId).text("Loading...");
	event.preventDefault();
	$.ajax({
		// the method the data should be sent with
		method : "POST",

		// the route to which the data should go
		url: postFavorites,

		// The data which should be send 
		data: {post_id:postId,_token:token}

	}).done(function(){
		if($("#favoriteButton-"+postId).hasClass("followed")){
			$("#favoriteButton-"+postId).removeClass("followed");
			$("#favoritesPostCount-"+postId).text(parseInt($("#favoritesPostCount-"+postId).text())-1);
			$("#followOptionText-"+postId).text("Follow");
		}else{
			$("#favoriteButton-"+postId).addClass("followed");
			$("#favoritesPostCount-"+postId).text(parseInt($("#favoritesPostCount-"+postId).text())+1);
			$("#followOptionText-"+postId).text("Un-follow");
		}
	});
}
// End of the : Function responsible for following the posts by normal users


// Beggining of the : Function responsible for following the doctors by normal users

function followDoctor(doctorId,type){
	if(type == "one"){
		$("#followButtonText").text("Loading...");
		
	}else if(type == "All"){
		$("#followingButtonTextAll-"+doctorId).text("Loading...");
	}
	event.preventDefault();
	$.ajax({
	// the method the data should be sent with
	method : "POST",

	// the route to which the data should go
	url: DoctorFollow,

	// The data which should be send 
	data: {doctor_id:doctorId, _token:token}

	}).done(function(){
		if(type == "one"){
			if($("#followButtonIcon").hasClass("fa-check")){
				$("#followButtonIcon").removeClass("fa-check");
				$("#followButtonIcon").addClass("fa-plus");
				$("#followButtonText").text("Follow");
			}else{
				$("#followButtonIcon").addClass("fa-check");
				$("#followButtonIcon").removeClass("fa-plus");
				$("#followButtonText").text("Following");
			}
		}else if(type == "All"){
			if($("#followButtonAllIcon-"+doctorId).hasClass("fa-check")){
				$("#followButtonAllIcon-"+doctorId).removeClass("fa-check");
				$("#followButtonAllIcon-"+doctorId).addClass("fa-plus");
				$("#followingButtonTextAll-"+doctorId).text("Follow");
				$("#followingCount").text(parseInt($("#followingCount").text())-1);
				$("#followingCountSmall").text(parseInt($("#followingCountSmall").text())-1);
			}else{
				$("#followButtonAllIcon-"+doctorId).addClass("fa-check");
				$("#followButtonAllIcon-"+doctorId).removeClass("fa-plus");
				$("#followingCount").text(parseInt($("#followingCount").text())+1);
				$("#followingButtonTextAll-"+doctorId).text("Following");
				$("#followingCountSmall").text(parseInt($("#followingCountSmall").text())+1);

			}
		}
	});
}
// End of the : Function responsible for following the doctors by normal users




// Beggging of the function which make sure user delete the comment
function deleteCommentPermission(commentId, type){

	$("#commentConfirmationBox-"+commentId).fadeIn();
	// $("#profileParent").css("opacity","0.4");
	// $("#confirmationBox-"+commentId).css("opacity","1");
	// var sure = window.confirm("Are you sure?");
	// if(sure){
	// 	deleteComments(commentId,postId);
	// }
}

// End of the function which make sure user delete the comment
function closePermissionBox(commentId){
	$("#commentConfirmationBox-"+commentId).fadeOut();
}
// Beggining of the function which delete comment

function deleteComments(commentId,postId){
	
	$("#commentDeleteButton-"+commentId).text(" Deleting...");
	$("#commentDeleteButton-"+commentId).css("color","red");
	$.ajax({
		method: "DELETE",
		url:deleteComment,
		data:{comment_id:commentId,_token:token}
	}).done(function(){
		$("#allCommentsContent-"+commentId).slideUp('fast');
		$("#allcommentsOwnerImage-"+commentId).slideUp('fast');
		$("#commentOptions-"+commentId).hide();
		$("#allReplies-"+commentId).slideUp("fast");

		$("#commentsCount-"+postId).text(parseInt($("#commentsCount-"+postId).text())-1);
		$("#commentcounts1-"+postId).text(parseInt($("#commentcounts1-"+postId).text())-1);
		$("#commentDeleteButton-"+commentId).text(" Delete");
		$("#commentDeleteButton-"+commentId).css("color","#666");
	});
}
// End of the function which delete comment




// Beggging of the function which make sure user delete the reply
function deleteReplyPermission(replyId){
 $("#replyConfirmationBox-"+replyId).fadeIn();	
}
// End of the function which make sure user delete the reply

function closeDeleteReplyPermission(replyId){
 $("#replyConfirmationBox-"+replyId).fadeOut();
}


// Beggining of the function which delete replies
function deleteReplies(replyId,commentId){
	$("#deleteReplyButton-"+replyId).text(" Deleting...");
	$("#deleteReplyButton-"+replyId).css("color","red");
	$.ajax({
		method: "DELETE",
		url:deleteReply,
		data:{reply_id:replyId,_token:token}
	}).done(function(){
		$("#allRepliessContent-"+replyId).slideUp('fast');
		$("#replyOwnerInfo-"+replyId).slideUp('fast');
		$("#repliesOptions-"+replyId).hide();
		$("#replies-count-"+commentId).text(parseInt($("#replies-count-"+commentId).text())-1);
		$("#replies-count1-"+commentId).text(parseInt($("#replies-count1-"+commentId).text())-1);
		$("#deleteReplyButton-"+replyId).text(" Delete");
		$("#deleteReplyButton-"+replyId).css("color","#666");
	});
}
// End of the function which delete replies

