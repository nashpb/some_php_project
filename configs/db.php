<?php
session_start();
$db_conn = new mysqli("localhost", "root", "", "tc_salon");
if ($db_conn->connect_error) {
    die("ERROR: Unable to connect: " . $db_conn->connect_error);
  } 
?>