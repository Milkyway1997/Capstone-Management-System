
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

// $sql0 = "SELECT DISTINCT id FROM users WHERE unique_id = '$sv'";
// $result0= $conn->query($sql0);
// $jsonArray0 =array();
// while($row = mysqli_fetch_assoc($result0)){
//     $row_array0['id'] = $row['id'];
//     array_push($jsonArray0,$row_array0);
// }


// $id = $jsonArray0[0]['id'];

// $sql = "SELECT DISTINCT group_id, leader_id FROM groups WHERE leader_id = '$id'";
// $result = $conn->query($sql);

// $jsonArray =array();
// while($row = mysqli_fetch_assoc($result)){
//     $row_array['group_id'] = $row['group_id'];
//     $row_array['leader_id'] = $row['leader_id'];
//     array_push($jsonArray,$row_array);
// }

$sql = "SELECT DISTINCT group_id, leader_id, project_id from groups";
$result = $conn->query($sql);

//response($result);
//print json_encode($result)
$jsonArray =array();
while($row = mysqli_fetch_assoc($result)){
    $row_array['group_id'] = $row['group_id'];
    $row_array['leader_id'] = $row['leader_id'];
    $row_array['project_id'] = $row['project_id'];
    array_push($jsonArray,$row_array);
}

print json_encode($jsonArray);



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
