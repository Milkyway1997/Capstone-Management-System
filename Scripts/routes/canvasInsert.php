<?php
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

$body = getJson();
$id = $body['uniqueID'];
$name =$body['name'];

$sql = "INSERT INTO users (unique_id, name) 
VALUES ('$id', '$name')
-- WHERE '$name' NOT IN (select name from users)";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
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

<html>

<H1>Hello</H1>

</html>