<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();

	if (isset($_POST["reg_submit"])) {
		include_once("../connection.php");
		$email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_email"])));
		$password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_pw"])));
		$password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_rep_pw"])));
		$name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_name"])));

		if(!empty($phone)) {
			$phone = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_phone"])));
		}else {
			$phone = "NULL";
		}

		if ($_FILES["reg_img"]['size'] != 0) {
			$billed = $_FILES["file_upload"];
			$img = mysqli_real_escape_string($dbc, trim(strip_tags($_FILES["reg_img"]["name"])));
			if ($billed["error"] == UPLOAD_ERR_OK && !empty($billed)) {
				if (move_uploaded_file($billed["tmp_name"], "img/profile_pic/" . $img)) {
				}else {
					mysqli_close($dbc);
					die(header("location: index.php?img=0"));
				}
			}
		}else {
			$img = "NULL";
		}

		$options = ['cost' => 11, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),];
		$password = password_hash($password, PASSWORD_BCRYPT, $options);

		$sql = "INSERT INTO users (user_email, user_password, user_name, user_phone, user_img) VALUES ('$email', '$password', '$name', '$phone','$img')";

		if ($query = mysqli_query($dbc, $sql)) {
			mysqli_close($dbc);
			die(header("location: index.php?reg=1"));
		}else {
			mysqli_close($dbc);
			die(header("location: index.php?reg=0"));
		}
	}else {
		die(header("location: index.php?ind=0"));
	}
?>