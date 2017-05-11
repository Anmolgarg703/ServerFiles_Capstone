<?php

include "./../config.php";
$query = "SELECT a.Username, a.Timestamp_Epoch, a.Latitude, a.Longitude, a.Humidity, a.Temperature, a.PM25, p.SO2, p.CO, p.Activity from aircastingdata a inner join pollutiondata p on (a.Username=p.User and a.Timestamp_Epoch=p.TimeStamp)";
$result = mysqli_query($conn,$query);
if (!$result) die('Couldn\'t fetch records');
$headers = $result->fetch_fields();
foreach($headers as $header) {
    $head[] = $header->name;
}
$fp = fopen('php://output', 'w');

if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="export.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, array_values($head)); 
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}
?>