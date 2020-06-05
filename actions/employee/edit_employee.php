<?php
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

if(empty($_POST))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_employee.php');
    exit;
}

$emp_id = mysqli_real_escape_string($db_conn,$_POST['empl_id']);
$emp_name = mysqli_real_escape_string($db_conn,$_POST['empl_name']);
$emp_mobile = mysqli_real_escape_string($db_conn,$_POST['empl_mobile']);
$emp_email = mysqli_real_escape_string($db_conn,$_POST['empl_email']);
$emp_user = mysqli_real_escape_string($db_conn,$_POST['empl_user']);
$emp_password = mysqli_real_escape_string($db_conn,$_POST['empl_password']);


$sql_query = "UPDATE employees set name='".$emp_name."', phone_no='".$emp_mobile."', email='".$emp_email."' WHERE id=".$emp_id;

$_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not edit service ".$emp_name.'.';
if(mysqli_query($db_conn,$sql_query))
{
    $sql_query = "UPDATE users set user_name='".$emp_user."', password='".$emp_password."' WHERE user_info_id=".$emp_id." AND user_type='E'";   
    if(mysqli_query($db_conn,$sql_query))
    {
        $_SESSION['flash'] = 'Success!!! Edited employee '.$emp_name.'.';
    }
    else
    {
        $error_msg = mysqli_error($db_conn);
        if (strpos($error_msg, 'Duplicate entry') !== false) 
        {
            $_SESSION['flash']  = "ERROR!!! Something Went wrong! Username exists. Please try another one. Every Other Changed detail Updated";
        }
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_employee.php');
        exit;
    }
}

header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_employee.php');

exit;




?>