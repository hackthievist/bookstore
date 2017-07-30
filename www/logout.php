<?php

session_start();

include "includes/db.php";
include "includes/functions.php";
include "includes/header.php";
include "includes/footer.php";

authenticate();

if(isset($_SESSION['admin_id'])) {
	session_destroy();
	header("Location: admin/login.php");
}

if(isset($_SESSION['customer_id'])) {
	session_destroy();
	header("Location: customer/login.php");
}
?>