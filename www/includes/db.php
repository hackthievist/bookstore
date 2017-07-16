<?php

define('DBNAME', 'online_store');
define('DBUSER', 'root');
define('DBPASS', 'fantastic');

try {
		#prepare a PDO instance

	$conn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

		#set verbose error modes
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

} catch(PDOException $e) {

	echo $e->getMessage();

}


?>