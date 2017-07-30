<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="../styles/styles.css?v=1"/>
</head>
<body>
	<section>
		<div class="mast">
			<h1><a href="home.php">T<span>SSB</span></a></h1>

			<?php if(isset($_SESSION['admin_id'])) {
				echo '<a style="color: white; position: absolute; left: 360px; top: 80px" href="addCategory.php">Add Category</a>
				<a style="color: white; position: absolute; left: 180px; top: 80px" href="viewCategory.php">View Category</a>
				<a style="color: white; position: absolute; left: 0px; top: 80px"href="viewBooks.php">View Books</a>
				<a style="color: red; position: absolute; right: -120px; top: 80px" href="../logout.php">Logout</a>';
			} ?>
		</div>
	</section>