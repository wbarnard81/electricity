<?php

    include('config/db_connect.php');

    $sql = 'SELECT * FROM data';

    $result = mysqli_query($conn, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    mysqli_close($conn);

    $file = 'data.json';

    $prevMeter = 0;
    $dbMeter = $_POST['dbMeter'] ?? '';

    $dbMeter = trim($dbMeter);

    if($dbMeter) {
        $currentTime =  time();
        if(file_exists('data.json')) {

            //Get current data of JSON first
            $json = file_get_contents($file);
            //convert to associative array
            $jsonArray = json_decode($json, true);
            $prevMeter = $jsonArray[array_keys($jsonArray)[count($jsonArray) - 1]]["dbMeter"] ?? 0;
        } else {
            $jsonArray = [];
        }
        //add data to array
        $jsonArray[] = ['date' => $currentTime, 'prevMeter' => $prevMeter, 'dbMeter' => $dbMeter];
        //convert to json and save to file
        file_put_contents('data.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
    }

    header('Location: index.php');