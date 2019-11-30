// Beggining of : the function which open the share options menu
function openShareOptions(){
	$("#shareOptions").toggle();
	event.preventDefault();
}
// End of : the function which open the share options menu

// Beggingon of the function which open the upvoter list
function openUpVotersList(){
	$("#upVotersList").fadeToggle();
	$("#DownVotersList").hide("fast");
	$("#follwersList").hide("fast");
}

//End of the function which open the upvoter list

// Beggingon of the function which close the upvoter list
function closeUpVotersList(){
	$("#upVotersList").fadeOut();
}
//End of the function which clse the upvoter lis


// Beggingon of the function which open the down list
function openDownVotersList(){
	$("#DownVotersList").fadeToggle();
	$("#upVotersList").hide("fast");
	$("#follwersList").hide("fast");
}
//End of the function which open the down list

// Beggingon of the function which close the Down list
function closeDownVotersList(){
	$("#DownVotersList").fadeOut();
}
//End of the function which clse the down list

// Beggingon of the function which open the upvoter list
function openFollowersList(){
	$("#follwersList").fadeToggle();
	$("#upVotersList").hide("fast");
	$("#DownVotersList").hide("fast");
}
//End of the function which open the upvoter list
// Beggingon of the function which close the upvoter list
function closeFollowersList(){
	$("#follwersList").fadeOut();
}
//End of the function which clse the upvoter list




// Beggining of the : Function responsible for following the doctors by normal users
function followDoctor(doctorId,type){
	if(type == "profile"){
		$("#followingButtonText").text("Loading...");
	}else if(type == "mostVoted"){
		$("#followingButtonText-"+doctorId).text("Loading...");
	}else{
		$("#followingButtonTextUp-"+doctorId).text("Loading...");
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
		if(type == "profile" ){
			if($("#followButtonIcon").hasClass("fa-check")){
				$("#followButtonIcon").removeClass("fa-check");
				$("#followButtonIcon").addClass("fa-plus");
				$("#followingButtonText").text("Follow");
			}else{
				$("#followButtonIcon").addClass("fa-check");
				$("#followButtonIcon").removeClass("fa-plus");
				$("#followingButtonText").text("Following");
			}
		}else if(type == "mostVoted"){
			if($("#followButtonIcon-"+doctorId).hasClass("fa-check")){
				$("#followButtonIcon-"+doctorId).removeClass("fa-check");
				$("#followButtonIcon-"+doctorId).addClass("fa-plus");
				$("#followingButtonText-"+doctorId).text("Follow");
				$("#followCount-"+doctorId).text(parseInt($("#followCount-"+doctorId).text())-1);
			}else{
				$("#followButtonIcon-"+doctorId).addClass("fa-check");
				$("#followButtonIcon-"+doctorId).removeClass("fa-plus");
				$("#followingButtonText-"+doctorId).text("Following");
				$("#followCount-"+doctorId).text(parseInt($("#followCount-"+doctorId).text())+1);
			}
		}else{
			if($("#followButtonIconUp-"+doctorId).hasClass("fa-check")){
				$("#followButtonIconUp-"+doctorId).removeClass("fa-check");
				$("#followButtonIconUp-"+doctorId).addClass("fa-plus");
				$("#followingButtonTextUp-"+doctorId).text("Follow");
				$("#followCountUp-"+doctorId).text(parseInt($("#followCount-"+doctorId).text())-1);
			}else{
				$("#followButtonIconUp-"+doctorId).addClass("fa-check");
				$("#followButtonIconUp-"+doctorId).removeClass("fa-plus");
				$("#followingButtonTextUp-"+doctorId).text("Following");
				$("#followCountUp-"+doctorId).text(parseInt($("#followCount-"+doctorId).text())+1);
			}
		}
	});
}
// End of the : Function responsible for following the doctors by normal users

