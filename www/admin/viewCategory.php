<?php

session_start();
$page_title = "View Category";


include "../includes/db.php";
include "../includes/header.php";
include "../includes/footer.php";
include "../includes/functions.php";

authenticate();

?>
<div class="wrapper">
	<div id="stream">
		<table id="tab">

				<?php $a = viewCategory($conn);
					   echo $a; ?>
				

