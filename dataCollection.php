<?php

function addEntryToDatabase($requestJson){
	
	include "config.php";
	
	$latitude = $requestJson->latitude;
	$longitude = $requestJson->longitude;
	$accelerometerX = $requestJson->accelerometerX;
	$accelerometerY = $requestJson->accelerometerY;
	$accelerometerZ = $requestJson->accelerometerZ;
	$magnetometerX = $requestJson->magnetometerX;
	$magnetometerY = $requestJson->magnetometerY;
	$magnetometerZ = $requestJson->magnetometerZ;
	$so2 = $requestJson->SO2;
	$co = $requestJson->CO;
	$username = $requestJson->username;
	$timestamp = $requestJson->timestamp;
	$gpsSpeed = $requestJson->gpsSpeed;
	$activity = $requestJson->activity;
	$COBaseline = $requestJson->COBaseline;
	$SO2Baseline = $requestJson->SO2Baseline;
	//$tiaGain = $requestJson->tia_gain;
	//$responseRatio = $requestJson->responseRatio;
	//$serialNumber = $requestJson->serialNumber;
	$coRaw = $requestJson->CO_Raw;
	$so2Raw = $requestJson->SO2_Raw;
	
	$sql = "INSERT INTO pollutiondata (TimeStamp, User, Latitude, Longitude, AccelerometerX, AccelerometerY, AccelerometerZ, MagnetometerX, MagnetometerY, MagnetometerZ, SO2, SO2_Raw, CO, CO_Raw, GPSSpeed, Activity, COBaseline, SO2Baseline) VALUES ($timestamp, $username, $latitude, $longitude, $accelerometerX, $accelerometerY, $accelerometerZ, $magnetometerX, $magnetometerY, $magnetometerZ, $so2, $so2Raw, $co, $coRaw, $gpsSpeed, '$activity', $COBaseline, $SO2Baseline)";

	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
}

function deleteAllEntries(){
	
	include "config.php";
	
	$sql = "DELETE FROM `pollutiondata` WHERE 1";
	if (mysqli_query($conn, $sql)) {
		echo "Records deleted successfully";
	} else {
		echo "Error deleting record: " . mysqli_error($conn);
	}

	mysqli_close($conn);
}

?>