<?php
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

if(empty($_POST))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/customer-profile.php');
    exit;
}

$cust_id = mysqli_real_escape_string($db_conn,$_POST['id']);
$cust_user = mysqli_real_escape_string($db_conn,$_POST['username']);
$cust_name = mysqli_real_escape_string($db_conn,$_POST['name']);
$cust_mobile = mysqli_real_escape_string($db_conn,$_POST['phone']);
$cust_email = mysqli_real_escape_string($db_conn,$_POST['email']);
$cust_gender = mysqli_real_escape_string($db_conn,$_POST['gender']);
$cust_address = mysqli_real_escape_string($db_conn,$_POST['address']);


$sql_query = "UPDATE customers set name='".$cust_name."', phone_no='".$cust_mobile."', email='".$cust_email."', gender='".$cust_gender."', address='".$cust_address."' WHERE id=".$cust_id;

$_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not edit profile";
if(mysqli_query($db_conn,$sql_query))
{
    $sql_query = "UPDATE users set user_name='".$cust_user."' WHERE id=".$_SESSION['id']." AND user_type='C'";   
    if(mysqli_query($db_conn,$sql_query))
    {
        $_SESSION['flash'] = 'Success!!! Updated Profile';
        $_SESSION['uname'] = $cust_user;
    }
    else
    {
        $error_msg = mysqli_error($db_conn);
        if (strpos($error_msg, 'Duplicate entry') !== false) 
        {
            $_SESSION['flash']  = "ERROR!!! Something Went wrong! Username exists. Please try another one. Every Other Changed detail Updated";
        }
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/customer-profile.php');
        exit;
    }
}

header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/customer-profile.php');

exit;




?>