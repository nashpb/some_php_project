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
$service_gender = mysqli_real_escape_string($db_conn,$_POST['ser_gender']);

$sql_query = "INSERT INTO services (name, description, price, gender) VALUES ('".$service_name."', '".$service_description."', '".$service_price."', '".$service_gender."')";
$_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not add service ".$service_name.'.';
if(mysqli_query($db_conn,$sql_query))
{
    $_SESSION['flash'] = 'Success!!! Added service '.$service_name.'.';
}
else
{
    $error_msg = mysqli_error($db_conn);
    if (strpos($error_msg, 'Duplicate entry') !== false) {
        $_SESSION['flash']  = "ERROR!!! Something Went wrong! Service exists. Please try another one.";
    }
}

header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_service.php');

exit;




?>