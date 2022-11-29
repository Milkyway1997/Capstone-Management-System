<?php
    $sv = $_SESSION["user_id"];

    header("Content-Type: Application/json");
    $servername = "localhost";
    $username = "liul16";
    $password = 'GTERE%%#$DEE';
    $dbname = "liul16";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //Get sender id
    $sql = "SELECT DISTINCT id FROM users WHERE unique_id = '$sv'";
    $result= $conn->query($sql);
    $jsonArray =array();
    while($row = mysqli_fetch_assoc($result)){
        $row_array['id'] = $row['id'];
        array_push($jsonArray,$row_array);
    }
    
    $sender_id = $jsonArray[0]['id'];

    //Get group id
    $sql2 = "SELECT DISTINCT group_id from group_users_view WHERE member_1 = '$sender_id' OR
    member_2 = '$sender_id' OR member_3 = '$sender_id' OR member_4 = '$sender_id'
     OR member_5 = '$sender_id' OR leader_id ='$sender_id'";
    $result2 = $conn->query($sql2);

    $jsonArray2 =array();
    while($row = mysqli_fetch_assoc($result2)){
    $row_array2['group_id'] = $row['group_id'];
    array_push($jsonArray2,$row_array2);
    }
    $gid = $jsonArray2[0]['group_id'];

    //Get reciever_id
    $data = getJson();
    $student = $data['student'];

    $sql0 = "SELECT DISTINCT id FROM users WHERE unique_id = '$student'";
    $result0= $conn->query($sql0);
    $jsonArray0 =array();
    while($row = mysqli_fetch_assoc($result0)){
        $row_array0['id'] = $row['id'];
        array_push($jsonArray0,$row_array0);
    }
    
    $id = $jsonArray0[0]['id'];
    //$time = date("F j, Y, g:i a");
    $sql1 = "INSERT INTO invitations (receiver_id, sender_id, group_id)
        VALUES ($id, $sender_id, $gid)";
    // $sql1 = "INSERT INTO users (unique_id, name)
    // VALUES ('liu15', 'Liu Liu')";
    if ($conn->query($sql1) === TRUE) {
        echo "invite successfully";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }


     $conn->close();


     function getJson() {
        $jsonStringIn = file_get_contents('php://input');
        $json = array();
        $response = array();
        try {
           $json = json_decode($jsonStringIn,true);
           return $json;
        }
        catch (Exception $e) {
           header("HTTP/1.0 500 Invalid content -> probably invalid JSON format");
           $response['status'] = "fail";
           $response['message'] = $e->getMessage();
           print json_encode($response);
           exit;
        }
     }
    
?>

    