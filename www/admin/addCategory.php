<?php
session_start();
$page_title = "Add Category";
include "../includes/db.php";
include "../includes/header.php";
include "../includes/functions.php";
include "../includes/footer.php";

authenticate();

?>

<!DOCTYPE html>
<html>
<head>
	<link href="../styles/style.css" rel="stylesheet" type="text/css"/>
	<title><?php echo $page_title ?></title>
</head>
<body>
	<div class="wrapper">
		<div id="stream">
			<?php

			$error = [];

			if(array_key_exists('submit', $_POST)) {
				if(empty($_POST['category_name'])) {
					$error['category_name'] = "Please enter category name";
				}

				if(empty($error)) {
					$clean = array_map('trim', $_POST);
					$add = addCategory($conn, $clean);

					if($add[0]) {
						$_SESSION['category_id'] = $add[1];
						header("Location:addCategory.php?successfully added");
					} else {
						header("Location: addCategory.php?err");
					}
				}

			}

			?>

			<form id="register" action="" method="post">
				<p>Category Name: <input type="text" name="category_name"></p>
				<input type="submit" name="submit" value="Add">
			</form>

		</body>
		</html>