<?php

session_start();
$page_title = "Add Products";

include "includes/db.php";
include "includes/header.php";
include "includes/functions.php";
include "includes/footer.php";

authenticate();
checkURL($conn);
$id = $_SESSION['category_id'];
$name = $_SESSION['category_name'];

echo "Category: " . $name . "<br/>";
echo "ID: " . $id . "<br/>";


?>



<?php


if(array_key_exists('sub', $_POST)) {
	var_dump($_FILES['pic']);
	$error = [];
	$MAX_FILE_SIZE = 3048576;
	$allowed_extensions = ['image/jpg', 'image/JPG', 'image/JPEG', 'image/jpeg', 'image/png'];
	$upload_dir = "uploads/";

	if($_FILES['pic']['size'] > $MAX_FILE_SIZE) {
		$error[] = "Are you the one buying our space ni?";
	}

	if(!in_array($_FILES['pic']['type'], $allowed_extensions)) {
		$error[] = "Upload correct format this guy";
	}

	$random = rand(00000, 99999);
	$filename = $random . "_" . $_FILES['pic']['name'];

	$destination = $upload_dir . $filename;

	if(!move_uploaded_file($_FILES['pic']['tmp_name'], $destination)) {
		$error[] = "Could not upload";
	}

	if(empty($_POST['title'])) {
		$error[] = "Please enter a book title";
	}

	if(empty($_POST['author'])) {
		$error[] = "Please enter the book author";
	}

	if(empty($_POST['year'])) {
		$error[] = "Please enter the year of publication";
	}

	if(empty($error)) {
		$clean = array_map('trim', $_POST);
		addProducts($conn, $clean, $id, $destination);
	} else {
		foreach($error as $err) {
			echo $err;
		}
	}

}

?>


<form id="register" action="" method="post" enctype="multipart/form-data">

	<div>
		<label>Book Title:</label>
		<input type="text" name="title" placeholder="Book Title">
	</div>

	<div>
		<label>Author:</label>
		<input type="text" name="author" placeholder="Author">
	</div>

	<div>
	<label>Year:</label>
		<input type="text" name="year" placeholder="Year">
	</div>

	<div>
		<label>Price:</label>
		<input type="text" name="price" placeholder="Price">
	</div>

	<p><input type="file" name="pic"></p>
	<input type="submit" name="sub" value="Upload">


</form>

