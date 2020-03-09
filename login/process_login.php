<html>
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
            $password = $_POST["pwd"];
            $username = $_POST["username"];
            /** Helper function to authenticate the login. */
            function authenticateUser() {
            global $username, $firstname, $lastname, $email, $password, $errorMsg, $success;

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
            echo "<h3>Login successful!</h3>";
            echo "<h4>Welcome back, $firstname $lastname. </h4>";
            echo "<form action = 'index.php'>";
            echo "<button class='btn btn-success'>Return to Home</button></form> ";
            
            }

            else{
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
    <?php include "footer.inc.php"; ?>
</html>