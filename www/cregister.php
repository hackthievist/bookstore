<?php

$page_title = "Customer Register";
include "includes/db.php";
include "includes/header.php";
include "includes/functions.php";
include "includes/footer.php";
?>

<div class="wrapper">
	<h1 id="register-label">Customer Register</h1>
	<hr>

	<?php

	$error = [];

	if(array_key_exists('register', $_POST)) {
		

		if(empty($_POST['fname'])) {
			$error['fname'] = "First Name field cannot be empty";
		}

		if(empty($_POST['lname'])) {
			$error['lname'] = "Last Name field cannot be empty";
		}	

		if(empty($_POST['email'])) {
			$error['email'] = "Email field cannot be empty";
		}

		if(empty($_POST['password'])) {
			$error['password'] = "Please enter a password";
		}

		if(empty($_POST['pword'])) {
			$error['pword'] = "Please confirm your password";
		}

		if(empty($error)) {
					//database stuff
					$clean = array_map('trim', $_POST);  //trims whitespace
					insertIntoCustomer($conn, $clean);

				} 

				
			} 

			?>
			<form id="register"  action ="" method ="post">
				<div>
					<?php 
					$display = displayErrors($error, 'fname');
					echo $display;
					?>
					<label>First Name:</label>
					<input type="text" name="fname" placeholder="First Name">
				</div>
				<div>
					<label>Last Name:</label>	
					<input type="text" name="lname" placeholder="Last Name">
				</div>

				<div>
					<label>Email:</label>
					<input type="text" name="email" placeholder="email">
				</div>
				<div>
					<label>Password:</label>
					<input type="password" name="password" placeholder="Password">
				</div>

				<div>
					<label>Confirm Password:</label>	
					<input type="password" name="pword" placeholder="Confirm Password">
				</div>

				<input type="submit" name="register" value="Register">
			</form>

			<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
		</div>

