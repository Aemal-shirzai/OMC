// Beggining of : the function which open the share options menu
function openShareOptions(){
	$("#shareOptions").toggle();
	event.preventDefault();
}
// End of : the function which open the share options menu

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
	}).fail(function(response){
		if(response.status == 403){
			$("#notAllowedDiv").fadeIn("slow");
			if(type == "profile" ){
				if($("#followButtonIcon").hasClass("fa-check")){
					$("#followButtonIcon").addClass("fa-check");
					$("#followButtonIcon").removeClass("fa-plus");
					$("#followingButtonText").text("Following");
				}else{
					$("#followButtonIcon").removeClass("fa-check");
					$("#followButtonIcon").addClass("fa-plus");
					$("#followingButtonText").text("Follow");
				}
			}else if(type == "mostVoted"){
				if($("#followButtonIcon-"+doctorId).hasClass("fa-check")){
					$("#followButtonIcon-"+doctorId).addClass("fa-check");
					$("#followButtonIcon-"+doctorId).removeClass("fa-plus");
					$("#followingButtonText-"+doctorId).text("Following");
				}else{
					$("#followButtonIcon-"+doctorId).removeClass("fa-check");
					$("#followButtonIcon-"+doctorId).addClass("fa-plus");
					$("#followingButtonText-"+doctorId).text("Follow");
				}	
			}else{
				if($("#followButtonIconUp-"+doctorId).hasClass("fa-check")){
					$("#followButtonIconUp-"+doctorId).addClass("fa-check");
					$("#followButtonIconUp-"+doctorId).removeClass("fa-plus");
					$("#followingButtonTextUp-"+doctorId).text("Following");
				}else{
					$("#followButtonIconUp-"+doctorId).removeClass("fa-check");
					$("#followButtonIconUp-"+doctorId).addClass("fa-plus");
					$("#followingButtonTextUp-"+doctorId).text("Follow");
				}
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
		}).fail(function(response){
			if(response.status == 403){
				$("#notAllowedDiv").fadeIn("slow");
				if(type == "upVote"){
					$("#postOptionsVoteUpText").text("Up-vote");
				}else{
					$("#postOptionsDownVoteText").text("Down-vote");
				}
				return false;
			}
		});  
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
	}).fail(function(response){
		if(response.status == 403){
			$("#notAllowedDiv").fadeIn("slow");
			if($("#favoriteButton").hasClass("followed")){
				$("#followOptionText").text("Un-follow");
			}else{
				$("#followOptionText").text("Follow");
			}
			return false;
		}
	});
}
// End of the : Function responsible for following the posts by normal users


