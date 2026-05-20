<?php

	/*
	$host = "http://intheon.uk";
	$username = "intheon_root";
	$password = "S%!;PUXm?MVl";
	$database = "intheon_homepage";
	$connect = mysqli_connect($host,$username,$password,$database);
*/
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "homepage";
	try {
		$connect = mysqli_connect($host,$username,$password,$database);
	} catch (Throwable $e) {
		// Suppress fatal error for "simple run" mode
		// Ideally we would log this or show a friendly error, but for now just don't crash
		$connect = false;
	}
?>