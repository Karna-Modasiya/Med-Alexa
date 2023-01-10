<?php
session_start();

$_SESSION['op_id'] = "";
$_SESSION['op_name'] = "";
$_SESSION['op_pass'] = "";
$_SESSION['email'] = "";
header('location: login-user.php');
?>