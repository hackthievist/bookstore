<?php

$page_title = "Admin Register";
include "includes/db.php";
include "includes/header.php";
include "includes/functions.php";
include "includes/footer.php";
?>

<div class="wrapper">
	<h1 id="register-label">Admin Register</h1>
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
					insertIntoAdmin($conn, $clean);

				} 

				
			} 

			?>
			<form id="register"  action ="" method ="post">
				<div>
					<?php 
					$display = displayErrors($error, 'fname');
					echo $display;
					?>
					<label>first name:</label>
					<input type="text" name="fname" placeholder="First Name">
				</div>
				<div>
					<label>last name:</label>	
					<input type="text" name="lname" placeholder="Last Name">
				</div>

				<div>
					<label>email:</label>
					<input type="text" name="email" placeholder="email">
				</div>
				<div>
					<label>password:</label>
					<input type="password" name="password" placeholder="password">
				</div>

				<div>
					<label>confirm password:</label>	
					<input type="password" name="pword" placeholder="password">
				</div>

				<input type="submit" name="register" value="register">
			</form>

			<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
		</div>

