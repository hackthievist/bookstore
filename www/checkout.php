<?php

session_start();
include 'includes/db.php';
include 'includes/functions.php';
include 'style.html';
$id = $_SESSION['customer_id'];

if(isset($_GET['id'])) {
	$cid = $_GET['id'];
}

checkout($conn, $cid);
header("Location: view_cart.php");


?>