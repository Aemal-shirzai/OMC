
// Beggining of the : Function responsible for following the doctors by normal users
function followDoctor(doctorId){

	$("#followText-"+doctorId).text("Loading...");
	event.preventDefault();
	$.ajax({
	// the method the data should be sent with
	method : "POST",

	// the route to which the data should go
	url: DoctorFollow,

	// The data which should be send 
	data: {doctor_id:doctorId, _token:token}

	}).done(function(){
		if($("#followBtnIcon-"+doctorId).hasClass("fa-check")){
			$("#followBtnIcon-"+doctorId).removeClass("fa-check");
			$("#followBtnIcon-"+doctorId).addClass("fa-plus");
			$("#followText-"+doctorId).text("Follow");
			$("#followersCount-"+doctorId).text(parseInt($("#followersCount-"+doctorId).text())-1);
		}else{
			$("#followBtnIcon-"+doctorId).addClass("fa-check");
			$("#followBtnIcon-"+doctorId).removeClass("fa-plus");
			$("#followText-"+doctorId).text("Following");
			$("#followersCount-"+doctorId).text(parseInt($("#followersCount-"+doctorId).text())+1);
		}
	});
}
// End of the : Function responsible for following the doctors by normal users



