<?php
	//IMPORT CONFIGS
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
    <link rel="stylesheet" href="style/bootstrap.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
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
</style>
<body>
<?= $flash_div;?>
	<div class="container-fluid">
		<p class="text-center font-weight-bold m-4">Manager Service</p>
		<div class="row">
			<div class="col-md-3">
				<form action="actions/service/add_service.php" class="form-group" method="POST">
					<p class="text-center font-weight-bold">Add Service</p>
					<input type="text" class="form-control" placeholder="Service name" name="ser_name" required>
					<input type="text" class="form-control" placeholder="Service Description" name="ser_desc" required>
					<input type="number" class="form-control" placeholder="Price" name="ser_price" required>
					<select class="form-control" name="ser_gender" required>
					<option disabled selected value>Select a gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					</select>
					<div class="text-right">
						<input type="submit" value="Add Service" class="btn btn-sm btn-primary">
					</div>
				</form>
			</div>
			<div class="col-md-9">
				<table class="table">
					<thead>
						<tr>
							<th>S.ID</th>
							<th>Service Name</th>
							<th>Description</th>
							<th>Pricing</th>
							<th>Gender</th>
							<th>Action</th>
						</tr>
						<?php if(empty($services)):?>
							<tr align="center">
							<td colspan="6"> NO SERVICES ADDED </td>
							</tr>
						<?php else:?>
						<?php 
						foreach($services as $key=>$service)
						{
						echo ' 
							<tr>
								<td>'.($key+1).'</td>
								<td>'.$service[1].'</td>
								<td>'.$service[2].'</td>
								<td>'.$service[3].'</td>
								<td>'.$service[4].'</td>
								<td>
									<div class="btn-group btn-group-sm">
									<button type="button" class="btn btn-warning  edit-service" onclick=edit_service('.$service[0].')>Edit</button>
									<button type="button" class="btn btn-danger"  onclick=del_service_alert('.$service[0].')>Delete</button>
									</div>
								</td>
							</tr>';
						}
						?>
						<?php endif; ?>	

					</thead>
				</table>
			</div>
		</div>
	</div>
<div class="edit-service-form">
	<div class="form-container">
		<div class="inner-container">
			<form action="actions/service/edit_service.php" class="form-group" method="POST">
				<input id="edit_serv_id" type="hidden" class="form-control" name="ser_id">
				<input id="edit_serv_name" type="text" class="form-control" name="ser_name" required>
				<input id="edit_serv_desc" type="text" class="form-control" name="ser_desc" required>
				<input id="edit_serv_price" type="number" class="form-control" name="ser_price" required>
				<select id="edit_serv_gender" class="form-control" name="ser_gender" required>
					<option disabled selected value>Select a gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
				<div class="text-right btn-group">
					<button type="submit" class="btn btn-sm btn-success">Save</button>
					<button type="button" class="btn btn-sm btn-danger cancel-form">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<script>

	function edit_service(id)
	{
		$.ajax({
			url:"actions/service/fetch_service.php",
			method:"POST",
			data:{id:id},
			dataType:"json",
			success:function(data)
			{
				// console.log('lol',data[0]);	
				$('#edit_serv_id').val(data[0]);
				$('#edit_serv_name').val(data[1]);
				$('#edit_serv_desc').val(data[2]);
				$('#edit_serv_price').val(data[3]);
				$('#edit_serv_gender').val(data[4]);
				$(".edit-service-form")	.fadeIn("fast");
			},
			error:function()
			{
				alert("Something Went Wrong!");
			}
		})
	}

	function del_service_alert(id)
	{
		var choice = confirm("Are you sure you want to delete the service");
		if(choice)
		{
			location.href="actions/service/remove_service.php?id="+id;
		}
	}
	$(document).ready(function(){
		$(".cancel-form").click(function(){
			$(".edit-service-form")	.fadeOut("fast");
		})
	})
</script>