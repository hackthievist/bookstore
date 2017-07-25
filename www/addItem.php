<?php

session_start();
include 'includes/db.php';
include 'includes/functions.php';
include 'style.html';
$id = $_SESSION['customer_id'];

if(isset($_GET['id'])) {
	$bid = $_GET['id'];
}

addCartItem($conn, $id, $bid);
header("Location: view_cart.php");


?>