// Beggining of the function which delete question in profile
function deletePosts(postId){
	$('#deleteBox').modal('hide')
	$("#postDeleteText").text("Loading ...");
	$("#postDeleteText").css("color","red");
	$.ajax({
		method: "DELETE",
		url: deletePost,
		data:{post_id:postId,_token:token}
	}).done(function(){
		$("#mainContent").slideUp('fast');
		$("#postDeleteMessage").show();
	}).fail(function(response){
		if(response.status == 403){
			$("#notAllowedDiv").fadeIn("slow");
			$("#postDeleteText").text("Delete");
			$("#postDeleteText").css("color","#999");
			return false;
		}
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
		$("#msg").text("");
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
	scrollTop: $("#successMsg").offset().top-200},"fast");
 }
 // Adding comment serverside error post 
 if(scroll === "on2"){
 	$("#fileError").show();
 	$("#allComments").show()
	$("html,body").animate({
	scrollTop: $("#fileError").offset().top-200},"fast");
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



		}).fail(function(response){
			if(response.status == 403){
				$("#notAllowedDiv").fadeIn("slow");
				if(type == "upVote"){ // if the up voted is clicked
					if($("#commentVotedUpCheck-"+commentId).hasClass("fa-check")){ // if the up voted button has the class fa-check
					
					 	$("#commentVotedUpCheck-"+commentId).addClass("fas fa-check upVotedCheck"); // if there is not class fa-check then add up vote that class
				 		$("#commentOptionsVoteUpIcon-"+commentId).css("color","#3fbbc0"); //change icon color to green
				 		$("#commentOptionsLoadingUpText-"+commentId).text("");
					 	
					}else{ // if the voted button has no class fa-check it means we vote here not taking our vote back
						$("#commentVotedUpCheck-"+commentId).removeClass("fas fa-check upVotedCheck"); // then remove that class from it, it means we click up vote for two reason to get our vote back or to vote someting and this is the first case
				 		$("#commentOptionsVoteUpIcon-"+commentId).css("color","#666"); // change icon color
				 		$("#commentOptionsLoadingUpText-"+commentId).text("");
					}
				}
				if(type == "downVote"){ // if the user is clicking the down vote button
				if($("#commentVotedDownCheck-"+commentId).hasClass("fa-check")){ // now if the down voted is already clicked it means it that the user has already down voted the post
					$("#commentVotedDownCheck-"+commentId).removeClass("fas fa-check upVotedCheck"); // then remove it . because clicking one button for the second time should take the vote back
			 		$("#commentOptionsVoteDownIcon-"+commentId).css("color","#666"); // change the icon color
			 		$("#commentOptionsLoadingDownText-"+commentId).text("");
					
					$("#commentVotedDownCheck-"+commentId).addClass("fas fa-check upVotedCheck"); // now add the class to down vote button because we are downvoting
					$("#commentOptionsVoteDownIcon-"+commentId).css("color","#3fbbc0"); //change the icon color
					$("#commentOptionsLoadingDownText-"+commentId).text("");
				}else{ // if the user is clickin the down vote for first time
					
					$("#commentVotedDownCheck-"+commentId).removeClass("fas fa-check upVotedCheck"); // then remove it . because clicking one button for the second time should take the vote back
			 		$("#commentOptionsVoteDownIcon-"+commentId).css("color","#666"); // change the icon color
			 		$("#commentOptionsLoadingDownText-"+commentId).text("");
					
				}
			}
			}
		});
}
//End of : The function which add and update vote to comments


function deleteComments(commentId,postOrQuestionId){
	$("#deleteBox").modal("hide")
	event.preventDefault();
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
		$("#reply-"+commentId).slideUp("fast");

		$("#commentsCount").text(parseInt($("#commentsCount").text())-1);
		$("#commentcounts1").text(parseInt($("#commentcounts1").text())-1);
		$("#commentDeleteButton-"+commentId).text(" Delete");
		$("#commentDeleteButton-"+commentId).css("color","#666");
	}).fail(function(response){
		if(response.status == 403){
			$("#notAllowedDiv").fadeIn("slow");
			$("#commentDeleteButton-"+commentId).text("Delete");
			$("#commentDeleteButton-"+commentId).css("color","#999");
		}
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
		}).fail(function(response){
			if(response.status == 403){
				$("#notAllowedDiv").fadeIn("slow");
				if(type == "upVote"){ // if the up voted is clicked
					if($("#replyVotedUpCheck-"+replyId).hasClass("fa-check")){ // if the up voted button has the class fa-check
						$("#replyVotedUpCheck-"+replyId).addClass("fas fa-check upVotedCheck"); // if there is not class fa-check then add up vote that class
				 		$("#replyVotedUpCheck-"+replyId).css("color","#3fbbc0"); //change icon color to green
				 		$("#replyOptionsLoadingUpText-"+replyId).text("");
					}else{ // if the voted button has no class fa-check it means we vote here not taking our vote back
						$("#replyVotedUpCheck-"+replyId).removeClass("fas fa-check upVotedCheck"); // then remove that class from it, it means we click up vote for two reason to get our vote back or to vote someting and this is the first case
				 		$("#replyOptionsVoteUpIcon-"+replyId).css("color","#666"); // change icon color
				 		$("#replyOptionsLoadingUpText-"+replyId).text("");

					}
				}if(type == "downVote"){ // if the user is clicking the down vote button
					if($("#replyVotedDownCheck-"+replyId).hasClass("fa-check")){ // now if the down voted is already clicked it means it that the user has already down voted the post
						$("#replyVotedDownCheck-"+replyId).addClass("fas fa-check upVotedCheck"); // now add the class to down vote button because we are downvoting
						$("#replyOptionsVoteDownIcon-"+replyId).css("color","#3fbbc0"); //change the icon color
						$("#replyOptionsLoadingDownText-"+replyId).text("");			
					}else{ // if the user is clickin the down vote for first time
						$("#replyVotedDownCheck-"+replyId).removeClass("fas fa-check upVotedCheck"); // then remove it . because clicking one button for the second time should take the vote back
				 		$("#replyOptionsVoteDownIcon-"+replyId).css("color","#666"); // change the icon color
				 		$("#replyOptionsLoadingDownText-"+replyId).text("");
						
					}
				}
			}
		});	
}
// End of the function which vote the replies


