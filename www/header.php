<!DOCTYPE html>
<html>
<head>
	<title>Pageinator</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<style>

		* {
			margin: 0;
			padding: 0;
			font-family: Titillium Web;
		}

		.nav {
			width: 100%;
			height: 90px;
			background-color: CadetBlue;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.18);
			position: fixed;
			z-index: 999;
		}

		#logo {
			font-family: Abel;
		}

		.links a {
			margin-left: 40px;
			text-decoration: none;
			font-family: Raleway;
			color: MidnightBlue;
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
			background-image: url("b.jpg");
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

	</style>

</head>
<body>

	<div class="nav">
		<div class="container">
			<h2 id="logo">hackthievate.</h2>
			<div class="links navbar-right">
				<a href="">View Categories</a>
				<a href=""><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a>
			</div>
		</div>

	</div>

	<div class="content">

	</div>

	<?php
	include 'includes/db.php';
	include 'includes/functions.php';
	$a = fetchBooks($conn);
	echo $a;

	?>

<!--
	


	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<center>
					<img class="img-thumbnail" src="../book images/js1.jpg"/>
				</center>
			</div>
			

			<div class="col-md-3">
				<center>
					<img class="img-thumbnail" src="../book images/js2.jpg"/>
				</center>
				<div class="caption">
					<p class="title">Programming JavaScript Applications</p>
					<p>Eric Elliott</p>
					<p>500</p>
				</div>
				<button>Add To Cart</button>
				
			</div>

			<div class="col-md-3">
				<center>
					<img class="img-thumbnail" src="../book images/js3.png"/>
				</center>
				<div class="caption">
					<p class="title">Eloquent JavaScript</p>
					<p>Marijn Haverbeke</p>
					<p>₦550</p>
				</div>
				
			</div>

			<div class="col-md-3">
				<center>
					<img class="img-thumbnail" src="../book images/js3.png"/>
				</center>
				<div class="caption">
					<p>Eloquent JavaScript</p>
					<p>Marijn Haverbeke</p>
					<p>₦550</p>
				</div>
			</div>

		</div>
	</div>-->

</body>
</html>
