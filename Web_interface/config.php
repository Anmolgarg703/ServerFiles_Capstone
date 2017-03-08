<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="Hazewatch";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error) {
	//echo "Error";
    die("Connection failed: " . $conn->connect_error);
}
?>