<?php
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

if(empty($_REQUEST))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_appointment.php');
    exit;
}

$appointment_id = $_REQUEST['app_id'];
$emp_id = (int)$_REQUEST['employees'][0];

$sql_query = "UPDATE `appointments` SET `emp_id`='$emp_id.',`appointment_status`='1' WHERE id = ".$appointment_id;
$_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not Approve appointment";
if(mysqli_query($db_conn,$sql_query))
{
    $_SESSION['flash'] = 'Success!!! Appointment Approved';
}


header('Location:'.$_SERVER["HTTP_REFERER"]);

exit;

?>