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
			background-color: violet;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.18);
		}

		#logo {
			font-family: Abel;
		}

		.links a {
			margin-left: 40px;
			text-decoration: none;
			font-family: Raleway;
		}

		.wide {
			background-color: blue;
		}

		.content {
			width: 100%;
			height: 400px;
			background-color: green;
		}

		img {
			margin-top: 25px;
			width: 300px;
		}

		p {
			font-size: 25px;
		}


	</style>

</head>
<body>

	<div class="nav">
		<div class="container">
			<h2 id="logo">hackthievate.</h2>
			<div class="links navbar-right">
				<a href="">View Categories</a>
				<a href="">Add to Cart</a>
			</div>
		</div>

	</div>

	<div class="content">

	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img src="../book images/js1.jpg"/	>
			</div>

			<div class="col-md-4">
				<img src="../book images/js2.jpg"/>
			</div>

			<div class="col-md-4">
				<img src="../book images/js3.png"/>
				<div class="caption">
					<p>Eloquent JavaScript</p>
					<p>Marijn Haverbeke</p>
					<p>₦550</p>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
