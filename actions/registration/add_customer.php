<?php
include_once('../../configs/db.php');


if(empty($_POST))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/registration.php');
    exit;
}

$cust_name =  mysqli_real_escape_string($db_conn,$_POST['Name']);
$cust_username =  mysqli_real_escape_string($db_conn,$_POST['Username']);
$cust_password =  mysqli_real_escape_string($db_conn,$_POST['Password']);
$cust_address =  mysqli_real_escape_string($db_conn,$_POST['Address']);
$cust_phone =  mysqli_real_escape_string($db_conn,$_POST['Phone']);
$cust_email =  mysqli_real_escape_string($db_conn,$_POST['Email']);
$cust_gender =  mysqli_real_escape_string($db_conn,$_POST['Gender']);

$sql_query = "INSERT INTO `customers`(`name`, `email`, `gender`, `phone_no`, `address`) VALUES ('".$cust_name."','".$cust_email."','".$cust_gender."','".$cust_phone."','".$cust_address."')";
$_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not add you.";

if(mysqli_query($db_conn,$sql_query))
{
    $cust_info_id = mysqli_insert_id($db_conn);
    $sql_query = "INSERT INTO `users`(`user_name`, `password`, `user_type`, `user_info_id`) VALUES ('".$cust_username."','".$cust_password."','C',".$cust_info_id.")";
    if(mysqli_query($db_conn,$sql_query))
    {
        $_SESSION['flash'] = 'Success!!! Registration successful for '.$cust_username.'.';
    }
    else
    {
        $error_msg = mysqli_error($db_conn);
        if (strpos($error_msg, 'user_name_UNIQUE') !== false) 
        {
            $_SESSION['flash']  = "ERROR!!! Something Went wrong! Username exists. Please try another one.";
        }
        $sql_query = "DELETE FROM `customers` WHERE id = ".$cust_info_id;
        mysqli_query($db_conn,$sql_query);
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/registration.php');
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

    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/registration.php');
    exit;
}

header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/login.php');

exit;


?>