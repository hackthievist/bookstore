<?php

function doesEmailExist($dbconn, $input) {
	$result = false;

	$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email = :em");
	$stmt->bindParam(":em", $input);
	$stmt->execute();
	$count = $stmt->rowCount();

	if($count > 0) {
		$result = true;
		$result = $row[admin_id];
	}

	return $result;

}

function insertInto($dbconn, $clean) {

	$hash = password_hash($clean['password'], PASSWORD_BCRYPT);

	$stmt = $dbconn->prepare("INSERT INTO admin(first_name, last_name, email, password, hash) VALUES (:fn, :ln, :em, :pw, :pwrd)");
	$data = [

	":fn" => $clean['fname'],
	":ln" => $clean['lname'],
	":em" => $clean['email'],
	":pw" => $clean['password'],
	":pwrd" => $hash

	];

	$stmt->execute($data);
}


function displayErrors($errors, $field) {
	$result = "";

	if(isset($errors['field'])) {
		$result .= '<p class="err">' . $errors[$field] . '</p>';
	}
	return $result;
}

function login($dbconn, $input) {
	$result = array();
	//$hsh = password_verify($clean['password']. $row['hash']);

	$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email = :email"); 
	$stmt->bindParam(":email", $input['email']);
	$stmt->execute(); 
	$row = $stmt->fetch(PDO::FETCH_BOTH);


	if($stmt->rowCount() > 0) {
		if(password_verify($input['password'], $row['hash'])) {

			$result[] = true;
			$result[] = $row['admin_id'];
			return $result;
		}
	}
	

}

function authenticate() {
	if(!isset($_SESSION['admin_id'])) {
		header("Location: login.php");
	}
}

function addCategory($dbconn, $input) {
	$cat = [];
	$stmt = $dbconn->prepare("SELECT * FROM category WHERE category_name = :cat_name");
	$stmt->bindParam(":cat_name", $input['category_name']);
	$stmt->execute();

	if($stmt->rowCount() == 0) {
		$st = $dbconn->prepare("INSERT INTO category(category_name) VALUES(:cat_name)");
		$st->bindParam(":cat_name", $input['category_name']);
		$st->execute();
		$row = $st->fetch(PDO::FETCH_BOTH);

		$cat[] = true;
		$cat[] = $row['category_id'];
		return $cat;
	}
}

function viewCategory($dbconn) {
	$cat = [];
	$stmt = $dbconn->prepare("SELECT * FROM category");
	$stmt->execute();
	
	echo "<ul>";
	while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
		extract($row);

		echo "<li>" . $row['category_name'] . "<a href=\"addProducts.php?id=$category_id&name=$category_name\">
		<button>Add Products</button></a>" . "<a href=\"updateCategory.php?id=$category_id&name=$category_name\">
		<button>Edit</button></a><a href=\"deleteProducts.php?id=$category_id&name=$category_name\">
		&nbsp<button>Delete</button></a></li>";
	}
	echo "</ul>";
	$cat[] = true;
	$cat[] = $row['category_id'];
	return $cat;
}

function checkURL($dbconn) {
	if(isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['category_id'] = $_GET['id'];
		$_SESSION['category_name'] = $_GET['name'];
	}
}

function addProducts($dbconn, $input, $id) {
	$stmt = $dbconn->prepare("INSERT INTO books(book_name, author, publication_year, price, category_id)
		VALUES(:bn, :au, :py, :pr, :cid)");
	$data = [
	":bn" => $input['title'],
	":au" => $input['author'],
	":py" => $input['year'],
	":pr" => $input['price'],
	":cid" => $id
	];

	$stmt->execute($data);
}

function changeProduct($dbconn, $input, $id) {
	$stmt = $dbconn->prepare("UPDATE products SET book_name=:bn,
		author = :au,
		publication_year = :yr,
		price = :pr
		WHERE book_id = :bid");

	$data = [
	":bn" => $input['title'],
	":au" => $input['author'],
	":yr" => $input['year'],
	":pr" => $input['price']
	];

	$stmt->execute($data);
}

function updateCategory($dbconn, $input, $id) {
	$st = $dbconn->prepare("UPDATE category SET category_name=:cn WHERE category_id = :cid");

	$data = 
			[":cn" => $input['new'],
			 ":cid" => $id
			];

	$st->execute($data);
	$row = $st->fetch(PDO::FETCH_BOTH);
	$cat[] = $row['category_name'];
	$cat[] = $row['category_id'];
	return $cat;
}

?>