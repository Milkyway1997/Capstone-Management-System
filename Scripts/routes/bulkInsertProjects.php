<?php
    //Displays errors on webpage for testing
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header("Content-Type: Application/json");

    //Connects to database
    $db_host = "127.0.0.1";
    $db_user = "liul16";
    $db_pass = "GTERE%%#\$DEE";
    $db_database = "liul16";
    $db_port = "3306";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_database);

    if($conn) {
        //Gets the content of uploaded csv file
        $content = file_get_contents($_FILES['projectFile']['tmp_name']);
        
        //Separate the csv file into an array of individual lines
        $lines = explode("\n", $content);

        //Loops through each line of the csv file
        for ($i = 0; $i < count($lines); $i++) {
            if($lines[$i] != "") {
                //Split each line by commas, assigning to variables the information in the line 
                $values = explode(",", $lines[$i]);
                $project_name = $values[0];
                $max_size = $values[1];
                $project_description = $values[2];

                //Insert into the SQL database what is contained in the current line
                //Note: did not use bulk insert because database permission was not granted to the user
                $insert = "INSERT INTO projects (project_name, max_size, project_description) VALUES ('$project_name', $max_size, '$project_description')";
                if ($conn->query($insert) === TRUE) {
                    echo "New record created successfully\n";
                } else {
                    echo "Error: " . $insert . "<br>" . $conn->error;
                }

            }
        }


        $conn -> close();


    }
    else {
        echo "Connection not established. <br>";
    }
?>