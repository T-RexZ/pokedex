<?php


		if (empty($_POST['username'])) {
			$errors[] = 'The username cannot be empty';

			}
			if (empty($_POST['password']) || empty($_POST['repeat_password'])) {
				$errors[] = 'The password cannot be empty';
			}
			if ($_POST['password'] !== $_POST['repeat_password']) {
				$errors[] = 'the passwords must match';
			}
	
			if (empty($errors)) {
		
				$username = mysqli_real_escape_string($link, $_POST['username']);
				$password = mysqli_real_escape_string($link, $_POST['password']);
				$password = sha1($password);
				$query = "INSERT INTO `profil` (`username`, `password`) VALUES ('$username', '$password')" or die('SQL register failed: ' . mysqli_error($link));


				mysqli_query($link, $query);
			
			}else{
				$_SESSION['errors'] = $errors;
			}

?>


<?php
	if(isset($_SESSION['errors']))
		if (empty($_SESSION['errors']) === false){
			?>
			<ul style="text-align: center; list-style-type: none;">
			<?php
				foreach ($_SESSION['errors'] as $error) {
					echo "<li>{$error}</li>";
				}
			?>
			</ul>
		<?php
		}
	}
?>