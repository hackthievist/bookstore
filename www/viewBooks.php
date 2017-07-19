<?php

session_start();
$page_title = "View Books";


include "includes/db.php";
include "includes/header.php";
include "includes/footer.php";
include "includes/functions.php";

authenticate();

?>

<div class="wrapper">
	<div id="stream">
		<table id="tab">

<?php

			$b = viewBooks($conn);
			echo $b;

			?>