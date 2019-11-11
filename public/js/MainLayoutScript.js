// Call the function of which chagne size of search box , large navbar and header when scroll
window.onscroll = function() {changeMenuSize()};
// Beggining of the function which change the size of the search box , largenavbar and the header when scroll
function changeMenuSize(){
	if(document.documentElement.scrollTop > 10){
		document.getElementById("header-div").style.padding = "7px";
		document.getElementById("sidebar-large").style.marginTop = "-12px";
		document.getElementById("sidebar-large").style.height = "65x";
		document.getElementById("logodiv").style.width = "150px";
		document.getElementById("logodiv").style.marginTop= "6px";
		document.getElementById("search-box").style.height= "36px";
		document.getElementById("search-close-button").style.height= "36px";
		document.getElementById("search-close-button").style.paddingTop= "5px";
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


// Beggining of : function which enable the contact us button

function enableContactButton(){
	var fullName = document.getElementById("fullName");
	var phoneNumber = document.getElementById("phoneNumber");
	var emailAddress = document.getElementById("emailAddress");
	var message = document.getElementById("message");
	var button = document.getElementById("contactButton");
	if(fullName.value.trim().length > 0 && phoneNumber.value.trim().length > 0 && emailAddress.value.trim().length > 0 && message.value.trim().length > 0){
		button.disabled = false;
		button.className += " activeContactButton";
	}else{
		button.disabled = true;
		button.className = "btn btn-sm offset-lg-2";
	}
}

// End of : function which enable the contact us button

// Beggining of : function which validate contact form

function validateContactForm(){
	var fullName = document.getElementById("fullName");
	var fullNameError = document.getElementById("fullNameErrorSmall");
	var fullNameErrorSmall = document.getElementById("fullNameError");
	var phoneNumber = document.getElementById("phoneNumber");
	var phoneNumberError = document.getElementById("phoneNumberError");
	var phoneNumberErrorSmall = document.getElementById("phoneNumberErrorSmall");
	var emailAddress = document.getElementById("emailAddress");
	var emailAddressError = document.getElementById("emailAddressError");
	var emailAddressErrorSmall = document.getElementById("emailAddressErrorSmall");
	var message = document.getElementById("message");
	var messageError = document.getElementById("messageErrorForBothScreen");

// Beggining : to validate the message part of contact form
	if(message.value.trim().length < 1){
		message.focus();
		message.style.border = "1px solid red";
		messageError.innerHTML = "Message Field is required...";
		message.placeholder = "Message field is required....";
		event.preventDefault();
	}else{
		messageError.innerHTML = "";
		message.style.border = "1px solid #efefef";
	}
// End : to validate the message part of contact form

// Beggining : to validate the Email part of contact form
	if(emailAddress.value.trim().length < 1){
		emailAddress.focus();
		emailAddress.style.border = "1px solid red";
		emailAddressError.innerHTML = "Email field is required....";
		emailAddressErrorSmall.innerHTML = "Email field is required....";
		emailAddress.placeholder = "Email field is required....";
		event.preventDefault();
	}else if(!emailAddress.value.trim().match(/^[^<>]*$/ig)){
		emailAddress.focus();
		emailAddress.style.border = "1px solid red";
		emailAddressError.innerHTML = "Invalid Email Address..."
		emailAddressErrorSmall.innerHTML = "Invalid Email Address..."
		emailAddress.placeholder = "Invalid Email Address...";
		event.preventDefault();
	}
	else{
		emailAddressError.innerHTML = "";
		emailAddressErrorSmall.innerHTML = "";
		emailAddress.style.border = "1px solid #efefef";
	}
// End : to validate the Email part of contact form

// Beggining : to validate the phone part of contact form
	if(phoneNumber.value.trim().length < 1){
		phoneNumber.focus();
		phoneNumber.style.border = "1px solid red";
		phoneNumberError.innerHTML = "Phone number is required...";
		phoneNumberErrorSmall.innerHTML = "Phone number is required...";
		phoneNumber.placeholder = "Phone field is required....";
		event.preventDefault();
	}else if(!phoneNumber.value.trim().match(/^([0-9+() ]+)-*([ 0-9-]+)$/ig)){
		phoneNumber.focus();
		phoneNumber.style.border = "1px solid red";
		phoneNumberError.innerHTML = "Invalid phone number...";
		phoneNumberErrorSmall.innerHTML = "Invalid phone number...";
		phoneNumber.placeholder = "Invalid phone number...";
		event.preventDefault();
	}
	else{
		phoneNumberError.innerHTML = "";
		phoneNumberError.innerHTMLSmall = "";
		phoneNumber.style.border = "1px solid #efefef";
	}
// End : to validate the phone part of contact form

// Beggining : to validate the fullName part of contact form
	if(fullName.value.trim().length < 1){
		fullName.focus();
		fullName.style.border = "1px solid red";
		fullNameError.innerHTML = "Full Name file is required...";
		fullNameErrorSmall.innerHTML = "Full Name file is required...";
		fullName.placeholder = "Full name field is required...";
		event.preventDefault();
	}else if(!fullName.value.match(/^[^<>]*$/ig)){
		fullName.focus();
		fullName.style.border = "1px solid red";
		fullNameError.innerHTML = "Invalid Name...";
		fullNameErrorSmall.innerHTML = "Invalid Name...";
		fullName.placeholder = "Invalid Name...";
		event.preventDefault();
	}
	else{
		fullNameError.innerHTML = "";
		fullNameErrorSmall.innerHTML = "";
		fullName.style.border = "1px solid #efefef";
	}
// End : to validate the fullName part of contact form

}
// End of : function which validate contact form


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
		}else{
			// This else hide the dropdown content menue when screen is resized
			$("#dropdownContent").hide();
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

// Beggining of : to scroll to contact form when its resposnse is returned back
// Note the status variable is comming from the main page
if(status === "on"){
	$("html,body").animate({
	scrollTop: $("#section5").offset().top+320},"slow");
}
// End of : to scroll to contact form when its resposnse is returned back

// Begenning of : to scroll smooth to for contact us 
	$(".contactUs").click(function(){
		closeNav();
		$("html,body").animate({
			scrollTop: $("#section5").offset().top-74},900);
		$("#fullName").focus();
	});
// End of : to scroll smooth to for contact us

// Beggining of : the function which hide the small slidebar and user menu list when the screen is clicked
$("#mainParent,#footer").click(function(){
	$("#dropdownContent").hide();
	closeNav();
});
// End of : the function which hide the small slidebar and user menu list when the screen is clicked

$("#userProfileParent").click(function(){
	$("#dropdownContent").toggle();
});

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
	        750:{
	            items:(s > 1)  ? '2' : '1',
	            nav:true,
	            loop:(s > 3),

	        },
	        1024:{
	        	items:(s > 1)  ? '3' : '1',
	            nav:true,
	            loop:(s > 3),
	        }
		}
	});
// sllide how for lates new in main page end


});
// jquery ready function end

