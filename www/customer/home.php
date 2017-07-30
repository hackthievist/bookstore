<?php

session_start();
$page_title = "Home";
include '../includes/db.php';
include '../includes/functions.php';
layerProtect();
include 'header.php';

if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
?>



<body>

	<div class="content">

	</div>

	
	<div class="container">
		<?php
		viewCategoryButtons($conn);
		?>
	</div>

	<?php
	if(!isset($_GET['id'])) {
		$a = fetchBooks($conn);
		echo $a;
	} else {
		$b = fetchBooksById($conn, $id);
		echo $b;
	}

	?>

</body>
</html>
