// to open message delete confirmation box
function openMessageConfirmation(id){
	$("body").css("pointer-events","none");
	// $("#shareOptions").hide();
	$("#messageConfirmationBox-"+id).fadeIn();
}

// to close message delete confrimation box
function messageClosePermissionBox(id){
	$("body").css("pointer-events","initial");
	$("#messageConfirmationBox-"+id).fadeOut();
}

// Beggining of the function which delete messaes
function deleteMessages(id){
	messageClosePermissionBox(id);
	$("#deletText-"+id).text("Deleting...");
	$("#deletText-"+id).css({"color":"red","opacity":"0.5"});
	$("#deleteLoad-"+id).show();
	$.ajax({
		method: "DELETE",
		url: deleteMessage,
		data:{id:id,_token:token}
	}).done(function(){
		$("#deletText-"+id).text("Delete");
		$("#deletText-"+id).css({"color":"black","opacity":"1"});
		$("#deleteLoad-"+id).hide();
		$("#fullMessage-"+id).slideUp();
		$("#fullMessage-"+id).remove();
	});
}


