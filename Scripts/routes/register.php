<?php
    if (!empty($_POST)) {
        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
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
            $unique_id = explode("@", $_POST['email'])[0];
            
            // CURRENTLY, PASSWORDS ARE NOT BEING HASHED FOR TESTING PURPOSES _________
            $hashed_password = $_POST['password'];
            // ^^^HASH THIS PASSWORD BEFORE DEPLOYING TO PROD ___________
            
            $result = mysqli_query($db, "SELECT * FROM users WHERE unique_id = '$unique_id';");
            if ($result) {
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $active = $row['active'];
                $count = mysqli_num_rows($result);
                if ($count == 0) {
                    printf("Error: User has not been added to this website by the instructor yet");
                }
                elseif ($_POST['password'] != $_POST['confirmPassword']) {
                    printf("Passwords do not match");
                }
                else {
                    $result = mysqli_query($db, "SELECT * FROM logins WHERE unique_id = '$unique_id';");
                    if ($result) {
                        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                        $active = $row['active'];
                        $count = mysqli_num_rows($result);
                        if ($count == 0) {
                            $code = rand(10000000,99999999);
                            $result = mysqli_query($db, "INSERT INTO logins (unique_id, password, verification_code) VALUES ('$unique_id', '$hashed_password', $code)");
                            if (!$result) {
                                printf("Error message: %s\n", mysqli_error($db));
                            }
                            else {
                                sendEmail($_POST['email'], strval($code) . $unique_id);
                                header("location: verify");
                                exit();
                            }
                        }
                        elseif ($count == 1 && $row['is_verified'] == 0) {
                            $code = rand(10000000,99999999);
                            $result = mysqli_query($db, "UPDATE logins SET verification_code = $code WHERE unique_id = '$unique_id';");
                            if (!$result) {
                                printf("Error message: %s\n", mysqli_error($db));
                            }
                            else {
                                sendEmail($_POST['email'], strval($code) . $unique_id);
                                header("location: verify");
                                exit();
                            }
                        }
                        else {
                            printf("Error: User already exists");
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
    function sendEmail($email, $code) {
        $subject = "Capstone Management Verification";
        $msg = "Hello,\n\nHere is your verification code:\n$code\n";
        $headers = "From: no-reply";
        mail($email, $subject, $msg, $headers);
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
                <a class="nav-link" href="register">Register</a>
            </li>
        </ul>
    </nav>

    <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-6">
                    <h1>Register an Account</h1>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-6">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="emailAddress">Email Address:</label>
                            <input type="text" id="emailAddress" name="email" class="form-control" placeholder="Enter your Miami Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                                <label for="confirmPassword">Confirm Password:</label>
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>