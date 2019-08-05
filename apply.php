<?php
	session_start();
	if(isset($_SESSION["type"]) && $_SESSION["type"]!= 2)
	{
		$_SESSION["message"]="Please Sign In using a student account to apply.";
		header("Location: home.php");
		return;
	}
	else if(!isset($_SESSION["type"]))
	{
		header("Location: login.php");
		return ;
	}
	if(isset($_GET))
	{
		require_once "pdo.php";
		$query=$pdo->query("SELECT * FROM APPLICATIONS");
		while ( $row=$query->fetch(PDO::FETCH_ASSOC) ) {
			if( $_SESSION["user_id"]==$row["user_id"] && $_GET["internship_id"]==$row["internship_id"] ){
					$_SESSION["message"]='You have already applied for this internship.Multiple Applications are not allowed';
					header("Location: home.php");
					return ;
			}		
		}
	}
	if(isset($_POST["apply"])){
		require_once "pdo.php";
		$sql="INSERT INTO APPLICATIONS (internship_id,user_id) values (:internship_id , :user_id)";

		$stmt=$pdo->prepare($sql);
		$stmt->execute(array(
								":internship_id"=>htmlentities($_POST["internship_id"]),
								":user_id"=>htmlentities($_SESSION["user_id"])));
		$_SESSION["message"]="Successfully Applied";
		header("Location: home.php");
		return;
	}
	else if(isset($_POST["cancel"])){
		header("Location: home.php");
		return ;
	}
	else if (!isset($_GET["internship_id"]))
	{
		die("Access Denied!");
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>Confirmation</title>
  </head>
  <body>
  	<div class="container">
  		<?php
 			if(isset($_GET["internship_id"])){
				echo ("<h1 class=\"display-4\">Are you sure you want to apply for the internship with following details:-</h1>");
				require_once "pdo.php";
				$sql="SELECT * FROM INTERNSHIPS WHERE internship_id=:internship_id";
				$stmt=$pdo->prepare($sql);
				$stmt->execute(array(":internship_id"=>$_GET["internship_id"]));
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
				echo("<p class=\"lead\">Field:       ".htmlentities($row["field"])."</p>");
				echo("<p class=\"lead\">City:        ".htmlentities($row["city"])."</p>");
				echo("<p class=\"lead\">Company:     ".htmlentities($row["company"])."</p>");
				echo("<p class=\"lead\">Stipend:     ".htmlentities($row["stipend"])."</p>");
			}
  		?>
		<form method="POST">
			<input type="hidden" name="internship_id" value=<?= $_GET["internship_id"]?> >
			<input type="submit" class=" btn btn-primary" name="apply" value="Apply" >
			<input type="submit" class=" btn btn-primary" name="cancel" value="Cancel">
		</form>
	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
