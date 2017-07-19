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

			if(isset($_GET['id']) && isset($_GET['name'])) {
				$id = $_GET['id'];
				$name = $_GET['name'];
				$a = viewBooksByCategory($conn, $id);
				echo $a;
			} else {
				$b = viewBooks($conn);
				echo $b;
			}
			
			?>