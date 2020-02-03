<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Salon</title>
	<link rel="stylesheet" href="style/style.css">
	<script src="script/script.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body class="back-img">
	<div class="container-fluid display-flex-center login">
		<div class="login-div">
			<p class="form-title">Registration</p>
			<form>
				<div class="input-container">
					<input type="text" class="form-control" placeholder="Name">
					<input type="text" class="form-control" placeholder="Username">
					<input type="text" class="form-control" placeholder="Password">
					<input type="text" class="form-control" placeholder="address">
				</div>
				<div class="otp_container">
					<input type="text" class="form-control" placeholder="Phone Number">
					<p class="otp-input">Get OTP</p>
				</div>
				<div class="input-container" id="otp-container">
					<input type="text" class="form-control" placeholder="OTP">
				</div>
				<hr>
				<input type="submit" value="SUBMIT" class="form-submit">
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
</script>