// Beggining of the : Function responsible for following the doctors by normal users
function followDoctor(doctorId){

	$("#followText-"+doctorId).text("Loading...");
	event.preventDefault();
	$.ajax({
	// the method the data should be sent with
	method : "POST",

	// the route to which the data should go
	url: DoctorFollow,

	// The data which should be send 
	data: {doctor_id:doctorId, _token:token}

	}).done(function(){
		if($("#followBtnIcon-"+doctorId).hasClass("fa-check")){
			$("#followBtnIcon-"+doctorId).removeClass("fa-check");
			$("#followBtnIcon-"+doctorId).addClass("fa-plus");
			$("#followText-"+doctorId).text("Follow");
			$("#followersCount-"+doctorId).text(parseInt($("#followersCount-"+doctorId).text())-1);
		}else{
			$("#followBtnIcon-"+doctorId).addClass("fa-check");
			$("#followBtnIcon-"+doctorId).removeClass("fa-plus");
			$("#followText-"+doctorId).text("Following");
			$("#followersCount-"+doctorId).text(parseInt($("#followersCount-"+doctorId).text())+1);
		}
	});
}
// End of the : Function responsible for following the doctors by normal users


//BO: this function get the value from the ajax return search result and put that into the textfield
function getdata(value){
	$("#searchForField").val(value);
	$("#searchForField").focus();
	$("#searchResult").hide();
}
//EO: this function get the value from the ajax return search result and put that into the textfield

// BO:  function show the avaibible doctors based on user search 
function searchDoctors(){
	var value = $("#searchForField").val();
	var stype = $("#searchType").val();
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
		url:doctorsSearchResult,
		data:{data:value,type:stype, _token:token},
	}).done(function(response){
		imageLoad.hide();
		searchText.text("resutls");
		if(!$.isEmptyObject(response.resultFound)){
			resultsDiv.text("");
			if(stype === "name"){
				$.each(response.resultFound,function(index,value){
					resultsDiv.append($("<a href='javascript:void(0)' onclick='getdata(" + '"' + value.fullName  + '"' + ")'>").text(value.fullName));
				});
			}else if(stype === "username"){
				$.each(response.resultFound,function(index,value){
					resultsDiv.append($("<a href='javascript:void(0)' onclick='getdata(" + '"' + value.username  + '"' + ")'>").text(value.username));
				});
			}else if(stype === "field"){
				$.each(response.resultFound,function(index,value){
					resultsDiv.append($("<a href='javascript:void(0)' onclick='getdata(" + '"' + value.category  + '"' + ")'>").text(value.category));
				});
			}else if(stype === "location"){
				console.log(response.resultFound);
				$.each(response.resultFound,function(index,value){
					resultsDiv.append($("<a href='javascript:void(0)' onclick='getdata(" + '"' + value.street  + '"' + ")'>").text(value.street));
				});
			}
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
// EO: This function show the avaibible doctors based on user search

// BO:  function show the avaibible narmal users based on user search 
function searchNusers(){
	var value = $("#searchForField").val();
	var stype = $("#searchType").val();
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
		$("#searchForField").attr("placeholder","Search users");
	}

	$.ajax({
		method: "GET",
		url:nusersSearchResult,
		data:{data:value,type:stype, _token:token},
	}).done(function(response){
		imageLoad.hide();
		searchText.text("resutls");
		if(!$.isEmptyObject(response.resultFound)){
			resultsDiv.text("");
			if(stype === "name"){
				$.each(response.resultFound,function(index,value){
					resultsDiv.append($("<a href='javascript:void(0)' onclick='getdata(" + '"' + value.fullName  + '"' + ")'>").text(value.fullName));
				});
			}else if(stype === "username"){
				$.each(response.resultFound,function(index,value){
					resultsDiv.append($("<a href='javascript:void(0)' onclick='getdata(" + '"' + value.username  + '"' + ")'>").text(value.username));
				});
			}
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
	}else if($("#searchForField").val().trim().length > 60){
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
		}else if($("#searchForField").val().trim().length > 60){
			$("#searchForField").css("border","1px solid red");
			$("#searchForField").attr("placeholder","Too long search");
			event.preventDefault();
		}
	});
});



// to activate user
function activateUser(id,type){

	$("#followText-"+id).text("changing status");
	$("#followBtnIcon-"+id).addClass("fa-spinner");
	$("#followBtnIcon-"+id).removeClass("fa-check");
	if(type == "doctor"){
		$.ajax({
			method: "PUT",
			url: changeStatus,
			data:{id:id,type:type,_token:token}
		}).done(function(response){
			if(response.status == "activated"){
				$("#followText-"+id).text("Activated");
				$("#followBtnIcon-"+id).removeClass("fa-spinner");
				$("#followBtnIcon-"+id).addClass("fa-check");
			}else{
				$("#followText-"+id).text("Active User");
				$("#followBtnIcon-"+id).removeClass("fa-spinner");
				$("#followBtnIcon-"+id).removeClass("fa-check");
			}

		}).fail(function(response){
			alert("not done");
		});
	}else{
		$.ajax({
			method: "PUT",
			url: changeStatusUser,
			data:{id:id,type:type,_token:token}
		}).done(function(response){
			if(response.status == "activated"){
				$("#followText-"+id).text("Activated");
				$("#followBtnIcon-"+id).removeClass("fa-spinner");
				$("#followBtnIcon-"+id).addClass("fa-check");
			}else{
				$("#followText-"+id).text("Active User");
				$("#followBtnIcon-"+id).removeClass("fa-spinner");
				$("#followBtnIcon-"+id).removeClass("fa-check");
			}

		}).fail(function(response){
			alert("not done");
		});
	}

}