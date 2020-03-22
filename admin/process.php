<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'debug.php';
if ($GLOBALS['local'] == true) {
    $conn = new mysqli('localhost', 'root', '', 'carpark');
} else {
    $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd', 'carpark');
}

if (isset($_POST['update'])) {
    if ($GLOBALS['local'] == true) {
        $name = $_POST['name'];
        $location = $_POST['location'];
        $id = $_POST['id'];
        $conn->query("UPDATE users SET name='$name', location='$location' WHERE id='$id'");
        $_SESSION['message'] = "User has been updated";
        $_SESSION['msg_type'] = "success";
        header("location: /ICT1004-Project/manage");
    } else {
        $username = $_POST['username'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $permissions = $_POST['permissions'];
        $id = $_POST['id'];
        $sql = $conn->query("UPDATE users SET username='$username', fname='$fname',lname='$lname', password='$password',"
                . "email='$email', contact='$contact', permissions='$permissions' WHERE id='$id'");
//        $sql = $conn->prepare("UPDATE users SET username=?, fname=?, lname=? password=?,"
//                . "email=?, contact=?, permissions=? WHERE id=?");        
//        $sql->bind_param('ssssssss', $username,$fname,$lname,$password,$email,$contact,$permissions,$id);
//        $sql->execute();
        $_SESSION['message'] = "User has been updated";
        $_SESSION['msg_type'] = "success";
        header("location: /ICT1004-Project/manage");
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $result = $conn->query("SELECT * FROM users WHERE id='$id'");
    while ($user = $result->fetch_assoc()) {
        if ($GLOBALS['local'] == true) {
            $name = $user['name'];
        } else {
            $name = $user['username'];
        }
    }
    $conn->query("DELETE FROM users WHERE id='$id'");
    $_SESSION['message'] = "User " . $name . " has been deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: /ICT1004-Project/manage");
}

if (isset($_GET['area_id'])) {
    $id = $_GET['area_id'];
    $occupancy = $_GET['new_occupancy'];
    $result = $conn->query("SELECT * FROM area WHERE area_id='$id'");
    while ($area = $result->fetch_assoc()) {
        if ($GLOBALS['local'] == true) {
            $area = $area['name'];
        } else {
            $area = $area['name'];      
            print_r($area);
        }
    }
    $conn->query("UPDATE area SET occupancy='$occupancy' WHERE area_id='$id'");
    $_SESSION['message'] = "Occupancy in $occupancy has been updated";
    $_SESSION['msg_type'] = "success";
    header("location: /ICT1004-Project/occupancy");
}

$conn->close();
