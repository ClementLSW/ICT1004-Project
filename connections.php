<?php
//turn off error reporting
error_reporting(0);
class connections{       
function retrieve_data_where(String $tableName , String $colname, String $colval ){
    //INPUT: 1 Argum , Returns Array
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM " . $tableName . " WHERE " . $colname . "=" . $colval;
    $result = $conn->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
    }
    $conn->close();
    return $data;
    
}

function retrieve_all_data(String $tableName){    
    //  INPUT: String , RETURNS: Array     
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
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