
<!DOCTYPE HTML>
<html>
	<head>
		  <link rel="stylesheet" type="text/css" media="screen" href="css/form.css">

			<script>
				function allowDrop(ev) {
				    ev.preventDefault();
				}

				function drag(ev) {
				    ev.dataTransfer.setData( Text, ev.target.id);
				}

				function drop(ev) {
				    var data = ev.dataTransfer.getData(Text);
				    ev.target.appendChild(document.getElementById(data));
				    if ( document.getElementById(data).classList.contains('New'))
				    	document.getElementById(data).classList.remove('New');
					if( document.getElementById(data).classList.contains('Confirmed'))
						document.getElementById(data).classList.remove('Confirmed');
				    if(document.getElementById(data).classList.contains('Pending'))
				    	document.getElementById(data).classList.remove('Pending');
				    document.getElementById(data).classList.add('Temp')
				    //document.getElementById(data).style.background="#c5690b";
				    ev.preventDefault();

				    //new code
				    //var x= ev.target.id;
				     //window.open('stocktake_add.php?id='+data+'&date='+x+'?', "ititi", "width=500,height=500");				    
				    
				}
				function openstocktake(st_id){
					//var data = ev.dataTransfer.getData(Text);

					window.open('stocktake_add.php?id='+st_id+'&date=?', "ititi", "width=500,height=500");				    

				}

			</script>
	</head>
	<body id="body">

		<div id="header">
			<img src="images/logo.png"  /> &nbsp;&nbsp;
			<div class="logout" style="float:right; "> Logout</div>
			<div class="navigation" >
			<b> Customers | Stores | <img src="images/home.png"/> | Stocktakes | Staff </b>
			</div> 
				
				
		</div>

		<span style="clear:both;"><br></span>

		<div id="leftdiv">
			<div style="text-align:center;"> <a href="#Connacht" >Connacht</a> |
<a href="#Leinster" >Leinster</a> | <a href="#Munster" >Munster</a> | <a href="#All" >All</a>
</div>
			<h4> Staff</h4>
			<div id="tasks">
				<?php
				include ("staffCall.php");
				?>
			</div>
		</div>

		<div id="rightdiv" >
			<div id="calbox" >
					<?php

						//include and create the object !!
						include ("schStaff_dayJobs.php");
						$calendar = new dayJobs ($_GET['dayName'], $_GET['day'],$_GET['month'], $_GET['year']);
						echo $calendar->showCalendar ();

					?>		

			</div>
		</div>

		<div id="footer">
			<p>
				this is the footer of this page 2016.....
			</p>
		</div>
	</body>
</html>