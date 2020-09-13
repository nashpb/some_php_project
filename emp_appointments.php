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

	//EXPIRE APPOINTMENTS
	$exp_appointments = [];
	$sql_query = 'SELECT * FROM `appointments` WHERE (`appointment_status` = "0" OR `appointment_status` = "1")';
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$exp_appointments = mysqli_fetch_all($result);
		$today = date("Y-m-d");
		foreach($exp_appointments as $exp_appointment)
		{
			if($exp_appointment[2] < $today)
			{
				$sql_query = 'UPDATE `appointments` SET `appointment_status`="3" WHERE `id`='.$exp_appointment[0];
				mysqli_query($db_conn,$sql_query);
			}
		}
	}


	//LOAD ONGOING APPOINTMENTS
	$on_appointments = [];
	$sql_query = 'SELECT * FROM `appointments` WHERE (`appointment_status` = "1") AND `emp_id` = '.$_SESSION['uid'];
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$on_appointments = mysqli_fetch_all($result);
	}
	//LOAD COMPLETED APPOINTMENTS
	$comp_appointments = [];
	$sql_query = 'SELECT * FROM `appointments` WHERE (`appointment_status` = "2" OR `appointment_status` = "3") AND `emp_id` = '.$_SESSION['uid'];
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
    <link rel="stylesheet" href="style/bootstrap.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
	<!-- Multi Select -->
	<link rel="stylesheet" href="style/bootstrap-select.min.css">
	<script src="style/bootstrap-select.min.js"></script>

	
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
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>D&T</th>
                    <th>Services</th>
                    <th>Service Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(empty($on_appointments)):?>
							<tr align="center">
							<td colspan="8"> NO ON-GOING APPOINTMENTS </td>
							</tr>
			<?php else:?>
                <?php 
						foreach($on_appointments as $key=>$on_appointment)
						{
                            $sel_services = [];
							$optinons = "PROBLEM LOADING SERVICES";
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
                            $sql_query = "SELECT * from `customers` WHERE id=".$on_appointment[1]; 
                            $result = mysqli_query($db_conn,$sql_query);
							if($result)
							{
								$customer_details = mysqli_fetch_all($result);
                            }
                            echo 
                            '<tr>
                                <td>'.($key+1).'</td>
                                <td>'.$customer_details[0][1].'</td>
                                <td>'.$customer_details[0][3].'</td>
                                <td>'.$customer_details[0][4].'</td>
                                <td>'.date('d-F-Y',strtotime($on_appointment[2])).' | '.$on_appointment[3].'</td>
                                <td><select name="services[]" id="services" class="selectpicker" multiple title="Selected Services" data-width="100%" data-live-search="true">'
									
                                .$optinons.
                                '</td>
                                <td>'.$service_type[$on_appointment[4]].'</td>
                                <td>
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-primary" onclick=complete_appointment_alert('.$on_appointment[0].')>Complete</button>
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
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>D&T</th>
                    <th>Service for</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php if(empty($comp_appointments)):?>
							<tr align="center">
							<td colspan="9"> NO COMPLETED APPOINTMENTS </td>
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
                            $sql_query = "SELECT * from `customers` WHERE id=".$comp_appointment[1]; 
                            $result = mysqli_query($db_conn,$sql_query);
							if($result)
							{
								$customer_details = mysqli_fetch_all($result);
                            }
                            echo 
                            '<tr>
                                <td>'.($key+1).'</td>
                                <td>'.$customer_details[0][1].'</td>
                                <td>'.$customer_details[0][3].'</td>
                                <td>'.$customer_details[0][4].'</td>
                                <td>'.date('d-F-Y',strtotime($comp_appointment[2])).' | '.$comp_appointment[3].'</td>
                                <td><select name="services[]" id="services" class="selectpicker" multiple title="Selected Services" data-width="100%" data-live-search="true">'
									
                                .$optinons.
                                '</td>
                                <td>'.$service_type[$comp_appointment[4]].'</td>
                                <td>
                                    <div class="btn-group">
                                    <button class="btn btn-sm btn-'.$color[$comp_appointment[5]].'">'.$status[$comp_appointment[5]].'</button>
                                    </div>
                                </td>
                            </tr>';
                        }
                        ?>
                <?php endif; ?>	
            </tbody>
        </table>
	</div>
	
	<script>
		function complete_appointment_alert(id)
		{
			var choice = confirm("Are you sure you want to complete this appointment?");
			if(choice)
			{
				location.href="actions/appointment/complete_appointment.php?id="+id;
			}
		}

	</script>



</body>
</html>