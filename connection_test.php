<?php

class connections {

    function return_all_results($tableName) {
        $config = parse_ini_file('/var/www/private/db-config.ini'); //Should use absolute path because when method is called from different places, the relative path is different    
        $servername = $config['servername'];
        $username = $config['username'];
        $password = $config['password'];
        $dbname = $config['dbname'];
        $dsn = "mysql:host=$servername;dbname=$dbname;";
        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
        $stmt = $pdo->query("SELECT * FROM $tableName");
        $data = $stmt->fetchAll();        
        
        return $data;
    }

}

?>