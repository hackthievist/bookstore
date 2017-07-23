<?php
session_start();
include 'includes/db.php';
include 'includes/functions.php';
include 'style.html';
$id = $_SESSION['customer_id'];

?>


<div class="wrapper">
	<div id="stream">
		<table id="tab">

			<?php
			viewCart($conn, $id);

			?>