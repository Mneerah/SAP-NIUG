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


		<div id="normaldiv" >
		<h2> Modify Stocktake </h2>
						<?php 
							require ("db_connect.php");

							$id= $_POST['id'];
							$date = $_POST['date'];
							$time = $_POST['time'];
							$comment= $_POST['comment'];

							if($_POST['mybutton'] == 'Save')
							{
							  $status="Pending";
							}
							elseif($_POST['mybutton'] == 'Confirm')
							{
							  $status="Confirmed";
							}

							$sql = "UPDATE stocktake
									SET status='$status', date='$date', time='$time', Comment='$comment'
									WHERE idStocktake='$id';";

							//$result = mysqli_query($conn, $sql);

							if ($conn->query($sql) === TRUE) {
								echo "- Record updated successfully";
							} else {
							    echo "-Error updating record: " . $conn->error;
							}
							

							mysqli_close($conn);

						?>
			
		</div>
				

		<div id="footer">
			<p>
				this is the footer of this page 2016.....
			</p>
		</div>
	</body>
</html>
