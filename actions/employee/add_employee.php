<?php
include_once('../../configs/db.php');


if(empty($_POST))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_employee.php');
    exit;
}

$emp_name =  mysqli_real_escape_string($db_conn,$_POST['Name']);
$emp_username =  mysqli_real_escape_string($db_conn,$_POST['Username']);
$emp_password =  mysqli_real_escape_string($db_conn,$_POST['Password']);
$emp_phone =  mysqli_real_escape_string($db_conn,$_POST['Phone']);
$emp_email =  mysqli_real_escape_string($db_conn,$_POST['Email']);


$sql_query = "INSERT INTO `employees`(`name`, `email`,`phone_no`) VALUES ('".$emp_name."','".$emp_email."','".$emp_phone."')";
$_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not add employee.";

if(mysqli_query($db_conn,$sql_query))
{
    $emp_info_id = mysqli_insert_id($db_conn);
    $sql_query = "INSERT INTO `users`(`user_name`, `password`, `user_type`, `user_info_id`) VALUES ('".$emp_username."','".$emp_password."','E',".$emp_info_id.")";
    if(mysqli_query($db_conn,$sql_query))
    {
        $_SESSION['flash'] = 'Success!!! Added employee with username '.$emp_username.'.';
    }
    else
    {
        $error_msg = mysqli_error($db_conn);
        if (strpos($error_msg, 'user_name_UNIQUE') !== false) 
        {
            $_SESSION['flash']  = "ERROR!!! Something Went wrong! Username exists. Please try another one.";
        }
        $sql_query = "DELETE FROM `employees` WHERE id = ".$emp_info_id;
        mysqli_query($db_conn,$sql_query);
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_employee.php');
        exit;
    }
}
else
{
    $error_msg = mysqli_error($db_conn);
    if (strpos($error_msg, 'email_UNIQUE') !== false) {
        $_SESSION['flash']  = "ERROR!!! Something Went wrong! Email exists. Please try another one.";
    }
    if (strpos($error_msg, 'phone_no_UNIQUE') !== false) {
        $_SESSION['flash']  = "ERROR!!! Something Went wrong! Mobile number exists. Please try another one.";
    }

    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_employee.php');
    exit;
}

header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_employee.php');

exit;


?>