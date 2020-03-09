<?php
function establish_connection(){
    $dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = "";

    $conn = new mysqli($dbservername, $dbusername, $dbpassword);

    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    return $conn;
}

function kill_connection($conn){
    $conn -> close();
}
   
?>