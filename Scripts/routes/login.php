<?php
    // error_reporting(E_ERROR | E_PARSE);     // mute errors that are displayed to user
    if (!empty($_POST)) {
        if (isset($_POST['email']) && isset($_POST['password'])) {
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

            $unique_id = explode("@", $_POST['email'])[0];      // extract unique id from email

            // CURRENTLY, PASSWORDS ARE NOT BEING HASHED FOR TESTING PURPOSES _________
            $hashed_password = $_POST['password'];
            // ^^^HASH THIS PASSWORD BEFORE DEPLOYING TO PROD ___________

            $result = mysqli_query($db, "SELECT * FROM logins WHERE unique_id = '$unique_id' AND password = '$hashed_password' AND is_verified = 1;");
            if ($result) {
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $active = $row['active'];
                $count = mysqli_num_rows($result);
                if ($count > 0) {
                    $_SESSION['user_id'] = explode("@", $_POST['email'])[0];
                    header("location: dashboard");
                    exit();
                }
                else {      // no users found, check instructors table
                    $result = mysqli_query($db, "SELECT * FROM instructors WHERE unique_id = '$unique_id' AND password = '$hashed_password';");
                    if ($result) {
                        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                        $active = $row['active'];
                        $count = mysqli_num_rows($result);
                        if ($count > 0) {
                            $_SESSION['instructor_id'] = explode("@", $_POST['email'])[0];
                            header("location: console");
                            exit();
                        }
                        else {
                            printf("The specified username or password is invalid.");
                        }
                    }
                    else {
                        printf("Error message: %s\n", mysqli_error($db));
                    }
                }
            }
            else {
                printf("Error message: %s\n", mysqli_error($db));
            }
            mysqli_close($db);
        }
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

</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand text-white">Capstone Management System</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register">Register</a>
            </li>
        </ul>
    </nav>

    <!--Login Form-->
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-6">
                <h1>Login</h1>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="emailAddress">Email Address or Unique ID:</label>
                        <input type="text" name="email" id="emailAddress" class="form-control" placeholder="Email or UID" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
