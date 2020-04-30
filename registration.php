<?php
	include_once('configs/db.php');

	//FLASH MESSAGE SECTION
	$flash_message['status'] = "";
	$flash_message['message'] = "";
	$flash_div = "";
	if(isset($_SESSION['flash']))
	{
		$explode_flash = explode("!!!",$_SESSION['flash']);
		$flash_message['status'] = $explode_flash[0];
		$flash_message['message'] = $explode_flash[1];
		if(!strcasecmp($flash_message['status'],'ERROR'))
		{
			$flash_div = '<div class="alert alert-danger alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$flash_message['message'].'</div>';
		}
		else if(!strcasecmp($flash_message['status'],'Success'))
		{
			$flash_div = '<div class="alert alert-success alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$flash_message['message'].'</div>';
		}
		unset($_SESSION['flash']);
	}
?>
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
<?= $flash_div;?>
	<div class="container-fluid display-flex-center login">
		<div class="login-div">
			<?php
			// if(isset($_GET))
			// {
			// 	print_r($_GET);
			// }

			?>
			<p class="form-title">Registration</p>
			<form id="regForm"  method="post" action="actions/registration/add_customer.php" autocomplete="off">
				<div class="input-container">
					<input name="Name" autocomplete="off" type="text" class="form-control" placeholder="Please Enter Name" required>
					<input name="Username" autocomplete="off" type="text" class="form-control" placeholder="Please Enter Username" required>
					<input name="Password" autocomplete="off" type="password" id="pass1" name="pswd1"  class="form-control showPassword"onfocusout="passwordValidate();" placeholder="Please Enter Password" minlength="4" maxlength="12"   required >
					<div id="passVal"></div>
					<input autocomplete="off" type="password" id="pass2" name="pswd2"class="form-control showPassword" placeholder="Please Enter Password Again"  onfocusout="passwordCheck();"minlength="4" maxlength="12" required><div id="errorPass"></div>
					<label  class="form-control"> Show Password<input type="checkbox" id="checkBox" class="form-control" ></label>
					<input name="Address" autocomplete="off" type="text" class="form-control" placeholder="Please Enter address">	
					<select name="Gender" class="form-control" required>
					<option disabled selected value>Select A Gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					</select>
				<input name="Phone" autocomplete="off" type="number" class="form-control" placeholder="Please Enter Phone Number"   id="phone" required onfocusout="mobileNumber();"><div id="errorPhone" ></div>
					</div>
				<div class="otp_container">
					<input name="Email" autocomplete="off" type="email" class="form-control" placeholder="Please Enter Email-ID" id="emailVal"><div id="errorEmail"  ></div>
					<!-- <button type="button" class="otp-input"  onclick="checkEmail();">Get OTP</button> -->
				</div>
				<!-- <div class="input-container" id="otp-container" >
					<input autocomplete="off" type="text" class="form-control"   placeholder="OTP" >		
				</div> -->
				<hr>
				<input type="submit" value="SUBMIT" class="form-submit" id="okButton"  >
			</form>
			</div>
</body>
</html>
<script>

$(document).ready(function (){

	$("#checkBox").click(function (){
  if($(this).prop("checked") == true){
                $(".showPassword").attr("type","text");
            }
            else {
                $(".showPassword").attr("type","password");
            }
}) 


}) 
 
 


function checkEmail() {
        var email = document.getElementById("emailVal");
        var filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         
		if (!filter.test(email.value))
		{
			emailVal.classList.add("invalid");
			document.getElementById("errorEmail").innerHTML="please enter valid Email ID";
			errorEmail.style.color="red";
		  email.focus();
			return false;
        }else{
			emailVal.classList.add("valid");
			document.getElementById("errorEmail").innerHTML="";
			errorEmail.style.color="green";
				
			//$("#otp-container").css('display','block');
			// var x = document.getElementById("otp-container");
    		// x.style.display = "block";
		}
}
	
function mobileNumber()
{
	var Number = document.getElementById("phone");
	var IndNum =/^[6-9]\d{9}$/;
if(!IndNum.test(Number.value)){
	document.getElementById("errorPhone").innerHTML="please enter valid mobile number";
	phone.classList.add("invalid");
	errorPhone.style.color="red";
	phone.focus();
		return false ;
}else{
	document.getElementById("errorPhone").innerHTML="";
	phone.classList.add("valid");
	errorPhone.style.color="green";
	
	return true;
}
}

function passwordCheck(){
	var pass1=$("#pass1").val();
	var pass2=$("#pass2").val();
if(pass2!= pass1){
	$("#errorPass").html("Password does not match").css("color","red");
	$("#pass2").addClass("invalid");
	$("#pass2").focus();
	 
	 return false;
	
}else{
	$("#errorPass").html("").css("color","green");
	$("#pass2").addClass("valid");
}
}
function passwordValidate(){
	var passVal=RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])");
	var pass1=$("#pass1").val();
	if(!passVal.test(pass1)){
$("#passVal").html("Kindly check with atleast one lower and upper case letter one special character one number ").css("color","red");
		$("#pass1").addClass("invalid");
		$("#pass1").focus();
	}else {
		$("#passVal").html("").css("color","green");
		$("#pass1").addClass("valid");
	}

}
//$(document).ready(function(){
//	$(".otp-input").click(function(){
//		$("#otp-container").css('display','block');	
//	})
//	});
 
//if(!IndNum.test(Number.value)){
		
	//	document.getElementById("errorPhone").innerHTML="please enter valid mobile number";

	  // phone.focus();
		//return false;
		
//	}
//}

// $(document).ready(function(){
// 	$(".otp-input").click(function(){
// 		$("#otp-container").css('display','block');
// 	})
// });
</script>
