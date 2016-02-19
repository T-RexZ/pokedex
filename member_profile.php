<?php
	session_start();
	if(!isset($_SESSION["user_id"]))
	{
		die(header("location: index.php"));
	}

	include_once "../connection.php";

	$member_id = $_GET["id"];

	//Der skal joines med status senere
	$sql = "SELECT * FROM users
			INNER JOIN status 
			ON user_id = fk_user_id 
			INNER JOIN descriptions 
			ON fk_description_id = description_id
			WHERE user_id = " . $member_id;

	if ($query = mysqli_query($dbc, $sql)) 
	{
		$row = mysqli_fetch_assoc($query);
		$name = $row["user_name"];
		$email = $row["user_email"];
		$phone = $row["user_phone"];
		$img = $row["user_img"];
		$status_id = $row["status_id"];
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
        			echo '<img class="img-circle" src="img/profile_pic/' . $img . '" alt="profile image">';
        	
        
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

					 
        			echo '<span class="img-circle glyphicon ' . $status_description . '" style="background-color:' . $color . '"></span>';
        			
        		
        		
        	

        		?>
    		</div> 			
    		<!--	Status color	-->
        	<h1><?= $name ?></h1> 				
        	<!-- 	 name	-->
        	<?php echo '<a class="btn btn-success glyphicon glyphicon-envelope contact_button" href="mailto:' . $email . '"> ' . $email . '</a>  <!--	Mail	--> <br>';
        		  echo '<a class="btn btn-info glyphicon glyphicon-earphone contact_button" href="#"> ' . $phone . '</a>			<!--	Phone	-->';

        	?>
        </section>
	<script src="js/menu.js"></script>
    </body>
</html>
