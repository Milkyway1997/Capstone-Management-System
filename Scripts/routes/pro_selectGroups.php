
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



$sql = "SELECT group_users_view.group_id, group_users_view.leader_id,group_users_view.member_1,
group_users_view.member_2,group_users_view.member_3,group_users_view.member_4,group_users_view.member_5,
 group_concat(projects.project_name) as pro_name 
from group_users_view join bids on group_users_view.group_id = bids.group_id join projects 
on projects.project_id = bids.project_id group by bids.group_id";


$result = $conn->query($sql);
$count = mysqli_num_rows($result);
$jsonArray =array();

while($row = mysqli_fetch_assoc($result)){
    $lid = $row['leader_id'];
    $m1 = $row['member_1'];
    $m2 = $row['member_2'];
    $m3 = $row['member_3'];
    $m4 = $row['member_4'];
    $m5 = $row['member_5'];
   

    $sql1 = "SELECT DISTINCT name from users WHERE id = '$lid'";
    $result1 = $conn->query($sql1);
    while($row1 = mysqli_fetch_assoc($result1)){
        $row_array['leader_name'] = $row1['name'];
    }

    $sql2 = "SELECT DISTINCT name from users WHERE id = '$m1'";
    $result2 = $conn->query($sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $row_array['m1'] = $row2['name'];


    $sql3 = "SELECT DISTINCT name from users WHERE id = '$m2'";
    $result3 = $conn->query($sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $row_array['m2'] = $row3['name'];

    $sql4 = "SELECT DISTINCT name from users WHERE id = '$m3'";
    $result4 = $conn->query($sql4);
    $row4 = mysqli_fetch_assoc($result4);
    $row_array['m3'] = $row4['name'];

    $sql5 = "SELECT DISTINCT name from users WHERE id = '$m4'";
    $result5 = $conn->query($sql5);
    $row5 = mysqli_fetch_assoc($result5);
    $row_array['m4'] = $row5['name'];

    $sql6 = "SELECT DISTINCT name from users WHERE id = '$m5'";
    $result6 = $conn->query($sql6);
    $row6 = mysqli_fetch_assoc($result6);
    $row_array['m5'] = $row6['name'];

    $row_array['group_id'] = $row['group_id'];
    $row_array['m6'] = $row['pro_name']; 

    
    array_push($jsonArray,$row_array);
}

print json_encode($jsonArray);

$conn->close();



?>
