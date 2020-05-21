<?php
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

if(empty($_POST))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_employee.php');
    exit;
}
$emp_id = $_REQUEST['id'];
$sql_query = "select * from employees where id=".$emp_id;
$result = mysqli_query($db_conn,$sql_query);
if($result)
{
    $row = mysqli_fetch_array($result);
    $sql_query = "select * from users where user_info_id=".$emp_id;
    $result = mysqli_query($db_conn,$sql_query);
    if($result)
    {
        $row1 = mysqli_fetch_array($result);
        array_push($row,$row1[1],$row1[2]);
        echo json_encode($row);
    }
}





?>