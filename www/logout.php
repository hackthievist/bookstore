<?php

session_start();
include "includes/db.php";
include "includes/header.php";
include "includes/footer.php";
include "includes/functions.php";

session_destroy();
header("Location: login.php");

?>