<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();

	if (isset($_POST["reg_submit"])) {
		include_once("../connection.php");

		if (!empty($_POST["reg_email"])) {
			$email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_email"])));
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors["email"] = "The email needs to be formattet as a email";
			}
		}else{
			$errors["email"] = "The email cannot be empty";
		}

		if (!empty($_POST["reg_pw"]) || !empty($_POST["reg_rep_pw"])) {
			$password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_pw"])));
			$rep_password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_rep_pw"])));
			if(strlen($_POST["reg_pw"]) >= 8) {
				if ($password == $rep_password) {
					$options = ['cost' => 11, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),];
					$password = password_hash($password, PASSWORD_BCRYPT, $options);
				}else {
					$errors["password"] = "The passwords must match";
				}
			}else {
				$errors["password"] = "The password must contain 8 or more letters";
			}
		}else {
			$errors["password"] = "The password cannot be empty";
		}
		
		if (!empty($_POST["reg_name"])) {
			$name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_name"])));
			if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
				$errors["name"] = "The name may only contain letters and spaces";
			}
		}else{
			$errors["name"] = "The name cannot be empty";
		}

		if(!empty($_POST["reg_phone"])) {
			$phone = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_phone"])));
			if(!preg_match("/^((\(?\+45\)?)?)(\s?\d{2}\s?\d{2}\s?\d{2}\s?\d{2})$/", $phone)){
				$errors["phone"] = "The phone number is not valit";
			}
		}else {
			$phone = "NULL";
		}

		if ($_FILES["reg_img"]["size"] != 0) {
			$billed = $_FILES["reg_img"];
			$img = mysqli_real_escape_string($dbc, trim(strip_tags($_FILES["reg_img"]["name"])));
			if ($billed["error"] == UPLOAD_ERR_OK && !empty($billed)) {
				if (!move_uploaded_file($billed["tmp_name"], "img/profile_pic/" . $img)) {
					$errors["file"] = "The file cant be uploadet";
				}
			}
		}else {
			$img = "NULL";
		}

		if (empty($errors)) {
			$sql = "INSERT INTO users (user_email, user_password, user_name, user_phone, user_img) VALUES ('$email', '$password', '$name', '$phone','$img')";

			if ($query = mysqli_query($dbc, $sql)) {
				mysqli_close($dbc);
				die(header("location: index.php?reg=1"));
			}else {
				mysqli_close($dbc);
				die(header("location: index.php?reg=0"));
			}
		}else {
			$_SESSION["errors"] = $errors;
			mysqli_close($dbc);
			die(header("location: index.php"));
		}
	}else {
		die(header("location: index.php?in=0"));
	}
?>
