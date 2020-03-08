<?php
include_once('../../configs/db.php');
include_once('../../configs/login_check.php');

if(empty($_POST))
{
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! PARAMETERS MISSING!";
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/manage_service.php');
    exit;
}
$service_id = $_REQUEST['id'];
$sql_query = "select * from services where id=".$service_id;
$result = mysqli_query($db_conn,$sql_query);
if($result)
{
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}





?>