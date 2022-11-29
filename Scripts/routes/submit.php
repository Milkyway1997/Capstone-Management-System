<?php
    //Displays errors on webpage for testing
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Connects to database
    $db_host = "127.0.0.1";
    $db_user = "liul16";
    $db_pass = "GTERE%%#\$DEE";
    $db_database = "liul16";
    $db_port = "3306";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_database);

    if($conn) {
        //Information about the project and group are sent through POST
        $projectID = (int)$_POST['projectID'];
        $groupID = (int)$_POST['groupID'];
        $priority = (int)$_POST['priority'];
 
        
        //Inserts the given information in the bids table
        $bid = "INSERT INTO bids (project_id, group_id, timestamp, priority) VALUES ($projectID, $groupID, NOW(), $priority)";
        if (!mysqli_query($conn, $bid)) {
            printf("Error message: %s\n", mysqli_error($link));
        }


        $conn -> close();


    }
    else {
        echo "Connection not established. <br>";
    }
?>