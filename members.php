<?php
	session_start();
	if(!isset($_SESSION["user_id"]))
	{
		die(header("location: index.php"));
	}

	include_once "../connection.php";

	class Member
	{
		private $id;
		private $name;
		private $image;
		private $status;

		//Set id
		public function setId($id)
		{
			$this->id = $id;
		}

		//Set name
		public function setName($name)
		{
			$this->name = $name;
		}

		//Set profile image
		public function setImage($img)
		{
			$this->image = $img;
		}

		//Set status 
		public function setStatus($status)
		{
			$this->status = $status;
		}


		//Get id
		public function getId()
		{
			return $this->id;
		}

		//Get name
		public function getName()
		{
			return $this->name;
		}

		//Get profile image
		public function getImage()
		{
			return $this->image;
		}
	}


	//Join status
	$sql = "SELECT * FROM users"; 
			
			//INNER JOIN status
			//ON user_id = fk_user_id";

 	$member_list = array();

	if ($query = mysqli_query($dbc, $sql)) 
	{
		while($row = mysqli_fetch_assoc($query))
		{
			$member = new Member;

			$member->setId($row["user_id"]);
			$member->setName($row["user_name"]);
			$member->setImage($row["user_img"]);
			//$member->setName($row["fk_message_id"]);  //Skal ændres senere, så den henter selve beskrivelsen. Nu er det bare test

			array_push($member_list, $member);
		}
		
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
        <section id="member_list">
        	<?php

        	//Der skal styles med status og besked
        	foreach ($member_list as $member) 
        	{
        		echo '<div class="individual_member">';
        		echo '<img class="img-circle members_profile_image" src="img/profile_pic/' . $member->getImage() . '" alt="profile image">';       		
        		echo '<h2>' . $member->getName() . '</h2>';
        		echo '<a class="btn btn-default"href="member_profile.php?id=' . $member->getId() . '">Se profil</a>'; 
        		echo "</div>";
        	}

        	?>
        </section>
	<script src="js/menu.js"></script>
    </body>
</html>
