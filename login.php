<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();

	if (isset($_POST["login_submit"])) {
		include_once("connection.php");
		$email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["login_email"])));
		$password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["login_pw"])));

		$sql = "SELECT user_id, user_email, user_password FROM users WHERE user_email = '$email' LIMIT 1";

		if ($query = mysqli_query($dbc, $sql)) {
			$row = mysqli_fetch_assoc($query);
			$user_id = $row["user_id"];
			$db_email = $row["user_email"];
			$db_password = $row["user_password"];
		}

		if ($email == $db_email && password_verify($password, $db_password) && !empty($email) && !empty($password)) {
			$_SESSION["id"] = $user_id;
			mysqli_close($dbc);
			die(header("location: user.php"));
		}else{
			mysqli_close($dbc);
			die(header("location: index.php"));
		}
	}else {
		die(header("location: index.php"));
	}
?>