<?php 
	include_once('configs/db.php');
	include_once('configs/login_check.php'); //DEVELOPRS!!!!!!!!!!!! UNCOMMENT THIS LINE WHEN DEVELOPING
	include("navbar.php");

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

	//LOAD ONGOING APPOINTMENTS
	//LOAD COMPLETED APPOINTMENTS
	//LOAD CANCELLED APPOINTMENTS
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
    <title></title>
</head>
<body>
<?= $flash_div;?>
	<div class="container-fluid mt-3">
		<p class="text-center font-weight-bold">Ongoing Booking</p>
		<table class="table">
			<thead>
				<tr>
					<th>Sl.no</th>
					<th>date</th>
					<th>time</th>
					<th>Service Type</th>
					<th>Book for</th>
					<th>Address</th>
					<th>Mobile</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>13-02-20</td>
					<td>01:00PM</td>
					<td>On Parlour</td>
					<td>Hair Cutting</td>
					<td>Electronic City</td>
					<td>9876543212</td>
					<td>
						<button class="btn btn-sm btn-warning">Waiting</button>
					</td>
					<td>
						<button class="btn btn-sm btn-danger">Cancel</button>
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td>13-02-20</td>
					<td>03:00PM</td>
					<td>Home</td>
					<td>Nail Polish</td>
					<td>Konapanna Agrahara</td>
					<td>9876543218</td>
					<td>
						<button class="btn btn-sm btn-success">Approved</button>
					</td>
					<td>
						<button class="btn btn-sm btn-danger">Cancel</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="container-fluid mt-3">
		<p class="text-center font-weight-bold">Completed Appointments</p>
		<table class="table">
			<thead>
				<tr>
					<th>Sl.no</th>
					<th>date</th>
					<th>time</th>
					<th>Service Type</th>
					<th>Book for</th>
					<th>Address</th>
					<th>Mobile</th>
					<th>Status</th>
					<th>Bill</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td>13-01-20</td>
					<td>01:00PM</td>
					<td>On Parlour</td>
					<td>Hair Cutting</td>
					<td>Electronic City</td>
					<td>9876543212</td>
					<td>
						<button class="btn btn-sm btn-success">Completed</button>
					</td>
					<td>
						<button class="btn btn-sm btn-primary">Print Bill</button>
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td>13-01-20</td>
					<td>03:00PM</td>
					<td>Home</td>
					<td>Nail Polish</td>
					<td>Konapanna Agrahara</td>
					<td>9876543218</td>
					<td>
						<button class="btn btn-sm btn-success">Completed</button>
					</td>
					<td>
						<button class="btn btn-sm btn-primary">Print Bill</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>