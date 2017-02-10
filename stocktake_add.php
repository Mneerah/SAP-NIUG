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

							$sql = "SELECT idStocktake,status,date,idStore,Store_id, 
											name,addressLine1,addressLine2,County,Region
									FROM stocktake,store where (Store_id=idStore) and (idStocktake='$id');";

							$result = mysqli_query($conn, $sql);
							//echo $result;
							if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_assoc($result)) {
							    // output data of each row
							        echo'<label id="'. $row["idStocktake"].'"
					        			 class="btn '.$row["status"].' '.$row["Region"].'"
					        			  >'  . $row["name"].'<br></label> 					
					        			  <input  value="'.$row["idStocktake"].'" type="text" name="id" hidden>	';
							    }
							} else {
							    echo "0 results";
							}

							mysqli_close($conn);

						?>
  				<br>Stocktake date: 	<br>
					<input  type="date" name="date">	
  				
  				
  				<br>Stocktake time: 	<br>
					<input type="time" name="time">

  				

  				<br>Comments: <br>
  					<textarea name="comment">Enter text here...</textarea>
				

				<br><br>
  				<input type="submit" value="Send Offer">
				<input type="submit" value="Confirm">
				<input type="submit" value="Save Offer">


			
		</form>
				

		<div id="footer">
			<p>
				this is the footer of this page 2016.....
			</p>
		</div>
	</body>
</html>