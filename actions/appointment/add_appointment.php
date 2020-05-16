<?php
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

if(empty($_POST))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/customer-booking.php');
    exit;
}
$payment = $_POST;
$_POST = $_SESSION['booked_appointment'];

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
        // $sql_query_3 = 'INSERT INTO `customer_payment`(`app_id`, `card_number`, `amount`) VALUES ({$app_id},{$payment["card_number"]},{(float)$payment["total"]})';
        $sql_query_3 = 'INSERT INTO `customer_payment`(`app_id`, `card_number`, `amount`) VALUES ('.$app_id.',"'.$payment["card_number"].'", '.$payment["total"].')';
        if(mysqli_query($db_conn,$sql_query_3))
        {
            $_SESSION['flash'] = 'Success!!! Appointment Booked.';
            header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/view_my_appointment.php');
            exit;
        }
        else{
            del_appointment($db_conn,$app_id,true);
        }
    }
    else
    {
        del_appointment($db_conn,$app_id,false);   
    }
}
header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/customer-booking.php');
exit;

function del_appointment($db_conn,$app_id,$services=false)
{
    $sql_query_1 = "DELETE FROM `appointments` WHERE id=".$app_id;
    mysqli_query($db_conn,$sql_query_1);
    if($services)
    {
        $sql_query_2 = "DELETE FROM `appointment_services_junc` WHERE appointment_id=".$app_id;
        mysqli_query($db_conn,$sql_query_2);
    }
}



?>