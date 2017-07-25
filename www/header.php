<?php

session_start();
$page_title = "Home";
include 'includes/db.php';
include 'includes/functions.php';
include 'style.html';

?>

<!-- <style>

	* {
		margin: 0;
		padding: 0;
		font-family: Titillium Web;
	}

	.nav {
		width: 100%;
		height: 90px;
		background-color: #2980b9;
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


</style> -->

<body>

	<!-- <div class="nav">
		<div class="container">
			<h2 id="logo">hackthievate.</h2>
			<div class="links navbar-right">
				<a href="">View Categories</a>
				<a href="view_cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a>
				<a><?//php fetchName($conn, $id); ?></a>
			</div>
		</div>

	</div> -->

	<div class="content">

	</div>

	<?php
	$a = fetchBooks($conn);
	echo $a;

	?>

</body>
</html>
