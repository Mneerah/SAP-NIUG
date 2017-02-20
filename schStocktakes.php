
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
				if( ev.target.className=='daylong'){
					    ev.target.appendChild(document.getElementById(data));

					    if ( document.getElementById(data).classList.contains('New'))
					    	document.getElementById(data).classList.remove('New');
						if( document.getElementById(data).classList.contains('Confirmed'))
							document.getElementById(data).classList.remove('Confirmed');
					    if(document.getElementById(data).classList.contains('Pending'))
					    	document.getElementById(data).classList.remove('Pending');
					    document.getElementById(data).classList.add('Temp')
					}					    
					ev.preventDefault();
				}
				function openstocktake(st_id){
					window.open('stocktake_add.php?id='+st_id+'&date=?', "ADD-STOCKTAKE", "width=500,height=500");				    
				}
				//-------------------------display regions ---------------------------------
				function onlyConnacht(){ 
					regionVisibility('Connacht','visible');
					regionVisibility('Leinster','hidden');
					regionVisibility('Munster','hidden');
					regionVisibility('Ulster','hidden');
				}
				function onlyLeinster(){ 
					regionVisibility('Leinster','visible');
					regionVisibility('Connacht','hidden');
					regionVisibility('Munster','hidden');
					regionVisibility('Ulster','hidden');
				}
				function onlyMunster(){ 
					regionVisibility('Munster','visible');
					regionVisibility('Connacht','hidden');
					regionVisibility('Leinster','hidden');
					regionVisibility('Ulster','hidden');
				}
				function displayAllRegions(){ 
					regionVisibility('Munster','visible');
					regionVisibility('Connacht','visible');
					regionVisibility('Leinster','visible');
					regionVisibility('Ulster','visible');
				}
				//----------------main diplay hide method------------------------------------
				function regionVisibility(classname, value){
					var cols = document.getElementsByClassName(classname);
					  for(i=0; i<cols.length; i++) {
					    cols[i].style.visibility = value;
					  } 
				}
				//---------------------------------------------------------------------------
			</script>
	</head>
	<body id="body">

		<div id="header">
			<img src="images/logo.png"  /> &nbsp;&nbsp;
			<a class="logout" style="float:right; " href="#logout"> Logout</a> 
			<ul class="navigation">
			  <li><a href="#clients" >Clients</a></li>
			  <li><a href="#stores">Stores</a></li>
			  <li ><a href="home.php" class="activeTab" >Home</a></li>
			  <li><a href="#staff">Staff</a></li>
			  <li><a href="schStocktakes.php" >Stocktakes</a></li>
			</ul>
							
				
		</div>

		<span style="clear:both;"><br></span>

		<div id="leftdiv">
			<div style="text-align:center;">
				<a href="#Connacht" id="ConnachtLink" onclick="onlyConnacht()">Connacht</a> |
				<a href="#Leinster" id="LeinsterLink" onclick="onlyLeinster()">Leinster</a> | 
				<a href="#Munster" id="MunsterLink" onclick="onlyMunster()">Munster</a> | 
				<a href="#All" id="AllRegionsLink" onclick="displayAllRegions()">All</a>
</div>
			<h4> New Stocktakes</h4>
			<div id="tasks">
				<?php
				include ("stocktakesCall.php");
				?>
			</div>
		</div>

		<div id="rightdiv" >
			<div id="calbox" >
					<?php
							$dia = date ("d"); $mes = date ("n"); $ano = date ("Y");
							if($dia[0]=='0') $dia=substr($dia, -1);

							if (isset($_GET["dia"])){
								//($_GET["dia"] && $_GET["mes"] && $_GET["ano"]) {
								$dia = $_GET["dia"]; $mes = $_GET["mes"]; $ano = $_GET["ano"];
							} 

						//include the WeeklyCalClass and create the object !!
						include ("stocktakeCalClass.php");
						$calendar = new EasyWeeklyCalClass ($dia, $mes, $ano);
						echo $calendar->showCalendar ();
						//$today=strtotime("today");$day= date("d", $today); $month=date("m", $today); $year=date("Y", $today);
						//echo date("Y-m-d", $today) . "<br>".$day."/".$month."/".$year."<br>";
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
