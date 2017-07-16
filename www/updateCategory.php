<?php

session_start();
$page_title = "Add Products";


include "includes/db.php";
include "includes/header.php";
include "includes/footer.php";
include "includes/functions.php";

authenticate();
checkURL($conn);
$id = $_SESSION['category_id'];
$name = $_SESSION['category_name'];


	if(array_key_exists('sub', $_POST)) {
		$error = [];

		if(empty($_POST['new'])) {
			$error[] = "Please enter a new name";
		}

		if(empty($error)) {
			$clean = array_map('trim', $_POST);
			$up = updateCategory($conn, $id);
		}
	}

?>

<form action="" method="post">
	<p>Current Category Name: <?php echo $name ?> </p>
	<p><input type="text" name="new" placeholder="New Name"></p>
	<input type="submit" name="sub" value="Update">

</form>