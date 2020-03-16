<html>
    <head>
        <?php
        //turn off error reporting
        error_reporting(0);
        include '../header.inc.php';
        ?>
    </head>
    <body>
        <?php include '../navigation.php'; ?>
        <main class = "container">
            <?php
            $password = $_POST["pwd"];
            $username = $_POST["username"];

            /** Helper function to authenticate the login. */
            function authenticateUser() {
                global $username, $firstname, $permission, $lastname, $email, $password, $errorMsg, $success;

// Create database connection.
                $config = parse_ini_file('/var/www/private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
// Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
                    $sql = "SELECT * FROM users WHERE ";
                    $sql .= "username='$username' AND password='$password'";
                }
// Execute the query

                $result = $conn->query($sql);

                if ($result->num_rows > 0 || $username = $row["username"] || $password = $row["password"]) {
                    session_start();
                    $row = $result->fetch_assoc();
                    $firstname = $row["fname"];
                    $lastname = $row["lname"];
                    $_SESSION["username"] = $username;
                    $permission = $row["permissions"];
                    $_SESSION["permissions"] = $permission;
                    echo "<h3>Login successful!</h3>";
                    echo "<h4>Welcome back, $firstname $lastname. </h4>";
                    echo "<form action = '../index.php'>";
                    echo "<button class='btn btn-success'>Return to Home</button></form> ";
                } else {
                    $success = false;
                    $errorMsg = "Email not found or password doesn't match...";
                    echo"<h3>Oops!</h3>";
                    echo "<h4>The following input errors were detected:</h4> <p>$errorMsg</p>";
                    echo "<form action = 'Login.php'>";
                    echo "<button class='btn btn-success'>Return to Login</button></form> ";
                }
                $result->free_result();

                $conn->close();
            }

            $functionName = "authenticateUser();";
            eval($functionName);
            $success = true;
            ?>
        </main>
    </body>    
</html>
