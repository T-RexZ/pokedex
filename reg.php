<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	//tjekker om der er blevet postet
	if (isset($_POST["reg_submit"])) {
		include_once("../connection.php");
		//tjekker om reg_email er tom
		if (!empty($_POST["reg_email"])) {
			//fjerner tags som kan bruges til injections
			$email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_email"])));
			//tjekker om reg_email er formateret ordenligt
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors["email"] = "The email needs to be formatted as an email";
			}
		}else{
			$errors["email"] = "The email cannot be empty";
		}
		//tjekker om reg_pw og reg_rep_pw er tomme
		if (!empty($_POST["reg_pw"]) || !empty($_POST["reg_rep_pw"])) {
			//fjerner tags som kan bruges til injections
			$password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_pw"])));
			$rep_password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_rep_pw"])));
			//tjekker om password er 8 eller længere
			if(strlen($_POST["reg_pw"]) >= 8) {
				//sammenliner password og rep_password
				if ($password == $rep_password) {
					//laver en random salt
					$options = ['cost' => 11, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),];
					//hasher password med en random salt
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
		
		//tjekker om reg_name er tom
		if (!empty($_POST["reg_name"])) {
			//fjerner tags som kan bruges til injections
			$name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_name"])));
			//tjekker om name kun indenhulder bokstaver og mellemrum
			if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
				$errors["name"] = "The name may only contain letters and spaces";
			}
		}else{
			$errors["name"] = "The name cannot be empty";
		}
		//tjekker om reg_phone
		if (!empty($_POST["reg_phone"])) {
			//fjerner tags som kan bruges til injections
			$phone = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_phone"])));
			//tjekker om phone er fomateret rigtigt
			if(!preg_match("/^((\(?\+45\)?)?)(\s?\d{2}\s?\d{2}\s?\d{2}\s?\d{2})$/", $phone)){
				$errors["phone"] = "The phone number is not valit";
			}
		}else {
			$phone = "NULL";
		}
		//tjekker om reg_img størrelse er støre end 0
		if ($_FILES["reg_img"]["size"] != 0) {
			$billed = $_FILES["reg_img"];
			//fjerner tags som kan bruges til injections
			$img = mysqli_real_escape_string($dbc, trim(strip_tags($_FILES["reg_img"]["name"])));
			//tjekker om der er en error i billed
			if ($billed["error"] == UPLOAD_ERR_OK && !empty($billed)) {
				//uploader filen
				if (!move_uploaded_file($billed["tmp_name"], "img/profile_pic/" . $img)) {
					$errors["file"] = "The file cant be uploadet";
				}
			}
		}else {
			$img = "NULL";
		}
		//tjekker om der er nogle errors
		if (empty($errors)) {
			$sql = "INSERT INTO users (user_email, user_password, user_name, user_phone, user_img) VALUES ('$email', '$password', '$name', '$phone','$img')";
			//connecter til serveren
			if ($query = mysqli_query($dbc, $sql)) {
				mysqli_close($dbc);
				die(header("location: index.php?reg=1"));
			}else {
				mysqli_close($dbc);
				die(header("location: index.php?reg=0"));
			}
		}else {
			// ligger errors ind i en session
			$_SESSION["errors"] = $errors;
			mysqli_close($dbc);
			die(header("location: index.php"));
		}
	}else {
		die(header("location: index.php?in=0"));
	}
?>