<?php

session_start();
include "./../config.php";
	$id = $_SESSION["id"];
	$sql="SELECT * FROM login WHERE Phone = '$id'";
	$result = $conn->query($sql);
if ($result->num_rows > 0) {
   $row = $result->fetch_assoc();
			echo "Hello ";
			echo $row["Name"];
}
if(isset($_GET['search']))
  {
	$valueToSearch = $_GET['date'];
	//echo "$valueToSearch";
	$query = "SELECT * FROM login WHERE Name = '".$valueToSearch."'";
    $search_result = filterTable($query);
	}
else{
	//echo "hello";
	$query = "SELECT * FROM login";
	$search_result = filterTable($query);
}

function filterTable($query)
{
echo "  ";
	$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);

$conn->query("use sensor_env");
$filter_Result = mysqli_query($conn,$query);

return $filter_Result;
}
?>

 <!DOCTYPE html>
<html>
<head>
<title>Select time stamp</title>

<style>
table,td,tr,th
{border:1px solid black;}
iframe,p
{margin: 0,200px;
}
</style>
</head>


<body>
<h1>HEAT MAP</h1>
	<form action = "filter.php" method "GET">
	Enter date :<br>
  <input type="date" name="date" ><br><br>
	<input type="submit" name = "search" value = "Filter"><br><br>
	
	<iframe src="https://savinasingla.carto.com/builder/203dff0e-179e-11e7-8e35-0e3ebc282e83/embed" name="iframe_a" width = "100%" height = "100%" ></iframe>
	</form>
</body>
</html>