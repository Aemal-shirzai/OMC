$("#chooseAll").click(function(){
	if(this.checked){
		$(".one_by_one").each(function(){
			this.checked = true;
				$("#deleteCatButton").show();
		});
	}else{
		$(".one_by_one").each(function(){
			this.checked = false;
			$("#deleteCatButton").hide();
		});
	}	
});
$(".one_by_one").click(function(){
	var toBeDeleted = $(".one_by_one:checked").length;
	if(toBeDeleted > 0){
		$("#deleteCatButton").show();
	}else{
		$("#deleteCatButton").hide();
		document.getElementById("chooseAll").checked = false;
	}
});

$(document).ready(function(e){
	$("#deleteCatForm").submit(function(e){
		$("#deleteLoad").show();
		$("body").css("pointer-events","none");
		e.preventDefault();
		var formData = $(this).serialize();
		// console.log(formData);

		$.ajax({
			method: "DELETE",
			url: dcategoryDelete,
			data: formData,
		}).done(function(response){
			$("body").css("pointer-events","initial");
			$.each(response.ids,function(index,value){
				$("#row-"+value).remove();
			});
			$("#deleteLoad").hide();
			$("#deleteMessage").show();
			window.setTimeout(function() {
				$("#deleteMessage").fadeOut(200);
			}, 2000);
		}).fail(function(response){
			$("body").css("pointer-events","initial");
			alert("fail");
			$("#deleteLoad").hide();
		});

	});

});