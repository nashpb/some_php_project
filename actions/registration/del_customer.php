<?php
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

if(empty($_REQUEST['id']))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_customer.php');
    exit;
}

$customer_id = $_REQUEST['id'];

$sql_query = "DELETE FROM users WHERE user_info_id=".$customer_id." AND `user_type`='C'";
$_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not delete customer";
if(mysqli_query($db_conn,$sql_query))
{
    $sql_query = "DELETE FROM customers WHERE id=".$customer_id;
    if(mysqli_query($db_conn,$sql_query))
    {
        $sql_query = "DELETE FROM appointments WHERE cust_id=".$customer_id;
        if(mysqli_query($db_conn,$sql_query))
        $_SESSION['flash'] = 'Success!!! Customer deleted';
    }
    
}

header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_customer.php');

exit;

?>