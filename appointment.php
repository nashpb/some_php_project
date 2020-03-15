<?php
    include_once('configs/db.php');
    include_once('configs/login_check.php'); //DEVELOPRS!!!!!!!!!!!! UNCOMMENT THIS LINE WHEN DEVELOPING
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
    <p class="text-center font-weight-bold m-4">Manage Appointment</p>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>D&T</th>
                    <th>Service for</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>emp001</td>
                    <td>Sumit</td>
                    <td>9876543210</td>
                    <td>E-cityks;askx
                        dxksaokdxpd
                        dknsalkdnlkansdklxn
                        skdnlksndxlka
                        lkandxljasnxlj
                        dnalksndx
                    </td>
                    <td>10-02-2020 | 12:00PM</td>
                    <td>Hair Cut</td>
                    <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success">Approve</button>
                          <button type="button" class="btn btn-danger">Cancel</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>emp002</td>
                    <td>Kritti</td>
                    <td>9876543232</td>
                    <td>Konapanna Agrahara</td>
                    <td>10-02-2020 | 1:00PM</td>
                    <td>Hair Cut</td>
                    <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success">Approve</button>
                          <button type="button" class="btn btn-danger">Cancel</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="text-center font-weight-bold m-4">Approved Appointment</p>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>D&T</th>
                    <th>Service for</th>
                    <th>Type</th>
                    <th>Assigned Person</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>emp001</td>
                    <td>Sumit</td>
                    <td>9876543210</td>
                    <td>E-city</td>
                    <td>10-02-2020 | 12:00PM</td>
                    <td>Hair Cut</td>
                    <th>On House</th>
                    <td>Biplab</td>
                    <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success">Approved</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p class="text-center font-weight-bold m-4">Successful Appointment</p>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>D&T</th>
                    <th>Service for</th>
                    <th>Type</th>
                    <th>Assigned Person</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>emp002</td>
                    <td>Kritti</td>
                    <td>9876543232</td>
                    <td>Konapanna Agrahara</td>
                    <td>09-02-2020 | 1:00PM</td>
                    <td>Hair Cut</td>
                    <th>On House</th>
                    <td>Biplab</td>
                    <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-primary">Successful</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <style>
    .table{
        table-layout:fixed;
    }
    </style>
</body>
</html>