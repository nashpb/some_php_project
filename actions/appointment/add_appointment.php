<?php
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

if(empty($_POST))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/customer-booking.php');
    exit;
}

$services = $_POST['services'];
$service_type =  mysqli_real_escape_string($db_conn,$_POST['service_type']);
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];

$sql_query_1 = "INSERT INTO appointments (`cust_id`, `appointment_date`, `appointment_time`,`appointment_service_type`, `appointment_status`) VALUES (".$_SESSION['uid'].", '".$appointment_date."', '".$appointment_time."','".$service_type."','0')";
$_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not make an appointment.";
if(mysqli_query($db_conn,$sql_query_1))
{
    $app_id = mysqli_insert_id($db_conn);
    $sql_query_2 = '';
    foreach($services as $key=>$service)
    {
        $sql_query_2.="INSERT INTO appointment_services_junc(`appointment_id`, `service_id`) VALUES ($app_id,$service);";
    }
    if(mysqli_multi_query($db_conn,$sql_query_2))
    {
        $_SESSION['flash'] = 'Success!!! Appointment Booked.';
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/view_my_appointment.php');
        exit;
    }
}
header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/customer-booking.php');
exit;




?>