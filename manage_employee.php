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

    //LOAD EMPLOYEES
    $employees = [];
	$sql_query = 'SELECT * FROM `employees`';
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
    <title>Document</title>
    <style>
    .edit-employee-form
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
</head>
<body>
<?= $flash_div ?>
<div class="container-fluid">
    <div class="row mt-3 mb-3">
        <div class="col-md-4 offset-md-4">
            <p class="text-center font-weight-bold">ADD EMPLOYEE</p>
            <form action="actions/employee/add_employee.php" class="form-group" method="POST" onSubmit="return validation()">
                <input name="Name" type="text" class="form-control" placeholder="Name" required>
                <input name="Phone" id="phone" type="number" class="form-control" placeholder="Mobile" onfocusout="mobileNumber();" required><div id="errorPhone" ></div>
                <input name="Email" id="emailVal" type="email" class="form-control" placeholder="Email" onfocusout="checkEmail();" required><div id="errorEmail" ></div>
                <input name="Designation" id="desig" type="text" class="form-control" placeholder="Designation" required>
                <select id="gender" name="Gender" class="form-control selectpicker" title="Select Gender" required>
                    <!-- <option disabled selected>Select A Gender</option> -->
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <input name="Username" type="text" class="form-control" placeholder="Username" required>
                <input name="Password" type="password" class="form-control" placeholder="Password" required>
                <input type="submit" value="Add Employee" class="btn btn-sm btn-primary float-right">
            </form>
        </div>
    </div>
