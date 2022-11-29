
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

$sql = "SELECT DISTINCT project_name, max_size, project_description from projects";
$result = $conn->query($sql);

$jsonArray =array();
while($row = mysqli_fetch_assoc($result)){
    $row_array['project_name'] = $row['project_name'];
    $row_array['max_size'] = $row['max_size'];
    $row_array['project_description'] = $row['project_description'];
    array_push($jsonArray,$row_array);
}

print json_encode($jsonArray);

$conn->close();



?>
