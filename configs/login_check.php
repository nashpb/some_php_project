<?php 
if(!isset($_SESSION['uname']))
{
    $_SESSION['cred_check_fail'] = 'true';
	$_SESSION['login_errors'] = 'Login First';
    header('Location: login.php');
}

?>