<?php

session_start();
unset($_SESSION['uname']);
header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/login.php');

?>