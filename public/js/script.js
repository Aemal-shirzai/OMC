$("document").ready(function(){
	$("#search-icon").click(function(){
		$("#header-div").slideUp("fast");
		$(".search-box-button").slideDown();
		$("#search-box").focus();
		event.preventDefault();
	});

	$("#search-close-button").click(function(){	
		$(".search-box-button").hide();
		$("#header-div").show();
	});
});