// Beggining of the function which delete replies
function deleteReplies(replyId,commentId){
	$("#deleteBox").modal("hide")
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
	}).fail(function(response){
		if(response.status == 403){
			$("#notAllowedDiv").fadeIn("slow");
			$("#deleteReplyButton-"+replyId).text("Delete");
			$("#deleteReplyButton-"+replyId).css("color","#999");
		}
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
		}).fail(function(response){
			if(response.status == 403){
				$("#notAllowedDiv").fadeIn("slow");
				if(type == "upVote"){
					$("#postOptionsVoteUpText").text("Up-vote");
				}else{
					$("#postOptionsDownVoteText").text("Down-vote");
				}
			}
		}); 
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
	}).fail(function(response){
		if(response.status == 403){
			$("#notAllowedDiv").fadeIn("slow");
			if($("#favoriteButton").hasClass("followed")){
				$("#favoriteButton").addClass("followed");
				$("#followOptionText").text("Un-follow");
			}else{
				$("#favoriteButton").removeClass("followed");
				$("#followOptionText").text("Follow");
			}	
		}
	});
}

// End of the : Function responsible for following the posts by normal users

// Beggining of the function which delete question in profile
function deleteQuestions(questiontId){
	$('#deleteBox').modal('hide')
	$("#questionDeleteText").text("Loading ...");
	$("#questionDeleteText").css("color","red");
	$.ajax({
		method: "DELETE",
		url: deleteQuestion,
		data:{question_id:questiontId,_token:token}
	}).done(function(){
		$("#mainContent").slideUp('fast');
		$("#questionDeleteMessage").show();
	}).fail(function(response){
		if(response.status == 403){
			$("#notAllowedDiv").fadeIn("slow");
			$("#questionDeleteText").text("Delete");
			$("#questionDeleteText").css("color","#999");
		}
	});
}
// End of the function which delete question in profile



// 
// add comments using ajax
$(".commentForm").submit(function(e){
	event.preventDefault();
	var formData = new FormData(this);
	var post_id = formData.get('post_id');
	showAllCommentsAjax();
	
	$(`#countComment`).after(
		`${showLoad()}
		`
	);
	$.ajax({
		method: "POST",
		url:commentAdd,
		data: formData,
		contentType:false,
		cache:false,	
		processData:false,
	}).done(function(response){
		$("#commentAddLoad").remove();
		if(!$.isEmptyObject(response.comment)){
			afterReplyCommentDone(post_id,"comment");
			$(`#countComment`).after(
				`
				<div class="allcommentsOwnerImage" id="allcommentsOwnerImage-${response.comment['id']}">
					${commentReplyOwnerPhotoShow(response.comment['ownerPhoto'],response.comment['ownerType'])}
					${commentOwnerInfoShow(response.comment['fullName'],response.comment['username'],response.comment['createTime'])}
				</div>	
				<div class="allCommentsContent" id="allCommentsContent-${response.comment['id']}">
					${commentContentShow(response.comment['id'],response.comment['content'])}
					${commentImageShow(response.comment['photo'])}
					${commentOptionsShow(response.comment['id'],post_id)}
				</div>
				<div class ="reply" id="reply-${response.comment['id']}">
					${commentRepliesForm(response.comment['id'],post_id)}
				</div>

				<div class="allReplies" id="allReplies-${response.comment['id']}">
					<div class="mb-2 replies-count" id="replyCount-${response.comment['id']}" style="font-weight: bold;"><span id="replies-count-${response.comment['id']}">0</span> Replies</div>
				</div>
				`
			);
		}else if(!$.isEmptyObject(response.errors)){
			$(`#fileError`).show();
			$(`#msg`).text(`${response.errors['content'] ? (0 in response.errors['content'] ? response.errors['content'][0] : '') : ''} , ${response.errors['photo'] ? (0 in response.errors['photo'] ? response.errors['photo'][0] : '')  : ""}`);
		}else if(!$.isEmptyObject(response.overAllError)){
			$(`#fileError`).show();
			$(`#msg`).text(response.overAllError);
		}
	}).fail(function(response){
		$("#commentAddLoad").remove();
		$(`#fileError`).show();
		$(`#msg`).text("OOPS! something went wrong please try again");
	});
});


