<?php
if(!isset($_SESSION['uname']))
{
    $_SESSION['cred_check_fail'] = 'true';
    $_SESSION['login_errors'] = 'Login First';
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.explode("/",$_SERVER['PHP_SELF'],4)[1].'/login.php');
    exit;
}

?>