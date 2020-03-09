<?php

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "carpark";
$users = array();

$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>