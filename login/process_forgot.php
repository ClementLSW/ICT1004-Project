<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if (isset($_POST['submit_email']) && $_POST['email']) {
    global $email, $password_hash, $success, $firstname;

    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
        $_SESSION['Inputerror'] = $errorMsg;
    } else {
        $email = sanitize_input($_POST["email"]);
    }


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
        $sql .= "email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
    }
}
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if ($result->num_rows > 0) {

    $password_hash = $row['password'];
    $firstname = $row["fname"];
    $_SESSION['email'] = $email;

    //Send email to the user using phpmailer
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->IsHTML(true);
    $mail->Username = 'parknow38@gmail.com';
    $mail->Password = 'Singapore@123';
    $mail->setFrom('parknow38@gmail.com', 'ParkNow');
    $mail->addReplyTo('parknow38@gmail.com', 'ParkNow');
    $mail->addAddress($email, $firstname);
    $mail->Subject = 'Password Recovery';
    $mail->Body = "Password Recovery, Click on the link to recover your password:
                    <p>http://52.54.127.185/ICT1004-Project/login/reset.php</p>"
            . "If this is not you, send a reply to this email and we will contact you shortly";
    $mail->send();
    if (!$mail->send()) {
        $_SESSION["mailerror"] = $mail->ErrorInfo;
    } else {
        $_SESSION["forgotsuccess"] = 1;
        header('location:/ICT1004-Project/userlogin');
    }
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
} else {
    $success = false;
    $_SESSION["errorforgot"] = 1;
    header('location:/ICT1004-Project/userlogin');
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$conn->close();
$success = true;

