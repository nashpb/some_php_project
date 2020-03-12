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
		$sql_query = "select * from admin where username='".$uname."' and password='".$password."'";
		$result = mysqli_query($db_conn,$sql_query);
		$row = mysqli_fetch_array($result);

		$count = count($row);

        if($count > 0){
			$_SESSION['uname'] = $row['username'];
			$_SESSION['uid'] = $row['id'];
			$_SESSION['cred_check_fail'] = 'false';
            header('Location: index.php');
        }else{
			$_SESSION['cred_check_fail'] = 'true';
			$_SESSION['login_errors'] = 'Incorrect Username Password';
			header('Location: login.php');
        }
	}
	echo "<pre>";var_dump($uname.$password);exit;
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