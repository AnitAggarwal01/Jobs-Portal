<?php
	session_start();
	if(!isset($_SESSION["type"]) || $_SESSION["type"]!=1)
	{
		die("Access Denied");
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

    <title>Applications</title>
  	<style>
  		.mt-4 {
			  margin-top: ($spacer * 1.5) !important;
		}

  	</style>
  </head>
  <body >
	<div class="container ">
		
			<h1 class="display-1 text-center ">Current Applications</h1>
		<?php
		require_once "pdo.php";
		$sql="SELECT * from INTERNSHIPS where owner=:owner_id";
		$stmt=$pdo->prepare($sql);
		$stmt->execute(array(":owner_id"=>$_SESSION["user_id"]));

		while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
			
			$sql1="SELECT username ,email from USERS join APPLICATIONS join INTERNSHIPS on USERS.user_id=APPLICATIONS.user_id and INTERNSHIPS.internship_id=APPLICATIONS.internship_id where owner=:user and INTERNSHIPS.internship_id=:internship_id";
			$stmt1=$pdo->prepare($sql1);
			$stmt1->execute(array(
				":user"=>$_SESSION["user_id"],
				":internship_id"=>$row["internship_id"]));
			echo ("<div class=\"row justify-content-center\">
				  	<div class=\"col-xs-12 col-lg-4 border border-primary  mt-4 \">");
						echo("<p class=\"lead\">Field:       ".htmlentities($row["field"])."</p>");
						echo("<p class=\"lead\">City:        ".htmlentities($row["city"])."</p>");
						echo("<p class=\"lead\">Company:     ".htmlentities($row["company"])."</p>");
						echo("<p class=\"lead\">Stipend:     ".htmlentities($row["stipend"])."</p>");				
				echo "</div>";
				echo "<div class=\"col-xs-12 col-push-2 col-lg-6 mt-4 text-center \">" ;
					echo "<table class=\"table table-striped \">
							<thead class=\"thead-dark\">
								<tr>
									<th>Username</th>
									<th>Email</th>
								</tr></thead>"."\n";
						echo "<tbody>";
					while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)){
						echo("<tr><td>");
						echo($row1["username"]);
						echo("</td><td>");
						echo($row1["email"]);
						echo("</td></tr>\n");
		
			}
						echo("</tbody>");
					echo "</table>";
				echo("</div>");
			echo("</div>");

		}

		
?>

	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>