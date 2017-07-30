<?php

session_start();
$page_title = "Customer Login";
include "../includes/db.php";
include "../includes/header.php";
include "../includes/functions.php";
include "../includes/footer.php";

?>

<div class="wrapper">
	<h1 id="register-label">Customer Login</h1>
	<hr/>

	<?php
	$error = [];

	if(array_key_exists('login', $_POST)) {
		

		if(empty($_POST['email'])) {
			$error['email'] = "Email field cannot be empty";
		}


		if(empty($_POST['password'])) {
			$error['password'] = "Please enter a password";
		}


		if(empty($error)) {
					//database stuff
					$clean = array_map('trim', $_POST);  //trims whitespace
					$log = customerLogin($conn, $clean);

					if($log[0]) {
						$_SESSION['customer_id'] = $log[1];
						header("Location: home.php");
					}
					

				} else {
					echo "ERRORS"; //placeholder
				} 

			} 

			?>
			<form id="register" action ="" method ="post">


				<div>
					<label>Email:</label>
					<input type="text" name="email" placeholder="Email">
				</div>
				<div>
					<label>Password:</label>
					<input type="password" name="password" placeholder="Password">
				</div>

				
				<input type="submit" name="login" value="Login"">
			</form>

			<h4 class="jumpto">Don't have an account? <a href="register.php">Register</a></h4>
		</div>