<head>
        <title>This is the title of the webpage!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
        <!-- External JS-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script src="../resources/js/lib/userhome.js"></script>

        <!-- External Style Sheet -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"></link>
        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha384-rCA2D+D9QXuP2TomtQwd+uP50EHjpafN+wruul0sXZzX/Da7Txn4tB9aLMZV4DZm" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        
        <!-- Own Style Sheet -->
        <link rel="stylesheet" href="resources/css/main.css"></link>
       

    </head>
    <body>
        <?php include 'navigation.php';?>
 <main class = "container">
                <?php
                $errorMsgpwd = "";
                $email = $errorMsg = "";
                $lastname = $_POST["lname"];
                $firstname = $_POST["fname"];
                $password = $_POST["pwd"];
                $cmfpassword = $_POST["pwd_confirm"];
                $contact = $_POST["contact"];
                $success = true;
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
                    echo "<p>Username:" .$username;
                    echo "<p>Email: " . $email;
                    echo "<p>First Name: " . $firstname;
                    echo "<p>Last Name: " . $lastname;
                    echo "<p>Contact:". $contact;
                    echo "<form action = 'index.php'>";
                    echo "<button class='btn btn-success'>Home</button></form> ";
                    $permission = 'normaluser';
                } else {
                    echo "<h4>The following input errors were detected:</h4>";
                    echo "<p>" . $errorMsg . "</p>";
                    echo "<p>" . $errorMsgpwd . "</p>";
                    echo "<form action = 'register.php'>";
                    echo "<button class='btn btn-success'>Login</button></form> ";
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
                    global $username, $firstname, $lastname, $email, $password, $contact,  $errorMsg, $success;

                    //Creating databse connection.
                    $config = parse_ini_file('/var/www/private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'],$config['password'], $config['dbname']);
                    // Check connection
                    if ($conn->connect_error) {
                        $errorMsg = "Connection failed: " . $conn->connect_error;
                        $success = false;
                    } else {
                        $sql = "INSERT INTO new_table(username, fname, lname, email, password, contact)";
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

                $functionName = "saveMemberToDB();";
                eval($functionName);
                ?>
            </main>
        </body>
</html>