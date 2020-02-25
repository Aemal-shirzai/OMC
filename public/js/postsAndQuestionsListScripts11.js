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
			$("#followOptionText-"+postId).text("(follow)");
		}else{
			$("#favoriteButton-"+postId).addClass("followed");
			$("#favoritesPostCount-"+postId).text(parseInt($("#favoritesPostCount-"+postId).text())+1);
			$("#followOptionText-"+postId).text("(following)");
		}
	}).fail(function(response){
		if(response.status == 403){
			$("#notAllowedDiv").fadeIn("slow");
			if($("#favoriteButton-"+postId).hasClass("followed")){
				$("#followOptionText-"+postId).text("(following)");
			}else{
				$("#followOptionText-"+postId).text("(follow)");
			}
			return false;
		}
	});
}
// End of the : Function responsible for following the posts by normal users

// Beggining of the function which delete posts in profile
function deletePosts(postId){
	$('#deleteBox').modal('hide')	
	$("#postDeleteText-"+postId).text("Loading ...");
	$("#postDeleteOption-"+postId).css("color","red");
	$.ajax({
		method: "DELETE",
		url: deletePost,
		data:{post_id:postId,_token:token}
	}).done(function(){
		$("#mainContent-"+postId).slideUp('fast');
	}).fail(function(response){
			if(response.status == 403){
				$("#notAllowedDiv").fadeIn("slow");
				$("#postDeleteText-"+postId).text("Delete");
				$("#postDeleteOption-"+postId).css("color","black");
				return false;
			}
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
			$("#followOptionText-"+questionId).text("(follow)");
		}else{
			$("#favoriteButton-"+questionId).addClass("followed");
			$("#favoritesPostCount-"+questionId).text(parseInt($("#favoritesPostCount-"+questionId).text())+1);
			$("#followOptionText-"+questionId).text("(following)");
		}
	}).fail(function(response){
		if(response.status == 403){
			$("#notAllowedDiv").fadeIn("slow");
			if($("#favoriteButton-"+questionId).hasClass("followed")){
				$("#favoriteButton-"+questionId).addClass("followed");	
				$("#followOptionText-"+questionId).text("(following)");
			}else{
				$("#favoriteButton-"+questionId).removeClass("followed");
				$("#followOptionText-"+questionId).text("(follow)");
			}
		}
	});
}
// End of the : Function responsible for following the posts by normal users


// Beggining of the function which delete question in profile
function deleteQuestions(questiontId){
	$('#deleteBox').modal('hide')
	$("#postDeleteText-"+questiontId).text("Loading ...");
	$("#postDeleteOption-"+questiontId).css("color","red");
	$.ajax({
		method: "DELETE",
		url: deleteQuestion,
		data:{question_id:questiontId,_token:token}
	}).done(function(){
		$("#mainContent-"+questiontId).slideUp('fast');
	}).fail(function(response){
		if(response.status == 403){
			$("#notAllowedDiv").fadeIn("slow");
			$("#postDeleteText-"+questiontId).text("Delete");
			$("#postDeleteOption-"+questiontId).css("color","#999");
		}
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
	
	}).fail(function(response){
		if(response.status == 403){
			$("#notAllowedDiv").fadeIn("slow");
			if($("#followButtonIcon-"+doctorId).hasClass("fa-check")){
				$("#followButtonIcon-"+doctorId).addClass("fa-check");
				$("#followButtonIcon-"+doctorId).removeClass("fa-plus");
				$("#followingButtonText-"+doctorId).text("Following");
			}else{
				$("#followButtonIcon-"+doctorId).removeClass("fa-check");
				$("#followButtonIcon-"+doctorId).addClass("fa-plus");
				$("#followingButtonText-"+doctorId).text("Follow");
			}
		}
	});
}
// End of the : Function responsible for following the doctors by normal users

//  Search part 

//BO: this function get the value from the ajax return search result and put that into the textfield
function getdata(value){
	$("#searchForField").val(value);
	$("#searchForField").focus();
	$("#searchResult").hide();
}
//EO: this function get the value from the ajax return search result and put that into the textfield

// BO:  function show the avaibible posts based on user search 

