
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

$sql1 = "DELETE FROM invitations WHERE receiver_id = '$id'";
if ($conn->query($sql1) === TRUE) {
    echo "Refused";
} else {
    echo "Error: " . $sql5 . "<br>" . $conn->error;
}

$conn->close();



?>
