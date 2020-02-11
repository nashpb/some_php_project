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
<div class="container-fluid">
    <div class="row mt-3 mb-3">
        <div class="col-md-4 offset-md-4">
            <p class="text-center font-weight-bold">ADD EMPLOYEE</p>
            <form action="" class="form-group">
                <input type="text" class="form-control" placeholder="employee ID">
                <input type="text" class="form-control" placeholder="Name">
                <input type="date" class="form-control" placeholder="DOB">
                <input type="number" class="form-control" placeholder="Mobile">
                <input type="text" class="form-control" placeholder="Post">
                <input type="submit" value="Add Employee" class="btn btn-sm btn-primary float-right">
            </form>
        </div>
    </div>
</div>
<hr>
    <p class="text-center font-weight-bold m-4">Manage Employee</p>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <td>Emp ID</td>
                    <td>Name</td>
                    <td>DOB</td>
                    <td>Mobile</td>
                    <td>Post</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>emp001</td>
                    <td>Sumit</td>
                    <td>10-01-1997</td>
                    <td>9876543210</td>
                    <td>Hair Cutting</td>
                </tr>
                <tr>
                    <td>emp002</td>
                    <td>Kritti</td>
                    <td>10-01-1996</td>
                    <td>9876543232</td>
                    <td>Nail Polishing</td>
                </tr>
            </tbody>
        </table>   
    </div>
</body>
</html>