// adding replies to comments
var addReply = (e)=>{
	event.preventDefault();

	var formData = new FormData(e.target);
	var comment_id = formData.get('comment_id');
	$(`#replyCount-${comment_id}`).after(
		`${showLoad()}
		`
	);
	$.ajax({
		method: "POST",
		url:replyAdd,
		data: formData,
		contentType:false,
		cache:false,	
		processData:false,
	}).done(function(response){
			$("#commentAddLoad").remove();
			if(!$.isEmptyObject(response.reply)){
				afterReplyCommentDone(comment_id,"reply");
				$(`#replyCount-${comment_id}`).after(
					`<div class="allRepliesOwnerImage" id="replyOwnerInfo-${response.reply['id']}">
						${commentReplyOwnerPhotoShow(response.reply['ownerPhoto'],response.reply['ownerType'])}
						${replyOwnerInfoShow(response.reply['fullName'],response.reply['username'],response.reply['createTime'])}
				 	 </div>
				 	 <div class="allRepliessContent" id="allRepliessContent-${response.reply['id']}">
				 	 	${replyContentShow(response.reply['id'],response.reply['content'])}
				 	 	${replyImageShow(response.reply['photo'])}
						${replyOptionsShow(response.reply['id'],comment_id)}
				 	 </div>
					`
				);
			}else if(!$.isEmptyObject(response.errors)){
				$(`#replyPhotoError-${comment_id}`).show();
				$(`#replymsg-${comment_id}`).text(`${response.errors['replyContent'] ? (0 in response.errors['replyContent'] ? response.errors['replyContent'][0] : '') : ''} , ${response.errors['replyPhoto'] ? (0 in response.errors['replyPhoto'] ? response.errors['replyPhoto'][0] : '')  : ""}`);
			}else if(!$.isEmptyObject(response.overAllError)){
				$(`#replyPhotoError-${comment_id}`).show();
				$(`#replyPhotoError-${comment_id}`).text(response.overAllError);
			}
	}).fail(function(response){
			$("#commentAddLoad").remove();
			$(`#replyPhotoError-${comment_id}`).show();
			$(`#replyPhotoError-${comment_id}`).text("OOPS! something went wrong please try again");
			
	});

}



// functions to show comments and its replies usign ajax

