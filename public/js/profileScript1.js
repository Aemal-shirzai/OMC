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

 if (rows>maxrows){ 

 	textbox.rows=maxrows;
 	textbox.setAttribute("style","border-radius:0px !important;overflow:auto !important");
 	
 }else {
  	textbox.rows=rows;
  	textbox.setAttribute("style","border-radius:40px !important;");
}
 }

 // End of the function which resize the comment text area when the text increase, AND the function whihc enable the commnet button