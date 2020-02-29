<?php
	include_once('configs/db.php');
	include_once('configs/login_check.php'); //DEVELOPRS!!!!!!!!!!!! UNCOMMENT THIS LINE WHEN DEVELOPING
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
				  <li class="nav-item">
				    <a class="nav-link" data-toggle="tab" href="#menu2">Cash</a>
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
				  <div class="tab-pane container fade" id="menu2">
				  	<a href="">
				  		<button class="btn btn-sm btn-primary mt-5">CASH ON COMPLETION</button>
				  	</a>
				  	<a href="">
				  		<button class="btn btn-sm btn-danger mt-5">Cancel</button>
				  	</a>
				  </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>