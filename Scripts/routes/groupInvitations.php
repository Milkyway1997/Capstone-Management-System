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

$sql1 = "SELECT DISTINCT sender_id, group_id FROM invitations WHERE receiver_id = '$id'";
$result1 = $conn->query($sql1);

$count = mysqli_num_rows($result1);
if($count >0){
$jsonArray1 =array();
while($row = mysqli_fetch_assoc($result1)){
    $row_array1['sender_id'] = $row['sender_id'];
    $row_array1['group_id'] = $row['group_id'];
    array_push($jsonArray1,$row_array1);
}

$jsonArray =array();
 $sid0 = $jsonArray1[0]['sender_id'];
 $sid1 = $jsonArray1[1]['sender_id'];
 $sid2 = $jsonArray1[2]['sender_id'];
 $sid3 = $jsonArray1[3]['sender_id'];
 $sid4 = $jsonArray1[4]['sender_id'];
 $sid5 = $jsonArray1[5]['sender_id'];

$sql = "SELECT DISTINCT name, group_id from users WHERE id = '$sid0' OR id = '$sid1' OR id = '$sid2'
OR id = '$sid3' OR id = '$sid4' OR id = '$sid5'";
$result = $conn->query($sql);
while($row = mysqli_fetch_assoc($result)){
    $row_array['name'] = $row['name'];
    $row_array['group_id'] = $row['group_id'];
    array_push($jsonArray,$row_array);
}
print json_encode($jsonArray);
}

$conn->close();



?>
