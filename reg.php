<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();

	if (isset($_POST["reg_submit"])) {

		include_once("../connection.php");

		if (!empty($_POST['reg_email'])) {
			$email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_email"])));
		}else{
			$_SESSION['errors[]'] = 'The email cannot be empty';
		}

		if (!empty($_POST['reg_pw']) || !empty($_POST['reg_rep_pw'])) {
			$password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_pw"])));
			$rep_password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_rep_pw"])));
			if ($password === $rep_password) {
				$options = ['cost' => 11, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),];
				$password = password_hash($password, PASSWORD_BCRYPT, $options);
			}else {
				$_SESSION['errors[]'] = 'the passwords must match';
			}
		}else {
			$_SESSION['errors[]'] = 'The password cannot be empty';
		}
		
		if (!empty($_POST['reg_name'])) {
			$name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_name"])));
		}else{
			$_SESSION['errors[]'] = 'The name cannot be empty';
		}

		if(!empty($$_POST["reg_phone"])) {
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
					$_SESSION['errors[]'] = 'The file cant be uploadet';
					mysqli_close($dbc);
					die(header("location: index.php"));
				}
			}
		}else {
			$img = "NULL";
		}


		if (empty($_SESSION['errors[]'])) {
			$sql = "INSERT INTO users (user_email, user_password, user_name, user_phone, user_img) VALUES ('$email', '$password', '$name', '$phone','$img')";

			if ($query = mysqli_query($dbc, $sql)) {
				mysqli_close($dbc);
				die(header("location: index.php?reg=1"));
			}else {
				mysqli_close($dbc);
				die(header("location: index.php?reg=0"));
			}
		}
	}else {
		die(header("location: index.php?in=0"));
	}
?>