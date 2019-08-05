<?php
	session_start();
	if(!isset($_SESSION["type"]) || $_SESSION["type"] != 1 )
	{
		die("Access Denied!");
	}
	if(isset($_SESSION["message"])){
		echo "<div class= \"alert alert-primary\" role=\"alert\">";
		echo $_SESSION["message"];	
		echo "</div>";
		unset($_SESSION["message"]);
	}	
	if(isset($_POST["field"]) && !empty($_POST["field"]) && isset($_POST["company"]) && !empty($_POST["company"]) && isset($_POST["city"]) && !empty($_POST["city"]) && isset($_POST["stipend"]) && !empty($_POST["stipend"]) ){
		require_once "pdo.php";
		$sql="INSERT INTO INTERNSHIPS (FIELD,CITY,COMPANY,STIPEND,OWNER) VALUES (:field , :city , :company , :stipend , :owner);";
		$stmt=$pdo->prepare($sql);
		$stmt->execute(array(
							":field"=>htmlentities($_POST["field"]),
							":city"=>htmlentities($_POST["city"]),
							":company"=>htmlentities($_POST["company"]),
							":stipend"=>htmlentities($_POST["stipend"]),
							":owner"=>htmlentities($_POST["owner"]) ));
		$_SESSION["message"]="Internship Posted";
		header("Location: dashboard.php");
		return ;		
	}
	else if( (isset($_POST["field"]) && empty($_POST["field"])) ||  (isset($_POST["company"]) && !empty($_POST["company"])) ||  (isset($_POST["city"]) && !empty($_POST["city"]) ) || ( isset($_POST["stipend"]) && !empty($_POST["stipend"]) ) ){
			$_SESSION["message"]='Please Enter the details in all the fields before submitting.';
			header("Location: add.php");
			return;
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

    <title>Add intenrships</title>
  </head>
  <body>
  	<div class="container text-center">
	    <h1 class="display-1">Fill the details of the Internship</h1>
	</div>
	<div class="container"> 	
		<form method="post">
			<div class="form-group">
				<label for="field">Field</label>
				<input type="text" class="form-control" name="field"  id="field"><br>
			</div>
			<div class="form-group">
				<label for="city">City</label>
				<input type="text" class="form-control" name="city" id="city"><br>
			</div>
			<div class="form-group">
				<label for="company">Company</label>
				<input type="text" class="form-control" name="company" id="company"><br>
			</div>
			<div class="form-group">
				<label for="company">Stipend</label>
				<input type="text" class="form-control" name="stipend" id="stipend"><br>
			</div>
				<input type="hidden" name="owner" value=<?= $_SESSION["user_id"]?> >
				<input type="submit" class="btn btn-primary" value="Add "> 
		</form>	
	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
