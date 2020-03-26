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

if(isset($_POST['historyID'])){
    $validID = filter_var($_POST['historyID'], FILTER_VALIDATE_INT);
    if(!$validID === false){
        $historyID = $_POST['historyID'];
        $connection = new connections();
        $colArray = ["user_id" ];
        $valArray = [$historyID];
        $length = count($valArray);
        $typeArray = ["int" ];
        $operators = ["="];
        $historyInformation = $connection->retrieve_data_where_multiple_equals("history", $colArray , $valArray, $length , $typeArray , $operators);
        echo json_encode($historyInformation);
    }
}


if(isset($_POST['destinationName']) && isset($_POST['shopName'])){
    $destinationName = $_POST['destinationName'];
    $shopName = $_POST['shopName'];
    $destinationValue = trim(strval($destinationName));
    $shopValue = trim(strval($shopName));
    $destinationValue = htmlspecialchars($destinationName);
    $shopValue = htmlspecialchars($shopName);
    $connection = new connections();
    $colArray = ["name"];
    $valArray = [$shopValue];
    $length = count($valArray);
    $typeArray = ["string" ];
    $operators = ["="];
    $getAreaID = $connection->retrieve_data_where_multiple_equals("area", $colArray , $valArray, $length , $typeArray , $operators);
    

    $colArray = ["location_name"];
    $valArray = [$destinationValue];
    $length = count($valArray);
    $typeArray = ["string" ];
    $operators = ["="];
    $getLocationID = $connection->retrieve_data_where_multiple_equals("location", $colArray , $valArray, $length , $typeArray , $operators);
    
    $arr = array('destinationID' => $getLocationID[0]['location_id'] , 'shopID' => $getAreaID[0]['area_id']);
    echo json_encode($arr);
}

//Check if got both value 
if (isset($_POST['currentDestination']) && isset($_POST['currentShop']) && isset($_POST['userlat']) && isset($_POST['userlng'])) {
    $currentDestination = $_POST['currentDestination'];
    $currentShop = $_POST['currentShop'];
    $validDestination = filter_var($_POST['currentDestination'], FILTER_VALIDATE_INT);
    $validShop = filter_var($_POST['currentShop'], FILTER_VALIDATE_INT);
    $validuserlat = filter_var($_POST['userlat'] , FILTER_SANITIZE_NUMBER_FLOAT);
    $validuserlng = filter_var($_POST['userlat'] , FILTER_SANITIZE_NUMBER_FLOAT);
    if (!$validShop === false && !$validDestination === false && $validuserlat != NULL && $validuserlng != NULL){
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
        
        $getDestinationName = $connection->retrieve_data_where("location", "location_id", $currentDestination);
        //Use Clement Method 
        include  '../calculate_route.php';
        list($area_id, $occupancy) = get_best_cp($getAreaName[0]['zone']);
    //    $area_id = 20;
        // Retrieve the area data based on area id
        // $area = $connection->retrieve_data_where_multiple_equals("area", ["location_id" ] , [$destinationValue ] , 1 , ['int']);

        $colArray = ["location_id" , "type" , "area_id"];
        $valArray = [$destinationValue , "carpark" , $area_id];
        $length = count($valArray);
        $typeArray = ["int" , "string" , "int"];
        $operators = ["=" , "=" , "="];
        $area = $connection->retrieve_data_where_multiple_equals("area", $colArray , $valArray, $length , $typeArray , $operators);
        $userlatitude = $_POST['userlat'];
        $userlongitude = $_POST['userlng'];

        $usercombined = $userlatitude . ",".  $userlongitude;
        list($destlat,  $destlng) = getCoordinatesFromArea($area);
        $destcombined = $destlat . "," . $destlng;
        $url = "https://www.google.com/maps/dir/" . $usercombined . "/" . $destcombined;
        
        if($_POST['isLogin'] == 'true' && isset($_POST['username'])){
            // save to history 
            $fullDestinationName = $getDestinationName[0]['location_name'] . ", " .  $getAreaName[0]['name'];
            $starting_address = $userlatitude . "," . $userlongitude;
            $destination_address = $destlat . "," . $destlng;
            $connection->saveUserHistory("history" , $_POST['username'] , $_POST['dateTime'] , $starting_address, "test", $_POST['startingName'] , $fullDestinationName);
        }
        $arr = array('error' => 0 , 'destinationName' => $getDestinationName[0]['location_name'] , 'carparkName' => $area[0]['name'], 'destlat' => $destlat, 'destlng' => $destlng, 'url' => $url, 'userlat' => $userlatitude , 'userlng' => $userlongitude , 'areaName' => $getAreaName[0]['name'] , 'occupancy' => $occupancy);
        echo json_encode($arr);
        
       
        // echo '<a href="'. $url . '"target="_blank">Direct</a>';
    }else{
        $arr = array('error' => 1);
        echo json_encode($arr);
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
    }elseif($carparkName === "carpark h"){
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