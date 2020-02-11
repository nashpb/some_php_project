<?php 
	include("navbar.php");
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
</head>
<body>
	<div class="container-fluid">
		<div class="row mt-3 mb-3">
			<div class="col-md-4 offset-md-4">
				<p class="text-center font-weight-bold">BOOK APPOINTMENT</p>
				<form action="" class="form-group">
					<input type="text" class="form-control" placeholder="Name">
					<input type="number" class="form-control" placeholder="Mobile number">
					<input type="date" class="form-control" placeholder="Date">
					<input type="time" class="form-control" placeholder="Time">
					<select name="" id="" class="form-control">
						<option>Select Service</option>
						<option>Hair cutting</option>
						<option>Nail polish</option>
					</select>
					<select name="" id="" class="form-control">
						<option>Service Type</option>
						<option>Home Service</option>
						<option>On Parlour</option>
					</select>
					<textarea name="" id="" rows="3" class="form-control">Address</textarea>
					<input type="submit" value="Book" class="btn btn-sm btn-primary float-right">
				</form>
			</div>
		</div>
	</div>
</body>
</html>