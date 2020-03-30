<?php
include_once('configs/db.php');
if(isset($_SESSION['uid']))
{
	header('Location: index.php');
}
if(isset($_POST['login_hit']))
{
	$uname = mysqli_real_escape_string($db_conn,$_POST['username']);
	$password = mysqli_real_escape_string($db_conn,$_POST['password']);
	if ($uname != "" && $password != "")
	{
		$sql_query = "select * from users where user_name='".$uname."' and password='".$password."'";
		$result = mysqli_query($db_conn,$sql_query);
		$row = mysqli_fetch_array($result);

		$count = count($row);

        if($count > 0){
			$_SESSION['uname'] = $row['username'];
			$_SESSION['uid'] = $row['user_info_id'];
			$_SESSION['user_type'] = $row['user_type'];
			$_SESSION['cred_check_fail'] = 'false';
			if($_SESSION['user_type'] == 'C')
			{
				header('Location: index.php');
			}
			if($_SESSION['user_type'] == 'A')
			{
				header('Location: dashboard.php');
			}
        }else{
			$_SESSION['cred_check_fail'] = 'true';
			$_SESSION['login_errors'] = 'Incorrect Username Password';
			header('Location: login.php');
        }
	}
	echo "<pre>";var_dump($uname.$password);exit;
}

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Salon</title>
	<link rel="stylesheet" href="style/style.css">
	<script src="script/script.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body class="back-img">
<?= $flash_div;?>
	<div class="container-fluid display-flex-center login">
		<div class="login-div">
			<p class="form-title">Login</p>
			<form  method="post" action="">
				<div class="input-container">
					<input type="text" class="form-control" placeholder="Username" name="username" required>
					<input type="password" class="form-control" placeholder="Password" name="password" required>
					<?php 
					if(isset($_SESSION['cred_check_fail']) && $_SESSION['cred_check_fail'] == 'true')
					{
						echo '<p style="color:red;">'.$_SESSION['login_errors'].'</p>';
					}
					?>
				</div>
				<input type="submit" value="SUBMIT" class="form-submit" name="login_hit">
			</form>
		</div>
	</div>
</body>
</html>
<?php
unset($_SESSION['cred_check_fail']);
?>