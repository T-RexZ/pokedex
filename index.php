<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();

	if(isset($_SESSION["errors"])){
		if (!empty($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
		}
	}
	session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#2D78BB">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
	<body class="container">
	<div class="row">

		<button class="btn btn-default" onclick="show_login()">
			I already have a login
		</button>

		<form id="login-form"  action="login.php" class="non-visible row form-group" method="post">

			<label for="login_email">Email Address</label>

			<input class="form-control" type="text" placeholder="email" name="login_email"></input><br>

			<label for="login_pw">Password</label>

			<input class="form-control" type="password" placeholder="password" name="login_pw"></input><br>

			<input class="btn btn-default" type="submit" name="login_submit"></input><br>

		</form>
 
		<button class="btn btn-default" onclick="show_register()">
			I dont have a login
		</button>

		<form id="register-form" action="reg.php" class="non-visible row form-group" method="post">
			
		    <label for="reg_email">Email address</label>
		    <?php
			    if (isset($errors)) {
			    	if (!empty($errors)) {
			    		echo "<p>" . $errors["email"] . "</p>";
			    	}
			    }  
		    ?>
			<input class="form-control" type="text" placeholder="email" name="reg_email"></input><br>

			<label for="reg_pw">Password</label>
			<?php
			    if (isset($errors)) {
			    	if (!empty($errors)) {
			    		echo "<p>" . $errors["password"] . "</p>";
			    	}
			    }  
		    ?>
			<input class="form-control" type="password" placeholder="password" name="reg_pw"></input><br>

			<label for="reg_rep_pw">Repeat password</label>
			
			<input class="form-control" type="password" placeholder="repeat password" name="reg_rep_pw"></input><br>

			<label for="reg_phone">Phone</label>
			<?php
			    if (isset($errors)) {
			    	if (!empty($errors)) {
			    		echo "<p>" . $errors["phone"] . "</p>";
			    	}
			    }  
		    ?>
			<input class="form-control" type="text" placeholder="phone number" name="reg_phone"></input><br>

			<label for="reg_name">Name</label>
			<?php
			    if (isset($errors)) {
			    	if (!empty($errors)) {
			    		echo "<p>" . $errors["name"] . "</p>";
			    	}
			    }  
		    ?>
			<input class="form-control" type="text" placeholder="name" name="reg_name"></input><br>

			<input class="btn btn-default" type="submit" name="reg_submit"></input><br>

		</form>

		<a href="about.php">What is PokeDex?</a>

	</div>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/buttons.js"></script>
	</body>
</html>
