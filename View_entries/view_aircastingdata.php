<?php
include "./../config.php";
$sql="SELECT * FROM aircastingdata WHERE 1";
$result = mysqli_query($conn,$sql);
$count=0;
if ($result->num_rows > 0) {
	echo "<table border=1>";
	echo "<tr><th> S.No. </th><th> Timestamp </th><th>User </th><th> Latitude </th><th> Longitude </th><th> Humidity </th><th> Temperature </th><th> PM2.5</th></tr>";
	while($row = $result->fetch_assoc()) {
		$count++;
		echo "<tr><td> $count </td> <td>" . $row['Timestamp_Epoch'] . "</td><td>". $row['Username']."</td><td>". $row['Latitude']."</td><td>". $row['Longitude']."</td><td>". $row['Humidity']."</td><td>". $row['Temperature']."</td><td>". $row['PM25']."</td></tr>";
    }
	echo "</table>";
}
else{
	echo "No database found";
}

?>