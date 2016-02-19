<?php
	session_start();
	/*if(!isset($_SESSION["user_id"]))
	{
		die(header("location: index.php"));
	}*/

	include_once "../connection.php";

	class Member
	{
		private $id;
		private $name;
		private $image;
		private $status_id;
		private $status_description;
		private $message;

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
		public function setStatusId($status)
		{
			$this->status_id = $status;
		}

		//Set status 
		public function setStatusDescription($desc)
		{
			$this->status_description = $desc;
		}

		//Set message
		public function setMessage($message)
		{
			$this->message = $message;
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

		//Get profile status id
		public function getStatusId()
		{
			return $this->status_id;
		}

		//Get status description
		public function getStatusDescription()
		{
			return $this->status_description;
		}

		//Get message
		public function getMessage()
		{
			return $this->message;
		}
	}


	//Join status
		$sql = "SELECT * FROM users
			INNER JOIN status 
			ON user_id = fk_user_id 
			INNER JOIN descriptions 
			ON fk_description_id = description_id
			INNER JOIN messages
			ON message_id = fk_message_id";

			
		

 	$member_list = array();

	if ($query = mysqli_query($dbc, $sql)) 
	{

		while($row = mysqli_fetch_assoc($query))
		{
			$member = new Member;

			$member->setId($row["user_id"]);
			$member->setName($row["user_name"]);
			$member->setImage($row["user_img"]);
			$member->setStatusId($row["status_id"]);
			$member->setStatusDescription($row["description_text"]);
			$member->setMessage($row["message_text"]);

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
        <section id="member_list">
        	<?php

        	foreach ($member_list as $member) 
        	{


				$color = "";

        			switch ($member->getStatusId()) 
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

				echo '<div class="individual_member">';
				echo '<div class="member_wrapper">';
			    echo '<img onclick="show_message(this)" class="img-circle members_profile_image" src="img/profile_pic/' . $member->getImage() . '" alt="profile image">';       
        	    echo '<span class="img-circle glyphicon ' . $member->getStatusDescription() . '" style="background-color:' . $color . '"></span>';
        		echo '<h2>' . $member->getName() . '</h2>';
        		echo '<a class="btn btn-default"href="member_profile.php?id=' . $member->getId() . '">Se profil</a><br>'; 
        		echo '<textarea class="message_hidden" readonly>' . $member->getMessage() . '</textarea>';
        		echo "</div>";
        		echo "</div>";
        	}

        	?>
        </section>
	<script src="js/menu.js"></script>
	<script src="js/buttons.js"></script>
    </body>
</html>
