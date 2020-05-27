<?php
    include('dashboard_header.php');
    include_once('configs/db.php');
	include_once('configs/login_check.php');
    $payments = [];
	$sql_query = 'SELECT * FROM `customer_payment`';
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$payments = mysqli_fetch_all($result);
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <p class="text-center font-weight-bold m-4">Payment History</p>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Appointment ID</th>
                    <th>Customer Name</th>
                    <th>Date | Time</th>
                    <th>Card Number</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($payments as $key=>$payment)
                    {
                        $sql_query = 'SELECT * FROM `appointments` WHERE id='.$payment[1];
                        $app = '';
                        $cust = '';
                        $result = mysqli_query($db_conn,$sql_query);
                    	if($result)
	                    {
		                    $app = mysqli_fetch_all($result);
                        }
                        $sql_query = "SELECT * from `customers` WHERE id=".$app[0][1];
                        $result = mysqli_query($db_conn,$sql_query);
                    	if($result)
	                    {
		                    $cust = mysqli_fetch_all($result);
                        }
                        echo 
                            '<tr>
                                <td>'.($key+1).'</td>
                                <td>APP-'.$app[0][0].'</td>
                                <td>'.$cust[0][1].'</td>
                                <td>'.$payment[4].'</td>
                                <td>'.$payment[2].'</td>
                                <td>'.$payment[3].'</td>
                            </tr>';
                    }
                ?>
                <!-- <tr>
                    <td>SBI0012343283</td>
                    <td>APP-1</td>
                    <td>Rahul</td>
                    <td>14/03/2020</td>
                    <td>4716 1089 9971 6531</td>
                    <td><span class="font-weight-bold">&#8377;</span> 150</td>
                </tr> -->
            </tbody>
        </table>   
    </div>
</body>
</html>