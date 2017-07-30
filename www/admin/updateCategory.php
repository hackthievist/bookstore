<?php

session_start();
$page_title = "Update Category";


include "../includes/db.php";
include "../includes/header.php";
include "../includes/footer.php";
include "../includes/functions.php";

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
		$change = updateCategory($conn, $clean, $id);
		header("Location: viewCategory.php?succesfully_changed");
	}
}

?>

<div class="wrapper">
	<div id="stream">
			<form id="register" action="" method="post">
				<p>Current Category Name: <?php echo $name ?> </p>
				<br/>
				<p>New Category Name:<input type="text" name="new" placeholder="New Name"></p>
				<input type="submit" name="sub" value="Update">

			</form>