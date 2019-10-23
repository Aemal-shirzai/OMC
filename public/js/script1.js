// Call the function of which chagne size of search box , large navbar and header when scroll
window.onscroll = function() {changeMenuSize()};
// Beggining of the function which change the size of the search box , largenavbar and the header when scroll
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
// End of the function which change the size of the search box , largenavbar and the header

// Begining of: function which open the small sidebar
function openNav() {
	document.getElementById("side").style.width = "230px";	
	document.getElementById("side").className += " sidebar-small-shadow";
	document.getElementById("header-div").style.marginLeft = "230px";
	document.getElementById("sidebar-large").style.marginLeft = "230px";
}
// End of: function which open the small sidebar

// Begining of: function which close the small sidebar
function closeNav() {
  document.getElementById("side").style.width = "0";
  document.getElementById("header-div").style.marginLeft= "0";
  document.getElementById("sidebar-large").style.marginLeft= "0";
}
// End of: function which open the small sidebar


// Beggining of the jquery ready function
$("document").ready(function(){
// Beggining of the function which open search box and close the large nav
	$("#search-icon").click(function(){
		$("#header-div").hide();
		$(".search-box-button").show();
		event.preventDefault();
	});
// End of the function which open search box and close the large nav

// Beggining of the function which open the large nav and close search box  
	$("#search-close-button").click(function(){	
		$(".search-box-button").hide();
		$("#header-div").show();
	});
// End of the function which open the large nav and close search box 

// beginning of :  to automatically hide the small slidebar when the screen gets large  
	$(window).resize(function(){
		if($(window).width() > 1000){
			$("#side").css("width","0px");
			$("#header-div").css("margin-left","0px");
			$("#sidebar-large").css("margin-left","0px");
		}
	});
// End of :  to automatically hide the small slidebar when the screen gets large 

// Begenning of : to scroll smooth to forusers, by omc
	$("#forUsersBtn").click(function(){
		$("html,body").animate({
			scrollTop: $("#section2").offset().top-74},"slow");
	});
// End of : to scroll smooth to forusers, by omc

// Begenning of : to scroll smooth to for doctors, by omc
	$("#forDoctorsBtn").click(function(){
		$("html,body").animate({
			scrollTop: $("#section3").offset().top-74},"slow");
	});
// End of : to scroll smooth to for doctors, by omc

// Begenning of : to scroll smooth to for ads from for users, by omc
	
	$("#forUsersViewAds").click(function(){
		$("html,body").animate({
			scrollTop: $("#section4").offset().top-160},"slow");
	});

// End of : to scroll smooth to for ads from for users, by omc

//  slideshow for latest news in main page
	var s = $(".owl-carousel").find(".adsItems").length;
	$(".owl-carousel").owlCarousel({
		autoplay:true,
		autoplaySpeed: 1000,
		autoplayTimeout:4000,
		responsiveClass:true,
		autoplayHoverPause:true,
		navText : ["<i class='fad fa-chevron-left navLatestNews'></i>","<i class='fad fa-chevron-right navLatestNews'></i>"],
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
// sllide how for lates new in main page end


});
// jquery ready function end

