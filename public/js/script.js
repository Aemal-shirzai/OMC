function openNav() {
	document.getElementById("side").style.width = "230px";	
	document.getElementById("side").className += " sidebar-small-shadow";
	document.getElementById("parent-dev").style.marginLeft = "230px";
}
function closeNav() {
  document.getElementById("side").style.width = "0";
  document.getElementById("parent-dev").style.marginLeft= "0";
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
});

