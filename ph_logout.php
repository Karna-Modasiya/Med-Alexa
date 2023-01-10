<?php
session_start();

$_SESSION['ph_id'] = "";
$_SESSION['ph_name'] = "";
$_SESSION['ph_pass'] = "";
$_SESSION['email'] = "";
header('location: login-user.php');
?>