// Beggining of the function which readmore and readless the post content and comment contents 
 function showComplete(value,type){
 	if(type == "post"){
	 	$("#halfContent").hide();
	 	$("#completeContent").show();
 	}else if(type == "comment"){
 		$("#halfComment-"+value).hide();
	 	$("#completeComment-"+value).show();
 	}else if(type == "reply"){
 		$("#halfReply-"+value).hide();
	 	$("#completeReply-"+value).show();
 	}

 	// For questions
 	if(type == "question"){
 		$("#QhalfContent").hide();
	 	$("#QcompleteContent").show();
 	}else if(type == "Qcomments"){
 		$("#QhalfComment-"+value).hide();
	 	$("#QcompleteComment-"+value).show();
 	}else if(type == "QReplies"){
 		$("#QhalfReply-"+value).hide();
	 	$("#QcompleteReply-"+value).show();
 	}
 }

 function showLess(value,type){
 	if(type == "post"){
	 	$("#completeContent").hide();
	 	$("#halfContent").show();
 	}else if(type == "comment"){
 		$("#halfComment-"+value).show();
	 	$("#completeComment-"+value).hide();
 	}else if(type == "reply"){
 		$("#halfReply-"+value).show();
	 	$("#completeReply-"+value).hide();
 	}

  	// For questions
 	if(type == "question"){
 		$("#QhalfContent").show();
	 	$("#QcompleteContent").hide();
 	}else if(type == "Qcomments"){
 		$("#QhalfComment-"+value).show();
	 	$("#QcompleteComment-"+value).hide();
 	}else if(type == "QReplies"){
 		$("#QhalfReply-"+value).show();
	 	$("#QcompleteReply-"+value).hide();
 	}
 }
 // End of the function which readmore and readless the post content and comment content

 //Beggining of : The function which add and update vote to post
function vote(postId,type){
	if(type == "upVote"){
		$("#postOptionsVoteUpText").text("Loading..");
	}else{
		$("#postOptionsDownVoteText").text("Loading..");
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
				if($("#upVotedCheck").hasClass("fa-check")){ // if the up voted button has the class fa-check
					$("#upVotedCheck").removeClass("fas fa-check upVotedCheck"); // then remove that class from it, it means we click up vote for two reason to get our vote back or to vote someting and this is the first case
			 		$("#postOptionsVoteUpIcon").css("color","#666"); // change icon color
				 	$("#postOptionsVoteUpText").css("color","#666");// changed text color
				 	$("#postOptionsVoteUpText").text("Up-vote"); // change button text
				 	$("#postOptionsVoteUpCount").text(parseInt($("#postOptionsVoteUpCount").text())-1); // and substruct one from the up votes because we are not adding new vote we are just taking our vote back
				 	$("#upVoters").text(parseInt($("#upVoters").text())-1); // and substruct one from the up votes because we are not adding new vote we are just taking our vote back
				 	
				}else{ // if the voted button has no class fa-check it means we vote here not taking our vote back
					if($("#downVotedCheck").hasClass("fa-check")){ // here if the down the current user has down voted the post
						$("#downVotedCheck").removeClass("fas fa-check upVotedCheck"); // then remove the class from down voted votes
						$("#postOptionsDownVoteText").css("color","#666"); // changed down voted votes color to simple
						$("#postOptionsDownVoteText").text("Down-vote"); //change its text aswell
				 		$("#postOptionsDownVoteUpIcon").css("color","#666"); // change its icon color
				 		$("#postOptionsVoteDownCount").text(parseInt($("#postOptionsVoteDownCount").text())-1); // and stubsturct one from the downvotes because adding the up vote because one user cant up vote and down vote a post at same time
				 		$("#downVoters").text(parseInt($("#downVoters").text())-1); // and stubsturct one from the downvotes because adding the up vote because one user cant up vote and down vote a post at same time
					}
					$("#upVotedCheck").addClass("fas fa-check upVotedCheck"); // if there is not class fa-check then add up vote that class
			 		$("#postOptionsVoteUpIcon").css("color","#3fbbc0"); //change icon color to green
				 	$("#postOptionsVoteUpText").css("color","#3fbbc0"); // change text color
				 	$("#postOptionsVoteUpText").text("Up-voted");	// change button text
				 	$("#postOptionsVoteUpCount").text(parseInt($("#postOptionsVoteUpCount").text())+1); // and add one to the total of up voted votes
				 	$("#upVoters").text(parseInt($("#upVoters").text())+1); // and add one to the total of up voted votes
				}
			}
			if(type == "voteDown"){ // if the user is clicking the down vote button
				if($("#downVotedCheck").hasClass("fa-check")){ // now if the down voted is already clicked it means it that the user has already down voted the post
					$("#downVotedCheck").removeClass("fas fa-check upVotedCheck"); // then remove it . because clicking one button for the second time should take the vote back
					$("#postOptionsDownVoteText").css("color","#666"); // change text color to simple
					$("#postOptionsDownVoteText").text("Down-vote");	//change button text
			 		$("#postOptionsDownVoteUpIcon").css("color","#666"); // change the icon color
			 		$("#postOptionsVoteDownCount").text(parseInt($("#postOptionsVoteDownCount").text())-1); // and substrruct one from downvotes because we are taking our vote back
			 		$("#downVoters").text(parseInt($("#downVoters").text())-1); // and substrruct one from downvotes because we are taking our vote back
				}else{ // if the user is clickin the down vote for first time
					if($("#upVotedCheck").hasClass("fa-check")){ // now if the user has already up voted the post then
						$("#upVotedCheck").removeClass("fas fa-check upVotedCheck"); // remove the upvoted from the user
				 		$("#postOptionsVoteUpIcon").css("color","#666"); // romve icon color
					 	$("#postOptionsVoteUpText").css("color","#666"); // change text color
					 	$("#postOptionsVoteUpText").text("Up-vote"); //chagne button text
					 	$("#postOptionsVoteUpCount").text(parseInt($("#postOptionsVoteUpCount").text())-1);// and sustruct one fro the up votes because one user can not vote up and down at the same time
					 	$("#upVoters").text(parseInt($("#upVoters").text())-1);// and sustruct one fro the up votes because one user can not vote up and down at the same time
					}
					$("#downVotedCheck").addClass("fas fa-check upVotedCheck"); // now add the class to down vote button because we are downvoting
					$("#postOptionsDownVoteText").css("color","#3fbbc0"); //change the text color
					$("#postOptionsDownVoteText").text("Down-voted"); //change the button text
					$("#postOptionsDownVoteUpIcon").css("color","#3fbbc0"); //change the icon color
					$("#postOptionsVoteDownCount").text(parseInt($("#postOptionsVoteDownCount").text())+1); // and add one to the total of the down voted votes
					$("#downVoters").text(parseInt($("#downVoters").text())+1); // and add one to the total of the down voted votes
				}
			}
		});  // done function end
}
//End of : The function which add and update vote to post

