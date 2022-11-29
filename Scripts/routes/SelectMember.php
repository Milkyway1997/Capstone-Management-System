
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

$sql1 = "SELECT DISTINCT group_id, leader_id FROM groups WHERE leader_id = '$id'";
$result1 = $conn->query($sql1);

$count = mysqli_num_rows($result1);
if($count >0){
$jsonArray1 =array();
while($row = mysqli_fetch_assoc($result1)){
    $row_array1['group_id'] = $row['group_id'];
    $row_array1['leader_id'] = $row['leader_id'];
    array_push($jsonArray1,$row_array1);
}
$gid = $jsonArray1[0]['group_id'];
$sql2 = "SELECT DISTINCT member_1, member_2, member_3,
            member_4, member_5 from group_users_view WHERE group_id = '$gid'";
$result2 = $conn->query($sql2);
$jsonArray2 =array();
while($row = mysqli_fetch_assoc($result2)){
    $row_array2['member_1'] = $row['member_1'];
    $row_array2['member_2'] = $row['member_2'];
    $row_array2['member_3'] = $row['member_3'];
    $row_array2['member_4'] = $row['member_4'];
    $row_array2['member_5'] = $row['member_5'];
    array_push($jsonArray2,$row_array2);
}

$m1 = $jsonArray2[0]['member_1'];
$m2 = $jsonArray2[0]['member_2'];
$m3 = $jsonArray2[0]['member_3'];
$m4 = $jsonArray2[0]['member_4'];
$m5 = $jsonArray2[0]['member_5'];

$sql = "SELECT DISTINCT id, name, unique_id from users WHERE id = '$m1' OR
    id = '$m2' OR id = '$m3' OR id = '$m4' OR id = '$m5'";
$result = $conn->query($sql);

$jsonArray =array();
while($row = mysqli_fetch_assoc($result)){
    $row_array['id'] = $row['id'];
    $row_array['unique_id'] = $row['unique_id'];
    $row_array['name'] = $row['name'];
    array_push($jsonArray,$row_array);
}
}else{
    // $sql = "SELECT DISTINCT member_1, member_2, member_3,
    // member_4, member_5 from group_users_view";
    $sql2 = "SELECT DISTINCT member_1, member_2, member_3,
            member_4, member_5, leader_id from group_users_view WHERE member_1 = '$id' OR
            member_2 = '$id' OR member_3 = '$id' OR member_4 = '$id' OR member_5 = '$id'";
    $result2 = $conn->query($sql2);
    
    $jsonArray2 =array();
    while($row = mysqli_fetch_assoc($result2)){
        if($row['member_1'] != $id){
        $row_array2['member_1'] = $row['member_1'];
        }
        if($row['member_2'] != $id){
        $row_array2['member_2'] = $row['member_2'];
        }
        if($row['member_3'] != $id){
        $row_array2['member_3'] = $row['member_3'];
        }
        if($row['member_4'] != $id){
        $row_array2['member_4'] = $row['member_4'];
        }
        if($row['member_5'] != $id){
        $row_array2['member_5'] = $row['member_5'];
        }
        $row_array2['leader_id'] = $row['leader_id'];
        array_push($jsonArray2,$row_array2);
    }

$m1 = $jsonArray2[0]['member_1'];
$m2 = $jsonArray2[0]['member_2'];
$m3 = $jsonArray2[0]['member_3'];
$m4 = $jsonArray2[0]['member_4'];
$m5 = $jsonArray2[0]['member_5'];
$ld = $jsonArray2[0]['leader_id'];

$sql = "SELECT DISTINCT id, name, unique_id from users WHERE id = '$m1' OR
    id = '$m2' OR id = '$m3' OR id = '$m4' OR id = '$m5' OR id = '$ld'";
$result = $conn->query($sql);

$jsonArray =array();
while($row = mysqli_fetch_assoc($result)){
    $row_array['id'] = $row['id'];
    $row_array['unique_id'] = $row['unique_id'];
    $row_array['name'] = $row['name'];
    array_push($jsonArray,$row_array);
}
}
print json_encode($jsonArray);


// $sql3 = "SELECT DISTINCT member_1, member_2, member_3,
//             member_4, member_5, leader_id from group_users_view WHERE member_1 = '$id' OR
//             member_2 = '$id' OR member_3 = '$id' OR member_4 = '$id' OR member_5 = '$id'";


// $getGroupByUI = "SELECT * FROM groups WHERE leader_id = '$sv'";
// $gp = $conn->query($getGroupByUI);
// if ($gp) {
//     $row = mysqli_fetch_array($gp,MYSQLI_ASSOC);
//     $leader_id = $row['leader_id'];
//     $count = mysqli_num_rows($gp);
//     if($count > 0) {
//         printf("You are a leader.");
//     }
//     else {
//         printf("You are not a leader.");
//     }
// }


$conn->close();



?>
