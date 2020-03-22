<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'debug.php';
if ($GLOBALS['local']) {
    $conn = new mysqli("localhost", "sqldev", "P@ssw0rd", "carpark");
} else {
    $config = parse_ini_file('/var/www/private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
}

if (isset($_POST['update'])) {
    $username = htmlspecialchars($_POST['username']);
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $email = filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL);
    $contact = htmlspecialchars($_POST['contact']);
    $permissions = htmlspecialchars($_POST['permissions']);
    $id = htmlspecialchars($_POST['id']);  
    //check database for duplicate username
    $result = $conn->query("SELECT * FROM users WHERE username='$username' AND id!='$id'");
    if($result->num_rows < 1){
        $sql = $conn->prepare("UPDATE users SET password=? , fname=? , lname=? , email=?, contact=? , permissions=? , username=? WHERE id=?");
        print("after prepare");
        $sql->bind_param('ssssissi', $password, $fname, $lname, $email, $contact, $permissions, $username, $id);
        print("after bind");
        $sql->execute();

        // $sql->execute();
        $_SESSION['message'] = "User " . $username . " has been updated";
        $_SESSION['msg_type'] = "success";
        header("location: /ICT1004-Project/manage");
    }else{
         $_SESSION['message'] = "User " . $username . " already exists";
        $_SESSION['msg_type'] = "danger";
        header("location: /ICT1004-Project/manage");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $result = $conn->prepare("SELECT * FROM users WHERE id=?");
    $result->bind_param('i', $id);
    $result->execute();
    $rows = $result->get_result();
    $user = $rows->fetch_assoc();
    $name = $user['username'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $_SESSION['message'] = "User " . $name . " has been deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: /ICT1004-Project/manage");
}

if (isset($_GET['area_id'])) {
    $id = $_GET['area_id'];
    $occupancy = $_GET['new_occupancy'];
    $result = $conn->prepare("SELECT * FROM area WHERE area_id=?");
    $result->bind_param('i', $id);
    $result->execute();
    $rows = $result->get_result();
    while ($area = $rows->fetch_assoc()) {
        if ($GLOBALS['local'] == true) {
            $area = $area['name'];
        } else {
            $area = $area['name'];
        }
    }
    $sql = $conn->prepare("UPDATE area SET occupancy=? WHERE area_id=?");
    $sql->bind_param('ii', $occupancy, $id);
    $sql->execute();
    $_SESSION['message'] = "Occupancy in $area has been updated";
    $_SESSION['msg_type'] = "success";
    header("location: /ICT1004-Project/occupancy");
}
$sql->close();
$conn->close();
