<?php

$file = 'data.json';

$meter = $_POST['meter'] ?? '';
$dbMeter = $_POST['dbMeter'] ?? '';

$meter = trim($meter);
$dbMeter = trim($dbMeter);

if($meter) {
    $currentTime =  time();
    if(file_exists('data.json')) {

        //Get current data of JSON first
        $json = file_get_contents($file);
        //convert to associative array
        $jsonArray = json_decode($json, true);
    } else {
        $jsonArray = [];
    }
    //add data to array
    $jsonArray[] = ['date' => $currentTime, 'meter' => $meter, 'dbMeter' => $dbMeter];
    //convert to json and save to file
    file_put_contents('data.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
    echo $json;
}

header('Location: index.php');