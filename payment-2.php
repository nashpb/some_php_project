<?php
	include_once('configs/db.php');
	include_once('configs/login_check.php'); //DEVELOPRS!!!!!!!!!!!! UNCOMMENT THIS LINE WHEN DEVELOPING
    $_SESSION['booked_appointment'] = $_POST;
    $_SESSION['flash']  = "ERROR!!! Something Went wrong! Could not complete payment. Booking failed";
    $total = 0.00;
    // var_dump($_POST);
    foreach($_POST['services'] as $key => $service)
    {
        // var_dump($service);
        $total += (double)explode('|', $service)[1];
        $_SESSION['booked_appointment']['services'][$key] = (int)explode('|', $service)[0];

    }
    // var_dump($total);
    // var_dump($_SESSION['booked_appointment']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="style/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/demo.css">
</head>

<body>
    <div class="container-fluid">
       
        <div class="creditCardForm">
            <div class="heading">
                <h1>Confirm Purchase</h1>
            </div>
            <div class="payment">
                <form action="actions/appointment/add_appointment.php" method="POST">
                    <div class="form-group owner">
                        <label for="owner">Owner</label>
                        <input name="owner" type="text" class="form-control" id="owner">
                    </div>
                    <div class="form-group CVV">
                        <label for="cvv">CVV</label>
                        <input name="cvv" type="text" class="form-control" id="cvv">
                    </div>
                    <div class="form-group total">
                        <input type="hidden" name="total" class="form-control" id="total" value=<?= $total ?>>
                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Card Number</label>
                        <input name="card_number" type="text" class="form-control" id="cardNumber">
                    </div>
                    <div class="form-group" id="expiration-date">
                        <label>Expiration Date</label>
                        <select name="exp_month">
                            <option value="01">January</option>
                            <option value="02">February </option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select name="exp_year"> 
                            <option value="20"> 2020</option>
                            <option value="21"> 2021</option>
                            <option value="16"> 2022</option>
                            <option value="17"> 2023</option>
                            <option value="18"> 2024</option>
                            <option value="19"> 2025</option>
                            <option value="21"> 2026</option>
                            <option value="16"> 2027</option>
                            <option value="17"> 2028</option>
                            <option value="18"> 2029</option>
                            <option value="19"> 2030</option>
                        </select>
                    </div>
                    <div class="form-group" id="credit_cards">
                        <img src="assets/images/visa.jpg" id="visa">
                        <img src="assets/images/mastercard.jpg" id="mastercard">
                        <img src="assets/images/amex.jpg" id="amex">
                    </div>
                    <div class="form-group" id="pay-now">
                        <button type="submit" class="btn btn-default" id="confirm-purchase">Confirm (₹<?= $total ?>)</button>
                    </div>
                </form>
            </div>
        </div>


     
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.payform.min.js" charset="utf-8"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
