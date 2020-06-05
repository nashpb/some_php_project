<?php
include_once('../../configs/db.php');
try{
$data = json_decode(file_get_contents('php://input'), true);
if(! is_array($data)) 
{
    echo "!error!";exit;
}

$cust_user = mysqli_real_escape_string($db_conn,$data['username']);
$cust_mobile = mysqli_real_escape_string($db_conn,$data['phone']);
$cust_email = mysqli_real_escape_string($db_conn,$data['email']);

$sql_query = "select * from customers where email='".$cust_email."'";
$result = mysqli_query($db_conn,$sql_query);
if($result)
{
    $row = mysqli_fetch_all($result);
    $actual_mobile = $row[0][4];
    if($actual_mobile == $cust_mobile)
    {
        $uid = $row[0][0];
        $sql_query = "select user_name from users where user_info_id=".$uid." AND user_type='C'";
        $result = mysqli_query($db_conn,$sql_query);
        if($result)
        {
            $row = mysqli_fetch_all($result);
            $actual_username = $row[0][0];
            if($actual_username == $cust_user)
            {
                $part_email = substr($cust_email, 0, 4); 
                $part_phone = substr($cust_mobile, -4);
                $sql_query = "UPDATE users set password='".$part_email.$part_phone."' WHERE user_name='".$cust_user."' AND user_type='C'";   
                $result = mysqli_query($db_conn,$sql_query);
                if($result)
                {
                    echo "!success!";exit;
                }
                else
                {
                    echo "!error!";exit;
                }
            }
            else
            {
                echo "!mismatch!";exit;
            }
            $row = mysqli_fetch_all($result);
            // echo ;exit;
        }   
        else
        {
            echo "!error!";exit;
        }
    }
    else
    {
        echo "!mismatch!";exit;
    }
}
else
{
    echo "!no-user-found!";exit;
}
}
catch(Exception $e)
{
    echo "!error!";exit;
}

?>