var commentOptionsShow = (id,post_id) =>{
	return `
		<div class="commetOptions" id="commentOptions-${id}">
			<button class="btn" title="Reply" onclick="showReplies(${id})">
				<a href="javascript:void(0)"> 
					<span class="fal fa-reply commentOptionsIcons"></span>  
					<span class="commentVotes">. Reply.  <span id="replies-count1-${id}">0</span> </span>
				</a> 
			</button>
			<button class="btn" onclick="voteComments('${id}','upVote')" title="The answer was usefull">
				<a href="javascript:void(0)">
					<span id="commentVotedUpCheck-${id}"></span>
					<span class="fal fa-arrow-alt-up commentOptionsIcons" id="commentOptionsVoteUpIcon-${id}"></span>
					. <span class="commentVotes" id="commentOptionsVoteUpCount-${id}">0</span>
				</a>
			</button>
			<button class="btn" onclick="voteComments('${id}','downVote')" title="The answer was not usefull">
				<a href="javascript:void(0)">
					<span id="commentVotedDownCheck-${id}"></span>
					<span class="fal fa-arrow-alt-down commentOptionsIcons" id="commentOptionsVoteDownIcon-${id}"></span>
					. <span class="commentVotes" id="commentOptionsVoteDownCount-${id}">0</span>
				</a>
			</button>
			<a href="/comments/${id}/edit"><button class=" commentManageOptions fal fa-edit float-right"> Edit</button></a>
			<button type="button" class="commentManageOptions fal fa-trash float-right" id="commentDeleteButton-${id}" 
					data-toggle="modal" data-target="#deleteBox"  data-id="${id}" data-type="comment" data-post="${post_id}"> 
				Delete
			</button>
		</div>
	`;
}
var commentImageShow = (photo) =>{
	if(photo === ''){
		return 	``;
	}else{
		return `
			<div id="commentImage" class="text-center" style="overflow: hidden;">
				<a href="/storage/images/comments/${photo}" target="__blank">
					<img src="/storage/images/comments/${photo}" class="">
				</a>
			</div>
		`;
	}
}
var commentContentShow = (id,content) => {
	if(content != null){
		if(content.length > 500){
			return `
				<p id="halfComment-${id}">${content.substring(0,500)} <a href="javascript:void(0)" class="readMoreLess" onclick="showComplete(${id},'comment')">... Read more...</a></p>
				<p id="completeComment-${id}" style="display: none;">${content} <a href="javascript:void(0)" class="readMoreLess" onclick="showLess(${id},'comment')"> Read less...</a></p>
			`;		
		}else{
			return `<p>${content}</p>`
		}
	}else{
		return ``;
	}
}
var commentReplyOwnerPhotoShow = (photo,ownerType) =>{

	if(photo === ''){
		return `<span class="fal fa-user" id="no-image-in-comment"></span>`;
	}else{
		if(ownerType === "App\\Doctor"){
			return `<img src="/storage/images/doctors/${photo}">`;

		}else{
			return `<img src="/storage/images/normalUsers/${photo}">`;
		}
	}
}
var commentOwnerInfoShow = (fullName,userName,createTime) => {
	return `
		<div class="commentOwnerName">
			<a href="${userName}"><span>${fullName}</span></a> 
				<span class="commentcreateTime">Commented:${createTime}</span>
		</div>
	`;
}
var commentRepliesForm = (commentId,post_id) => {
	return `
		<div class="alert alert-danger replyImageVideoErrorMsg" id="replyPhotoError-${commentId}" >
			<button class="close" onclick="closeReplyMsgs(${commentId})">&times;</button>
			<span id="replymsg-${commentId}">
			</span>
		</div>
		<div class="commentImageDiv" id="replyImageDiv-${commentId}">
			<button class="close removeImage" onclick="removeReplyImage(${commentId})">&times; 
				<span class="removeEditCommentPhotoText"> Remove photo</span>
			</button>
			<a href="javascript:void(0)" class="fal fa-edit ml-2" onclick="openReplyPhotoField(${commentId})">
				<span class="removeEditCommentPhotoText">Change photo</span>
			</a>
			<div class="text-center" style="overflow: hidden;">
				<img src="" id="replyImg-${commentId}" >
			</div>
		</div>
		<form method="POST" accept-charset="UTF-8" id="repliesForm-${commentId}" action="${replyAdd}" enctype='multipart/form-data' onsubmit='addReply(event)'>
			<div class="input-group">
				<input type="hidden" name="_token" value='${token}'>
				<input type="file" name="replyPhoto" class="replyPhotoField", accept="image/*" id="replyPhotoField-${commentId}" onchange="showAndValidateReplyFile(${commentId})">
				<textarea  name="replyContent" class="form-control replyField" placeholder="Add Reply..." id="replyField-${commentId}" rows="1" maxlength="65500" 
				 onkeyup="do_resize_and_enable_reply_button(this,${commentId})"></textarea>
				 <input type="hidden" name="comment_id" value="${commentId}">
				 <input type="hidden" name="post_id_for_replies" value="${post_id}">
				 <input type="submit" value="Reply" class="btn btn-sm addReplyBtn" id="addReplyBtn-${commentId}" disabled="true" onclick="validateReplyForm(${commentId})">
				 <i class="fal fa-camera replyPhotoButton" id="replyPhotoButton-${commentId}" onclick="openReplyPhotoField(${commentId})"></i>
			</div>
		</form>
	`;
}

