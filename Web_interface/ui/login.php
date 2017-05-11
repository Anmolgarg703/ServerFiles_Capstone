<?php
session_start();
include "./../config.php";
$id=$_GET['username'];
$password=$_GET['password'];
$_SESSION['id'] = $id;
$sql="SELECT * FROM login WHERE Phone = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if($row["Password"]==$password){
			echo "valid  Password";
		header('Location: filter.php');
		
			exit;
		}
        else{
			
			echo "Invalid  Password";
		}
    }
} else {
    echo "Username not found";
}


?>