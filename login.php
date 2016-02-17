<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	//tjækker om der er blevet postet
	if (isset($_POST["login_submit"])) {
		include_once("../connection.php");
		//fjerner tags som kan bruges til injections
		$email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["login_email"])));
		$password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["login_pw"])));
		$sql = "SELECT user_id, user_email, user_password FROM users WHERE user_email = '$email' LIMIT 1";
		//connecter til db
		if ($query = mysqli_query($dbc, $sql)) {
			$row = mysqli_fetch_assoc($query);
			$user_id = $row["user_id"];
			$db_email = $row["user_email"];
			$db_password = $row["user_password"];
		}
		//sammenliner om den indtastede email og emailen fra db er ens, sammenliner det hashet passerword med det password der er blevet indtastet, tjekker og der er blevet indtastet noget
		if ($email == $db_email && password_verify($password, $db_password) && !empty($email) && !empty($password)) {
			$_SESSION["user_id"] = $user_id;
			//lukker db connection
			mysqli_close($dbc);
			die(header("location: user.php"));
		}else{
			mysqli_close($dbc);
			die(header("location: index.php?log=0"));
		}
	}else {
		die(header("location: index.php?sub=0"));
	}
?>
