<?php

session_start();
require_once 'debug.php';
if ($GLOBALS['local'] == true) {
    $conn = new mysqli('localhost', 'root', '', 'testing');
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
        header("location: index.php");
    } else {
        $username = $_POST['username'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $permissions = $_POST['permissions'];
        $id = $_POST['id'];
        $conn->query("UPDATE users SET username='$username', fname='$fname', password='$password',"
                . "email='$email', contact='$contact', permissions='$permissions' WHERE id='$id'");
        $_SESSION['message'] = "User has been updated";
        $_SESSION['msg_type'] = "success";
        header("location: index.php");
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
    header("location: index.php");
}

$conn->close();
