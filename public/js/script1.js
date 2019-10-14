window.onscroll = function() {changeMenuSize()};
function changeMenuSize(){
	if(document.documentElement.scrollTop > 80){
		document.getElementById("header-div").style.padding = "5px";
		document.getElementById("sidebar-large").style.marginTop = "-14px";
		document.getElementById("sidebar-large").style.height = "65x";
		document.getElementById("logodiv").style.width = "150px";
		document.getElementById("logodiv").style.marginTop= "6px";
	}else{
		document.getElementById("header-div").style.padding = "10px";
		document.getElementById("sidebar-large").style.marginTop = "-4px";
		document.getElementById("sidebar-large").style.height = "70x";
		document.getElementById("logodiv").style.width = "140px";
	}
}
// alert(document.documentElement.scrollTop);

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


