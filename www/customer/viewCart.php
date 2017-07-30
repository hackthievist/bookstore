<?php
session_start();
$page_title = "View Cart";
include '../includes/db.php';
include '../includes/functions.php';
include 'header.php';
$id = $_SESSION['customer_id'];

?>

		<table class="mytable" id="tab">

			<?php
			viewCart($conn, $id);

			?>