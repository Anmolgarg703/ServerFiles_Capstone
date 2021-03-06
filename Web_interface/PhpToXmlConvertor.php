<?php

session_start();
include "config.php";

$user = "";
$user= $_SESSION["id"];
//echo $users;
$fromDate = $_SESSION["fromDate"];
$toDate = $_SESSION["toDate"];
$fromTimestamp = strtotime($fromDate);
$toTimestampStart = strtotime($toDate);
$toTimestamp = $toTimestampStart + 86400;

header('Content-type: text/xml');

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

$query = "SELECT * FROM pollutiondata WHERE `User`=$user AND `TimeStamp`>=$fromTimestamp AND `TimeStamp`<=$toTimestamp";
$result = mysqli_query($conn, $query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

while ($row = mysqli_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("User",$row['User']);
  //$newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("CO", $row['CO']);
  $newnode->setAttribute("SO2", $row['SO2']);
  $newnode->setAttribute("latitude", $row['Latitude']);
  $newnode->setAttribute("longitude", $row['Longitude']);
}

echo $dom->saveXML();

?>