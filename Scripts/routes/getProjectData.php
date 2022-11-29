<?php
    //Displays errors on webpage for testing
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    //Connects to database
    $db_host = "127.0.0.1";
    $db_user = "liul16";
    $db_pass = "GTERE%%#\$DEE";
    $db_database = "liul16";
    $db_port = "3306";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_database);

    if($conn) {
        $getProjects = "SELECT projects.project_id, projects.project_name, projects.max_size, projects.project_description FROM projects";


        //Gets all projects
        $projectsResult = mysqli_query($conn, $getProjects);


        $projectID = array();
        $projectName = array();
        $maxSize = array();
        $projectDescription = array();

        $count = 0;
        while($row = $projectsResult->fetch_assoc()) {
             $projectID[$count] = $row["project_id"];
             $projectName[$count] = $row["project_name"];
             $maxSize[$count] = $row["max_size"];
             $projectDescription[$count] = $row["project_description"];
            $count += 1;
        }

        $projectData = array('projectID' => $projectID, 'projectName' => $projectName, 'maxSize' => $maxSize, 'projectDescription' => $projectDescription);
        echo json_encode($projectData);



        $conn -> close();


    }
    else {
        echo "Connection not established. <br>";
    }

?>

