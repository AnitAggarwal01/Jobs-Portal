<?php
	session_start();	
	if(isset($_SESSION["message"])){
		echo "<div class= \"alert alert-primary\" role=\"alert\">";
		echo $_SESSION["message"];	
		echo "</div>";
		unset($_SESSION["message"]);
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

    <title>Internshala</title>
  	<style>
  		.mr-4 {
			  margin-right: ($spacer * 1.5) !important;
		}


  	</style>
 
  </head>
  <body class="text-center justify-content-center">
  	<div class="container ">
	    <h1 class="display-2 ">Welcome to Internshala</h1>
		
		<?php	
			echo "<p class=\"lead \">Available  Internships</h1>";
			require_once "pdo.php";
			$sql="SELECT * FROM INTERNSHIPS";
			$query=$pdo->query($sql);


			echo "<table class=\"table table-striped \">
					<thead class=\"thead-dark\">
						<tr>
							<th>Field</th>
							<th>City</th>
							<th>Company</th>
							<th>Stipend</th>
							<th>Action</th>
						</tr></thead>"."\n";
			echo "<tbody>";

			while($row=$query->fetch(PDO::FETCH_ASSOC)){
				echo("<tr>
						<td>");
				echo(htmlentities($row["field"]));
				echo("	</td>
					  	<td>");
				echo(htmlentities($row["city"]));
				echo("	</td>
						<td>");
				echo(htmlentities($row["company"]));
				echo("	</td>
						<td>");
				echo(htmlentities($row["stipend"]));
				echo("	</td>
						<td>");
				echo("<a href=\"apply.php?internship_id=".$row["internship_id"]."\" class=\"btn btn-primary text-white\" >Apply Now!</a>"."\n");
				echo("</td></tr>\n");
			} 
			echo "</tbody>";		
			echo("</table>");
		?>

	</div>
	<div class="container text- center">
		<div class=" row">
			<?php
				if(!isset($_SESSION["type"]))
				{
			?>
			<div class="col-xs-2 mr-4">
				<a href='signup.php' class="btn btn-primary text-white ">SignUp</a> 	
			</div>
			<div class="col-xs-2">
				<a href='login.php' class="btn btn-primary text-white ">Log In</a> 	
			<?php 
				}
				else{
			?>
					<a href='logout.php' class="btn btn-primary text-white ">Log Out</a> 	
				<?php
					}
				?>		
							
				</div>			
			</div>
	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
