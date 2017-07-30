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

function insertIntoAdmin($dbconn, $clean) {

	$st = $dbconn->prepare("SELECT * FROM admin WHERE email =:em");
	$st->bindParam(":em", $clean['email']);
	$st->execute();

	if($st->rowCount() == 0) {
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
	} else {
		header("Location: register.php?email_exists");
	}
}

function insertIntoCustomer($dbconn, $clean) {

	$st = $dbconn->prepare("SELECT * FROM customer WHERE email =:em");
	$st->bindParam(":em", $clean['email']);
	$st->execute();

	if($st->rowCount() == 0) {

		$hash = password_hash($clean['password'], PASSWORD_BCRYPT);

		$stmt = $dbconn->prepare("INSERT INTO customer(first_name, last_name, email, password, hash) VALUES (:fn, :ln, :em, :pw, :pwrd)");
		$data = [

		":fn" => $clean['fname'],
		":ln" => $clean['lname'],
		":em" => $clean['email'],
		":pw" => $clean['password'],
		":pwrd" => $hash

		];

		$stmt->execute($data);
	}
}

function fetchName($dbconn, $cid) {
	$stmt = $dbconn->prepare("SELECT * FROM customer WHERE customer_id = :cid");
	$stmt->bindParam(":cid", $cid);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_BOTH);
	extract($row);
	echo $last_name . ", " . $first_name;
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

function customerLogin($dbconn, $input) {
	$result = array();

	$stmt = $dbconn->prepare("SELECT * FROM customer WHERE email = :email"); 
	$stmt->bindParam(":email", $input['email']);
	$stmt->execute(); 
	$row = $stmt->fetch(PDO::FETCH_BOTH);


	if($stmt->rowCount() > 0) {
		if(password_verify($input['password'], $row['hash'])) {

			$result[] = true;
			$result[] = $row['customer_id'];
			return $result;
		}
	}
	

}

function authenticate() {
	if(!isset($_SESSION['admin_id'])) {
		header("Location: login.php");
	}
}

