<?php
    include('dashboard_header.php');
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
	<div class="container-fluid">
		<p class="text-center font-weight-bold m-4">Manager Service</p>
		<div class="row">
			<div class="col-md-3">
				<form action="" class="form-group">
					<p class="text-center">Add Service</p>
					<input type="text" class="form-control" placeholder="Service name">
					<input type="text" class="form-control" placeholder="Service Description">
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
							<th>Action</th>
						</tr>
						<tr>
							<td>ser001</td>
							<td>Hair Cut</td>
							<td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dolor saepe velit aspernatur est eaque nostrum magni beatae! Assumenda, sapiente!</td>
							<td>Rs. 230</td>
							<td>
								<div class="btn-group btn-group-sm">
		                          <button type="button" class="btn btn-warning edit-service">Edit</button>
		                          <button type="button" class="btn btn-danger">Delete</button>
		                        </div>
							</td>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
<div class="edit-service-form">
	<div class="form-container">
		<div class="inner-container">
			<form action="" class="form-group">
				<input type="text" value="Hair Cut" class="form-control">
				<input type="text" value="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio nobis, quidem culpa molestiae repellendus iusto aliquid, eius sint sequi eveniet." class="form-control">
				<input type="number" value="230" class="form-control">
				<div class="text-right btn-group">
					<button type="submit" class="btn btn-sm btn-success">Save</button>
					<button class="btn btn-sm btn-danger cancel-form">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<script>
	$(document).ready(function(){
		$(".edit-service").click(function(){
			$(".edit-service-form")	.fadeIn("fast");
		});
		$(".cancel-form").click(function(){
			$(".edit-service-form")	.fadeOut("fast");
		})
	})
</script>