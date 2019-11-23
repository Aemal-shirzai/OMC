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
	var field = document.getElementById("postPhotoField");
	field.disabled = false;
	field.click();
}
// End of the function which opens the photofiled input for adding post