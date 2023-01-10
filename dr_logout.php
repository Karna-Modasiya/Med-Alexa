<?php
session_start();
$_SESSION['dr_id'] = "";
$_SESSION['dr_name'] = "";
$_SESSION['dr_pass'] = "";
$_SESSION['email'] = "";
header('location: login-user.php');
?>