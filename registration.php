<?php
	include_once('configs/db.php');
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
	<div class="container-fluid display-flex-center login">
		<div class="login-div">
			<?php
			// if(isset($_GET))
			// {
			// 	print_r($_GET);
			// }

			?>
			<p class="form-title">Registration</p>
<<<<<<< Updated upstream
			<form formname="myForm"  >
				<div class="input-container">
					<input type="text" class="form-control" placeholder="Name" required>
					<input type="text" class="form-control" placeholder="Username" required>
					<input type="password" id="pass1" name="pswd1"  class="form-control showPassword"onfocusout="passwordValidate();" placeholder="Password" minlength="4" maxlength="12"   required >
						<div id="passVal"></div>
<input type="password" id="pass2" name="pswd2"class="form-control showPassword" placeholder="Confirm Password"  onfocusout="passwordCheck();"minlength="4" maxlength="12" required><div id="errorPass"></div>
					<input type="checkbox" id="checkBox"><span>show Password</span>
					<input type="text" class="form-control" placeholder="address">	
				
				<input type="number" class="form-control" placeholder="Phone Number"   id="phone" required onfocusout="mobileNumber();"><div id="errorPhone" ></div>
					</div>
				<div class="otp_container">
					<input type="email" class="form-control" placeholder="emailid" id="emailVal"     ><div id="errorEmail"  ></div>
					<button type="button" class="otp-input"  onclick="checkEmail();">Get OTP</button>
				</div>
				<div class="input-container" id="otp-container" >
					<input type="text" class="form-control"   placeholder="OTP" >
=======
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="input-container">
					<input type="text" class="form-control" placeholder="Name" name="name">
					<span class="nameErr">* <?php echo $_GET["nameErr"]?></span><br>
					<input type="text" class="form-control" placeholder="Email" name="email">
					<span class="emailErr">* <?php echo $_GET["emailErr"];?></span><br>
					<input type="text" class="form-control" placeholder="Password" name="password">
					<span class="passwordErr">* <?php echo $_GET["passwordErr"];?></span><br>
					<!-- <input type="text" class="form-control" placeholder="address" name="address"> -->
					Gender : 
					<input type="radio" name="gender" value="female">Female
					<input type="radio" name="gender" value="male">Male 
					<input type="radio" name="gender" value="other">Other
					<span class="error">* <?php echo "$genderErr";?></span><br>
				</div>
				<div class="otp_container">
					<input type="text" class="form-control" placeholder="Phone Number" name="phoneno">
					<span class="error">* <?php echo "$phonenoErr";?></span><br>
					<p class="otp-input">Get OTP</p>
				</div>
				<div class="input-container" id="otp-container">
					<input type="text" class="form-control" placeholder="OTP"><br>
>>>>>>> Stashed changes
				</div>
				<hr>
				<input type="submit" value="SUBMIT" class="form-submit" id="okButton"  >
			</form>
		</div>
	</div>
</body>
</html>
<script>
<<<<<<< Updated upstream

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
			var x = document.getElementById("otp-container");
    		x.style.display = "block";
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
</script>
=======
$(document).ready(function(){
	$(".otp-input").click(function(){
		$("#otp-container").css('display','block');
	})
});
</script>


<?php 

	$name = $email = $password = $gender = $phoneno="";
	$nameErr = $emailErr = $passwordErr = $genderErr = $phonenoErr = "";
	$flag = 0;
	
	$playerurl = "registration.php" ;
	$testvar = "TESTING NIGGA"; 



	if($_SERVER["REQUEST_METHOD"] == "POST"){

		// echo "Your registration form is being processed.. please wait.";
		// echo "Getting the data !";
		if(empty($_POST["name"])){
			$nameErr = "Name is required ! ";
			// echo "$nameErr";
			header( "Location: $playerurl?nameErr=$nameErr" );
			$flag++;
		}
		else{
			$name = test_input($_POST["name"]);
			if (!preg_match("/^[a-zA-Z ]*$/",$name)){
 				$nameErr = "Only letters and white space allowed";
 				// echo "$nameErr";
				header( "Location: $playerurl?nameErr=$nameErr" );
 				$flag++;
			}
		}
		
		if(empty($_POST["email"])){
			$emailErr = "Email is required ! ";
			// echo $emailErr;
			header( "Location: $playerurl?emailErr=$emailErr" );
			$flag++;
		}
		else{
			$email = test_input($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid email format";
				// echo $emailErr;
				header( "Location: $playerurl?emailErr=$emailErr" );
				$flag++;
			}

		}
		
		if(empty($_POST["password"])){
			$passwordErr = "Password is required ! ";
			// echo $passwordErr;
			header( "Location: $playerurl?passwordErr=$passwordErr" );
			$flag++;
		}
		else
			$password = test_input($_POST["password"]);
		
		if(empty($_POST["gender"])){
			$genderErr = "Gender is required ! ";
			// echo $genderErr;
			header( "Location: $playerurl?genderErr=$genderErr" );
			$flag++;
		}
		else
			$gender = test_input($_POST["gender"]);
		
		if(empty($_POST["phoneno"])){
			$phonenoErr = "Phone Number is required ! ";
			// echo $phonenoErr;
			header( "Location: $playerurl?phonenoErr=$phonenoErr" );
			$flag++;
		}
		else{
			$phoneno = test_input($_POST["phoneno"]);
			if(!preg_match("/^[0-9]{10}$/",$phoneno)) {
				$phonenoErr = "Invalid phone number ! ";
				// echo $phonenoErr;
				header( "Location: $playerurl?phonenoErr=$phonenoErr" );
				$flag++;
			}	
		}

		//echo $name. "," .$username. "," .$password. "," .$address;
		// echo "$name, $email, $password, $gender, $phoneno";

		// echo "<br> outside the method : $name, $email, $password, $gender, $phoneno<br>";
		
		if($flag == 0)
			connect($name, $password, $email, $gender, $phoneno);
		else
			echo "<h1>Flag</h1>";

	}
	else
		echo "<h1>condition failed !!</h1>";

	


	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function connect($name, $password, $email, $gender, $phoneno){

		// echo "<br> inside connect() : $name, $email, $password, $gender, $phoneno<br>";

		$servername = "localhost";
		$db_username = "admin";
		$db_password = "pass";
		$db_name = "salon";

		// creating connection
		$conn = new mysqli($servername, $db_username, $db_password, $db_name);

		// checking connection
		if ($conn -> connect_error){
			// echo "connection failed";
			die("Connection failed : ".$conn->connect_error);
		}
		// echo "Connected successfully \n";

		// echo "<br> name : $name, password : $password";

		$sql = "insert into customers (name, password, email, phone_no, gender, verified) values(\"$name\", \"$password\", \"$email\", \"$phoneno\", \"$gender\", \"n\")";
		//$sql = "insert into customers (name, password) values($name, $password)";
		
		if ($conn->query($sql) === TRUE) {
		    
		    echo "<h1>New Record created !</h1>";
		    
		} else {
		    echo "<h1>error</h1>";
		}

		$conn->close();
	}

?>
>>>>>>> Stashed changes
