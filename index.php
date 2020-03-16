<?php
    include_once('configs/db.php');
    include_once('configs/login_check.php'); //DEVELOPRS!!!!!!!!!!!! UNCOMMENT THIS LINE WHEN DEVELOPING
    include("navbar.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

	<title>Home</title>
<style>
*
{
    font-family: 'Raleway';   
}
.carousel-inner img
{
  width: 100vw;
  height: 500px;
  object-fit: cover;
}
.home-img
{
    width: 300px;
    height: 200px;
    object-fit: cover;
    border-radius: 5px;
}
.home-img2
{
    width: 400px;
    height: 300px;
    object-fit: cover;
    border-radius: 5px;
}
.person-img
{
    width: 100%;
}
.title
{
    font-size: 30px;
    margin: 0px;
    padding: 20px 0px;
    text-transform: uppercase;
    font-weight: bold;
}
.gender-img-container
{
    position: relative;
    cursor: pointer;
}
.gender-title
{
    position: absolute;
    right: 30px;
    top: 50%;
    font-size: 2.5rem;
    font-weight: bold;
    font-family: sans-serif;
}
.title-body
{
    font-size: 30px;
}
</style>
</head>
<body>
	
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/slider/back1.jpg" alt="Los Angeles" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="images/slider/back2.jpg" alt="Chicago" width="1100" height="500">
    </div>
    <div class="carousel-item">
      <img src="images/slider/back3.jpg" alt="New York" width="1100" height="500">
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<div class="container-fluid p-0">
    <p class="text-center title">Our Looks</p>
    <div class="row m-0 p-0">
        <div class="col-md-4 m-0 p-0">
            <img class="person-img" src="images/person/1.jpg" alt="">
        </div>
        <div class="col-md-4 m-0 p-0">
            <img class="person-img" src="images/person/2.jpg" alt="">    
        </div>
        <div class="col-md-4 m-0 p-0">
            <img class="person-img" src="images/person/3.jpg" alt="">    
        </div>
        <div class="col-md-4 m-0 p-0">
            <img class="person-img" src="images/person/4.jpg" alt="">
        </div>
        <div class="col-md-4 m-0 p-0">
            <img class="person-img" src="images/person/5.jpg" alt="">    
        </div>
        <div class="col-md-4 m-0 p-0">
            <img class="person-img" src="images/person/6.jpg" alt="">    
        </div>
    </div>
</div>
<div class="container-fluid p-0">
    <p class="text-center title">Our Service</p>
    <div class="row m-0 p-0">
        <div class="col-md-6 m-0 p-0 gender-img-container">
            <img class="person-img" src="images/person/gents.jpg" alt="">
            <p class="gender-title">GENTS</p>
        </div>
        <div class="col-md-6 m-0 p-0 gender-img-container">
            <img class="person-img" src="images/person/ladies.jpg" alt="">
            <p class="gender-title">LADIES</p>
        </div>
    </div>
</div>
<style>
.man-service-title
{
    font-size: 20px;
    font-weight: bold;
}
.full-image
{
    width: 100%;
    margin-bottom: 20px;
}
.extra-service
{
    width: 600px;
    margin: 10px auto;
    display: flex;
}
.inner-extra-service
{
    flex: 1;
}
</style>
<div class="container-fluid p-5">
    <p class="title text-center">Gents Service</p>
    <img src="images/service-men-1.jpg" class="full-image" alt="">
    <div class="row">
        <div class="col-md-3 man-service-section">
            <p class="man-service-title">Hair Cut & Finish</p>
            <ul>
                <li>Cut and Hair Care</li>
                <li>Shampoo & Conditioning</li>
                <li>Head Massage</li>
                <li>Beard Styling</li>
                <li>Hair/Beard Colouring</li>
            </ul>
        </div>
        <div class="col-md-3 man-service-section">
            <p class="man-service-title">Hair Colour</p>
            <ul>
                <li>Hair Colour</li>
                <li>Hi - Lites</li>
                <li>Beard Colour</li>
            </ul>
        </div>
        <div class="col-md-3 man-service-section">
            <p class="man-service-title">Hair Texture</p>
            <ul>
                <li>Straightening</li>
                <li>Smoothening</li>
                <li>Rebonding</li>
                <li>Perming</li>
            </ul>
        </div>
        <div class="col-md-3 man-service-section">
            <p class="man-service-title">Hair Treatments</p>
            <ul>
                <li>Hair Spa</li>
                <li>Advanced Moisturising</li>
                <li>Scalp Treatments</li>
                <li>Colour Protection</li>
            </ul>
        </div>
    </div>
    <img src="images/serviceGents.jpg" class="full-image" alt="">
    <div class="extra-service">
        <div class="inner-extra-service">
            <p class="man-service-title">Skin Care</p>
            <ul>
                <li>Clean Ups</li>
                <li>Facials</li>
                <li>Organic Treatments</li>
                <li>Manicure</li>
                <li>Pedicure</li>
            </ul>
        </div>
        <div class="inner-extra-service">
            <p class="man-service-title">Beard Grooming</p>
            <ul>
                <li>Beard Trim</li>
                <li>Beard Colour</li>
                <li>Beard Styling</li>
                <li>Shave</li>
                <li>Luxury Shave & Beard Spa</li>
            </ul>
        </div>
    </div>
</div>

<!-- ladies -->
<div class="container-fluid p-5">
    <p class="title text-center">Ladies Service</p>
    <img src="images/ladies-1.png" class="full-image" alt="">
    <div class="row">
        <div class="col-md-3 man-service-section">
            <p class="man-service-title">Hair Styling</p>
            <ul>
                <li>Hair Cut</li>
                <li>Ironing</li>
                <li>Global Colouring</li>
                <li>Blow Dry</li>
                <li>Root Touch Up</li>
                <li>Shampoo & Conditioning</li>
                <li>Head Massage</li>
                <li>Roller Setting</li>
                <li>Oiling</li>
            </ul>
        </div>
        <div class="col-md-3 man-service-section">
            <p class="man-service-title">Make Up</p>
            <ul>
                <li>Party Make Up</li>
                <li>Engagement Make Up</li>
                <li>Bridal & Reception Make Up</li>
                <li>Base Make Up</li>
                <li>Eye Make Up</li>
            </ul>
        </div>
        <div class="col-md-3 man-service-section">
            <p class="man-service-title">Hair Texture</p>
            <ul>
                <li>Rebonding</li>
                <li>Perming</li>
                <li>Keratin</li>
                <li>Colour Protection</li>
                <li>Smoothening</li>
            </ul>
        </div>
        <div class="col-md-3 man-service-section">
            <p class="man-service-title">Hair Treatments</p>
            <ul>
                <li>Spa Treatments</li>
                <li>Volumizing</li>
                <li>Advanced Hair Moisturising</li>
                <li>Scalp Treatments</li>
            </ul>
        </div>
    </div>
    <img src="images/ladies-2.png" class="full-image" alt="">
    <div class="extra-service">
        <div class="inner-extra-service">
            <p class="man-service-title">Facials & Rituals</p>
            <ul>
                <li>Bleach</li>
                <li>Luxury Facials/Rituals</li>
                <li>Clean Ups</li>
                <li>Body Polishing/Rejuvenation</li>
                <li>Threading</li>
            </ul>
        </div>
        <div class="inner-extra-service">
            <p class="man-service-title">Hand & Feet</p>
            <ul>
                <li>Manicure</li>
                <li>Spa Pedicure</li>
                <li>Pedicure</li>
                <li>Waxing</li>
                <li>Spa Manicure</li>
            </ul>
        </div>
    </div>
</div>

<div class="text-section p-5">
    <p class="title-body">
        Explore the Realm of Beauty with Looks Salonp
    </p>
    <p>
        With over 95+ branches nationally and internationally, Looks salon is a premium beauty salon for men and women who desire to look the best every day. Getting a makeover not only changes the appearance of a person but also brings back the lost confidence and Looks Salon would take pride in being a part of it. From beauty to grooming services, we provide a tremendous range of facilities that touches every dimension of beauty and hair treatments. Our repertoire of professional experts makes sure that all your beauty and hair questions are answered, and you leave the salon with a big smile on your face.
    </p>
    <p>
        With over 3000 employees engaged in transforming your look, we make sure that all the services provided at our salons meet the international standards. Through our advice and solutions from the expertise in this array, we aim at giving the best services through our state-of-art facilities. Our professional stylists and beauty experts are constantly updated with the latest trends and fashion advices that help them to work efficiently and deliver outstanding results!
    </p>
    <p>
        Give us an opportunity to serve you once, we are sure you'll love to come back to us again and be our esteemed customer forever. Fill the form or call us to book an appointment now!
    </p>
    <div class="text-center">
        <a href="customer-booking.php" class="btn btn-sm btn-primary">Book Appointment</a>
    </div>
</div>
<style>
.footer
{
    padding: 50px;
    background-color: #9AAB33;
}
.name
{
    font-size: 3rem;
    color: #ffffff;
    text-align: center;
}
</style>
<div class="footer">
    <p class="name">EMPOWER SALON</p>
</div>
</body>
</html>
