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

	//LOAD SERVICES SECTION
	$services = [];
	$sql_query = "select * from services";
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$services = mysqli_fetch_all($result);
	}
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

	<!-- Date and time picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
	  <script src="https://kit.fontawesome.com/27d67155ea.js" crossorigin="anonymous"></script>
	  
	<!-- Multi Select -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
  
	<title>Document</title>
</head>
<body>
<?= $flash_div;?>
	<div class="container-fluid">
		<div class="row mt-3 mb-3">
			<div class="col-md-4 offset-md-4">
				<p class="text-center font-weight-bold">BOOK APPOINTMENT</p>
				<form id="bookForm" action="payment-2.php" class="form-group" method="POST">
					<select name="services[]" id="services" class="form-control selectpicker" multiple title="Select Services" data-live-search="true" required>
					<?php
					foreach($services as $key=>$service)
					{
						echo " <option value={$service[0]}|{$service[3]}>{$service[1]}  ₹{$service[3]}</option>";
					}
					?>

					</select>
					<br>
					<br>
					<select name="service_type" id="service_type" class="form-control selectpicker" title="Select Service Type" required>
						<option value="0">Home Service</option>
						<option value="1">Parlour</option>
					</select>
					<br>
					<br>

					<div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                    <input id="date_picker" onkeydown="return false" name="appointment_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" required/>
                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
					</div>
					<br>
					<div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                    <input id="time_picker" onkeydown="return false" name="appointment_time" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3" required/>
                    <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                    </div>
                	</div>
	
					<br>
					<input type="submit" value="Book" class="form-control btn btn-primary">
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$("#datetimepicker3").on('change.datetimepicker', function() {
		checkBookTime();
	});
	$("#datetimepicker4").on('change.datetimepicker', function() {
		checkBookTime();
	});
	$("#bookForm").on("submit", function(){

		if(checkBookTime())
			return true;
		else
			return false;
 	})


	function checkBookTime()
	{
		let curr_time = moment().add(30, 'minutes').format('hh:mm A');
		let given_time = document.getElementById("time_picker").value
		let given_date = document.getElementById("date_picker").value
		if(given_time != "" && given_date == moment().format('YYYY-MM-DD'))
		{
			if (moment(given_time, "h:mm:ss A").unix() > moment(curr_time, "h:mm:ss A").unix())
			{
				alert("Please book atleast 30 mins from current time")
				document.getElementById("time_picker").value = moment().add(30, 'minutes').format('hh:mm A');
				return false
			}
		}
		return true;
	}

	</script>
	<script type="text/javascript">
	var deftime = moment().add(30, 'minutes');
            $(function () {
                $('#datetimepicker3').datetimepicker({
					format: 'LT',
					defaultDate: deftime,
					disabledTimeIntervals: [[moment({ h: 0 }), moment({ h: 7})], [moment({ h: 21 }), moment({ h: 24 } )]]
                });
            });
		</script>
	  <script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker({
					format: 'YYYY-MM-DD',
					defaultDate: moment(),
					minDate:moment().format('L')
                });
            });
        </script>
</body>
</html>