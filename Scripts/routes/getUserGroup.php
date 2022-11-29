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
        $unique_id = $_SESSION['user_id'];
        $get_user_id = "SELECT DISTINCT id FROM users WHERE unique_id = '$unique_id'";
        $idResult = mysqli_query($conn, $get_user_id);
        $user_id = -1;
        while($row = $idResult->fetch_assoc()) {
            $user_id = $row["id"];
        }

        $group_id = -1;
        
        $getGroup = "SELECT group_id FROM group_users_view
                    WHERE leader_id = $user_id OR member_1 = $user_id OR member_2 = $user_id OR member_3=$user_id OR member_4 = $user_id OR member_5 = $user_id";
        $groupResult = mysqli_query($conn, $getGroup);
        while($row = $groupResult->fetch_assoc()) {
            $group_id = $row["group_id"];
        }

        echo json_encode($group_id);



        $conn -> close();


    }
    else {
        echo "Connection not established. <br>";
    }

?>

