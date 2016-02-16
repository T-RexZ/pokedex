<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
	<body class="container max-40-vw">
	<div class="row">
		<button class="btn" onclick="show_login()">
			I already have a login
		</button>
			
		

		<form id="login-form" action="login.php" class="non-visible row" method="post">

			<input type="text" placeholder="email" name="login_email"></input>
			
			<br>

			<input type="password" placeholder="password" name="login_pw"></input>
			
			<br>
			
			<input class="btn" type="submit" name="login_submit"></input>

			<br>


		</form>


		<button class="btn" onclick="show_register()">
			I dont have a login
		</button>

		<form id="register-form" action="reg.php" class="non-visible row" method="post">
			
			<input type="text" placeholder="email" name="reg_email"></input>
			
			<br>

			<input type="password" placeholder="password" name="reg_pw"></input>
			
			<br>
			
			<input type"password" placeholder="repeat password" name="reg_rep_pw"></input>

			<br>

			<input type="text" placeholder="name" name="reg_name"></input>

			<br>

			<input type="text" placeholder="phone number" name="reg_phone"></input>

			<br>

			<input class="btn" type="submit" name="reg_submit"></input>

			<br>




		</form>

		

		<a href="about.php">What is PokeDex?</a>

	</div>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/buttons.js"></script>
	</body>
</html>
