<?php

session_start();
include '../includes/db.php';
include '../includes/functions.php';
$id = $_SESSION['customer_id'];

if(isset($_GET['id'])) {
	$book_id = $_GET['id'];
}

addToCart($conn, $id, $book_id);
header("Location: home.php");


?>