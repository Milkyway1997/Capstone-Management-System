<?php
//session_start();
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

$sql0 = "SELECT DISTINCT id FROM users WHERE unique_id = '$sv'";
$result0= $conn->query($sql0);
$jsonArray0 =array();
while($row = mysqli_fetch_assoc($result0)){
    $row_array0['id'] = $row['id'];
    array_push($jsonArray0,$row_array0);
}

$id = $jsonArray0[0]['id'];
$sql1 = "SELECT DISTINCT group_id, leader_id, member_1,
    member_2, member_3, member_4, member_5
     FROM group_users_view WHERE leader_id = '$id'";
    $result1 = $conn->query($sql1);
    $count = mysqli_num_rows($result1);

    if($count >0){
        $jsonArray1 =array();
        while($row = mysqli_fetch_assoc($result1)){
            $row_array1['group_id'] = $row['group_id'];
            $row_array1['leader_id'] = $row['leader_id'];
            $row_array1['member_1'] = $row['member_1'];
            $row_array1['member_2'] = $row['member_2'];
            $row_array1['member_3'] = $row['member_3'];
            $row_array1['member_4'] = $row['member_4'];
            $row_array1['member_5'] = $row['member_5'];
            array_push($jsonArray1,$row_array1);
        }
            $m1=$jsonArray1[0]['member_1'];
            $m2=$jsonArray1[0]['member_2'];
            $m3=$jsonArray1[0]['member_3'];
            $m4=$jsonArray1[0]['member_4'];
            $m5=$jsonArray1[0]['member_5'];
        if(!empty($m1)){
        $sql2="UPDATE group_users_view SET leader_id = '$m1', member_1 = NULL WHERE leader_id = '$id'";
        $sql3="UPDATE groups SET leader_id = '$m1' WHERE leader_id = '$id'";
        // $sql4="INSERT groups (leader_id) VALUE($id)";
        // $sql5="INSERT group_users_view (leader_id) VALUE($id)";
        if ($conn->query($sql2) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
        if ($conn->query($sql3) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql3 . "<br>" . $conn->error;
        }
        // if ($conn->query($sql4) === TRUE) {
        //     echo "Leave group successfully";
        // } else {
        //     echo "Error: " . $sql4 . "<br>" . $conn->error;
        // }
        // if ($conn->query($sql5) === TRUE) {
        //     echo "Leave group successfully";
        // } else {
        //     echo "Error: " . $sql5 . "<br>" . $conn->error;
        // }
    }else if(!empty($m2)){
        $sql2="UPDATE group_users_view SET leader_id = '$m2', member_2 = NULL WHERE leader_id = '$id'";
        $sql3="UPDATE groups SET leader_id = '$m2' WHERE leader_id = '$id'";
        // $sql4="INSERT groups (leader_id) VALUE($id)";
        // $sql5="INSERT group_users_view (leader_id) VALUE($id)";
        if ($conn->query($sql2) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
        if ($conn->query($sql3) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql3 . "<br>" . $conn->error;
        }
        // if ($conn->query($sql4) === TRUE) {
        //     echo "Leave group successfully";
        // } else {
        //     echo "Error: " . $sql4 . "<br>" . $conn->error;
        // }
        // if ($conn->query($sql5) === TRUE) {
        //     echo "Leave group successfully";
        // } else {
        //     echo "Error: " . $sql5 . "<br>" . $conn->error;
        // }
    }else if(!empty($m3)){
        $sql2="UPDATE group_users_view SET leader_id = '$m3', member_3 = NULL WHERE leader_id = '$id'";
        $sql3="UPDATE groups SET leader_id = '$m3' WHERE leader_id = '$id'";
        // $sql4="INSERT groups (leader_id) VALUE($id)";
        // $sql5="INSERT group_users_view (leader_id) VALUE($id)";
        if ($conn->query($sql2) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
        if ($conn->query($sql3) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql3 . "<br>" . $conn->error;
        }
        // if ($conn->query($sql4) === TRUE) {
        //     echo "Leave group successfully";
        // } else {
        //     echo "Error: " . $sql4 . "<br>" . $conn->error;
        // }
        // if ($conn->query($sql5) === TRUE) {
        //     echo "Leave group successfully";
        // } else {
        //     echo "Error: " . $sql5 . "<br>" . $conn->error;
        // }
    }else if(!empty($m4)){
        $sql2="UPDATE group_users_view SET leader_id = '$m4', member_4 = NULL WHERE leader_id = '$id'";
        $sql3="UPDATE groups SET leader_id = '$m4' WHERE leader_id = '$id'";
        // $sql4="INSERT groups (leader_id) VALUE($id)";
        // $sql5="INSERT group_users_view (leader_id) VALUE($id)";
        if ($conn->query($sql2) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
        if ($conn->query($sql3) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql3 . "<br>" . $conn->error;
        }
        // if ($conn->query($sql4) === TRUE) {
        //     echo "Leave group successfully";
        // } else {
        //     echo "Error: " . $sql4 . "<br>" . $conn->error;
        // }
        // if ($conn->query($sql5) === TRUE) {
        //     echo "Leave group successfully";
        // } else {
        //     echo "Error: " . $sql5 . "<br>" . $conn->error;
        // }
    }else if(!empty($m5)){
        $sql2="UPDATE group_users_view SET leader_id = '$m5', member_5 = NULL WHERE leader_id = '$id'";
        $sql3="UPDATE groups SET leader_id = '$m5' WHERE leader_id = '$id'";
        // $sql4="INSERT groups (leader_id) VALUE($id)";
        // $sql5="INSERT group_users_view (leader_id) VALUE($id)";
        if ($conn->query($sql2) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
        if ($conn->query($sql3) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql3 . "<br>" . $conn->error;
        }
        // if ($conn->query($sql4) === TRUE) {
        //     echo "Leave group successfully";
        // } else {
        //     echo "Error: " . $sql4 . "<br>" . $conn->error;
        // }
        // if ($conn->query($sql5) === TRUE) {
        //     echo "Leave group successfully";
        // } else {
        //     echo "Error: " . $sql5 . "<br>" . $conn->error;
        // }
    }
    }else{
        $sql5 = "SELECT DISTINCT member_1, member_2, member_3,
            member_4, member_5 from group_users_view WHERE member_1 = '$id' OR
            member_2 = '$id' OR member_3 = '$id' OR member_4 = '$id' OR member_5 = '$id'";
    $result5 = $conn->query($sql5);
    
    $jsonArray5 =array();
    while($row = mysqli_fetch_assoc($result5)){
        $row_array5['member_1'] = $row['member_1'];
        $row_array5['member_2'] = $row['member_2'];
        $row_array5['member_3'] = $row['member_3'];
        $row_array5['member_4'] = $row['member_4'];
        $row_array5['member_5'] = $row['member_5'];
        array_push($jsonArray5,$row_array5);
    }

$m1 = $jsonArray5[0]['member_1'];
$m2 = $jsonArray5[0]['member_2'];
$m3 = $jsonArray5[0]['member_3'];
$m4 = $jsonArray5[0]['member_4'];
$m5 = $jsonArray5[0]['member_5'];
        if($m1===$id){
    $sql2="UPDATE group_users_view SET member_1 = NULL WHERE member_1 = '$id'";
    
    if ($conn->query($sql2) === TRUE) {
        echo "Leave group successfully";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
    }else if($m2===$id){
    $sql2="UPDATE group_users_view SET member_2 = NULL WHERE member_2 = '$id'";
    
    if ($conn->query($sql2) === TRUE) {
        echo "Leave group successfully";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
    }else if($m3===$id){
        $sql2="UPDATE group_users_view SET member_3 = NULL WHERE member_3 = '$id'";
        
        if ($conn->query($sql2) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    }else if($m4===$id){
        $sql2="UPDATE group_users_view SET member_4 = NULL WHERE member_4 = '$id'";
        
        if ($conn->query($sql2) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    }else if($m5===$id){
        $sql2="UPDATE group_users_view SET member_5 = NULL WHERE member_5 = '$id'";
        
        if ($conn->query($sql2) === TRUE) {
            echo "Leave group successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    }
    }

$data = getJson();
$sender = $data['sender'];

$sql2 = "SELECT DISTINCT id FROM users WHERE name = '$sender'";
$result2 = $conn->query($sql2);

$jsonArray2 =array();
while($row = mysqli_fetch_assoc($result2)){
    $row_array2['id'] = $row['id'];
    array_push($jsonArray2,$row_array2);
}
$sender_id = $jsonArray2[0]['id'];

$test="test";

$sql3 = "SELECT DISTINCT leader_id, member_1, member_2, member_3, member_4, member_5 
FROM group_users_view WHERE leader_id = '$sender_id' OR member_1 = '$sender_id'
OR member_2 = '$sender_id' OR member_3 = '$sender_id' OR member_4 = '$sender_id' OR member_5 = '$sender_id'";
$result3 = $conn->query($sql3);

$jsonArray3 =array();
while($row = mysqli_fetch_assoc($result3)){
    $row_array3['leader_id'] = $row['leader_id'];
    $row_array3['member_1'] = $row['member_1'];
    $row_array3['member_2'] = $row['member_2'];
    $row_array3['member_3'] = $row['member_3'];
    $row_array3['member_4'] = $row['member_4'];
    $row_array3['member_5'] = $row['member_5'];
    array_push($jsonArray3,$row_array3);
}
$leader_id = $jsonArray3[0]['leader_id'];
$m1 = $jsonArray3[0]['member_1'];
$m2 = $jsonArray3[0]['member_2'];
$m3 = $jsonArray3[0]['member_3'];
$m4 = $jsonArray3[0]['member_4'];
$m5 = $jsonArray3[0]['member_5'];


if(empty($m1)){
$sql4 = "UPDATE group_users_view SET member_1 = '$id' WHERE leader_id = '$leader_id'";
 if ($conn->query($sql4) === TRUE) {
    echo "Join group successfully";
} else {
    echo "Error: " . $sql4 . "<br>" . $conn->error;
}
$sql5="SELECT group_id FROM groups WHERE leader_id = '$leader_id'";
$result = $conn->query($sql5);
$row = mysqli_fetch_assoc($result);
$gid = $row['group_id'];
$sql6="UPDATE users SET group_id = '$gid' WHERE id = '$id'";
if ($conn->query($sql6) === TRUE) {
    echo "Join group successfully";
} else {
    echo "Error: " . $sql6 . "<br>" . $conn->error;
}
}else if(empty($m2)){
    $sql4 = "UPDATE group_users_view SET member_2 = '$id' WHERE leader_id = '$leader_id'";
     if ($conn->query($sql4) === TRUE) {
        echo "Join group successfully";
    } else {
        echo "Error: " . $sql4 . "<br>" . $conn->error;
    }
    $sql5="SELECT group_id FROM groups WHERE leader_id = '$leader_id'";
    $result = $conn->query($sql5);
    $row = mysqli_fetch_assoc($result);
    $gid = $row['group_id'];
    $sql6="UPDATE users SET group_id = '$gid' WHERE id = '$id'";
    if ($conn->query($sql6) === TRUE) {
        echo "Join group successfully";
    } else {
        echo "Error: " . $sql6 . "<br>" . $conn->error;
    }
}else if(empty($m3)){
    $sql4 = "UPDATE group_users_view SET member_3 = '$id' WHERE leader_id = '$leader_id'";
     if ($conn->query($sql4) === TRUE) {
        echo "Join group successfully";
    } else {
        echo "Error: " . $sql4 . "<br>" . $conn->error;
    }
    $sql5="SELECT group_id FROM groups WHERE leader_id = '$leader_id'";
    $result = $conn->query($sql5);
    $row = mysqli_fetch_assoc($result);
    $gid = $row['group_id'];
    $sql6="UPDATE users SET group_id = '$gid' WHERE id = '$id'";
    if ($conn->query($sql6) === TRUE) {
        echo "Join group successfully";
    } else {
        echo "Error: " . $sql6 . "<br>" . $conn->error;
    }
}else if(empty($m4)){
    $sql4 = "UPDATE group_users_view SET member_4 = '$id' WHERE leader_id = '$leader_id'";
     if ($conn->query($sql4) === TRUE) {
        echo "Join group successfully";
    } else {
        echo "Error: " . $sql4 . "<br>" . $conn->error;
    }
    $sql5="SELECT group_id FROM groups WHERE leader_id = '$leader_id'";
    $result = $conn->query($sql5);
    $row = mysqli_fetch_assoc($result);
    $gid = $row['group_id'];
    $sql6="UPDATE users SET group_id = '$gid' WHERE id = '$id'";
    if ($conn->query($sql6) === TRUE) {
        echo "Join group successfully";
    } else {
        echo "Error: " . $sql6 . "<br>" . $conn->error;
    }
}else if(empty($m5)){
    $sql4 = "UPDATE group_users_view SET member_5 = '$id' WHERE leader_id = '$leader_id'";
     if ($conn->query($sql4) === TRUE) {
        echo "Join group successfully";
    } else {
        echo "Error: " . $sql4 . "<br>" . $conn->error;
    }
    $sql5="SELECT group_id FROM groups WHERE leader_id = '$leader_id'";
    $result = $conn->query($sql5);
    $row = mysqli_fetch_assoc($result);
    $gid = $row['group_id'];
    $sql6="UPDATE users SET group_id = '$gid' WHERE id = '$id'";
    if ($conn->query($sql6) === TRUE) {
        echo "Join group successfully";
    } else {
        echo "Error: " . $sql6 . "<br>" . $conn->error;
    }
}
//print json_encode($jsonArray);

$sql3 = "DELETE FROM invitations WHERE receiver_id = '$id'";
if ($conn->query($sql3) === TRUE) {
    echo "Refused";
} else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
}
$sql4 = "DELETE FROM group_users_view WHERE leader_id = '$id'";
if ($conn->query($sql4) === TRUE) {
    echo "deleted";
} else {
    echo "Error: " . $sql4. "<br>" . $conn->error;
}
$sql5 = "DELETE FROM groups WHERE leader_id = '$id'";
if ($conn->query($sql5) === TRUE) {
    echo "deleted";
} else {
    echo "Error: " . $sql5. "<br>" . $conn->error;
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