function searchPosts(){
	var value = $("#searchForField").val();
	var resultBox = $("#searchResult");
	var resultsDiv = $("#allResultsDiv");
	var imageLoad = $("#searchLoad");
	var searchText = $("#searchText");
	
	resultBox.show();
	imageLoad.show();
	searchText.text("searching");

	if(value.trim().length < 1){
		resultBox.hide();
		resultsDiv.text("");
		imageLoad.hide();
		searchText.text("");
		return false;	
	}else{
		$("#searchForField").css("border","1px solid #ced4da");
		$("#searchForField").attr("placeholder","Search doctors");
	}

	$.ajax({
		method: "GET",
		url:postsSearchResult,
		data:{data:value, _token:token},
	}).done(function(response){
		imageLoad.hide();
		searchText.text("resutls");
		if(!$.isEmptyObject(response.resultFound)){
			resultsDiv.text("");
			$.each(response.resultFound,function(index,value){
				resultsDiv.append($("<a href='javascript:void(0)' onclick='getdata(" + '"' + value.title  + '"' + ")'>").text(value.title));
			});
		}else{
			if(!$.isEmptyObject(response.resultNotFound)){
				resultsDiv.text(response.resultNotFound);
				resultsDiv.css("font-size","12px");
			}
		}

	}).fail(function(response){
		imageLoad.hide();
		searchText.text("resutls");
		resultsDiv.text("oops! Someting went wrong!");
		resultsDiv.css("font-size","12px");
	});
}
// EO: This function show the avaibible posts based on user search

// BO:  function show the avaibible questions based on user search 
function searchQuestions(){
	var value = $("#searchForField").val();
	var resultBox = $("#searchResult");
	var resultsDiv = $("#allResultsDiv");
	var imageLoad = $("#searchLoad");
	var searchText = $("#searchText");
	
	resultBox.show();
	imageLoad.show();
	searchText.text("searching");

	if(value.trim().length < 1){
		resultBox.hide();
		resultsDiv.text("");
		imageLoad.hide();
		searchText.text("");
		return false;	
	}else{
		$("#searchForField").css("border","1px solid #ced4da");
		$("#searchForField").attr("placeholder","Search doctors");
	}

	$.ajax({
		method: "GET",
		url:questionsSearchResult,
		data:{data:value, _token:token},
	}).done(function(response){
		imageLoad.hide();
		searchText.text("resutls");
		if(!$.isEmptyObject(response.resultFound)){
			resultsDiv.text("");
			$.each(response.resultFound,function(index,value){
				resultsDiv.append($("<a href='javascript:void(0)' onclick='getdata(" + '"' + value.title  + '"' + ")'>").text(value.title));
			});
		}else{
			if(!$.isEmptyObject(response.resultNotFound)){
				resultsDiv.text(response.resultNotFound);
				resultsDiv.css("font-size","12px");
			}
		}

	}).fail(function(response){
		imageLoad.hide();
		searchText.text("resutls");
		resultsDiv.text("oops! Someting went wrong!");
		resultsDiv.css("font-size","12px");
	});
}
// EO: This function show the avaibible normal users based on user search


// this is diffrent from bellow submit this is done when some one click that search icon
function submitSearchForm(){
	if($("#searchForField").val().trim().length < 1){
		$("#searchForField").css("border","1px solid red");
		$("#searchForField").attr("placeholder","You need to type");
		event.preventDefault();
	}else if($("#searchForField").val().trim().length > 200){
		$("#searchForField").css("border","1px solid red");
		$("#searchForField").attr("placeholder","Too long search");
		event.preventDefault();
	}else{
		document.getElementById("searchForm").submit();
	}
}

$(document).ready(function(e){
	$("#searchForm").submit(function(e){
		if($("#searchForField").val().trim().length < 1){
			$("#searchForField").css("border","1px solid red");
			$("#searchForField").attr("placeholder","You need to type");
			event.preventDefault();
		}else if($("#searchForField").val().trim().length > 200){
			$("#searchForField").css("border","1px solid red");
			$("#searchForField").attr("placeholder","Too long search");
			event.preventDefault();
		}
	});
});