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
        $getGroups = "SELECT * FROM group_users_view";


        //Gets all groups
        $groupsResult = mysqli_query($conn, $getGroups);

        $groupID = array();
        $leader = array();
        $memberOne = array();
        $memberTwo = array();
        $memberThree = array();
        $memberFour = array();
        $memberFive = array();

        $count = 0;
        while($row = $groupsResult->fetch_assoc()) {
             $groupID[$count] = $row["group_id"];
             $leader[$count] = $row["leader_id"];
             $memberOne[$count] = $row["member_1"];
             $memberTwo[$count] = $row["member_2"];
             $memberThree[$count] = $row["member_3"];
             $memberFour[$count] = $row["member_4"];
             $memberFive[$count] = $row["member_5"];
            $count += 1;
        }

        $groupData = array('groupID' => $groupID, 'leader' => $leader, 'memberOne' => $memberOne, 'memberTwo' => $memberTwo,
            'memberThree' => $memberThree, 'memberFour' => $memberFour, 'memberFive' => $memberFive);
        echo json_encode($groupData);



        $conn -> close();


    }
    else {
        echo "Connection not established. <br>";
    }

?>

