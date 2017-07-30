<?php

session_start();
include '../includes/db.php';
include '../includes/functions.php';
include 'header.php';
$id = $_SESSION['customer_id'];

if(isset($_GET['id'])) {
	$cid = $_GET['id'];
}

checkout($conn, $cid);
header("Location: viewCart.php");


?>