<?php
class connections{

function retrieve_all_users(String $tableName){
    //  INPUT: String , RETURNS: Array 

    global $dbservername , $dbusername , $dbpassword , $dbname , $data;
    $dbservername = "127.0.0.1";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "carpark";
    $users = array();

    
    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM " . $tableName;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    return $data;
    }
}




?>