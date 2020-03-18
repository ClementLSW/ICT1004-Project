<?php

//turn off error reporting
error_reporting(1);

class connections {

    function retrieve_data_where_multiple_equals(String $tableName, Array $colname , Array $colval , int $argCount , Array $types , Array $operators){
        //Takes in a table name, array of col name , array of col val , total count of name-val pair and the type of each attribute
        try{
            $argValue = "";
            for($i = 0; $i < $argCount; $i++){
                if($types[$i] != "string"){
                    $argValue = $argValue . strval($colname[$i]) . $operators[$i] . strval($colval[$i]);
                }
                else{
                    $argValue = $argValue . strval($colname[$i]) .  $operators[$i] . "'". strval($colval[$i]) . "'";
                }
                
                if($i != $argCount -1){
                    $argValue = $argValue . " and ";
                }
            }


            if ($GLOBALS['localtesting']) {
                $conn = new mysqli("localhost", "root", "", "carpark");
            } else {
                $config = parse_ini_file('/var/www/private/db-config.ini'); //Should use absolute path because when method is called from different places, the relative path is different
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
            }
            if ($conn->connect_error) {
                die("Connection error: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM " . $tableName . " WHERE " . $argValue;

            $result = $conn->query($sql);
            $data = [];
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                // echo json_encode($data); // dont remove pls 
            } else {
                // echo json_encode([]);
            }
            $conn->close();
            return $data;

            
        }catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    function retrieve_data_where(String $tableName, String $colname, String $colval) {
        //INPUT: 1 Argum , Returns Array
        // $config = parse_ini_file('/var/www/private/db-config.ini'); //Should use absolute path because when method is called from different places, the relative path is different
//        $config = parse_ini_file('../../../../../var/www/private/db-config.ini'); //Should use absolute path because when method is called from different places, the relative path is different
//        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        if ($GLOBALS['localtesting']) {
            $conn = new mysqli("localhost", "root", "", "carpark");
        } else {
            $config = parse_ini_file('/var/www/private/db-config.ini'); //Should use absolute path because when method is called from different places, the relative path is different
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        }
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
            // echo json_encode($data); // dont remove pls 
        } else {
            // echo json_encode([]);
        } 
       $conn->close();
        return $data;
    }


    function retrieve_all_data($tableName) {

        if ($GLOBALS['localtesting']) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "carpark";
        } else {
            $config = parse_ini_file('/var/www/private/db-config.ini'); //Should use absolute path because when method is called from different places, the relative path is different    
            $servername = $config['servername'];
            $username = $config['username'];
            $password = $config['password'];
            $dbname = $config['dbname'];
        }

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM ?";
        echo $sql;
        $stmt = $conn->prepare($sql);
        echo $stmt;
        $stmt->bind_param("i", $tableName);
        $stmt->execute();
        $result = $stmt->get_result();
        echo $result;
        $data = $result->fetch_all(MYSQLI_ASSOC);
                        
        
        return $data;
    }

    function retrieve_cp_by_occupancy($threshold) {
        if ($GLOBALS['localtesting']) {
            $conn = new mysqli("localhost", "root", "", "carpark");
        } else {
            $config = parse_ini_file('/var/www/private/db-config.ini'); //Should use absolute path because when method is called from different places, the relative path is different
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        }
        if ($conn->connect_error) {
            die("Connection error: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM AREA WHERE occupancy < " . $threshold;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        $conn->close();
        return $data;
    }

}
