<?php
	include_once('configs/db.php');
	include_once('configs/login_check.php'); //DEVELOPRS!!!!!!!!!!!! UNCOMMENT THIS LINE WHEN DEVELOPING
	$_SESSION['booked_appointment'] = $_POST
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
    	.form-control
    	{
    		margin-top: 10px;
    	}
    </style>
</head>
<body>
<div>
	<p class="mb-0 p-2 bg-primary text-light text-center font-weight-bold">Payment</p>
</div>
	<div class="container-fluid mt-3">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<ul class="nav nav-tabs">
				  <li class="nav-item">
				    <a class="nav-link active" data-toggle="tab" href="#home">Debit Card</a>
				  </li>
			
				</ul>
				<div class="tab-content">
				  <div class="tab-pane container active" id="home">
				  	<form action="" class="form-group">
				  		<input type="number" class="form-control" placeholder="Card Number">
						<input type="text" class="form-control" placeholder="Card Name">
						<div class="row">
							<div class="col-md-5">
							   <input type="text" class="form-control" placeholder="Expire month">
							</div>
							<div class="col-md-5">
							   <input type="text" class="form-control" placeholder="Expire Year">
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
							   <input type="text" class="form-control" placeholder="CVV">
							</div>
						</div>
						<a href="">
				  			<button class="btn btn-sm btn-danger float-right ">Cancel</button>
				  		</a>	
						<input type="submit" class="btn btn-primary btn-sm float-right" value="Payment">
				  	</form>
				  </div>
			
				</div>
			</div>
		</div>
	</div>
	<script>
	function cc_brand_id(cur_val) {
		var sel_brand;

		// the regular expressions check for possible matches as you type, hence the OR operators based on the number of chars
		// regexp string length {0} provided for soonest detection of beginning of the card numbers this way it could be used for BIN CODE detection also

		//JCB
		jcb_regex = new RegExp('^(?:2131|1800|35)[0-9]{0,}$'); //2131, 1800, 35 (3528-3589)
		// American Express
		amex_regex = new RegExp('^3[47][0-9]{0,}$'); //34, 37
		// Diners Club
		diners_regex = new RegExp('^3(?:0[0-59]{1}|[689])[0-9]{0,}$'); //300-305, 309, 36, 38-39
		// Visa
		visa_regex = new RegExp('^4[0-9]{0,}$'); //4
		// MasterCard
		mastercard_regex = new RegExp('^(5[1-5]|222[1-9]|22[3-9]|2[3-6]|27[01]|2720)[0-9]{0,}$'); //2221-2720, 51-55
		maestro_regex = new RegExp('^(5[06789]|6)[0-9]{0,}$'); //always growing in the range: 60-69, started with / not something else, but starting 5 must be encoded as mastercard anyway
		//Discover
		discover_regex = new RegExp('^(6011|65|64[4-9]|62212[6-9]|6221[3-9]|622[2-8]|6229[01]|62292[0-5])[0-9]{0,}$');
		////6011, 622126-622925, 644-649, 65
		//RuPay
		rupay_regex = new RegExp('^6(?!011)(?:0[0-9]{14}|52[12][0-9]{12})$');



		// get rid of anything but numbers
		cur_val = cur_val.replace(/\D/g, '');

		// checks per each, as their could be multiple hits
		//fix: ordering matter in detection, otherwise can give false results in rare cases
		if (cur_val.match(jcb_regex)) {
			sel_brand = "jcb";
		} else if (cur_val.match(amex_regex)) {
			sel_brand = "amex";
		} else if (cur_val.match(diners_regex)) {
			sel_brand = "diners_club";
		} else if (cur_val.match(visa_regex)) {
			sel_brand = "visa";
		} else if (cur_val.match(mastercard_regex)) {
			sel_brand = "mastercard";
		} else if (cur_val.match(discover_regex)) {
			sel_brand = "discover";
		} else if (cur_val.match(maestro_regex)) {
			if (cur_val[0] == '5') { //started 5 must be mastercard
			sel_brand = "mastercard";
			} else {
			sel_brand = "maestro"; //maestro is all 60-69 which is not something else, thats why this condition in the end
			}
		} else {
			sel_brand = "unknown";
		}

		return sel_brand;
	}
	</script>
</body>
</html>