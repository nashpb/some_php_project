<?php
    include('dashboard_header.php');
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
                    <th>Transection ID</th>
                    <th>Cust.ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>SBI0012343283</td>
                    <td>001</td>
                    <td>Rahul</td>
                    <td>14/03/2020</td>
                    <td><span class="font-weight-bold">&#8377;</span> 150</td>
                    <td><button class="btn btn-sm btn-danger">Failed</button></td>
                </tr>
                <tr>
                    <td>SBI0012343284</td>
                    <td>001</td>
                    <td>Rahul</td>
                    <td>14/03/2020</td>
                    <td><span class="font-weight-bold">&#8377;</span> 150</td>
                    <td><button class="btn btn-sm btn-success">Successful</button></td>
                </tr>
            </tbody>
        </table>   
    </div>
</body>
</html>