function showDeleteButtonAll(){

	if($("#chooseAll").is(":checked")){
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
}
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
	$("#deleteTagForm").submit(function(e){
		$("#deleteLoad").show();
		$("body").css("pointer-events","none");
		e.preventDefault();
		var formData = $(this).serialize();
		// console.log(formData);

		$.ajax({
			method: "DELETE",
			url: tagsDelete,
			data: formData,
		}).done(function(response){
			$("#deleteCatButton").hide();
			$("body").css("pointer-events","initial");
			$.each(response.ids,function(index,value){
				$("#row-"+value).remove();
			});
			$("#deleteLoad").hide();
			$("#deleteMessage").show();
			$("#messages").text(response.ids.length + " tag (s) deleted!");
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
	$("#tagsAddForm").submit(function(e){
		$(".done").text("");
		$(".errors").text("");
		// validation part
		if($("#formField").val().trim().length < 1){
			$("#formField").addClass("errorForm");
			$(".errors").text("The field can not be empty");
			 $("#formField").focus();
			return false;
		}else if($("#formField").val().trim().length < 3){
			$("#formField").addClass("errorForm");
			$(".errors").text("The tag name must be at least 3 characters");
			 $("#formField").focus();
			return false;
		}else if($("#formField").val().trim().length > 60){
			$("#formField").addClass("errorForm");
			$(".errors").text("The tag name may not be greater than 60 characters.");
			 $("#formField").focus();
			return false;
		}else{
			$("#formField").removeClass("errorForm");
			$(".errors").text("");
		}

		// ajax request part
		$("#formField").removeClass("errorForm");
		$(".addLoad").show();
		$("#submitButtonAdd").attr('value','Adding ...')
		$("#submitButtonAdd").attr('disabled','true')
		event.preventDefault();

		var formData = $(this).serialize();
		$("#formField").attr("disabled","true");
		$.ajax({
			method: "POST",
			url: storeTags,
			data: formData,
		}).done(function(response){
			$("#submitButtonAdd").attr('value','Add')
			$("#submitButtonAdd").removeAttr("disabled");
			$("#formField").removeAttr("disabled");
			$(".addLoad").hide();

			if($.isEmptyObject(response.errors)){
				$(".done").text("category Added!")
				$(".errors").text("")
				 $("#formField").focus();
				document.getElementById("tagsAddForm").reset();
				if($("#catTableBody tr").length > 0){
					$("#catTableBody tr:first").before("<tr id='row-"+ response.data["id"] +"''>" +"<td>"+ response.data['id'] +"</td>"+ "<td>"+ response.data['category'] +"</td>"+ 
						"<td>"+ 0  +"</td>"+ "<td>"+ "<a href='/profile/"+ response.data['createdBy']  +"'>" + response.data['createdBy'] + "</a>" +"</td>"+ "<td>"+ ""  +"</td>"+ 
						"<td>"+ response.createDate  +"</td>"+ "<td>"+ response.updateDate  +"</td>"+ "<td><a href='javascript:void(0)' class='fal fa-edit' onclick='openUpdateForm("+ response.data['id'] +")'></a></td>" + 
						"<td><input type='checkbox' class='one_by_one' name='tagIds[]' value='"+ response.data['id'] +"' id='checkbox-"+ response.data["id"] +"' onclick='showDeleteButtonSingle()'></td>"+  "</tr>")
				}else if($("#catTableBody tr").length < 1){
					$("#catTableBody").append("<tr id='row-"+ response.data["id"] +"''>" +"<td>"+ response.data['id'] +"</td>"+ "<td>"+ response.data['category'] +"</td>"+ 
						"<td>"+ 0  +"</td>"+ "<td>"+ "<a href='/profile/"+ response.data['createdBy']  +"'>" + response.data['createdBy'] + "</a>" +"</td>"+ "<td>"+ ""  +"</td>"+ 
						"<td>"+ response.createDate  +"</td>"+ "<td>"+ response.updateDate  +"</td>"+ "<td><a href='#' class='fal fa-edit'></span></a>"+ 
						"<td><input type='checkbox' class='one_by_one' name='tagIds[]' value='"+ response.data['id'] +"' id='checkbox-"+ response.data["id"] +"' onclick='showDeleteButtonSingle()'></td>"+  "</tr>")
				}
			}else{
				 $("#formField").focus();
				 $(".errors").text(response.errors['category']);
				 $(".done").text("");
				 $("#formField").addClass("errorForm");
			}
		}).fail(function(response){
			$("#submitButtonAdd").attr('value','Add')
			$("#submitButtonAdd").removeAttr("disabled");
			$("#formField").removeAttr("disabled");
			$(".addLoad").hide();
			$(".errors").text("oops! something went wrong!");
			$(".done").text("");
		});
	});

	// to update dcategories form using ajax
	$("#tagsUpdateForm").submit(function(e){
		// validation part
		if($("#formFieldUpdate").val().trim().length < 1){
			$("#formFieldUpdate").addClass("errorForm");
			$(".errors").text("The field can not be empty");
			 $("#formFieldUpdate").focus();
			return false;
		}else if($("#formFieldUpdate").val().trim().length < 3){
			$("#formFieldUpdate").addClass("errorForm");
			$(".errors").text("The category must be at least 3 characters");
			 $("#formFieldUpdate").focus();
			return false;
		}else if($("#formFieldUpdate").val().trim().length > 60){
			$("#formFieldUpdate").addClass("errorForm");
			$(".errors").text("The category may not be greater than 60 characters.");
			 $("#formFieldUpdate").focus();
			return false;
		}else{
			$("#formFieldUpdate").removeClass("errorForm");
			$(".errors").text("");
		}

		e.preventDefault();
		var formData = $(this).serialize();

		$(".addLoad").show();
		$("#submitButtonUpdate").attr('value','Updating ...');
		$("#submitButtonUpdate").attr('disabled','true');
		$("#formFieldUpdate").attr("disabled","true");
		$(".errors").text("");
		$("#formFieldUpdate").removeClass("errorForm");
		console.log(formData['cat_id']);

		$.ajax({
			method: "PUT",
			url:updateTags,
			data: formData,
		}).done(function(response){
			$(".addLoad").hide();
			$("#submitButtonUpdate").attr('value','Update');
			$("#submitButtonUpdate").removeAttr('disabled');
			$("#formFieldUpdate").removeAttr('disabled');
			if(!$.isEmptyObject(response.errors)){
				$(".errors").text(response.errors["category"]);
				$("#formFieldUpdate").focus();
				$("#formFieldUpdate").addClass("errorForm");
			}else{
				$("body").css("pointer-events","initial");
				$("#cFormDivUpdate").fadeOut();	
				$("#row-"+ response.data['id']).after("<tr id='row-"+ response.data["id"] +"''>" +"<td>"+ response.data['id'] +"</td>"+ "<td>"+ response.data['category'] +"</td>"+ 
						"<td>"+ response.registered  +"</td>"+ "<td>"+ "<a href='/profile/"+ response.data['createdBy']  +"'>" + response.data['createdBy'] + "</a>" +"</td>"+ "<td>"+ "<a href='/profile/"+ response.data['updatedBy']  +"'>" + response.data['updatedBy'] + "</a>"  +"</td>"+ 
						"<td>"+ response.createDate  +"</td>"+ "<td>"+ response.updateDate  +"</td>"+ "<td><a href='javascript:void(0)' class='fal fa-edit' onclick='openUpdateForm("+ response.data['id'] +")'></a></td>"+ 
						"<td><input type='checkbox' class='one_by_one' name='tagIds[]' value='"+ response.data['id'] +"' id='checkbox-"+ response.data["id"] +"' onclick='showDeleteButtonSingle()'></td>"+  "</tr>");
				$("#row-"+response.data['id']).remove();
				$("#deleteMessage").show();
				$("#deleteMessage").show();
				$("#messages").text("updated");
				window.setTimeout(function() {
					$("#deleteMessage").fadeOut(200);
				}, 1500);
			}

		}).fail(function(response){
			$(".addLoad").show();
			$("#submitButtonUpdate").attr('value','Updating ...');
			$("#submitButtonUpdate").removeAttr('disabled');
			$("#formFieldUpdate").removeAttr('disabled');
		});
	});


	window.setTimeout(function() {
		$("#deleteMessage").fadeOut(200);
	}, 2000);

});



// function which open the form
function openForm(value){
	if(value === "Cadd"){
		$("#cFormDivAdd").fadeIn();
	}
	if(value === "Cupdate"){
		$("#cFormDivUpdate").fadeIn();	
	}
	$("#formField").focus();
	$("body").css("pointer-events","none");
}

// function which open the form for tags
function openUpdateForm(id){
	$("#deleteLoad").show();
	$("body").css("pointer-events","none");
	$.ajax({
		method: "GET",
		url: editTags,
		data:{id:id,_token:token}
	}).done(function(response){
		$("#deleteLoad").hide();
		if(!$.isEmptyObject(response.category)){
			$("#cFormDivUpdate").fadeIn();	
			$("#formFieldUpdate").focus();
			$("#formFieldUpdate").val(response.category['category']);	
			$("#tag_id").val(response.category['id']);
		}
	}).fail(function(response){
		$("#deleteLoad").hide();
		alert("fail");
	});
}

// function to close form
function closeForm(value){
	$("#formField").removeClass("errorForm");
	$(".errors").text("");
	$(".done").text("");
	if(value === "Cadd"){
		document.getElementById("tagsAddForm").reset();
		$("#cFormDivAdd").hide();
	}
	if(value === "Cupdate"){
		document.getElementById("tagsUpdateForm").reset();
		$("#cFormDivUpdate").hide();
	}
	$("body").css("pointer-events","initial");
}

