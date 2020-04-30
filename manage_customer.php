<?php
    include_once('configs/db.php');
    include_once('configs/login_check.php'); //DEVELOPRS!!!!!!!!!!!! UNCOMMENT THIS LINE WHEN DEVELOPING
    include('dashboard_header.php');

    //FLASH MESSAGE SECTION
    $flash_message['status'] = "";
	$flash_message['message'] = "";
	$flash_div = "";
	if(isset($_SESSION['flash']))
	{
		$explode_flash = explode("!!!",$_SESSION['flash']);
		$flash_message['status'] = $explode_flash[0];
		$flash_message['message'] = $explode_flash[1];
		if(!strcasecmp($flash_message['status'],'ERROR'))
		{
			$flash_div = '<div class="alert alert-danger alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$flash_message['message'].'</div>';
		}
		else if(!strcasecmp($flash_message['status'],'Success'))
		{
			$flash_div = '<div class="alert alert-success alert-dismissible" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$flash_message['message'].'</div>';
		}
		unset($_SESSION['flash']);
    }

    //LOAD Customers
    $customers = [];
	$sql_query = 'SELECT * FROM `customers`';
	$result = mysqli_query($db_conn,$sql_query);
	if($result)
	{
		$customers = mysqli_fetch_all($result);
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
<?= $flash_div ?>
    <p class="text-center font-weight-bold m-4">Manage Customer</p>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(empty($customers)):?>
							<tr align="center">
							<td colspan="9"> NO REGISTERED CUSTOMERS </td>
							</tr>
			    <?php else:?>
                <?php 
                    foreach($customers as $key=>$customer)
                    {
                        echo '<tr>
                                    <td>'.($key+1).'</td>
                                    <td>'.$customer[1].'</td>
                                    <td>'.$customer[2].'</td>
                                    <td>'.$customer[3].'</td>
                                    <td>'.$customer[4].'</td>
                                    <td>'.$customer[5].'</td>
                                    <td>
                                    <i class="material-icons" onclick=del_customer_alert('.$customer[0].')>delete</i>
                                    </td>
                             </tr>';

                    }
                ?>
                <?php endif; ?>	
                <!-- <tr>
                    <td>emp002</td>
                    <td>Kritti</td>
                    <td>10-01-1996</td>
                    <td>9876543232</td>
                    <td>Konapanna Agrahara</td>
                    <td>
                        <i class="material-icons">delete</i>
                    </td>
                </tr> -->
            </tbody>
        </table>   
    </div>
    <script>
    function del_customer_alert(id)
	{
		var choice = confirm("Are you sure you want to delete this customer? It will delete their existing and on-going appointments!!");
		if(choice)
		{
			location.href="actions/registration/del_customer.php?id="+id;
		}
	}
    </script>
</body>
</html>