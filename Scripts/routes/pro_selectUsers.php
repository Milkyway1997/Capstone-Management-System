
<?php
//session_start();
$ins_uniqueId = $_SESSION["instructor_id"];


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

$sql = "SELECT DISTINCT name, unique_id from users";
$result = $conn->query($sql);

$jsonArray =array();
while($row = mysqli_fetch_assoc($result)){
    $row_array['name'] = $row['name'];
    $row_array['unique_id'] = $row['unique_id'];
    array_push($jsonArray,$row_array);
}

print json_encode($jsonArray);


$conn->close();



?>
