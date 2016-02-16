<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();

	if (isset($_POST["rig_submit"])) {
		include_once("connection.php");
		$email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["rig_email"])));
		$password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["rig_pw"])));
		$name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["rig_name"])));
		$phone = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["rig_phone"])));
		$img = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["rig_img"])));

		$options = ['cost' => 11, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),];
		$password = password_hash($password, PASSWORD_BCRYPT, $options);

		$sql = "INSERT INTO users (user_email, user_password, user_name, user_phone, user_img) VALUES ('$email', '$password', '$name', '$phone','$img')";

		if ($query = mysqli_query($dbc, $sql)) {
			mysqli_close($dbc);
			die(header("location: index.php"));
		}else{
			mysqli_close($dbc);
			die(header("location: rigp.php"));
		}
	}else {
		die(header("location: index.php"));
	}
?>