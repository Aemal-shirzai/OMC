
// Beggining of: the function which shows the profile content based on the clicked button
function openContent(evt,value){
	var tabcontent = document.getElementsByClassName("tab-content");
  	for (i = 0; i < tabcontent.length; i++) {
    	tabcontent[i].style.display = "none";
  	}

  	var tablinks = document.getElementsByClassName("tabLinks");
  	for (i = 0; i < tablinks.length; i++) {
    	tablinks[i].className = tablinks[i].className.replace(" active1", "");
  	}

  	 document.getElementById(value).style.display = "block";
 	 evt.currentTarget.className += " active1";

}
// End of: the function which shows the profile content based on the clicked button

// Beggining of : the function which select provice based on country and district based on province
function selectProvinceAndDistrict(value){
	// if the inpput which should be select is province . means when country is changed
	if(value == "province"){
		var country = document.getElementById("country").value;
		var province = document.getElementById("province");
		var district = document.getElementById("district");

		if(country.length > 0){
			province.disabled =false;
			province.style.cursor = "pointer";
			province.setAttribute('title',"Choose a province");
			province.style.color = "#6d6161";
			province.innerHTML = "";
			province.innerHTML = "<option value='' selected>Province</option>";
			district.value = "";
			district.disabled = true;
			district.style.cursor = "not-allowed";
			district.style.color = "lightgray";
			district.setAttribute('title',"Choose a provice first");
			district.innerHTML = "<option value='' selected>District</option>";

			
			var countryProvince = eval("province" + country);
			console.log(countryProvince);
			for(var index in countryProvince){
				var openTag = "<option value='"+ index  +"'>";
				var text = countryProvince[index];
				var closeTag = "</option>";
			 	var result = openTag.concat(text,closeTag);
				province.innerHTML += result;
			}

		}else{
			province.disabled =true;
			province.style.cursor = "not-allowed";
			province.style.color = "lightgray";
			province.setAttribute('title',"Choose a country first");
			province.innerHTML = "<option value='' selected>Province</option>"

			district.disabled =true;
			district.style.cursor = "not-allowed";
			district.style.color = "lightgray";
			district.setAttribute('title',"Choose a province first");
			district.innerHTML = "<option value='' selected>District</option>";
		}
	}else if (value == "district"){ // if its province which is chagned and need to enable the selection of district
		var province = document.getElementById("province").value;
		var district = document.getElementById("district");

		if(province.length > 0){
			district.disabled =false;
			district.style.cursor = "pointer";
			district.setAttribute('title',"Choose a district");
			district.style.color = "#6d6161";
			district.innerHTML = "";
			district.innerHTML = "<option value=''>District</option>";

			
			var provinceDistrict = eval("district" + province); //eval change a string into variable name
			for(var index in provinceDistrict){
				var openTag = "<option value='"+ index  +"'>";
				var text = provinceDistrict[index];
				var closeTag = "</option>";
			 	var result = openTag.concat(text,closeTag);
				district.innerHTML += result;
			}
		}else{
			district.disabled =true;
			district.style.cursor = "not-allowed";
			district.style.color = "lightgray";
			district.setAttribute('title',"Choose a province first");
			district.innerHTML = "<option value='' selected>District</option>"
		} // end of : if the no province is selected
	}


}
// End of : the function which select provice based on country and district based on province




// Beggging of the function which make sure user change user photo
function changePhotoConfirmation(){
	$("body").css("pointer-events","none");
	$("#changeConfirmationBox").fadeIn();
}

// End of the function which make sure user delete the comment
function changePhotoConfirmationClose(){
	$("#changeConfirmationBox").fadeOut();
	$("body").css("pointer-events","initial");
}
// Beggining of the function which delete comment

// function deleteComments(commentId,postId){
// 	closePermissionBox(commentId);
// 	event.preventDefault();
// 	$("#commentDeleteButton-"+commentId).text(" Deleting...");
// 	$("#commentDeleteButton-"+commentId).css("color","red");
// 	$.ajax({
// 		method: "DELETE",
// 		url:deleteComment,
// 		data:{comment_id:commentId,_token:token}
// 	}).done(function(){
// 		$("#allCommentsContent-"+commentId).slideUp('fast');
// 		$("#allcommentsOwnerImage-"+commentId).slideUp('fast');
// 		$("#commentOptions-"+commentId).hide();
// 		$("#allReplies-"+commentId).slideUp("fast");
// 		$("#reply-"+commentId).slideUp("fast");

// 		$("#commentsCount-"+postId).text(parseInt($("#commentsCount-"+postId).text())-1);
// 		$("#commentcounts1-"+postId).text(parseInt($("#commentcounts1-"+postId).text())-1);
// 		$("#commentDeleteButton-"+commentId).text(" Delete");
// 		$("#commentDeleteButton-"+commentId).css("color","#666");
// 	});
// }
// End of the function which make sure user change user photo







function openphotoField(){
	alert("done");
}


function removeprofilePhoto(accountId){
	// alert("done");
	changePhotoConfirmationClose();
	$(".image").css("opacity","0.3");
	$("#loading").show();
	$("#changePhotoLink").css({"pointer-events":"none", "opacity":'0.5'});

	$.ajax({
		method: "DELETE",
		url:removePhoto,
		data:{account_id:accountId, _token:token}


	}).done(function(response){
		$(".image").hide();
		$("#loading").hide();
		$("#notImage").show();
		$("#changePhotoLink").css({"pointer-events":"initial", "opacity":'1'});

	});
}