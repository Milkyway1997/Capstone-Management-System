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
        //A group id is sent to this page and assigned to a variable
        $groupId = $_POST['groupID'];

        
        //Drops all bids who had the group id 
        $delete = "DELETE FROM bids WHERE group_id = $groupId";
        if (!mysqli_query($conn, $delete)) {
            printf("Error message: %s\n", mysqli_error($link));
        }


        $conn -> close();


    }
    else {
        echo "Connection not established. <br>";
    }
?>