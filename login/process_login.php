<html>
    <head>
        <?php
        session_start();
        //turn off error reporting
        error_reporting(0);
        include '../header.inc.php';
        include '../initialize.php';
        ?>
    </head>
    <body>

        <main class = "container">
            <?php
            
            //Sanitisation of input
            if (empty($_POST["username"])) {
                $errorMsg .= "Username is required.<br>";
                $success = false;
                $_SESSION['Inputerror'] = $errorMsg;
            } else {
                $username = sanitize_input($_POST["username"]);
            }

            if (empty($_POST["pwd"])) {
                $errorMsg .= "Password is required.<br>";
                $success = false;
                $_SESSION['Inputerror'] = $errorMsg;
            } else {
                $password = sanitize_input($_POST["pwd"]);
            }

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
                    //Getting the row based on username
                    $sql = "SELECT * FROM users WHERE ";
                    $sql .= "username='$username'";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ss', $username, $username);
                    $stmt->execute();
                    $result = $stmt->get_result();
                           
                }
// Execute the query
              
                $row = $result->fetch_assoc();
                if ($GLOBALS['debug']) {
                    //print("results");
                    //print(var_dump($row["username"]));
                }
                if ($result->num_rows > 0) {
                    //session_start();               
                    $password_hash = $row["password"];
                    if (password_verify($password, $password_hash)) {
                        $_SESSION["username"] = $username;
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
                } else {
                    $success = false;
                    header('location:/ICT1004-Project/userlogin');
                    $_SESSION["error"] = 1;
                }
//                if ($GLOBAL['localtesting']) {
//                    $result->free_results();
//                }
                $conn->close();
            }

            $functionName = "authenticateUser();";
            eval($functionName);
            $success = true;
            $result->free_result();
            function sanitize_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
        </main>
    </body>    
</html>