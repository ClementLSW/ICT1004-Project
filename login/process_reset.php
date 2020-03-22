<?php

session_start();

global $password, $cmfpassword, $success, $errorMsgpwd, $email, $password_hash;

$email = $_SESSION['email'];
$username = $_SESSION['username'];


//Sanitsation of input
if (empty($_POST["pwd"])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
    $_SESSION['Inputerror'] = $errorMsg;
} else {
    $password = sanitize_input($_POST["pwd"]);
}
if (empty($_POST["cmfpassword"])) {
    $errorMsg .= "Password is required.<br>";
    $success = false;
    $_SESSION['Inputerror'] = $errorMsg;
} else {
    $cmfpassword = sanitize_input($_POST["cmfpassword"]);
}
//Comparing password string
if (strcmp($password, $cmfpassword) !== 0) {
    $_SESSION["nomatchpass"] = 1;
    header('location:/ICT1004-Project/login/reset.php');
} // Create database connection.
else {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $config = parse_ini_file('/var/www/private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        
        
        $sqlpassword = "UPDATE users SET password = '$password_hash' WHERE email = '$email'";
        $resultpassword = $conn->query($sqlpassword);
        $_SESSION["resetsuccess"] = 1;
        header('location:http://52.54.127.185/ICT1004-Project/userlogin');
        if (!$conn->query($sql)) {

            $errorMsg = "Database error: " . $conn->error;

            $success = false;
            //header('location:/ICT1004-Project/login/reset.php');
        }
        $result->free_result();
        $conn->close();
        //header('location:/ICT1004-Project/userlogin');
    }
}
//Helper function to sanitise input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
