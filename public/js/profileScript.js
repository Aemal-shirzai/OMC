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

// Begginng of : the function which validate the comment form

function validateCommentForm(postId){
	var field = document.getElementById("commentField-"+postId);
	if(field.value.trim().length < 1){
		field.focus();
		field.style.border = "1px solid red";
		field.placeholder = "can not add empty comment";
		event.preventDefault();
	}else{
		field.placeholder = "Add Comment...";
		field.style.border = "none";
	}
}
// End of : the function which validate the comment form

// Beggining of the function which resize the comment text area when the text increase, AND the function whihc enable the commnet button
function do_resize_and_enable_button(textbox,postId) {
 var maxrows=15; 
  var txt=textbox.value;
  var cols=textbox.cols;
// enable button
if(txt.trim().length > 0){
	//  This if is to disable border red if the text area is border red due to any error
	if(textbox.style.border == "1px solid red"){
		textbox.style.border = "none";
		textbox.placeholder = "Add Comment...";
	}
	document.getElementById("addCommentBtn-"+postId).disabled = false;
}else{
	document.getElementById("addCommentBtn-"+postId).disabled = true;
}

// resize
 var arraytxt=txt.split('\n');

  var rows=arraytxt.length; 

 for (i=0;i<arraytxt.length;i++) 
  rows+=parseInt(arraytxt[i].length/cols);

if(rows == 1){
	textbox.setAttribute("style","border-radius:10px !important;");
	
}else{
	textbox.setAttribute("style","border-radius:0px !important;");
}

 if (rows>maxrows){ 

 	textbox.rows=maxrows;
 	textbox.setAttribute("style","overflow:auto !important");
 	
 }else {
  	textbox.rows=rows;
}
 }
 // End of the function which resize the comment text area when the text increase, AND the function whihc enable the commnet button


 // Beggining of : the function which open the comment photo field
function openCommentPhotoField(value){
	// var field = document.getElementById("commentPhotoField-"+value);
	var field = document.getElementById("commentPhotoField-"+value);
	field.click();
}
 // End of : the function which open the comment photo field


// Beggining of : the function which open the share options menu

var count = 0;
function openShareOptions(value){
	var menu = document.getElementById("shareOptions-"+value);
	if(count == 0){
		menu.style.display = "block";
		count = 1;
	}else{
		menu.style.display = "none";
		count =0;
	}
	event.preventDefault();
}

// End of : the function which open the share options menu


