<?php
	session_start();
	if( (isset($_POST["username"])&&!empty($_POST["username"])) && (isset($_POST["email"])&&!empty($_POST["email"])) && (isset($_POST["password"])&&!empty($_POST["password"])) && (isset($_POST["usertype"])&&!empty($_POST["usertype"])) ){
		require_once "pdo.php";
		$sql='Insert into users (username, email, password, type_id) values(:username, :email, :password, :type)';
		$stmt=$pdo->prepare($sql);
		$stmt->execute(array(
							':username'=>htmlentities($_POST["username"]),
							':email'=>htmlentities($_POST["email"]),
							':password'=>htmlentities($_POST["password"]),
							':type'=>htmlentities($_POST["usertype"])));
		$_SESSION["message"]='Account created';
		header("Location: home.php");
		return ;
	}
	else if( (isset($_POST["username"])&&empty($_POST["username"])) || (isset($_POST["email"])&&empty($_POST["email"])) || (isset($_POST["password"])&&empty($_POST["password"])) || (isset($_POST["usertype"])&&empty($_POST["usertype"])) ){
		$_SESSION["message"]='Enter credentials properly!';
		header("Location: signup.php");
		return ;
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

    <title>Sign Up</title>
  </head>
  <body>
    <div class="container">
	    <h1 class="display-1 text-xs-center">Please Enter your Details</h1>
	    <form method='post'>																	
		<div class="form-group">
			<label for="username">UserName</label>										
			<input type="text" class="form-control" name="username" id="username">									
		</div>																
		<div>
			<label for="email">Email ID<?= "   "?></label>																	
			<input type="email"  class="form-control" name="email" id="email">
		</div>															
		<div>																			
			<label type="password">Password</label>
			<input type="password"  class="form-control" name="password" id="password">
		</div>			
		<select name="usertype" >
			<option value="1">Employer</option>
	  	  	<option value="2">Student</option>
	    </select>												
		<input type="submit" class="btn btn-primary" value="Sign Up">
		</form>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>

