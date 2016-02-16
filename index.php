<?php
	

 ?>
<?php
	

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
	<body class="container max-40-vw">
	<div class="row">
		<button class="btn col-sm-12 max-40-vw" onclick="show_login()">
			I already have a login
		</button>
			
		

		<form id="login-form" action="login.php" class="col-sm-12 non-visible max-40-vw row" method="post">

			<input class="col-sm-12" type="text" placeholder="email" name="login_email"></input>
			
			<input class="col-sm-12" type="password" placeholder="password" name="login_pw"></input>
			
			
			
			<input class="btn" type="submit" name="login_submit"></input>
		</form>


		<button class="btn  col-sm-12 max-40-vw" onclick="show_register()">
			I dont have a login
		</button>

		<form id="register-form" action="rig.php" class="col-sm-12 non-visible container">
			

		</form>

	</div>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/buttons.js"></script>
	</body>
</html>
