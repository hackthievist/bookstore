<?php

session_start();
$id = $_SESSION['admin_id'];
$page_title = "Admin Home";
include "../includes/db.php";
include "../includes/header.php";
include "../includes/functions.php";
authenticate();


//echo "ID: " .$id;


?>