// Beggining of the : Function responsible for following the posts by normal users
function followPost(postId){
	$("#followOptionText").text("Loading...");
	event.preventDefault();
	$.ajax({
		// the method the data should be sent with
		method : "POST",

		// the route to which the data should go
		url: postFavorites,

		// The data which should be send 
		data: {post_id:postId,_token:token}

	}).done(function(){
		if($("#favoriteButton").hasClass("followed")){
			$("#favoriteButton").removeClass("followed");
			$("#favoritesPostCount").text(parseInt($("#favoritesPostCount").text())-1);
			$("#follwers").text(parseInt($("#follwers").text())-1);
			$("#followOptionText").text("Follow");
		}else{
			$("#favoriteButton").addClass("followed");
			$("#favoritesPostCount").text(parseInt($("#favoritesPostCount").text())+1);
			$("#follwers").text(parseInt($("#follwers").text())+1);
			$("#followOptionText").text("Un-follow");
		}
	});
}
// End of the : Function responsible for following the posts by normal users


// deleting question confirmation box 
function openPostConfirmation(){
 $("#postConfirmationBox").fadeIn();
}
function postClosePermissionBox(){
 $("#postConfirmationBox").fadeOut();
}
// deleging question confirmation box


// Beggining of the function which delete question in profile
function deletePosts(postId){
	$("#postDeleteText").text("Loading ...");
	$("#postDeleteText").css("color","red");
	$("#postConfirmationBox").fadeOut();
	$.ajax({
		method: "DELETE",
		url: deletePost,
		data:{post_id:postId,_token:token}
	}).done(function(){
		$("#mainContent").slideUp('fast');
		$("#postDeleteMessage").show();
	});
}
// End of the function which delete question in profile





// Beggining of : the function which open the comment photo field
function openCommentPhotoField(){
	// var field = document.getElementById("commentPhotoField-"+value);
	var field = document.getElementById("commentPhotoField");
	field.value = "";
	$("#commentImageDiv").hide();
	if(document.getElementById("commentField").value.trim().length < 1){
		document.getElementById("addCommentBtn").disabled = true;
	}
	field.click();
}
 // End of : the function which open the comment photo field



 // Beggining of th function whihc is responsible to show the image on the screen after beign seleccted
function showpic(input,id){
	if(input.files && input.files[0]){
		var reader = new FileReader();

		reader.onload = function(e){
			$("#commentImg").attr("src",e.target.result);	
		}

		reader.readAsDataURL(input.files[0]);
	}
}
// End of th function whihc is responsible to show the image on the screen after beign seleccted

