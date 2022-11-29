
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

//Gets the id of the user in the database
$unique_id = $_SESSION['user_id'];
$get_user_id = "SELECT DISTINCT id FROM users WHERE unique_id = '$unique_id'";
$idResult = mysqli_query($conn, $get_user_id);
$user_id = -1;
while($row = $idResult->fetch_assoc()) {
    $user_id = $row["id"];
}

//Gets the group id of the user
$group_id = -1;

$getGroup = "SELECT group_id FROM group_users_view
            WHERE leader_id = $user_id OR member_1 = $user_id OR member_2 = $user_id OR member_3=$user_id OR member_4 = $user_id OR member_5 = $user_id";
$groupResult = mysqli_query($conn, $getGroup);
while($row = $groupResult->fetch_assoc()) {
    $group_id = $row["group_id"];
}

//Retrieves the Projects
$biddedProjects = "SELECT bids.bid_id, bids.priority, projects.project_name, projects.project_id, projects.project_description, projects.max_size FROM projects 
    INNER JOIN bids ON projects.project_id = bids.project_id
    WHERE bids.group_id = $group_id
    ORDER BY bids.priority";
$biddedResult = mysqli_query($conn, $biddedProjects);

//Retrieves the bids
$bidArray = Array();

if ($biddedResult->num_rows > 0) {
    while($row = $biddedResult->fetch_assoc()) {
        $row_array['project_id'] = $row['project_id'];
        $row_array['project_name'] = $row['project_name'];
        $row_array['priority'] = $row['priority'];
        array_push($bidArray, $row_array);
    }

} 
else {

}
//JSON Encode the array of bids
print json_encode($bidArray);

$conn->close();





?>
