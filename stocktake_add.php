<!DOCTYPE HTML>
<html>
	<head>
		  <link rel="stylesheet" type="text/css" media="screen" href="css/form.css">

		<script>
		    window.onunload = refreshParent;
		    function refreshParent() {
		      window.opener.location.reload();
		    }
		</script>
	</head>
	<body>
		<div id="header">
			<img src="images/logo.png" >
		</div>

		<span style="clear:both;"><br></span>


		<form id="normaldiv" action="stocktake_addACTION.php" method="post">
		<h2> Modify Stocktake </h2>
						<?php 
							require ("db_connect.php");
							$id= $_GET['id'];

							$sql = "SELECT idStocktake,status,date,time,Comment, Supervisor_Staff_id,
											idStore,Store_id, 
											name,addressLine1,addressLine2,
											County,Region
									FROM stocktake,store where (Store_id=idStore) and (idStocktake='$id');";
							$SupervisorIsSet="No supervisor is assigned yet.";
							$result = mysqli_query($conn, $sql);
							//echo $result;
							if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_assoc($result)) {
							    // output data of each row
									if($row["Supervisor_Staff_id"]!= null)
										$SupervisorIsSet="Supervisor is assigned!";

							        echo'
										<label id="'. $row["idStocktake"].'" class="btn '.$row["status"].' '.$row["Region"].'">'  
					        			 . $row["name"].'<br></label> <i> » '.$SupervisorIsSet.'</i>	<br>

					        			  <input  value="'.$row["idStocktake"].'" type="text" name="id" hidden>	
					        			  <br>Stocktake date: 	
					        			  <br><input class="inputstyle" type="date" name="date" value='.$row["date"].'>
										  <br>Stocktake time: 	
										  <br><input class="inputstyle" type="time" name="time" value='.$row["time"].'>
										  <br>Comments: 			
										  <br><textarea class="inputstyle" name="comment">'.$row["Comment"].'</textarea>
					        			  ' ;
							    }
							} else {
							    echo "0 results";
							}

							mysqli_close($conn);

						?>
  					
  				
  				
  				

				<br><br>
  				<input class="inputstyle" type="submit" name="mybutton" value="Save"> <br>
				<input class="inputstyle" type="submit" name="mybutton" value="Confirm">


			
		</form>
				

		<div id="footer">
			<p>
				this is the footer of this page 2016.....
			</p>
		</div>
	</body>
</html>