// Beggining of the functio which validate the comment image
function showAndValidateFile(value){
	var field = document.getElementById("commentPhotoField");
	var button = document.getElementById("addCommentBtn");
	var commentField = document.getElementById("commentField");
	var fileType = field.value.split(".").pop().toLowerCase();
	if(fileType == "jpg" || fileType == "bmp" || fileType == "jpeg" || fileType == "png" || fileType == "gif" || fileType == "svg"){
		if(field.files[0].size/1024/1024 < 10){
			$("#commentImageDiv").show();
			button.disabled =false; // It enable the add comment button because the image is correct
			$("#fileError").hide();
			showpic(field,value);
		}else{
			$("#fileError").show();
			field.value= "";
			$("#commentImageDiv").hide();
			$("#msg").text("File too large. max 10MB...");
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
		$("#fileError").show();
		field.value= "";
		$("#commentImageDiv").hide();
		$("#msg").text("Invalid file. Only photos are allowed...");
		event.preventDefault();
	}
}
// End of of the functio which validate the comment image

// Beggining of the function which Remove the comment image when click remove image
	function removeImage(){
		var field = document.getElementById("commentPhotoField");
		var commentField = document.getElementById("commentField");
		var button = document.getElementById("addCommentBtn");
		/* By clicking the remove photo field the photo length becomes 0 because the path is cleared  
		   so now this if checks if the commetn field is also empty the disable the commetn button */
		if(commentField.value.trim().length < 1){
			button.disabled = true;
		}
		field.value= "";
		$("#commentImageDiv").hide();
	}
// Endof of the function which Remove the comment image when click remove image

// Beggining of the function which close the eroror msg while clikcing on the cross button
function closeMsgs(){
	document.getElementById("fileError").style.display = "none";
}
// End of the function which close the eroror msg while clikcing on the cross button

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
	document.getElementById("addCommentBtn").disabled = false;
	}else{
		if(document.getElementById("commentPhotoField").files.length < 1){
			document.getElementById("addCommentBtn").disabled = true;
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
 // Begginng of : the function which validate the comment form
function validateCommentForm(){
	var field = document.getElementById("commentField");
	var photoField = document.getElementById("commentPhotoField");

	if(field.value.trim().length >= 65500){
		field.focus();
		$("#fileError").show();
		$("#msg").text("Too Long Text");
		field.style.border = "1px solid red";
		field.placeholder = "Too long text";
		event.preventDefault();
	}else{
		$("#fileError").hide();
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
 // End of the function which resize the comment text area when the text increase, AND the function whihc enable the commnet button
$(document).ready(function(){
// Adding comment serverside successs for post
 if(scroll === "on"){
 	$("#successMsg").show();
 	$("#allComments").show();
	$("html,body").animate({
	scrollTop: $("#successMsg").offset().top-350},"fast");
 }
 // Adding comment serverside error post 
 if(scroll === "on2"){
 	$("#fileError").show();
 	$("#allComments").show()
	$("html,body").animate({
	scrollTop: $("#fileError").offset().top-350},"fast");
 }

// Beggingin of: reply success messages scrols 
 if(scroll === "toReplySuccess"){
 	$("#allComments").show();
 	$("#allReplies-"+comment_id).show();
 	$("#reply-"+comment_id).show();
 	$("#replySuccessMsg-"+comment_id).show();

 	$("html,body").animate({
		scrollTop: $("#replySuccessMsg-"+comment_id).offset().top-150},"fast");	
 }
// End of reply success messsgae scroll

// Beggingin of: reply error messages scrols 
 if(scroll === "toReplyError"){
 	$("#allComments").show();
 	$("#allReplies-"+comment_id).show();
 	$("#reply-"+comment_id).show();
 	$("#replyPhotoError-"+comment_id).show();

 	$("html,body").animate({
		scrollTop: $("#replyPhotoError-"+comment_id).offset().top-150},"fast");;	
 }
// End of reply error messsgae scroll

});

// beggining of: the function which shows all comments
function showAllComments(){
	$("#allComments").toggle();
		$("html,body").animate({
		scrollTop: $("#commentPart").offset().top-200},"slow");
}		
// End of: the function which shows all comments

// beggining of: the function which shows reply form
function showReplies(value){
	$("#reply-"+value).toggle();
	// $('#replyField-'+value).focus();
	$("#allReplies-"+value).toggle();
}
// End of: the function which shows reply form

//Beggining of : The function which add and update vote to commnets  NOTE WORK FOR BOTH QUESTIONS AND POSTS
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

// Beggging of the function which make sure user delete the comment
function deleteCommentPermission(commentId){
	$("#commentConfirmationBox-"+commentId).fadeIn();
}

// End of the function which make sure user delete the comment
function closePermissionBox(commentId){
	$("#commentConfirmationBox-"+commentId).fadeOut();
}
// Beggining of the function which delete comment

function deleteComments(commentId,postOrQuestionId){
	event.preventDefault();
	$("#commentDeleteButton-"+commentId).text(" Deleting...");
	$("#commentDeleteButton-"+commentId).css("color","red");
	$("#commentConfirmationBox-"+commentId).fadeOut('fast');
	$.ajax({
		method: "DELETE",
		url:deleteComment,
		data:{comment_id:commentId,_token:token}
	}).done(function(){
		$("#allCommentsContent-"+commentId).slideUp('fast');
		$("#allcommentsOwnerImage-"+commentId).slideUp('fast');
		$("#commentOptions-"+commentId).hide();
		$("#allReplies-"+commentId).slideUp("fast");
		$("#reply-"+commentId).slideUp("fast");

		$("#commentsCount").text(parseInt($("#commentsCount").text())-1);
		$("#commentcounts1").text(parseInt($("#commentcounts1").text())-1);
		$("#commentDeleteButton-"+commentId).text(" Delete");
		$("#commentDeleteButton-"+commentId).css("color","#666");
	});
}
// End of the function which delete comment


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



// Begginign of the function which vote the replies  NOTE FOR BOTH POSTS AND QUESTION WORK THE SAME

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
	event.preventDefault();
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
// End of the function which delete replies-count1



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Beggining of : The function which add and update vote to qustions
function Qvote(qustionId,type){
	if(type == "upVote"){
		$("#postOptionsVoteUpText").text("Loading..");
	}else{
		$("#postOptionsDownVoteText").text("Loading..");
	}
	event.preventDefault();
	$.ajax({
		//sending data using post method
		method: "post",
		// The url is passed from the profile blade
		url : questionVote,
		// the token is also passed from profile blade
		data : {voteType:type,question_id:qustionId, _token: token},

	})
		.done(function(){ // if the request is done seccessfully thn:

			if(type == "upVote"){ // if the up voted is clicked
				if($("#upVotedCheck").hasClass("fa-check")){ // if the up voted button has the class fa-check
					$("#upVotedCheck").removeClass("fas fa-check upVotedCheck"); // then remove that class from it, it means we click up vote for two reason to get our vote back or to vote someting and this is the first case
			 		$("#postOptionsVoteUpIcon").css("color","#666"); // change icon color
				 	$("#postOptionsVoteUpText").css("color","#666");// changed text color
				 	$("#postOptionsVoteUpText").text("Up-vote"); // change button text
				 	$("#postOptionsVoteUpCount").text(parseInt($("#postOptionsVoteUpCount").text())-1); // and substruct one from the up votes because we are not adding new vote we are just taking our vote back
				 	$("#upVoters").text(parseInt($("#upVoters").text())-1); // and substruct one from the up votes because we are not adding new vote we are just taking our vote back
				 	
				}else{ // if the voted button has no class fa-check it means we vote here not taking our vote back
					if($("#downVotedCheck").hasClass("fa-check")){ // here if the down the current user has down voted the post
						$("#downVotedCheck").removeClass("fas fa-check upVotedCheck"); // then remove the class from down voted votes
						$("#postOptionsDownVoteText").css("color","#666"); // changed down voted votes color to simple
						$("#postOptionsDownVoteText").text("Down-vote"); //change its text aswell
				 		$("#postOptionsDownVoteUpIcon").css("color","#666"); // change its icon color
				 		$("#postOptionsVoteDownCount").text(parseInt($("#postOptionsVoteDownCount").text())-1); // and stubsturct one from the downvotes because adding the up vote because one user cant up vote and down vote a post at same time
				 		$("#downVoters").text(parseInt($("#downVoters").text())-1); // and stubsturct one from the downvotes because adding the up vote because one user cant up vote and down vote a post at same time
					}
					$("#upVotedCheck").addClass("fas fa-check upVotedCheck"); // if there is not class fa-check then add up vote that class
			 		$("#postOptionsVoteUpIcon").css("color","#3fbbc0"); //change icon color to green
				 	$("#postOptionsVoteUpText").css("color","#3fbbc0"); // change text color
				 	$("#postOptionsVoteUpText").text("Up-voted");	// change button text
				 	$("#postOptionsVoteUpCount").text(parseInt($("#postOptionsVoteUpCount").text())+1); // and add one to the total of up voted votes
				 	$("#upVoters").text(parseInt($("#upVoters").text())+1); // and add one to the total of up voted votes
				}
			}
			if(type == "voteDown"){ // if the user is clicking the down vote button
				if($("#downVotedCheck").hasClass("fa-check")){ // now if the down voted is already clicked it means it that the user has already down voted the post
					$("#downVotedCheck").removeClass("fas fa-check upVotedCheck"); // then remove it . because clicking one button for the second time should take the vote back
					$("#postOptionsDownVoteText").css("color","#666"); // change text color to simple
					$("#postOptionsDownVoteText").text("Down-vote");	//change button text
			 		$("#postOptionsDownVoteUpIcon").css("color","#666"); // change the icon color
			 		$("#postOptionsVoteDownCount").text(parseInt($("#postOptionsVoteDownCount").text())-1); // and substrruct one from downvotes because we are taking our vote back
			 		$("#downVoters").text(parseInt($("#downVoters").text())-1); // and substrruct one from downvotes because we are taking our vote back
				}else{ // if the user is clickin the down vote for first time
					if($("#upVotedCheck").hasClass("fa-check")){ // now if the user has already up voted the post then
						$("#upVotedCheck").removeClass("fas fa-check upVotedCheck"); // remove the upvoted from the user
				 		$("#postOptionsVoteUpIcon").css("color","#666"); // romve icon color
					 	$("#postOptionsVoteUpText").css("color","#666"); // change text color
					 	$("#postOptionsVoteUpText").text("Up-vote"); //chagne button text
					 	$("#postOptionsVoteUpCount").text(parseInt($("#postOptionsVoteUpCount").text())-1);// and sustruct one fro the up votes because one user can not vote up and down at the same time
					 	$("#upVoters").text(parseInt($("#upVoters").text())-1);// and sustruct one fro the up votes because one user can not vote up and down at the same time
					}
					$("#downVotedCheck").addClass("fas fa-check upVotedCheck"); // now add the class to down vote button because we are downvoting
					$("#postOptionsDownVoteText").css("color","#3fbbc0"); //change the text color
					$("#postOptionsDownVoteText").text("Down-voted"); //change the button text
					$("#postOptionsDownVoteUpIcon").css("color","#3fbbc0"); //change the icon color
					$("#postOptionsVoteDownCount").text(parseInt($("#postOptionsVoteDownCount").text())+1); // and add one to the total of the down voted votes
					$("#downVoters").text(parseInt($("#downVoters").text())+1); // and add one to the total of the down voted votes
				}
			}
		});  // done function end
}
//End of : The function which add and update vote to questions


// Beggining of the : Function responsible for following the posts by normal users
function followQuestion(questionId){
	$("#followOptionText").text("Loading...");
	event.preventDefault();
	$.ajax({
		// the method the data should be sent with
		method : "POST",

		// the route to which the data should go
		url: questionFavorites,

		// The data which should be send 
		data: {question_id:questionId,_token:token}

	}).done(function(){
		if($("#favoriteButton").hasClass("followed")){
			$("#favoriteButton").removeClass("followed");
			$("#favoritesPostCount").text(parseInt($("#favoritesPostCount").text())-1);
			$("#follwers").text(parseInt($("#follwers").text())-1);
			$("#followOptionText").text("Follow");
		}else{
			$("#favoriteButton").addClass("followed");
			$("#favoritesPostCount").text(parseInt($("#favoritesPostCount").text())+1);
			$("#follwers").text(parseInt($("#follwers").text())+1);
			$("#followOptionText").text("Un-follow");
		}
	});
}
// End of the : Function responsible for following the posts by normal users

// deleting question confirmation box 
function openQuestionConfirmation(){
 $("#questionConfirmationBox").fadeIn();
}
function questionClosePermissionBox(){
 $("#questionConfirmationBox").fadeOut();
}
// deleging question confirmation box


// Beggining of the function which delete question in profile
function deleteQuestions(questiontId){
	$("#questionDeleteText").text("Loading ...");
	$("#questionDeleteText").css("color","red");
	$("#questionConfirmationBox").fadeOut();
	$.ajax({
		method: "DELETE",
		url: deleteQuestion,
		data:{question_id:questiontId,_token:token}
	}).done(function(){
		$("#mainContent").slideUp('fast');
		$("#questionDeleteMessage").show();
	});
}
// End of the function which delete question in profile


