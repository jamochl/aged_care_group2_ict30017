
function validate() {
	var pwd1 = $("#password").val();
	var pwd2 = $("#repassword").val();
	var name = $("#name").val();
	var email = $("#email").val();
	var role = $("#roleID").val();
	var phoneNumber = $("#phone").val();
	var nationality = $("#nationality").val();
	var bDate = $("#birthDate").val();

	var errMsg = "";								
	var result = true;								
	var pattern = /^[a-zA-Z ]+$/;					
	var atSign = "@";


	if (pwd1 == "") { 
		errMsg += "<li>Password cannot be empty.</li>";
	}
	if (pwd2 == "") {
		errMsg += "<li>Retype password cannot be empty.</li>";
	}

    if (pwd1.length < 8){
        errMsg += "<li>Password must have at least 8 letters.</li>";
    }

	if (name == "") { 
		errMsg += "<li> Name cannot be empty.</li>";
	}

	if (email.indexOf(atSign) < 0) { 
		errMsg += "<li> Must contain @ for email.</li>";
	}

	if (role == "") { 
		errMsg += "<li> Role cannot be empty.</li>";
	}

	if (role > 4 || role < 1){
		errMsg += "<li> Please enter a valid role.</li>";
	}

	if (phoneNumber == "") {
		errMsg += "<li> Phone number cannot be empty.</li>";
	}

	if (phoneNumber.length != 10) {
		errMsg += "<li> Phone number length must be 10.</li>";
	}

	if (nationality == "") {
		errMsg += "<li> Nationality cannot be empty.</li>";
	}


	if (pwd1 != pwd2) {
		errMsg += "<li>Passwords do not match.</li>";
	}

	if (! name.match (pattern)) {
		errMsg += "<li>User name contains symbols.</li>";
	}

	if (errMsg != "") {
		errMsg = "<div id='scrnOverlay'></div>"
		+ "<section id='errWin' class='window'><ul>"
		+ errMsg
		+ "</ul><a href='#' id='errBtn' class='button'>Close</a></section>";

		var numOfItems = ((errMsg.match(/<li>/g)).length) + 6;
		
		$("body").after(errMsg); 
		$("#scrnOverlay").css('visibility', 'visible');
		$("#errWin").css('height', numOfItems.toString() + 'em'); 
		$("#errWin").css('margin-top', (numOfItems/-2).toString() + 'em');
		$("#errWin").show(); 
		$("#errBtn").click (function () { 
		$("#scrnOverlay").remove();
		$("#errWin").remove();
		} );
		result = false;
	}
	return result;
}



function init () {
	$("#add").submit(validate);
}


jQuery(document).ready(init);