<?php //var_dump($_SESSION);exit;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="navbar">
        <span>Empower Salon</span>
        <ul class="nav-links">
        <?php
        if(isset($_SESSION['uid'])):
        ?>
            <?php
            if($_SESSION['user_type'] == 'C'):
            ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="customer-booking.php">Book</a></li>
            <li><a href="view_my_appointment.php">View Appointments</a></li>
            <li><a href="customer-profile.php">Profile(<?=  $_SESSION['uname']?>)</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php
            else :
            ?>
            <li><a href="emp_appointments.php">View Appointments</a></li>
            <li><a href="employee-profile.php">Profile(<?=  $_SESSION['uname']?>)</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>	
        <?php
        else :
        ?>
        <li><a href="registration.php">SignUp</a></li>
        <li><a href="login.php">Login</a></li>
        <?php endif; ?>	
        </ul>
    </div>
</body>
</html>