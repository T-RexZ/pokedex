<?php
	session_start();
	if(!isset($_SESSION["user_id"]))
	{
		die(header("location: index.php"));
	}

	include_once "../connection.php";

	$member_id = $_GET["id"];

	//Der skal joines med status senere
	$sql = "SELECT * FROM users WHERE user_id = " . $member_id;

	if ($query = mysqli_query($dbc, $sql)) 
	{
		$row = mysqli_fetch_assoc($query);
		$name = $row["user_name"];
		$email = $row["user_email"];
		$phone = $row["user_phone"];
		$img = $row["user_img"];
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
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

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
        		?>
        			<!--	Echo src fra PHP	-->
        		<div class="img-circle status_color">
        			<span class="glyphicon glyphicon-ok"></span>
        		</div> 			<!--	Status color	-->
        	</div>
        	<h1><?= $name ?></h1> 				<!-- 	 name	-->
        	<?php echo '<a class="btn btn-success" href="mailto:' . $email . '">' . $email . '</a>  <!--	Mail	--> <br>';
        		  echo '<a class="btn btn-info" href="#">' . $phone . '</a>			<!--	Phone	-->';

        	?>
        </section>
	<script src="js/menu.js"></script>
    </body>
</html>
