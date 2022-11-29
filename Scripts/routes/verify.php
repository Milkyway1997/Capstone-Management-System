<?php
    if (!empty($_POST)) {
        if (isset($_POST['verificationCode'])) {
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
            $code = substr($_POST['verificationCode'], 0, 8);
            $unique_id = substr($_POST['verificationCode'], 8);

            $result = mysqli_query($db, "SELECT * FROM logins WHERE unique_id = '$unique_id' AND verification_code = $code");
            if ($result) {
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $active = $row['active'];
                $count = mysqli_num_rows($result);
                if ($count > 0) {
                    $result = mysqli_query($db, "UPDATE logins SET is_verified = 1 WHERE unique_id = '$unique_id';");
                    if ($result) {
                        //Automatically adds a newly registered user to a new group
                        $getId = mysqli_query($db, "SELECT id FROM users WHERE unique_id = '$unique_id';");
                        $id = -1;
                        while($row = $getId->fetch_assoc()) {
                            $id = $row["id"];
                        }
                        $setGroup = mysqli_query($db, "INSERT INTO group_users_view (leader_id) VALUES ($id);");

                        //Goes to login page
                        header("location: login");
                        exit();
                    }
                    else {
                        printf("Error message: %s\n", mysqli_error($db));
                    }
                }
                else {
                    printf("Error: Invalid verification code");
                }
            }
            else {
                printf("Error message: %s\n", mysqli_error($db));
            }
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Bootstrap CDN for CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand text-white">Capstone Management System</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
            </li>
        </ul>
    </nav>

    <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-6">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="verificationCode">Enter the verification code sent to your university email</label>
                            <input type="text" id="verificationCode" name="verificationCode" class="form-control" placeholder="Enter verification code">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>
