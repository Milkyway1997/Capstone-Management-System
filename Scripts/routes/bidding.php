<?php
    //Displays errors on webpage for testing
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'navbar.php';

    //Connects to database
    $db_host = "127.0.0.1";
    $db_user = "liul16";
    $db_pass = "GTERE%%#\$DEE";
    $db_database = "liul16";
    $db_port = "3306";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_database);

    if($conn) {
        //Use sql queries

        //Gets the group of the user
        $unique_id = $_SESSION['user_id'];
        $get_user_id = "SELECT DISTINCT id FROM users WHERE unique_id = '$unique_id'";
        $idResult = mysqli_query($conn, $get_user_id);
        $user_id = -1;
        while($row = $idResult->fetch_assoc()) {
            $user_id = $row["id"];
        }

        $group_id = -1;
        
        $getGroup = "SELECT group_id FROM group_users_view
                    WHERE leader_id = $user_id OR member_1 = $user_id OR member_2 = $user_id OR member_3=$user_id OR member_4 = $user_id OR member_5 = $user_id";
        $groupResult = mysqli_query($conn, $getGroup);
        while($row = $groupResult->fetch_assoc()) {
            $group_id = $row["group_id"];
        }

        //Retrieves the Projects
        $nonBiddedProjects = "SELECT DISTINCT projects.project_id, projects.project_name, projects.max_size, projects.project_description FROM projects 
            LEFT JOIN bids ON projects.project_id = bids.project_id 
            WHERE projects.project_id NOT IN 
            (SELECT projects.project_id FROM projects 
            INNER JOIN bids ON projects.project_id = bids.project_id
            WHERE bids.group_id = $group_id);";

        $biddedProjects = "SELECT bids.bid_id, bids.priority, projects.project_name, projects.project_id, projects.project_description, projects.max_size FROM projects 
            INNER JOIN bids ON projects.project_id = bids.project_id
            WHERE bids.group_id = $group_id
            ORDER BY bids.priority";
        $biddedResult = mysqli_query($conn, $biddedProjects);
        $nonbiddedResult = mysqli_query($conn, $nonBiddedProjects);


        $conn -> close();


    }
    else {
        echo "Connection not established. <br>";
    }

    if(isset($_POST['submit'])) {
        //Your SQL Query
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Bootstrap CDN for CSS and Javascript-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        
    <!-- Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Jquery UI-->
    <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
        crossorigin="anonymous">
    </script>

    <script src="drag"></script>


</head>

<body>
    


    <div class="container">
        <div class="row justify-content-between">
        <!-- Table for not bidded projects -->
            <div class="col-6">
                <div class="row">
                    <table class="table tables_ui" id="nonbid_table">
                        <tr>
                            <th>Not Ranked Projects </th>
                        </tr>
                        <tbody class="t_sortable">
                        <?php
                                if ($nonbiddedResult->num_rows > 0) {
                                    while($row = $nonbiddedResult->fetch_assoc()) {
                                        echo "<tr draggable = \"true\" class='toSubmit'>";
                                        echo "<td class=\"projectID\" hidden>" . $row["project_id"] . "</td>";
                                        echo "<td class=\"projectName\">" . $row["project_name"] . "</td>";
                                        echo "<td class=\"maxSize\">" . $row["max_size"] . "</td>";
                                        echo "  <td class=\"projectDescription\"> <button type='button' class='trigger_popup btn-secondary' 
                                                value='" . $row["project_description"] . "'>Project Description</button> </td>";
                                        echo "</tr>";
                                    }
                                } else {

                                }
                                if(isset($_POST["submit"])) {
                                    
                                }
                        ?>
                        <tr class="sort-disabled"><td></td></tr>                        
                        </tbody>
                    </table>
            </div>
            </div>




            <!-- Table for bidded projects -->
            <div class="col-6">
                <table class="table tables_ui" id="bid_table">
                    <thead>
                        <tr>
                            <th>Ranked Projects</th>
                        </tr>
                    </thead>
                    <tbody class="t_sortable">
                    <?php
                        if ($biddedResult->num_rows > 0) {
                            while($row = $biddedResult->fetch_assoc()) {
                                echo "<tr draggable=\"true\" class = 'toSubmit'>";
                                echo "<td class=\"projectID\" hidden>" . $row["project_id"] . "</td>";
                                echo "<td class=\"projectName\">" . $row["project_name"] . "</td>";
                                echo "<td class=\"maxSize\">" . $row["max_size"] . "</td>";
                                echo "  <td class=\"projectDescription\"> <button type='button' class='trigger_popup btn-secondary' 
                                        value='" . $row["project_description"] . "'>Project Description</button> </td>";                                
                                echo "</tr>";
                            }
    
                        } 
                        else {

                        }
                    ?>
                    <tr class="sort-disabled"><td></td></tr>

                    </tbody>
                </table>
                <?php echo "<button id=\"groupID\" value=\"$group_id\" hidden></button>" ?>
                <button id="submitButton" type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    </div>
</body>

</html>

