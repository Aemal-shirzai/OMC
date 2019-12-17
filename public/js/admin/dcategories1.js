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
// $(".one_by_one").click(function(){
// 	alert("done");
// 	var toBeDeleted = $(".one_by_one:checked").length;
// 	if(toBeDeleted > 0){
// 		$("#deleteCatButton").show();
// 	}else{
// 		$("#deleteCatButton").hide();
// 		document.getElementById("chooseAll").checked = false;
// 	}
// });

function showDeleteButtonSingle(){
	var toBeDeleted = $(".one_by_one:checked").length;
	if(toBeDeleted > 0){
		$("#deleteCatButton").show();
	}else{
		$("#deleteCatButton").hide();
		document.getElementById("chooseAll").checked = false;
	}
}

$(document).ready(function(e){

	// to delete the dcateogires using ajax
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
			$("#deleteCatButton").hide();
			$("body").css("pointer-events","initial");
			$.each(response.ids,function(index,value){
				$("#row-"+value).remove();
			});
			$("#deleteLoad").hide();
			$("#deleteMessage").show();
			$("#messages").text(response.ids.length + " category (s) deleted!");
			window.setTimeout(function() {
				$("#deleteMessage").fadeOut(200);
			}, 2000);
		}).fail(function(response){
			$("#deleteCatButton").hide();
			$("body").css("pointer-events","initial");
			$("#messages").text("oops! something went wrong!");
			$("#deleteLoad").hide();
		});

	});


	// To add dcategories using ajax
	$("#dCategoryAddForm").submit(function(e){

		// validation part
		if($("#formField").val().trim().length < 1){
			$("#formField").addClass("errorForm");
			$(".errors").text("The field can not be empty");
			 $("#formField").focus();
			return false;
		}else if($("#formField").val().trim().length < 3){
			$("#formField").addClass("errorForm");
			$(".errors").text("The category must be at least 3 characters");
			 $("#formField").focus();
			return false;
		}else if($("#formField").val().trim().length > 60){
			$("#formField").addClass("errorForm");
			$(".errors").text("The category may not be greater than 60 characters.");
			 $("#formField").focus();
			return false;
		}else{
			$("#formField").removeClass("errorForm");
			$(".errors").text("");
		}

		// ajax request part
		$(".errors").text("");
		$("#formField").removeClass("errorForm");
		$("#addLoad").show();
		$("#submitButton").attr('value','Adding ...')
		$("#submitButton").attr('disabled','true')
		event.preventDefault();

		var formData = $(this).serialize();
		$("#formField").attr("disabled","true");
		$.ajax({
			method: "POST",
			url: storeCategories,
			data: formData,
		}).done(function(response){
			$("#submitButton").attr('value','Add')
			$("#submitButton").removeAttr("disabled");
			$("#formField").removeAttr("disabled");
			$("#addLoad").hide();

			if($.isEmptyObject(response.errors)){
				$(".done").text("category Added!")
				document.getElementById("dCategoryAddForm").reset();

				$("#catTableBody tr:first").before("<tr id='row-"+ response.data["id"] +"''>" +"<td>"+ response.data['id'] +"</td>"+ "<td>"+ response.data['category'] +"</td>"+ 
					"<td>"+ 0  +"</td>"+ "<td>"+ "<a href='/profile/"+ response.data['createdBy']  +"'>" + response.data['createdBy'] + "</a>" +"</td>"+ "<td>"+ ""  +"</td>"+ 
					"<td>"+ response.createDate  +"</td>"+ "<td>"+ response.updateDate  +"</td>"+ "<td><a href='#' class='fal fa-edit'></span></a>"+ 
					"<td><input type='checkbox' class='one_by_one' name='catIds[]' value='"+ response.data['id'] +"' id='checkbox-"+ response.data["id"] +"' onclick='showDeleteButtonSingle()'></td>"+  "</tr>")

			}else{
				 $("#formField").focus();
				 $(".errors").text(response.errors['category']);
				 $("#formField").addClass("errorForm");
			}
		}).fail(function(response){
			$("#submitButton").attr('value','Add')
			$("#submitButton").removeAttr("disabled");
			$("#formField").removeAttr("disabled");
			$("#addLoad").hide();
		});
	});





	window.setTimeout(function() {
		$("#deleteMessage").fadeOut(200);
	}, 2000);

});


// function which open the form
function openForm(){
	$("#formDiv").fadeIn();
	$("#formField").focus();
	$("body").css("pointer-events","none");
}

// function to close form
function closeForm(){
	$("#formField").removeClass("errorForm");
	$(".errors").text("");
	$(".done").text("");
	document.getElementById("dCategoryAddForm").reset();
	$("#formDiv").hide();
	$("body").css("pointer-events","initial");
}

