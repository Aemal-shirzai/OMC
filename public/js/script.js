
function openNav() {
	document.getElementById("side").style.width = "230px";	
	document.getElementById("side").className += " sidebar-small-shadow";
	document.getElementById("parent-div").style.marginLeft = "230px";
}
function closeNav() {
  document.getElementById("side").style.width = "0";
  document.getElementById("parent-div").style.marginLeft= "0";
}
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

$(window).resize(function(){

	if($(window).width() > 1000){
		$("#side").css("width","0px");
		$("#parent-div").css("margin-left","0px");
	}
});

});