var showAllCommentsAjax = () =>{
	$("#allComments").show();
		$("html,body").animate({
		scrollTop: $("#addCommentBtn").offset().top-200},"slow");
}
var showLoad = () =>{
	return `
		<div class="text-center" id="commentAddLoad">
			<img  src="/images/load1.gif" class="mb-3 mt-3 text-center">
		</div>
	`;
}


// reply part

var replyOwnerInfoShow = (fullName,userName,createTime) => {
	return `
		<div class="replyOwnerName">
			<a href="${userName}"><span>${fullName}</span></a> 
				<span class="replyCreateTime">Replied:${createTime}</span>
		</div>
	`;
}
var replyContentShow = (id,content) => {
	if(content != null){
		if(content.length > 300){
			return `
				<p id="halfReply-${id}">${content.substring(0,300)} <a href="javascript:void(0)" class="readMoreLess" onclick="showComplete(${id},'reply')">... Read more...</a></p>
				<p id="completeReply-${id}" style="display: none;">${content} <a href="javascript:void(0)" class="readMoreLess" onclick="showLess(${id},'reply')"> Read less...</a></p>
			`;		
		}else{
			return `<p>${content}</p>`
		}
	}else{
		return ``;
	}
}
var replyImageShow = (photo) =>{
	if(photo === ''){
		return 	``;
	}else{
		return `
			<div class="replyImage text-center" style="overflow: hidden;">
				<a href="/storage/images/comment_replies/${photo}" target="__blank">
					<img src="/storage/images/comment_replies/${photo}" class="">
				</a>
			</div>
		`;
	}
}

var replyOptionsShow = (id,comment_id) =>{
	return `
		<div class="commetOptions" id="repliesOptions-${id}">
			<button class="btn" onclick="voteReplies('${id}','upVote')" title="The answer was usefull">
				<a href="javascript:void(0)">
					<span id="replyVotedUpCheck-${id}"></span>
					<span class="fal fa-arrow-alt-up commentOptionsIcons" id="replyOptionsVoteUpIcon-${id}"></span> 
					<span id="replyOptionsLoadingUpText-${id}"></span>
					<span class="commentVotes" id="replyOptionsVoteUpCount-${id}">0</span>
				</a>
			</button>
			<button class="btn" onclick="voteReplies('${id}','downVote')" title="The answer was not usefull">
				<a href="javascript:void(0)">
					<span id="replyVotedDownCheck-${id}"> </span>
					<span class="fal fa-arrow-alt-down commentOptionsIcons" id="replyOptionsVoteDownIcon-${id}"></span>
					<span id="replyOptionsLoadingDownText-${id}"></span>  
					<span class="commentVotes" id="replyOptionsVoteDownCount-${id}">0</span>
				</a>
			</button>
			<a href="/replies/${id}/edit"><button class=" commentManageOptions fal fa-edit float-right"> Edit</button></a>
			<button type="button" class="commentManageOptions fal fa-trash float-right" id="deleteReplyButton-${id}" 
						data-toggle="modal" data-target="#deleteBox"  data-id="${id}" data-type="reply" data-comment="${comment_id}"> 
				Delete
			</button>
			<div class="dropdown-divider reply-divider"></div>
		</div>
	`;
}

var afterReplyCommentDone = (id,type) => {
	if(type == "comment"){
		$(`#commentsCount`).text(parseInt($(`#commentsCount`).text())+1);
		$(`#commentcounts1`).text(parseInt($(`#commentcounts1`).text())+1);
		$(`#commentImageDiv`).hide("fast");	
		$(".commentForm").trigger("reset");	
		$(`#commentField`).attr("rows",'1');	
		$(`#addCommentBtn`).attr("disabled",'true');
	}else if(type == "reply"){
		$(`#replyPhotoError-${id}`).hide();
		$(`#replies-count-${id}`).text(parseInt($(`#replies-count-${id}`).text())+1);
		$(`#replies-count1-${id}`).text(parseInt($(`#replies-count1-${id}`).text())+1);
		$(`#repliesForm-${id}`).trigger("reset");
		$(`#replyImageDiv-${id}`).hide("fast");	
		$(`#replyField-${id}`).attr("rows",'1');
		$(`#addReplyBtn-${id}`).attr("disabled",'true');
	}
}