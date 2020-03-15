<?php
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

if(empty($_REQUEST['id']))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/view_my_appointment.php');
    exit;
}

$appointment_id = $_REQUEST['id'];

$sql_query = "UPDATE `appointments` SET `appointment_status`='3' WHERE id = ".$appointment_id;
$_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not delete service";
if(mysqli_query($db_conn,$sql_query))
{
    $_SESSION['flash'] = 'Success!!! Service deleted';
}

header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/view_my_appointment.php');

exit;

?>