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
        $getUsers = "SELECT id, unique_id FROM users ORDER BY id";


        $usersResult = mysqli_query($conn, $getUsers);

        $id = array();
        $unique_id = array();


        $count = 0;
        while($row = $usersResult->fetch_assoc()) {
             $id[$count] = $row["id"];
             $unique_id[$count] = $row["unique_id"];
             $count += 1;
        }

        $userData = array('id' => $id, 'unique_id' => $unique_id);
        echo json_encode($userData);



        $conn -> close();


    }
    else {
        echo "Connection not established. <br>";
    }

?>