</div>
<hr>
    <p class="text-center font-weight-bold m-4">Manage Employee</p>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <td>Emp ID</td>
                    <td>Name</td>
                    <td>Mobile</td>
                    <td>Email</td>
                    <td>Gender</td>
                    <td>Designation</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <!-- <tr> -->
                <?php if(empty($employees)):?>
							<tr align="center">
							<td colspan="5"> NO EMPLOYEES ADDED </td>
							</tr>
			    <?php else:?>
                <?php 
                    foreach($employees as $key=>$employee)
                    {
                        echo '<tr>
                                    <td>'.($key+1).'</td>
                                    <td>'.$employee[1].'</td>
                                    <td>'.$employee[2].'</td>
                                    <td>'.$employee[3].'</td>
                                    <td>'.$employee[5].'</td>
                                    <td>'.$employee[4].'</td>
                                    <td>
                                    <div class="btn-group btn-group-sm">
									<button type="button" class="btn btn-warning  edit-employee" onclick=edit_employee('.$employee[0].')>Edit</button>
									<button type="button" class="btn btn-danger"  onclick=del_employee_alert('.$employee[0].')>Delete</button>
                                    </div>
                                    </td>
                             </tr>';

                    }
                ?>
                <?php endif; ?>	
                    <!-- <td>emp001</td>
                    <td>Sumit</td>
                    <td>10-01-1997</td>
                    <td>9876543210</td>
                    <td>Hair Cutting</td> -->
                <!-- </tr> -->
            </tbody>
        </table>   
    </div>
    <div class="edit-employee-form">
	<div class="form-container">
		<div class="inner-container">
			<form action="actions/employee/edit_employee.php" class="form-group" method="POST" onSubmit="return validation1()">
				<input id="edit_empl_id" type="hidden" class="form-control" name="empl_id">
				<input id="edit_empl_name" placeholder="Name" type="text" class="form-control" name="empl_name" required>
				<input id="edit_empl_mobile" placeholder="Mobile" type="number" class="form-control" name="empl_mobile" onfocusout="mobileNumber1();" required><div id="errorPhone1" ></div>
                <input id="edit_empl_email" placeholder="Email" type="email" class="form-control" name="empl_email" onfocusout="checkEmail1();" required><div id="errorEmail1" ></div>
                <input name="empl_desg" id="edit_empl_desg" type="text" class="form-control" placeholder="Designation" required>
                <select id="edit_empl_gender" name="empl_gender" class="form-control" title="Select Gender" required>
                    <!-- <option disabled selected>Select A Gender</option> -->
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <input id="edit_empl_username" placeholder="Username" type="text" class="form-control" name="empl_user" required>
                <input id="edit_empl_password" placeholder="Password" type="password" class="form-control" name="empl_password" required>
				<div class="text-right btn-group">
					<button type="submit" class="btn btn-sm btn-success">Save</button>
					<button type="button" class="btn btn-sm btn-danger cancel-form">Cancel</button>
				</div>
			</form>
		</div>
	</div>
    </div>
    <script>
    function mobileNumber()
    {
        var Number = document.getElementById("phone");
        var IndNum =/^[6-9]\d{9}$/;
        if(!IndNum.test(Number.value)){
            document.getElementById("errorPhone").innerHTML="please enter valid mobile number";
            phone.classList.add("invalid");
            errorPhone.style.color="red";
            phone.focus();
                return false ;
        }else{
            document.getElementById("errorPhone").innerHTML="";
            phone.classList.add("valid");
            errorPhone.style.color="green";
            
            return true;
        }
    }
    function checkEmail() {
        var email = document.getElementById("emailVal");
        var filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         
		if (!filter.test(email.value))
		{
			emailVal.classList.add("invalid");
			document.getElementById("errorEmail").innerHTML="please enter valid Email ID";
			errorEmail.style.color="red";
		  email.focus();
			return false;
        }else{
			emailVal.classList.add("valid");
			document.getElementById("errorEmail").innerHTML="";
			errorEmail.style.color="green";
            return true;
		}
    }
    function validation() {
        if(checkEmail() && mobileNumber())
        return true;
        else
        return false;
    }
    function mobileNumber1()
    {
        var Number = document.getElementById("edit_empl_mobile");
        var IndNum =/^[6-9]\d{9}$/;
        if(!IndNum.test(Number.value)){
            document.getElementById("errorPhone1").innerHTML="please enter valid mobile number";
            edit_empl_mobile.classList.add("invalid");
            errorPhone1.style.color="red";
            edit_empl_mobile.focus();
                return false ;
        }else{
            document.getElementById("errorPhone1").innerHTML="";
            edit_empl_mobile.classList.add("valid");
            errorPhone1.style.color="green";
            
            return true;
        }
    }
    function checkEmail1() {
        var email = document.getElementById("edit_empl_email");
        var filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         
		if (!filter.test(email.value))
		{
			edit_empl_email.classList.add("invalid");
			document.getElementById("errorEmail1").innerHTML="please enter valid Email ID";
			errorEmail1.style.color="red";
		    edit_empl_email.focus();
			return false;
        }else{
			edit_empl_email.classList.add("valid");
			document.getElementById("errorEmail1").innerHTML="";
			errorEmail1.style.color="green";
            return true;
		}
    }
    function validation1() {
        if(checkEmail1() && mobileNumber1())
        return true;
        else
        return false;
    }
    function del_employee_alert(id)
	{
		var choice = confirm("Are you sure you want to delete this employee? All approved appoinments assigned to this employee will be disapproved!!");
		if(choice)
		{
			location.href="actions/employee/del_employee.php?id="+id;
		}
    }
    function edit_employee(id)
    {
        $.ajax({
			url:"actions/employee/fetch_employee.php",
			method:"POST",
			data:{id:id},
			dataType:"json",
			success:function(data)
			{
				console.log('lol',data);	
				$('#edit_empl_id').val(data[0]);
				$('#edit_empl_name').val(data[1]);
				$('#edit_empl_mobile').val(data[2]);
                $('#edit_empl_email').val(data[3]);
                $('#edit_empl_desg').val(data[4]);
                $('#edit_empl_gender').val(data[5]);
                $('#edit_empl_username').val(data[6]);
                $('#edit_empl_password').val(data[7]);
                document.getElementById("errorPhone1").innerHTML="";
                edit_empl_mobile.classList.add("valid");
                errorPhone1.style.color="green";
                edit_empl_email.classList.add("valid");
			    document.getElementById("errorEmail1").innerHTML="";
			    errorEmail1.style.color="green";
				$(".edit-employee-form").fadeIn("fast");
			},
			error:function()
			{
				alert("Something Went Wrong!");
			}
		})
    }
    $(document).ready(function(){
		$(".cancel-form").click(function(){
			$(".edit-employee-form").fadeOut("fast");
		})
	})
    </script>
</body>
</html>