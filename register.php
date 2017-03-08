<?php

function callLoginUser($requestJson){
	
	include "config.php";
	
	$phone = $requestJson->phone;
	$password = $requestJson->password;
	
	$sql = "SELECT * FROM `login` WHERE `Phone` = '".$phone."' AND `Password` = '".$password."'";
	$result = mysqli_query($conn,$sql); 
	$return_arr = array();
	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc())
		{
			$return_arr['Login'] = 1;
			$return_arr['Name'] = $row['Name'];
			$return_arr['phone'] = $phone;
		}
	}
	else{
		$return_arr['Login'] = 0;
	}
	$returnJson = json_encode($return_arr);
	return $returnJson;
}

function signUpUser($requestJson){
	
	include "config.php";
	
	$name = $requestJson->name;
	$email = $requestJson->email;
	$phone = $requestJson->phone;
	$password = $requestJson->password;
	$height = $requestJson->height;
	$weight = $requestJson->weight;
	$age = $requestJson->age;
	$gender = $requestJson->gender;
	
	$sql = "SELECT * FROM `login` WHERE `Phone` = '".$phone."'";
	$result = mysqli_query($conn,$sql); 
	$return_arr = array();
	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc())
		{
			$return_arr['alreadyExists'] = 1;
		}
	}
	else{
		$sql2="INSERT INTO `login` (`Name`, `Email`, `Phone`, `Password`, `Height(cms)`, `Weight(kgs)`, `Age`, `Gender`) VALUES ('$name', '$email', '$phone', '$password', '$height', '$weight', '$age', '$gender')";
		if (mysqli_query($conn,$sql2))
		{
			$return_arr["signUp"] = 1;
			$return_arr["name"] = $name;
			$return_arr["phone"] = $phone;
		}
		$return_arr['alreadyExists'] = 0;
	}
	$returnJson = json_encode($return_arr);
	return $returnJson;
}

?>