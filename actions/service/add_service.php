<?php
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

if(empty($_POST))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_service.php');
    exit;
}

$service_name = mysqli_real_escape_string($db_conn,$_POST['ser_name']);
$service_description = mysqli_real_escape_string($db_conn,$_POST['ser_desc']);
$service_price = mysqli_real_escape_string($db_conn,$_POST['ser_price']);

$sql_query = "INSERT INTO services (name, description, price) VALUES ('".$service_name."', '".$service_description."', '".$service_price."')";
$_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not add service ".$service_name.'.';
if(mysqli_query($db_conn,$sql_query))
{
    $_SESSION['flash'] = 'Success!!! Added service '.$service_name.'.';
}

header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_service.php');

exit;




?>