// function which opens the all cat list
function openCatList(){
	$("#adsCategoryContent").slideToggle("fast");
	if($("#openCatIcon").hasClass("fa-chevron-down")){
		$("#openCatIcon").removeClass("fa-chevron-down");
		$("#openCatIcon").addClass("fa-chevron-up");
	}else{
		$("#openCatIcon").removeClass("fa-chevron-up");
		$("#openCatIcon").addClass("fa-chevron-down");
	}
}

// function to open ads cat form
function openAddCatForm(){
	$("#cFormDivAdd").fadeIn();
	$("#formField").focus();
	$("body").css("pointer-events","none");
}

// function to close form
function closeForm(value){
	$("#formField").removeClass("errorForm");
	$(".errors").text("");
	$(".done").text("");
	if(value === "Cadd"){
		document.getElementById("adsCategoryAddForm").reset();
		$("#cFormDivAdd").hide();
	}
	if(value === "Cupdate"){
		document.getElementById("adsCategoryUpdateForm").reset();
		$("#cFormDivUpdate").hide();
	}
	$("body").css("pointer-events","initial");
}

// function which open  edit the form for ads categoires
function openUpdateForm(id){
	$("#deleteLoad").show();
	$("body").css("pointer-events","none");
	$.ajax({
		method: "GET",
		url: adCatEdit,
		data:{id:id,_token:token}
	}).done(function(response){
		$("#deleteLoad").hide();
		if(!$.isEmptyObject(response.category)){
			$("#cFormDivUpdate").fadeIn();	
			$("#formFieldUpdate").focus();
			$("#formFieldUpdate").val(response.category['category']);	
			$("#cat_id").val(response.category['id']);
		}
	}).fail(function(response){
		$("#deleteLoad").hide();
		alert("fail");
	});
}





$(document).ready(function(e){

	// alert($("#adsCategoryContent a").length);	

	// To add dcategories using ajax
	$("#adsCategoryAddForm").submit(function(e){
		//validation part
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

		//ajax request part
		$(".errors").text("");
		$(".done").text("");
		$("#formField").removeClass("errorForm");
		$(".addLoad").show();
		$("#submitButtonAddCat").attr('value','Adding ...')
		$("#submitButtonAddCat").attr('disabled','true')
		event.preventDefault();

		var formData = $(this).serialize();
		$("#formField").attr("disabled","true");
		$.ajax({
			method: "POST",
			url: adCatStore,
			data: formData,
		}).done(function(response){
			$("#submitButtonAddCat").attr('value','Add')
			$("#submitButtonAddCat").removeAttr("disabled");
			$("#formField").removeAttr("disabled");
			$(".addLoad").hide();

			if($.isEmptyObject(response.errors)){
				$(".done").text("category Added!")
				$(".errors").text("")
				 $("#formField").focus();

				document.getElementById("adsCategoryAddForm").reset();
				if($("#adsCategoryContent a").length > 0){
					$("#adsCategoryContent a:first").before("<a href='javascript:void(0)' class='categories' onclick='openUpdateForm("+ response.data['id'] +")' id='row-"+ response.data['id'] +"'><button class='close'><span class='far fa-edit'></span></button>"+ response.data['category'] +"</a>")
				}else if($("#adsCategoryContent a").length < 1){
					$("#adsCategoryContent").append("<a href='javascript:void(0)' class='categories'><button class='close' onclick='openUpdateForm("+ response.data['id'] +")' id='row-"+ response.data['id'] +"'><span class='far fa-edit'></span></button>"+ response.data['category'] +"</a>");
					$("#noCategory").hide();
				}
			}else{
				 $("#formField").focus();
				 $(".errors").text(response.errors['category']);
				 $(".done").text("");
				 $("#formField").addClass("errorForm");
			}
		}).fail(function(response){
			$("#submitButtonAddCat").attr('value','Add')
			$("#submitButtonAddCat").removeAttr("disabled");
			$("#formField").removeAttr("disabled");
			$(".addLoad").hide();
			$(".errors").text("oops! something went wrong!");
			$(".done").text("");
		});
	});


	// to update ads form using ajax
	$("#adsCategoryUpdateForm").submit(function(e){
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
		console.log(formData);
		$(".addLoad").show();
		$("#submitButtonUpdateCat").attr('value','Updating ...');
		$("#submitButtonUpdateCat").attr('disabled','true');
		$("#formFieldUpdate").attr("disabled","true");
		$(".errors").text("");
		$("#formFieldUpdate").removeClass("errorForm");

		$.ajax({
			method: "PUT",
			url:adCatUpdate,
			data: formData,
		}).done(function(response){
			$(".addLoad").hide();
			$("#submitButtonUpdateCat").attr('value','Update');
			$("#submitButtonUpdateCat").removeAttr('disabled');
			$("#formFieldUpdate").removeAttr('disabled');
			if(!$.isEmptyObject(response.errors)){
				$(".errors").text(response.errors["category"]);
				$("#formFieldUpdate").focus();
				$("#formFieldUpdate").addClass("errorForm");
			}else{
				$("body").css("pointer-events","initial");
				$("#cFormDivUpdate").fadeOut();	
				$("#row-"+ response.data['id']).after("<a href='javascript:void(0)' class='categories' onclick='openUpdateForm("+ response.data['id'] +")' id='row-"+ response.data['id'] +"'><button class='close'><span class='far fa-edit'></span></button>"+ response.data['category'] +"</a>");
				$("#row-"+response.data['id']).remove();
			}

		}).fail(function(response){
			$(".addLoad").show();
			$("#submitButtonUpdateCat").attr('value','Updating ...');
			$("#submitButtonUpdateCat").removeAttr('disabled');
			$("#formFieldUpdate").removeAttr('disabled');
		});
	});


});



// to open message delete confirmation box
function openMessageConfirmation(){
	var id = $("#cat_id").val();
	$("body").css("pointer-events","none");
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
	closeForm("Cupdate");
	$("#row-"+id).text("Deleting...");
	$("#row-"+id).css({"color":"red","opacity":"0.5"});
	$.ajax({
		method: "DELETE",
		url: adCatDelete,
		data:{id:id,_token:token}
	}).done(function(){
		$("#row-"+id).slideUp();
		$("#row-"+id).remove();
	});
}
