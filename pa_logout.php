<?php
session_start();

$_SESSION['pa_id'] = "";
$_SESSION['pa_name'] = "";
$_SESSION['pa_pass'] = "";
$_SESSION['email'] = "";
header('location: login-user.php');
?>