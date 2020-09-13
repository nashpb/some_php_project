<?php
    include_once('configs/db.php');
    include_once('configs/login_check.php'); //DEVELOPRS!!!!!!!!!!!! UNCOMMENT THIS LINE WHEN DEVELOPING
    include('dashboard_header.php');

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
	$sql_query = 'SELECT * FROM `appointments` WHERE (`appointment_status` = "0")';
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$on_appointments = mysqli_fetch_all($result);
    }
    //LOAD APPROVED APPOINTMENTS
    $approved_appointments = [];
	$sql_query = 'SELECT * FROM `appointments` WHERE (`appointment_status` = "1") ';
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$approved_appointments = mysqli_fetch_all($result);
    }
	//LOAD COMPLETED APPOINTMENTS
	$comp_appointments = [];
	$sql_query = 'SELECT * FROM `appointments` WHERE (`appointment_status` = "2" OR `appointment_status` = "3")';
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
    
    //LOAD EMPLOYEES
	$employees = [];
	$sql_query = "select * from employees";
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$employees = mysqli_fetch_all($result);
	}
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

    <!-- PDF GEN -->
    <script src="./script/html2canvas.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>


    <title>Document</title>
    <style>
.edit-service-form
{
	position: fixed;
	top: 0px;
	left: 0px;
	height: 100vh;
	width: 100%;
	background-color: rgba(0,0,0,0.4);
	display: none;
}
.form-container
{
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100vh;
}
.inner-container
{
	width: 400px;
	background-color: #fff;
	padding: 20px;
	border-radius: 5px;

}
.pdfgen{
    left: 89vw;
    position: relative;
}
</style>
</head>
<body>
<?= $flash_div ?>
<button class="btn btn-success pdfgen" onClick="getPDF()">Generate PDF</button>
<div class="canvas_div_pdf">
    <p class="text-center font-weight-bold m-4">Manage Appointments</p>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>ID</th>
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
                                <td>APP-'.$on_appointment[0].'</td>
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
                                    <button type="button" class="btn btn-success" onclick=assign_employee('.$on_appointment[0].')>Approve</button>
                                    <button type="button" class="btn btn-danger" onclick=cancel_appointment_alert('.$on_appointment[0].')>Cancel</button>
                                    </div>
                                </td>
                            </tr>';
                        }
                        ?>
                <?php endif; ?>	
            </tbody>
        </table>
    </div>
    <p class="text-center font-weight-bold m-4">Approved Appointments</p>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>D&T</th>
                    <th>Service for</th>
                    <th>Type</th>
                    <th>Assigned Person</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(empty($approved_appointments)):?>
							<tr align="center">
							<td colspan="9"> NO APPROVED APPOINTMENTS </td>
							</tr>
			<?php else:?>
                <?php 
						foreach($approved_appointments as $key=>$approved_appointment)
						{
                            $sel_services = [];
                            $optinons = "PROBLEM LOADING SERVICES";
							if(empty($approved_appointment[6]))
							{
								$approved_appointment[6] = "Not Assigned yet";
							}
							else
							{
                                $sql_query = 'SELECT * FROM employees where id='.$approved_appointment[6];
                                $result = mysqli_query($db_conn,$sql_query);
                                if($result)
                                {
                                    $employee = mysqli_fetch_all($result);
                                }   
                                $approved_appointment[6] = $employee[0][1];  
							}
                            $sql_query = "SELECT `service_id` FROM `appointment_services_junc` WHERE `appointment_id` = ".$approved_appointment[0];
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
                            $sql_query = "SELECT * from `customers` WHERE id=".$approved_appointment[1]; 
                            $result = mysqli_query($db_conn,$sql_query);
							if($result)
							{
								$customer_details = mysqli_fetch_all($result);
                            }
                            echo 
                            '<tr>
                                <td>'.($key+1).'</td>
                                <td>APP-'.$approved_appointment[0].'</td>
                                <td>'.$customer_details[0][1].'</td>
                                <td>'.$customer_details[0][3].'</td>
                                <td>'.$customer_details[0][4].'</td>
                                <td>'.date('d-F-Y',strtotime($approved_appointment[2])).' | '.$approved_appointment[3].'</td>
                                <td><select name="services[]" id="services" class="selectpicker" multiple title="Selected Services" data-width="100%" data-live-search="true">'
									
                                .$optinons.
                                '</td>
                                <td>'.$service_type[$approved_appointment[4]].'</td>
                                <td>'.$approved_appointment[6].'</td>
                                <td>
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-warning"  onclick=disapprove('.$approved_appointment[0].')>Disapprove</button>
                                    </div>
                                </td>
                            </tr>';
                        }
                        ?>
                <?php endif; ?>	
            </tbody>
        </table>
    </div>
    <p class="text-center font-weight-bold m-4">Completed Appointments</p>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>D&T</th>
                    <th>Service for</th>
                    <th>Type</th>
                    <th>Assigned Person</th>
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
							if(empty($comp_appointment[6]))
							{
								$comp_appointment[6] = "Not Assigned";
							}
							else
							{
                                $sql_query = 'SELECT * FROM employees where id='.$comp_appointment[6];
                                $result = mysqli_query($db_conn,$sql_query);
                                if($result)
                                {
                                    $employee = mysqli_fetch_all($result);
                                }   
                                $comp_appointment[6] = $employee[0][1];  
							}
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
                                <td>APP-'.$comp_appointment[0].'</td>
                                <td>'.$customer_details[0][1].'</td>
                                <td>'.$customer_details[0][3].'</td>
                                <td>'.$customer_details[0][4].'</td>
                                <td>'.date('d-F-Y',strtotime($comp_appointment[2])).' | '.$comp_appointment[3].'</td>
                                <td><select name="services[]" id="services" class="selectpicker" multiple title="Selected Services" data-width="100%" data-live-search="true">'
									
                                .$optinons.
                                '</td>
                                <td>'.$service_type[$comp_appointment[4]].'</td>
                                <td>'.$comp_appointment[6].'</td>
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
    <style>
    .table{
        table-layout:fixed;
    }
    </style>
    <script>
		function cancel_appointment_alert(id)
		{
			var choice = confirm("Are you sure you want to cancel this appointment?");
			if(choice)
			{
				location.href="actions/appointment/cancel_appointment.php?id="+id;
			}
		}

        function assign_employee(id)
	    {
            $(".edit-service-form")	.fadeIn("fast");
            $('#emp_assg_id').val(id);
        }
        
        function disapprove(id)
        {
            var choice = confirm("Are you sure you want to disapprove the appointment?");
            if(choice)
            {
                location.href="actions/appointment/disapprove.php?id="+id;
            }
        }

        $(document).ready(function(){
		$(".cancel-form").click(function(){
			$(".edit-service-form")	.fadeOut("fast");
		})
	})

	</script>
    <script>
    function getPDF(){

        var HTML_Width = $(".canvas_div_pdf").width();
        var HTML_Height = $(".canvas_div_pdf").height();
        var top_left_margin = 15;
        var PDF_Width = HTML_Width+(top_left_margin*2);
        var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;


        html2canvas($(".canvas_div_pdf")[0],{allowTaint:true}).then(function(canvas) {
            canvas.getContext('2d');
            
            console.log(canvas.height+"  "+canvas.width);
            
            
            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
            
            
            for (var i = 1; i <= totalPDFPages; i++) { 
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
            }
            var today = new Date();
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var dateTime = date+''+time;
            pdf.save("AppointmentsList"+dateTime+".pdf");
        });
    };
    </script>
    <div class="edit-service-form">
	<div class="form-container">
		<div class="inner-container">
			<form action="actions/appointment/assign_employee.php" class="form-group" method="POST">
				
				<input id="emp_assg_id" type="hidden" class="form-control" name="app_id">
				<select name="employees[]" id="employees" class="form-control selectpicker" title="Select Employee To be assigned" data-live-search="true" required>
					<?php
					foreach($employees as $key=>$employee)
					{
						echo " <option value=".$employee[0].">".$employee[1]." (".$employee[4].")</option>";
					}
					?>
                </select>
                <br>
                <br>
				<div class="text-left btn-group">
					<button type="submit" class="btn btn-sm btn-success">Approve</button>
					<button class="btn btn-sm btn-danger cancel-form">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</body>
</html>