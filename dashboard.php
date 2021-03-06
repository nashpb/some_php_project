<?php
include_once('configs/db.php');
include_once('configs/login_check.php'); //DEVELOPRS!!!!!!!!!!!! UNCOMMENT THIS LINE WHEN DEVELOPING
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/bootstrap.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/style.css">
</head>
<style>
.all-dash-item
{
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-gap: 10px;
    padding: 10px;
}
.all-dash-item a
{
    text-decoration: none;
    color: #000;
}
.dashoard-service
{
    /*border: 1px solid #2f2f2f;*/
    background-color: #f2f2f2;
    padding: 10px;
    border-radius: 5px;
    transition: .5s;
}
.dashoard-service:hover
{
    background-color: #ddd;
    transition: .5s;
}
.dashoard-service p
{
    margin: 0px;
}
</style>
<body>
    <div class="navbar">
        <span>Empower Salon</span>
        <ul class="nav-links">
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="ccontainer-fluid all-dash-item">
        <a href="manage_employee.php">
            <div class="dashoard-service">
                <p class="font-weight-bold">Manage Employees</p>
            </div>
        </a>
        <a href="manage_customer.php">
            <div class="dashoard-service">
                <p class="font-weight-bold">Manage Customers</p>
            </div>
        </a>
        <a href="manage_appointment.php">
            <div class="dashoard-service">
                <p class="font-weight-bold">Manage Appoinments</p>
            </div>
        </a>
        <a href="manage_service.php">
            <div class="dashoard-service">
                <p class="font-weight-bold">Manage Services</p>
            </div>
        </a>
        <a href="manage_payment.php">
            <div class="dashoard-service">
                <p class="font-weight-bold">Manage Payments</p>
            </div>
        </a>
        
    </div>
</body>
</html>