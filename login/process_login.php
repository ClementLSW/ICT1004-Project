
<html>
    <head>
        <?php
        session_start();
        //turn off error reporting
        error_reporting(1);
        include '../header.inc.php';
        include '../initialize.php';
        ?>
    </head>
    <body>
        <?php include '../navigation.php'; ?>
        <main class = "container">
            <?php
            $password = $_POST["pwd"];
            $username = $_POST["username"];
            if ($GLOBALS['debug']) {
                print($_POST["pwd"]);
                print($_POST["username"]);
            }

            /** Helper function to authenticate the login. */
            function authenticateUser() {
                global $username, $firstname, $permission, $lastname, $email, $password, $password_hash, $errorMsg, $success;

// Create database connection.
                if ($GLOBALS['localtesting']) {
                    $conn = new mysqli("localhost", "sqldev", "P@ssw0rd", "carpark");
                } else {
                    $config = parse_ini_file('/var/www/private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                }

// Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
                    $sql = "SELECT * FROM users WHERE ";
                    $sql .= "username='$username'";
                }
// Execute the query

                $result = $conn->query($sql);

                if ($GLOBALS['debug']) {
                    print("results");
                    print(var_dump($row["username"]));
                }
                if ($result->num_rows > 0) {
                    //session_start();
                    $row = $result->fetch_assoc();
                    $password_hash = $row["password"];
                    if (password_verify($password, $password_hash)) {
                        $firstname = $row["fname"];
                        $lastname = $row["lname"];
                        $_SESSION["username"] = $username;
                        $permission = $row["permissions"];
                        $_SESSION["permissions"] = $permission;
                        header('location:/ICT1004-Project/home');
                    } elseif ($password == $row["password"]) {
                        $firstname = $row["fname"];
                        $lastname = $row["lname"];
                        $_SESSION["username"] = $username;
                        $permission = $row["permissions"];
                        $_SESSION["permissions"] = $permission;
                        header('location:/ICT1004-Project/home');
                    } else {
                        $success = false;
                        header('location:/ICT1004-Project/userlogin');
                        $_SESSION["error"] = 1;
                    }


//                    echo "<h3>Login successful!</h3>";
//                    echo "<h4>Welcome back, $firstname $lastname. </h4>";
//
//                    echo "<a href='/ICT1004-Project/userlogin'><button class='btn btn-success'>Return to Login</button></a></form> ";
//               
//
//                    echo "<a href='/ICT1004-Project/home'><button class='btn btn-success'>Return to Home</button></a></form> ";
                } else {


                    $success = false;
                    header('location:/ICT1004-Project/userlogin');
                    $_SESSION["error"] = 1;
                }
                if ($GLOBAL['localtesting']) {
                    $result->free_results();
                }
                $conn->close();
            }

            $functionName = "authenticateUser();";
            eval($functionName);
            $success = true;
            ?>
        </main>
    </body>    
</html>
