<?php

//echo "Anmol Garg";
$filedata = file_get_contents('php://input',true);
$arr = json_decode($filedata);
$method = $arr->method;
$request = $arr->request;
$requestJson = json_decode($request);

$var = "";
switch($method)
{
case "loginUser";
$var = loginUser($requestJson);
break;
case "userSignUp";
$var = userSignUp($requestJson);
break;
case "addEntryToDb";
$var = addEntryToDb($requestJson);
break;
case "deleteEntries";
$var = deleteEntries();
break;
}

echo $var;

function loginUser($requestJson)
{
	include 'register.php';
	return callLoginUser($requestJson);
}

function userSignUp($requestJson)
{
	include 'register.php';
	return signUpUser($requestJson);
}
function addEntryToDb($requestJson)
{
	include 'dataCollection.php';
	return addEntryToDatabase($requestJson);
}

function deleteEntries()
{
	include "dataCollection.php";
	return deleteAllEntries();
}


?>
