<head>
    <?php
    //turn off error reporting
    error_reporting(0);
    include '../header.inc.php';
    ?>
</head>
<body>
    <?php include 'navigation.php'; ?>
    <main class = "container">
        <?php
        $errorMsgpwd = "";
        $email = $errorMsg = "";
        $username = $_POST["username"];
        $lastname = $_POST["lname"];
        $username = $_POST["username"];
        $firstname = $_POST["fname"];
        $password = $_POST["pwd"];
        $cmfpassword = $_POST["pwd_confirm"];
        $contact = $_POST["contact"];
        $success = true;
        $permissions = "user";
        if (empty($_POST["email"])) {
            $errorMsg .= "Email is required.<br>";
            $success = false;
        } else {
            $email = sanitize_input($_POST["email"]);
        }
        if (empty($_POST["fname"])) {
            $success = True;
        } else {
            sanitize_input($firstname);
        }
        if (empty($_POST["lname"])) {
            $errorMsg .= "Lastname is required.<br>";
            $success = false;
        } else {
            sanitize_input($lastname);
        }
        if (empty($_POST["username"])) {
            $errorMsg .= "Username is required.<br>";
            $success = false;
        } else {
            sanitize_input($username);
        }

        // Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.";
            $success = false;
        }

        if (strcmp($password, $cmfpassword) !== 0) {
            $errorMsgpwd .= "Passwords does not match";
            $success = false;
        }
        sanitize_input($lastname);
        sanitize_input($password);
        sanitize_input($cmfpassword);
        sanitize_input($contact);
        if ($success) {
            echo "<h4>Registration successful!</h4>";
            echo "<p>Username:" . $username;
            echo "<p>Email: " . $email;
            echo "<p>First Name: " . $firstname;
            echo "<p>Last Name: " . $lastname;
            echo "<p>Contact:" . $contact;
            echo "<p>Permissions:" . $permissions;
            saveMemberToDB();
            echo "<form action = '../index.php'>";
            echo "<button class='btn btn-success'>Home</button></form> ";
        } else {
            echo "<h4>The following input errors were detected:</h4>";
            echo "<p>" . $errorMsg . "</p>";
            echo "<p>" . $errorMsgpwd . "</p>";
            echo "<form action = 'register.php'>";
            echo "<button class='btn btn-success'>Register</button></form> ";
        }

//Helper function that checks input for malicious or unwanted content.
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

//Helper function to write the member data to the DB
        function saveMemberToDB() {
            global $username, $firstname, $lastname, $email, $password, $contact, $errorMsg, $success, $permissions;

            //Creating databse connection.
            $config = parse_ini_file('/var/www/private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {
                $sql = "INSERT INTO carpark.users(username, fname, lname, email, password, contact)";
                $sql .= " VALUES ('$username','$firstname', '$lastname', '$email', '$password', '$contact')";
                //Execute the query
                if (!$conn->query($sql)) {
                    $errorMsg = "Database error: " . $conn->error;
                    $success = false;
                }
                $result->free_result();
            }
            $conn->close();
        }
        ?>
    </main>        
</body>
</html>
