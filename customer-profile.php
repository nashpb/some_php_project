<?php 
    include_once('configs/db.php');
	include_once('configs/login_check.php');
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
    
    //LOAD Customer
    $customer = [];
	$sql_query = "select * from customers where id=".$_SESSION['uid'];
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$customer = mysqli_fetch_all($result);
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
    <?= $flash_div;?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5 border rounded">
                <h4 class="text-center">User Profile</h4>
                <div class="text-right">
                    <button id="edit-profile" class="btn btn-sm btn-primary">Edit Profile</button>
                </div>
                <form method="POST" action="actions/registration/edit_customer.php" class="form-group">
                    <div>
                        <input name="id" id="id" type="hidden" class="form-control" value=<?= $customer[0][0]?> readonly>
                    </div>
                    <div>
                        <label for="username">Username</label>
                        <input name="username" id="username" type="text" class="form-control" value=<?= $_SESSION['uname']?> readonly>
                    </div>
                    <div>
                        <label for="name">Name</label>
                        <input name="name" id="name" type="text" class="form-control" value=<?= $customer[0][1]?> readonly>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input name="email" id="email" type="text" class="form-control" value=<?= $customer[0][2]?> readonly>
                    </div>
                    <div>
                        <label for="phone">Phone</label>
                        <input name="phone" id="phone" type="text" class="form-control" value=<?= $customer[0][4]?> readonly>
                    </div>
                    <div>
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="form-control"  readonly required>
                        <?php
                        $malesel="";
                        $femalesel="";
                        $defsel="selected";
                        if($customer[0][3] == 'Male')
                        {
                            $malesel="selected";
                            $defsel="";
                        }
                        else if($customer[0][3] == 'Female')
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
                        <label for="phone">Address</label>
                        <textarea name="address" id="address" class="form-control" readonly><?= $customer[0][5]?></textarea>
                    </div>
                    <div class="text-right">
                        <input type="submit" value="Save" class="btn btn-success" id="save-change">
                        <button type="button" class="btn btn-danger" id="cancel-change">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#edit-profile").click(function(){
            $(".form-control").removeAttr("readonly");
            $('#gender').children().each(function(i, opt){
            if(i != 0)
            $(opt).removeAttr("disabled")
            });
            $("#save-change").show();
            $("#cancel-change").show();
            $(this).hide();
        });
        $("#cancel-change").click(function(){
            username.value="<?=$_SESSION['uname'];?>";
            name.value="<?=$customer[0][1];?>";
            email.value="<?=$customer[0][2];?>";
            gender.value="<?=$customer[0][3];?>";
            phone.value="<?=$customer[0][4];?>";
            address.value="<?=$customer[0][5];?>";
            $("input").attr("readonly","readonly");
            $("textarea").attr("readonly","readonly");
            $("select").attr("readonly","readonly");
            $('#gender').children().each(function(i, opt){
            if(i != 0)
            $(opt).attr("disabled","disabled")
            });
            $("#save-change").hide();
            $("#edit-profile").show();
            $(this).hide();
        })
    })
</script>