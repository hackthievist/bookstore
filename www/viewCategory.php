<?php

	session_start();
	$page_title = "Add Products";


	include "includes/db.php";
	include "includes/header.php";
	include "includes/footer.php";
	include "includes/functions.php";

	authenticate();

	$view = viewCategory($conn);
	if($view[0]) {
		$_SESSION['category_id'] = $view[1];
	}
	

?>