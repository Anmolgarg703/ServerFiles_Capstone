<?php

//include "config.php";

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

$query = "SELECT Username, Latitude, Longitude, AVG(PM25) as `PM25` FROM aircastingdata WHERE `Username`=$user AND `TimeStamp_Epoch`>=$fromTimestamp AND `TimeStamp_Epoch`<=$toTimestamp GROUP BY Latitude, Longitude";
$result = mysqli_query($conn, $query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

/*$xml = new XMLWriter();

$xml->openURI("php://output");
$xml->startDocument();
$xml->setIndent(true);

$xml->startElement('markers');

while ($row = mysqli_fetch_assoc($result)) {
  $xml->startElement("marker");

  $xml->writeAttribute('User', $row['User']);
  //$xml->writeRaw($row['country']);
  $xml->writeAttribute('latitude', $row['Latitude']);
  $xml->writeAttribute('longitude', $row['Longitude']);

  $xml->endElement();
}

$xml->endElement();

//print $xml->asXML();
$xml->flush();*/

//header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
//$count = 0;
while ($row = mysqli_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("User",$row['Username']);
  //$newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("PM2.5", $row['PM25']);
  //$newnode->setAttribute("SO2", $row['SO2']);
  $newnode->setAttribute("latitude", $row['Latitude']);
  $newnode->setAttribute("longitude", $row['Longitude']);
}

echo $dom->saveXML();

?>