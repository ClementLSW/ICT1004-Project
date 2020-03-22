<?php

//turn off error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
class connections {

    function retrieve_data_where_multiple_equals(String $tableName, Array $colname , Array $colval , int $argCount , Array $types , Array $operators){
        //Takes in a table name, array of col name , array of col val , total count of name-val pair and the type of each attribute
        try{
            $argValue = "";
            $parameter = "";
            $valArr =[];
            $valArr1 = "";
            $valArr2 = "";
            $valArr3 = "";
            $valArr4 = "";
            $valArr5 = "";            
            for($i = 0; $i < $argCount; $i++){
                if($types[$i] != "string"){
                    $argValue = $argValue . strval($colname[$i]) . $operators[$i] . "?";
                    $parameter .= "i";
                    array_push($valArr , $colval[$i]);
                    if($i == 0){
                        $varArr1 = $colval[$i];
                    }
                    else if($i == 1){
                        $varArr2 = $colval[$i];
                    }
                    else if($i == 2){
                        $varArr3 = $colval[$i];
                    }
                    else if($i == 3){
                        $varArr4 = $colval[$i];
                    }
                    else if($i == 4){
                        $varArr5 = $colval[$i];
                    }
                }
                else{
                    $argValue = $argValue . strval($colname[$i]) .  $operators[$i] . "?";
                    $parameter .= "s";
                    array_push($valArr , $colval[$i]);
                    if($i == 0){
                        $varArr1 = $colval[$i];
                    }
                    else if($i == 1){
                        $varArr2 = $colval[$i];
                    }
                    else if($i == 2){
                        $varArr3 = $colval[$i];
                    }
                    else if($i == 3){
                        $varArr4 = $colval[$i];
                    }
                    else if($i == 4){
                        $varArr5 = $colval[$i];
                    }
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
//            print_r($valArr);

            $result = $conn->prepare($sql);
//            echo $parameter;
//            print_r($valArr);
//            print_r(implode(",", $valArr));
//            echo $sql;        
         
            $result->bind_param($parameter, ...$valArr);
//            if($argCount == 1){
//                $result->bind_param($parameter, $valArr1);
//            }
//            if($argCount == 2){
//                $result->bind_param($parameter, $valArr1, $valArr2);
//            }
//            if($argCount == 3){
//                $result->bind_param($parameter, $valArr1, $valArr2, $valArr3);
//            }
//            if($argCount == 4){
//                $result->bind_param($parameter, $valArr1, $valArr2, $valArr3, $valArr4);
//            }
//            if($argCount == 5){
//                $result->bind_param($parameter, $valArr1, $valArr2, $valArr3, $valArr5);
//            }
            $result->execute();
            $rows = $result->get_result();
            $data = [];
            if ($rows->num_rows > 0) {
                // output data of each row
                while ($row = $rows->fetch_assoc()) {
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

        $sql = "SELECT * FROM " . $tableName . " WHERE " . $colname . "=?";
        $result = $conn->prepare($sql);
        $result->bind_param('i', $colval);
        $result->execute();
        $stmt = $result->get_result();
        $data = [];
        if ($stmt->num_rows > 0) {
            // output data of each row
            while ($row = $stmt->fetch_assoc()) {
                $data[] = $row;
            }
            // echo json_encode($data); // dont remove pls 
        } else {
            // echo json_encode([]);
        } 
       $conn->close();
        return $data;
    }

    function saveUserHistory($tableName, $username , $date_time , $start_point, $end_point , $startingName , $destinationName){
        if ($GLOBALS['localtesting']) {
            $conn = new mysqli("localhost", "root", "", "carpark");
        } else {
            $config = parse_ini_file('/var/www/private/db-config.ini'); //Should use absolute path because when method is called from different places, the relative path is different
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        }
        if ($conn->connect_error) {
            die("Connection error: " . $conn->connect_error);
        }

        $sql = "INSERT INTO " . $tableName ."(username , date_time, start_point , end_point , startingName , destinationName)
        VALUES (?, ?, ?, ?, ?, ?)";
        $result = $conn->prepare($sql);
        $result->bind_param('ssssss', $username, $date_time, $start_point, $end_point, $startingName, $destinationName);
        $result->execute();
        if ($result) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

    }


    function retrieve_all_data($tableName) {
        
        if ($GLOBALS['localtesting']) {
            $conn = new mysqli("localhost", "root", "", "carpark");
        } else {
            $config = parse_ini_file('/var/www/private/db-config.ini'); //Should use absolute path because when method is called from different places, the relative path is different
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        }
        if ($conn->connect_error) {
            die("Connection error: " . $conn->connect_error);
        }


        $sql = "SELECT * FROM " . $tableName;
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
        


        //PDO IS BELOW
        // print("HELLO");
        
        // $conn = new mysqli($servername, $username, $password, $dbname);

        // if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }

        // $sql = "SELECT * FROM ?";
        // echo $sql;
        // $stmt = $conn->prepare($sql);
        // echo $stmt;
        // $stmt->bind_param("i", $tableName);
        // $stmt->execute();
        // $result = $stmt->get_result();
        // echo $result;
        // $data = $result->fetch_all(MYSQLI_ASSOC);
        // if($GLOBALS['debug']) {print_r($data);}
        
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

        $sql = "SELECT * FROM AREA WHERE occupancy < ?";
        $result = $conn->prepare($sql);
        $result->bind_param('i', $threshold);
        $result->execute();
        $stmt = $result->get_result();
        if ($stmt->num_rows > 0) {
            // output data of each row
            while ($row = $stmt->fetch_assoc()) {
                $data[] = $row;
            }
        }
        $conn->close();
        return $data;
    }

    function retrieve_cp_by_zone($zone) {
        if ($GLOBALS['localtesting']) {
            $conn = new mysqli("localhost", "root", "", "carpark");
        } else {
            $config = parse_ini_file('/var/www/private/db-config.ini'); //Should use absolute path because when method is called from different places, the relative path is different
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        }
        if ($conn->connect_error) {
            die("Connection error: " . $conn->connect_error);
        }
        $type = "carpark";
        $sql = "SELECT * FROM area WHERE zone = ? AND type = ?";
        $result = $conn->prepare($sql);
        $result->bind_param('ss', $zone, $type);
        $result->execute();
        $stmt = $result->get_result();
        if ($stmt->num_rows > 0) {
            // output data of each row
            while ($row = $stmt->fetch_assoc()) {
                $data[] = $row;
            }
        }
       
        $conn->close();
        return $data;
    }
}
