window.onscroll = function() {changeMenuSize()};
function changeMenuSize(){
	if(document.documentElement.scrollTop > 10){
		document.getElementById("header-div").style.padding = "7px";
		document.getElementById("sidebar-large").style.marginTop = "-10px";
		document.getElementById("sidebar-large").style.height = "65x";
		document.getElementById("logodiv").style.width = "150px";
		document.getElementById("logodiv").style.marginTop= "6px";
		document.getElementById("search-box").style.height= "38px";
		document.getElementById("search-close-button").style.height= "38px";
		document.getElementById("search-close-button").style.paddingTop= "6px";
	}else{
		document.getElementById("header-div").style.padding = "10px";
		document.getElementById("sidebar-large").style.marginTop = "-2px";
		document.getElementById("sidebar-large").style.height = "70x";
		document.getElementById("logodiv").style.width = "140px";
		document.getElementById("search-box").style.height= "46px";
		document.getElementById("search-close-button").style.height= "46px";
		document.getElementById("search-close-button").style.paddingTop= "9px";
	}
}


// alert(document.documentElement.scrollTop);

function openNav() {
	document.getElementById("side").style.width = "230px";	
	document.getElementById("side").className += " sidebar-small-shadow";
	document.getElementById("header-div").style.marginLeft = "230px";
	document.getElementById("sidebar-large").style.marginLeft = "230px";
}
function closeNav() {
  document.getElementById("side").style.width = "0";
  document.getElementById("header-div").style.marginLeft= "0";
  document.getElementById("sidebar-large").style.marginLeft= "0";
}
$("document").ready(function(){
	$("#search-icon").click(function(){
		$("#header-div").hide();
		$(".search-box-button").show();
		event.preventDefault();
	});

	$("#search-close-button").click(function(){	
		$(".search-box-button").hide();
		$("#header-div").show();
	});

$(window).resize(function(){

	if($(window).width() > 1000){
		$("#side").css("width","0px");
		$("#header-div").css("margin-left","0px");
		$("#sidebar-large").css("margin-left","0px");
	}
});
	//  slideshow for latest news in main page
	var s = $(".owl-carousel").find(".adsItems").length;
	$(".owl-carousel").owlCarousel({
		autoplay:6000,
		responsiveClass:true,
		responsive:{
		0:{
            items:1,
            nav:true,
            loop:true,
        },
        600:{
            items:(s > 1)  ? '3' : '1',
            nav:true,
            loop:(s > 3),

        }
		}
	});
});


