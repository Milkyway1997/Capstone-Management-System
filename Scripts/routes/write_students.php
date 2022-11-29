<?php
    if (!empty($_POST)) {
        if (isset($_POST['users'])) {
            $db_host = "127.0.0.1";
            $db_user = "liul16";
            $db_pass = "GTERE%%#\$DEE";
            $db_database = "liul16";
            $db_port = "3306";
            $db = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }
            $users = $_POST['users'];
            $added_users = array();
            for ($i = 0; $i < count($users); $i++) {
                $unique_id = $users[$i]['sis_user_id'];
                $name = $users[$i]['name'];
                $result = mysqli_query($db, 'INSERT INTO users (unique_id, name) VALUES ("' . $unique_id . '", "' . $name . '");');
                if ($result) {
                    array_push($added_users, $users[$i]['sis_user_id']);
                }
            }
            echo implode(",", $added_users);
        }
    }
?>