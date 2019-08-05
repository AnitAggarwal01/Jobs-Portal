<?php
	session_start();
	if(isset($_SESSION["user_id"]))
	{
		$_SESSION["message"]="Already Logged In";
		header("Location: home.php");
		return;
	}
	if( (isset($_POST["email"]) && !empty($_POST["email"]) ) && ( isset($_POST["pass"]) && !empty($_POST["pass"]) )){
		require_once 'pdo.php' ;
		$sql="Select * from users where email =:email;";
		$stmt=$pdo->prepare($sql);
		$stmt->execute(array(
							":email"=>htmlentities($_POST["email"])));
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		if( $_POST["pass"] == $row["password"] ){
			$_SESSION["message"]='Login Successful';
			$_SESSION["user_id"]=$row["user_id"];
			$_SESSION["type"]=$row["type_id"];
			if($_SESSION["type"]==1)
			{
				header("Location: dashboard.php");
				return ;
			}
			else if($_SESSION["type"]==2)
			{
				header("Location: home.php");
				return ;	
			}
		}
		else
		{
			echo("ERROR!");
		}

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

    <title>Log In</title>
  </head>
  <body>

    <div class="container">
		<h1 class="display-3 text-center">Please Enter your Log In credentials</h1>
	    <form method='post'>	
	    	<div class="row">
				<div class="form-group col-xs-12 col-sm-6">
					<label for="loginId">Login ID</label>
					<input type="email" class="form-control" name="email" id="loginId">
				</div>																
				<div class="form-group col-xs-12 col-sm-6">
					<label for="pass">Password</label>
					<input type="password" class= "form-control" name="pass"id="pass">
				</div>															
			</div>											
		<input type="submit" class="btn btn-primary" value="Log In">
		</form>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>