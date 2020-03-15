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
	$on_appointments = [];
	$sql_query = 'SELECT * FROM `appointments` WHERE (`appointment_status` = "0" OR `appointment_status` = "1") AND `cust_id` = '.$_SESSION['uid'];
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$on_appointments = mysqli_fetch_all($result);
	}
	//LOAD COMPLETED APPOINTMENTS
	$comp_appointments = [];
	$sql_query = 'SELECT * FROM `appointments` WHERE (`appointment_status` = "2" OR `appointment_status` = "3") AND `cust_id` = '.$_SESSION['uid'];
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$comp_appointments = mysqli_fetch_all($result);
	}

	//SERVICE TYPES
	$service_type = ['Home Service','Parlour'];

	//STATUSES
	$status = ['Waiting','Approved','Completed','Cancelled'];
	$color = ['warning', 'primary', 'success', 'danger'];
    
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
	
	<!-- Multi Select -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

	
    <title></title>
</head>
<body>
<?= $flash_div;?>
	<div class="container-fluid mt-3">
		<p class="text-center font-weight-bold">On-Going Appointments</p>
		<table class="table">
			<thead>
				<tr>
					<th>Sl.no</th>
					<th>date</th>
					<th>time</th>
					<th>Service Type</th>
					<th>Services</th>
					<th>Assigned beautician</th>
					<th>Beautician's Mobile</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php if(empty($on_appointments)):?>
							<tr align="center">
							<td colspan="12"> NO ON-GOING APPOINTMENTS </td>
							</tr>
			<?php else:?>
				<?php 
						foreach($on_appointments as $key=>$on_appointment)
						{
							$sel_services = [];
							$optinons = "PROBLEM LOADING SERVICES";
							$emp_number = "Not Assigned yet";
							if(empty($on_appointment[6]))
							{
								$on_appointment[6] = "Not Assigned yet";
							}
							else
							{
								$emp_number = "Number";
							}
							$sql_query = "SELECT `service_id` FROM `appointment_services_junc` WHERE `appointment_id` = ".$on_appointment[0];
							$result = mysqli_query($db_conn,$sql_query);
							if($result)
							{
								$sel_services = mysqli_fetch_all($result);
							}
							if(!empty($sel_services))
							{
								foreach($sel_services as $key_1=>$sel_service)
								{
									$sql_query = "SELECT `name` FROM `services` WHERE `id` =".$sel_service[0];
									$result = mysqli_query($db_conn,$sql_query);
									if($result)
									{
										if($key_1 == 0)
										{
											$optinons = '';
										}
										$optinons.= "<option disabled>".mysqli_fetch_array($result)['name']."</option>";
									}
								}
							}
							
							// var_dump($optinons);exit;
							echo ' 
								<tr>
									<td>'.($key+1).'</td>
									<td>'.date('d-F-Y',strtotime($on_appointment[2])).'</td>
									<td>'.$on_appointment[3].'</td>
									<td>'.$service_type[$on_appointment[4]].'</td>
									<td>
										<select name="services[]" id="services" class="selectpicker" multiple title="Selected Services" data-live-search="true">'
									
										.$optinons.
									'</td>
									<td>'.$on_appointment[6].'</td>
									<td>'.$on_appointment[6].'</td>
									<td>
										<button class="btn btn-sm btn-'.$color[$on_appointment[5]].'">'.$status[$on_appointment[5]].'</button>
									</td>
									<td>
										<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
											<button class="btn btn-sm btn-danger" onclick=cancel_appointment_alert('.$on_appointment[0].')>Cancel</button>
										</div>
									</td>
								</tr>';
						}
						?>
				<?php endif; ?>	
			</tbody>
		</table>
	</div>
	<div class="container-fluid mt-3">
		<p class="text-center font-weight-bold">Previous Appointments</p>
		<table class="table">
			<thead>
				<tr>
					<th>Sl.no</th>
					<th>date</th>
					<th>time</th>
					<th>Service Type</th>
					<th>Services</th>
					<th>Status</th>
					<th>Bill</th>
				</tr>
			</thead>
			<tbody>
			<?php if(empty($comp_appointments)):?>
							<tr align="center">
							<td colspan="12"> NO PREVIOUS APPOINTMENTS </td>
							</tr>
			<?php else:?>
				<?php 
						foreach($comp_appointments as $key=>$comp_appointment)
						{
							$sel_services = [];
							$optinons = "PROBLEM LOADING SERVICES";							
							$sql_query = "SELECT `service_id` FROM `appointment_services_junc` WHERE `appointment_id` = ".$comp_appointment[0];
							$result = mysqli_query($db_conn,$sql_query);
							if($result)
							{
								$sel_services = mysqli_fetch_all($result);
							}
							if(!empty($sel_services))
							{
								foreach($sel_services as $key_1=>$sel_service)
								{
									$sql_query = "SELECT `name` FROM `services` WHERE `id` =".$sel_service[0];
									$result = mysqli_query($db_conn,$sql_query);
									if($result)
									{
										if($key_1 == 0)
										{
											$optinons = '';
										}
										$optinons.= "<option disabled>".mysqli_fetch_array($result)['name']."</option>";
									}
								}
							}
							echo ' 
								<tr>
									<td>'.($key+1).'</td>
									<td>'.date('d-F-Y',strtotime($comp_appointment[2])).'</td>
									<td>'.$comp_appointment[3].'</td>
									<td>'.$service_type[$comp_appointment[4]].'</td>
									<td>
										<select name="services[]" id="services" class="selectpicker" multiple title="Selected Services" data-live-search="true">'
									
										.$optinons.
									'</td>
									<td>
										<button class="btn btn-sm btn-'.$color[$comp_appointment[5]].'">'.$status[$comp_appointment[5]].'</button>
									</td>
									<td>
										<button class="btn btn-sm btn-primary" onclick=print_bill_alert('.$comp_appointment[0].')>Print Bill</button>
									</td>
								</tr>';
						}
						?>
				<?php endif; ?>	
			</tbody>
		</table>
	</div>
	
	<script>
		function cancel_appointment_alert(id)
		{
			var choice = confirm("Are you sure you want to cancel this appointment?");
			if(choice)
			{
				location.href="actions/appointment/cancel_appointment.php?id="+id;
			}
		}

	</script>



</body>
</html>