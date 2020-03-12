<?php
class connections{    

    global $dbservername , $dbusername , $dbpassword , $dbname , $data;
    $dbservername = "localhost";
    $dbusername = "sqldev";
    $dbpassword = "P@ssw0rd";
    $dbname = "carpark";
    $data = array();
function retrieve_data_where(String $tableName , String $colname, String $colval ){
    //INPUT: 1 Argum , Returns Array
    
    $conn = new mysqli($this->dbservername, $this->dbusername, $this ->dbpassword, $this ->dbname);
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
        echo json_encode($data);
    } else {
        echo json_encode([]);
    }
    $conn->close();
    return $data;
    
}

function retrieve_all_data(String $tableName){
    //  INPUT: String , RETURNS: Array 
    $conn = new mysqli($this->dbservername, $this->dbusername, $this ->dbpassword, $this ->dbname);
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