<?php
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

if(empty($_REQUEST['id']))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_employee.php');
    exit;
}

$employee_id = $_REQUEST['id'];

$sql_query = "DELETE FROM users WHERE user_info_id=".$employee_id." AND `user_type`='E'";
$_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not delete employee";
if(mysqli_query($db_conn,$sql_query))
{
    $sql_query = "DELETE FROM employees WHERE id=".$employee_id;
    if(mysqli_query($db_conn,$sql_query))
    {
        $sql_query = "DELETE FROM appointments WHERE cust_id=".$employee_id;
        if(mysqli_query($db_conn,$sql_query))
        {
            $sql_query = "UPDATE `appointments` SET `emp_id`= NULL,`appointment_status`='0' WHERE `emp_id` = ".$employee_id." AND `appointment_status` = '1'";
            if(mysqli_query($db_conn,$sql_query))
            $_SESSION['flash'] = 'Success!!! Employee deleted';
        }
    }
    
}

header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_employee.php');

exit;

?>