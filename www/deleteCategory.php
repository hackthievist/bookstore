<?php

session_start();
$page_title = "Delete Category";


include "includes/db.php";
include "includes/header.php";
include "includes/footer.php";
include "includes/functions.php";

authenticate();
checkURL($conn);
$id = $_SESSION['category_id'];
$name = $_SESSION['category_name'];

?>

<div class="wrapper">
	<div id="stream">
		<table id="tab">

			<?php

			if(array_key_exists('yes', $_POST)) {
				deleteCategory($conn, $id);
				header("Location: view.php");
			}

			if(array_key_exists('no', $_POST)) {
				header("Location: view.php");
			}
			
			?>

			<form id="register" action="" method="post">
			<p> Are you sure you want to delete this category? 
				<button style="width:70px; border: 1px solid; padding: 5px; border-radius: 5px; cursor: pointer" name="yes">Yes</button>
				<button style="width:70px; border: 1px solid; padding: 5px; border-radius: 5px; cursor: pointer" name="no">No</button> </p>

			</form>

			<?php

			$view = viewBooksByCategory($conn, $id);
			echo $view;

			?>