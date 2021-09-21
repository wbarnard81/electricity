<?php

    $db = 'dbname';
    $username = 'dbuser';
    $password = 'password';
    $server = 'localhost';
    $errors = array('dbMeter' => '');

    $conn = mysqli_connect($server, $username, $password, $db);

    if(!$conn){
        echo 'Connection Error: ' . mysqli_connect_error();
    }

    if(isset($_POST['submit'])){
		// check dbMeter input
		if(empty($_POST['dbMeter'])){
            $errors['dbMeter'] = 'A meter reading is required.';
		} else {
            $dbMeter = $_POST['dbMeter'];
			if(!is_numeric($dbMeter)){
                $errors['dbMeter'] = 'Meter reading can only be a number.';
			}
		}

        //get last record in db, if any
        $lastRecordReading;
        $sql = "SELECT * FROM data WHERE id=(SELECT MAX(id) FROM data)";
        $result = mysqli_query($conn, $sql);
	    $lastRecord = mysqli_fetch_all($result, MYSQLI_ASSOC);
	    
        if(!$lastRecord){
            $lastRecordReading = $_POST['dbMeter'];
        } else {
            $lastRecordReading = $lastRecord[0]['meter_reading'];
        }

		if(array_filter($errors)){
			//echo 'errors in form';
		} else {
			// escape sql chars
			$dbMeter = mysqli_real_escape_string($conn, $_POST['dbMeter']);
			$unitsPurchased = mysqli_real_escape_string($conn, $_POST['units_purchased']);
			// create sql
			$sql = "INSERT INTO data(previous_meter_reading,meter_reading,units_purchased) VALUES('$lastRecordReading','$dbMeter', '$unitsPurchased')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
                if(isset($_POST['units_purchased'])){
                    $addedUnits = intval($lastRecordReading) + intval($_POST['units_purchased']);
                    $lastId = mysqli_insert_id($conn);
                    $sql = "UPDATE data SET previous_meter_reading = $addedUnits WHERE id = $lastId";
                    mysqli_query($conn, $sql);
                }
				// header('Location: index.php');
                // mysqli_free_result($result);
                // mysqli_close($conn);
			} else {
				echo 'Query Error: '. mysqli_error($conn);
			}

		}

        
	} // end POST check
    
?>