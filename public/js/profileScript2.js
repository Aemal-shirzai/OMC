// Beggining of: the function which shows the profile content based on the clicked button

function openContent(evt,value){
	var tabcontent = document.getElementsByClassName("tab-content");
  	for (i = 0; i < tabcontent.length; i++) {
    	tabcontent[i].style.display = "none";
  	}

  	var tablinks = document.getElementsByClassName("tabLinks");
  	for (i = 0; i < tablinks.length; i++) {
    	tablinks[i].className = tablinks[i].className.replace(" active", "");
  	}

  	 document.getElementById(value).style.display = "block";
 	 evt.currentTarget.className += " active";
}

// End of: the function which shows the profile content based on the clicked button