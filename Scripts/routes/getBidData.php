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
        $getBids = "SELECT * FROM bids";

        //Gets all bids
        $bidsResult = mysqli_query($conn, $getBids);

        $bidID = array();
        $projectID = array();
        $groupID = array();
        $timestamp = array();
        $priority = array();

        $count = 0;
        while($row = $bidsResult->fetch_assoc()) {
             $bidID[$count] = $row["bid_id"];
             $projectID[$count] = $row["project_id"];
             $groupID[$count] = $row["group_id"];
             $timestamp[$count] = $row["timestamp"];
             $priority[$count] = $row["priority"];
            $count += 1;
        }

        $bidData = array('bidID' => $bidID, 'projectID' => $projectID, 'groupID' => $groupID,
            'timestamp' => $timestamp, 'priority' => $priority);
        echo json_encode($bidData);



        $conn -> close();


    }
    else {
        echo "Connection not established. <br>";
    }

?>

