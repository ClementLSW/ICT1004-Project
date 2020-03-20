<head>
    <?php
    session_start();

    //require 'PHPMailer/PHPMailerAutoload.php';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
//    use PHPMailer\PHPMailer\PHPMailer;
//    use PHPMailer\PHPMailer\Exception;
//    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    //turn off error reporting
    error_reporting(0);
    include '../header.inc.php';
    ?>
</head>
<body> 

    <main class = "container">
        <?php
        $errorMsgpwd = "";
        $email = $errorMsg = "";
        $success = true;
        $permissions = "user";
        if (empty($_POST["email"])) {
            $errorMsg .= "Email is required.<br>";
            $success = false;
            $_SESSION['Inputerror'] = $errorMsg;
        } else {
            $email = sanitize_input($_POST["email"]);
        }
        if (empty($_POST["fname"])) {
            $errorMsg .= "Firstname is required.<br>";
            $success = false;
            $_SESSION['Inputerror'] = $errorMsg;
        } else {
            $firstname = sanitize_input($_POST["fname"]);
        }
        if (empty($_POST["lname"])) {
            $errorMsg .= "Lastname is required.<br>";
            $success = false;
            $_SESSION['Inputerror'] = $errorMsg;
        } else {
            $lastname = sanitize_input($_POST["lname"]);
        }
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
        if (empty($_POST["pwd_confirm"])) {
            $errorMsg .= "Password is required.<br>";
            $success = false;
            $_SESSION['Inputerror'] = $errorMsg;
        } else {
            $cmfpassword = sanitize_input($_POST["pwd_confirm"]);
        }
        if (empty($_POST["contact"])) {
            $errorMsg .= "Contact is required.<br>";
            $success = false;
            $_SESSION['Inputerror'] = $errorMsg;
        } else {
            $contact = sanitize_input($_POST["contact"]);
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
        if ($success) {

            //Creating databse connection.
            $config = parse_ini_file('/var/www/private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {

                $sql = "SELECT * FROM users WHERE ";
                $sql .= "username='$username'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();


                //Checking for duplicate username
                if ($result->num_rows > 0) {
                    $_SESSION["duplicateerror"] = 1;
                    header('location:http://52.54.127.185/ICT1004-Project/register');
                } else {
                    $sql = "SELECT * FROM users WHERE ";
                    $sql .= "email='$email'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    if ($result->num_rows > 0) {
                        $_SESSION["duplicateemail"] = 1;
                        header('location:http://52.54.127.185/ICT1004-Project/register');
                    } else {
                        $_SESSION["registersuccess"] = 1;
                        $password_hash = password_hash($password, PASSWORD_DEFAULT);
                        $mail = new PHPMailer;
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = 587;
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->SMTPAuth = true;
                        $mail->Username = 'parknow38@gmail.com';
                        $mail->Password = 'Singapore@123';
                        $mail->setFrom('parknow38@gmail.com', 'ParkNow');
                        $mail->addReplyTo('parknow38@gmail.com', 'ParkNow');
                        $mail->addAddress($email, $firstname);
                        $mail->Subject = 'Welcome to Park Now!';
                        $mail->Body = "Thank you for registering to be a member! If this is not you, send a reply to this email and we will contact you shortly";
                        $mail->send();
                        echo $username;
                        header('location:/ICT1004-Project/userlogin');
                        $sql = "INSERT INTO carpark.users(username, fname, lname, email, password, contact, permissions)";
                        $sql .= " VALUES ('$username','$firstname', '$lastname', '$email', '$password_hash', '$contact', '$permissions')";
                        //Execute the query
                        if (!$conn->query($sql)) {
                            $errorMsg = "Database error: " . $conn->error;
                            $success = false;
                        }
                        return $success;
                        $result->free_result();
                        $conn->close();
                        header('location:/ICT1004-Project/userlogin');
                    }
                }
            }
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
        ?>
    </main>        
</body>
</html>
