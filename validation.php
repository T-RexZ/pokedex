<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();

	if (isset($_POST["reg_submit"])) {
		include_once("connection.php");
		$email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_email"])));
		$password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_pw"])));
		$name = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_name"])));
		$phone = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_phone"])));
		
		//hvis email er tom så kommer der en besked om at den skal udfyldes og hvis email ikke har @ så siger den ugyldig email
		if (empty($_POST["reg_email"])) {
			die(header("location: hallo.php?em=0"));
			} 
			else {
				$email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["reg_email"])));
				// check if e-mail address is well-formed
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
				{
				  die(header("location: hallo.php?em=00"));
				}
			}
			
		//hvis password er tom så kommer der en besked om at den skal udfyldes
		if (empty($_POST["reg_password"])) {
			die(header("location: hallo.php?pa=0"));
		}
		else {
			//password skal være over 3 tegn 
			if(strlen($_POST["reg_password"]) <= 3) {
				die(header("location: hallo.php?pa=00"));
			}
		}
		
		//hvis name er tom så kommer der en besked om at den skal udfyldes	
		if (empty($_POST["reg_name"])) {
			die(header("location: hallo.php?na=0"));
		}
		else {
		$name = ($_POST["reg_name"]);
		//checker om navn kun indeholder bogstaver og mellemrun
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				die(header("location: hallo.php?na=00")); 
			}
		}
		
		//har jeg ikke fået til at virke
		if(preg_match("/^((\(?\+45\)?)?)(\s?\d{2}\s?\d{2}\s?\d{2}\s?\d{2})$/", $phone)) {	
			die(header("location: hallo.php?ph=1")); 
		}else{
			die(header("location: hallo.php?ph=0")); 	
		}

		$options = ['cost' => 11, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),];
		$password = password_hash($password, PASSWORD_BCRYPT, $options);

		$sql = "INSERT INTO users (user_email, user_password, user_name, user_phone) VALUES ('$email', '$password', '$name', '$phone')";

		if ($query = mysqli_query($dbc, $sql)) {
			mysqli_close($dbc);
			die(header("location: hallo.php"));
		}else{
			mysqli_close($dbc);
			die(header("location: hallo.php"));
		}
	}else {
		die(header("location: hallo.php"));
	}
?>