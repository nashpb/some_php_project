<?php 
    include_once('configs/db.php');
	include_once('configs/login_check.php');
    include("navbar.php");
    
    //LOAD Employee
    $employee = [];
	$sql_query = "select * from employees where id=".$_SESSION['uid'];
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$employee = mysqli_fetch_all($result);
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
    <title></title>
    <style>
        #save-change
        {
            display: none;
        }
        #cancel-change
        {
            display: none;
        }
        .form-control[readonly]
        {
            border: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5 border rounded">
                <h4 class="text-center">User Profile</h4>
                <form method="POST" action="" onSubmit="return false">
                    <div>
                        <input name="id" id="id" type="hidden" class="form-control" value=<?= $employee[0][0]?> readonly>
                    </div>
                    <div>
                        <label for="username">Username</label>
                        <input name="username" id="username" type="text" class="form-control" value=<?= $_SESSION['uname']?> readonly>
                    </div>
                    <div>
                        <label for="name">Name</label>
                        <input name="name" id="name" type="text" class="form-control" value=<?= $employee[0][1]?> readonly>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input name="email" id="email" type="text" onfocusout="checkEmail();" class="form-control" value=<?= $employee[0][3]?> readonly>
                    </div>
                    <div>
                        <label for="phone">Phone</label>
                        <input name="phone" id="phone" type="number" onfocusout="mobileNumber();" class="form-control" value=<?= $employee[0][2]?> readonly>
                    </div>
                    <div>
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control"  readonly required>
                        <?php
                        $malesel="";
                        $femalesel="";
                        $defsel="selected";
                        if($employee[0][5] == 'Male')
                        {
                            $malesel="selected";
                            $defsel="";
                        }
                        else if($employee[0][5] == 'Female')
                        {
                            $femalesel="selected";
                            $defsel="";
                        }
                        ?>
                        <option disabled <?= $defsel?> value>Select A Gender</option>
                        <option <?= $malesel ?> disabled value="Male">Male</option>
                        <option <?= $femalesel?> disabled value="Female">Female</option>
                        </select>
                    </div>
                    <div>
                        <label for="designation">Designation</label>
                        <input name="designation" id="designation" class="form-control" readonly value="<?= $employee[0][4]?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>