function layerProtect() {
	if(!isset($_SESSION['customer_id'])) {
		header("Location: clogin.php");
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

function viewCategoryButtons($dbconn) {
	$stmt = $dbconn->prepare("SELECT * FROM category");
	$stmt->execute();
	$colors = ["BlueViolet", "CadetBlue", "CornflowerBlue", "Crimson", "LightSteelBlue", "HotPink", "Tomato", "ForestGreen"];
	

	while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
		$random = array_rand($colors, 1);
		extract($row);
		echo '<a style="color: black" href="home.php?id='.$category_id.'">
		<button class="category-button" style="background-color:'.$colors[$random].'">'.$category_name.'</button></a>';

	}
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

		$stmt = $dbconn->prepare("UPDATE books SET book_name = :book_name, 
			author = :auth,
			publication_year = :py,
			price = :pr,
			filepath = :des WHERE book_id = :bid");

		$data = 
		[":book_name" => $input['title'],
		":auth" => $input['author'],
		":py" => $input['year'],
		":pr" => $input['price'],
		":des" => $destination,
		":bid" => $id
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

function fetchBooks($dbconn) {
	$result = "";
	$stmt = $dbconn->prepare("SELECT * FROM books");
	$stmt->execute();

	$row_counter = 1;
	$result .= '<div class="container">
	<div class="row">';
		while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
			extract($row);

			if(($row_counter % 5) == 0) {
				$result .= '<div class="row">';
				$row_counter = 1;
			}

			$result .= 
			'<div class="col-md-3">
			<center>
				<img style="min-height: 350px; height: 350px" class="img-thumbnail" src="'.$filepath.'"/>
			</center>
			<div class="caption">
				<p class="title">'.$book_name.'</p>
				<p>'.$author.'</p>
				<p>₦'.$price.'</p>
				<a href="cart.php?id='.$book_id.'"><button>Add To Cart</button></a>
			</div>

		</div>';

		if($row_counter % 5 == 0) {
			$result .= '</div>';
		}

		$row_counter++;
	}
	return $result;
}

function fetchBooksById($dbconn, $id) {
	$result = "";
	$stmt = $dbconn->prepare("SELECT * FROM books WHERE category_id = :cid");
	$stmt->bindParam(":cid", $id);
	$stmt->execute();

	$row_counter = 1;
	$result .= '<div class="container">
	<div class="row">';
		while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
			extract($row);

			if(($row_counter % 5) == 0) {
				$result .= '<div class="row">';
				$row_counter = 1;
			}

			$result .= 
			'<div class="col-md-3">
			<center>
				<img style="min-height: 350px; height: 350px" class="img-thumbnail" src="'.$filepath.'"/>
			</center>
			<div class="caption">
				<p class="title">'.$book_name.'</p>
				<p>'.$author.'</p>
				<p>₦'.$price.'</p>
				<a href="cart.php?id='.$book_id.'"><button>Add To Cart</button></a>
			</div>

		</div>';

		if($row_counter % 5 == 0) {
			$result .= '</div>';
		}

		$row_counter++;
	}
	return $result;
}

function addToCart($dbconn, $cid, $bid) {
	$s = $dbconn->prepare("SELECT * FROM cart WHERE book_id = :bid AND customer_id = :cid");
	

	$dat = 
	[":bid" => $bid,
	":cid" => $cid
	];

	$s->execute($dat);

	$st = $dbconn->prepare("SELECT * FROM books WHERE book_id = :bid");
	$st->bindParam(":bid", $bid);

	if($s->rowCount() > 0) {
		$up = $dbconn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE customer_id = :cid AND book_id = :bid");
		$val = 
		[":bid" => $bid,
		":cid" => $cid
		];

		$up->execute($val);

	} else {

		$stmt = $dbconn->prepare("INSERT INTO cart(customer_id, book_id, quantity) VALUES(:cid, :bid, 1)");

		$data = 
		[":cid" => $cid,
		":bid" => $bid
		];

		$stmt->execute($data);

	}
}

function viewCart($dbconn, $cid) {
	$result = [];
	$arr = [];
	$stmt = $dbconn->prepare("SELECT * FROM cart WHERE customer_id = :cid AND quantity > 0");
	$stmt->bindParam(":cid", $cid);
	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_BOTH)) {
		extract($row);
		$result[] = $book_id;
		$arr[] = $quantity;
	}

	$counter = 0;

	if($stmt->rowCount() > 0) {
		echo '<tr><th>S/N</th>
		<th>Title</th>
		<th>Author</th>
		<th>Image</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Add</th>
		<th>Remove</th>
		<th>Delete Item</th>
		<th>Total Price</th>
		<th></th>
	</tr>';
}

$x = 0;
foreach($result as $res) {
	global $total;
	$y = $arr[$x];
	$counter++;
	$st = $dbconn->prepare("SELECT * FROM books WHERE book_id = :bid");
	$st->bindParam(":bid", $res);
	$st->execute();
	$fetch = $st->fetch(PDO::FETCH_BOTH);
	extract($fetch);
	echo '<tr>
	<td>'.$counter.'</td>
	<td>'.$book_name.'</td>
	<td>'.$author.'</td>
	<td><img style="min-height: 150px; height: 150px; width: 100px" src="'.$filepath.'"/></td>
	<td>₦'.$price.'</td>
	<td>'.$y.'</td>
	<td><a style="border: none" href="addItem.php?id='.$res.'"><img style= "width:25px" src="../icons & images/add.png"/></a></td>
	<td><a style="border: none" href="removeCartItem.php?id='.$res.'"><img style= "width:25px" src="../icons & images/minus.png"/></a></td>
	<td><a style="border: none" href="deleteCartItem.php?id='.$res.'"><img style= "width:25px" src="../icons & images/trashb.png"/></a></td>
	<td>₦'.$price*$y.'</td>
	<td></td>

</tr>';
$total += $price*$y;
$x++;

}

if($stmt->rowCount() > 0) {
	echo '<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<th>₦'.$total.'</th>
	<td><a style="border: none" href="checkout.php?id='.$cid.'"><button style="width: 70px; text-align: center; border: 1px solid grey; padding: 5px; border-radius: 5px; margin-left: 0">Checkout</button></a></td>
</tr>';

} else {
	echo '<div style="text-align:center; position: relative; top: 150px;"><h1>Cart Empty</h1></div>';
}
}

function deleteCartItem($dbconn, $cid, $bid) {
	$stmt = $dbconn->prepare("DELETE FROM cart WHERE customer_id = :cid AND book_id = :bid");
	$data = [":cid" => $cid, ":bid" => $bid];
	$stmt->execute($data);
}

function removeCartItem($dbconn, $cid, $bid) {
	$stmt = $dbconn->prepare("UPDATE cart SET quantity = quantity - 1 WHERE customer_id = :cid AND book_id = :bid");
	$data = [":cid" => $cid, ":bid" => $bid];
	$stmt->execute($data);
}

function addCartItem($dbconn, $cid, $bid) {
	$up = $dbconn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE customer_id = :cid AND book_id = :bid");
	$val = 
	[":bid" => $bid,
	":cid" => $cid
	];

	$up->execute($val);
}

function checkout($dbconn, $cid) {
	$stmt = $dbconn->prepare("DELETE FROM cart WHERE customer_id = :cid");
	$stmt->bindParam(":cid", $cid);
	$stmt->execute();
}

?>