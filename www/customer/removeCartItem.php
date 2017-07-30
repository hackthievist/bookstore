<?php

session_start();
include '../includes/db.php';
include '../includes/functions.php';
include 'header.php';
$id = $_SESSION['customer_id'];

if(isset($_GET['id'])) {
	$bid = $_GET['id'];
}

removeCartItem($conn, $id, $bid);
header("Location: viewCart.php");


?>