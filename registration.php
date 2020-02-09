<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Salon</title>
	<link rel="stylesheet" href="style/style.css">
	<script src="script/script.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<style>
      #emailVal:invalid {
        border: 2px solid red;
      }

      #emailVal:valid {
        border: 2px solid green;
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
					<input type="number" class="form-control" placeholder="Phone Number" maxlength="10"  id="phone" onfocusout="mobileNumber();">
					
				</div>
				<div class="otp_container">
					<input type="email" class="form-control" placeholder="emailid" onfocusout="checkEmail();"id="emailVal" >
					<button class="otp-input" >Get OTP</button>
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
            alert('Please provide a valid email address');
			
            email.focus;
            return false;
        }
}
	
function mobileNumber()
{
	var Number = document.getElementById('phone');
	var IndNum =/^[6-9]\d{9}$/;
	if(!IndNum.test(Number.value)){
	   alert('please enter valid mobile number');
		
	phone.focus;
	return false;
	}
}




</script> 