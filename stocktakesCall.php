<?php
		require ("db_connect.php");

		$sql = "SELECT idStocktake,status,date,Store_id, 
						name,addressLine1,addressLine2,County,Region
				FROM stocktake,store where (Store_id=idStore)";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        if($row["status"] == "New")
		        	echo'<label id="'. $row["idStocktake"].'"
		        			 class="btn '.$row["status"].' '.$row["Region"].'"
		        			 draggable="true" ondragstart="drag(event)" onclick="openstocktake(this.id)">'
		        			 
		        			 . $row["name"].'<br></label>';
		    }
		} else {
		    echo "0 results";
		}

		mysqli_close($conn);
?>