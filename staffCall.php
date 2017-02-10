<?php
		require ("db_connect.php");

		$sql = "SELECT idStaff,name,County,Region FROM staff";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        	echo'<label id="'. $row["idStaff"].'" class="btn '.$row["Region"].'" draggable="true" 
		        							ondragstart="drag(event)" onclick="openstocktake(this.id)">'
		        			 
		        			 . $row["name"].' <br>'.$row["County"].', '.$row["Region"].'</label>';
		    }
		} else {
		    echo "0 results";
		}

		mysqli_close($conn);
?>