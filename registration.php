<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Salon</title>
	<link rel="stylesheet" href="style/style.css">
	<script src="script/script.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<style>
      .invalid {
        border: 1px solid red;
      }

      .valid {
        border: 1px solid green;
      }
    </style>
</head>
<body class="back-img">
	<div class="container-fluid display-flex-center login">
		<div class="login-div">
			<p class="form-title">Registration</p>
			<form formname="myForm"  >
				<div class="input-container">
					<input type="text" class="form-control" placeholder="Name" required>
					<input type="text" class="form-control" placeholder="Username" required>
					<input type="password" id="pass1" name="pswd1"class="form-control" placeholder="Password" minlength="4" maxlength="10"   required >

					<input type="password"  name="pswd2"class="form-control" placeholder="Confirm Password" minlength="4" maxlength="10" required>
					<input type="text" class="form-control" placeholder="address">	
				
				<input type="number" class="form-control" placeholder="Phone Number"   id="phone" required onfocusout="mobileNumber();"><div id="errorPhone"></div>
					</div>
				<div class="otp_container">
					<input type="email" class="form-control" placeholder="emailid" id="emailVal"  ><div id="errorEmail"></div>
					<button class="otp-input" onclick="checkEmail();" >Get OTP</button>
				</div>
				<div class="input-container" id="otp-container">
					<input type="text" class="form-control" placeholder="OTP" >
				</div>
				<hr>
				<input type="submit" value="SUBMIT" class="form-submit" id="okButton"  >
			</form>
		</div>
	</div>
</body>
</html>
<script>
$(document).ready(function(){
	$(".otp-input").click(function(){
		$("#otp-container").css('display','block');
	})
});
function checkEmail() {
        var email = document.getElementById("emailVal");
        var filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!filter.test(email.value))
		{
			document.getElementById("errorEmail").innerHTML="please enter valid Email ID";
			emailVal.classList.add("invalid");
		  email.focus();
			return false;
        }else{
			document.getElementById("errorEmail").innerHTML="";
	emailVal.classList.add("valid");
	return true;
		}
}
	
function mobileNumber()
{
	var Number = document.getElementById("phone");
	var IndNum =/^[6-9]\d{9}$/;
if(!IndNum.test(Number.value)){
	document.getElementById("errorPhone").innerHTML="please enter valid mobile number";
	phone.classList.add("invalid");
	phone.focus();
		return false ;
}else{
	document.getElementById("errorPhone").innerHTML="";
	phone.classList.add("valid");
	return true;
}
}

 
//if(!IndNum.test(Number.value)){
		
	//	document.getElementById("errorPhone").innerHTML="please enter valid mobile number";

	  // phone.focus();
		//return false;
		
//	}
//}
</script>