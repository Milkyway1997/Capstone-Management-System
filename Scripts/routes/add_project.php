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

    $body = getJson();
    $name =$body['name'];
    $des = $body['description'];
    $size = $body['num'];
    
    $sql = "INSERT INTO projects (instructor_id, project_name,max_size,project_description)
    VALUES (3, '$name', $size,'$des')";
    
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