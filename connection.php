<?php
	error_reporting(E_ALL & ~E_NOTICE);
	
	$dbc = mysqli_connect("127.0.0.1", "root", "", "pokedex");
	mysqli_query($dbc, "SET NAMES utf8");

	if (mysqli_connect_errno()) {
		echo "Failed" . mysqli_connect_error();
	}
?>