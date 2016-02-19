<?php
	session_start();
	if(!isset($_SESSION["user_id"]))
	{
		die(header("location: index.php"));
	}

	include_once "../connection.php";

	$sql = "SELECT * FROM users
			INNER JOIN status 
			ON user_id = fk_user_id 
			INNER JOIN descriptions 
			ON fk_description_id = description_id
			WHERE user_id = " . $_SESSION["user_id"];

	if ($query = mysqli_query($dbc, $sql)) 
	{
		$row = mysqli_fetch_assoc($query);
		$name = $row["user_name"];
		$email = $row["user_email"];
		$phone = $row["user_phone"];
		$img = $row["user_img"];
		$status_id = $row["fk_description_id"];
		$status_description = $row["description_text"];
	}

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="theme-color" content="#2D78BB">
    	<meta name="mobile-web-app-capable" content="yes">
    	<meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">        
        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>
    <body>
        <header>
            <nav>
	            <section class="navbar">
	            </section>
	            <section class="hamburger">
	                <section class="material-design-hamburger">
	                    <button class="material-design-hamburger__icon">
	                        <span class="material-design-hamburger__layer"></span>
	                    </button>
	                </section>
		            <section class="menu menu--off">
		                
		                <button class="btn btn-default buttons" onclick="logout.php"></button>
		               
		                    
		            </section>
	            </section>
            </nav>    
        </header>
        <section class="container-fluid" id="profile">	

        	<div id="profile_image_wrapper">
        		<?php
        			
        			$color = "";

        			switch ($status_id) 
        			{
        				case 1:
        					$color = "#5cb85c";
        					break;
        				
        				case 2:
        					$color = "#d9534f";
        					break;

        				case 3:
        					$color = "#5bc0de";
        					break;

    					case 4:
	    					$color = "#f0ad4e";
	    					break;
        			}

					 echo '<img class="img-circle" src="../img/profile_pic/' . $img . '" alt="profile image">';
            
        
        			echo '<span class="img-circle glyphicon ' . $status_description . '" style="background-color:' . $color . '"></span>';
        			
        		
        		
        	
                ?>
			
    		<!--	Status color	-->
        	<h1><?= $name ?></h1> 				
        	<!-- 	 name	-->
        	<?php 
                  echo '<a class="btn btn-success contact_button" href="mailto:' . $email . '">' . $email . '</a> <br>';
        		  echo '<a class="btn btn-info contact_button" href="#">' . $phone . '</a>';


        	?>
        </section>
        <section id="profile_edit">
            <form id="register-form" action="update_profile.php" class="form-group" method="post" enctype="multipart/form-data">

            
            <label for="reg_email">Email address</label>
            <?php
                if (isset($errors)) {
                    if (!empty($errors)) {
                        echo "<p>" . $errors["email"] . "</p>";
                    }
                }  
            ?>
            <input class="form-control" type="email" placeholder="email" name="reg_email"></input><br>

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

            <label for="reg_img">Profile picture</label>
            <?php
                if (isset($errors)) {
                    if (!empty($errors)) {
                        echo "<p>" . $errors["file"] . "</p>";
                    }
                }  
            ?>
            <input class="btn btn-default" type="file" name="reg_img"></input>

            <input class="btn btn-default" type="submit" name="reg_submit"></input><br>

        </form>
        </section>
	<script src="js/menu.js"></script>
    </body>
</html>
