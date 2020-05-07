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
<?= $flash_div ?>
<div class="container-fluid">
    <div class="row mt-3 mb-3">
        <div class="col-md-4 offset-md-4">
            <p class="text-center font-weight-bold">ADD EMPLOYEE</p>
            <form action="actions/employee/add_employee.php" class="form-group" method="POST" onSubmit="validation()">
                <input name="Name" type="text" class="form-control" placeholder="Name" required>
                <input name="Phone" id="phone" type="number" class="form-control" placeholder="Mobile" onfocusout="mobileNumber();" required><div id="errorPhone" ></div>
                <input name="Email" id="emailVal" type="email" class="form-control" placeholder="Email" onfocusout="checkEmail();" required><div id="errorEmail" ></div>
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
                                    <td>
                                    <div class="btn-group btn-group-sm">
									<button type="button" class="btn btn-warning  edit-service" onclick=edit_employee('.$employee[0].')>Edit</button>
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
    function del_employee_alert(id)
	{
		var choice = confirm("Are you sure you want to delete this employee? All approved appoinments assigned to this employee will be disapproved!!");
		if(choice)
		{
			location.href="actions/employee/del_employee.php?id="+id;
		}
	}
    </script>
</body>
</html>