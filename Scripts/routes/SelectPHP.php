<?php
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


$sql = "SELECT DISTINCT unique_id, name FROM users";
$result = $conn->query($sql);

//response($result);
//print json_encode($result)
$jsonArray =array();
while($row = mysqli_fetch_assoc($result)){
    $row_array['uniqueId'] = $row['unique_id'];
    $row_array['name'] = $row['name'];
    array_push($jsonArray,$row_array);
}

print json_encode($jsonArray);


$conn->close();



?>
