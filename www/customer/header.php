<?php

$id = $_SESSION['customer_id'];	

?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../styles/styles.css"/>	
	<title>
		<?php echo $page_title ?>
	</title>

	<style>

		* {
			margin: 0;
			padding: 0;
			font-family: Oxygen;
		}

		.nav {
			width: 100%;
			height: 90px;
			background-color: #2980b9;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.18);
			position: fixed;
			top: 0;
			z-index: 999;
		}

		#logo {
			font-family: Abel;
		}

		.links a {
			margin-left: 40px;
			text-decoration: none;
			font-family: "";
			color: MidnightBlue;
		}

		.mytable {
			float: left;
			position: absolute;
			top: 120px;
			width: 100%;
			text-align: center;
		}

		.mytable tr:nth-child(even) {
			background-color: #f1f1f1;
		}

		.mytable th {
			font-family: "Bitter";
			font-size: 25px;
		}

		.links a:hover {
			color: #fff;
		}

		.wide {
			background-color: blue;
		}

		.content {
			width: 100%;
			height: 500px;
			background-image: url("../icons & images/b.jpg");
			background-size: contain;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.18);
		}

		img {
			margin-top: 25px;
			width: 300px;
			height: 300;
		}

		p {
			font-size: 15px;
			margin-bottom: 2px;
		}

		.title {
			color: RoyalBlue;
		}

		button {
			border: 1px solid;
			border-radius: 5px;
			padding: 5px;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.18);
		}

		button:hover {
			color: white;
			background-color: Tomato;
		}

		.category-button {
			width: 100px;
			margin-left: 30px;
			margin-top: 30px;
			border-radius: 3px;
			border: 1px transparent;
			padding: 10px;
		}

	</style>

	</head>

	<div class="nav">
		<div class="container">
			<a style="color:MidnightBlue" href="home.php"><h2 id="logo">hackthievate.</h2></a>
			<div class="links navbar-right">
				<a href="">View Categories</a>
				<a href="viewCart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a>
				<a href="../logout.php">Logout</a>
				<a><?php fetchName($conn, $id); ?></a>
				
			</div>
		</div>

	</div>
