// Beggining of : the function which open the share options menu
function openShareOptions(value){
	$("#shareOptions-"+value).toggle();
	event.preventDefault();
}
// End of : the function which open the share options menu

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


// deleting post confirmation box 
function openPostConfirmation(postId){
 $("#postConfirmationBox-"+postId).fadeIn();
}
function postClosePermissionBox(postId){
 $("#postConfirmationBox-"+postId).fadeOut();
}
// deleging posts confirmation box


// Beggining of the function which delete posts in profile
function deletePosts(postId){
	$("#postDeleteText-"+postId).text("Loading ...");
	$("#postDeleteOption-"+postId).css("color","red");
	$("#postConfirmationBox-"+postId).fadeOut();
	$.ajax({
		method: "DELETE",
		url: deletePost,
		data:{post_id:postId,_token:token}
	}).done(function(){
		$("#mainContent-"+postId).slideUp('fast');
	});
}
// End of the function which delete posts in profile




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Beggining of the : Function responsible for following the posts by normal users
function followQuestion(questionId){
	$("#followOptionText-"+questionId).text("Loading...");
	event.preventDefault();
	$.ajax({
		// the method the data should be sent with
		method : "POST",

		// the route to which the data should go
		url: questionFavorites,

		// The data which should be send 
		data: {question_id:questionId,_token:token}

	}).done(function(){
		if($("#favoriteButton-"+questionId).hasClass("followed")){
			$("#favoriteButton-"+questionId).removeClass("followed");
			$("#favoritesPostCount-"+questionId).text(parseInt($("#favoritesPostCount-"+questionId).text())-1);
			$("#followOptionText-"+questionId).text("Follow");
		}else{
			$("#favoriteButton-"+questionId).addClass("followed");
			$("#favoritesPostCount-"+questionId).text(parseInt($("#favoritesPostCount-"+questionId).text())+1);
			$("#followOptionText-"+questionId).text("Un-follow");
		}
	});
}
// End of the : Function responsible for following the posts by normal users


// deleting question confirmation box 
function openPostConfirmation(postId){
 $("#postConfirmationBox-"+postId).fadeIn();
}
function postClosePermissionBox(postId){
 $("#postConfirmationBox-"+postId).fadeOut();
}
// deleging question confirmation box


// Beggining of the function which delete question in profile
function deleteQuestions(questiontId){
	$("#postDeleteText-"+questiontId).text("Loading ...");
	$("#postDeleteOption-"+questiontId).css("color","red");
	$("#postConfirmationBox-"+questiontId).fadeOut();
	$.ajax({
		method: "DELETE",
		url: deleteQuestion,
		data:{question_id:questiontId,_token:token}
	}).done(function(){
		$("#mainContent-"+questiontId).slideUp('fast');
	});
}
// End of the function which delete question in profile


// Beggining of the : Function responsible for following the doctors by normal users

function followDoctor(doctorId){
	$("#followingButtonText-"+doctorId).text("Loading...");
	event.preventDefault();
	$.ajax({
	// the method the data should be sent with
	method : "POST",

	// the route to which the data should go
	url: DoctorFollow,

	// The data which should be send 
	data: {doctor_id:doctorId, _token:token}

	}).done(function(){
	
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
	
	});
}
// End of the : Function responsible for following the doctors by normal users

