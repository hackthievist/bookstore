<?php

session_start();
$page_title = "Delete Book";


include "../includes/db.php";
include "../includes/header.php";
include "../includes/footer.php";
include "../includes/functions.php";

authenticate();

if(isset($_GET['id']) && isset($_GET['name'])) {
	$_SESSION['book_id'] = $_GET['id'];
	$_SESSION['book_name'] = $_GET['name'];

}


$id = $_SESSION['book_id'];
$name = $_SESSION['book_name'];
//echo "Category: " . $name . "<br/>";
//echo "ID: " . $id . "<br/>";

?>

<div class="wrapper">
	<div id="stream">
		<table id="tab">

			<?php

			if(array_key_exists('yes', $_POST)) {
				deleteBooks($conn, $id);
				header("Location: viewBooks.php");
			}

			if(array_key_exists('no', $_POST)) {
				header("Location: viewBooks.php");
			}
			
			?>

			<form id="register" action="" method="post">
				<p> Are you sure you want to delete this book? 
					<button style="width:70px; border: 1px solid; padding: 5px; border-radius: 5px; cursor: pointer" name="yes">Yes</button>
					<button style="width:70px; border: 1px solid; padding: 5px; border-radius: 5px; cursor: pointer" name="no">No</button> </p>
					<br/><br/>

				</form>

				<?php

				$a = displayBook($conn, $id);
				echo $a;	

				?>
