function closeReadMore(){
	$("#readmorediv").fadeOut("fast");
	$("body").css("pointer-events","initial");
}


function readMore(id){
	event.preventDefault();
	$("#readmorediv").fadeIn("fast");
	$("#readmoreLoad").show();
	$("body").css("pointer-events","none");

	$.ajax({
		method: "GET",
		url: readFull,
		data:{id:id,_token:token}
	}).done(function(response){
		if(!$.isEmptyObject(response.data)){
			$("#readmoreHeading").text(response.data["title"]);
			$("#readmoredivContent").text(response.data["content"]);
			$("#readmoreLoad").hide();
		}
	}).fial(function(response){
		alert("fail");
	});
}
