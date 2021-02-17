<?php
//connect to assignment 2 database in MySQL

	$dbhost = "localhost";
	$dbuser= "root";
	$dbpass = "cs3319";
	$dbname = "mgianco2assign2db";
	$connection = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);

	if (mysqli_connect_errno()) {
     		die("database connection failed :" .
     		mysqli_connect_error() .
     		"(" . mysqli_connect_errno() . ")"
         	);
    	}
?>

