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
	$result = "";
	$stmt = $dbconn->prepare("SELECT * FROM category");
	$stmt->execute();
	$counter = 1;

	echo '<tr>
	<th>S/N</th>
	<th>Category Name</th>
	<th>View Books</th>
	<th>Edit</th>
	<th>Delete</th>
	<th>Add Products</th>
</tr>
</thead>';

while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
	extract($row);
	$result .= '<tr>
	<td>' . $counter . '</td>
	<td>' . $category_name . '</td>

	<td><a href="viewBooks.php?id='.$category_id.'&name='.$category_name.'">View</a></td>
	<td><a href="updateCategory.php?id='.$category_id.'&name='.$category_name.'">Edit</a></td>
	<td><a href="deleteCategory.php?id='.$category_id.'&name='.$category_name.'">Delete</a></td>
	<td><a href="addProducts.php?id='.$category_id.'&name='.$category_name.'">Add</a></td>
</tr>';
$counter++;
}
return $result;
}

function checkURL($dbconn) {
	if(isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['category_id'] = $_GET['id'];
		$_SESSION['category_name'] = $_GET['name'];
	}
}

function addProducts($dbconn, $input, $id, $image) {
	$st = $dbconn->prepare("SELECT * FROM books WHERE book_name = :bn");
	$stmt = $dbconn->prepare("INSERT INTO books(book_name, author, publication_year, price, category_id, filepath)
		VALUES(:bn, :au, :py, :pr, :cid, :fp)");

	$dat = [":bn" => $input['title']];
	$data = [
	":bn" => $input['title'],
	":au" => $input['author'],
	":py" => $input['year'],
	":pr" => $input['price'],
	":cid" => $id,
	":fp" => $image
	];

	$st->execute($dat);

	if($st->rowCount() == 0) {
		$stmt->execute($data);
	} else {
		echo "Book already exists";
	}
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

function deleteCategory($dbconn, $id) {
	$stmt = $dbconn->prepare("DELETE FROM category WHERE category_id = :id");
	$st = $dbconn->prepare("DELETE FROM books WHERE category_id = :ix");
	$stmt->bindParam(":id", $id);
	$data = [":ix" => $id];
	$stmt->execute();
	$st->execute($data);
}

function viewBooks($dbconn) {
	$result = "";
	$stmt = $dbconn->prepare("SELECT * FROM books");
	$stmt->execute();

	echo '<thead>
	<tr>
		<th>S/N</th>
		<th>Book Name</th>
		<th>Image</th>
		<th>Price</th>
		<th>Edit</th>
		<th>Delete</th>
		
	</tr>
</thead>';

$counter = 1;
while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
	extract($row);

	$result .= '<tr>
	<td>' . $counter . '</td>
	<td>' . $book_name . '&nbsp</td>
	<td><img class="img-thumbnail" width="80px" src="'.$filepath.'"></td>
	<td>' . "₦" .$price. '</td>

	<td><a href="editBooks.php?id='.$book_id.'&name='.$book_name.'">Edit</a></td>
	<td><a href="deleteBooks.php?id='.$book_id.'&name='.$book_name.'">Delete</a></td>

</tr>';
$counter++;
}

return $result;

}

function viewBooksByCategory($dbconn, $id) {
	$result = "";
	$stmt = $dbconn->prepare("SELECT * FROM books WHERE category_id =:id");
	$stmt->bindParam(":id", $id);
	$stmt->execute();
	

	echo '<thead>
	<tr>
		<th>S/N</th>
		<th>Book Name</th>
		<th>Image</th>
		<th>Edit</th>
		<th>Delete</th>
		
	</tr>
</thead>';

$counter = 1;
while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
	extract($row);

	$result .= '<tr>
	<td>' . $counter . '</td>
	<td>' . $book_name . '&nbsp</td>
	<td><img width="80px" src="'.$filepath.'"></td>

	<td><a href="editBooks.php?id='.$book_id.'&name='.$book_name.'">Edit</a></td>
	<td><a href="deleteBooks.php?id='.$book_id.'&name='.$book_name.'">Delete</a></td>

</tr>';
$counter++;
}

return $result;

}

function updateBooks($dbconn, $input, $id, $destination) {
	$st = $dbconn->prepare("SELECT * FROM books WHERE book_name = :bn");

	$dat = [
	":bn" => $input['title']
	];

	$st->execute($dat);

	if($st->rowCount() == 0) {

		echo "yes";
		exit();

		$stmt = $dbconn->prepare("UPDATE books SET book_name = :book_name, 
			author = :auth,
			publication_year = :py,
			price = :pr,
			filepath = :des");

		$data = 
		[":book_name" => $input['title'],
		":auth" => $input['author'],
		":py" => $input['year'],
		":pr" => $input['price'],
		":des" => $destination
		];

		$stmt->execute($data);
	}
}

function deleteBooks($dbconn, $id) {
	$stmt = $dbconn->prepare("DELETE FROM books WHERE book_id = :ix");
	$data = [":ix" => $id];
	$stmt->execute($data);
}

function displayBook($dbconn, $id) {
	$result = "";
	$stmt = $dbconn->prepare("SELECT * FROM books WHERE book_id = :bid");
	$stmt->bindParam(":bid", $id);
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
		extract($row);
	}

	$result .= '<img width="300px" style="height:400px" src="'.$filepath.'"/>
	<p>Title: ' . $book_name . '</p>
	<p>Author: ' . $author . '</p>
	<p>Year: ' . $publication_year . '</p>
	<p>Price: ' . $price. '</p>';
	return $result;
}

?>