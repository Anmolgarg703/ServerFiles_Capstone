<?php
include "./../config.php";
$sql="SELECT * FROM pollutiondata WHERE 1";
$result = mysqli_query($conn,$sql);
$count=0;
if ($result->num_rows > 0) {
	echo "<table border=1>";
	echo "<tr><th> S.No. </th><th> Timestamp </th><th>User </th><th> Latitude </th><th> Longitude </th><th> CO </th><th> SO2</th></tr>";
	while($row = $result->fetch_assoc()) {
		$count++;
		echo "<tr><td> $count </td> <td>" . $row['TimeStamp'] . "</td><td>". $row['User']."</td><td>". $row['Latitude']."</td><td>". $row['Longitude']."</td><td>". $row['CO']."</td><td>". $row['SO2']."</td></tr>";
    }
	echo "</table>";
}
else{
	echo "No database found";
}

?>