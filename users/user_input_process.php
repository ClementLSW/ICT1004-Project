<?php

//turn off error reporting
error_reporting(1);
require "../initialize.php";
include $GLOBALS['root'] ."/connections.php";
$currentDestination = null;
$currentShop = null;
$area = [];
if (isset($_POST['destination'])) {
    if ($_POST['destination'] == 1) {
        // Expo 
        $connection = new connections();
        
        if (!filter_var($_POST['destination'], FILTER_VALIDATE_INT) === false){
            $value = trim(strval($_POST['destination']));
            $value = htmlspecialchars($value);
            $colArray = ['location_id' , "type"];
            $valArray = [$value , "carpark"];
            $length = count($valArray);
            $typeArray = ['int' , 'string'];
            $operators = ["=","!="];
            $area = $connection->retrieve_data_where_multiple_equals("area", $colArray , $valArray, $length , $typeArray , $operators);
            echo json_encode($area); 
            
            // $area = $connection->retrieve_data_where("area", "location_id",$value);
        }
    }
    if ($_POST['destination'] == 2) {
        // Suntec City 
        $connection = new connections();
       if (!filter_var($_POST['destination'], FILTER_VALIDATE_INT) === false){
            $value = trim(strval($_POST['destination']));
            $value = htmlspecialchars($value);
            $colArray = ['location_id' , "type"];
            $valArray = [$value , "carpark"];
            $length = count($valArray);
            $typeArray = ['int' , 'string'];
            $operators = ["=","!="];
            $area = $connection->retrieve_data_where_multiple_equals("area", $colArray , $valArray, $length , $typeArray , $operators);
            echo json_encode($area); 
            // $area = $connection->retrieve_data_where_multiple_equals("area", ["location_id" ] , [$destinationValue ] , 1 , ['int']);

        }
    }
}

if(isset($_POST['getKey'])){
    if($GLOBALS['localtesting']){
        $param = parse_ini_file($GLOBALS['root'] . '/../var/www/private/db-config.ini');
        $key = $param['googlekey'];
        echo $key;

    }else{
        echo "AIzaSyCmiOGqCQ_5z0FeMbuelO3H3kFPQC7JDPw";   
    }
}

if(isset($_POST['getServerKey'])){
    if($GLOBALS['localtesting']){
        $param = parse_ini_file($GLOBALS['root'] . '/../var/www/private/db-config.ini');
        $key = $param['googlekey'];
        echo $key;

    }else{
        echo "AIzaSyDo4fLUAb1snqCHGfOI8xMsT8dECiI_mc8";   
    }
}

//Check if got both value 
if (isset($_POST['currentDestination']) && isset($_POST['currentShop']) && isset($_POST['userlat']) && isset($_POST['userlng'])) {
    $currentDestination = $_POST['currentDestination'];
    $currentShop = $_POST['currentShop'];
    $validDestination = filter_var($_POST['currentDestination'], FILTER_VALIDATE_INT);
    $validShop = filter_var($_POST['currentShop'], FILTER_VALIDATE_INT);
    if (!$validShop === false && !$validDestination === false){
        $destinationValue = trim(strval($_POST['currentDestination']));
        $shopValue = trim(strval($_POST['currentShop']));
        $destinationValue = htmlspecialchars($destinationValue);
        $shopValue = htmlspecialchars($shopValue);


        $connection = new connections();
        $colArray = ["area_id" ];
        $valArray = [$currentShop];
        $length = count($valArray);
        $typeArray = ["int" ];
        $operators = ["="];
        $getAreaName = $connection->retrieve_data_where_multiple_equals("area", $colArray , $valArray, $length , $typeArray , $operators);
        
        //Use Clement Method 
        include  '../calculate_route.php';
        $area_id = get_best_cp($shopValue);
        //Retrieve the area data based on area id
        // $area = $connection->retrieve_data_where_multiple_equals("area", ["location_id" ] , [$destinationValue ] , 1 , ['int']);

        $colArray = ["location_id" , "type" , "area_id"];
        $valArray = [$destinationValue , "carpark" , $area_id];
        $length = count($valArray);
        $typeArray = ["int" , "string" , "int"];
        $operators = ["=" , "=" , "="];
        $area = $connection->retrieve_data_where_multiple_equals("area", $colArray , $valArray, $length , $typeArray , $operators);
        $userlatitude = $_POST['userlat'];
        $userlongitude = $_POST['userlng'];
        list($destlat,  $destlng) = getCoordinatesFromArea($area);
        $url = "https://www.google.com/maps/dir/" . $userlatitude . "," . $userlongitude . "/" . $destlat . "," . $destlng;
        $arr = array('carparkName' => $area[0]['name'], 'destlat' => $destlat, 'destlng' => $destlng, 'url' => $url, 'userlat' => $userlatitude , 'userlng' => $userlongitude , 'areaName' => $getAreaName[0]['name']);
        echo json_encode($arr);
        // echo '<a href="'. $url . '"target="_blank">Direct</a>';


        // if($GLOBALS['debug']){print($destinationValue);}
    }
}



function getCoordinatesFromArea($area){
    $carparkName = $area[0]['name'];
    $carparkName = strtolower($carparkName);
    if($carparkName === "carpark a"){
        $n = 1.335925;
        $e = 103.960238;
    }elseif($carparkName === "carpark b"){
        $n = 1.335216; 
        $e = 103.959563;
    }
    elseif($carparkName === "carpark c"){
        $n = 1.334594; 
        $e = 103.958984;
    }elseif($carparkName === "carpark d"){
        $n = 1.334036; 
        $e =  103.958437;
    } elseif($carparkName === "carpark e"){
        $n = 1.334336; 
        $e =  103.957884;
    }elseif($carparkName === "carpark f"){
        $n = 1.334974; 
        $e =  103.958469;
    }elseif($carparkName === "carpark g"){
        $n = 1.335612;
        $e =  103.959113;
    }elseif($carparkName === "carpark g"){
        $n = 1.335612;
        $e =  103.959113;
    }elseif($carparkName === "carpark g"){
        $n = 1.336347;
        $e =  103.959606;
    }elseif ($carparkName === "carpark k"){
        $n= 1.339157;
        $e = 103.964042;
    }elseif ($carparkName === "carpark j"){
        $n = 1.331695; 
        $e = 103.959673;
    }

    return array($n, $e);

}

?>