<html>
	<head>
		<link rel="stylesheet" href="style.css">
		 <script type="text/javascript">
	function selectAll(selectBox,selectAll) {
		// have we been passed an ID
		if (typeof selectBox == "string") {
			selectBox = document.getElementById(selectBox);
		}
		// is the select box a multiple select box?
		if (selectBox.type == "select-multiple") {
			for (var i = 0; i < selectBox.options.length; i++) {
				selectBox.options[i].selected = selectAll;
			}
		}
	}
	</script>

	</head>

<body>
	<div id="field">
     <form name="frmdropdown" method="post" action="./../PhpToXmlConvertor.php">
	 
		<div id="Main">
			<h1 align="center"> Data </h1>
		</div>
        
			<h2> Select Username :</h2>
			<h2 style="margin:-45px 0 0 325px;"> Timestamp from  :</h2>
			<h2 style="margin:-26px 0 0 588px;"> Timestamp to  :</h2>
		
			
		<div id ="Users">
			<select id ="users" name="users[]" multiple size="2"> 
				 
					<?php
						include "./../../config.php";
				
						$res=mysqli_query($conn,"Select DISTINCT User from pollutiondata");
						while($r=mysqli_fetch_row($res))
					{ 
						echo "<option value='$r[0]'> $r[0] </option>";
					}
					?>
			</select>
					
		</div>
	
		<div id ="Timestamp1">
			<input id="t1" type="date" name="t1" value="2017-01-13"/>
		</div>
		
		<div id ="Timestamp2">
			<input id="t2" type="date" name="t2" value="2017-03-13"/>		
			<input type="time" name="timestamp" step="1">
		</div>
	
	<br />
		<input type="button" id="select_all" name="Button" value="All" onclick="selectAll('users',true)" />
		<input type="button" id="select_none" name="Button" value="None" onclick="selectAll('users',false)" />
	</div>
     <br><br>
	 
	  <button type="submit" class="button" >Submit</button>
	  
  </form>
 
 
</body>
</html>


