<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Opret dig</title>
    </head>
    
    <body>
    	<h1>Opret dig som bruger</h1>
        <form action="validation.php" method="post">
            <label>Email</label>
            <input type="email" name="reg_email" placeholder="Email">
            <?php 
				if(isset($_GET["em"])){
					//hvis email er tom echoer den nedenstående
					if($_GET["em"] == 0){
						echo "Du skal udfylde email";
					}
					//hvis der er fejl så echoer den nedenstående
					else if($_GET["em"] == 00){
						echo "Ugyldig email";
					}
				} 
			?>
            <label>Password</label>
            <input type="password" name="reg_password" placeholder="Password">
            <?php 
				if(isset($_GET["pa"])){
					//hvis password er tom echoer den nedenstående
					if($_GET["pa"] == 0){
						echo "Du skal udfylde kodeord";
					}
					//hvis der er fejl så echoer den nedenstående
					else if($_GET["pa"] == 00){
						echo "Kodeord skal indeholde mindst 4 tegn";
					}
				} 
			?>
            <label>Name</label>
            <input type="text" name="reg_name" placeholder="Name">
            <?php 
				if(isset($_GET["na"])){
					//hvis navn  er tom echoer den nedenstående
					if($_GET["na"] == 0){
						echo "Du skal udfylde navn";
					}
					//hvis der er fejl så echoer den nedenstående
					else if($_GET["na"] == 00){
						echo "Navn må ikke indeholde tal";
					}
				} 
			?>
            <label>Phone</label>
            <input type="text" name="reg_phone" placeholder="Phone">
            <input type="submit" name="reg_submit" value="Opret">
        </form>
    </body>
</html>